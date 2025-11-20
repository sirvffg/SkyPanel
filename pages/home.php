<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky Panel - Frp 内网穿透管理面板</title>
    <meta name="description" content="Sky Panel - 专业的 Frp 内网穿透管理面板">
    
    <!-- 国产字体 MiSans -->
    <link rel="stylesheet" href="https://lf3-cdn-tos.bytescm.com/obj/static/xitu/MiSans/font.css">
    
    <style>
        /* ==================== 全局样式 ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary-color: #1e6fff;
            --primary-light: #4da1ff;
            --primary-dark: #0052e0;
            --bg-color: #f5f7fa;
            --text-color: #222;
            --text-secondary: #666;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.16);
        }
        
        body {
            font-family: "MiSans", "PingFang SC", "Microsoft YaHei", sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            transition: background 0.4s ease, color 0.4s ease;
            overflow-x: hidden;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .body-wrap {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        /* ==================== 顶部导航 ==================== */
        .site-header {
            text-align: center;
            padding: 40px 20px 30px;
            animation: fadeInDown 0.8s ease;
        }
        
        .site-header img {
            height: 70px;
            filter: drop-shadow(0 4px 12px rgba(30, 111, 255, 0.3));
            transition: transform 0.3s ease, filter 0.3s ease;
        }
        
        .site-header img:hover {
            transform: scale(1.05) rotate(2deg);
            filter: drop-shadow(0 6px 16px rgba(30, 111, 255, 0.5));
        }
        
        /* ==================== 英雄区 ==================== */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero {
            position: relative;
            text-align: center;
            padding: 60px 20px;
            max-width: 900px;
            margin: 0 auto;
            animation: fadeInUp 1s ease;
        }
        
        .hero-title {
            font-size: clamp(48px, 8vw, 72px);
            font-weight: 700;
            margin-bottom: 24px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: titleGlow 3s ease-in-out infinite;
            letter-spacing: -1px;
        }
        
        .hero-paragraph {
            font-size: clamp(18px, 3vw, 24px);
            color: var(--text-secondary);
            margin-bottom: 48px;
            font-weight: 400;
            animation: fadeIn 1.2s ease;
        }
        
        .button-primary {
            display: inline-block;
            font-size: 18px;
            font-weight: 500;
            padding: 16px 48px;
            border-radius: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: #fff;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(30, 111, 255, 0.35);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            animation: fadeIn 1.4s ease;
        }
        
        .button-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .button-primary:hover::before {
            left: 100%;
        }
        
        .button-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 32px rgba(30, 111, 255, 0.5);
        }
        
        .button-primary:active {
            transform: translateY(-1px) scale(0.98);
        }
        
        /* ==================== 特性卡片 ==================== */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-top: 60px;
            padding: 0 20px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeIn 1.6s ease;
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 32px 24px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            border: 1px solid rgba(30, 111, 255, 0.1);
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(30, 111, 255, 0.3);
        }
        
        .feature-icon {
            font-size: 36px;
            margin-bottom: 16px;
        }
        
        .feature-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 12px;
        }
        
        .feature-desc {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.8;
        }
        
        /* ==================== 页脚 ==================== */
        footer {
            text-align: center;
            padding: 48px 20px 32px;
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 2;
            animation: fadeIn 1.8s ease;
            background: linear-gradient(to top, rgba(255, 255, 255, 0.5), transparent);
        }
        
        footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* ==================== 画布 ==================== */
        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }
        
        /* ==================== 动画 ==================== */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes titleGlow {
            0%, 100% {
                filter: drop-shadow(0 0 20px rgba(30, 111, 255, 0.3));
            }
            50% {
                filter: drop-shadow(0 0 30px rgba(30, 111, 255, 0.6));
            }
        }
        
        /* ==================== 响应式设计 ==================== */
        @media (max-width: 768px) {
            .site-header {
                padding: 30px 20px 20px;
            }
            
            .site-header img {
                height: 50px;
            }
            
            .hero {
                padding: 40px 20px;
            }
            
            .button-primary {
                padding: 14px 36px;
                font-size: 16px;
            }
            
            .features {
                grid-template-columns: 1fr;
                gap: 16px;
                margin-top: 40px;
            }
            
            footer {
                padding: 32px 20px 24px;
                font-size: 13px;
            }
        }
        
        @media (max-width: 480px) {
            .hero-paragraph {
                margin-bottom: 32px;
            }
        }
    </style>
</head>

