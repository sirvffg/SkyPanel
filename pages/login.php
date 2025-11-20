<?php
global $_config;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>登录 :: <?php echo $_config['sitename']; ?> - <?php echo $_config['description']; ?></title>

<style>
/* ===== 全局 ===== */
body {
    margin:0;
    font-family:"MiSans","PingFang SC","Microsoft YaHei",sans-serif;
    background:#f5f7fa;
    color:#222;
    overflow-x:hidden;
}
canvas { position: fixed; top:0; left:0; width:100%; height:100%; z-index:-10; pointer-events:none; }

/* ===== 登录框 ===== */
.main-box {
    width:100%;
    max-width:400px;
    margin:100px auto;
    padding:40px;
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(12px);
    border-radius:16px;
    box-shadow: 0 16px 32px rgba(0,0,0,0.15);
}
.logo {
    font-weight:700;
    font-size:32px;
    color:#1e6fff;
    margin-bottom:8px;
}
.main-box p { margin-bottom:12px; }
input[type=text], input[type=password] {
    width:100%;
    padding:10px 14px;
    border-radius:8px;
    border:1px solid #ccc;
    outline:none;
    font-size:16px;
    margin-bottom:12px;
}
input:focus { border-color:#1e6fff; box-shadow:0 0 8px rgba(30,111,255,0.3); }
button {
    width:100%;
    padding:12px;
    font-size:18px;
    border:none;
    border-radius:8px;
    color:#fff;
    background: linear-gradient(135deg,#1e6fff,#4da1ff);
    cursor:pointer;
    transition: all 0.3s;
}
button:hover {
    transform: translateY(-2px);
    box-shadow:0 8px 24px rgba(30,111,255,0.4);
}

/* ===== 链接 ===== */
a { color:#1e6fff; text-decoration:none; }
a:hover { text-decoration:underline; }

/* ===== 底部版权 ===== */
footer {
    text-align: center;
    font-size: 14px;
    color: #555;
    margin-top: 40px;
    line-height: 1.6; 
}

/* ===== 响应式 ===== */
@media(max-width:768px){ .main-box { margin:50px 16px; padding:24px; } }
</style>
</head>
<body>

<canvas id="stars"></canvas>
<canvas id="particles"></canvas>

<div class="main-box text-center">
    <h2 class="logo"><?php echo $_config['sitename']; ?></h2>
    <p><?php echo $_config['description']; ?></p>
    <hr>

    <?php
    if(isset($data['status']) && isset($data['message'])) {
        $alertType = $data['status'] ? "success" : "danger";
        echo '<div style="margin-bottom:12px;padding:12px;background:'.($data['status']?'#d4edda':'#f8d7da').';color:'.($data['status']?'#155724':'#721c24').';border-radius:8px;">'.$data['message'].'</div>';
    }
    ?>

    <form method="POST" action="?action=login&page=login">
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
        <input type="text" name="username" id="username" placeholder="账号" required>
        <input type="password" name="password" id="password" placeholder="密码" required>
        <button type="submit">登录</button>
        <p style="margin-top:12px;">
            <?php if($_config['register']['enable']) echo "<a href='?page=register'>注册新账号</a> | "; ?>
            <a href='?page=findpass'>忘记密码？</a>
        </p>
    </form>
</div>

<footer>
    <div>&copy; <?php echo $_config['sitename']; ?> 2019–<?php echo date("Y"); ?></div>
    <div>基于 ZeroDream-CN | SakuraPanel 二开</div>
</footer>

<?php
if($_config['recaptcha']['enable']) {
    echo <<<EOF
<script>
window.onload = function() {
    grecaptcha.ready(function() {
        grecaptcha.execute('{$_config['recaptcha']['sitekey']}', {action:'validate_captcha'}).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
}
</script>
EOF;
}
?>

<script>
// 自动调整画布
const canvases = ['stars','particles'].map(id=>document.getElementById(id));
function resizeCanvas(){for(let c of canvases){c.width=window.innerWidth;c.height=window.innerHeight;}}
window.onresize = resizeCanvas;
resizeCanvas();

// 星光闪烁
let ctxStars = document.getElementById('stars').getContext('2d');
let starList=[]; for(let i=0;i<200;i++){starList.push({x:Math.random()*window.innerWidth,y:Math.random()*window.innerHeight,r:Math.random()*1.5,o:Math.random()});}
function drawStars(){ctxStars.clearRect(0,0,window.innerWidth,window.innerHeight);for(let s of starList){ctxStars.beginPath();ctxStars.arc(s.x,s.y,s.r,0,Math.PI*2);ctxStars.fillStyle=`rgba(30,111,255,${s.o})`;ctxStars.fill();s.o += (Math.random()*0.02-0.01); if(s.o<0.1)s.o=0.1;if(s.o>1)s.o=1;} requestAnimationFrame(drawStars);}
drawStars();

// 粒子漂浮
let ctxP = document.getElementById('particles').getContext('2d'); let ps=[]; for(let i=0;i<60;i++){ps.push({x:Math.random()*window.innerWidth,y:Math.random()*window.innerHeight,r:Math.random()*3+1,vx:(Math.random()-0.5)*0.3,vy:(Math.random()-0.5)*0.3});}
function drawParticles(){ctxP.clearRect(0,0,window.innerWidth,window.innerHeight);for(let p of ps){ctxP.beginPath();ctxP.arc(p.x,p.y,p.r,0,2*Math.PI);ctxP.fillStyle="rgba(30,111,255,0.3)";ctxP.fill();p.x+=p.vx;p.y+=p.vy;if(p.x<0||p.x>window.innerWidth)p.vx*=-1;if(p.y<0||p.y>window.innerHeight)p.vy*=-1;} requestAnimationFrame(drawParticles);}
drawParticles();
</script>

</body>
</html>
