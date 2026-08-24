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

// WooCommerce products for the Flash Pro-Forma Form
$woo_products = [];
if (class_exists('WooCommerce')) {
    $woo_products = wc_get_products(['status' => 'publish', 'limit' => -1]);
}
?>

<main id="primary" class="site-main flex-grow bg-slate-50 font-sans">

    <!-- ═══════════════════════════════════════════════════════════
         1. HERO SECTION & FLASH PRO-FORMA EXPRESS
         ═══════════════════════════════════════════════════════════ -->
    <section class="relative bg-tpm-slate text-white py-14 lg:py-20 overflow-hidden" data-purpose="hero-section">
        <!-- Background Image with High-Tech Dark Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo esc_url($theme_img_uri . 'hero_bg.jpg'); ?>" 
                 alt="TPM SA Usine de Production" 
                 class="w-full h-full object-cover opacity-25"/>
            <div class="absolute inset-0 bg-gradient-to-r from-tpm-navy/95 via-tpm-navy/90 to-tpm-navy/80"></div>
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
                                    SÉLECTIONNER UN ARTICLE <span class="text-tpm-orange">*</span>
                                </label>
                                <select id="flash-product-select" name="add-to-cart" class="w-full text-xs font-bold text-tpm-navy bg-slate-50 border border-gray-300 rounded-lg px-3 py-2.5 outline-none focus:ring-2 focus:ring-tpm-orange transition">
                                    <?php if (!empty($woo_products)): ?>
                                        <?php foreach ($woo_products as $p): ?>
                                            <option value="<?php echo esc_attr($p->get_id()); ?>" 
                                                    data-price="<?php echo esc_attr($p->get_price()); ?>"
                                                    data-unit="<?php echo esc_attr(get_post_meta($p->get_id(), '_unit', true) ?: 'unité'); ?>"
                                                    <?php echo (stripos($p->get_name(), '0,35') !== false || stripos($p->get_name(), '5/10') !== false) ? 'selected' : ''; ?>>
                                                <?php echo esc_html($p->get_name()); ?> (<?php echo number_format($p->get_price(), 0, ',', ' '); ?> XAF)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="1" data-price="5800" data-unit="mètre linéaire">Tôle BAC Prélaquée 0.50mm - Bordeau (5 800 XAF HT / mètre linéaire)</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- Longueur & Couleur -->
                            <div class="grid grid-cols-2 gap-3">
                                <div class="space-y-1">
                                    <label class="block text-[10px] font-extrabold uppercase text-gray-700">LONGUEUR / FORMAT</label>
                                    <select name="flash_length" class="w-full text-xs bg-slate-50 border border-gray-300 rounded-lg px-2.5 py-2 outline-none focus:ring-2 focus:ring-tpm-orange transition font-semibold text-gray-800">
                                        <option value="Standard 6.00m">Standard 6.00m</option>
                                        <option value="Sur-mesure 3.00m">Sur-mesure 3.00m</option>
                                        <option value="Sur-mesure 4.00m">Sur-mesure 4.00m</option>
                                        <option value="Sur-mesure 5.00m">Sur-mesure 5.00m</option>
                                        <option value="Sur-mesure 8.00m">Sur-mesure 8.00m</option>
                                        <option value="Sur-mesure 10.00m">Sur-mesure 10.00m</option>
                                    </select>
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[10px] font-extrabold uppercase text-gray-700">COULEUR RAL</label>
                                    <select name="flash_color" class="w-full text-xs bg-slate-50 border border-gray-300 rounded-lg px-2.5 py-2 outline-none focus:ring-2 focus:ring-tpm-orange transition font-semibold text-gray-800">
                                        <option value="Bordeau RAL 3005">Bordeau RAL 3005</option>
                                        <option value="Bleu Cendre RAL 5014">Bleu Cendre RAL 5014</option>
                                        <option value="Orange Terracotta">Orange Terracotta</option>
                                        <option value="Vert Olive">Vert Olive</option>
                                        <option value="Alu Naturel">Alu Naturel (Brut)</option>
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
         2. PÔLES DE PRODUCTION : 6 DOMAINES D'ACTIVITÉ INDUSTRIELLE
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
                        Nos 6 Domaines d'Activité Industrielle
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-gray-500 max-w-md md:text-right leading-relaxed font-medium">
                    Fabrication directe sur nos sites de Bekoko et PK12 selon les normes de solidité les plus strictes au Cameroun.
                </p>
            </div>

            <!-- Grid of 6 Domain Cards (2 rows of 3) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Pôle 1: Tôles & Couvertures BAC -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'pole1_toles.jpg'); ?>" 
                                 alt="Tôles &amp; Couvertures BAC" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°1
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base sm:text-lg font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Tôles &amp; Couvertures BAC
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                                Tôles BAC aluminium prélaqué, ondulées, tous coloris (RAL 3005, Rouge, Vert Olive, Alu brillant) et découpes sur mesure.
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($cat_toles_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1">
                            <span>Voir les Tôles Bacs</span>
                        </a>
                    </div>
                </div>

                <!-- Pôle 2: Accessoires de Toiture & Pliage -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'pole2_accessoires.jpg'); ?>" 
                                 alt="Accessoires de Toiture &amp; Pliage" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°2
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base sm:text-lg font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Accessoires de Toiture &amp; Pliage
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                                Faîtières double pente, faîtières crantées, demi-rives, rives, gouttières et noues sur-mesure.
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($cat_accessoires_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1">
                            <span>Voir les Accessoires</span>
                        </a>
                    </div>
                </div>

                <!-- Pôle 3: Fixations & Étanchéité -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'pole3_fixations.jpg'); ?>" 
                                 alt="Fixations &amp; Étanchéité" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°3
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base sm:text-lg font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Fixations &amp; Étanchéité
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                                Fixations complètes à tirefonds, cavaliers étanches, rouleaux bitumés Toiturole 900G et vis auto-foreuses.
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($cat_fixations_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1">
                            <span>Voir les Fixations</span>
                        </a>
                    </div>
                </div>

                <!-- Pôle 4: Emballages PP Bekoko -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'pole4_sacs.jpg'); ?>" 
                                 alt="Emballages PP Bekoko" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°4
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base sm:text-lg font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Emballages PP Bekoko
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                                Gamme d'emballages en sacs tissés en PP (50kg, 25kg, ciment, agroalimentaire et industrie).
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($cat_interieurs_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1">
                            <span>Voir les Sacs PP Bekoko</span>
                        </a>
                    </div>
                </div>

                <!-- Pôle 5: Carreaux & Revêtements -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'pole6_carreaux.jpg'); ?>" 
                                 alt="Carreaux &amp; Revêtements" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°5
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base sm:text-lg font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Carreaux &amp; Revêtements
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                                Carrelage grès cérame italien et espagnol pour sols et murs, douches thérapeutiques Zagonel.
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($cat_interieurs_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1">
                            <span>Voir les Carreaux &amp; Sols</span>
                        </a>
                    </div>
                </div>

                <!-- Pôle 6: Quincaillerie & Outillage BTP -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="<?php echo esc_url($theme_img_uri . 'pole5_prestations.jpg'); ?>" 
                                 alt="Quincaillerie &amp; Outillage BTP" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                            <span class="absolute top-3 left-3 bg-tpm-navy/90 backdrop-blur-sm text-white font-black text-[10px] px-2.5 py-1 rounded shadow uppercase tracking-wider">
                                PÔLE N°6
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-base sm:text-lg font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Quincaillerie &amp; Outillage BTP
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                                Prestations industrielles d'électro-zingage 800 VA, outillage de couverture, quincaillerie lourde et chantiers BTP.
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?php echo esc_url($shop_url); ?>" 
                           class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-1">
                            <span>Voir la Quincaillerie</span>
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
                            <img src="<?php echo esc_url($theme_img_uri . 'prod1_tole.jpg'); ?>" 
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
                        <div>
                            <span class="text-lg font-black text-tpm-orange">5 800 XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[0]->get_id() ?? 1); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 2: Tôle BAC Prélaquée 0.50mm - Bleu Cendre -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'project2.jpg'); ?>" 
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
                        <div>
                            <span class="text-lg font-black text-tpm-orange">5 800 XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[1]->get_id() ?? 2); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 3: Faîtière à Bord Rabattu 0.50mm -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'prod3_faitiere.jpg'); ?>" 
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
                        <div>
                            <span class="text-lg font-black text-tpm-orange">4 500 XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[2]->get_id() ?? 3); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 4: Fixations Complètes 6x80mm -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'prod2_fixation.jpg'); ?>" 
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
                        <div>
                            <span class="text-lg font-black text-tpm-orange">12 500 XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[3]->get_id() ?? 4); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 5: Joint Bitumé Étanchéité 10M -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'prod5_joint.jpg'); ?>" 
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
                        <div>
                            <span class="text-lg font-black text-tpm-orange">8 500 XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[4]->get_id() ?? 5); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors">
                            <span class="material-symbols-outlined text-[15px]">add</span>
                            <span>+ Pro-Forma</span>
                        </a>
                    </div>
                </div>

                <!-- Product 6: Sacs PP Blancs Tissés 50kg -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'prod4_sac.jpg'); ?>" 
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
                        <div>
                            <span class="text-lg font-black text-tpm-orange">62 500 XAF</span>
                            <span class="text-[9px] text-gray-400 block font-medium">+ TVA 19.25%</span>
                        </div>
                        <a href="?add-to-cart=<?php echo esc_attr($woo_products[5]->get_id() ?? 6); ?>" 
                           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-3.5 py-2 rounded-lg text-xs flex items-center gap-1 shadow transition-colors">
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
    <section class="bg-tpm-orange text-white py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
    // Dynamic Flash Pro-Forma calculation
    const select = document.getElementById('flash-product-select');
    const qtyInput = document.getElementById('flash-quantity-input');
    const totalDisplay = document.getElementById('flash-total-display');
    const unitLabel = document.getElementById('flash-unit-label');

    function updateFlashPrice() {
        if (!select || !qtyInput || !totalDisplay) return;
        const opt = select.options[select.selectedIndex];
        if (!opt) return;

        const price = parseFloat(opt.getAttribute('data-price')) || 5800;
        const unit = opt.getAttribute('data-unit') || 'mètres linéaires';
        const qty = parseInt(qtyInput.value, 10) || 1;

        const total = price * qty;
        totalDisplay.textContent = total.toLocaleString('fr-FR');
        if (unitLabel) unitLabel.textContent = unit;
    }

    if (select) select.addEventListener('change', updateFlashPrice);
    if (qtyInput) qtyInput.addEventListener('input', updateFlashPrice);
    updateFlashPrice();
})();
</script>

<?php get_footer(); ?>
