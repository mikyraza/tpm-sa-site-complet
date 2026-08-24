<?php
/**
 * woocommerce/archive-product.php
 * Faithful implementation of the Category / Hub Catalogue B2B & Inventaire Usine layout.
 */

defined( 'ABSPATH' ) || exit;

get_header();

$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
$cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');

$total_products = wp_count_posts('product')->publish ?? 58;

// Categories for Sidebar
$cat_toles_url       = get_term_link('toles-et-toiture', 'product_cat');
$cat_accessoires_url = get_term_link('accessoires-toiture', 'product_cat');
$cat_fixations_url   = get_term_link('fixations-et-etancheite', 'product_cat');
$cat_interieurs_url  = get_term_link('accessoires-interieurs', 'product_cat');

if (is_wp_error($cat_toles_url))       $cat_toles_url = $shop_url;
if (is_wp_error($cat_accessoires_url)) $cat_accessoires_url = $shop_url;
if (is_wp_error($cat_fixations_url))   $cat_fixations_url = $shop_url;
if (is_wp_error($cat_interieurs_url))  $cat_interieurs_url = $shop_url;

$current_term = is_product_category() ? get_queried_object() : null;
$current_slug = $current_term ? $current_term->slug : '';
$current_title = $current_term ? $current_term->name : 'Tous les Articles';
?>

