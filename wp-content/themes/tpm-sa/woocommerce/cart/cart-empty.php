<?php
/**
 * Empty cart page
 * woocommerce/cart/cart-empty.php
 */

defined( 'ABSPATH' ) || exit;

$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center font-sans">
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-10 space-y-6">
        <div class="w-16 h-16 bg-orange-50 text-tpm-orange rounded-2xl flex items-center justify-center mx-auto">
            <span class="material-symbols-outlined text-4xl">shopping_cart</span>
        </div>
        <div class="space-y-2">
            <h2 class="text-2xl font-black text-tpm-navy uppercase tracking-tight">Votre Panier Pro-Forma est actuellement vide</h2>
            <p class="text-xs text-gray-500 max-w-md mx-auto leading-relaxed">
                Vous n'avez pas encore ajouté d'articles à votre devis. Explorez notre catalogue pour composer votre sélection de tôles, accessoires ou fixations.
            </p>
        </div>
        <a href="<?php echo esc_url($shop_url); ?>" 
           class="inline-block bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-8 py-3.5 rounded-lg text-xs uppercase tracking-wider shadow-lg transition-colors">
            Explorer le Catalogue Usine
        </a>
    </div>
</div>
