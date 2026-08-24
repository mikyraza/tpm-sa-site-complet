<?php
/**
 * woocommerce/cart/cart.php
 * Formattage Panier en Devis Pro-Forma B2B Imprimable / PDF
 * Faithful to Design/tpm_sa_b2b_pro_forma_checkout_fiscal_compliance_page/code.html
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );

$subtotal_ht = WC()->cart->get_subtotal();
$tax_amount  = WC()->cart->get_subtotal_tax();
$total_ttc   = WC()->cart->get_total('edit');
$cart_count  = WC()->cart->get_cart_contents_count();
$proforma_no = 'TPM-' . date('Y') . '-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8 font-sans">
    
    <!-- PRINT BUTTONS STRIP (Invisible quand imprimé) -->
    <div class="flex flex-col sm:flex-row justify-between items-center bg-slate-100 p-4 rounded-xl border border-gray-200 gap-4 print:hidden">
        <div class="flex items-center gap-2 text-tpm-navy font-bold text-sm">
            <span class="material-symbols-outlined text-tpm-orange">receipt_long</span>
            <span>Document Pro-Forma Officiel B2B — Valable 30 Jours</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?php echo esc_url( add_query_arg('generate_proforma_pdf', '1', wc_get_cart_url()) ); ?>" target="_blank" download="<?php echo esc_attr($proforma_no . '.pdf'); ?>" class="bg-tpm-navy hover:bg-slate-900 text-white font-bold px-5 py-2.5 rounded-lg text-xs flex items-center gap-2 shadow transition-colors">
                <span class="material-symbols-outlined text-[18px]">download</span>
                Télécharger ma Pro-Forma (PDF)
            </a>
            <a href="<?php echo esc_url( wc_get_page_permalink('checkout') ); ?>" class="bg-tpm-orange hover:bg-orange-700 text-white font-bold px-5 py-2.5 rounded-lg text-xs flex items-center gap-2 shadow transition-colors uppercase tracking-wider">
                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                Valider la Commande Usine
            </a>
        </div>
    </div>

    <!-- EN-TÊTE PRO-FORMA B2B (Style Document Officiel) -->
    <div class="bg-white border-2 border-tpm-navy rounded-2xl p-8 shadow-md relative overflow-hidden">
        <!-- Bande de fond subtile -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 border-b-2 border-tpm-orange pb-6">
            <div class="flex items-center gap-4">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo_tpm.png' ); ?>" alt="TPM SA Logo" class="h-16 w-auto object-contain" onerror="this.style.display='none';"/>
                <div>
                    <h1 class="text-3xl font-black text-tpm-navy uppercase tracking-tight">TPM SA (Groupe CAC)</h1>
                    <p class="text-xs font-bold text-tpm-orange uppercase tracking-widest">Transformation Métallique &amp; Plastique — Depuis 1976</p>
                    <p class="text-xs text-gray-500 font-semibold mt-1">Fondé par M. NJIPNGANG — Usines de Douala PK12 &amp; Bekoko</p>
                </div>
            </div>

            <div class="text-left md:text-right font-mono text-xs space-y-1 bg-slate-50 p-4 rounded-lg border border-gray-200">
                <p class="font-bold text-tpm-navy text-sm">BON DE PRO-FORMA N° : <span class="text-tpm-orange"><?php echo esc_html($proforma_no); ?></span></p>
                <p class="text-gray-600">Date d'émission : <strong><?php echo date('d/m/Y'); ?></strong></p>
                <p class="text-gray-600">Validité : <strong>30 Jours ouvrés</strong></p>
                <p class="text-gray-600">NIU : <strong>M052217435713Q</strong> | TVA : <strong>19.25%</strong></p>
            </div>
        </div>

        <div class="mt-4 pt-2 text-center text-xs font-bold text-tpm-navy italic uppercase tracking-wide">
            "BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ"
        </div>
    </div>

    <!-- MAIN CART CONTENT -->
    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- LEFT TABLE -->
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-tpm-navy text-white px-6 py-4 flex justify-between items-center">
                        <h2 class="font-extrabold text-base uppercase tracking-wider">Détail des Articles Répertoriés (<?php echo esc_html($cart_count); ?>)</h2>
                        <span class="text-xs text-tpm-orange font-bold">Tarification Usine HT</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead class="bg-slate-100 text-tpm-navy font-bold text-xs uppercase border-b border-gray-200">
                                <tr>
                                    <th class="py-3.5 px-4">Article &amp; Réf</th>
                                    <th class="py-3.5 px-4">Spécifications</th>
                                    <th class="py-3.5 px-4 text-center">Quantité</th>
                                    <th class="py-3.5 px-4 text-right">Prix Unitaire HT</th>
                                    <th class="py-3.5 px-4 text-right">Total HT (FCFA)</th>
                                    <th class="py-3.5 px-4 text-center print:hidden">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                        $sku = $_product->get_sku() ?: 'TPM-'.$product_id;
                                        $unit = get_post_meta($product_id, '_unit', true) ?: 'unité';
                                        ?>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-4 px-4">
                                                <div class="font-bold text-tpm-navy text-sm"><?php echo $_product->get_name(); ?></div>
                                                <div class="text-xs font-mono text-tpm-orange">Réf: <?php echo esc_html($sku); ?></div>
                                            </td>
                                            <td class="py-4 px-4 text-xs text-gray-600">
                                                <?php
                                                if (!empty($cart_item['flash_length'])) echo '<div>Longueur: <strong>'.esc_html($cart_item['flash_length']).'</strong></div>';
                                                if (!empty($cart_item['flash_color'])) echo '<div>Couleur: <strong>'.esc_html($cart_item['flash_color']).'</strong></div>';
                                                ?>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <div class="inline-flex items-center border border-gray-300 rounded font-bold font-mono">
                                                    <?php
                                                    if ( $_product->is_sold_individually() ) {
                                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                    } else {
                                                        $product_quantity = woocommerce_quantity_input(
                                                            array(
                                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                                'input_value'  => $cart_item['quantity'],
                                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                                'min_value'    => '0',
                                                                'product_name' => $_product->get_name(),
                                                            ),
                                                            $_product,
                                                            false
                                                        );
                                                    }
                                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                                    ?>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-right font-mono text-xs">
                                                <?php echo wc_price( $_product->get_price() ); ?> / <?php echo esc_html($unit); ?>
                                            </td>
                                            <td class="py-4 px-4 text-right font-mono font-bold text-tpm-navy">
                                                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                                            </td>
                                            <td class="py-4 px-4 text-center print:hidden">
                                                <?php
                                                echo apply_filters(
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="text-red-600 hover:text-red-800 font-bold" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                        esc_html__( 'Remove this item', 'woocommerce' ),
                                                        esc_attr( $product_id ),
                                                        esc_attr( $_product->get_sku() )
                                                    ),
                                                    $cart_item_key
                                                );
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 bg-slate-50 border-t border-gray-200 flex justify-between items-center print:hidden">
                        <a href="<?php echo esc_url( wc_get_page_permalink('shop') ); ?>" class="text-xs font-bold text-tpm-navy hover:text-tpm-orange transition-colors">
                            ← Continuer vos ajouts au catalogue
                        </a>
                        <button type="submit" class="bg-tpm-navy text-white text-xs font-bold px-4 py-2 rounded hover:bg-slate-800 transition-colors" name="update_cart" value="Mettre à jour le panier">
                            Mettre à jour la Pro-Forma
                        </button>
                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                    </div>
                </div>
            </div>

            <!-- RIGHT SUMMARY & FISCAL BREAKDOWN -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white border-2 border-tpm-navy rounded-xl p-6 shadow-lg sticky top-8">
                    <h3 class="text-lg font-extrabold text-tpm-navy uppercase tracking-wider pb-3 border-b-2 border-tpm-orange mb-4">
                        Décompte Financier B2B
                    </h3>

                    <div class="space-y-3 text-sm font-mono">
                        <div class="flex justify-between items-center text-gray-700">
                            <span>Total des articles HT :</span>
                            <span class="font-bold text-tpm-navy"><?php echo wc_price( WC()->cart->get_subtotal() ); ?></span>
                        </div>
                        <div class="flex justify-between items-center text-gray-700">
                            <span>TVA Cameroun (19.25%) :</span>
                            <span class="font-bold text-tpm-orange"><?php echo wc_price( WC()->cart->get_subtotal_tax() ); ?></span>
                        </div>
                        <div class="flex justify-between items-center text-gray-700">
                            <span>Frais de Manutention :</span>
                            <span class="text-emerald-700 font-bold">Inclus Usine</span>
                        </div>
                    </div>

                    <div class="my-6 pt-4 border-t-2 border-tpm-navy">
                        <div class="flex justify-between items-end">
                            <span class="text-sm font-extrabold text-tpm-navy uppercase">TOTAL GÉNÉRAL TTC :</span>
                            <span class="text-2xl font-black text-tpm-orange"><?php echo wc_price( WC()->cart->get_total('edit') ); ?></span>
                        </div>
                    </div>

                    <div class="bg-slate-100 p-3 rounded text-center text-[11px] font-bold text-tpm-navy border border-gray-200 mb-6">
                        ✔ Conforme à la réglementation fiscale du Cameroun
                    </div>

                    <div class="space-y-3 print:hidden">
                        <a href="<?php echo esc_url( add_query_arg('generate_proforma_pdf', '1', wc_get_cart_url()) ); ?>" target="_blank" download="<?php echo esc_attr($proforma_no . '.pdf'); ?>" class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-extrabold py-3.5 px-4 rounded-lg transition-colors text-center flex items-center justify-center gap-2 text-xs uppercase tracking-wider shadow-md">
                            <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                            GÉNÉRER MA PRO-FORMA EN PDF
                        </a>
                        <a href="<?php echo esc_url( wc_get_page_permalink('checkout') ); ?>" class="w-full bg-tpm-navy hover:bg-slate-900 text-white font-bold py-3 px-4 rounded-lg transition-colors text-center block text-xs uppercase tracking-wider shadow">
                            Valider la Commande Usine →
                        </a>
                        <a href="https://wa.me/237696340008?text=<?php echo rawurlencode('Bonjour TPM SA, je souhaite valider mon panier de commande Pro-Forma N° '.$proforma_no); ?>" target="_blank" class="w-full bg-[#25D366] hover:bg-[#1ebd59] text-white font-bold py-3 px-4 rounded-lg transition-colors text-center flex items-center justify-center gap-2 text-xs shadow">
                            <span class="material-symbols-outlined text-[18px]">chat</span>
                            Transmettre au Commercial WhatsApp
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </form>

    <!-- FOOTER INFORMATIONS LÉGALES DU DEVIS -->
    <div class="bg-tpm-navy text-white rounded-xl p-6 text-xs leading-relaxed space-y-2">
        <p class="font-bold text-tpm-orange text-sm uppercase">Coordonnées et Mentions Légales TPM SA (Groupe CAC) :</p>
        <p>• E-mail officiel : <strong>cac_vis3@yahoo.fr</strong> | Téléphones Usine : <strong>+237 696 34 00 08 / +237 691 53 75 14</strong></p>
        <p>• Horaires de bureau : <strong>Du Lundi au Vendredi de 08h00 à 18h00</strong> | Jours fériés : <strong>08h00 à 12h00</strong> (Fermé : 01/01, 11/02, 01/05, 20/05, 25/12)</p>
        <p>• Adresse usine : Carrefour Bekoko (Axe Douala - Limbé) &amp; Zone Industrielle Douala PK12, Cameroun.</p>
    </div>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