<main id="primary" class="site-main flex-grow bg-slate-50 font-sans">

    <!-- ═══════════════════════════════════════════════════════════
         1. TOP HUB BANNER & SEARCH BAR
         ═══════════════════════════════════════════════════════════ -->
    <section class="bg-tpm-slate text-white py-12 md:py-16 border-b border-gray-800 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-r from-tpm-navy via-tpm-navy/95 to-slate-900 opacity-95"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-5">
            
            <!-- Badge -->
            <div class="inline-flex items-center px-3.5 py-1 rounded-full bg-tpm-orange/20 border border-tpm-orange/40 text-tpm-orange font-black text-[11px] uppercase tracking-wider">
                PÔLE INDUSTRIEL / TARIFS USINE DIRECTS
            </div>

            <!-- Title -->
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white uppercase tracking-tight">
                HUB CATALOGUE B2B &amp; INVENTAIRE USINE
            </h1>

            <!-- Subtitle -->
            <p class="text-xs sm:text-sm text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Consultation de l'ensemble de nos matériaux métalliques, accessoires de toiture, sacs d'emballage et carrelage disponibles en stock usine.
            </p>

            <!-- Search Form -->
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="max-w-2xl mx-auto pt-2">
                <div class="flex items-center bg-white rounded-xl overflow-hidden shadow-2xl p-1 border border-gray-200">
                    <span class="material-symbols-outlined text-gray-400 pl-3.5 pr-2 text-[20px]">search</span>
                    <input type="search" 
                           name="s" 
                           value="<?php echo get_search_query(); ?>" 
                           placeholder="Rechercher un produit, une référence (TOL, FIX, ACC, INT)..." 
                           class="w-full text-xs font-semibold text-gray-800 placeholder-gray-400 outline-none bg-transparent py-2.5"/>
                    <input type="hidden" name="post_type" value="product"/>
                    <button type="submit" 
                            class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-6 py-2.5 rounded-lg text-xs uppercase tracking-wider transition-colors shrink-0 shadow-md">
                        Rechercher
                    </button>
                </div>
            </form>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         2. MAIN TWO-COLUMN CONTENT AREA (SIDEBAR + PRODUCT GRID)
         ═══════════════════════════════════════════════════════════ -->
    <section class="py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- LEFT SIDEBAR (Col 1-3) -->
                <aside class="lg:col-span-3 space-y-6">
                    
                    <!-- 1. SÉLECTION D'ACTIVITÉ -->
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                        <div class="p-4 border-b border-gray-100 bg-slate-50/50">
                            <h2 class="text-xs font-black text-tpm-navy uppercase tracking-wider flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-tpm-orange text-[18px]">category</span>
                                <span>SÉLECTION D'ACTIVITÉ</span>
                            </h2>
                        </div>
                        
                        <nav class="p-2 space-y-1 text-xs font-bold">
                            <!-- All products -->
                            <a href="<?php echo esc_url($shop_url); ?>" 
                               class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors <?php echo (!is_product_category() && !is_search()) ? 'bg-tpm-navy text-white shadow-sm' : 'text-gray-700 hover:bg-slate-100'; ?>">
                                <span>Tous les articles</span>
                                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                            </a>

                            <!-- Tôles & Couvertures -->
                            <a href="<?php echo esc_url($cat_toles_url); ?>" 
                               class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors <?php echo ($current_slug === 'toles-et-toiture') ? 'bg-tpm-navy text-white shadow-sm' : 'text-gray-700 hover:bg-slate-100'; ?>">
                                <span>Tôles &amp; Couvertures</span>
                                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                            </a>

                            <!-- Accessoires de Toiture -->
                            <a href="<?php echo esc_url($cat_accessoires_url); ?>" 
                               class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors <?php echo ($current_slug === 'accessoires-toiture') ? 'bg-tpm-navy text-white shadow-sm' : 'text-gray-700 hover:bg-slate-100'; ?>">
                                <span>Accessoires de Toiture</span>
                                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                            </a>

                            <!-- Fixations & Étanchéité -->
                            <a href="<?php echo esc_url($cat_fixations_url); ?>" 
                               class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors <?php echo ($current_slug === 'fixations-et-etancheite') ? 'bg-tpm-navy text-white shadow-sm' : 'text-gray-700 hover:bg-slate-100'; ?>">
                                <span>Fixations &amp; Étanchéité</span>
                                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                            </a>

                            <!-- Emballages & Plastiques -->
                            <a href="<?php echo esc_url($cat_interieurs_url); ?>" 
                               class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors <?php echo ($current_slug === 'accessoires-interieurs' || $current_slug === 'sacs-pp') ? 'bg-tpm-navy text-white shadow-sm' : 'text-gray-700 hover:bg-slate-100'; ?>">
                                <span>Emballages &amp; Plastiques</span>
                                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                            </a>

                            <!-- Carrelages & Revêtements -->
                            <a href="<?php echo esc_url($cat_interieurs_url); ?>" 
                               class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-gray-700 hover:bg-slate-100">
                                <span>Carrelages &amp; Revêtements</span>
                                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                            </a>

                            <!-- Quincaillerie & BTP -->
                            <a href="<?php echo esc_url($shop_url); ?>" 
                               class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-gray-700 hover:bg-slate-100">
                                <span>Quincaillerie &amp; BTP</span>
                                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                            </a>
                        </nav>
                    </div>

                    <!-- 2. BESOIN D'UN DEVIS FLASH CARD -->
                    <div class="bg-gradient-to-br from-tpm-navy to-slate-900 text-white rounded-2xl p-5 border border-white/10 shadow-lg space-y-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 text-tpm-orange flex items-center justify-center">
                            <span class="material-symbols-outlined text-[24px]">headset_mic</span>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-white">Besoin d'un Devis Flash ?</h3>
                            <p class="text-[11px] text-gray-300 leading-relaxed font-normal">
                                Contactez notre cellule commerciale pour vos calepinages et découpes sur-mesure.
                            </p>
                        </div>
                        <a href="<?php echo esc_url( home_url('/contact/#formulaire') ); ?>" 
                           class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-extrabold py-2.5 px-4 rounded-lg text-xs uppercase tracking-wider transition-colors text-center block shadow-md">
                            Demandez un Devis
                        </a>
                    </div>

                </aside>

                <!-- RIGHT PRODUCT GRID (Col 4-12) -->
                <div class="lg:col-span-9 space-y-6">
                    
                    <!-- Top Results Bar -->
                    <div class="bg-white rounded-xl border border-gray-200 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-sm">
                        <div class="text-xs font-bold text-gray-600">
                            <?php
                            global $wp_query;
                            $count = $wp_query->found_posts;
                            echo sprintf( 'Affichage des <strong class="text-tpm-navy font-black">%d produits</strong> correspondants', $count );
                            ?>
                        </div>

                        <!-- Sort dropdown / Ordering -->
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-500 font-semibold shrink-0">Trier par :</span>
                            <form class="woocommerce-ordering" method="get">
                                <select name="orderby" class="text-xs font-semibold bg-slate-50 border border-gray-300 rounded-lg px-2.5 py-1.5 outline-none focus:ring-2 focus:ring-tpm-orange transition text-tpm-navy" onchange="this.form.submit()">
                                    <option value="menu_order" <?php echo selected( get_query_var('orderby'), 'menu_order', false ); ?>>Dernières nouveautés</option>
                                    <option value="price" <?php echo selected( get_query_var('orderby'), 'price', false ); ?>>Prix croissant</option>
                                    <option value="price-desc" <?php echo selected( get_query_var('orderby'), 'price-desc', false ); ?>>Prix décroissant</option>
                                    <option value="title" <?php echo selected( get_query_var('orderby'), 'title', false ); ?>>Nom du produit</option>
                                </select>
                                <input type="hidden" name="paged" value="1"/>
                                <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
                            </form>
                        </div>
                    </div>

                    <!-- PRODUCTS 3-COLUMN GRID -->
                    <?php if ( woocommerce_product_loop() ) : ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php
                            while ( have_posts() ) {
                                the_post();
                                wc_get_template_part( 'content', 'product' );
                            }
                            ?>
                        </div>

                        <!-- PAGINATION -->
                        <div class="pt-8 flex justify-center">
                            <?php do_action( 'woocommerce_after_shop_loop' ); ?>
                        </div>

                    <?php else : ?>
                        <div class="bg-white p-12 text-center rounded-2xl border border-gray-200 shadow-sm space-y-4">
                            <span class="material-symbols-outlined text-5xl text-gray-300">inventory_2</span>
                            <h3 class="text-base font-bold text-tpm-navy">Aucun article ne correspond à votre sélection.</h3>
                            <p class="text-xs text-gray-500 max-w-md mx-auto">
                                Essayez d'autres mots-clés ou réinitialisez les filtres pour afficher l'ensemble de notre inventaire disponible.
                            </p>
                            <a href="<?php echo esc_url($shop_url); ?>" class="inline-block bg-tpm-orange text-white px-6 py-2.5 rounded-lg text-xs font-bold uppercase tracking-wider shadow">
                                Voir Tout le Catalogue
                            </a>
                        </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         3. ORANGE COMMERCIAL CTA BANNER : COMMANDE VOLUMINEUSE
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

<?php get_footer(); ?>
