<?php
/**
 * front-page.php - TPM SA Theme
 * Faithful implementation of Design/tpm_sa_complete_industrial_body_content/code.html
 * Using local assets for 100% reliability (no broken external links).
 */
get_header();

$theme_img_uri = get_template_directory_uri() . '/assets/images/';
$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
$cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');

$cat_toles_url       = get_term_link('toles-et-toiture', 'product_cat');
$cat_accessoires_url = get_term_link('accessoires-toiture', 'product_cat');
$cat_fixations_url   = get_term_link('fixations-et-etancheite', 'product_cat');
$cat_interieurs_url  = get_term_link('accessoires-interieurs', 'product_cat');

if (is_wp_error($cat_toles_url))       $cat_toles_url = $shop_url;
if (is_wp_error($cat_accessoires_url)) $cat_accessoires_url = $shop_url;
if (is_wp_error($cat_fixations_url))   $cat_fixations_url = $shop_url;
if (is_wp_error($cat_interieurs_url))  $cat_interieurs_url = $shop_url;

// WooCommerce products for the Pro-Forma flash form
$woo_products = [];
if (class_exists('WooCommerce')) {
    $woo_products = wc_get_products(['status' => 'publish', 'limit' => -1]);
}
?>

<!-- ========================================== -->
<!-- PART 1: HERO & METRICS                     -->
<!-- ========================================== -->
<!-- HERO SECTION -->
<section class="relative bg-tpm-slate min-h-[85vh] flex items-center overflow-hidden" data-purpose="hero-section">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img alt="Cinematic factory laser cutting" class="w-full h-full object-cover" src="<?php echo esc_url($theme_img_uri . 'hero_bg.jpg'); ?>"/>
        <div class="absolute inset-0 bg-tpm-navy/80 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-tpm-slate/50"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">
            
            <!-- Left Content -->
            <div class="space-y-8" data-purpose="hero-content">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-tpm-orange/10 border border-tpm-orange/30 text-tpm-orange font-semibold text-sm tracking-wide uppercase">
                    ★ Groupe CAC depuis 1976
                </div>

                <!-- Headlines -->
                <div class="space-y-4">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight uppercase tracking-tight">
                        BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-tpm-orange to-orange-300">AVEC GARANTIE DE DURABILITÉ</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-300 max-w-2xl font-medium leading-relaxed">
                        Leader camerounais dans le profilage d'acier, la fabrication de fixations industrielles, les emballages PP et le zingage unique en Afrique Centrale.
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <a class="inline-flex justify-center items-center px-8 py-4 bg-tpm-orange hover:bg-orange-700 text-white font-bold rounded-lg transition duration-300 shadow-lg shadow-tpm-orange/30" href="<?php echo esc_url($shop_url); ?>">
                        VOIR LE CATALOGUE
                    </a>
                    <a class="inline-flex justify-center items-center px-8 py-4 bg-transparent border-2 border-white text-white hover:bg-white hover:text-tpm-navy font-bold rounded-lg transition duration-300" href="#usine">
                        VISITER L'USINE
                    </a>
                </div>

                <!-- Glassmorphism Form -->
                <div class="mt-8 glass-card rounded-2xl p-6 md:p-8 max-w-lg shadow-2xl" data-purpose="proforma-form">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-tpm-orange rounded-sm inline-block"></span>
                        Demande de Pro-Forma Flash B2B
                    </h3>
                    <form action="<?php echo esc_url($cart_url); ?>" method="POST" class="space-y-4">
                        <?php if (!empty($woo_products)): ?>
                        <div>
                            <label class="block text-xs font-bold text-gray-300 mb-1 uppercase">Sélectionner un Article *</label>
                            <select name="add-to-cart" id="flash-product-id" onchange="updateFlashEstimate()" class="block w-full bg-white/10 border border-white/20 rounded-lg py-3 px-4 text-white focus:ring-2 focus:ring-tpm-orange focus:border-transparent transition [&>option]:text-tpm-navy">
                                <?php foreach ($woo_products as $p): 
                                    $price = $p->get_price();
                                    $unit = $p->get_attribute('unite') ?: 'unité';
                                ?>
                                    <option value="<?php echo esc_attr($p->get_id()); ?>" data-price="<?php echo esc_attr($price); ?>">
                                        <?php echo esc_html($p->get_name()); ?> (<?php echo number_format($price, 0, ',', ' '); ?> XAF HT / <?php echo esc_html($unit); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php else: ?>
                        <div>
                            <input class="block w-full bg-white/10 border border-white/20 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:ring-2 focus:ring-tpm-orange focus:border-transparent transition" name="raison_sociale" placeholder="Raison Sociale (Entreprise)" type="text" required/>
                        </div>
                        <?php endif; ?>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-gray-300 mb-1 uppercase">Longueur / Format</label>
                                <select name="flash-length" class="block w-full bg-white/10 border border-white/20 rounded-lg py-2.5 px-3 text-white text-xs [&>option]:text-tpm-navy">
                                    <option value="Standard">Standard usine</option>
                                    <option value="2.00m">2.00 Mètres</option>
                                    <option value="3.00m">3.00 Mètres</option>
                                    <option value="4.00m">4.00 Mètres</option>
                                    <option value="6.00m">6.00 Mètres</option>
                                    <option value="Sur-mesure">Sur-mesure</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-300 mb-1 uppercase">Couleur RAL</label>
                                <select name="flash-color" class="block w-full bg-white/10 border border-white/20 rounded-lg py-2.5 px-3 text-white text-xs [&>option]:text-tpm-navy">
                                    <option value="Bordeau RAL 3005">Bordeau RAL 3005</option>
                                    <option value="Bleu Cendre">Bleu Cendre</option>
                                    <option value="Orange Terracotta">Orange Terracotta</option>
                                    <option value="Vert Olive">Vert Olive</option>
                                    <option value="Alu Brut">Alu Brut</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-300 mb-1 uppercase">Quantité à commander</label>
                            <input id="flash-qty" oninput="updateFlashEstimate()" class="block w-full bg-white/10 border border-white/20 rounded-lg py-2.5 px-4 text-white placeholder-gray-400 font-mono font-bold focus:ring-2 focus:ring-tpm-orange focus:border-transparent transition" name="quantity" min="1" value="10" type="number"/>
                        </div>

                        <button class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-bold py-3.5 px-4 rounded-lg transition duration-300 shadow-md uppercase tracking-wider flex items-center justify-center gap-2" type="submit">
                            <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                            ENVOYER AU PRO-FORMA
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Content: Showcase Card -->
            <div class="hidden lg:block relative" data-purpose="hero-showcase">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/10 group">
                    <img alt="Stacked steel sheets inside Bekoko Factory" class="w-full h-auto object-cover aspect-[4/5] transform group-hover:scale-105 transition duration-700 ease-in-out" src="<?php echo esc_url($theme_img_uri . 'hero_factory.jpg'); ?>"/>
                    <!-- Gradient Overlay for Badges -->
                    <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy/90 via-transparent to-transparent"></div>
                    <!-- Badges positioned on image -->
                    <div class="absolute bottom-6 left-6 right-6 space-y-3">
                        <div class="bg-tpm-slate/80 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-lg text-white font-semibold flex items-center justify-between">
                            <span>Usine Bekoko</span>
                            <span class="text-tpm-orange">1 500 m²</span>
                        </div>
                        <div class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg text-tpm-navy font-bold flex items-center justify-between">
                            <span>★ Certifié Conforme BTP</span>
                            <span class="text-sm font-medium text-gray-500">Cameroun</span>
                        </div>
                    </div>
                </div>
                <!-- Decorative element -->
                <div class="absolute -z-10 -bottom-6 -right-6 w-full h-full border-2 border-tpm-orange/30 rounded-2xl"></div>
            </div>

        </div>
    </div>
</section>

<!-- METRICS BAR -->
<section class="bg-tpm-slate border-t border-white/10" data-purpose="metrics-bar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div class="bg-tpm-navy rounded-xl p-6 border border-white/5 shadow-lg text-center transform hover:-translate-y-1 transition duration-300">
                <div class="text-3xl md:text-4xl font-extrabold text-tpm-orange mb-2 tracking-tight">1976</div>
                <div class="text-sm md:text-base font-semibold text-white uppercase tracking-wider">50 Ans d'Expertise</div>
            </div>
            <div class="bg-tpm-navy rounded-xl p-6 border border-white/5 shadow-lg text-center transform hover:-translate-y-1 transition duration-300">
                <div class="text-3xl md:text-4xl font-extrabold text-tpm-orange mb-2 tracking-tight">1 500 m²</div>
                <div class="text-sm md:text-base font-semibold text-white uppercase tracking-wider">Usine Bekoko</div>
            </div>
            <div class="bg-tpm-navy rounded-xl p-6 border border-white/5 shadow-lg text-center transform hover:-translate-y-1 transition duration-300">
                <div class="text-3xl md:text-4xl font-extrabold text-tpm-orange mb-2 tracking-tight">800 VA</div>
                <div class="text-sm md:text-base font-semibold text-white uppercase tracking-wider">Zingage Unique</div>
            </div>
            <div class="bg-tpm-navy rounded-xl p-6 border border-white/5 shadow-lg text-center transform hover:-translate-y-1 transition duration-300">
                <div class="text-3xl md:text-4xl font-extrabold text-tpm-orange mb-2 tracking-tight">100%</div>
                <div class="text-sm md:text-base font-semibold text-white uppercase tracking-wider">Local Transformation</div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- PART 2: EXPERTISE & PRODUCTS               -->
<!-- ========================================== -->
<!-- ========================================== -->
<!-- PART 2: CATÉGORIES & PRODUITS              -->
<!-- ========================================== -->
<!-- CATÉGORIES DE PRODUITS SECTION -->
<section class="bg-slate-50 py-16 lg:py-24" data-purpose="categories-section" id="categories">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <h2 class="text-xs md:text-sm font-bold text-tpm-orange tracking-widest uppercase">Gamme Complète &amp; Pôles Industriels</h2>
            <h3 class="text-3xl md:text-4xl font-extrabold text-tpm-navy">Nos Catégories de Produits</h3>
            <p class="text-sm text-gray-600">Explorez les solutions métallurgiques, profilages et matériaux industriels certifiés fabriqués par TPM SA.</p>
            <div class="w-24 h-1.5 bg-tpm-orange mx-auto rounded-full mt-2"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Catégorie 1: Tôles et toiture -->
            <a href="<?php echo esc_url($cat_toles_url); ?>" class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl aspect-[4/5] bg-tpm-navy flex flex-col justify-end transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <img alt="Tôles et toiture" class="absolute inset-0 w-full h-full object-cover opacity-75 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole1_toles.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/60 to-transparent"></div>
                <div class="relative p-6 space-y-2.5 z-10">
                    <span class="inline-block bg-tpm-orange text-white text-[10px] uppercase font-black px-2.5 py-0.5 rounded tracking-wider">Catégorie Principale</span>
                    <h4 class="text-xl font-bold text-white leading-tight group-hover:text-tpm-orange transition-colors">Tôles et toiture</h4>
                    <p class="text-xs text-gray-300 line-clamp-3">Tôles BAC aluminium, prélaquées (RAL 3005, 5014, Terracotta, Vert Olive), ondulées et profilages.</p>
                    <div class="pt-2 flex items-center text-xs font-bold text-tpm-orange group-hover:text-white gap-1 transition-colors">
                        <span>Voir les 24 produits</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>
            </a>

            <!-- Catégorie 2: Accessoires toiture -->
            <a href="<?php echo esc_url($cat_accessoires_url); ?>" class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl aspect-[4/5] bg-tpm-navy flex flex-col justify-end transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <img alt="Accessoires toiture" class="absolute inset-0 w-full h-full object-cover opacity-75 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole2_accessoires.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/60 to-transparent"></div>
                <div class="relative p-6 space-y-2.5 z-10">
                    <span class="inline-block bg-indigo-600 text-white text-[10px] uppercase font-black px-2.5 py-0.5 rounded tracking-wider">Pliages Industriels</span>
                    <h4 class="text-xl font-bold text-white leading-tight group-hover:text-tpm-orange transition-colors">Accessoires toiture</h4>
                    <p class="text-xs text-gray-300 line-clamp-3">Faîtières double pente, crantées, rives de finition, noues étanches, bavettes et gouttières profilées.</p>
                    <div class="pt-2 flex items-center text-xs font-bold text-tpm-orange group-hover:text-white gap-1 transition-colors">
                        <span>Voir les 10 produits</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>
            </a>

            <!-- Catégorie 3: Fixations et étanchéité -->
            <a href="<?php echo esc_url($cat_fixations_url); ?>" class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl aspect-[4/5] bg-tpm-navy flex flex-col justify-end transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <img alt="Fixations et étanchéité" class="absolute inset-0 w-full h-full object-cover opacity-75 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole3_fixations.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/60 to-transparent"></div>
                <div class="relative p-6 space-y-2.5 z-10">
                    <span class="inline-block bg-emerald-600 text-white text-[10px] uppercase font-black px-2.5 py-0.5 rounded tracking-wider">Sécurité Chantier</span>
                    <h4 class="text-xl font-bold text-white leading-tight group-hover:text-tpm-orange transition-colors">Fixations et étanchéité</h4>
                    <p class="text-xs text-gray-300 line-clamp-3">Tirefonds zingués 6x80/6x60, vis auto-perceuses, cavaliers aluminium et bandes Toiturole 900G.</p>
                    <div class="pt-2 flex items-center text-xs font-bold text-tpm-orange group-hover:text-white gap-1 transition-colors">
                        <span>Voir les 9 produits</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>
            </a>

            <!-- Catégorie 4: Accessoires intérieurs -->
            <a href="<?php echo esc_url($cat_interieurs_url); ?>" class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl aspect-[4/5] bg-tpm-navy flex flex-col justify-end transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <img alt="Accessoires intérieurs" class="absolute inset-0 w-full h-full object-cover opacity-75 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole6_carreaux.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/60 to-transparent"></div>
                <div class="relative p-6 space-y-2.5 z-10">
                    <span class="inline-block bg-purple-600 text-white text-[10px] uppercase font-black px-2.5 py-0.5 rounded tracking-wider">Finition &amp; Plasturgie</span>
                    <h4 class="text-xl font-bold text-white leading-tight group-hover:text-tpm-orange transition-colors">Accessoires intérieurs</h4>
                    <p class="text-xs text-gray-300 line-clamp-3">Carreaux grès cérame haute résistance, sacs PP tissés (25kg à 100kg), éponges et finitions.</p>
                    <div class="pt-2 flex items-center text-xs font-bold text-tpm-orange group-hover:text-white gap-1 transition-colors">
                        <span>Voir les 15 produits</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- PRODUCTS SECTION -->
<section class="bg-white py-20 lg:py-28 border-t border-gray-200" data-purpose="products-section" id="catalogue">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl space-y-4">
                <h2 class="text-sm font-bold text-tpm-orange tracking-widest uppercase">Catalogue 2026</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-tpm-navy">Produits Phares</h3>
            </div>
            <a class="inline-flex items-center font-bold text-tpm-orange hover:text-orange-700 transition" href="<?php echo esc_url($shop_url); ?>">
                Télécharger le catalogue complet
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <a href="<?php echo esc_url( home_url('/product/toles-bacs-ou-ondulees-alu-5-10e-prelaquees/') ); ?>" class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col hover:-translate-y-1">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Tôle BAC 0.50mm" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod1_tole.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-base md:text-lg mb-1 group-hover:text-tpm-orange transition-colors">Tôle BAC 0.50mm</h4>
                    <span class="text-xs text-gray-500 font-medium">Tôles &amp; Couvertures</span>
                </div>
            </a>

            <!-- Product 2 -->
            <a href="<?php echo esc_url( home_url('/product/tirefonds-zingues-6x80/') ); ?>" class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col hover:-translate-y-1">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Fixation 6x80" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod2_fixation.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-base md:text-lg mb-1 group-hover:text-tpm-orange transition-colors">Fixation Complète 6x80</h4>
                    <span class="text-xs text-gray-500 font-medium">Fixations</span>
                </div>
            </a>

            <!-- Product 3 -->
            <a href="<?php echo esc_url( home_url('/product/faitiere-a-bord-rabattu-0-33/') ); ?>" class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col hover:-translate-y-1">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Faîtière 0.33" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod3_faitiere.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-base md:text-lg mb-1 group-hover:text-tpm-orange transition-colors">Faîtière Bord Rabattu</h4>
                    <span class="text-xs text-gray-500 font-medium">Accessoires &amp; Pliage</span>
                </div>
            </a>

            <!-- Product 4 -->
            <a href="<?php echo esc_url( home_url('/product/sacs-tisses-en-polypropylene-pp-blancs-50kg/') ); ?>" class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col hover:-translate-y-1">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Sacs PP 50kg" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod4_sac.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-base md:text-lg mb-1 group-hover:text-tpm-orange transition-colors">Sacs PP Blancs 50kg</h4>
                    <span class="text-xs text-gray-500 font-medium">Plasturgie</span>
                </div>
            </a>

            <!-- Product 5 -->
            <a href="<?php echo esc_url( home_url('/product/toiturole-900g-10m/') ); ?>" class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col hover:-translate-y-1">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Joints Bitumés" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod5_joint.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-base md:text-lg mb-1 group-hover:text-tpm-orange transition-colors">Joint Bitumé Étanchéité</h4>
                    <span class="text-xs text-gray-500 font-medium">Accessoires</span>
                </div>
            </a>

            <!-- Product 6 -->
            <a href="<?php echo esc_url( home_url('/product/eponges-metalliques-abrasives/') ); ?>" class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col hover:-translate-y-1">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Éponges Métalliques" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod6_eponge.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-base md:text-lg mb-1 group-hover:text-tpm-orange transition-colors">Éponges Métalliques</h4>
                    <span class="text-xs text-gray-500 font-medium">Quincaillerie</span>
                </div>
            </a>

            <!-- Product 7 -->
            <a href="<?php echo esc_url( home_url('/product/pointes-torsadees-en-acier/') ); ?>" class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col hover:-translate-y-1">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Pointes Torsadées" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod7_pointe.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-base md:text-lg mb-1 group-hover:text-tpm-orange transition-colors">Pointes Torsadées</h4>
                    <span class="text-xs text-gray-500 font-medium">Fixations</span>
                </div>
            </a>

            <!-- Product 8 -->
            <a href="<?php echo esc_url( home_url('/service-zingage/') ); ?>" class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col relative hover:-translate-y-1">
                <div class="absolute top-4 right-4 bg-tpm-orange text-white text-xs font-bold px-2 py-1 rounded z-10 uppercase tracking-wide">Service</div>
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Service Zingage 800 VA" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod8_zingage.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-base md:text-lg mb-1 group-hover:text-tpm-orange transition-colors">Service Zingage 800 VA</h4>
                    <span class="text-xs text-gray-500 font-medium">Prestations Industrielles</span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- PART 3: FACTORY & DOCUMENTATION            -->
<!-- ========================================== -->
<!-- FACTORY SHOWCASE -->
<section class="relative bg-tpm-navy text-white overflow-hidden py-20 lg:py-28" data-purpose="factory-showcase" id="usine">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img alt="L'Usine de Bekoko (Douala) floor" class="w-full h-full object-cover opacity-25" src="<?php echo esc_url($theme_img_uri . 'factory_showcase.jpg'); ?>"/>
        <div class="absolute inset-0 bg-gradient-to-b from-tpm-navy/90 via-tpm-navy/70 to-tpm-navy"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="inline-block bg-tpm-orange text-white text-xs uppercase font-extrabold px-3 py-1 rounded-full tracking-widest">
                Parc Industriel • 1 500 m² Couverts
            </span>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight uppercase">
                L'Usine de Bekoko <span class="text-tpm-orange block sm:inline">(Douala)</span>
            </h2>
            <p class="text-sm md:text-base text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Une infrastructure métallurgique de pointe dédiée au profilage haute vitesse, au pliage de précision et au traitement de surface anti-corrosion.
            </p>
            <div class="w-24 h-1.5 bg-tpm-orange mx-auto rounded-full mt-4"></div>
        </div>

        <!-- 4 Authentic Factory Photos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] group shadow-2xl border border-white/10">
                <img src="<?php echo esc_url($theme_img_uri . 'hero_factory.jpg'); ?>" alt="Ligne de profilage" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                    <span class="text-xs font-bold text-tpm-orange uppercase tracking-wider">Ligne 01</span>
                    <strong class="text-sm font-bold text-white">Profilage Continu Tôles BAC</strong>
                </div>
            </div>

            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] group shadow-2xl border border-white/10">
                <img src="<?php echo esc_url($theme_img_uri . 'pole1_toles.jpg'); ?>" alt="Stock de bobines" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                    <span class="text-xs font-bold text-tpm-orange uppercase tracking-wider">Stockage Matières</span>
                    <strong class="text-sm font-bold text-white">Bobines d'Aluminium &amp; Acier</strong>
                </div>
            </div>

            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] group shadow-2xl border border-white/10">
                <img src="<?php echo esc_url($theme_img_uri . 'pole2_accessoires.jpg'); ?>" alt="Atelier de pliage" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                    <span class="text-xs font-bold text-tpm-orange uppercase tracking-wider">Atelier Pliage</span>
                    <strong class="text-sm font-bold text-white">Faîtières &amp; Rives Profilées</strong>
                </div>
            </div>

            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] group shadow-2xl border border-white/10">
                <img src="<?php echo esc_url($theme_img_uri . 'prod8_zingage.jpg'); ?>" alt="Station de zingage" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                    <span class="text-xs font-bold text-tpm-orange uppercase tracking-wider">Traitement Anti-Rouille</span>
                    <strong class="text-sm font-bold text-white">Station Électro-Zingage 800 VA</strong>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DOCUMENTATION & FAQ SECTION -->
