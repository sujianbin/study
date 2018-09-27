<@sujianbin@
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

class @controller@ extends Base
{
    private $cid = @cid@;
    public function index()
    {
        $map[] = ['c.path_id', 'like', "%,{$this->cid},%"];
        $name  = input('name/s', '', 'trim');
        if ($name) {
            $map[] = ['c.cat_name', 'like', "%{$name}%"];
            $this->assign('name', $name);
        }
        $parent_id = input('parent_id/d');
        if ($parent_id) {
            $map[] = ['c.path_id', 'like', "%{$parent_id}%"];
            $this->assign('parent_id', $parent_id);
        }
        $lists = Db::name('category')->alias('c')->field('c.cat_id,c.cat_name,c.is_show,c.is_index,c.order_id,c1.cat_name as parent_name')->join('category c1', 'c.parent_id = c1.cat_id')->where($map)->order('c.order_id asc')->paginate(config('paginate.list_rows'), false, ['query' => request()->param()]);
        $this->assign("lists", $lists);
        $categoryLogic = new CategoryLogic;
        $level         = Db::name('category')->field('max_level,cat_id')->where('cat_id', $this->cid)->find();
        $subList       = $categoryLogic->getSubList($level['cat_id'], $level['max_level']);
        $this->assign('subList', $subList);
        return $this->fetch();
    }
    public function modify($id = 0)
    {
        if ($id != 0) {
            $model = Db::name('category')->where('cat_id', $id)->find();
            $model['pic_list']  = explode(';',$model['pic_list']);
            $model['pic_list1'] = explode(';',$model['pic_list1']);
            $model['seo_meta']  = unserialize($model['seo_meta']);
            $this->assign('model', $model);
        }
        $categoryLogic = new CategoryLogic;
        $level         = Db::name('category')->field('max_level,cat_id,cat_name,category_model')->where('cat_id', $this->cid)->find();
        $this->assign('level', $level);
        $parent_list = $categoryLogic->getSubSelect($level['cat_id'], $level['max_level']);
        $this->assign('parent_list', $parent_list);
        return $this->fetch();
    }
    public function update()
    {
        $data              = input('post.');
        $message = $this->validate(
            $data,
            '\app\admin\validate\@controller@'
        );
        if($message !== true){
            $this->error($message);
        }
        $id                = input('post.cat_id/d');
        $parent_id         = input('post.parent_id/d') ? input('post.parent_id/d') : $this->cid;
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
            $results = Db::name('category')->data($data)->strict(false)->insert();
            if ($results) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        }
    }
    public function delete($id)
    {
        if ($id) {
            $ids     = explode(',', $id);
            $results = Db::name('category')->where('is_lock', 0)->delete($ids);
            if ($results) {
                $this->success("成功删除{$results}条数据");
            } else {
                $this->error("删除失败");
            }
        } else {
            $this->error("删除失败");
        }
    }
}
