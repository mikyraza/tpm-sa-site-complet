<?php
/**
 * front-page.php - TPM SA Theme
 * Faithful implementation of the official homepage design with exact card layouts.
 */
get_header();

$theme_img_uri = get_template_directory_uri() . '/assets/images/';
$shop_url      = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
$cart_url      = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');

$cat_toles_url       = get_term_link('toles-et-toiture', 'product_cat');
$cat_accessoires_url = get_term_link('accessoires-toiture', 'product_cat');
$cat_fixations_url   = get_term_link('fixations-et-etancheite', 'product_cat');
$cat_interieurs_url  = get_term_link('accessoires-interieurs', 'product_cat');

if (is_wp_error($cat_toles_url))       $cat_toles_url = $shop_url;
if (is_wp_error($cat_accessoires_url)) $cat_accessoires_url = $shop_url;
if (is_wp_error($cat_fixations_url))   $cat_fixations_url = $shop_url;
if (is_wp_error($cat_interieurs_url))  $cat_interieurs_url = $shop_url;

$catalog_pdf_url = content_url('/uploads/catalogue-general-tpm-sa-2026.pdf');

// Structured grouped products for the Flash Pro-Forma Form
$flash_groups = function_exists('tpm_get_flash_proforma_groups') ? tpm_get_flash_proforma_groups() : [];
?>

