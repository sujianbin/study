<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 标签显示
 * @param  [type] $value [description]
 * @param  string $data  [description]
 * @return [type]        [description]
 */
function tag_show($value,$data = '')
{
    if(is_array($data)){
        return empty($value) ? $data[0] : $data[1];
    }else if(is_string($data) && !empty($data)){
        return empty($value) ? $data : $value;
    }else if(empty($data)){
        return empty($value) ? '--' : $value;
    }
}
/**
 *计算UTF8字符占用空间的长度用于准确截取字符串
 *@param string $str 要截取的字符串
 *@return int 个数
 */
function utf8_strlen($str) 
{
    $ch_amont = 0;
    $en_amont = 0;
    $str = preg_replace("/(　| ){1,}/", " ", $str);
    for ($i = 0; $i < strlen($str); $i++) {
        $ord = ord($str{$i});
        if ($ord > 128)
            $ch_amont++;
        else
            $en_amont++;
    }
    return round($ch_amont / 3 * 2) + $en_amont * 2;
}
/**
 *@param string $string需要处理的字符串
 *@param string $length需要截取的长度
 *@param string $dot字符串尾部处理(默认为...)
*/
function cut($string,$length,$dot='...')
{
  	//函数剥去字符串中的 HTML、XML 以及 PHP 的标签。
  	$string = strip_tags($string);
  	//替换标签
    $string = str_replace(array('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;'), array(' ', '&', '"', "'", '“', '”', '—', '<', '>'), $string);
    //计算原有字符串长度
    $strlen = utf8_strlen($string);
    if ($strlen <= $length)
        return $string;
    $strcut = '';
    $n = $tn = $noc = 0;
    //ASCII值为8、9、10 和13 分别转换为退格、制表、换行和回车字符。
    //32～126(共95个)是字符(32是空格），其中48～57为0到9十个阿拉伯数字。65～90为26个大写英文字母，97～122号为26个小写英文字母，其余为一些标点符号、运算符号等。
    while ($n < $strlen) {
        $t = ord($string[$n]);//获取首字母的ASCII值
        if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
            $tn = 1;
            $n++;
            $noc++;
        } elseif (194 <= $t && $t <= 223) {
            $tn = 2;
            $n += 2;
            $noc += 2;
        } elseif (224 <= $t && $t < 239) {
            $tn = 3;
            $n += 3;
            $noc += 2;
        } elseif (240 <= $t && $t <= 247) {
            $tn = 4;
            $n += 4;
            $noc += 2;
        } elseif (248 <= $t && $t <= 251) {
            $tn = 5;
            $n += 5;
            $noc += 2;
        } elseif ($t == 252 || $t == 253) {
            $tn = 6;
            $n += 6;
            $noc += 2;
        } else {
            $n++;
        }
        if ($noc >= $length)
            break;
    }
    if ($noc > $length)
        $n -= $tn;
    $strcut = substr($string, 0, $n);
    $strcut = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&#039;', '&lt;', '&gt;'), $strcut);
    return $strcut . $dot;
}
/**
 * 获取中文字符拼音首字母
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
function get_first_charter($str)
{
    if(empty($str)){
        return '';          
    }
    $fchar=ord($str{0});
    if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
    $s1=iconv('UTF-8','gb2312',$str);
    $s2=iconv('gb2312','UTF-8',$s1);
    $s=$s2==$str?$s1:$str;
    $asc=ord($s{0})*256+ord($s{1})-65536;
    if($asc>=-20319&&$asc<=-20284) return 'A';
    if($asc>=-20283&&$asc<=-19776) return 'B';
    if($asc>=-19775&&$asc<=-19219) return 'C';
    if($asc>=-19218&&$asc<=-18711) return 'D';
    if($asc>=-18710&&$asc<=-18527) return 'E';
    if($asc>=-18526&&$asc<=-18240) return 'F';
    if($asc>=-18239&&$asc<=-17923) return 'G';
    if($asc>=-17922&&$asc<=-17418) return 'H';
    if($asc>=-17417&&$asc<=-16475) return 'J';
    if($asc>=-16474&&$asc<=-16213) return 'K';
    if($asc>=-16212&&$asc<=-15641) return 'L';
    if($asc>=-15640&&$asc<=-15166) return 'M';
    if($asc>=-15165&&$asc<=-14923) return 'N';
    if($asc>=-14922&&$asc<=-14915) return 'O';
    if($asc>=-14914&&$asc<=-14631) return 'P';
    if($asc>=-14630&&$asc<=-14150) return 'Q';
    if($asc>=-14149&&$asc<=-14091) return 'R';
    if($asc>=-14090&&$asc<=-13319) return 'S';
    if($asc>=-13318&&$asc<=-12839) return 'T';
    if($asc>=-12838&&$asc<=-12557) return 'W';
    if($asc>=-12556&&$asc<=-11848) return 'X';
    if($asc>=-11847&&$asc<=-11056) return 'Y';
    if($asc>=-11055&&$asc<=-10247) return 'Z';
    return null;
}
/**
 * 查询设置缓存
 * @param  string $key  [description]
 * @param  array  $data [description]
 * @return [type]       [description]
 */
