<?php
/**
 * footer.php - TPM SA Theme
 * Faithful implementation of Design/tpm_sa_high_density_industrial_b2b_footer/code.html
 */
?>

<!-- 1. TOP CTA BANNER (Terracotta) -->
<div class="bg-tpm-orange text-white w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="text-center md:text-left max-w-2xl">
            <h2 class="text-xl md:text-2xl font-bold text-white leading-tight">
                Besoin d'une Facture Pro-Forma officielle ou d'une cotation B2B ?
            </h2>
            <p class="text-white/90 text-xs mt-1">
                Commandes au mètre linéaire sur-mesure pour tôles BAC, emballages PP tissés et tarification dégressive.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto shrink-0">
            <a href="https://wa.me/237655705866" target="_blank" class="bg-white text-tpm-slate font-bold text-xs px-6 py-3.5 rounded flex items-center justify-center gap-2 hover:bg-gray-100 transition-colors shadow-md">
                <span class="material-symbols-outlined text-[#25D366] text-[18px]">chat</span>
                WhatsApp Commercial Direct
            </a>
            <?php $cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/'); ?>
            <a href="<?php echo esc_url($cart_url); ?>" class="bg-tpm-navy text-white font-bold text-xs px-6 py-3.5 rounded flex items-center justify-center gap-2 hover:bg-opacity-90 transition-colors shadow-md">
                <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                Générer ma Pro-Forma
            </a>
        </div>
    </div>
</div>

