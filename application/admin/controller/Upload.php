<?php
	namespace app\admin\controller;
	use think\Db;
	use think\facade\Log;

	class Upload extends Base
	{
		public function index()
		{
			$num = input('num/d');
			$elementId = input('elementId/s');
			$path = input('path/s','tmp');
			$callback = input('callback/s');
			$info = [
				'num'       =>$num,
				'input'     =>$elementId,
				'path'      =>$path,
				'callback'  =>empty($callback) ? 'undefined' : $callback,
				'uploadUrl' =>url('upload/upload',['path'=>$path]),
				'deleteUrl' =>url('upload/delPicture')
			];
			$this->assign('info',$info);
			return $this->fetch('upload');
		}
		/**
		 * 图片上传
		 * @return [type] [description]
		 */
		public function upload($path)
		{
			// 获取表单上传文件 例如上传了001.jpg
		    $file = request()->file('file');
		    // 移动到框架应用根目录/uploads/ 目录下
		    $info = $file->validate(['size'=>1024*1024*2,'ext'=>'jpg,png,gif,bmp,ico'])->move('../public/upload/'.$path);
		    if($info){
		        // 成功上传后 获取上传信息
		        // 输出 jpg
		        //$getExtension = $info->getExtension();
		        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
		        $getSaveName = str_replace('\\', '/', $info->getSaveName());
		        // 输出 42a79759f284b767dfcb2a0197904287.jpg
		        //$getFilename = $info->getFilename();

		        //Log::record('图片上传信息,getExtension:'.$getExtension.',getSaveName:'.$getSaveName.',getFilename:'.$getFilename,'upload');
		        $data = ['code'=>0,'url'=>'/public/upload/' . $path . '/'. $getSaveName];
		    }else{
		        // 上传失败获取错误信息
		        $getError = $file->getError();
		        Log::record('图片上传失败,getError:'.$getError,'upload');
		        $data = ['code'=>101,'error'=>$file->getError()];
		    }
		    if($data['code'] == 0){
		    	if($path == 'goods'){
		    		$imgresource = env('ROOT_PATH') . $data['url'];
		    		//Log::record('图片文件位置：'.$imgresource,'upload');
        			$image = \think\Image::open($imgresource);
		    		$water = config_cache('config.water');
		    		//Log::record('图片水印配置：'.json_encode($water),'upload');
		    		if(isset($water['is_water']) && $water['is_water'] == 1){//开启商品水印
		    			if($water['water_type'] == 1){//文字水印
		    				$ttf = env('ROOT_PATH') . '/public/hgzb.ttf';
		    				//Log::record('文字水印开始','upload');
	        				if (file_exists($ttf)) {
	        					//Log::record('找到水印字体','upload');
	        					$size = $water['water_size'] ? $water['water_size'] : 30;
	        					$color = $water['water_color'] ?: '#000000';
	        					if (!preg_match('/^#[0-9a-fA-F]{6}$/', $color)) {
	        						$color = '#000000';
	        					}
	        					$transparency = intval((100 - $water['water_degree']) * (127/100));
	        					$color .= dechex($transparency);
	        					$image->open($imgresource)->text($water['water_text'], $ttf, $size, $color, $water['water_localtion'])->save($imgresource);
	        				}
		    			}else{
		    				$waterPath = env('ROOT_PATH') . $water['water_picture'];
	        				$quality = $water['water_quality'] ? $water['water_quality'] : 80;
	        				$waterTempPath = dirname($waterPath).'/temp_'.basename($waterPath);
	        				//Log::record('图片文件位置waterTempPath：'.$waterTempPath,'upload');
	        				$image->open($waterPath)->save($waterTempPath, null, $quality);
	        				$image->open($imgresource)->water($waterTempPath, $water['water_localtion'], $water['water_degree'])->save($imgresource);
	        				@unlink($waterTempPath);
		    			}
		    		}
		    	}
		    }
		    return json($data);
		}
		/**
		 * 图片删除
		 * @return [type] [description]
		 */
		public function delPicture(){
			if($this->request->isAjax()){
				$filename = env('ROOT_PATH') . input('post.filename');
				if(!empty($filename) && file_exists($filename)){
		            $size = getimagesize($filename);
		            $filetype = explode('/',$size['mime']);
		            if($filetype[0]!='image'){
		                return json(['code'=>101,'desc'=>'删除文件类型错误']);
		            }
		            if(unlink($filename)){
		            	return json(['code'=>0,'desc'=>'删除成功']);
		            }else{
		            	return json(['code'=>102,'desc'=>'删除失败']);
		            }  
		        }else{
		        	return json(['code'=>103,'desc'=>'要删除的图片文件不存在'.$filename]);
		        }
			}
		}
	}