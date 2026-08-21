<?php
/**
 * header.php - TPM SA Theme
 * Faithful implementation of Design/tpm_sa_official_inventory_mega_menu_interface/code.html
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="light">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="TPM SA (Groupe CAC) - Fabricant et distributeur de tôles BAC, sacs PP, faîtières, fixations et matériaux de construction à Douala PK12 & Bekoko, Cameroun."/>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        tpm: {
                            navy:       '#1C1340',
                            orange:     '#D84B1F',
                            terracotta: '#D84B1F',
                            slate:      '#0F172A',
                            surface:    '#F8FAFC',
                            border:     '#E2E8F0',
                            gray:       '#94A3B8'
                        },
                        "brand-terracotta": "#D84B1F",
                        "brand-navy": "#1C1340",
                        "brand-slate": "#0F172A",
                        "brand-gray": "#94A3B8"
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace']
                    },
                    maxWidth: {
                        'container-max': '1440px',
                    }
                }
            }
        }
    </script>

    <style>
        /* ═══════════════════════════════════════════════════════════
           GLOBAL RESET & FULL WIDTH FIT
        ═══════════════════════════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; }
        html, body {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* Material Icons */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* Glassmorphism Card Style */
        .glass-card {
            background: rgba(28, 19, 64, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* Buttons */
        .custom-button-primary, .btn-tpm-primary {
            background-color: #D84B1F;
            color: #FFFFFF;
            border-radius: 6px;
            font-weight: 700;
            transition: all 0.2s ease-in-out;
        }
        .custom-button-primary:hover, .btn-tpm-primary:hover {
            background-color: #b03a15;
            box-shadow: 0 4px 14px rgba(216,75,31,0.35);
        }

        /* Header Sticky & Mega Menu */
        #main-header {
            position: sticky;
            top: 0;
            z-index: 9000;
        }
        #mega-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #F8FAFC;
            border-top: 3px solid #D84B1F;
            box-shadow: 0 20px 60px rgba(15,23,42,0.18);
            z-index: 8000;
        }
        #mega-menu.is-open { display: block; }
        #mobile-menu { display: none; }
        #mobile-menu.is-open { display: block; }

        /* Remove WordPress Admin Bar Gap */
        html { margin-top: 0 !important; }
        #wpadminbar { display: none !important; }
    </style>

    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-slate-50 text-gray-800 antialiased min-h-screen flex flex-col'); ?>>

<?php wp_body_open(); ?>

<!-- ════════════════════════════════════════════════════════════
     TOP UTILITY STRIP (Dark Navy)
════════════════════════════════════════════════════════════ -->
<div class="bg-tpm-navy text-gray-300 py-2 px-4 md:px-8 text-xs font-medium hidden md:block border-b border-white/10">
    <div class="max-w-container-max mx-auto flex justify-between items-center">
        <div class="flex items-center gap-6">
            <span class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px] text-tpm-orange">location_on</span>
                TPM SA — Douala PK12 &amp; Bekoko
            </span>
            <span class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px] text-tpm-orange">call</span>
                <strong>+237 655 70 58 66</strong>
            </span>
            <span class="flex items-center gap-1.5 text-gray-400">
                <span class="material-symbols-outlined text-[16px]">verified</span>
                NIU : M052217435713Q
            </span>
        </div>
        <div class="flex items-center gap-6">
            <a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="hover:text-white transition-colors flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">assignment</span>
                Espace Devis B2B
            </a>
            <a href="https://wa.me/237655705866" target="_blank" class="hover:text-emerald-400 transition-colors flex items-center gap-1.5 text-emerald-300 font-semibold">
                <span class="material-symbols-outlined text-[16px]">chat</span>
                Support WhatsApp Commercial
            </a>
            <div class="flex items-center gap-2 border-l border-white/20 pl-4">
                <button class="text-white font-bold">FR</button>
                <span class="text-gray-500">/</span>
                <button class="text-gray-400 hover:text-white">EN</button>
            </div>
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════════════════════════
     MAIN HEADER BAR
