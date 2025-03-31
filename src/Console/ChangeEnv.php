<?php

namespace XiaoyJayUs\console;


use think\Console\Command;
use think\Console\input\Argument;
use XiaoyJayUs\Config;

class ChangeEnv extends Command
{

    /** @var array $config */
    protected $config = [];

    protected function configure()
    {
        $this->setName("change:env")
            ->addArgument('mysql', Argument::OPTIONAL, 'local/dev/prod', 'local')
            ->addArgument('mongo', Argument::OPTIONAL, 'local/dev/prod', 'local')
            ->addArgument('redis', Argument::OPTIONAL, 'local/dev/prod', 'local')
            ->setDescription('开发环境切换');
    }

    /**
     * @inheritdoc
     */
    protected function setArguments(): array
    {

    }

    public function handle(): bool
    {
        $this->config = Config::get();
        $mysql        = $this->input->getArgument('mysql');
        $mongo        = $this->input->getArgument('mongo');
        $redis        = $this->input->getArgument('redis');

        if (empty($this->config['mysql'][$mysql])) {
            $this->output->error('mysql配置不存在');
            exit;
        } elseif (empty($this->config['redis'][$redis])) {
            $this->output->error('redis配置不存在');
            exit;
        }
        $mysqlConfig = $this->config['mysql'][$mysql];
        $redisConfig = $this->config['redis'][$redis];
        $mongoConfig = $this->config['mongo'][$mongo];
        $file        = $this->app->getRootPath() . '.env';
        $content     = file_get_contents($file);
        $content     = preg_replace("/\r/", PHP_EOL, $content);

        # 替换 mysql 配置
        foreach ($mysqlConfig as $key => $value) {
            $pattern     = '/^' . preg_quote($key, '/') . '=.*$/m';
            $replacement = $key . '=' . $value;
            $content     = preg_replace($pattern, $replacement, $content);
        }

        # 替换 mongo 配置
        foreach ($mongoConfig as $key => $value) {
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

        $this->output->info("mysql:{$mysql}\nmongo:{$mongo}\nredis:{$redis}");
        return true;
    }
}
