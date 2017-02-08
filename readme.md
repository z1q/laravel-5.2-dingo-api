# Laravel PHP Framework
目前还有一个问题是apache2.4.23环境下可以正常访问,nginx1.8.0下则不行





#Api说明
/*
两种注册方式,ruser是用户名注册,rphone是手机号注册
*/
url:/api/reg

json:{
type:ruser/rphone
rusername:
rphonenum:
rpassword:
}
登录/api/login

找回/api/forget

验证/api/verif

## 数据结构
/*
待完善
*/

user:myfollow/我关注的
     praise总赞
     logdays打卡
     status状态


goal:user/用户
     tag/标签
     category/类别
     starttime/开始时间
     endtime/结束时间
     days/天数
     private/私密
     reason/原因
     degree/难度
     complete/完成
     stepnum/步骤数
     estimate/每天评估

step:starttime     
     endtime
     reason
     degree







---------------------------------------------------------------
Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
