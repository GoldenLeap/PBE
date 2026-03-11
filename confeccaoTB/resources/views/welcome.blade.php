<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'ConfeccaoTB') }} - Gestão de Alta Qualidade</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            .glass {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
            .dark .glass {
                background: rgba(15, 23, 42, 0.75);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 selection:bg-indigo-500 selection:text-white transition-colors duration-300">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-slate-200/50 dark:border-slate-800/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-3">
                        <x-application-logo class="w-9 h-9 fill-current text-indigo-600 dark:text-indigo-500" />
                        <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">Confeccao<span class="text-indigo-600 dark:text-indigo-400">TB</span></span>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    Aceder
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg shadow-indigo-500/20 transition-all active:scale-95">
                                        Registar agora
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="relative z-10 text-center lg:text-left">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20 mb-6 animate-fade-in">
                            Sistema de Gestão Profissional
                        </span>
                        <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight mb-6 bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-indigo-900 to-slate-900 dark:from-white dark:via-indigo-200 dark:to-slate-300">
                            Excelência em <br> <span class="text-indigo-600 dark:text-indigo-400">Confeção e Estilo.</span>
                        </h1>
                        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl mx-auto lg:mx-0 leading-relaxed mb-10">
                            Otimize a sua produção, controle stock e gira pedidos com uma plataforma desenhada para a precisão técnica e o cuidado artesanal.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                            <a href="{{ route('register') }}" class="group relative px-8 py-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-indigo-500/20 transition-all hover:-translate-y-0.5">
                                Começar Agora
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="relative lg:block">
                        <div class="absolute inset-0 bg-indigo-500/10 blur-3xl rounded-full"></div>
                        <div class="relative rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-2xl skew-y-1 hover:skew-y-0 transition-transform duration-700">
                            <img src="{{ asset('images/tailoring_hero_image.png') }}" alt="Oficina de Confeção" class="w-full h-auto">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                        </div>
                        
                        <!-- Floating Stats Card -->
                        <div class="absolute -bottom-6 -left-6 glass border border-slate-200/50 dark:border-slate-800/50 p-6 rounded-2xl shadow-xl animate-bounce-slow">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-indigo-500 rounded-full flex items-center justify-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Pedidos Concluídos</p>
                                    <p class="text-xl font-bold">100% Precisão</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="funcionalidades" class="py-24 bg-white dark:bg-slate-950/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold mb-4">Desenvolvido para Profissionais</h2>
                    <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                        Ferramentas integradas para gerir todos os aspetos do seu negócio têxtil em tempo real.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1: Clientes -->
                    <div class="group p-8 rounded-3xl border border-slate-100 dark:border-slate-900 bg-slate-50/50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="w-14 h-14 bg-indigo-100 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Clientes</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Gestão detalhada de perfis e histórico de encomendas dos seus clientes.
                        </p>
                    </div>

                    <!-- Feature 2: Pedidos -->
                    <div class="group p-8 rounded-3xl border border-slate-100 dark:border-slate-900 bg-slate-50/50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="w-14 h-14 bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Pedidos</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Acompanhamento de produção em tempo real, do corte à entrega final.
                        </p>
                    </div>

                    <!-- Feature 3: Stock -->
                    <div class="group p-8 rounded-3xl border border-slate-100 dark:border-slate-900 bg-slate-50/50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="w-14 h-14 bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Estoque</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Controlo rigoroso de matérias-primas, tecidos e acessórios disponíveis.
                        </p>
                    </div>

                    <!-- Feature 4: Fornecedores -->
                    <div class="group p-8 rounded-3xl border border-slate-100 dark:border-slate-900 bg-slate-50/50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Fornecedores</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Gestão de parcerias e faturas com fornecedores de tecidos e máquinas.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 border-t border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-3">
                    <x-application-logo class="w-8 h-8 fill-current text-slate-400" />
                    <span class="text-sm font-semibold text-slate-500 tracking-wider">CONFECCAO TB &copy; {{ date('Y') }}</span>
                </div>
                
                <div class="flex gap-8">
                    <a href="#" class="text-sm text-slate-500 hover:text-indigo-600 transition-colors">Política de Privacidade</a>
                    <a href="#" class="text-sm text-slate-500 hover:text-indigo-600 transition-colors">Termos de Uso</a>
                </div>

                <div class="flex gap-4">
                    <span class="text-xs text-slate-400">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
                </div>
            </div>
        </footer>

        <script>
            // Simple animation on scroll
            document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-in');
                        }
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('section').forEach(section => observer.observe(section));
            });
        </script>
    </body>
</html>
