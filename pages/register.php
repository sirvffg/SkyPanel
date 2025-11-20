<?php
global $_config;
if(!$_config['register']['enable']) {
    exit("<script>location='?page=login';</script>");
}
?>
<!DOCTYPE HTML>
<html lang="zh_CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="msapplication-TileColor" content="#F1F1F1">

    <!-- Bootstrap 5 CSS 国内源 -->
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery 国内源 -->
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Bootstrap 5 JS (bundle含Popper) 国内源 -->
    <script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>

    <!-- reCAPTCHA (可选) -->
    <?php if($_config['recaptcha']['enable']) {
        echo '<script src="https://www.recaptcha.net/recaptcha/api.js?render=' . $_config['recaptcha']['sitekey'] . '" defer></script>';
    } ?>

    <title>注册 :: <?php echo $_config['sitename']; ?> - <?php echo $_config['description']; ?></title>

    <style type="text/css">
        /* 全局样式 */
        body {
            margin:0;
            font-family:"Microsoft YaHei","PingFang SC",sans-serif;
            background:#f5f7fa;
            color:#222;
            overflow-x:hidden;
        }

        /* 背景装饰 */
        body:before{
            content:"";
            display:block;
            position:fixed;
            left:0; top:0;
            width:100%; height:100%;
            z-index:-10;
            background-color:#f5f7fa;
        }

        /* 主容器 */
        .main-box{
            width:100%;
            max-width:480px;
            margin:40px auto 80px auto;
            padding:30px;
            background:rgba(255,255,255,0.95);
            border-radius:12px;
            box-shadow:0 8px 24px rgba(0,0,0,0.15);
        }

        .logo{
            font-weight:700;
            font-size:32px;
            text-align:center;
            margin-bottom:10px;
            color:#1e6fff;
        }

        .description{
            text-align:center;
            margin-bottom:20px;
            font-size:16px;
            color:#555;
        }

        hr{
            margin:20px 0;
        }

        .full-width{width:100%;}
        .btn-primary{
            background: linear-gradient(135deg,#1e6fff,#4da1ff);
            border:none;
            padding:12px 0;
            font-size:18px;
            border-radius:8px;
            box-shadow:0 6px 16px rgba(30,111,255,0.3);
            transition: all 0.3s;
        }
        .btn-primary:hover{
            transform: translateY(-2px);
            box-shadow:0 8px 24px rgba(30,111,255,0.5);
        }

        /* 版权 */
        footer{
            text-align:center;
            font-size:14px;
            color:#555;
            margin-top:40px;
            line-height:1.6;
        }

        /* 响应式 */
        @media (max-width:768px){
            .main-box{
                margin:20px;
                padding:20px;
            }
        }
    </style>
</head>
<body>

<div class="main-box">
    <div class="logo"><?php echo $_config['sitename']; ?></div>
    <div class="description"><?php echo $_config['description']; ?></div>
    <form method="POST" action="?action=register&page=register">
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
        
        <div class="mb-3">
            <label for="username" class="form-label"><b>账号</b></label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><b>邮箱</b></label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <?php if($_config['smtp']['enable']): ?>
        <div class="mb-3">
            <label for="verifycode" class="form-label"><b>验证码</b> <small><a href="javascript:sendcode()">[点击发送]</a></small></label>
            <input type="number" class="form-control" name="verifycode" id="verifycode" required>
        </div>
        <?php endif; ?>

        <?php if($_config['register']['invite']): ?>
        <div class="mb-3">
            <label for="invitecode" class="form-label"><b>邀请码</b></label>
            <input type="text" class="form-control" name="invitecode" id="invitecode" required>
        </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="password" class="form-label"><b>密码</b></label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <button type="submit" class="btn btn-primary full-width">注册</button>

        <?php if($_config['register']['enable']): ?>
        <p class="text-center mt-3">
            已经注册？<a href='?page=login'>立即登录</a>
        </p>
        <?php endif; ?>
    </form>
</div>

<footer>
    &copy; 2019–<?php echo date("Y"); ?> <?php echo $_config['sitename']; ?><br>
    基于ZeroDream-CN | SakuraPanel二开
</footer>

<!-- reCAPTCHA 验证 -->
<?php if($_config['recaptcha']['enable']): ?>
<script type="text/javascript">
window.onload = function(){
    grecaptcha.ready(function(){
        grecaptcha.execute('<?php echo $_config['recaptcha']['sitekey']; ?>',{action:'validate_captcha'}).then(function(token){
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
};
</script>
<?php endif; ?>

<!-- 发送验证码 -->
<script type="text/javascript">
function sendcode() {
    $.ajax({
        type: 'POST',
        url: "?action=sendmail",
        data: { mail: $("#email").val() },
        success: function(response) {
            alert(response);
        },
        error: function() {
            alert("发送失败，请稍后再试。");
        }
    });
}
</script>

</body>
</html>
