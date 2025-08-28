# NCM Dump
[[食用方法]](https://github.com/airline12138/ncmdump_php#食用方法)

   针对[原项目(ncmdump)](https://github.com/SomeBottle/ncm)进行了修改完善 在其原有代码基础上修复并增加了一些功能

## 增加的功能
   * [add] 批量Dump
   * [fix] 玄学报错(缺少ogg3库引入)
   * [fix] flac格式无法写入封面图片
   * [add] mp3,flac格式写入歌曲元数据(歌曲名,艺术家/音乐家,专辑名)
   * [优化] 返回机制从echo改为return,class类库中终于不再直接输出内容
   * [优化] 更新了getid3类库

## 更新日志
   * [fix] 批量dump报错无输入文件
   * [add] 判断输入文件夹是否存在 不存在则退出执行
   * [add] 判断输出文件夹是否存在 不存在则自动创建

## 需要的拓展/需要开启的函数/依赖软件
   * php_openssl (不是很清楚 应该是用于解密)
   * php_exif (操作图像文件)

   * shell_exec (getid3库操作metaflac)
   * exec (用于操作文件)
   * metaflac (用于写入flac格式元数据 在CLI安装 `yum install flac -y` / `apt install flac -y`)

## 原项目使用的Class
   * [getID3](https://github.com/JamesHeinrich/getID3)
   * [hex2str](https://www.cnblogs.com/wangluochong/p/11383000.html)
   * [xor](https://www.cnblogs.com/dannywang/p/5316768.html)

## 原项目参考的项目
   * [NCMdump-py](https://github.com/bolitao/ncm)  
   * [ncmdump-php](https://github.com/juzi5201314/ncmdump)

## 食用方法
   单文件dump `php ncm.php <filepath> <dealwithid3>`

   批量dump(文件夹内所有歌曲) `php dump.php` 需手动修改PHP文件中的`输入NCM路径,输出NCM路径,输出dump后文件路径`(懒得适配CLI)

   [保姆级使用教程](https://blog.qcmoe.com/program/ncmDump.html)

## 鸣谢
   * [@Jochen233](https://blog.qcmoe.com) 发现并报告了bug及README的描述错误, 给予了更新意见, 为程序撰写了保姆级使用教程
