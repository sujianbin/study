<?php
/**
 * ============================================================================
 * 版权所有 2018-2027  sujianbin，并保留所有权利。
 * 网站地址: https://sujianbin.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必得到允许, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: sujianbin
 * Date: 2018-09-14
 */
namespace app\admin\controller;

use app\admin\logic\CategoryLogic;
use think\Db;

class About extends Base
{
    private $cid = 1;
    public function index()
    {
        $model = Db::name('category')->where('cat_id', $this->cid)->find();
        if($model){
            $model['pic_list']  = explode(';',$model['pic_list']);
            $model['pic_list1'] = explode(';',$model['pic_list1']);
            $model['seo_meta']  = unserialize($model['seo_meta']);
            $this->assign('model', $model);
            return $this->fetch();
        }else{
            $this->error('当前栏目不存在');
        }
    }
    public function update()
    {
        $data              = input('post.');
        $message = $this->validate(
            $data,
            '\app\admin\validate\About'
        );
        if($message !== true){
            $this->error($message);
        }
        $id                = input('post.cat_id/d');
        $parent_id         = 0;
        $categoryLogic     = new CategoryLogic;
        if(input('post.pic_list/a') != null)  $data['pic_list']   = implode(';',input('post.pic_list/a'));
        if(input('post.pic_list1/a') != null) $data['pic_list1']  = implode(';',input('post.pic_list1/a'));
        $data['path_id']   = $categoryLogic->getPathId($parent_id);
        $data['cat_level'] = $categoryLogic->getLevel($parent_id);
        $data['seo_meta']  = serialize(['seo_title' => $data['seo_title'] ? $data['seo_title'] : $cat_name, 'seo_keywords' => $data['seo_keywords'], 'seo_description' => $data['seo_description']]);
        if(!empty(input('post.create_time'))){
            $data['create_time'] = strtotime(input('post.create_time'));
        }else{
            $data['create_time'] = time();
        }
        if ($id) {
            $model = Db::name('category')->field('cat_id')->where('cat_id', $id)->find();
            if (!$model) {
                $this->error('对不起暂无当前记录');
            } else {
                $results = Db::name('category')->strict(false)->update($data);
                if ($results >= 0) {
                    $this->success('修改成功');
                } else {
                    $this->error('修改失败');
                }
            }
        } else {
            $this->error('参数错误');
        }
    }
}
