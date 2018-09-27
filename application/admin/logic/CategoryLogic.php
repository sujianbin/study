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
namespace app\admin\logic;

use think\Db;

class CategoryLogic
{
    /**
     * 获取路径id
     * @param  [type]  $id    [description]
     * @param  integer $first [description]
     * @return [type]         [description]
     */
    public function getPathId($id, $first = 1)
    {
        if ($first == 1) {
            $pathId = ",{$id},";
        }
        if ($id != 0) {
            $parentId = $this->getParentId($id);
            $pathId .= "{$parentId}," . $this->getPathId($parentId, 0);
        }
        return $pathId;
    }
    /**
     * 获取父类id
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    private function getParentId($id)
    {
        return Db::name('category')->where('cat_id', $id)->value('parent_id');
    }
    /**
     * 获取分类级别
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getLevel($id)
    {
        if ($id == 0) {
            return 1;
        }
        $parentId = $this->getParentId($id);
        if ($parentId != 0) {
            return 1 + $this->getLevel($parentId);
        } else {
            return 2;
        }
    }
    /**
     * 获取子类分类列表
     * @param  [type]  $id    [description]
     * @param  integer $level [description]
     * @param  string  $str   [description]
     * @param  array   $arr   [description]
     * @return [type]         [description]
     */
    public function getSubList($id = 0, $level = 1, $str = '|--', $arr = [])
    {
        $arrSub = $this->getSub($id, $level);
        if (is_array($arrSub)) {
            foreach ($arrSub as $k => $v) {
                $v['cat_name'] = $str . $v['cat_name'];
                array_push($arr, $v);
                $arrSub2 = $this->getSub($v['cat_id'], $level);
                if (is_array($arrSub2)) {
                    $arr = $this->getSubList($v['cat_id'], $level, $str . '----', $arr);
                }
            }
        }
        return $arr;
    }
    /**
     * 当去当前分类下下级分类集合
     * @param  [type]  $id    [description]
     * @param  integer $level [description]
     * @return [type]         [description]
     */
    private function getSub($id, $level = 2)
    {
        if ($level != -1) {
            $map[] = ['cat_level', '<=', $level];
        }

        $map[] = ['parent_id', '=', $id];
        $arr   = Db::name('category')->field('cat_id,cat_name,parent_id,cat_level')->where($map)->order('order_id asc')->select();
        return $arr;
    }
    /**
     * 针对下拉
     * 获取子类别列表
     * @param int $cat_id 类别ID
     */
    public function getSub2($cat_id, $level = 5)
    {
        $map[] = ['parent_id', '=', $cat_id];
        $map[] = ['is_show', '=', 1];
        if ($level != -1) {
            $map[] = ['cat_level', '<=', $level];
        }

        $arr = Db::name('category')->field('cat_id,cat_name,parent_id')->where($map)->order('order_id asc')->select();
        return $arr;
    }

    /**
     * 获取子类别select列表
     * @param int $cat_id 类别id
     */
    public function getSubSelect($cat_id, $level = 5, $current_id = 0, $str = '|--', $arr = [])
    {
        $arr1 = $this->getSub2($cat_id, $level);
        if (is_array($arr1)) {
            foreach ($arr1 as $k => $v) {
                $v['cat_name'] = $str . $v['cat_name'];
                if ($v['parent_id'] != $current_id) {
                    array_push($arr, $v);
                    $arr2 = $this->getSub2($v['cat_id'], $level);
                    if (is_array($arr2)) {
                        $arr = $this->getSubSelect($v['cat_id'], $level, $current_id, $str . '----', $arr);
                    }
                }
            }
        }
        return $arr;
    }
    /**
     * 处理数组$arr,存入数据库中
     * @param  [type] $arr [description]
     * @return [type]      [description]
     */
    public function stardand($arr)
    {
        foreach ($arr as $key => $value) {
            if ($value == 'dantu' || $value == 'duotu' || $value == 'riqi' || $value == 'wenjian' || $value == 'biaoti' || $value == 'wenben' || $value == 'bianjiqiBaidu' || $value == 'shouye') {
                $arr[$key] = ";" . $value;
            }
        }
        $arrs = implode(',', $arr);
        return $arrs;
    }
    /**
     * 处理字符串$arr
     * @param  [type] $arr [description]
     * @return [type]      [description]
     */
    public function unstardand($arr)
    {
        $arrs   = substr($arr, 1);
        $arrays = explode(',;', $arrs);
        return $arrays;
    }
    /**
     * 获取模板内容
     * @param  [type] $data       [description]
     * @param  [type] $controller [description]
     * @return [type]             [description]
     */
    public function tplData($data, $controller)
    {
        if (!empty($data)) {
            $html_models = $this->model_htmls($data);
            $module      = new \app\admin\controller\Module;
            return $module->tplHtml($html_models, $controller);
        } else {
            return null;
        }
    }
    /**
     * 格式化数据
     * @param  [type] $htmls [description]
     * @return [type]        [description]
     */
    private function model_htmls($htmls)
    {
        $html_model = $this->unstardand($htmls);
        if (is_array($html_model)) {
            foreach ($html_model as $key => $v) {
                $a = explode(',', $v);
                if (empty($a[0])) {
                    unset($html_models[$key]);
                } else {
                    $html_models[$key]['type']  = $a[0]; //类型
                    $html_models[$key]['field'] = $a[1]; //字段
                    if ($a[0] == 'shouye') {
                        $radios                    = explode('|', $a[2]);
                        $html_models[$key]['name'] = $radios;
                    } else {
                        $html_models[$key]['name'] = $a[2]; //名称
                    }
                    $html_models[$key]['msg'] = $a[3]; //描述
                }
            }
        }
        return $html_models;
    }
}
