<?php
	namespace app\admin\controller;
	use think\Db;

	class Comment extends Base
	{
		/**
		 * 在线咨询
		 * @return [type] [description]
		 */
		public function index()
		{
			$lists = Db::name('comment')->order('create_time desc')->paginate();
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		public function delete($id)
		{
			if($id){
				$ids = explode(',',$id);
				$results = Db::name('comment')->delete($ids);
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