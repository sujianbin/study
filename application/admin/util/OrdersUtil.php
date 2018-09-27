<?php
	namespace app\admin\util;
	use PHPExcel_IOFactory;
	use PHPExcel;
	use think\Db;

	class OrdersUtil
	{
		/**
		 * 订单导出
		 * @param  [type] $data [description]
		 * @return [type]       [description]
		 */
		public function export($data)
		{
			$PHPExcel = new PHPExcel();
			$PHPExcel->getProperties();

			$PHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID号');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('B1','订单编号');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('C1','会员名称');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('D1','订单金额');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('E1','支付金额');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('F1','支付方式');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('G1','下单时间');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('H1','支付时间');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('I1','付款状态');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('J1','订单状态');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('K1','发票信息');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('L1','收获地址');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('M1','资料提供');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('N1','续费提醒');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('O1','商品详情');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('P1','商品名称');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('Q1','单价');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('R1','数量');
			$PHPExcel->setActiveSheetIndex(0)->setCellValue('S1','合计');

			$PHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(10);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(20);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(15);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(10);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(10);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(18);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(25);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(25);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(18);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('J')->setWidth(18);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('K')->setWidth(40);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('L')->setWidth(40);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('M')->setWidth(10);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('N')->setWidth(10);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('O')->setWidth(20);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('P')->setWidth(20);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setWidth(20);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('R')->setWidth(20);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('S')->setWidth(20);

			$column = 2;

		    $objActSheet = $PHPExcel->getActiveSheet();

		    $objActSheet->getDefaultRowDimension()->setRowHeight(25);

			$objActSheet->getRowDimension(1)->setRowHeight(30);

			$first = 1;
			
			foreach ($data as $k=>$v){

				$first++;

				$span = ord("A");
			
				$objActSheet->setCellValue(chr($span).$column,$v['id'],\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;
				
				$objActSheet->setCellValue(chr($span).$column,$v['out_trade_no'],\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;
				
				$objActSheet->setCellValue(chr($span).$column,filter_emoji($v['realname']),\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;
				
				$objActSheet->setCellValue(chr($span).$column,$v['true_money'],\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;
				
				$objActSheet->setCellValue(chr($span).$column,tag_show($v['pay_money']),\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;

				$objActSheet->setCellValue(chr($span).$column,pay_type_show($v['is_pay'],$v['pay_type']),\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;

				$objActSheet->setCellValue(chr($span).$column,date('Y-m-d H:i:s',$v['create_time']),\PHPExcel_Cell_DataType::TYPE_STRING);//下单时间
				$span++;

				$objActSheet->setCellValue(chr($span).$column,$v['pay_time'] ? date('Y-m-d H:i:s',$v['pay_time']) : '--',\PHPExcel_Cell_DataType::TYPE_STRING);//支付时间
				$span++;

				$objActSheet->setCellValue(chr($span).$column,$v['is_pay'] == 1 ? '是': '--',\PHPExcel_Cell_DataType::TYPE_STRING);//付款状态
				$span++;

				$objActSheet->setCellValue(chr($span).$column,order_status($v['is_pay'],$v['status'],false),\PHPExcel_Cell_DataType::TYPE_STRING);//订单状态
				$span++;

				$objActSheet->setCellValue(chr($span).$column,invoice_show($v['is_invoice'],$v['invoice_header'],$v['invoice_meg']),\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;

				$objActSheet->setCellValue(chr($span).$column,address_show($v['m_name'],$v['m_phone'],$v['m_address'],$v['m_address_info']),\PHPExcel_Cell_DataType::TYPE_STRING);
				$span++;

				$objActSheet->setCellValue(chr($span).$column,$v['is_info'] == 1 ? '是': '--',\PHPExcel_Cell_DataType::TYPE_STRING);//付款状态
				$span++;

				$objActSheet->setCellValue(chr($span).$column,$v['is_notice'] == 1 ? '是': '--',\PHPExcel_Cell_DataType::TYPE_STRING);//付款状态
				$span++;

				$objActSheet->setCellValue(chr($span).$column,'商品详情',\PHPExcel_Cell_DataType::TYPE_STRING);//付款状态
				$span++;
				
				//$column = $first + 1;

				$info = Db::name('orders_info')->field('goods_name,goods_price,goods_num')->where('orders_id',$v['id'])->select();
				$counts = count($info);
				$last = $first+$counts-1;
				if(is_array($info)){
					$k = ord("P");
					$columns = $first;
					foreach($info as $k1=>$v1){
						$objActSheet->getRowDimension($columns)->setRowHeight(20);
						if($k == ord('T')){
							$k = ord('P');
						}
						$objActSheet->setCellValue(chr($k).$columns,$v1['goods_name'],\PHPExcel_Cell_DataType::TYPE_STRING);
						$k++;

						$objActSheet->setCellValue(chr($k).$columns,$v1['goods_price'],\PHPExcel_Cell_DataType::TYPE_STRING);
						$k++;

						$objActSheet->setCellValue(chr($k).$columns,$v1['goods_num'],\PHPExcel_Cell_DataType::TYPE_STRING);
						$k++;

						$objActSheet->setCellValue(chr($k).$columns,'￥'.round($v1['goods_num']*$v1['goods_price'],2),\PHPExcel_Cell_DataType::TYPE_STRING);
						$k++;

						$columns++;
					}
				}
				$PHPExcel->getActiveSheet()->mergeCells('A'.$first.':A'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('B'.$first.':B'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('C'.$first.':C'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('D'.$first.':D'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('E'.$first.':E'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('F'.$first.':F'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('G'.$first.':G'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('H'.$first.':H'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('I'.$first.':I'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('J'.$first.':J'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('K'.$first.':K'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('L'.$first.':L'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('M'.$first.':M'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('N'.$first.':N'.$last);

				$PHPExcel->getActiveSheet()->mergeCells('O'.$first.':O'.$last);

				$first = $last;

				$column = $last+1;
			}

			$date = date('Y-m-d-H-i',time());
			$fileName="订单数据-{$date}.xls";
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
	}