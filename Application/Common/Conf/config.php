<?php

return array(

	//'配置�?=>'配置�?

    // 添加数据库配置信�?

    'DB_TYPE' => 'mysql', // 数据库类�?

    'DB_HOST' => 'localhost', // 服务器地址

    'DB_NAME' => 'zliang', // 数据库名

    'DB_USER' => 'root', // 用户�?

    'DB_PWD' => 'Aiboms_1314', // 密码

    'DB_PORT' => 3306, // 端口

    'DB_CHARSET' => 'utf8', // 字符�?

    'DB_DEBUG' => TRUE,



    'DB_PREFIX' =>'zl_',//数据表的前缀


    'DATA_CACHE_TYPE' => 'Memcache',

    'MEMCACHED_HOST' => '127.0.0.1',

    'MEMCACHED_PORT' => '11211',



    // 子域名配�?

    'APP_SUB_DOMAIN_DEPLOY'   =>    1,

    'APP_SUB_DOMAIN_RULES'    =>    array(

        'admin.aiboms.cn'  => 'Admin',  // admin.aiboms.com域名指向Admin模块

        'blog.aiboms.cn'   => 'Home',  // blog.aiboms.com域名指向Test模块

    ),



);

        

        

        

        