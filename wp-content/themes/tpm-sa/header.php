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
            overflow-x: clip;
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

        /* Fixed Header & Mega Menu */
        #site-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 9999 !important;
        }
        #main-header .site-logo-img,
        #main-header a img,
        header#site-header img {
            height: 32px !important;
            max-height: 32px !important;
            width: auto !important;
            max-width: 140px !important;
            object-fit: contain !important;
            display: inline-block !important;
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

        /* Dropdown transition */
        .services-menu-dropdown {
            display: none;
        }
        .services-menu-parent:hover .services-menu-dropdown,
        .services-menu-parent:focus-within .services-menu-dropdown {
            display: block;
        }

        /* Remove WordPress Admin Bar Gap */
        html { margin-top: 0 !important; }
        #wpadminbar { display: none !important; }
    </style>

    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-slate-50 text-gray-800 antialiased min-h-screen flex flex-col'); ?>>

<?php wp_body_open(); ?>

<?php
// Common dynamic URLs
$shop_url     = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
$cart_url     = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');
$account_url  = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');
$cart_count   = function_exists('WC') && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;

$cat_toles_url       = get_term_link('toles-et-toiture', 'product_cat');
$cat_accessoires_url = get_term_link('accessoires-toiture', 'product_cat');
$cat_fixations_url   = get_term_link('fixations-et-etancheite', 'product_cat');
$cat_interieurs_url  = get_term_link('accessoires-interieurs', 'product_cat');

if (is_wp_error($cat_toles_url))       $cat_toles_url = $shop_url;
if (is_wp_error($cat_accessoires_url)) $cat_accessoires_url = $shop_url;
if (is_wp_error($cat_fixations_url))   $cat_fixations_url = $shop_url;
if (is_wp_error($cat_interieurs_url))  $cat_interieurs_url = $shop_url;
?>

<!-- ════════════════════════════════════════════════════════════
     FIXED SITE HEADER (Fixed at Top of Screen)
