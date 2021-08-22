<?php
require 'ncm.php';
$start_time = time();
$input_dir = "./ncm/"; //原ncm文件所在文件夹
$done_dir = "./ncm_done/"; //dump后的ncm文件输出文件夹
$output_dir = "./output/"; //mp3/flac文件输出文件夹
if(!is_dir($input_dir)) { echo "Input_dir is not existing"; exit; }
if(!is_dir($done_dir)) mkdir($done_dir);
if(!is_dir($output_dir)) mkdir($output_dir);
$info = opendir($input_dir);
while (($filename = readdir($info)) !== false) {
  if($filename == "." || $filename == ".." || !stristr($filename,".ncm"))continue;
  exec("echo 1 > /proc/sys/vm/drop_caches"); //清理内存缓存
  $tmpname = time().rand(1000,9999).".ncm"; //生成临时文件名防止乱码无法读取文件
  exec("mv '{$input_dir}{$filename}' '{$input_dir}{$tmpname}'"); //重命名
  $rt = NCM::dump($tmpname,true,$input_dir,$output_dir); //调用dump
  exec("mv '{$input_dir}{$tmpname}' '{$done_dir}{$filename}'"); //重命名回来
  if($rt[0] === false) { exec("echo 1 > /proc/sys/vm/drop_caches"); die("Returned Error: {$rt[1]} \n"); } //判断是否存在报错
  $realname = str_replace(str_replace(".ncm",null,$tmpname),str_replace(".ncm",null,$filename),$rt[1]); //取得dump后真实文件名
  exec("mv '{$rt[1]}' '{$realname}'"); //重命名输出文件
  echo "{$realname} | Successfully dumped \n";
  exec("echo 1 > /proc/sys/vm/drop_caches"); //清理内存缓存
}
closedir($info);
$end_time = time();
$start_date = date("Y-m-d H:i:s",$start_time);
$end_date = date("Y-m-d H:i:s",$end_time);
$spent = $end_time - $start_time;
echo "Done. Spent time:$spent s ({$start_date} ~ {$end_date})\n";
?>