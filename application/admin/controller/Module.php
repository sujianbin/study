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
use app\admin\logic\ModuleLogic;
use think\Db;

class Module extends Base
{
    public function index()
    {
        $map[]      = ['c.parent_id', '=', 0];
        $name       = input('name/s', '', 'trim');
        $controller = input('controller/s', '', 'trim');
        if ($name) {
            $this->assign('name', $name);
            $map[] = ['c.cat_name', 'like', "%{$name}%"];
        }
        if ($controller) {
            $this->assign('controller', $controller);
            $map[] = ['c.controller', 'like', "%{$controller}%"];
        }
        $lists = Db::name('category')->alias('c')->field('c.cat_id,c.cat_name,c.order_id,c.controller,c.module_id')->where($map)->order('c.order_id asc,c.cat_id desc')->paginate(config('paginate.list_rows'), false, ['query' => request()->param()]);
        $this->assign("lists", $lists);
        return $this->fetch();
    }
    public function modify()
    {
        return $this->fetch();
    }
    public function edit($id)
    {
        $model = Db::name('category')->where('cat_id',$id)->where('parent_id',0)->find();
        if($model){
            $model['seo_meta'] = unserialize($model['seo_meta']);
            $this->assign('model',$model);
            return $this->fetch();
        }else{
            $this->error('模块不存在');
        }
    }
    public function editUpdate()
    {
        $data              = input('post.');
        $id = input('post.cat_id/d');
        $model = Db::name('category')->where('cat_id',$id)->where('parent_id',0)->find();
        if($model){
            $data['seo_meta']  = serialize(['seo_title' => $data['seo_title'] ? $data['seo_title'] : $cat_name, 'seo_keywords' => $data['seo_keywords'], 'seo_description' => $data['seo_description']]);
            $update = [
                'max_level'=>input('post.max_level/d'),
                'seo_meta'=>$data['seo_meta'],
                'cat_id'=>$id
            ];
            $results = Db::name('category')->strict(false)->update($update);
            if ($results >= 0) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }else{
            $this->error('模块不存在');
        }
    }
    public function delete($id)
    {
        $model = Db::name('category')->where('cat_id', $id)->where('parent_id', 0)->find();
        if ($model) {
            //$this->error('当前权限不开放，请联系程序处理');
            $controller     = ucfirst($model['controller']);
            $controllerPath = env('APP_PATH') . 'admin/controller/' . $controller . '.php';
            $validatePath   = env('APP_PATH') . 'admin/validate/' . $controller . '.php';
            $dirPath        = env('APP_PATH') . 'admin/view/' . strtolower($controller);
            //删除控制器
            @unlink($controllerPath);
            @unlink($validatePath);
            //删除文件夹
            del_file($dirPath);
            @rmdir($dirPath);
            Db::name('category')->where('cat_id',$id)->delete();
            $this->success('模块删除成功');
        } else {
            $this->error('当前模块不存在');
        }
    }
    public function update()
    {
        $data         = input('post.');
        $json['code'] = 101;
        $controller   = ucfirst(input('post.controller/s', '', 'trim')); //规范控制器首字母大写
        $keywords     = ['abstract', 'and', 'array', 'as',
            'break', 'callable', 'case', 'catch', 'class',
            'clone', 'const', 'continue', 'declare', 'default',
            'die', 'do', 'echo', 'else', 'elseif',
            'enddeclare', 'endfor', 'endforeach', 'endif',
            'endswitch', 'endwhile', 'eval', 'exit', 'extends',
            'final', 'finally', 'for', 'foreach', 'function',
            'global', 'goto', 'if', 'implements', 'include',
            'include_once', 'instanceof', 'insteadof', 'interface', 'isset',
            'list', 'namespace', 'new', 'or', 'print',
            'private', 'protected', 'public', 'require', 'require_once',
            'return', 'static', 'switch', 'throw', 'trait',
            'try', 'unset', 'use', 'var', 'while',
            'xor', 'yield'];
        if (!preg_match('/^[_0-9a-zA-Z]{1,}$/i', $controller)) {
            $json['desc'] = '控制器名称只能是数字字母下划线';
        } else if (in_array(strtolower($controller), $keywords)) {
            $json['desc'] = '控制器名称不能是关键字';
        } else {
            //获取全部控制器
            $controllerPath = APP_PATH . 'admin/controller';
            $controllerList = array();
            $dirRes         = opendir($controllerPath);
            while ($dir = readdir($dirRes)) {
                if (!in_array($dir, array('.', '..'))) {
                    $controllerList[] = strtolower(basename($dir, '.php'));
                }
            }
            $cat_name = input('post.cat_name/s', '', 'trim');
            if (in_array(strtolower($controller), $controllerList)) {
                $json['desc'] = '当前控制器存在';
            } else if (!$cat_name) {
                $json['desc'] = '栏目名称不能为空';
            } else {
                //1、新建一条记录存储到数据库中
                //2、根据规则新建对应控制器和静态页面
                $data['seo_meta']       = serialize(['seo_title' => $data['seo_title'] ? $data['seo_title'] : $cat_name, 'seo_keywords' => $data['seo_keywords'], 'seo_description' => $data['seo_description']]);
                $categoryLogic          = new CategoryLogic;
                $data['path_id']        = $categoryLogic->getPathId(0);
                $data['cat_level']      = '1'; //当前级别
                $data['max_level']      = $data['max_level']; //最大级别
                $data['category_model'] = $categoryLogic->stardand(array_filter($data['more_category'])) . ',';
                $data['content_model']  = $categoryLogic->stardand(array_filter($data['more_content'])) . ',';

                $controllerPath = env('APP_PATH') . 'admin/controller/';
                $htmlPath       = env('APP_PATH') . 'admin/view/';
                if (!is_writable($controllerPath)) {
                    $json['desc'] = $controllerPath . '目录不可写入';
                } else if (!is_writable($htmlPath)) {
                    $json['desc'] = $htmlPath . '目录不可写入';
                } else {
                    $data['is_lock'] = 1;
                    $results         = Db::name('category')->strict(false)->insertGetId($data);
                    if ($results) {
                        $moduleLogic = new ModuleLogic;
                        $content     = [
                            'controller'     => $controller,
                            'cid'            => $results,
                            'cat_name'       => $cat_name,
                            'category_model' => $data['category_model'],
                            'content_model'  => $data['content_model'],
                        ];
                        $result = $moduleLogic->create($data['module_id'], $content);
                        $json   = $result;
                        if ($result['code'] != 0) {
                            Db::name('category')->where('cat_id', $results)->delete();
                        }
                    } else {
                        $json['desc'] = '添加数据失败';
                    }
                }
            }
        }
        return json($json);
    }
    public function tplHtml($html_models, $controller)
    {
        return $this->display(file_get_contents(env('APP_PATH') . 'admin/tpl/html_model.tpl'), [
            'controller'  => strtolower($controller),
            'html_models' => $html_models,
        ]);
    }
}