<main id="primary" class="site-main flex-grow bg-slate-50 font-sans">

    <!-- ═══════════════════════════════════════════════════════════
         1. HERO SECTION & FLASH PRO-FORMA EXPRESS
         ═══════════════════════════════════════════════════════════ -->
    <section class="relative bg-tpm-slate text-white py-14 lg:py-20 overflow-hidden" data-purpose="hero-section">
        <!-- Background Image with Slightly Reduced Color Overlay Opacity -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo esc_url($theme_img_uri . 'green_2.jpg'); ?>" 
                 alt="TPM SA Complexe Industriel" 
                 class="w-full h-full object-cover opacity-55"/>
            <div class="absolute inset-0 bg-gradient-to-r from-tpm-navy/80 via-tpm-navy/70 to-tpm-navy/60"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
                
                <!-- Left Column: Headlines & Metrics -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Badge -->
                    <div class="inline-flex items-center px-3.5 py-1 rounded-full bg-tpm-orange/20 border border-tpm-orange/40 text-tpm-orange font-bold text-[11px] uppercase tracking-wider">
                        USINE MÉTALLURGIQUE &amp; PLASTURGIE CAMEROUN
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight uppercase tracking-tight">
                        LE LEADER DE LA MÉTALLURGIE &amp; DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.
                    </h1>

                    <!-- Paragraph -->
                    <p class="text-sm sm:text-base text-gray-300 max-w-2xl font-normal leading-relaxed">
                        Depuis 1976, <strong>TPM SA</strong> fabrique et approvisionne les plus grands chantiers BTP, quincailleries et entreprises du Cameroun et de la zone CEMAC en <strong class="text-white">Tôles BAC prélaquées 0.50mm</strong>, accessoires de toiture, <strong class="text-white">Sacs PP tissés</strong> et carrelage.
                    </p>

                    <!-- 3 Stat Metrics -->
                    <div class="grid grid-cols-3 gap-3 pt-2">
                        <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-3.5 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-tpm-orange tracking-tight">50 ANS</div>
                            <div class="text-[11px] text-gray-300 font-semibold uppercase mt-0.5">Tradition 1976-2026</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-3.5 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">2 SITES</div>
                            <div class="text-[11px] text-gray-300 font-semibold uppercase mt-0.5">PK12 &amp; Bekoko Douala</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-3.5 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">100% NC</div>
                            <div class="text-[11px] text-gray-300 font-semibold uppercase mt-0.5">Conformité CEMAC</div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="<?php echo esc_url($shop_url); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-6 py-3 rounded-lg text-xs uppercase tracking-wider shadow-lg flex items-center gap-2 transition-all transform hover:-translate-y-0.5">
                            <span class="material-symbols-outlined text-[18px]">inventory_2</span>
                            <span>Explorer le Catalogue Officiel</span>
                        </a>
                        <a href="<?php echo esc_url( home_url('/contact/') ); ?>" 
                           class="bg-white/10 hover:bg-white/20 border border-white/25 text-white font-bold px-6 py-3 rounded-lg text-xs uppercase tracking-wider shadow transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">location_on</span>
                            <span>Localiser l'Usine Bekoko</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: FLASH PRO-FORMA EXPRESS CARD -->
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-2xl p-6 sm:p-7 shadow-2xl border border-gray-100 text-gray-900 relative">
                        
                        <!-- Header -->
                        <div class="flex items-start justify-between gap-2 border-b border-gray-100 pb-4 mb-5">
                            <div>
                                <div class="flex items-center gap-1.5 text-tpm-orange font-black text-xs uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-[18px]">bolt</span>
                                    <span>FLASH PRO-FORMA EXPRESS</span>
                                </div>
                                <p class="text-[11px] text-gray-500 font-medium mt-0.5">Ajustement immédiat des devis usine en 2 min</p>
                            </div>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping mt-1"></span>
                        </div>

                        <!-- Form -->
                        <form id="flash-proforma-form" action="<?php echo esc_url($cart_url); ?>" method="get" class="space-y-4">
                            
                            <!-- Article Select -->
                            <div class="space-y-1">
                                <label class="block text-[11px] font-extrabold uppercase text-gray-700">
                                    SÉLECTIONNER UN ARTICLE DU CATALOGUE <span class="text-tpm-orange">*</span>
                                </label>
                                <select id="flash-product-select" name="add-to-cart" class="w-full text-xs font-bold text-tpm-navy bg-slate-50 border border-gray-300 rounded-lg px-3 py-2.5 outline-none focus:ring-2 focus:ring-tpm-orange transition cursor-pointer">
                                    <?php if (!empty($flash_groups)): ?>
                                        <?php foreach ($flash_groups as $group): ?>
                                            <optgroup label="<?php echo esc_attr($group['label']); ?>" class="font-extrabold text-tpm-navy bg-slate-100 py-1">
                                                <?php foreach ($group['products'] as $p): ?>
                                                    <option value="<?php echo esc_attr($p['id']); ?>" 
                                                            data-price="<?php echo esc_attr($p['price']); ?>"
                                                            data-unit="<?php echo esc_attr($p['unit']); ?>"
                                                            data-sku="<?php echo esc_attr($p['sku']); ?>"
                                                            data-length-label="<?php echo esc_attr($p['details']['length_label']); ?>"
                                                            data-color-label="<?php echo esc_attr($p['details']['color_label']); ?>"
                                                            data-lengths="<?php echo esc_attr(json_encode($p['details']['lengths'], JSON_UNESCAPED_UNICODE)); ?>"
                                                            data-colors="<?php echo esc_attr(json_encode($p['details']['colors'], JSON_UNESCAPED_UNICODE)); ?>"
                                                            class="font-medium text-gray-900 bg-white py-1">
                                                        <?php echo esc_html($p['name']); ?> — <?php echo number_format((float)$p['price'], 0, ',', ' '); ?> FCFA HT
                                                    </option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="16" data-price="2600" data-unit="mètre linéaire" data-sku="TOL-001">Tôle Bac Alu 4N ET 5N — 2 600 FCFA HT</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- List Box 2 (Format / Longueur) & List Box 3 (Finition / Couleur) -->
                            <div class="grid grid-cols-2 gap-3">
                                <div class="space-y-1">
                                    <label id="flash-length-label" class="block text-[10px] font-extrabold uppercase text-gray-700 truncate">
                                        LONGUEUR / FORMAT
                                    </label>
                                    <select id="flash-length-select" name="flash_length" class="w-full text-xs bg-slate-50 border border-gray-300 rounded-lg px-2.5 py-2 outline-none focus:ring-2 focus:ring-tpm-orange transition font-semibold text-gray-800 cursor-pointer">
                                        <!-- Dynamically generated to match selected product -->
                                    </select>
                                </div>
                                <div class="space-y-1">
                                    <label id="flash-color-label" class="block text-[10px] font-extrabold uppercase text-gray-700 truncate">
                                        COULEUR RAL / FINITION
                                    </label>
                                    <select id="flash-color-select" name="flash_color" class="w-full text-xs bg-slate-50 border border-gray-300 rounded-lg px-2.5 py-2 outline-none focus:ring-2 focus:ring-tpm-orange transition font-semibold text-gray-800 cursor-pointer">
                                        <!-- Dynamically generated to match selected product -->
                                    </select>
                                </div>
                            </div>

                            <!-- Quantité & Unité -->
                            <div class="space-y-1">
                                <label class="block text-[10px] font-extrabold uppercase text-gray-700">
                                    QUANTITÉ À COMMANDER <span class="text-tpm-orange">*</span>
                                </label>
                                <div class="flex items-center gap-2">
                                    <input type="number" id="flash-quantity-input" name="quantity" value="10" min="1" class="w-24 text-xs font-bold text-center bg-slate-50 border border-gray-300 rounded-lg py-2 outline-none focus:ring-2 focus:ring-tpm-orange"/>
                                    <span id="flash-unit-label" class="text-xs text-gray-500 font-medium">mètres linéaires</span>
                                </div>
                            </div>

                            <!-- Estimation HT Price Box -->
                            <div class="bg-slate-50 p-3 rounded-xl border border-gray-200 flex justify-between items-center">
                                <div>
                                    <div class="text-[10px] uppercase font-bold text-gray-500">Estimation HT (Hors taxes) :</div>
                                    <div class="text-[10px] text-gray-400 font-medium">+ TVA 19.25% calculée au panier</div>
                                </div>
                                <div class="text-right">
                                    <span id="flash-total-display" class="text-lg sm:text-xl font-black text-tpm-orange">58 000</span>
                                    <span class="text-xs font-bold text-tpm-navy ml-1">XAF</span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-extrabold py-3 px-4 rounded-lg uppercase tracking-wider text-xs transition-colors flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                                <span>Ajouter au Panier Pro-Forma</span>
                            </button>

                            <div class="text-center">
                                <a href="<?php echo esc_url($cart_url); ?>" class="text-[11px] text-gray-500 hover:text-tpm-orange font-semibold transition-colors underline">
                                    Voir mon devis pro-forma en cours
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         2. PÔLES DE PRODUCTION : LES 4 DOMAINES INDUSTRIELS TPM SA
         ═══════════════════════════════════════════════════════════ -->
    <section class="py-16 md:py-24 bg-white border-b border-gray-200" id="domaines">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div class="space-y-2">
                    <span class="text-xs md:text-sm font-bold text-tpm-orange uppercase tracking-wider block">
                        PÔLES DE PRODUCTION TPM SA
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-tpm-navy uppercase tracking-tight">
                        Nos 4 Domaines d'Activité Industrielle
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-gray-500 max-w-md md:text-right leading-relaxed font-medium">
                    Fabrication directe sur nos sites de Bekoko et PK12 selon les normes de solidité les plus strictes au Cameroun.
                </p>
            </div>

            <!-- Grid of 4 Domain Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Pôle 1: Tôles & Couvertures BAC -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/11] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_cat_toles.jfif'); ?>" 
                                 alt="Tôles et toiture" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°1 • 10 RÉF.
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Tôles et toiture
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                                Tôles BAC aluminium prélaqué 0.50mm, profilage ondulé, nervuré D50/B30 et découpes sur mesure selon nuancier RAL.
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($cat_toles_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1 shadow-sm">
                            <span>Voir les 10 Tôles Bacs</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>
                </div>

                <!-- Pôle 2: Accessoires de Toiture -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/11] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_cat_accessoires.jfif'); ?>" 
                                 alt="Accessoires toiture" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°2 • 24 RÉF.
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Accessoires toiture
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                                Faîtières crantées double pente, faîtières non crantées, rives alu, gouttières étanches et noues façonnées en atelier.
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($cat_accessoires_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1 shadow-sm">
                            <span>Voir les 24 Accessoires</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>
                </div>

                <!-- Pôle 3: Fixations et Étanchéité -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/11] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_cat_fixations.jfif'); ?>" 
                                 alt="Fixations et étanchéité" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°3 • 10 RÉF.
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Fixations et étanchéité
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                                Tirefonds complets 6x80/6x100, cavaliers alu néoprène, rouleaux bitumés Toiturole 900G et vis auto-foreuses zinguées.
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($cat_fixations_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1 shadow-sm">
                            <span>Voir les 10 Fixations</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>
                </div>

                <!-- Pôle 4: Accessoires Intérieurs & Plasturgie -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/11] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_cat_interieurs.jfif'); ?>" 
                                 alt="Accessoires intérieurs" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°4 • 22 RÉF.
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Accessoires intérieurs
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                                Sacs PP tissés 50kg/25kg usine Bekoko, carrelages grès cérame italien/espagnol, douches sanitaires et second œuvre.
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($cat_interieurs_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1 shadow-sm">
                            <span>Voir les 22 Articles</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         3. INVENTAIRE DIRECT USINE : ARTICLES PHARES DISPONIBLE EN STOCK
         ═══════════════════════════════════════════════════════════ -->
    <section class="py-16 md:py-24 bg-slate-50" id="articles-phares">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-tpm-orange uppercase tracking-wider block">
                        INVENTAIRE DIRECT USINE
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-tpm-navy tracking-tight">
                        Articles Phares Disponible en Stock
                    </h2>
                </div>
                <a href="<?php echo esc_url($shop_url); ?>" class="text-xs font-bold text-tpm-orange hover:text-orange-700 flex items-center gap-1 transition-colors">
                    <span>Consulter les 58 références usine TPM</span>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                </a>
            </div>

            <!-- Grid of 6 Featured Product Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Product 1: Tôle BAC Prélaquée 0.50mm - Bordeau -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Top Image Box with Floating Tags -->
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_prod_tole_bordeau.jfif'); ?>" 
                                 alt="Tôle BAC Prélaquée 0.50mm – Bordeau" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover"/>
                            <span class="absolute top-2.5 left-2.5 bg-tpm-navy text-white text-[9px] font-bold px-2 py-0.5 rounded shadow">
                                Tôle Aluminium
                            </span>
                            <span class="absolute top-2.5 right-2.5 bg-emerald-50 text-emerald-800 border border-emerald-200 text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                En Stock Usine
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 space-y-3">
                            <div class="font-mono text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                REF: TPM-TOL-ALU-035
                            </div>
                            <h3 class="text-sm sm:text-base font-black text-tpm-navy leading-snug">
                                <a href="<?php echo esc_url( home_url('/product/toles-bacs-ou-ondulees-alu-5-10e-prelaquees/') ); ?>" class="hover:text-tpm-orange transition-colors">
                                    Tôle BAC Prélaquée 0.50mm – Bordeau
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                Tôle BAC profilée en acier galvanisé prélaqué haute durabilité 0.50mm selon nuancier officiel RAL 3005, ondulée BTP et calepinée.
                            </p>

                            <!-- Specs Box -->
                            <div class="bg-slate-50 p-2.5 rounded-lg border border-gray-100 flex justify-between text-[11px] font-semibold text-gray-600">
                                <span>Dispo : <strong>Usine Bekoko</strong></span>
                                <span class="text-tpm-orange">Tarif HT / m linéaire</span>
                            </div>
                        </div>
                    </div>

                    <!-- Price & Action Row -->
                    <div class="p-5 pt-0 border-t border-gray-100 flex items-center justify-between mt-2 pt-3">
                        <div class="whitespace-nowrap">
                            <span class="text-base sm:text-lg font-black text-tpm-orange whitespace-nowrap">5&nbsp;800&nbsp;XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium uppercase mt-0.5">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[0]->ID ?? 16); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors whitespace-nowrap shrink-0">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 2: Tôle BAC Prélaquée 0.50mm - Bleu Cendre -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_prod_tole_bleu.jfif'); ?>" 
                                 alt="Tôle BAC Prélaquée 0.50mm – Bleu Cendre" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover"/>
                            <span class="absolute top-2.5 left-2.5 bg-tpm-navy text-white text-[9px] font-bold px-2 py-0.5 rounded shadow">
                                Profilage D50
                            </span>
                            <span class="absolute top-2.5 right-2.5 bg-emerald-50 text-emerald-800 border border-emerald-200 text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                En Stock Usine
                            </span>
                        </div>

                        <div class="p-5 space-y-3">
                            <div class="font-mono text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                REF: TPM-TOL-D50-PREL
                            </div>
                            <h3 class="text-sm sm:text-base font-black text-tpm-navy leading-snug">
                                <a href="<?php echo esc_url( home_url('/product/toles-bacs-prelaquees-d50/') ); ?>" class="hover:text-tpm-orange transition-colors">
                                    Tôle BAC Prélaquée 0.50mm – Bleu Cendre
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                Tôle BAC 0.50mm nervures D50 Confort thermique, haute résistance marine, profilée 5 ondes renforcée pour entrepôts et habitations.
                            </p>

                            <div class="bg-slate-50 p-2.5 rounded-lg border border-gray-100 flex justify-between text-[11px] font-semibold text-gray-600">
                                <span>Dispo : <strong>Usine Bekoko</strong></span>
                                <span class="text-tpm-orange">Tarif HT / m linéaire</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 pt-0 border-t border-gray-100 flex items-center justify-between mt-2 pt-3">
                        <div class="whitespace-nowrap">
                            <span class="text-base sm:text-lg font-black text-tpm-orange whitespace-nowrap">5&nbsp;800&nbsp;XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium uppercase mt-0.5">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[1]->ID ?? 24); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors whitespace-nowrap shrink-0">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 3: Faîtière à Bord Rabattu 0.50mm -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_prod_faitiere.jfif'); ?>" 
                                 alt="Faîtière à Bord Rabattu 0.50mm" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover"/>
                            <span class="absolute top-2.5 left-2.5 bg-tpm-navy text-white text-[9px] font-bold px-2 py-0.5 rounded shadow">
                                Accessoires faîtage ondulé
                            </span>
                            <span class="absolute top-2.5 right-2.5 bg-emerald-50 text-emerald-800 border border-emerald-200 text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                En Stock Usine
                            </span>
                        </div>

                        <div class="p-5 space-y-3">
                            <div class="font-mono text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                REF: TPM-ACC-FAI-050
                            </div>
                            <h3 class="text-sm sm:text-base font-black text-tpm-navy leading-snug">
                                <a href="<?php echo esc_url( home_url('/product/faitiere-non-crantee-double-pente-0-35-0-33-nature/') ); ?>" class="hover:text-tpm-orange transition-colors">
                                    Faîtière à Bord Rabattu 0.50mm (Longueur 2.00m)
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                Faîtière de couronnement double pente alu et prélaquée haute précision, replis anti-goutte étanches et profilage 2 mètres pour toitures.
                            </p>

                            <div class="bg-slate-50 p-2.5 rounded-lg border border-gray-100 flex justify-between text-[11px] font-semibold text-gray-600">
                                <span>Dispo : <strong>PK12 &amp; Bekoko</strong></span>
                                <span class="text-tpm-orange">Tarif HT / Pièce 2m</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 pt-0 border-t border-gray-100 flex items-center justify-between mt-2 pt-3">
                        <div class="whitespace-nowrap">
                            <span class="text-base sm:text-lg font-black text-tpm-orange whitespace-nowrap">4&nbsp;500&nbsp;XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium uppercase mt-0.5">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[2]->ID ?? 25); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors whitespace-nowrap shrink-0">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 4: Fixations Complètes 6x80mm -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_prod_fixations.jfif'); ?>" 
                                 alt="Fixations Complètes 6x80mm" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover"/>
                            <span class="absolute top-2.5 left-2.5 bg-tpm-navy text-white text-[9px] font-bold px-2 py-0.5 rounded shadow">
                                Fixations et outillage BTP
                            </span>
                            <span class="absolute top-2.5 right-2.5 bg-emerald-50 text-emerald-800 border border-emerald-200 text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                En Stock Usine
                            </span>
                        </div>

                        <div class="p-5 space-y-3">
                            <div class="font-mono text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                REF: TPM-FIX-TIR-680
                            </div>
                            <h3 class="text-sm sm:text-base font-black text-tpm-navy leading-snug">
                                <a href="<?php echo esc_url( home_url('/product/tirefond-6x80-paquet-72-pcs/') ); ?>" class="hover:text-tpm-orange transition-colors">
                                    Fixations Complètes 6x80mm avec Rondelles néoprène (Boîte 100 pcs)
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                Tirefonds complets comprenant vis auto-foreuse haute charge 6x80mm zinguée avec cavaliers aluminium et rondelles d'étanchéité EPDM.
                            </p>

                            <div class="bg-slate-50 p-2.5 rounded-lg border border-gray-100 flex justify-between text-[11px] font-semibold text-gray-600">
                                <span>Dispo : <strong>PK12</strong></span>
                                <span class="text-tpm-orange">Tarif HT / Boîte 100 pcs</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 pt-0 border-t border-gray-100 flex items-center justify-between mt-2 pt-3">
                        <div class="whitespace-nowrap">
                            <span class="text-base sm:text-lg font-black text-tpm-orange whitespace-nowrap">12&nbsp;500&nbsp;XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium uppercase mt-0.5">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[3]->ID ?? 21); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors whitespace-nowrap shrink-0">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 5: Joint Bitumé Étanchéité 10M -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_prod_joint.jfif'); ?>" 
                                 alt="Joint Bitumé Étanchéité 10M" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover"/>
                            <span class="absolute top-2.5 left-2.5 bg-tpm-navy text-white text-[9px] font-bold px-2 py-0.5 rounded shadow">
                                Bandes &amp; Étanchéité BTP
                            </span>
                            <span class="absolute top-2.5 right-2.5 bg-emerald-50 text-emerald-800 border border-emerald-200 text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                En Stock Usine
                            </span>
                        </div>

                        <div class="p-5 space-y-3">
                            <div class="font-mono text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                REF: TPM-FIX-BIT-10M
                            </div>
                            <h3 class="text-sm sm:text-base font-black text-tpm-navy leading-snug">
                                <a href="<?php echo esc_url( home_url('/product/toiturole-900g/') ); ?>" class="hover:text-tpm-orange transition-colors">
                                    Joint Bitumé Étanchéité 10M (Rouleau 10m x 20cm)
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                Bande bitumineuse adhésive renforcée aluminium pour solins de toiture, arêtes de faîtage et joints d'étanchéité haute température.
                            </p>

                            <div class="bg-slate-50 p-2.5 rounded-lg border border-gray-100 flex justify-between text-[11px] font-semibold text-gray-600">
                                <span>Dispo : <strong>Usine Bekoko</strong></span>
                                <span class="text-tpm-orange">Tarif HT / Rouleau 10m</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 pt-0 border-t border-gray-100 flex items-center justify-between mt-2 pt-3">
                        <div class="whitespace-nowrap">
                            <span class="text-base sm:text-lg font-black text-tpm-orange whitespace-nowrap">8&nbsp;500&nbsp;XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium uppercase mt-0.5">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[4]->ID ?? 22); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors whitespace-nowrap shrink-0">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 6: Sacs PP Blancs Tissés 50kg -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'accueil_prod_sacs.jfif'); ?>" 
                                 alt="Sacs PP Blancs Tissés 50kg" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover"/>
                            <span class="absolute top-2.5 left-2.5 bg-tpm-navy text-white text-[9px] font-bold px-2 py-0.5 rounded shadow">
                                Fabrique de Sacs
                            </span>
                            <span class="absolute top-2.5 right-2.5 bg-emerald-50 text-emerald-800 border border-emerald-200 text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                En Stock Usine
                            </span>
                        </div>

                        <div class="p-5 space-y-3">
                            <div class="font-mono text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                REF: TPM-INT-SAC-PP50
                            </div>
                            <h3 class="text-sm sm:text-base font-black text-tpm-navy leading-snug">
                                <a href="<?php echo esc_url( home_url('/product/cartons-carreaux-sol-60x60-italien/') ); ?>" class="hover:text-tpm-orange transition-colors">
                                    Sacs PP Blancs Tissés 50kg (Lot de 500 Sacs Usine Bekoko)
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                Sacs en Polypropylène (PP) tissé ultra-résistants pour emballage de ciment, sable, gravier, produits agricoles et agro-industriels 50kg.
                            </p>

                            <div class="bg-slate-50 p-2.5 rounded-lg border border-gray-100 flex justify-between text-[11px] font-semibold text-gray-600">
                                <span>Dispo : <strong>Usine Bekoko</strong></span>
                                <span class="text-tpm-orange">Tarif HT / Lot 500 pcs</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 pt-0 border-t border-gray-100 flex items-center justify-between mt-2 pt-3">
                        <div class="whitespace-nowrap">
                            <span class="text-base sm:text-lg font-black text-tpm-orange whitespace-nowrap">62&nbsp;500&nbsp;XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium uppercase mt-0.5">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[5]->ID ?? 23); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors whitespace-nowrap shrink-0">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         4. ORANGE COMMERCIAL CTA BANNER : COMMANDE VOLUMINEUSE
         ═══════════════════════════════════════════════════════════ -->
    <section class="relative bg-tpm-orange text-white py-14 md:py-18 overflow-hidden">
        <!-- Background Image with Real TPM Workshop Coils & Gantry Crane -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="<?php echo esc_url($theme_img_uri . 'bg_tpm_crane_coils.jpg'); ?>" 
                 alt="Usine TPM SA Stock de Bobines & Portique" 
                 class="w-full h-full object-cover opacity-20 mix-blend-luminosity"/>
            <div class="absolute inset-0 bg-gradient-to-r from-tpm-orange/95 via-tpm-orange/90 to-orange-700/90"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                
                <div class="space-y-3 text-center lg:text-left max-w-3xl">
                    <span class="inline-block bg-white/20 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full tracking-wider">
                        SERVICE COMMERCIAL USINE &amp; BTP
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white leading-tight">
                        Besoin d'un devis sur-mesure ou d'une commande volumineuse ?
                    </h2>
                    <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                        Profilage de tôles BAC à la longueur exacte de votre chantier, emballages PP personnalisés et tarification dégressive pour quincailleries &amp; entreprises BTP au Cameroun.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 shrink-0 justify-center">
                    <a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" 
                       class="bg-tpm-navy hover:bg-slate-900 text-white font-black px-6 py-3.5 rounded-lg text-xs uppercase tracking-wider shadow-xl transition-all transform hover:-translate-y-0.5">
                        Demander un Devis Sur-Mesure
                    </a>
                    <a href="<?php echo esc_url( home_url('/contact/') ); ?>" 
                       class="bg-white hover:bg-slate-100 text-tpm-navy font-black px-6 py-3.5 rounded-lg text-xs uppercase tracking-wider shadow-xl transition-all transform hover:-translate-y-0.5">
                        Contacter l'Usine (Bekoko / PK12)
                    </a>
                </div>

            </div>
        </div>
    </section>

