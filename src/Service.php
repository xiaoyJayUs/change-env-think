<?php

namespace XiaoyJayUs;

use XiaoyJayUs\Console\ChangeEnv;

class Service extends \think\Service
{
    public function boot()
    {
        $this->commands([ChangeEnv::class]);
    }
}
