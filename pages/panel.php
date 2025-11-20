<?php
namespace SakuraPanel;

use SakuraPanel;

global $_config;

// 获取当前模块
$module = $_GET['module'] ?? "";

// 获取用户信息
$rs = Database::querySingleLine("users", ["username" => $_SESSION['user']]);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>管理面板 :: <?php echo $_config['sitename']; ?> - <?php echo $_config['description']; ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/panel/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/panel/dist/css/adminlte.min.css">
    <!-- 国内 Google Font 替代 -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/source-sans-pro/3.0.0/css/source-sans-pro.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="?page=panel&module=home" class="nav-link">主页</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?page=logout&csrf=<?php echo $_SESSION['token']; ?>" title="退出登录">
                        <i class="fas fa-sign-out-alt"></i> 登出
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="?page=panel&module=home" class="brand-link text-center">
                <span class="brand-text font-weight-light"><?php echo $_config['sitename']; ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img id="userAvatar" 
                             src="https://secure.gravatar.com/avatar/<?php echo md5($_SESSION['mail']); ?>?s=64" 
                             class="img-circle elevation-2" 
                             alt="<?php echo htmlspecialchars($_SESSION['user']); ?>"
                             title="点击刷新头像">
                    </div>
                    <div class="info">
                        <a href="?page=panel&module=profile" class="d-block">
                            <?php echo htmlspecialchars($_SESSION['user']); ?>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- 主要功能 -->
                        <li class="nav-item">
                            <a href="?page=panel&module=home" class="nav-link <?php echo $module == "home" || $module == "" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>管理面板</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=panel&module=profile" class="nav-link <?php echo $module == "profile" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>用户信息</p>
                            </a>
                        </li>

                        <!-- 内网穿透 -->
                        <li class="nav-header">内网穿透</li>
                        <li class="nav-item">
                            <a href="?page=panel&module=proxies" class="nav-link <?php echo $module == "proxies" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-list"></i>
                                <p>隧道列表</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=panel&module=addproxy" class="nav-link <?php echo $module == "addproxy" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>创建隧道</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=panel&module=sign" class="nav-link <?php echo $module == "sign" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-check-square"></i>
                                <p>每日签到</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=panel&module=download" class="nav-link <?php echo $module == "download" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-download"></i>
                                <p>软件下载</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=panel&module=configuration" class="nav-link <?php echo $module == "configuration" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>配置文件</p>
                            </a>
                        </li>

                        <?php if ($rs['group'] == "admin"): ?>
                        <!-- 管理员功能 -->
                        <li class="nav-header">管理员</li>
                        <li class="nav-item">
                            <a href="?page=panel&module=userlist" class="nav-link <?php echo $module == "userlist" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>用户管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=panel&module=nodes" class="nav-link <?php echo $module == "nodes" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-server"></i>
                                <p>节点管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=panel&module=traffic" class="nav-link <?php echo $module == "traffic" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-paper-plane"></i>
                                <p>流量统计</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=panel&module=settings" class="nav-link <?php echo $module == "settings" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p>站点设置</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <?php
            // 加载模块内容
            $page = new SakuraPanel\Pages();
            if (isset($_GET['module']) && preg_match("/^[A-Za-z0-9_\-]{1,16}$/", $_GET['module'])) {
                $page->loadModule($_GET['module']);
            } else {
                $page->loadModule("home");
            }
            ?>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer d-flex justify-content-between align-items-center">
            <div class="footer-left">
                &copy; 2019-<?php echo date("Y"); ?>
                <a href="https://SkytechStudio.top" target="_blank" rel="noopener noreferrer">
                    <?php echo $_config['sitename']; ?>
                </a>.
                All rights reserved.
            </div>
            <div class="footer-right">
                基于 ZeroDream-CN | SakuraPanel 二开
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="assets/panel/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/panel/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="assets/panel/dist/js/adminlte.js"></script>

    <script>
        // 随机头像 API
        const AVATAR_API = 'https://v2.xxapi.cn/api/head';

        // 获取随机头像
        function getRandomAvatar(callback) {
            $.ajax({
                url: AVATAR_API,
                type: 'GET',
                dataType: 'json',
                data: { return: 'json' },
                success: function(response) {
                    if (response.code === 200 && response.data) {
                        callback(response.data);
                    } else {
                        // 如果 API 返回失败，使用直接 302 方式
                        callback(AVATAR_API + '?t=' + Date.now());
                    }
                },
                error: function() {
                    // 如果请求失败，使用直接 302 方式
                    callback(AVATAR_API + '?t=' + Date.now());
                }
            });
        }

        // 更新头像
        function updateAvatar(avatarImg, showAnimation = true) {
            getRandomAvatar(function(avatarUrl) {
                if (showAnimation) {
                    avatarImg.fadeOut(300, function() {
                        $(this).attr('src', avatarUrl).fadeIn(300);
                    });
                } else {
                    avatarImg.css('opacity', '0.5');
                    avatarImg.attr('src', avatarUrl);
                    setTimeout(() => {
                        avatarImg.css('opacity', '1');
                    }, 300);
                }
            });
        }

        // 页面加载完成后更新头像
        $(document).ready(function() {
            const avatarImg = $('#userAvatar');
            
            // 延迟加载随机头像
            setTimeout(function() {
                updateAvatar(avatarImg, true);
            }, 500);

            // 点击头像刷新
            avatarImg.on('click', function() {
                updateAvatar($(this), false);
            });
        });
    </script>

    <style>
        /* 蓝白配色方案 */
        :root {
            --primary-blue: #1e88e5;
            --light-blue: #42a5f5;
            --dark-blue: #1565c0;
            --sky-blue: #4fc3f7;
            --pure-white: #ffffff;
            --light-gray: #f5f7fa;
            --border-gray: #e3e8ef;
        }

        body {
            background: var(--light-gray);
        }

        /* 顶部导航栏 - 蓝白风格 */
        .main-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%) !important;
            border-bottom: none !important;
            box-shadow: 0 2px 15px rgba(30, 136, 229, 0.2);
            position: relative;
        }

        .main-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--sky-blue), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        .main-header .navbar-nav .nav-link {
            color: var(--pure-white) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .main-header .navbar-nav .nav-link:hover {
            color: var(--pure-white) !important;
            transform: translateY(-2px);
            text-shadow: 0 2px 8px rgba(255, 255, 255, 0.3);
        }

        .main-header .navbar-nav .nav-link i {
            transition: transform 0.3s ease;
        }

        .main-header .navbar-nav .nav-link:hover i {
            transform: scale(1.1);
        }

        /* 侧边栏 - 白色简洁风 */
        .main-sidebar {
            background: var(--pure-white) !important;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.08);
            border-right: 1px solid var(--border-gray);
        }

        /* Logo 区域 - 蓝色渐变 */
        .brand-link {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%) !important;
            border-bottom: none !important;
            padding: 1.2rem !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .brand-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .brand-link:hover::before {
            opacity: 1;
        }

        .brand-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.3);
        }

        .brand-text {
            font-size: 1.3rem !important;
            font-weight: 700 !important;
            letter-spacing: 1px;
            color: var(--pure-white) !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* 用户面板 - 清爽风格 */
        .user-panel {
            border-bottom: 1px solid var(--border-gray);
            position: relative;
            padding: 15px 10px !important;
        }

        .user-panel .image img {
            border: 3px solid var(--primary-blue);
            box-shadow: 0 4px 12px rgba(30, 136, 229, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-panel .image img:hover {
            border-color: var(--light-blue);
            box-shadow: 0 6px 20px rgba(30, 136, 229, 0.4);
            transform: scale(1.05) rotate(5deg);
        }

        .user-panel .image img:active {
            transform: scale(0.95);
        }

        .user-panel .info a {
            color: var(--dark-blue) !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .user-panel .info a:hover {
            color: var(--primary-blue) !important;
            padding-left: 5px;
        }

        /* 导航标题 - 简洁风格 */
        .nav-header {
            color: #8b95a5 !important;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1.5px;
            margin-top: 1rem;
            position: relative;
            padding-left: 20px;
        }

        .nav-header::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 4px;
            background: var(--primary-blue);
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(30, 136, 229, 0.5);
        }

        /* 导航菜单 - 蓝白按钮 */
        .nav-sidebar .nav-link {
            border-radius: 10px;
            margin: 3px 10px;
            transition: all 0.3s ease;
            color: #5a6c7d !important;
            position: relative;
        }

        .nav-sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0;
            background: var(--primary-blue);
            border-radius: 10px 0 0 10px;
            transition: width 0.3s ease;
        }

        .nav-sidebar .nav-link:hover {
            background: rgba(30, 136, 229, 0.08) !important;
            color: var(--primary-blue) !important;
            transform: translateX(5px);
        }

        .nav-sidebar .nav-link:hover::before {
            width: 4px;
        }

        .nav-sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue)) !important;
            color: var(--pure-white) !important;
            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.3);
        }

        .nav-sidebar .nav-link.active::before {
            width: 0;
        }

        .nav-sidebar .nav-link .nav-icon {
            margin-right: 12px;
            transition: all 0.3s ease;
        }

        .nav-sidebar .nav-link:hover .nav-icon {
            transform: scale(1.15);
        }

        .nav-sidebar .nav-link.active .nav-icon {
            transform: scale(1.1);
        }

        /* 内容区域 - 浅色背景 */
        .content-wrapper {
            background: var(--light-gray);
            min-height: calc(100vh - 57px - 57px);
            position: relative;
        }

        /* 页脚 - 清爽风格 */
        .main-footer {
            background: var(--pure-white);
            border-top: 1px solid var(--border-gray);
            padding: 15px 20px;
            font-size: 14px;
            color: #5a6c7d;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.03);
        }

        .main-footer a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .main-footer a:hover {
            color: var(--dark-blue);
            transform: translateY(-1px);
        }

        /* 滚动条 - 简洁风格 */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--light-gray);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary-blue);
            border-radius: 3px;
            transition: background 0.3s ease;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--dark-blue);
        }

        /* 响应式优化 */
        @media (max-width: 768px) {
            .main-footer {
                flex-direction: column;
                text-align: center;
                padding: 12px 15px;
            }

            .footer-right {
                margin-top: 8px;
            }

            .brand-text {
                font-size: 1rem !important;
                letter-spacing: 2px;
            }
        }

        /* 加载动画 - 平滑淡入 */
        @keyframes fadeInSmooth {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-item {
            animation: fadeInSmooth 0.5s ease-out;
        }

        .nav-item:nth-child(1) { animation-delay: 0.05s; }
        .nav-item:nth-child(2) { animation-delay: 0.1s; }
        .nav-item:nth-child(3) { animation-delay: 0.15s; }
        .nav-item:nth-child(4) { animation-delay: 0.2s; }
        .nav-item:nth-child(5) { animation-delay: 0.25s; }
        .nav-item:nth-child(6) { animation-delay: 0.3s; }
        .nav-item:nth-child(7) { animation-delay: 0.35s; }
        .nav-item:nth-child(8) { animation-delay: 0.4s; }
        .nav-item:nth-child(9) { animation-delay: 0.45s; }
        .nav-item:nth-child(10) { animation-delay: 0.5s; }
    </style>
</body>

</html>
