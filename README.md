# SkyPanel
基于[ZeroDream-CN/SakuraPanel](https://github.com/ZeroDream-CN/SakuraPanel)二开 
## 功能和特性
- 支持多用户
- 支持用户组配置
- 支持每个用户单独限速
- 支持每个用户单独限制流量
- 可配置签到获得流量
- 可配置凭邀请码注册账号
- 实时流量统计
- 美观的界面

## 安装和配置
首先将项目 clone 到本地
```
git clone https://github.com/sirvffg/SkyPanel/
```
接着移动到网站目录，并设置权限
```
mv SakuraPanel/* /data/wwwroot/my.panel.com/
chown -R www:www /data/wwwroot/my.panel.com/
```
然后进入到网站目录，分别编辑以下三个文件，修改数据库信息

| 文件名 | 作用 |
| ------ | ------ |
| __/configuration.php__ | 网站核心配置文件，里面每个配置项都有介绍 |
| __/api/index.php__ | 用于对接 Frps，里面只需配置 Token |
| __/daemon.php__ | 服务器守护进程，需要在命令行下运行，里面只需要配置数据库 |

配置完成后，使用 Navicat、phpMyAdmin 等数据库管理软件创建一个数据库，然后导入 `import.sql`。

数据库编码类型：utf8mb4 / utf8mb4_unicode_ci；数据库引擎：InnoDB

导入完成后，打开网站，注册一个新账号，然后在数据库中设置这个账号的 __group__ 字段为 `admin` 即可设置为管理员。

## 配套 Frps 服务端
本面板需要专用 Frps 才能兼容，请访问[另一个项目](https://github.com/sirvffg/SkyFrp)

请按照另一个项目的介绍在每个服务器节点上进行配置。
