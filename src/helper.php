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

Route::get('captcha/[:id]', "\\shirne\\captcha\\CaptchaController@index");

Validate::extend('captcha', function ($value, $id = '') {
    return captcha_check($value, $id);
});

Validate::setTypeMsg('captcha', ':attribute错误!');

/**
 * @param string $id
 * @param array  $config
 * @return \think\Response
 */
function captcha($id = '', $config = [], $store = null)
{
    $captcha = new \shirne\captcha\Captcha($config, $store);
    return $captcha->entry($id);
}

/**
 * @param $id
 * @return string
 */
function captcha_src($id = '')
{
    return Url::build('/captcha' . ($id ? "/{$id}" : ''));
}

/**
 * @param $id
 * @return mixed
 */
function captcha_img($id = '')
{
    return '<img src="' . captcha_src($id) . '" alt="captcha" />';
}

/**
 * @param        $value
 * @param string $id
 * @param array  $config
 * @return bool
 */
function captcha_check($value, $id = '', $store=null)
{
    $config = (array) Config::pull('captcha');
    $mode = isset($config['mode'])?$config['mode']:'';
    $captcha = new \shirne\captcha\Captcha($config, $mode=='cache'? think\facade\Cache::instance():null);
    return $captcha->check($value, $id);
}
