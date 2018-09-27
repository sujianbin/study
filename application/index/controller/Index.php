<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use EasyWeChat\Factory;
use app\common\logic\WechatLogic;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function test()
    {
        echo 'test';
    }
    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
    /**
     * cur post请求数据
     * @param  [type] $url  [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    private function curl_post($url,$data){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array('Content-Type: multipart/form-data')
        );
        $res = curl_exec($curl);
        $errorno = curl_errno($curl);
        if ($errorno) {
            return array('resultCode' => 101, 'message' => $errorno);
        }
        curl_close($curl);
        return json_decode($res, true);
    }
}
