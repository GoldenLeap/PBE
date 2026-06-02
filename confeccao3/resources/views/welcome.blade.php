<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestão Inteligente de Confecções</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Premium Vanilla CSS -->
    <style>
        :root {
            --bg-color: #080b11;
            --bg-gradient: linear-gradient(135deg, #080b11 0%, #0d1321 100%);
            --accent-gold: #dfa13d;
            --accent-gold-glow: rgba(223, 161, 61, 0.4);
            --accent-indigo: #6366f1;
            --accent-indigo-glow: rgba(99, 102, 241, 0.3);
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --card-bg: rgba(255, 255, 255, 0.03);
            --card-border: rgba(255, 255, 255, 0.07);
            --card-border-hover: rgba(255, 255, 255, 0.15);
            --glass-blur: blur(16px);
            --font-sans: 'Inter', sans-serif;
            --font-display: 'Outfit', sans-serif;
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg-color);
            background-image: var(--bg-gradient);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        /* Ambient Glow Effects */
        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: var(--accent-indigo-glow);
            filter: blur(150px);
            border-radius: 50%;
            top: -100px;
            left: -100px;
            z-index: 0;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: var(--accent-gold-glow);
            filter: blur(180px);
            border-radius: 50%;
            bottom: -100px;
            right: -100px;
            z-index: 0;
            pointer-events: none;
        }

        header {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-indigo) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-weight: 800;
            color: #000;
            font-size: 20px;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
        }

        .logo-text {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 22px;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #ffffff, #dedede);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-btn {
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 14px;
            color: var(--text-primary);
            text-decoration: none;
            padding: 10px 22px;
            border-radius: 8px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: var(--glass-blur);
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .nav-btn:hover {
            border-color: var(--accent-gold);
            box-shadow: 0 0 15px var(--accent-gold-glow);
            transform: translateY(-2px);
        }

        .nav-btn svg {
            transition: transform 0.3s ease;
        }

        .nav-btn:hover svg {
            transform: translateX(4px);
        }

        main {
            position: relative;
            z-index: 5;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px 60px 24px;
            display: flex;
            flex-direction: column;
            gap: 80px;
        }

        /* Hero Section */
        .hero {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 48px;
            align-items: center;
            padding-top: 20px;
        }

        @media (max-width: 968px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 40px;
            }
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .hero-tag {
            align-self: flex-start;
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--accent-gold);
            background: rgba(223, 161, 61, 0.1);
            padding: 6px 16px;
            border-radius: 50px;
            border: 1px solid rgba(223, 161, 61, 0.2);
        }

        @media (max-width: 968px) {
            .hero-tag {
                align-self: center;
            }
        }

        .hero-title {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 52px;
            line-height: 1.1;
            letter-spacing: -1.5px;
            background: linear-gradient(to right, #ffffff 30%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 38px;
            }
        }

        .hero-desc {
            font-size: 17px;
            line-height: 1.6;
            color: var(--text-secondary);
            max-width: 540px;
        }

        @media (max-width: 968px) {
            .hero-desc {
                margin: 0 auto;
            }
        }

        .cta-group {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        @media (max-width: 968px) {
            .cta-group {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .cta-group {
                flex-direction: column;
                width: 100%;
            }
            .cta-group .nav-btn, .cta-group .btn-primary {
                width: 100%;
                justify-content: center;
            }
        }

        .btn-primary {
            font-family: var(--font-sans);
            font-weight: 700;
            font-size: 15px;
            color: #080b11;
            background: linear-gradient(135deg, var(--accent-gold) 0%, #b8822d 100%);
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 25px var(--accent-gold-glow);
            transition: var(--transition-smooth);
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 30px rgba(223, 161, 61, 0.6);
        }

        .btn-primary svg {
            transition: transform 0.3s ease;
        }

        .btn-primary:hover svg {
            transform: translateX(4px);
        }

        .hero-image-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-image-glow {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--accent-indigo) 0%, var(--accent-gold) 100%);
            opacity: 0.15;
            filter: blur(40px);
            border-radius: 24px;
            z-index: 1;
            pointer-events: none;
        }

        .hero-img {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 460px;
            height: auto;
            border-radius: 20px;
            border: 1px solid var(--card-border);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            animation: floatImage 6s ease-in-out infinite;
            transition: var(--transition-smooth);
        }

        .hero-img:hover {
            border-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.02);
        }

        @keyframes floatImage {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-12px);
            }
        }

        /* Features Section */
        .features-section {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .section-header {
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .section-title {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 32px;
            letter-spacing: -0.5px;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 15px;
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .feature-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 32px 24px;
            backdrop-filter: var(--glass-blur);
            transition: var(--transition-smooth);
            display: flex;
            flex-direction: column;
            gap: 20px;
            cursor: default;
        }

        .feature-card:hover {
            border-color: var(--card-border-hover);
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: var(--accent-indigo);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-smooth);
        }

        .feature-card:nth-child(2n) .feature-icon {
            background: rgba(223, 161, 61, 0.1);
            border: 1px solid rgba(223, 161, 61, 0.2);
            color: var(--accent-gold);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-card-title {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 18px;
            color: #ffffff;
        }

        .feature-card-desc {
            font-size: 14px;
            line-height: 1.5;
            color: var(--text-secondary);
        }

        footer {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
            border-top: 1px solid var(--card-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .footer-text {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .footer-brand {
            font-family: var(--font-display);
            font-weight: 600;
            color: var(--text-primary);
        }
    </style>
</head>
<body>

    <header>
        <div class="logo-container">
            <div class="logo-icon">CB</div>
            <div class="logo-text">Confecção</div>
        </div>
        <nav>
            @auth
                <a href="{{ url('/admin') }}" class="nav-btn">
                    <span>Painel de Controle</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            @else
                <a href="{{ route('filament.admin.auth.login') }}" class="nav-btn">
                    <span>Entrar no Sistema</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            @endauth
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <div class="hero-tag">ERP Confecção Têxtil</div>
                <h1 class="hero-title">Modelagem Inteligente & Gestão de Performance</h1>
                <p class="hero-desc">
                    O ERP sob medida para a sua confecção. Domine a produção da ficha técnica à entrega rápida. Monitore insumos, pedidos e vendas em um painel unificado e premium.
                </p>
                <div class="cta-group">
                    <a href="{{ route('filament.admin.auth.login') }}" class="btn-primary">
                        <span>Acessar Painel Admin</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
            <div class="hero-image-wrapper">
                <div class="hero-image-glow"></div>
                <img src="{{ asset('images/hero.png') }}" alt="Confecção Têxtil Moderna" class="hero-img">
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <div class="section-header">
                <h2 class="section-title">Controle Absoluto de Ponta a Ponta</h2>
                <p class="section-subtitle">Ferramentas avançadas integradas de ponta a ponta para otimizar e acelerar a produção de moda da sua marca.</p>
            </div>
            <div class="features-grid">
                <!-- Card 1 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h3 class="feature-card-title">Clientes & Fornecedores</h3>
                    <p class="feature-card-desc">Cadastro integrado de clientes e fornecedores de matéria-prima, com controle de pedidos, prazos e histórico de transações.</p>
                </div>
                <!-- Card 2 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                    </div>
                    <h3 class="feature-card-title">Gestão de Insumos</h3>
                    <p class="feature-card-desc">Controle preciso de estoques de insumos: tecidos, aviamentos, botões e linhas. Alertas automáticos de estoque baixo.</p>
                </div>
                <!-- Card 3 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <h3 class="feature-card-title">Pedidos & Produção</h3>
                    <p class="feature-card-desc">Monitore o progresso da modelagem, corte, costura e embalagem. Acompanhe a entrega com datas de entrega previstas em tempo real.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-text">
            &copy; 2026 Confecção. Todos os direitos reservados.
        </div>
        <div class="footer-brand">
            Powered by Laravel & Filament
        </div>
    </footer>

</body>
</html>