</main>

<script>
(function() {
    // Dynamic Flash Pro-Forma Synchronizer
    const productSelect = document.getElementById('flash-product-select');
    const lengthSelect  = document.getElementById('flash-length-select');
    const colorSelect   = document.getElementById('flash-color-select');
    const lengthLabel   = document.getElementById('flash-length-label');
    const colorLabel    = document.getElementById('flash-color-label');
    const qtyInput      = document.getElementById('flash-quantity-input');
    const totalDisplay  = document.getElementById('flash-total-display');
    const unitLabel     = document.getElementById('flash-unit-label');

    function updateFlashProductDetails() {
        if (!productSelect) return;
        const opt = productSelect.options[productSelect.selectedIndex];
        if (!opt) return;

        // 1. Update List Box 2 Label & Options (Format / Longueur / Dimension)
        const lengthLabelText = opt.getAttribute('data-length-label') || 'LONGUEUR / FORMAT';
        if (lengthLabel) lengthLabel.textContent = lengthLabelText;

        if (lengthSelect) {
            lengthSelect.innerHTML = '';
            let lengths = [];
            try {
                lengths = JSON.parse(opt.getAttribute('data-lengths') || '[]');
            } catch (e) {
                lengths = ['Standard Usine'];
            }
            if (!lengths || !lengths.length) lengths = ['Standard Usine'];

            lengths.forEach(function(val) {
                const el = document.createElement('option');
                el.value = val;
                el.textContent = val;
                lengthSelect.appendChild(el);
            });
        }

        // 2. Update List Box 3 Label & Options (Finition / Couleur RAL / Matière)
        const colorLabelText = opt.getAttribute('data-color-label') || 'COULEUR RAL / FINITION';
        if (colorLabel) colorLabel.textContent = colorLabelText;

        if (colorSelect) {
            colorSelect.innerHTML = '';
            let colors = [];
            try {
                colors = JSON.parse(opt.getAttribute('data-colors') || '[]');
            } catch (e) {
                colors = ['Standard Usine'];
            }
            if (!colors || !colors.length) colors = ['Standard Usine'];

            colors.forEach(function(val) {
                const el = document.createElement('option');
                el.value = val;
                el.textContent = val;
                colorSelect.appendChild(el);
            });
        }

        // 3. Update Price and Unit Label
        updateFlashPrice();
    }

    function updateFlashPrice() {
        if (!productSelect || !qtyInput || !totalDisplay) return;
        const opt = productSelect.options[productSelect.selectedIndex];
        if (!opt) return;

        const price = parseFloat(opt.getAttribute('data-price')) || 0;
        const unit  = opt.getAttribute('data-unit') || 'unités';
        const qty   = parseInt(qtyInput.value, 10) || 1;

        const total = price * qty;
        totalDisplay.textContent = total.toLocaleString('fr-FR');
        if (unitLabel) unitLabel.textContent = unit;
    }

    if (productSelect) productSelect.addEventListener('change', updateFlashProductDetails);
    if (qtyInput) qtyInput.addEventListener('input', updateFlashPrice);

    // Initial run on DOM load
    if (productSelect) {
        updateFlashProductDetails();
    }
})();
</script>

<?php get_footer(); ?>
