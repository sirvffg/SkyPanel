<?php
namespace SakuraPanel;

use SakuraPanel;

global $_config;

if(isset($_GET['link']) && $_GET['link'] !== "") {
    $um = new SakuraPanel\UserManager();
    if($um->resetPass($_GET['link'])) {
        exit("<script>alert('密码重置成功，请使用新密码登录。');location='?page=login';</script>");
    } else {
        exit("<script>alert('无效的找回密码链接，请重新获取。');location='?page=login';</script>");
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>找回密码 :: <?php echo $_config['sitename']; ?></title>

<!-- 国产字体 MiSans -->
<link rel="stylesheet" href="https://lf3-cdn-tos.bytescm.com/obj/static/xitu/MiSans/font.css">
<link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/popper.js/2.11.7/cjs/popper.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js"></script>
<?php if($_config['recaptcha']['enable']) echo '<script src="https://www.recaptcha.net/recaptcha/api.js?render=' . $_config['recaptcha']['sitekey'] . '" defer></script>'; ?>

<style>
/* 全局字体和主题 */
body {
    margin:0;
    font-family:"MiSans","PingFang SC","Microsoft YaHei",sans-serif;
    background: #f5f7fa;
    color: #222;
    overflow-x:hidden;
}

/* 顶部 Logo */
.site-header {
    text-align:center;
    padding: 30px 0 20px;
}
.site-header img { height:60px; }

/* 主容器 */
.main-box {
    width:100%;
    max-width:480px;
    margin:0 auto;
    padding:40px;
    background:rgba(255,255,255,0.95);
    border-radius:12px;
    box-shadow:0 12px 32px rgba(30,111,255,0.15);
    position:relative;
    z-index:10;
}
.main-box h2 { 
    color:#1e6fff; 
    font-weight:700; 
    text-align:center;
    margin-bottom:12px;
}
.main-box p { text-align:center; opacity:0.85; margin-bottom:20px; }
hr { border-color:#d0d8e3; }

/* 表单 */
.form-control {
    border-radius:6px;
    margin-bottom:15px;
    box-shadow:none;
    border:1px solid #ccc;
}
.btn-primary {
    width:100%;
    background: linear-gradient(135deg,#1e6fff,#4da1ff);
    border:none;
    padding:12px 0;
    font-size:18px;
    border-radius:8px;
    box-shadow:0 6px 20px rgba(30,111,255,0.3);
    transition:all 0.3s;
}
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow:0 8px 24px rgba(30,111,255,0.4);
}

/* 页脚 */
footer {
    text-align:center;
    padding:40px 0 20px;
    font-size:15px;
    line-height:1.6;
    opacity:0.7;
}

/* 星光/粒子 */
canvas {
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    z-index:0;
    pointer-events:none;
}

/* 响应式 */
@media screen and (max-width:768px){
    .main-box { width:90%; padding:30px; }
}
</style>
</head>

<body>

<div class="body-wrap">
    <header class="site-header">
        <img src="assets/home/dist/images/logo.svg" alt="Sky Logo">
    </header>

    <main>
        <div class="main-box">
            <h2><?php echo $_config['sitename']; ?></h2>
            <p><?php echo $_config['description']; ?></p>
            <hr>
            <form method="POST" action="?action=findpass&page=findpass">
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                <input type="text" class="form-control" name="username" placeholder="账号或邮箱" required>
                <button type="submit" class="btn btn-primary">找回密码</button>
                <?php if($_config['register']['enable']) { ?>
                    <p class="text-center mt-3"><a href='?page=register'>注册新账号</a> | <a href='?page=login'>返回登录</a></p>
                <?php } ?>
            </form>
        </div>
    </main>

    <footer>
        <div>© Skytech Studio 2019–<span id="year"></span></div>
        <div>基于 ZeroDream-CN | SakuraPanel 二开</div>
    </footer>
</div>

<script>
// 自动年份
document.getElementById("year").textContent = new Date().getFullYear();

// ================= 星光闪烁 =================
const stars = document.createElement('canvas');
document.body.appendChild(stars);
const ctxStars = stars.getContext("2d");
function resizeCanvas(){ stars.width=window.innerWidth; stars.height=window.innerHeight; }
window.onresize = resizeCanvas; resizeCanvas();

let starList=[];
for(let i=0;i<200;i++){ starList.push({x:Math.random()*stars.width, y:Math.random()*stars.height, r:Math.random()*1.5, o:Math.random()}); }
function drawStars(){
    ctxStars.clearRect(0,0,stars.width,stars.height);
    for(let s of starList){
        ctxStars.beginPath();
        ctxStars.arc(s.x,s.y,s.r,0,Math.PI*2);
        ctxStars.fillStyle=`rgba(30,111,255,${s.o})`;
        ctxStars.fill();
        s.o += (Math.random()*0.02-0.01);
        if(s.o<0.1)s.o=0.1;
        if(s.o>1)s.o=1;
    }
    requestAnimationFrame(drawStars);
}
drawStars();

// ================= 粒子漂浮 =================
const particles = document.createElement('canvas');
document.body.appendChild(particles);
const ctxP = particles.getContext("2d");
resizeCanvas();
let ps=[];
for(let i=0;i<60;i++){ps.push({x:Math.random()*particles.width,y:Math.random()*particles.height,r:Math.random()*3+1,vx:(Math.random()-0.5)*0.3,vy:(Math.random()-0.5)*0.3});}
function drawParticles(){
    ctxP.clearRect(0,0,particles.width,particles.height);
    for(let p of ps){
        ctxP.beginPath();
        ctxP.arc(p.x,p.y,p.r,0,2*Math.PI);
        ctxP.fillStyle="rgba(30,111,255,0.3)";
        ctxP.fill();
        p.x+=p.vx; p.y+=p.vy;
        if(p.x<0||p.x>particles.width)p.vx*=-1;
        if(p.y<0||p.y>particles.height)p.vy*=-1;
    }
    requestAnimationFrame(drawParticles);
}
drawParticles();

// ================= reCAPTCHA =================
<?php if($_config['recaptcha']['enable']){ ?>
window.onload=function(){
    grecaptcha.ready(function(){
        grecaptcha.execute('<?php echo $_config['recaptcha']['sitekey']; ?>',{action:'validate_captcha'})
        .then(function(token){ document.getElementById('g-recaptcha-response').value=token; });
    });
};
<?php } ?>
</script>

</body>
</html>
