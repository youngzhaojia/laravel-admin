# My Laravel Admin Template

基于 Laravel 5.4 开发的一套后台管理系统, 用于个人以及公司项目快速开发的基础项目

## 说明
* PHP 7 + Laravel 5.4
* AdminLTE 后台模版
* 前后台用户分表 (users , admins) 分别登录
* 前后端分离,数据处理均在 `Controller/Api`
* `juicer`与blade模板引擎冲突, 后使用 `art-template`
* 自带的gate来做权限认证 (抄的 `laravel-admin`), 并生成菜单
* 使用`Repository`模式实现业务逻辑与数据访问的分离

#### 本项目也可以用于laravel初学者学习

## 截图

![laravel-admin](http://github.com/youngzhaojia/laravel-admin/raw/master/public/images/page.gif)

## 安装
- git clone 到本地
- 执行 `composer install`,创建好数据库
- 配置 `.env` 中数据库连接信息,没有.env请复制.env.example命名为.env
- 执行 `php artisan key:generate`
- 执行 `php artisan migrate`
- 执行 `php artisan db:seed`
- 执行 `cd public`
- 执行 `bower init`
- 键入 '域名/admin/login'(后台登录)
- 默认后台账号:admin 密码:admin