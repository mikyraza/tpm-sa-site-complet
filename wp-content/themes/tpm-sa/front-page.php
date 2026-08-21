<?php
/**
 * front-page.php - TPM SA Theme
 * Faithful implementation of Design/tpm_sa_complete_industrial_body_content/code.html
 * Using local assets for 100% reliability (no broken external links).
 */
get_header();

$theme_img_uri = get_template_directory_uri() . '/assets/images/';
$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/boutique/');
$cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/panier/');

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
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight uppercase tracking-tight">
                        La Puissance Industrielle <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">Au Service de vos Chantiers</span>
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
<!-- EXPERTISE SECTION -->
<section class="bg-slate-50 py-20 lg:py-28" data-purpose="expertise-section" id="expertise">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <h2 class="text-sm font-bold text-tpm-orange tracking-widest uppercase">Nos Pôles de Compétences</h2>
            <h3 class="text-3xl md:text-4xl font-extrabold text-tpm-navy">Expertise Industrielle Multi-Sectorielle</h3>
            <div class="w-24 h-1.5 bg-tpm-orange mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Expertise Card 1 -->
            <div class="group relative rounded-2xl overflow-hidden shadow-xl aspect-video md:aspect-square bg-tpm-navy">
                <img alt="Tôles & Couvertures" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole1_toles.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/50 to-transparent opacity-90"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h4 class="text-2xl font-bold text-white mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Tôles &amp; Couvertures</h4>
                    <div class="w-12 h-1 bg-tpm-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100"></div>
                </div>
            </div>

            <!-- Expertise Card 2 -->
            <div class="group relative rounded-2xl overflow-hidden shadow-xl aspect-video md:aspect-square bg-tpm-navy">
                <img alt="Accessoires & Pliage" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole2_accessoires.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/50 to-transparent opacity-90"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h4 class="text-2xl font-bold text-white mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Accessoires &amp; Pliage</h4>
                    <div class="w-12 h-1 bg-tpm-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100"></div>
                </div>
            </div>

            <!-- Expertise Card 3 -->
            <div class="group relative rounded-2xl overflow-hidden shadow-xl aspect-video md:aspect-square bg-tpm-navy">
                <img alt="Fixations" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole3_fixations.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/50 to-transparent opacity-90"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h4 class="text-2xl font-bold text-white mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Fixations</h4>
                    <div class="w-12 h-1 bg-tpm-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100"></div>
                </div>
            </div>

            <!-- Expertise Card 4 -->
            <div class="group relative rounded-2xl overflow-hidden shadow-xl aspect-video md:aspect-square bg-tpm-navy">
                <img alt="Plasturgie" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole4_sacs.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/50 to-transparent opacity-90"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h4 class="text-2xl font-bold text-white mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Plasturgie (Sacs PP)</h4>
                    <div class="w-12 h-1 bg-tpm-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100"></div>
                </div>
            </div>

            <!-- Expertise Card 5 -->
            <div class="group relative rounded-2xl overflow-hidden shadow-xl aspect-video md:aspect-square bg-tpm-navy">
                <img alt="Prestations Industrielles" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole5_prestations.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/50 to-transparent opacity-90"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h4 class="text-2xl font-bold text-white mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Prestations Industrielles</h4>
                    <div class="w-12 h-1 bg-tpm-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100"></div>
                </div>
            </div>

            <!-- Expertise Card 6 -->
            <div class="group relative rounded-2xl overflow-hidden shadow-xl aspect-video md:aspect-square bg-tpm-navy">
                <img alt="Quincaillerie & Carreaux" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-40 transition-opacity duration-500 group-hover:scale-105 transform" src="<?php echo esc_url($theme_img_uri . 'pole6_carreaux.jpg'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/50 to-transparent opacity-90"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h4 class="text-2xl font-bold text-white mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Quincaillerie &amp; Carreaux</h4>
                    <div class="w-12 h-1 bg-tpm-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100"></div>
                </div>
            </div>
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
            <div class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Tôle BAC 0.50mm" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod1_tole.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-lg mb-2">Tôle BAC 0.50mm</h4>
                    <span class="text-sm text-gray-500 font-medium">Tôles &amp; Couvertures</span>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Fixation 6x80" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod2_fixation.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-lg mb-2">Fixation Complète 6x80</h4>
                    <span class="text-sm text-gray-500 font-medium">Fixations</span>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Faîtière 0.33" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod3_faitiere.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-lg mb-2">Faîtière Bord Rabattu</h4>
                    <span class="text-sm text-gray-500 font-medium">Accessoires &amp; Pliage</span>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Sacs PP 50kg" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod4_sac.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-lg mb-2">Sacs PP Blancs 50kg</h4>
                    <span class="text-sm text-gray-500 font-medium">Plasturgie</span>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Joints Bitumés" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod5_joint.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-lg mb-2">Joint Bitumé Étanchéité</h4>
                    <span class="text-sm text-gray-500 font-medium">Accessoires</span>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Éponges Métalliques" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod6_eponge.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-lg mb-2">Éponges Métalliques</h4>
                    <span class="text-sm text-gray-500 font-medium">Quincaillerie</span>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Pointes Torsadées" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod7_pointe.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-lg mb-2">Pointes Torsadées</h4>
                    <span class="text-sm text-gray-500 font-medium">Fixations</span>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="group bg-slate-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col relative">
                <div class="absolute top-4 right-4 bg-tpm-orange text-white text-xs font-bold px-2 py-1 rounded z-10 uppercase tracking-wide">Service</div>
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    <img alt="Service Zingage 800 VA" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'prod8_zingage.jpg'); ?>"/>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <h4 class="font-bold text-tpm-navy text-lg mb-2">Service Zingage 800 VA</h4>
                    <span class="text-sm text-gray-500 font-medium">Prestations Industrielles</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- PART 3: FACTORY & DOCUMENTATION            -->
