<?php
/**
 * woocommerce/content-single-product.php
 * Faithful implementation of Design/tpm_sa_product_detail_t_le_bac_0.50mm_bordeau/code.html
 */

defined( 'ABSPATH' ) || exit;

global $product;
if ( ! $product ) return;

$product_id  = $product->get_id();
$sku         = $product->get_sku();
$title       = $product->get_name();
$price_html  = $product->get_price_html();
$description = $product->get_description() ?: $product->get_short_description();
$unit        = get_post_meta( $product_id, '_unit', true ) ?: 'unité';
$colors_meta = get_post_meta( $product_id, '_colors', true ) ?: 'Bordeau, Bleu Cendre, Orange, Vert, Alu Naturel';
$img_url     = wp_get_attachment_image_url( $product->get_image_id(), 'full' ) ?: get_template_directory_uri() . '/assets/images/prod1_tole.jpg';
$cart_url    = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/panier/');

do_action( 'woocommerce_before_single_product' );
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12', $product ); ?>>

    <!-- 1. BREADCRUMB & STOCK STATUS -->
    <div class="bg-slate-100 border border-gray-200 px-6 py-4 rounded-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <nav class="text-sm text-gray-600 flex items-center gap-2 flex-wrap font-medium">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-tpm-orange transition-colors">Accueil</a>
            <span>></span>
            <a href="<?php echo esc_url( wc_get_page_permalink('shop') ); ?>" class="hover:text-tpm-orange transition-colors">Catalogue Usine</a>
            <span>></span>
            <span class="font-bold text-tpm-navy"><?php echo esc_html($title); ?></span>
        </nav>
        <div class="bg-emerald-50 text-emerald-800 border border-emerald-200 px-4 py-1.5 rounded text-xs font-bold flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Disponible en Stock Usine (Bekoko &amp; Douala PK12)
        </div>
    </div>

    <!-- 2. MAIN HERO PRODUCT SECTION -->
    <section class="bg-white border border-gray-200 rounded-xl overflow-hidden flex flex-col lg:flex-row shadow-sm">
        
        <!-- Gallery -->
        <div class="lg:w-1/2 p-6 md:p-8 border-b lg:border-b-0 lg:border-r border-gray-200 flex flex-col gap-4 bg-slate-50">
            <div class="aspect-[4/3] w-full bg-white border border-gray-200 rounded-lg overflow-hidden flex items-center justify-center shadow-inner">
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover"/>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="aspect-square bg-white border-2 border-tpm-navy rounded-lg overflow-hidden cursor-pointer">
                    <img src="<?php echo esc_url($img_url); ?>" class="w-full h-full object-cover"/>
                </div>
                <div class="aspect-square bg-white border border-gray-200 rounded-lg overflow-hidden cursor-pointer opacity-70 hover:opacity-100 transition-opacity">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero_factory.jpg'); ?>" class="w-full h-full object-cover"/>
                </div>
                <div class="aspect-square bg-white border border-gray-200 rounded-lg overflow-hidden cursor-pointer opacity-70 hover:opacity-100 transition-opacity">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/factory_showcase.jpg'); ?>" class="w-full h-full object-cover"/>
                </div>
            </div>
        </div>

        <!-- Product Details & Form -->
        <div class="lg:w-1/2 p-6 md:p-8 flex flex-col justify-between">
            <div>
                <p class="text-xs font-bold text-gray-500 tracking-wider uppercase mb-2">
                    Réf: <span class="text-tpm-navy font-mono"><?php echo esc_html($sku ?: 'TPM-'.get_the_ID()); ?></span> | Norme NC ISO 9001:2015
                </p>
                <h1 class="text-2xl md:text-3xl font-extrabold text-tpm-navy mb-3"><?php echo esc_html($title); ?></h1>
                
                <!-- Price HT & Unit -->
                <div class="flex items-baseline gap-3 mb-6 bg-slate-50 p-4 rounded-lg border border-gray-200">
                    <span class="text-3xl font-black text-tpm-orange"><?php echo $price_html; ?></span>
                    <span class="text-xs font-bold text-gray-500 uppercase">HT / <?php echo esc_html($unit); ?></span>
                    <span class="text-xs font-semibold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded ml-auto">+ TVA (19.25%)</span>
                </div>

                <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                    <?php echo esc_html($description); ?>
                </p>

                <!-- Color Swatches -->
                <div class="mb-6">
                    <p class="text-xs font-bold text-tpm-navy uppercase tracking-wider mb-2">COULEURS DISPONIBLES EN STOCK</p>
                    <div class="flex gap-2 flex-wrap items-center">
                        <span class="w-8 h-8 rounded-full border-2 border-tpm-navy bg-[#800020] cursor-pointer" title="Bordeau RAL 3005"></span>
                        <span class="w-8 h-8 rounded-full border border-gray-300 bg-[#4C6A92] cursor-pointer" title="Bleu Cendre"></span>
                        <span class="w-8 h-8 rounded-full border border-gray-300 bg-[#D84B1F] cursor-pointer" title="Orange Terracotta"></span>
                        <span class="w-8 h-8 rounded-full border border-gray-300 bg-[#556B2F] cursor-pointer" title="Vert Olive"></span>
                        <span class="w-8 h-8 rounded-full border border-gray-300 bg-[#C0C0C0] cursor-pointer" title="Alu Naturel"></span>
                        <span class="text-xs text-gray-500 font-medium ml-2">(<?php echo esc_html($colors_meta); ?>)</span>
                    </div>
                </div>

                <!-- Product Form (Add to Pro-Forma) -->
                <form action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' class="space-y-4">
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-tpm-navy mb-1 uppercase">Longueur usine</label>
                            <select name="flash-length" class="w-full bg-slate-50 border border-gray-300 rounded p-2.5 text-xs font-bold text-tpm-navy">
                                <option value="Standard usine">Standard usine</option>
                                <option value="2.00m">2.00 Mètres</option>
                                <option value="3.00m">3.00 Mètres</option>
                                <option value="4.00m">4.00 Mètres</option>
                                <option value="6.00m">6.00 Mètres</option>
                                <option value="Sur-mesure (max 12m)">Sur-mesure (max 12m)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-tpm-navy mb-1 uppercase">Quantité</label>
                            <input type="number" name="quantity" min="1" value="1" class="w-full bg-slate-50 border border-gray-300 rounded p-2.5 text-xs font-mono font-bold text-tpm-navy"/>
                        </div>
                    </div>

                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-extrabold py-4 px-6 rounded-lg transition-all shadow-lg flex items-center justify-center gap-2 uppercase tracking-wider text-sm">
                        <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                        Ajouter à ma Facture Pro-Forma
                    </button>
                </form>
            </div>

            <!-- WhatsApp Direct Order Button -->
            <?php
            $phone = '237696340008';
            $msg   = rawurlencode( "Bonjour TPM SA, je souhaite commander le produit : {$title} (Réf: {$sku})." );
            $wa_url = "https://wa.me/{$phone}?text={$msg}";
            ?>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="<?php echo esc_url($wa_url); ?>" target="_blank" class="w-full bg-[#25D366] hover:bg-[#1ebd59] text-white font-bold py-3.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2 text-xs uppercase tracking-wider shadow">
                    <span class="material-symbols-outlined text-[18px]">chat</span>
                    Commander via WhatsApp (+237 696 34 00 08)
                </a>
            </div>

        </div>
    </section>

    <!-- 3. FICHE TECHNIQUE & ACCESSOIRES COMPATIBLES -->
    <section class="space-y-6">
        <h2 class="text-xl font-bold text-tpm-navy border-b-2 border-tpm-orange pb-2 inline-block">Caractéristiques Techniques Réelles (Données Usine)</h2>
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse text-sm">
                <tbody>
                    <tr class="border-b border-gray-100 bg-slate-50">
                        <th class="py-3 px-6 font-bold text-tpm-navy w-1/3">Référence Produit</th>
                        <td class="py-3 px-6 font-mono text-tpm-orange font-bold"><?php echo esc_html($sku ?: 'TPM-'.get_the_ID()); ?></td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <th class="py-3 px-6 font-bold text-tpm-navy">Slogan &amp; Engagement</th>
                        <td class="py-3 px-6 font-bold text-tpm-navy">"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ"</td>
                    </tr>
                    <tr class="border-b border-gray-100 bg-slate-50">
                        <th class="py-3 px-6 font-bold text-tpm-navy">Fondateur &amp; Direction</th>
                        <td class="py-3 px-6 text-gray-700">Fondé par M. NJIPNGANG — Plus de 50 ans d'expertise industrielle au Cameroun</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <th class="py-3 px-6 font-bold text-tpm-navy">Provenance &amp; Usines</th>
                        <td class="py-3 px-6 text-gray-700">Usine de Bekoko (Axe Douala - Limbé) &amp; Usine de Douala PK12</td>
                    </tr>
                    <tr class="bg-slate-50">
                        <th class="py-3 px-6 font-bold text-tpm-navy">Conditions de Retrait</th>
                        <td class="py-3 px-6 text-gray-700">Ex-Works usine ou Livraison sur chantier sur cotation B2B</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
