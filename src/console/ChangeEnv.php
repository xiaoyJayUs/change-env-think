<?php

namespace XiaoyJayUs\console;


use think\console\Command;
use think\console\input\Argument;

class ChangeEnv extends Command
{
    /**
     * @var string $description
     */
    protected $description = '开发环境切换';

    protected $config = [
        'mysql' => [
            'local' => [
                'DB_HOST'     => '127.0.0.1',
                'DB_DATABASE' => 'crm_sys',
                'DB_USERNAME' => 'root',
                'DB_PASSWORD' => '123456',
                'DB_PORT'     => '58018',
            ],
        ],
        'redis' => [
            'local' => [
                'REDIS_HOST'     => '127.0.0.1',
                'REDIS_PASSWORD' => '',
                'REDIS_PORT'     => '6379',
            ],
            'dev'   => [
                'REDIS_HOST'     => '47.112.163.160',
                'REDIS_PASSWORD' => 'CdMd*20251048',
                'REDIS_PORT'     => '6379',
            ],
        ],
    ];

    protected function configure()
    {
        $this->setName("change:env")
             ->addArgument('mysql', Argument::OPTIONAL, 'local/dev/prod', 'local')
             ->addArgument('redis', Argument::OPTIONAL, 'local/dev/prod', 'local');
    }

    public function handle(): bool
    {
        $mysql = $this->input->getArgument('mysql');
        $redis = $this->input->getArgument('redis');

        if (empty($this->config['mysql'][$mysql])) {
            $this->output->error('mysql配置不存在');
            exit;
        } elseif (empty($this->config['redis'][$redis])) {
            $this->output->error('redis配置不存在');
            exit;
        }
        $mysqlConfig = $this->config['mysql'][$mysql];
        $redisConfig = $this->config['redis'][$redis];
        $file        = base_path() . '/.env';
        $content     = file_get_contents($file);

        # 替换 mysql 配置
        foreach ($mysqlConfig as $key => $value) {
            $pattern     = '/^' . preg_quote($key, '/') . '=.*$/m';
            $replacement = $key . '=' . $value;
            $content     = preg_replace($pattern, $replacement, $content);
        }

        # 替换 redis 配置
        foreach ($redisConfig as $key => $value) {
            $pattern     = '/^' . preg_quote($key, '/') . '=.*$/m';
            $replacement = $key . '=' . $value;
            $content     = preg_replace($pattern, $replacement, $content);
        }

        #替换源文件
        file_put_contents($file, $content);

        $this->output->info("mysql:{$mysql}\nredis:{$redis}");
        return true;
    }
}
