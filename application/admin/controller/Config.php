<?php
namespace app\admin\controller;

use think\Db;

class Config extends Base
{
    public function index()
    {
        if ($this->request->isPost()) {
            $data = input('post.');
            config_cache('', $data);
            $this->success('操作成功');
        } else {
            $group = [
                'config' => '基本设置',
                'water'  => '水印设置',
                'smtp'   => '邮件设置',
                'sms'    => '短信设置',
            ];
            $this->assign('group', $group);
            $type = input('type', 'config');
            $this->assign("type", $type);
            $model = Db::name('config')->where('type', $type)->column('value', 'name');
            $this->assign('model', $model);
            return $this->fetch($type);
        }
    }

    public function sendEmail()
    {
        if ($this->request->isAjax()) {
            $email   = input('post.email');
            $object  = '系统邮件设置测试';
            $content = '当您收到这封邮件时表明您的配置成功，能够正常发送邮件！';
            $data    = send_email($email, $object, $content);
            return json($data);
        }
    }
}
