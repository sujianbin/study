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
namespace app\admin\validate;

use think\Validate;

class News extends Validate
{
    //验证规则
    protected $rule = [
        'cat_name'        => 'require|checkEmpty',
        'title'           => 'require|checkEmpty',
        'cat_id'          => 'number|gt:0',
        'order_id'        => 'between:0,999999',
    ];

    //错误提示
    protected $message = [
    	'title'           => '栏目名称不能为空',
        'cat_name'        => '栏目名称不能为空',
        'cat_id'          => '请选择所属栏目',
        'order_id'        => '排序字段必须在1-999999之间',
    ];

    //验证场景
    protected $scene = [
    	'index'     => ['title' , 'cat_id', 'order_id'],
        'category'  => ['cat_name', 'order_id'],
    ];

    /**
     * 自定义验证函数去除空格判断是否为空
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    protected function checkEmpty($value)
    {
        if (!isset($value)) {
            return false;
        }
        if (is_string($value)) {
            $value = trim($value);
        }
        if (empty($value)) {
            return false;
        }
        return true;
    }
}
