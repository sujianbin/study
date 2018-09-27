<?php
	namespace app\admin\util;
	use PHPExcel_IOFactory;
	use PHPExcel;

	class MemberUtil
	{
		/**
		 * 会员导出
		 * @param  [type] $data [description]
		 * @return [type]       [description]
		 */
		public function export($data)
		{
			$PHPExcel = new PHPExcel();
			$PHPExcel->getProperties();

			$PHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID号');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('B1','会员名称');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('C1','会员昵称');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('D1','手机号码');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('E1','注册时间');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('F1','会员余额');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('G1','累计充值');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('H1','累计消费');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('I1','上级');

			$PHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(10);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(20);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(20);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(20);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(25);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(15);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(15);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(15);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(15);
			
			$column = 2;

		    $objActSheet = $PHPExcel->getActiveSheet();

		    $objActSheet->getDefaultRowDimension()->setRowHeight(25);

			$objActSheet->getRowDimension(1)->setRowHeight(30);

			$first = 1;
			
			foreach ($data as $key=>$v){

				$first++;

				$span = ord("A");
			
				$objActSheet->setCellValue(chr($span).$column,$v['id'],\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;
				
				$objActSheet->setCellValue(chr($span).$column,filter_emoji($v['realname']),\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;
				
				$objActSheet->setCellValue(chr($span).$column,filter_emoji($v['realname']),\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;
				
				$objActSheet->setCellValue(chr($span).$column,tag_show($v['phone']),\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;
				
				$objActSheet->setCellValue(chr($span).$column,date('Y-m-d H:i:s',$v['create_time']),\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;

				$objActSheet->setCellValue(chr($span).$column,$v['balance'],\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;

				$objActSheet->setCellValue(chr($span).$column,$v['recharge'],\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;

				$objActSheet->setCellValue(chr($span).$column,$v['money'],\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;

				$objActSheet->setCellValue(chr($span).$column,$v['invite_id'] ? $v['invite_name'].'【'.$v['invite_id'].'】' : '--',\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;
				
				$column = $first + 1;

			}

			$date = date('Y-m-d-H-i',time());
			$fileName="会员数据-{$date}.xls";
			//重命名表
			$PHPExcel->getDefaultStyle()->getFont()->setName('宋体');
			$PHPExcel->getDefaultStyle()->getFont()->setSize(10);
			$PHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true); 
			$PHPExcel->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$PHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
			
			$PHPExcel->getActiveSheet()->setTitle('Sheet1');
			//设置活动单指数到第一个表,所以Excel打开这是第一个表
			$PHPExcel->setActiveSheetIndex(0);
			//将输出重定向到一个客户端web浏览器(Excel2007)
			ob_end_clean();//缓存区，保证不乱码
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Type: application/vnd.ms-excel');
			header("Content-Disposition: attachment; filename=\"$fileName\"");
			header('Cache-Control: max-age=0');
			$objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;
		}
		/**
		 * 会员导入
		 * @param  [type]  $file  [description]
		 * @param  integer $start [description]
		 * @return [type]         [description]
		 */
		public function import($file = null,$start = 0)
		{

		}
	}