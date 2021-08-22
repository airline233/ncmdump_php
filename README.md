# NCM Dump
   针对[原项目(ncmdump)](https://github.com/SomeBottle/ncm)进行了修改完善 在原有基础上加入了批量dump,写入了曲目名/艺术家/专辑名,修复了flac格式无法dump与flac格式写入metadata无效的问题

## 需要的拓展/需要开启的函数/依赖软件
   * php_openssl (不是很清楚 应该是用于解密)
   * php_exif (操作图像文件)

   * shell_exec (getid3库操作flacmeta)
   * exec (用于操作文件)
   * flacmeta (用于写入flac格式元数据 在CLI安装 `yum install flacmeta -y` / `apt install flacmeta -y`)

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