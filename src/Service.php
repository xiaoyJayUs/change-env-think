<?php

namespace XiaoyJayUs\ChangeEnv\Think;

use XiaoyJayUs\ChangeEnv\Think\Console\ChangeEnv;

class Service extends \think\Service
{
    public function boot()
    {
        $this->commands([ChangeEnv::class]);
    }
}
