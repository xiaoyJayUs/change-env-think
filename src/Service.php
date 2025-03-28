<?php

namespace XiaoyJayUs;

use XiaoyJayUs\console\ChangeEnv;

class Service extends \think\Service
{
    public function boot()
    {
        $this->commands([ChangeEnv::class]);
    }
}
