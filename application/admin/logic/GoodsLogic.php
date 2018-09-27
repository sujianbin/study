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

class GoodsLogic
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
        return Db::name('goods_category')->where('id', $id)->value('parent_id');
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
     * 针对编辑商品分类
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
                $v['name'] = $str . $v['name'];
                array_push($arr, $v);
                $arrSub2 = $this->getSub($v['id'], $level);
                if (is_array($arrSub2)) {
                    $arr = $this->getSubList($v['id'], $level, $str . '----', $arr);
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
        $map[] = ['level', '<=', $level];
        $map[] = ['parent_id', '=', $id];
        $arr   = Db::name('goods_category')->field('id,name,parent_id')->where($map)->order('order_id asc')->select();
        return $arr;
    }
    /**
     * 获取规格输入框
     * @param  [type] $goods_id [description]
     * @param  [type] $spec_arr [description]
     * @return [type]           [description]
     */
    public function getSpecInput($goods_id, $spec_arr)
    {
        foreach ($spec_arr as $k => $v) {
            $spec_arr_sort[$k] = count($v);
        }
        asort($spec_arr_sort);
        foreach ($spec_arr_sort as $k => $v) {
            $spec_arr2[$k] = $spec_arr[$k];
        }
        //$a[1] = [1,2] $a[2] = [3,4]; $a[3] = [5,6]
        $spec = Db::name('goods_spec')->column('spec_name', 'id');

        $arr = '<tr>';

        $specKey = array_keys($spec_arr2); //[1,2,3] goods_spec
        foreach ($specKey as $k => $v) {
            $arr .= "<td>{$spec[$v]}</td>";
        }
        $arr .= "<td>价格</td><td>库存</td></tr>";

        $spec_arr2 = combineDika($spec_arr2); //数组的笛卡尔积 [[1,3],[1,4],[1,5],[1,6],[2,3]....]
        $specItem  = Db::name('goods_spec_item')->column('value', 'id');
        $specPrice = Db::name('goods_spec_price')->where('goods_id', $goods_id)->column('*', 'key');
        foreach ($spec_arr2 as $k => $v) {
            $arr .= "<tr>";
            $itemKeyName = [];
            foreach ($v as $k1 => $v1) {
//[1,3] goods_spec_item
                $arr .= "<td>{$specItem[$v1]}</td>";
                $itemKeyName[$v1] = $spec[$specKey[$k1]] . ':' . $specItem[$v1];
            }
            ksort($itemKeyName);
            $itemKey                                                                          = implode('#', array_keys($itemKeyName));
            $itemName                                                                         = implode(' ', $itemKeyName);
            $specPrice[$itemKey]['price'] ? false : $specPrice[$itemKey]['price']             = 0;
            $specPrice[$itemKey]['store_count'] ? false : $specPrice[$itemKey]['store_count'] = 0;
            $arr .= "<td><input type='text' style='width:80%;' name='item[$itemKey][price]' value='{$specPrice[$itemKey][price]}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")'></td>";
            $arr .= "<td><input type='text' style='width:80%;' name='item[$itemKey][store_count]' value='{$specPrice[$itemKey][store_count]}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")'><input type='hidden' name='item[$itemKey][key_name]' value='{$itemName}'/></td>";
            $arr .= "</tr>";
        }
        return $arr;
    }
    /**
     * 商品属性值赋值
     * @param  [type] $goods_id   [description]
     * @return [type]             [description]
     */
    public function saveGoodsAttr($goods_id)
    {
        $data = input('post.');
        //获取当前商品的属性值集合
        $oldAttrList = Db::name('goods_attr')->where('goods_id', $goods_id)->select();
        $oldAttr     = [];
        if (is_array($oldAttrList)) {
            foreach ($oldAttrList as $k => $v) {
                $oldAttr[$v['attr_id'] . '_' . $v['attr_value']] = $v;
            }
        }
        foreach ($data as $k => $v) {
            $attrId = str_replace('attr_', '', $k);
            if (is_numeric($attrId)) {
                $v = str_replace('_', '', $v); // 替换特殊字符
                $v = str_replace('@', '', $v); // 替换特殊字符
                $v = trim($v);
                if (!empty($v)) {
                    $tmpKey = $attrId . '_' . $v;
                    if (!array_key_exists($tmpKey, $oldAttr)) {
//当前值不存在，不存在原因在于什么？在于值改变了或者新添加了属性
                        //添加当前属性值,并且还需要删除当前的属性
                        Db::name('goods_attr')->data(['goods_id' => $goods_id, 'attr_id' => $attrId, 'attr_value' => $v])->insert();
                    } else {
                        unset($oldAttr[$tmpKey]);
                    }
                }
            }
        }
        if (is_array($oldAttr)) {
            foreach ($oldAttr as $k => $v) {
//删除原有数据库中原来存在的数据，但是表单中没有提交过来，或者提交过来但是值已被改变
                Db::name('goods_attr')->where('id', $v['id'])->delete();
            }
        }
    }
}
