<?php
namespace app\index\controller;
use think\Controller;

class Login extends Controller
{
	private $login;
    private $login_code;
    public function __construct()
    {
        parent::__construct();
        $this->login_code = input('login_code/s','weixin');
        $code = "\login\\$this->login_code\\$this->login_code";
        $this->login = new $code();
    }
	/**
	 * 授权登陆
	 * @return [type] [description]
	 */
    public function login()
    {
    	$this->login->login();
    }
    /**
     * 授权回调实现逻辑
     * @return function [description]
     */
    public function callback()
    {
    	$results = $this->login->callback();
    	dump($results);
    }
}