<body>
    <div class="body-wrap">
        <header class="site-header">
            <img src="assets/home/dist/images/logo.svg" alt="Sky Panel Logo">
        </header>

        <main>
            <section class="hero">
                <h1 class="hero-title">Sky Panel</h1>
                <p class="hero-paragraph">专业的 Frp 内网穿透管理面板</p>
                <a href="?page=login" class="button-primary">立即开始使用</a>
                
                <div class="features">
                    <div class="feature-card">
                        <div class="feature-icon">🚀</div>
                        <div class="feature-title">高效稳定</div>
                        <div class="feature-desc">基于 Frp 协议，提供稳定可靠的内网穿透服务</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <div class="feature-title">简单易用</div>
                        <div class="feature-desc">直观的管理界面，轻松配置和管理您的穿透节点</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🔒</div>
                        <div class="feature-title">安全可靠</div>
                        <div class="feature-desc">多重安全防护，保障您的数据传输安全</div>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <div>© Skytech Studio 2019–<span id="year"></span></div>
            <div>基于 ZeroDream-CN | SakuraPanel 二开</div>
        </footer>
    </div>

    <!-- ==================== JavaScript ==================== -->
    <script>
        // 自动更新年份
        document.getElementById("year").textContent = new Date().getFullYear();

        // ==================== 星光闪烁效果 ====================
        const starsCanvas = document.createElement('canvas');
        document.body.appendChild(starsCanvas);
        const ctxStars = starsCanvas.getContext("2d");
        
        function resizeCanvas() {
            starsCanvas.width = window.innerWidth;
            starsCanvas.height = window.innerHeight;
            particlesCanvas.width = window.innerWidth;
            particlesCanvas.height = window.innerHeight;
        }
        
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        // 创建星星数组
        const starList = [];
        const starCount = Math.min(250, Math.floor(window.innerWidth * window.innerHeight / 8000));
        
        for (let i = 0; i < starCount; i++) {
            starList.push({
                x: Math.random() * starsCanvas.width,
                y: Math.random() * starsCanvas.height,
                r: Math.random() * 1.8 + 0.3,
                o: Math.random(),
                speed: Math.random() * 0.02 + 0.005
            });
        }
        
        function drawStars() {
            ctxStars.clearRect(0, 0, starsCanvas.width, starsCanvas.height);
            
            starList.forEach(star => {
                ctxStars.beginPath();
                ctxStars.arc(star.x, star.y, star.r, 0, Math.PI * 2);
                
                // 渐变色星光
                const gradient = ctxStars.createRadialGradient(star.x, star.y, 0, star.x, star.y, star.r * 2);
                gradient.addColorStop(0, `rgba(30, 111, 255, ${star.o})`);
                gradient.addColorStop(1, `rgba(77, 161, 255, 0)`);
                ctxStars.fillStyle = gradient;
                ctxStars.fill();
                
                // 闪烁效果
                star.o += (Math.random() - 0.5) * star.speed;
                star.o = Math.max(0.1, Math.min(1, star.o));
            });
            
            requestAnimationFrame(drawStars);
        }
        
        drawStars();

        // ==================== 粒子漂浮效果 ====================
        const particlesCanvas = document.createElement('canvas');
        document.body.appendChild(particlesCanvas);
        const ctxParticles = particlesCanvas.getContext("2d");
        
        const particles = [];
        const particleCount = Math.min(80, Math.floor(window.innerWidth * window.innerHeight / 15000));
        
        for (let i = 0; i < particleCount; i++) {
            particles.push({
                x: Math.random() * particlesCanvas.width,
                y: Math.random() * particlesCanvas.height,
                r: Math.random() * 3 + 1,
                vx: (Math.random() - 0.5) * 0.5,
                vy: (Math.random() - 0.5) * 0.5,
                opacity: Math.random() * 0.3 + 0.1
            });
        }
        
        function drawParticles() {
            ctxParticles.clearRect(0, 0, particlesCanvas.width, particlesCanvas.height);
            
            particles.forEach(particle => {
                // 绘制粒子
                ctxParticles.beginPath();
                ctxParticles.arc(particle.x, particle.y, particle.r, 0, Math.PI * 2);
                
                const gradient = ctxParticles.createRadialGradient(
                    particle.x, particle.y, 0,
                    particle.x, particle.y, particle.r * 2
                );
                gradient.addColorStop(0, `rgba(30, 111, 255, ${particle.opacity})`);
                gradient.addColorStop(1, `rgba(77, 161, 255, 0)`);
                ctxParticles.fillStyle = gradient;
                ctxParticles.fill();
                
                // 更新位置
                particle.x += particle.vx;
                particle.y += particle.vy;
                
                // 边界检测
                if (particle.x < 0 || particle.x > particlesCanvas.width) {
                    particle.vx *= -1;
                    particle.x = Math.max(0, Math.min(particlesCanvas.width, particle.x));
                }
                if (particle.y < 0 || particle.y > particlesCanvas.height) {
                    particle.vy *= -1;
                    particle.y = Math.max(0, Math.min(particlesCanvas.height, particle.y));
                }
            });
            
            // 绘制连接线
            ctxParticles.strokeStyle = 'rgba(30, 111, 255, 0.1)';
            ctxParticles.lineWidth = 1;
            
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    
                    if (distance < 150) {
                        ctxParticles.beginPath();
                        ctxParticles.moveTo(particles[i].x, particles[i].y);
                        ctxParticles.lineTo(particles[j].x, particles[j].y);
                        ctxParticles.globalAlpha = (1 - distance / 150) * 0.3;
                        ctxParticles.stroke();
                        ctxParticles.globalAlpha = 1;
                    }
                }
            }
            
            requestAnimationFrame(drawParticles);
        }
        
        drawParticles();

        // ==================== 鼠标交互效果 ====================
        let mouseX = 0;
        let mouseY = 0;
        
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            // 粒子跟随鼠标
            particles.forEach(particle => {
                const dx = mouseX - particle.x;
                const dy = mouseY - particle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < 100) {
                    const force = (100 - distance) / 100;
                    particle.vx -= (dx / distance) * force * 0.1;
                    particle.vy -= (dy / distance) * force * 0.1;
                }
            });
        });
    </script>

</body>
</html>
