<?php
namespace think;
// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');
// 加载框架基础引导文件
require __DIR__ . '/thinkphp/base.php';
// 多语言版本设置允许的语言
//\think\facade\Lang::setAllowLangList(['cn','en']);
// 执行应用并响应
Container::get('app')->path(APP_PATH)->bind('index')->run()->send();