════════════════════════════════════════════════════════════ -->
<header id="site-header" class="fixed top-0 left-0 w-full z-50 bg-white shadow-sm">
    <!-- Top Utility Strip (Dark Navy) -->
    <div class="bg-tpm-navy text-gray-300 py-1.5 text-xs font-medium hidden md:block border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
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
                <a href="<?php echo esc_url( $account_url ); ?>" class="hover:text-white transition-colors flex items-center gap-1.5 font-semibold text-white/90">
                    <span class="material-symbols-outlined text-[16px] text-tpm-orange">account_circle</span>
                    <?php echo is_user_logged_in() ? 'Mon Espace Client' : 'Connexion / Mon Compte'; ?>
                </a>
                <a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="hover:text-white transition-colors flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">assignment</span>
                    Espace Devis B2B
                </a>
                <a href="https://wa.me/237655705866" target="_blank" class="hover:text-emerald-400 transition-colors flex items-center gap-1.5 text-emerald-300 font-semibold">
                    <span class="material-symbols-outlined text-[16px]">chat</span>
                    Support WhatsApp Commercial
                </a>
                <div class="flex items-center gap-2 border-l border-white/20 pl-4">
                    <button type="button" class="text-white font-bold cursor-default" title="Français">FR</button>
                    <span class="text-gray-500">/</span>
                    <button type="button" class="text-gray-400 hover:text-white" title="English">EN</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <div id="main-header" class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2.5 flex items-center justify-between gap-6">
        
        <!-- Logo -->
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="flex items-center gap-2.5 shrink-0">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo_tpm.png' ); ?>"
                 alt="Logo TPM SA (Groupe CAC)"
                 class="site-logo-img h-8 w-auto object-contain"
                 height="32"
                 style="height: 32px !important; max-height: 32px !important; width: auto !important; max-width: 140px !important; object-fit: contain !important; display: block;"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
            />
            <div style="display:none;" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-tpm-navy rounded flex items-center justify-center text-white font-extrabold text-xs border-b-2 border-tpm-orange">
                    TPM
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-extrabold text-sm text-tpm-navy uppercase tracking-tight">TPM SA</span>
                    <span class="text-[9px] font-bold text-tpm-orange uppercase tracking-wider">Groupe CAC • Depuis 1976</span>
                </div>
            </div>
        </a>

        <!-- Search Bar (Native Form with Auto Submit & Enter Key support) -->
        <form method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="flex-grow max-w-2xl hidden lg:block">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">search</span>
                </div>
                <input type="hidden" name="post_type" value="product"/>
                <input id="header-search"
                       type="search"
                       name="s"
                       value="<?php echo esc_attr( get_search_query() ); ?>"
                       placeholder="Rechercher un article (ex: Tôle BAC 0.50mm, Faîtière, Sac PP 50kg, Vis 6×80…)"
                       class="block w-full pl-10 pr-24 py-2 border border-gray-200 rounded-lg text-sm bg-slate-50 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-tpm-orange focus:border-transparent transition-colors font-medium"/>
                <button type="submit"
                        class="absolute right-1.5 top-1/2 -translate-y-1/2 bg-tpm-navy text-white text-xs px-3.5 py-1.5 rounded-md font-bold hover:bg-tpm-orange transition-colors">
                    Chercher
                </button>
            </div>
        </form>

        <!-- Navigation & Cart CTA -->
        <div class="flex items-center gap-6 shrink-0">
            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-tpm-slate">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-tpm-orange transition-colors <?php echo is_front_page() ? 'text-tpm-orange font-bold' : ''; ?>">
                    Accueil
                </a>
                <a href="<?php echo esc_url( home_url('/entreprise/') ); ?>" class="hover:text-tpm-orange transition-colors <?php echo is_page('entreprise') ? 'text-tpm-orange font-bold' : ''; ?>">
                    L'Entreprise
                </a>
                
                <!-- Catalogue Menu Link & Trigger -->
                <div class="inline-flex items-center gap-0.5">
                    <a href="<?php echo esc_url($shop_url); ?>" class="hover:text-tpm-orange transition-colors <?php echo (is_shop() || is_product_taxonomy() || is_product()) ? 'text-tpm-orange font-bold' : ''; ?>">
                        Catalogue
                    </a>
                    <button id="catalog-trigger" type="button" class="text-tpm-navy hover:text-tpm-orange transition-colors p-0.5 flex items-center" title="Dérouler l'inventaire complet">
                        <span class="material-symbols-outlined text-[18px]" id="catalog-chevron">expand_more</span>
                    </button>
                </div>

                <a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="hover:text-tpm-orange transition-colors <?php echo is_page('devis-sur-mesure') ? 'text-tpm-orange font-bold' : ''; ?>">
                    Devis B2B
                </a>
                <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="hover:text-tpm-orange transition-colors <?php echo is_page('contact') ? 'text-tpm-orange font-bold' : ''; ?>">
                    Contact
                </a>
            </nav>

            <!-- Cart CTA -->
            <a href="<?php echo esc_url($cart_url); ?>" class="custom-button-primary px-5 py-2.5 flex items-center gap-2 text-xs uppercase tracking-wider font-extrabold shadow-md shrink-0">
                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                <span>Mon Panier Pro-Forma (<span class="cart-badge-count"><?php echo esc_html($cart_count); ?></span>)</span>
            </a>

            <!-- Mobile Hamburger -->
            <button id="mobile-menu-btn" type="button" class="md:hidden flex items-center justify-center w-10 h-10 text-tpm-navy">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>
    </div>
    </div>

    <!-- ════════════════════════════════════════════════════════════
         MEGA MENU DROPDOWN (6 Colonnes avec URLs réelles)
    ════════════════════════════════════════════════════════════ -->
    <div id="mega-menu" class="absolute top-full left-0 w-full bg-slate-50 border-t-[3px] border-tpm-orange shadow-2xl z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">

                <!-- Col 1: Tôles & Couvertures -->
                <div class="flex flex-col gap-3">
                    <a href="<?php echo esc_url($cat_toles_url); ?>" class="group">
                        <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2 group-hover:text-tpm-orange transition-colors">
                            <span class="material-symbols-outlined text-tpm-orange text-[20px]">roofing</span>
                            Tôles &amp; Couvertures
                        </h3>
                    </a>
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
                        <li><a href="<?php echo esc_url( home_url('/product/toles-bacs-ou-ondulees-alu-5-10e-prelaquees/') ); ?>" class="hover:text-tpm-orange transition-colors">→ Tôles BAC 5/10e Prélaquées</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/toles-bacs-prelaquees-d50/') ); ?>" class="hover:text-tpm-orange transition-colors">→ Tôles BAC D50 Haute Résistance</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/tole-ondulee-alu-035-3m/') ); ?>" class="hover:text-tpm-orange transition-colors">→ Tôles Ondulées ALU 3M</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/toles-tuile-nervurale-prelaquee-d50/') ); ?>" class="hover:text-tpm-orange transition-colors">→ Tôles Tuiles Nervurées D50</a></li>
                        <li><a href="<?php echo esc_url($cat_toles_url); ?>" class="text-tpm-orange font-bold pt-1 hover:underline">Voir toutes les tôles &raquo;</a></li>
                    </ul>
                </div>

                <!-- Col 2: Accessoires & Pliage -->
                <div class="flex flex-col gap-3">
                    <a href="<?php echo esc_url($cat_accessoires_url); ?>" class="group">
                        <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2 group-hover:text-tpm-orange transition-colors">
                            <span class="material-symbols-outlined text-tpm-orange text-[20px]">architecture</span>
                            Accessoires &amp; Pliage
                        </h3>
                    </a>
                    <ul class="flex flex-col gap-2 text-xs text-gray-600 font-medium">
                        <li><a href="<?php echo esc_url( home_url('/product/faitiere-non-crantee-double-pente-0-35-0-33-nature/') ); ?>" class="hover:text-tpm-orange transition-colors">Faîtières Non Crantées Double Pente</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/faitiere-centrale-0-33-en-0-35-ml-nature/') ); ?>" class="hover:text-tpm-orange transition-colors">Faîtières Centrales Alu</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/rives-de-faitage-0-33-0-35-ml-nature/') ); ?>" class="hover:text-tpm-orange transition-colors">Rives de Faîtage</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/gouttiere-alu-0-33-0-35-ml-nature/') ); ?>" class="hover:text-tpm-orange transition-colors">Gouttières Industrielles Alu</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/noues-en-alu-0-33-0-35-ml-nature/') ); ?>" class="hover:text-tpm-orange transition-colors">Noues &amp; Bandes Ourlées</a></li>
                        <li><a href="<?php echo esc_url($cat_accessoires_url); ?>" class="text-tpm-orange font-bold pt-1 hover:underline">Voir les 17 accessoires &raquo;</a></li>
                    </ul>
                </div>

                <!-- Col 3: Fixations & Étanchéité -->
                <div class="flex flex-col gap-3">
                    <a href="<?php echo esc_url($cat_fixations_url); ?>" class="group">
                        <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2 group-hover:text-tpm-orange transition-colors">
                            <span class="material-symbols-outlined text-tpm-orange text-[20px]">build</span>
                            Fixations &amp; Étanchéité
                        </h3>
                    </a>
                    <ul class="flex flex-col gap-2 text-xs text-gray-600 font-medium">
                        <li><a href="<?php echo esc_url( home_url('/product/tirefond-6x80-paquet-72-pcs/') ); ?>" class="hover:text-tpm-orange transition-colors">Tirefond 6×80 (Paquet 72 pcs)</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/tirefond-6x60-paquet-72-pcs/') ); ?>" class="hover:text-tpm-orange transition-colors">Tirefond 6×60 (Paquet 72 pcs)</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/toiturole-900g/') ); ?>" class="hover:text-tpm-orange transition-colors">Toiturole Étanchéité 900G</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/vis-auto-foreuse-6x70/') ); ?>" class="hover:text-tpm-orange transition-colors">Vis Auto-foreuses 6×70 / 6×60</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/cavaliers-alu-nature/') ); ?>" class="hover:text-tpm-orange transition-colors">Cavaliers Alu &amp; Rondelles Feutres</a></li>
                        <li><a href="<?php echo esc_url($cat_fixations_url); ?>" class="text-tpm-orange font-bold pt-1 hover:underline">Voir les 10 fixations &raquo;</a></li>
                    </ul>
                </div>

                <!-- Col 4: Emballages PP & Fils -->
                <div class="flex flex-col gap-3">
                    <a href="<?php echo esc_url($cat_interieurs_url); ?>" class="group">
                        <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2 group-hover:text-tpm-orange transition-colors">
                            <span class="material-symbols-outlined text-tpm-orange text-[20px]">inventory_2</span>
                            Emballages PP &amp; Fils
                        </h3>
                    </a>
                    <ul class="flex flex-col gap-2 text-xs text-gray-600 font-medium">
                        <li><a href="<?php echo esc_url($cat_interieurs_url); ?>" class="hover:text-tpm-orange transition-colors">Sacs PP Blancs Tissés 50kg</a></li>
                        <li><a href="<?php echo esc_url($cat_interieurs_url); ?>" class="hover:text-tpm-orange transition-colors">Sacs PP Blancs Tissés 100kg</a></li>
                        <li><a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="hover:text-tpm-orange transition-colors">Sacs PP Marquage Personnalisé</a></li>
                        <li><a href="<?php echo esc_url($cat_interieurs_url); ?>" class="hover:text-tpm-orange transition-colors">Éponges Métalliques Inox</a></li>
                        <li><a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="hover:text-tpm-orange transition-colors">Extrusion Polypropylène &amp; Ficelles</a></li>
                        <li><a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="text-tpm-orange font-bold pt-1 hover:underline">Devis sacs en gros volume &raquo;</a></li>
                    </ul>
                </div>

                <!-- Col 5: Carreaux & Quincaillerie -->
                <div class="flex flex-col gap-3">
                    <a href="<?php echo esc_url($cat_interieurs_url); ?>" class="group">
                        <h3 class="text-sm font-bold text-tpm-navy border-b border-gray-200 pb-2 flex items-center gap-2 group-hover:text-tpm-orange transition-colors">
                            <span class="material-symbols-outlined text-tpm-orange text-[20px]">grid_view</span>
                            Carreaux &amp; Sanitaires
                        </h3>
                    </a>
                    <ul class="flex flex-col gap-2 text-xs text-gray-600 font-medium">
                        <li><a href="<?php echo esc_url( home_url('/product/cartons-carreaux-sol-60x60-italien/') ); ?>" class="hover:text-tpm-orange transition-colors">Carreaux Sol 60×60 Italien</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/cartons-carreaux-murs-25x40-ref-pmc42054c/') ); ?>" class="hover:text-tpm-orange transition-colors">Carreaux Mur 25×40 PMC</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/cartons-carreaux-sol-40x40-ref-ymg44223c/') ); ?>" class="hover:text-tpm-orange transition-colors">Carreaux Sol 40×40 YMG</a></li>
                        <li><a href="<?php echo esc_url( home_url('/product/douche-therapeutique-zagonel-moment-grand-modele/') ); ?>" class="hover:text-tpm-orange transition-colors">Douche Thérapeutique Zagonel</a></li>
                        <li><a href="<?php echo esc_url($cat_interieurs_url); ?>" class="text-tpm-orange font-bold pt-1 hover:underline">Voir les 22 articles intérieur &raquo;</a></li>
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
                        <p class="text-xs text-gray-300 mb-4 leading-relaxed">Consultez notre inventaire officiel de 58 articles usine et recevez votre Pro-Forma sous 2h.</p>
                    </div>
                    <div class="space-y-2">
                        <a href="<?php echo esc_url($shop_url); ?>" class="w-full bg-white/10 hover:bg-white/20 text-white border border-white/20 py-2 text-xs font-bold rounded flex items-center justify-center gap-1 transition-colors">
                            <span class="material-symbols-outlined text-[14px]">storefront</span>
                            Inventaire Complet (58)
                        </a>
                        <a href="<?php echo esc_url($cart_url); ?>" class="custom-button-primary w-full py-2 text-xs font-bold flex items-center justify-center gap-1">
                            Obtenir ma Pro-Forma
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden border-t border-gray-200 bg-white">
        <nav class="flex flex-col py-4 px-6 gap-2 text-sm font-bold text-tpm-navy">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="py-2 hover:text-tpm-orange flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Accueil
            </a>
            <a href="<?php echo esc_url( home_url('/entreprise/') ); ?>" class="py-2 hover:text-tpm-orange flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">domain</span>
                L'Entreprise
            </a>
            <a href="<?php echo esc_url($shop_url); ?>" class="py-2 hover:text-tpm-orange flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">inventory</span>
                Catalogue Général (58 Articles)
            </a>
            <div class="pl-4 py-1 flex flex-col gap-1.5 text-xs text-gray-600 font-semibold border-l-2 border-tpm-orange/40 my-1">
                <a href="<?php echo esc_url($cat_toles_url); ?>" class="hover:text-tpm-orange">→ Tôles &amp; Toitures</a>
                <a href="<?php echo esc_url($cat_accessoires_url); ?>" class="hover:text-tpm-orange">→ Accessoires Toiture</a>
                <a href="<?php echo esc_url($cat_fixations_url); ?>" class="hover:text-tpm-orange">→ Fixations &amp; Étanchéité</a>
                <a href="<?php echo esc_url($cat_interieurs_url); ?>" class="hover:text-tpm-orange">→ Carreaux &amp; Emballages PP</a>
            </div>
            <a href="<?php echo esc_url( home_url('/chantiers-btp/') ); ?>" class="py-2 hover:text-tpm-orange flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                Chantiers &amp; BTP
            </a>
            <a href="<?php echo esc_url( home_url('/service-zingage/') ); ?>" class="py-2 hover:text-tpm-orange flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">bolt</span>
                Électro-Zingage 800 VA
            </a>
            <a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="py-2 hover:text-tpm-orange flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">assignment</span>
                Devis B2B
            </a>
            <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="py-2 hover:text-tpm-orange flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">call</span>
                Contact
            </a>
            <a href="<?php echo esc_url( $account_url ); ?>" class="py-2 hover:text-tpm-orange flex items-center gap-2 text-tpm-orange">
                <span class="material-symbols-outlined text-[18px]">account_circle</span>
                <?php echo is_user_logged_in() ? 'Mon Espace Client' : 'Connexion / Mon Compte'; ?>
            </a>
        </nav>
    </div>
</header>

<!-- Header Spacer to prevent fixed header from overlapping top page content -->
<div class="header-spacer h-[92px] hidden md:block w-full pointer-events-none" aria-hidden="true"></div>
<div class="header-spacer h-[58px] md:hidden w-full pointer-events-none" aria-hidden="true"></div>

<script>
(function() {
    const trigger = document.getElementById('catalog-trigger');
    const chevron = document.getElementById('catalog-chevron');
    const megaMenu = document.getElementById('mega-menu');
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (trigger && megaMenu) {
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = megaMenu.classList.toggle('is-open');
            if (chevron) {
                chevron.textContent = isOpen ? 'expand_less' : 'expand_more';
            }
        });
        document.addEventListener('click', (e) => {
            if (!megaMenu.contains(e.target) && !trigger.contains(e.target)) {
                megaMenu.classList.remove('is-open');
                if (chevron) chevron.textContent = 'expand_more';
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