<section class="bg-white py-20 lg:py-28" data-purpose="doc-faq-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Documentation -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-sm font-bold text-tpm-orange tracking-widest uppercase mb-2">Ressources</h2>
                    <h3 class="text-3xl font-extrabold text-tpm-navy">Espace Documentaire</h3>
                </div>
                <div class="space-y-4">
                    <a class="flex items-center p-5 bg-slate-50 border border-gray-200 rounded-xl hover:border-tpm-orange hover:shadow-md transition group" href="#">
                        <div class="w-12 h-12 bg-tpm-navy/10 rounded-lg flex items-center justify-center text-tpm-navy font-bold text-xl mr-5 group-hover:bg-tpm-orange group-hover:text-white transition-colors">PDF</div>
                        <div class="flex-grow">
                            <h4 class="text-lg font-bold text-tpm-navy group-hover:text-tpm-orange transition-colors">Catalogue Général 2026</h4>
                            <p class="text-sm text-gray-500">Gamme complète des produits et services (15 Mo)</p>
                        </div>
                    </a>
                    <a class="flex items-center p-5 bg-slate-50 border border-gray-200 rounded-xl hover:border-tpm-orange hover:shadow-md transition group" href="#">
                        <div class="w-12 h-12 bg-tpm-navy/10 rounded-lg flex items-center justify-center text-tpm-navy font-bold text-xl mr-5 group-hover:bg-tpm-orange group-hover:text-white transition-colors">DOC</div>
                        <div class="flex-grow">
                            <h4 class="text-lg font-bold text-tpm-navy group-hover:text-tpm-orange transition-colors">Fiches Techniques</h4>
                            <p class="text-sm text-gray-500">Spécifications détaillées par produit (ZIP)</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- FAQ -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-sm font-bold text-tpm-orange tracking-widest uppercase mb-2">Support</h2>
                    <h3 class="text-3xl font-extrabold text-tpm-navy">Questions Fréquentes</h3>
                </div>
                <div class="space-y-4">
                    <details class="group border border-gray-200 bg-slate-50 rounded-xl">
                        <summary class="flex cursor-pointer items-center justify-between p-6 text-tpm-navy font-bold">
                            <h4 class="text-lg">Comment obtenir une Pro-Forma ?</h4>
                        </summary>
                        <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-200 pt-4 text-sm">
                            Vous pouvez utiliser notre formulaire de "Demande Flash" en haut de page, nous contacter via WhatsApp (+237 655 70 58 66), ou envoyer votre panier pro-forma directement.
                        </div>
                    </details>
                    <details class="group border border-gray-200 bg-slate-50 rounded-xl">
                        <summary class="flex cursor-pointer items-center justify-between p-6 text-tpm-navy font-bold">
                            <h4 class="text-lg">Le retrait direct à l'usine de Bekoko est-il possible ?</h4>
                        </summary>
                        <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-200 pt-4 text-sm">
                            Oui, le retrait usine est privilégié (Ex-Works). Après confirmation de votre commande, notre service logistique vous communiquera un bon d'enlèvement.
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function updateFlashEstimate() {
    const select = document.getElementById('flash-product-id');
    if (!select || !select.options || select.options.length === 0) return;
    const selected = select.options[select.selectedIndex];
    const price = parseFloat(selected.dataset.price || 0);
    const qty = parseInt(document.getElementById('flash-qty').value || 1);
}
</script>

<?php get_footer(); ?>
