<?php
namespace app\index\controller;
use think\Controller;

class Test extends Controller
{
    public function index()
    {
    	echo phpinfo();
        return $this->fetch('/index');
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
