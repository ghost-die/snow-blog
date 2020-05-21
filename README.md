# Snow Blog



## 简介

使用laravel 7.0开发的一款blog 主要是因为在csdn不方便 偶然登陆不了，所以自己抽空写了一个blog。目前只有基础功能 其他功能在后续再慢慢添加！主要用来记录工作中遇到的一些问题以及解决的思路。



## 说明

此blog将在后续整合完成后开源。



## 链接

- Blog : https://www.ghost-ai.com
- GitHub : https://github.com/Ghost-die
- Gitee : https://gitee.com/GhostAi



## 安装

1. 通过git 获取源码

```bash
git clone git@git.ghost-ai.com:root/note.git
```

2. 进入项目目录后，用```compose``` 安装依赖

```bash
cd note && compose install
```

3. 生成```.env``` 文件

```bash
cp .env.example .env
```

4. 生成key

```bash
php artisan key:generate
```

5. 创建MySql数据库 ```note``` ,字符集采用```utf8mb4``` ,```utf8mb4_general_cl```  

   编辑```.env```  ,修改MySql数据库配置

```php
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=note
DB_USERNAME=root
DB_PASSWORD=root
```

6. 数据库迁移&数据库填充

```bash
php artisan migrate
php artisan db:seed
```

7. 创建storage软连接

```bash
php artisan storage:link
```

8. 使用Nginx 配置

```shell
server {
    listen 80 default_server;
    listen [::]:80 default_server ipv6only=on;
    # For https
    # listen 443 ssl default_server;
    # listen [::]:443 ssl default_server ipv6only=on;
    # ssl_certificate /etc/nginx/ssl/default.crt;
    # ssl_certificate_key /etc/nginx/ssl/default.key;
    server_name localhost;
    root /var/www/note/public;
    index index.php index.html index.htm;
    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }
    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_pass php-upstream;
        fastcgi_index index.php;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fixes timeouts
        fastcgi_read_timeout 600;
        include fastcgi_params;
    }
    location ~ /\.ht {
        deny all;
    }
    location /.well-known/acme-challenge/ {
        root /var/www/letsencrypt/;
        log_not_found off;
    }
}
```



## 联系

E-mail : ghost@ghost-ai.com



## License

- ```MIT License``` 