function config_cache($key = 'config.config',$data = null)
{
    if(is_array($data)){
        $type = $data['type'];
        unset($data['type']);
        $model = Db::name('config')->where('type',$type)->column('value','name');
        if(is_array($model)){
            foreach ($data as $k=>$v){
                $newData = ['name'=>$k,'value'=>$v,'type'=>$type];
                if(!isset($model[$k])){
                    Db::name('config')->data($newData)->insert();
                }else{
                    if($mdoel[$k] != $v){
                        Db::name('config')->where('name',$k)->data($newData)->update();
                    }
                }
            }
        }else{
            foreach ($data as $k=>$v){
                $newData[] = ['name'=>$k,'value'=>$v,'type'=>$type];
            }
            Db::name('config')->insertAll($newData);
        }
        $results = Db::name('config')->where('type',$type)->column('value','name');
        cache('config.'.$type,$results);
    }else{
        //config.config  网站基本设置
        //config.water   水印设置
        //config.smtp    邮件设置
        //config.sms     短信设置
        //config.config.phone   获取基本设置中某项值
        $key = $key ? $key : 'config.config';
        $cacheTag = $key;
        $param = explode('.',$key);
        if(count($param) >= 2) $cacheTag = $param[0].'.'.$param[1];
        if(!cache($cacheTag)){
            $results = Db::name('config')->where('type',$param[1])->column('value','name');
            cache($cacheTag,$results);
        }
        if(isset($param[2])){
            $cache = cache($cacheTag);
            return $cache[$param[2]];
        }else{
            return cache($cacheTag);
        }
    }
}
/**
 * 发送邮件
 * @param  [type] $to      [description]
 * @param  string $subject [description]
 * @param  string $content [description]
 * @return [type]          [description]
 */
function send_email($to,$subject = '',$content = '')
{
    $PHPMailerUtil = new app\common\util\PHPMailerUtil;
    return $PHPMailerUtil->sendEmail($to,$subject,$content);
}
/**
 * [date_show description]
 * @param  [type] $date   [description]
 * @param  [type] $format [description]
 * @param  [type] $time   [description]
 * @return [type]         [description]
 */
function date_show($date,$format,$time = 0)
{
    if(empty($date)){
        return date($format,time()+$time);
    }else{
        return date($format,$date);
    }
}
/**
 * 去除表情标签
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
function filter_emoji($str)
{
    $str = preg_replace_callback(
    '/./u',
        function (array $match) {
            return strlen($match[0]) >= 4 ? '' : $match[0];
        },
    $str);
    return $str;
}
/**
 * 订单状态
 * @param  [type] $is_pay [description]
 * @param  [type] $status [description]
 * @return [type]         [description]
 */
function order_status($is_pay,$status,$html = true)
{
    if($html === true){
        if($status == 1){
            if($is_pay == 0){
                return '<span style="color:#fabc43">未付款</span>';
            }else{
                return '<span style="color:#ff4933">已付款</span>';
            }
        }else if($status == 2){
            return '<span style="color:#ff4933">服务中</span>';
        }else if($status == 3){
            return '<span style="color:green">已完成</span>';
        }else{
            return '<span style="color:#fabc43">未付款</span>';
        }
    }else{
        if($status == 1){
            if($is_pay == 0){
                return '未付款';
            }else{
                return '已付款';
            }
        }else if($status == 2){
            return '服务中';
        }else if($status == 3){
            return '已完成';
        }else{
            return '未付款';
        }
    }
}