<?php

namespace XiaoyJayUs\ChangeEnv\Think\Console;


use think\Console\Command;
use think\Console\input\Option as InputOption;
use think\Console\input\Argument as InputArgument;
use think\console\output\Ask;
use think\console\output\Question;
use think\console\Table;
use think\contract\Arrayable;
use think\console\output\question\Choice as ChoiceQuestion;

class ChangeEnv extends Command
{

    /** @var array $config */
    protected $config = [];

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $configNames = array_keys($this->config());
        $this->setName("xy:change-env")
            ->setDescription('开发环境切换')
            ->addArgument('env-all', InputArgument::OPTIONAL, '替换所有配置环境')
            ->addOption('quick', 'Q', InputOption::VALUE_NONE, '快捷模式');
        foreach ($configNames as $name) {
            $this->addOption($name, null, InputOption::VALUE_OPTIONAL, 'local/dev/prod', 'local');
        }
    }

    public function handle(): bool
    {
        $this->config = $this->config();
        $configNames  = array_keys($this->config);
        $argument     = $this->input->getArgument('env-all');
        $options      = $this->input->getOptions();
        # 快速模式
        if ($options['quick']) {
            $askConfigNames = $this->askQuestion((new ChoiceQuestion('需要替换的【配置】', $configNames))->setMultiselect(true));
            $askEnv         = $this->askQuestion((new ChoiceQuestion('需要替换的【环境】', ['local', 'dev', 'prod'])));
            foreach ($askConfigNames as $name) {
                $options[$name] = $askEnv;
            }
        }
        # 获取配置文件
        $file    = $this->app->getRootPath() . '.env';
        $content = file_get_contents($file);
        $content = preg_replace("/\r/", PHP_EOL, $content);

        # 替换配置
        $result    = [];
        $envColors = [
            'local' => '',
            'dev'   => 'comment',
            'prod'  => 'info',
        ];
        foreach ($configNames as $name) {
            $inputEnv  = $argument ?: $options[$name];
            $nowConfig = $this->config[$name][$inputEnv];
            # 替换某个配置
            foreach ($nowConfig as $key => $value) {
                $pattern     = '/^' . preg_quote($key, '/') . '=.*$/m';
                $replacement = $key . '=' . $value;
                $content     = preg_replace($pattern, $replacement, $content);
            }
            $color    = $envColors[$inputEnv];
            $result[] = [$name, $color ? "<{$color}>{$inputEnv}</{$color}>" : $inputEnv];
        }

        #替换源文件
        file_put_contents($file, $content);


        #---- output -----
        $this->tableRender(
            ['配置', '环境'],
            $result
        );
        #---- output -----
        return true;
    }

    /**
     * 获取配置
     * @return array
     */
    public function config(): array
    {
        return config('change-env') ?: [];
    }

    /**
     * 输出提问
     * @param Question $question
     * @return mixed
     */
    public function askQuestion(Question $question)
    {
        $ask    = new Ask($this->input, $this->output, $question);
        $answer = $ask->run();

        if ($this->input->isInteractive()) {
            $this->output->newLine();
        }

        return $answer;
    }

    /**
     * 输出信息
     * @param Question $question
     * @return mixed
     */
    public function info($msg)
    {
        $this->output->info($msg);
    }

    /**
     * 输出表格
     * @param array $headers
     * @param $rows
     * @param string $tableStyle
     * @return string
     */
    public function tableRender(array $headers, $rows, string $tableStyle = 'default'): string
    {
        $table = new Table();

        if ($rows instanceof Arrayable) {
            $rows = $rows->toArray();
        }

        $table->setHeader($headers);
        $table->setRows($rows);
        $table->setStyle($tableStyle);

        return $this->table($table);
    }
}