<!-- 2. MAIN FOOTER BODY (Dark Navy) -->
<footer class="bg-tpm-navy text-white pt-16 pb-8 border-t border-white/10 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">
        
        <!-- Col 1: Brand -->
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-tpm-orange text-white font-extrabold rounded flex items-center justify-center text-lg">
                    TPM
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-white text-xl uppercase tracking-tight">TPM SA</span>
                    <span class="text-xs text-tpm-orange font-bold uppercase">Groupe CAC • Depuis 1976</span>
                </div>
            </div>
            <p class="text-xs text-gray-300 leading-relaxed">
                Leader camerounais dans le profilage de tôles BAC prélaquées, la fabrication de fixations industrielles, l'extrusion de sacs PP et le zingage unique en Afrique Centrale.
            </p>
            <div class="flex flex-wrap gap-2 pt-2">
                <span class="inline-flex items-center gap-1 bg-white/10 border border-white/20 px-2.5 py-1 rounded text-[10px] text-gray-300 uppercase font-semibold">
                    <span class="material-symbols-outlined text-[14px] text-tpm-orange">verified</span> PME Agréée
                </span>
                <span class="inline-flex items-center gap-1 bg-white/10 border border-white/20 px-2.5 py-1 rounded text-[10px] text-gray-300 uppercase font-semibold">
                    <span class="material-symbols-outlined text-[14px] text-tpm-orange">factory</span> Usines: PK12 &amp; Bekoko
                </span>
            </div>
        </div>

        <!-- Col 2: Nos Produits -->
        <?php 
        $shop_url            = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
        $cat_toles_url       = get_term_link('toles-et-toiture', 'product_cat');
        $cat_accessoires_url = get_term_link('accessoires-toiture', 'product_cat');
        $cat_fixations_url   = get_term_link('fixations-et-etancheite', 'product_cat');
        $cat_interieurs_url  = get_term_link('accessoires-interieurs', 'product_cat');

        if (is_wp_error($cat_toles_url))       $cat_toles_url = $shop_url;
        if (is_wp_error($cat_accessoires_url)) $cat_accessoires_url = $shop_url;
        if (is_wp_error($cat_fixations_url))   $cat_fixations_url = $shop_url;
        if (is_wp_error($cat_interieurs_url))  $cat_interieurs_url = $shop_url;
        ?>
        <div class="flex flex-col gap-4">
            <h3 class="text-sm font-bold text-white pb-2 border-b-2 border-tpm-orange inline-block w-max uppercase tracking-wider">
                Nos Produits
            </h3>
            <ul class="flex flex-col gap-2.5 text-xs text-gray-300">
                <li><a href="<?php echo esc_url($cat_toles_url); ?>" class="hover:text-tpm-orange transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-[16px] text-tpm-orange">chevron_right</span> Tôles BAC &amp; Ondulées</a></li>
                <li><a href="<?php echo esc_url($cat_accessoires_url); ?>" class="hover:text-tpm-orange transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-[16px] text-tpm-orange">chevron_right</span> Faîtières, Rives &amp; Gouttières</a></li>
                <li><a href="<?php echo esc_url($cat_fixations_url); ?>" class="hover:text-tpm-orange transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-[16px] text-tpm-orange">chevron_right</span> Fixations Complètes &amp; Pointes</a></li>
                <li><a href="<?php echo esc_url($cat_interieurs_url); ?>" class="hover:text-tpm-orange transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-[16px] text-tpm-orange">chevron_right</span> Sacs PP Blancs 50kg / 100kg</a></li>
                <li><a href="<?php echo esc_url($cat_interieurs_url); ?>" class="hover:text-tpm-orange transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-[16px] text-tpm-orange">chevron_right</span> Carreaux &amp; Sanitaires</a></li>
            </ul>
        </div>

        <!-- Col 3: Services & Pro-Forma -->
        <div class="flex flex-col gap-4">
            <h3 class="text-sm font-bold text-white pb-2 border-b-2 border-tpm-orange inline-block w-max uppercase tracking-wider">
                Services &amp; Pro-Forma
            </h3>
            <ul class="flex flex-col gap-2.5 text-xs text-gray-300">
                <li><a href="<?php echo esc_url( home_url('/devis-sur-mesure/') ); ?>" class="hover:text-tpm-orange transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">description</span> Demande de Pro-Forma Flash</a></li>
                <li><a href="<?php echo esc_url( home_url('/chantiers-btp/') ); ?>" class="hover:text-tpm-orange transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">local_shipping</span> Approvisionnement Chantiers BTP</a></li>
                <li><a href="<?php echo esc_url( home_url('/service-zingage/') ); ?>" class="hover:text-tpm-orange transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">bolt</span> Électro-Zingage 800 VA</a></li>
                <li><a href="<?php echo esc_url( $shop_url ); ?>" class="hover:text-tpm-orange transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">storefront</span> Catalogue Général (58 Articles)</a></li>
            </ul>
        </div>

        <!-- Col 4: Usine & Contact -->
        <div class="flex flex-col gap-4">
            <h3 class="text-sm font-bold text-white pb-2 border-b-2 border-tpm-orange inline-block w-max uppercase tracking-wider">
                Usine &amp; Contact
            </h3>
            <ul class="flex flex-col gap-3 text-xs text-gray-300">
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-tpm-orange text-[18px] shrink-0 mt-0.5">location_on</span>
                    <div>
                        <strong class="text-white block">Usine Principale Bekoko :</strong>
                        Carrefour Bekoko (Axe Douala - Limbé), Cameroun
                    </div>
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-tpm-orange text-[18px]">call</span>
                    <strong class="text-white">+237 655 70 58 66</strong>
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-tpm-orange text-[18px]">mail</span>
                    <span>commercial@tpm-sa.cm</span>
                </li>
            </ul>
        </div>

    </div>

    <!-- 3. BOTTOM LEGAL BAR -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-400 gap-4">
        <div>
            © 1976 - 2026 <strong>TPM SA</strong> (Groupe CAC). Tous droits réservés. Douala / Bekoko, Cameroun.
        </div>
        <div class="flex flex-wrap items-center gap-4 text-gray-400">
            <span>TVA : <strong>19.25%</strong></span>
            <span>•</span>
            <span>NIU : <strong>M052217435713Q</strong></span>
            <span>•</span>
            <span>RCCM : <strong>DLA/2026/B/1976</strong></span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
