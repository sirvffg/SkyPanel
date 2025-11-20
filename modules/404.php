<?php
$page_title = "404 Not Found";
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="color:#1e6fff;"><?php echo $page_title; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="?">主页</a>
                    </li>
                    <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="error-page" style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:60vh;">
        <h2 class="headline" style="font-size:120px;font-weight:bold;color:#1e6fff;">404</h2>
        <div class="error-content" style="text-align:center;">
            <h3 style="font-size:28px;color:#555;">
                <i class="fas fa-exclamation-triangle" style="color:#ffb400;margin-right:8px;"></i>
                页面未找到
            </h3>
            <p style="font-size:16px;color:#666;line-height:1.6;">
                抱歉，我们无法找到您请求的页面或文件。<br>
                您可以尝试 <a href="?page=panel&module=home" style="color:#1e6fff;text-decoration:underline;">返回首页</a> 或返回上一页。
            </p>
            <a href="?page=panel&module=home" class="btn btn-primary" style="margin-top:20px;background:linear-gradient(135deg,#1e6fff,#4da1ff);border:none;box-shadow:0 6px 20px rgba(30,111,255,0.4);transition:all 0.3s;">返回首页</a>
        </div>
    </div>
</section>

<style>
    /* 小屏幕自适应 */
    @media (max-width:768px){
        .headline { font-size:80px !important; }
        .error-content h3 { font-size:22px !important; }
    }
    /* 按钮悬停效果 */
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow:0 8px 24px rgba(30,111,255,0.5);
    }
</style>
