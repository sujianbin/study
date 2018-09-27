<?php
namespace app\index\controller;
use think\Controller;

class Sms extends Controller
{
	/**
	 * 阿里大于短信发送
	 * @return [type] [description]
	 */
    public function index()
    {
    	$phone = '13266604379';
    	$signName = '短信签名';
    	$templateCode = 'SMS_0000001';
    	$templateParam = ["code"=>"12345","product"=>"dsd"];
    	$results = \sms\aliyundy\aliyundy::sendSms($phone,$signName,$templateCode,$templateParam);
    	dump($results);
    }
}