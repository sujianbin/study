<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Payment extends Controller
{
    private $payment;
    private $pay_code;
    public function __construct()
    {
        parent::__construct();
        $this->pay_code = input('pay_code/s','alipay');
        $code = "\payment\\$this->pay_code\\$this->pay_code";
        $this->payment = new $code();
    }
    /**
     * 去支付
     * @return [type] [description]
     */
    public function goPay()
    {
        //我统一写的，对应开发人员根据需求进行更改
        $data = [
            'body'             => '测试',
            'subject'          => '主题',
            'out_trade_no'     => time(),
            'total_fee'        => 0.01,
            'spbill_create_ip' => '', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
            'notify_url'       => request()->domain().url('payment/notifyUrl',['pay_code'=>$this->pay_code]), // 支付结果异步通知网址，如果不设置则会使用配置里的默认地址
            'return_url'       => request()->domain().url('payment/returnUrl',['pay_code'=>$this->pay_code]), // 支付结果同步通知网址，如果不设置则会使用配置里的默认地址
            'product_id'       => 1,//扫码支付必须传递商品id
            'openid'           => '',
            'attach'           => '',//附带其他参数
        ];
        //微信支付
        if($this->pay_code == 'weixin'){
            if(cookie('openid') && strstr($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')){
                $results = $this->payment->getJSAPI($data);
            }else{
                $results = $this->payment->getCodeUrl($data);
            }
        }else if($this->pay_code == 'alipay' || $this->pay_code == 'alipayMobile'){
            $results = $this->payment->goPay($data);
        }
        dump($results);
    }
    /**
     * 异步通知
     * @return [type] [description]
     */
    public function notifyUrl()
    {
        $this->payment->notifyUrl();
        exit();
    }
    /**
     * 同步通知
     * @return [type] [description]
     */
    public function returnUrl()
    {
        $this->payment->returnUrl();
        exit();
    }
}