<!-- ========================================== -->
<!-- FACTORY SHOWCASE -->
<section class="relative h-[55vh] min-h-[400px] flex items-center justify-center overflow-hidden" data-purpose="factory-showcase" id="usine">
    <div class="absolute inset-0 z-0">
        <img alt="L'Usine de Bekoko (Douala) floor" class="w-full h-full object-cover" src="<?php echo esc_url($theme_img_uri . 'factory_showcase.jpg'); ?>"/>
        <div class="absolute inset-0 bg-tpm-navy/60 mix-blend-multiply"></div>
    </div>
    <div class="relative z-10 text-center px-4">
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight uppercase">
            L'Usine de Bekoko <span class="text-tpm-orange block sm:inline">(Douala)</span>
        </h2>
        <div class="mt-6 w-24 h-2 bg-tpm-orange mx-auto rounded-full"></div>
    </div>
</section>

<!-- REALIZATIONS SECTION -->
<section class="bg-slate-50 py-20 lg:py-28 border-b border-gray-200" data-purpose="realizations-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <h2 class="text-sm font-bold text-tpm-orange tracking-widest uppercase">Nos Réalisations</h2>
            <h3 class="text-3xl md:text-4xl font-extrabold text-tpm-navy">La Confiance des Grands Chantiers</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Project 1 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 group">
                <div class="aspect-[4/3] overflow-hidden">
                    <img alt="Stade Omnisports" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'project1.jpg'); ?>"/>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-tpm-navy mb-2">Stade Omnisports</h4>
                    <p class="text-gray-600 text-sm">Fourniture de structures métalliques et tôles de couverture.</p>
                </div>
            </div>

            <!-- Project 2 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 group">
                <div class="aspect-[4/3] overflow-hidden">
                    <img alt="Complexe Logistique Portuaire" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'project2.jpg'); ?>"/>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-tpm-navy mb-2">Complexe Logistique Portuaire</h4>
                    <p class="text-gray-600 text-sm">Solutions de bardage industriel et fixations lourdes.</p>
                </div>
            </div>

            <!-- Project 3 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 group">
                <div class="aspect-[4/3] overflow-hidden">
                    <img alt="Unité de Transformation" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo esc_url($theme_img_uri . 'project3.jpg'); ?>"/>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-tpm-navy mb-2">Unité de Transformation</h4>
                    <p class="text-gray-600 text-sm">Zingage sur mesure pour équipements exposés.</p>
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
