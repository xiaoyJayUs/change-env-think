<?php

namespace XiaoyJayUs\console;


use think\Console\Command;
use think\Console\input\Option;

class ChangeEnv extends Command
{

    /** @var array $config */
    protected $config = [];

    protected function configure()
    {
        $configNmaes = array_keys(config('change_env'));
        $this->setName("change:env")
            ->setDescription('开发环境切换');
        foreach ($configNmaes as $name) {
            $this->addOption($name, null, Option::VALUE_OPTIONAL, 'local/dev/prod', 'local');
        }
    }

    public function handle(): bool
    {
        $this->config = $this->app->config->get('change_env');
        $configNmaes  = array_keys($this->config);
        $options      = $this->input->getOptions();
        $file         = $this->app->getRootPath() . '.env';
        $content      = file_get_contents($file);
        $content      = preg_replace("/\r/", PHP_EOL, $content);
        $msg          = [];
        foreach ($configNmaes as $name) {
            $inputEnv  = $options[$name];
            $nowConfig = $this->config[$name][$inputEnv];
            # 替换配置
            foreach ($nowConfig as $key => $value) {
                $pattern     = '/^' . preg_quote($key, '/') . '=.*$/m';
                $replacement = $key . '=' . $value;
                $content     = preg_replace($pattern, $replacement, $content);
            }
            $msg[] = "{$name}:{$inputEnv}";
        }

        #替换源文件
        file_put_contents($file, $content);

        $this->output->info(implode(PHP_EOL, $msg));
        return true;
    }
}