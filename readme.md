![AD-WALL](public/image/ad_wall_logo_300_300.jpg)
##AD-WALL是什么?
广告墙，一个周边商铺广告的推送平台

当前很多商铺的优惠信息、热卖产品、上架新品很难快速被很多人知晓， 通过该平台，商铺的活动会很快得到传播，使用户在无意间得到消息从而形成消费行为。

##AD-WAL有哪些功能？

* WEB端
    *  商家注册、登录、上传广告
    *  管理员登录、审核广告
    *  服务器后台
* APP（不在这里实现）
    * 获取广告信息
    * 获取商家信息
    * 定位导航

##使用说明
* 配置 Nginx+MySQL+PHP5+Laravel 5.0 开发环境
* Nginx 网站根目录配置为 ad-wall/public
* 数据库配置
    * 按实际需要修改 ad-wall/.env 文件以下各项，并且在 MySQL 上建立对应的数据库 
            DB_HOST=localhost
            DB_DATABASE=ad_wall
            DB_USERNAME=root
            DB_PASSWORD=
    * 在 ad-wall/ 目录执行以下命令执行数据库迁移操作： php artisan migrate
* 添加管理员
    * 修改文件 ad-wall/app/Services/Registrar.php，把 create 函数中用户类型 type 改为0
    * 访问网站，新注册的用户即拥有管理员权限
    * 关闭管理员注册功能，即撤销 Registrar.php 文件的修改
* 访问网站，进行正常用户注册、登录、上传广告操作以及管理员审核操作

##问题反馈
在使用中有任何问题，欢迎反馈给我，可以用以下联系方式跟我交流

* 邮件(1103530380@qq.com)
* 微博: [@MarshalRUAN](http://weibo.com/u/2949154057)

##感激
感谢以下的项目,排名不分先后

* [Laravel](http://laravel.com/) 
* [jquery](http://jquery.com)
