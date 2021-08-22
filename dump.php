<?php
require 'ncm.php';
$start_time = time();
$dir = "./ncm/"; //原ncm文件所在文件夹
$done_dir = "./ncm_done/"; //dump后的ncm文件输出文件夹
$output_dir = "./output/"; //mp3/flac文件输出文件夹
$info = opendir($dir);
while (($filename = readdir($info)) !== false) {
  if($filename == "." || $filename == "..") continue;
  exec("echo 1 > /proc/sys/vm/drop_caches"); //清理内存缓存
  $tmpname = time().rand(1000,9999).".ncm"; //生成临时文件名防止乱码无法读取文件
  exec("mv '{$dir}{$filename}' '{$dir}{$tmpname}'"); //重命名
  $rt = NCM::dump($tmpname,true,$dir,$output_dir); //调用dump
  exec("mv '{$dir}{$tmpname}' '{$done_dir}{$filename}'"); //重命名回来
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