════════════════════════════════════════════════════════════ -->
<header id="main-header" class="bg-white border-b border-gray-200 shadow-sm relative">
    <div class="max-w-container-max mx-auto px-4 md:px-8 py-3.5 flex items-center justify-between gap-8">
        
        <!-- Logo -->
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="flex items-center gap-3 shrink-0 group">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo_tpm.png' ); ?>"
                 alt="Logo TPM SA (Groupe CAC)"
                 class="h-11 w-auto object-contain group-hover:opacity-90 transition-opacity"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
            />
            <div style="display:none;" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-tpm-navy rounded flex items-center justify-center text-white font-extrabold text-base border-b-4 border-tpm-orange">
                    TPM
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-extrabold text-base text-tpm-navy uppercase tracking-tight">TPM SA</span>
                    <span class="text-[10px] font-bold text-tpm-orange uppercase tracking-wider">Groupe CAC • Depuis 1976</span>
                </div>
            </div>
        </a>

        <!-- Search Bar -->
        <div class="flex-grow max-w-2xl hidden lg:block">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">search</span>
                </div>
                <input id="header-search"
                       type="text"
                       placeholder="Rechercher un article (ex: Tôle BAC 0.50mm, Faîtière, Sac PP 50kg, Vis 6×80…)"
                       class="block w-full pl-10 pr-24 py-2.5 border border-gray-200 rounded-lg text-sm bg-slate-50 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-tpm-orange focus:border-transparent transition-colors font-medium"/>
                <button type="button"
                        onclick="const q=encodeURIComponent(document.getElementById('header-search').value.trim()); if(q) window.location.href='<?php echo esc_url( home_url('/') ); ?>?s='+q+'&post_type=product';"
                        class="absolute right-1.5 top-1/2 -translate-y-1/2 bg-tpm-navy text-white text-xs px-3.5 py-1.5 rounded-md font-bold hover:bg-tpm-orange transition-colors">
                    Chercher
                </button>
            </div>
        </div>

        <!-- Navigation & Cart CTA -->
        <div class="flex items-center gap-6 shrink-0">
            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-tpm-slate">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-tpm-orange transition-colors <?php echo is_front_page() ? 'text-tpm-orange font-bold' : ''; ?>">Accueil</a>
                <a href="<?php echo esc_url( home_url('/entreprise/') ); ?>" class="hover:text-tpm-orange transition-colors">L'Entreprise</a>
                <button id="catalog-trigger" type="button" class="flex items-center gap-0.5 text-tpm-navy font-bold hover:text-tpm-orange transition-colors">
                    CATALOGUE
                    <span class="material-symbols-outlined text-[18px]" id="catalog-chevron">expand_more</span>
                </button>
                <a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="hover:text-tpm-orange transition-colors">Devis B2B</a>
                <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="hover:text-tpm-orange transition-colors">Contact</a>
            </nav>

            <?php $cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/panier/'); ?>
            <?php $cart_count = function_exists('WC') && WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
            <a href="<?php echo esc_url($cart_url); ?>" class="custom-button-primary px-5 py-2.5 flex items-center gap-2 text-xs uppercase tracking-wider shadow-md">
                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                <span>Mon Panier Pro-Forma (<span class="cart-badge-count"><?php echo esc_html($cart_count); ?></span>)</span>
            </a>

            <!-- Mobile Hamburger -->
            <button id="mobile-menu-btn" type="button" class="md:hidden flex items-center justify-center w-10 h-10 text-tpm-navy">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>
    </div>

    <!-- ════════════════════════════════════════════════════════════
         MEGA MENU DROPDOWN (6 Colonnes)
    ════════════════════════════════════════════════════════════ -->
    <div id="mega-menu" class="absolute top-full left-0 w-full bg-slate-50 border-t-[3px] border-tpm-orange shadow-2xl z-40">
        <?php $shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/boutique/'); ?>
        <div class="max-w-container-max mx-auto px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">

                <!-- Col 1: Tôles & Couvertures -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tpm-orange text-[20px]">roofing</span>
                        Tôles &amp; Couvertures
                    </h3>
                    <ul class="flex flex-col gap-2 text-xs text-gray-600 font-medium">
                        <li>
                            <span class="font-bold text-tpm-navy block mb-1">Tôles BAC Couleurs</span>
                            <div class="flex items-center gap-1.5 mb-1.5">
                                <span class="w-3.5 h-3.5 rounded-full bg-red-800 border border-gray-300" title="Bordeau RAL 3005"></span>
                                <span class="w-3.5 h-3.5 rounded-full bg-blue-600 border border-gray-300" title="Bleu Cendre RAL 5014"></span>
                                <span class="w-3.5 h-3.5 rounded-full bg-orange-500 border border-gray-300" title="Orange Terracotta"></span>
                                <span class="w-3.5 h-3.5 rounded-full bg-green-700 border border-gray-300" title="Vert Olive"></span>
                            </div>
                        </li>
                        <li><a href="<?php echo esc_url($shop_url); ?>?pole=toles" class="hover:text-tpm-orange transition-colors">→ Tôles BAC 0.50mm Bordeau</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>?pole=toles" class="hover:text-tpm-orange transition-colors">→ Tôles BAC Bleu Cendre</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>?pole=toles" class="hover:text-tpm-orange transition-colors">→ Tôles Ondulées</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>?pole=toles" class="hover:text-tpm-orange transition-colors">→ Tôles Translucides</a></li>
                    </ul>
                </div>

                <!-- Col 2: Accessoires & Pliage -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tpm-orange text-[20px]">architecture</span>
                        Accessoires &amp; Pliage
                    </h3>
                    <ul class="flex flex-col gap-2 text-xs text-gray-600 font-medium">
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Faîtières Bord Rabattu</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Faîtières Crantées</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Rives Sur-Mesure</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Gouttières Industrielles</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Noues &amp; Bandes Ourlées</a></li>
                    </ul>
                </div>

                <!-- Col 3: Fixations & Étanchéité -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tpm-orange text-[20px]">build</span>
                        Fixations &amp; Étanchéité
                    </h3>
                    <ul class="flex flex-col gap-2 text-xs text-gray-600 font-medium">
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Fixations Complètes 6×80</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Fixations Complètes 6×60</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Joint Bitumé 1976 (10m)</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Pointes Torsadées Toiture</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Pointes Ordinaires BTP</a></li>
                    </ul>
                </div>

                <!-- Col 4: Emballages PP & Fils -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tpm-orange text-[20px]">inventory_2</span>
                        Emballages PP &amp; Fils
                    </h3>
                    <ul class="flex flex-col gap-2 text-xs text-gray-600 font-medium">
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Sacs PP Blancs 50kg</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Sacs PP Blancs 100kg</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Sacs PP Personnalisés</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Éponges Métalliques</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Extrusion Polypropylène</a></li>
                    </ul>
                </div>

                <!-- Col 5: Carreaux & Quincaillerie -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tpm-orange text-[20px]">grid_view</span>
                        Carreaux &amp; Quincaillerie
                    </h3>
                    <ul class="flex flex-col gap-2 text-xs text-gray-600 font-medium">
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Carreaux Sol Grès 60×60</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Carreaux Mur 30×60 Verony</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Brouette Industrielle 80L</a></li>
                        <li><a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors">Outillage Lourd de Chantier</a></li>
                    </ul>
                </div>

                <!-- Col 6: Promo Card -->
                <div class="flex flex-col bg-tpm-navy text-white p-4 rounded-xl justify-between shadow-lg border border-white/10">
                    <div>
                        <div class="flex items-center gap-1.5 mb-2 text-tpm-orange font-bold text-[10px] uppercase tracking-widest">
                            <span class="material-symbols-outlined text-[16px]">local_shipping</span>
                            B2B Procurement
                        </div>
                        <h4 class="text-sm font-bold text-white mb-2">Commande Spéciale / Grossiste ?</h4>
                        <p class="text-xs text-gray-300 mb-4 leading-relaxed">Consultez notre inventaire officiel et recevez votre Pro-Forma en 2h.</p>
                    </div>
                    <a href="<?php echo esc_url($cart_url); ?>" class="custom-button-primary w-full py-2 text-xs font-bold flex items-center justify-center gap-1">
                        Obtenir ma Pro-Forma
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden border-t border-gray-200 bg-white">
        <nav class="flex flex-col py-4 px-6 gap-2 text-sm font-bold text-tpm-navy">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="py-2 hover:text-tpm-orange">Accueil</a>
            <a href="<?php echo esc_url( home_url('/entreprise/') ); ?>" class="py-2 hover:text-tpm-orange">L'Entreprise</a>
            <a href="<?php echo esc_url($shop_url); ?>" class="py-2 hover:text-tpm-orange">Catalogue Général</a>
            <a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="py-2 hover:text-tpm-orange">Devis B2B</a>
            <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="py-2 hover:text-tpm-orange">Contact</a>
        </nav>
    </div>
</header>

<script>
(function() {
    const trigger = document.getElementById('catalog-trigger');
    const megaMenu = document.getElementById('mega-menu');
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (trigger && megaMenu) {
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            megaMenu.classList.toggle('is-open');
        });
        document.addEventListener('click', (e) => {
            if (!megaMenu.contains(e.target) && !trigger.contains(e.target)) {
                megaMenu.classList.remove('is-open');
            }
        });
    }

    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('is-open');
        });
    }
})();
</script>
