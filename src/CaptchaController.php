<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

namespace shirne\captcha;

use think\facade\Config;

class CaptchaController
{
    public function index($id = "")
    {
        $config = (array) Config::pull('captcha');
        $mode = isset($config['mode'])?$config['mode']:'';
        $captcha = new Captcha($config, $mode=='cache'? think\facade\Cache::instance():null );
        return $captcha->entry($id);
    }
}
