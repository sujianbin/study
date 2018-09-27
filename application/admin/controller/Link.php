<?php
	namespace app\admin\controller;
	use think\Db;

	class Link extends Base
	{
		public function index()
		{
			$lists = Db::name('link')->order('order_id asc')->paginate();
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		public function modify($id = 0)
		{
			if($id == 0){
				return $this->fetch();
			}else{
				$model = Db::name('link')->where('id',$id)->find();
				$this->assign('model',$model);
				return $this->fetch();
			}
		}
		public function update()
		{
			$data = input('post.');
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\Link'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }
			$id = input('post.id/d');
			if($id){
				$model = Db::name('link')->field('id')->where('id',$id)->find();
				if(!$model){
					$this->error('对不起暂无当前记录');
				}else{
					$results = Db::name('link')->update($data);
					if($results >= 0){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}
			}else{
				$results = Db::name('link')->data($data)->insert();
				if($results){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}
		public function delete($id)
		{
			if($id){
				$ids = explode(',',$id);
				$results = Db::name('link')->delete($ids);
				if($results){
					$this->success("成功删除{$results}条数据");
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->error("删除失败");
			}
		}
	}