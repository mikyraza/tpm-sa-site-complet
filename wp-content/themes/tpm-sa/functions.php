<?php
/**
 * TPM SA Theme functions and definitions
 * Site officiel TPM SA (Groupe CAC) - Usines de Douala PK12 & Bekoko
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function tpm_sa_setup() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'primary' => 'Menu Principal',
        'footer'  => 'Menu Pied de page',
    ) );
    add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption','style','script') );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'tpm_sa_setup' );

/**
 * Enqueue scripts and styles.
 */
function tpm_sa_scripts() {
    // Theme main stylesheet
    wp_enqueue_style( 'tpm-sa-style', get_stylesheet_uri(), array(), '1.0.3' );

    // Theme JS & i18n Translation Engine
    wp_enqueue_script( 'tpm-sa-i18n',
        get_template_directory_uri() . '/assets/js/tpm-i18n.js',
        array(), '1.0.4', true );

    wp_enqueue_script( 'tpm-sa-scripts',
        get_template_directory_uri() . '/assets/js/main.js',
        array('tpm-sa-i18n'), '1.0.5', true );

    wp_localize_script( 'tpm-sa-scripts', 'tpm_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'cart_url' => function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/'),
        'nonce'    => wp_create_nonce( 'tpm_cart_nonce' ),
    ) );

    // Supprimer les styles WordPress parasites
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'wp-block-directory' );
    wp_dequeue_style( 'wc-blocks-vendors-style' );
    wp_dequeue_style( 'wc-all-blocks-style' );
    wp_dequeue_style( 'wp-elements' );

    // Supprimer les scripts inutiles et les requêtes AJAX parasites
    wp_dequeue_script( 'wc-cart-fragments' );
    wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_enqueue_scripts', 'tpm_sa_scripts', 100 );

// Supprimer le CSS global-styles injecté inline
remove_action( 'wp_head', 'wp_global_styles_render_svg_filters' );
add_filter( 'wp_get_global_stylesheet', '__return_empty_string' );
remove_action( 'wp_head', '_admin_bar_bump_cb' );
add_filter( 'show_admin_bar', '__return_false' );

// Désactiver le tracking d'attribution WooCommerce (bloque admin-ajax.php en local)
add_filter( 'woocommerce_order_attribution_enabled', '__return_false' );

// Désactiver les requêtes Heartbeat en arrière-plan qui saturent les workers FastCGI
add_action( 'init', function() {
    wp_deregister_script( 'heartbeat' );
}, 1 );

// Désactiver les analytics et suggestions WooCommerce d'arrière-plan
add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );
add_filter( 'woocommerce_show_marketplace_suggestions', '__return_false' );
add_filter( 'woocommerce_marketplace_suggestions', '__return_empty_array' );
add_filter( 'woocommerce_background_image_regeneration', '__return_false' );

// Désactiver les vérifications automatiques externes lentes en local
add_filter( 'auto_update_core', '__return_false' );

// Désactiver la sidebar WooCommerce parasite (search bar et widgets entre les détails et le footer)
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
remove_action( 'admin_init', '_maybe_update_core' );
remove_action( 'admin_init', '_maybe_update_plugins' );
remove_action( 'admin_init', '_maybe_update_themes' );

// Forcer un timeout ultra-court sur les requêtes HTTP externes pour ne jamais bloquer FastCGI
add_filter( 'http_request_timeout', function() { return 1; } );
add_filter( 'http_request_redirection_count', function() { return 1; } );

// Désactiver les scripts emojis WordPress
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * WooCommerce : Personnalisation Boutons Panier -> Pro-Forma B2B
 */
add_filter( 'woocommerce_product_single_add_to_cart_text', function() {
    return 'Ajouter à la Pro-Forma';
} );

add_filter( 'woocommerce_product_add_to_cart_text', function() {
    return 'Ajouter à la Pro-Forma';
} );

/**
 * Bouton Direct WhatsApp sur la fiche produit
 */
add_action( 'woocommerce_single_product_summary', function() {
    global $product;
    if ( ! $product ) return;

    $phone = '237696340008';
    $name  = $product->get_name();
    $sku   = $product->get_sku();
    $msg   = rawurlencode( "Bonjour TPM SA, je souhaite avoir des informations et commander le produit : {$name} (Réf: {$sku})." );
    $url   = "https://wa.me/{$phone}?text={$msg}";

    echo '<div class="mt-4 pt-4 border-t border-gray-200">
        <a href="' . esc_url($url) . '" target="_blank" class="w-full bg-[#25D366] hover:bg-[#1ebd59] text-white font-bold py-3.5 px-6 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-md">
            <span class="material-symbols-outlined text-[22px]">chat</span>
            Commander via WhatsApp (+237 696 34 00 08)
        </a>
    </div>';
}, 35 );

/**
 * Sauvegarder les attributs Flash Pro-Forma (Longueur, Couleur) - Support GET & POST
 */
add_filter('woocommerce_add_cart_item_data', function($cart_item_data, $product_id, $variation_id) {
    $length = $_REQUEST['flash_length'] ?? $_REQUEST['flash-length'] ?? '';
    $color  = $_REQUEST['flash_color'] ?? $_REQUEST['flash-color'] ?? '';
    
    if (!empty($length)) {
        $cart_item_data['flash_length'] = sanitize_text_field($length);
    }
    if (!empty($color)) {
        $cart_item_data['flash_color'] = sanitize_text_field($color);
    }
    return $cart_item_data;
}, 10, 3);

/**
 * Assurer que 100% des articles du catalogue TPM SA sont toujours éligibles et commandables dans la Pro-Forma
 */
add_filter( 'woocommerce_product_is_in_stock', '__return_true', 99 );
add_filter( 'woocommerce_product_backorders_allowed', '__return_true', 99 );
add_filter( 'woocommerce_product_is_purchasable', '__return_true', 99 );


add_filter('woocommerce_get_item_data', function($item_data, $cart_item) {
    if (!empty($cart_item['flash_length'])) {
        $item_data[] = array('key' => 'Longueur', 'value' => $cart_item['flash_length']);
    }
    if (!empty($cart_item['flash_color'])) {
        $item_data[] = array('key' => 'Couleur', 'value' => $cart_item['flash_color']);
    }
    return $item_data;
}, 10, 2);

add_action('woocommerce_checkout_create_order_line_item', function($item, $cart_item_key, $values, $order) {
    if (!empty($values['flash_length'])) {
        $item->add_meta_data('Longueur', $values['flash_length']);
    }
    if (!empty($values['flash_color'])) {
        $item->add_meta_data('Couleur', $values['flash_color']);
    }
}, 10, 4);

/**
 * Formateur du symbole FCFA
 */
add_filter( 'woocommerce_currency_symbol', function( $symbol, $currency ) {
    if ( $currency === 'XAF' ) {
        return 'FCFA';
    }
    return $symbol;
}, 10, 2 );

/**
 * Champs B2B d'Identification (NIU, Raison Sociale, RCCM) sur la Commande
 */
add_filter( 'woocommerce_checkout_fields', function( $fields ) {
    $fields['billing']['billing_company']['label']       = 'Raison Sociale (Entreprise B2B) *';
    $fields['billing']['billing_company']['required']    = true;
    
    $fields['billing']['billing_niu'] = array(
        'label'       => 'Numéro d\'Identifiant Unique (NIU) *',
        'placeholder' => 'Ex: M052217435713Q',
        'required'    => true,
        'class'       => array('form-row-wide'),
        'priority'    => 35,
    );

    $fields['billing']['billing_rccm'] = array(
        'label'       => 'Numéro RCCM (Registre du Commerce)',
        'placeholder' => 'Ex: DLA/2026/B/1976',
        'required'    => false,
        'class'       => array('form-row-wide'),
        'priority'    => 36,
    );

    return $fields;
} );

add_action( 'woocommerce_checkout_update_order_meta', function( $order_id ) {
    if ( ! empty( $_POST['billing_niu'] ) ) {
        update_post_meta( $order_id, '_billing_niu', sanitize_text_field( $_POST['billing_niu'] ) );
    }
    if ( ! empty( $_POST['billing_rccm'] ) ) {
        update_post_meta( $order_id, '_billing_rccm', sanitize_text_field( $_POST['billing_rccm'] ) );
    }
} );

/**
 * Redirection des paramètres ?pole= vers les catégories officielles
 */
add_action( 'template_redirect', function() {
    if ( is_shop() && isset( $_GET['pole'] ) ) {
        $pole_map = array(
            'toles'        => 'toles-et-toiture',
            'accessoires'  => 'accessoires-toiture',
            'fixations'    => 'fixations-et-etancheite',
            'emballages'   => 'accessoires-interieurs',
            'carreaux'     => 'accessoires-interieurs',
        );
        $pole = sanitize_key( $_GET['pole'] );
        if ( isset( $pole_map[$pole] ) ) {
            $term = get_term_by( 'slug', $pole_map[$pole], 'product_cat' );
            if ( $term && ! is_wp_error( $term ) ) {
                wp_safe_redirect( get_term_link( $term ), 301 );
                exit;
            }
        }
    }
} );

/**
 * Helper d'image produit contextuelle (Haute Définition Usine & Pièces Jointes Réelles)
 */
function tpm_get_product_image_url( $product ) {
    $img_dir = get_template_directory_uri() . '/assets/images/';
    if ( ! $product ) return $img_dir . 'prod1_tole.jpg';

    // 1. Prioritize real attached product image from WordPress Media Library
    $img_id = $product->get_image_id();
    if ( $img_id ) {
        $attached_url = wp_get_attachment_image_url( $img_id, 'large' ) ?: wp_get_attachment_url( $img_id );
        if ( $attached_url ) {
            return $attached_url;
        }
    }

    $sku  = strtoupper( $product->get_sku() );
    $name = strtolower( $product->get_name() );

    // 2. Fallbacks by category
    if ( str_starts_with( $sku, 'TOL' ) || str_contains( $name, 'tôle' ) || str_contains( $name, 'tole' ) ) {
        return $img_dir . 'prod1_tole.jpg';
    }
    if ( str_starts_with( $sku, 'ACC' ) || str_contains( $name, 'faîtière' ) || str_contains( $name, 'faitiere' ) || str_contains( $name, 'gouttière' ) || str_contains( $name, 'noue' ) || str_contains( $name, 'rive' ) || str_contains( $name, 'bande' ) ) {
        return $img_dir . 'prod3_faitiere.jpg';
    }
    if ( str_starts_with( $sku, 'FIX' ) || str_contains( $name, 'vis' ) || str_contains( $name, 'tirefond' ) || str_contains( $name, 'cavalier' ) || str_contains( $name, 'rondelle' ) ) {
        if ( str_contains( $name, 'pointe' ) ) return $img_dir . 'prod7_pointe.jpg';
        if ( str_contains( $name, 'toiturole' ) || str_contains( $name, 'joint' ) || str_contains( $name, 'feutre' ) || str_contains( $name, 'bitum' ) ) return $img_dir . 'prod5_joint.jpg';
        return $img_dir . 'prod2_fixation.jpg';
    }
    if ( str_contains( $name, 'sac' ) ) {
        return $img_dir . 'prod4_sac.jpg';
    }
    if ( str_contains( $name, 'éponge' ) || str_contains( $name, 'eponge' ) ) {
        return $img_dir . 'prod6_eponge.jpg';
    }
    if ( str_contains( $name, 'zingage' ) ) {
        return $img_dir . 'prod8_zingage.jpg';
    }
    if ( str_contains( $name, 'carreau' ) || str_contains( $name, 'douche' ) || str_starts_with( $sku, 'INT' ) ) {
        return $img_dir . 'pole6_carreaux.jpg';
    }

    return $img_dir . 'prod1_tole.jpg';
}

/**
 * Dynamic Pro-Forma PDF Engine
 */
require_once get_template_directory() . '/inc/proforma-pdf.php';

/**
 * Automated Dual-Receipt Email Delivery System (Customer + Admin)
 */
require_once get_template_directory() . '/inc/order-receipt-email.php';

/**
 * Integrated SMTP Engine & Test Tool
 */
require_once get_template_directory() . '/inc/smtp-settings.php';

/**
 * Fiches Techniques Certifiées TPM SA (Groupe CAC)
 */
require_once get_template_directory() . '/inc/fiche-technique.php';
/**
 * Fast AJAX Add-to-Cart / Pro-Forma Handler (Prevents page reloads and scroll jumps)
 */
function tpm_ajax_add_to_cart_handler() {
    $product_id   = isset($_POST['product_id']) ? intval($_POST['product_id']) : (isset($_GET['product_id']) ? intval($_GET['product_id']) : 0);
    $quantity     = isset($_POST['quantity']) ? intval($_POST['quantity']) : (isset($_GET['quantity']) ? intval($_GET['quantity']) : 1);
    $flash_length = sanitize_text_field($_REQUEST['flash_length'] ?? $_REQUEST['flash-length'] ?? '');
    $flash_color  = sanitize_text_field($_REQUEST['flash_color'] ?? $_REQUEST['flash-color'] ?? '');

    if ( ! $product_id ) {
        wp_send_json_error( array( 'message' => 'Produit invalide.' ) );
    }

    $cart_item_data = array();
    if ( ! empty( $flash_length ) ) {
        $cart_item_data['flash_length'] = $flash_length;
    }
    if ( ! empty( $flash_color ) ) {
        $cart_item_data['flash_color'] = $flash_color;
    }

    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

    if ( $passed_validation ) {
        $cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity, 0, array(), $cart_item_data );
        if ( $cart_item_key ) {
            $count   = WC()->cart->get_cart_contents_count();
            $product = wc_get_product( $product_id );
            $name    = $product ? $product->get_name() : 'Article';

            wp_send_json_success( array(
                'count'        => $count,
                'product_name' => $name,
                'cart_url'     => wc_get_cart_url(),
                'message'      => sprintf( '"%s" a été ajouté à votre Pro-Forma !', $name )
            ) );
        }
    }

    $notices = wc_get_notices( 'error' );
    $msg     = ! empty( $notices ) ? strip_tags( $notices[0]['notice'] ) : 'Impossible d\'ajouter cet article.';
    wc_clear_notices();
    wp_send_json_error( array( 'message' => $msg ) );
}
add_action( 'wp_ajax_tpm_ajax_add_to_cart', 'tpm_ajax_add_to_cart_handler' );
add_action( 'wp_ajax_nopriv_tpm_ajax_add_to_cart', 'tpm_ajax_add_to_cart_handler' );

/**
 * Ensure price numbers and currency always stay on a single line with non-breaking spaces
 */
add_filter( 'woocommerce_price_format', function( $format, $currency_pos ) {
    return '%1$s&nbsp;%2$s';
}, 20, 2 );

add_filter( 'formatted_woocommerce_price', function( $formatted_price ) {
    return str_replace( ' ', '&nbsp;', $formatted_price );
}, 20, 1 );

/**
 * Get dynamic specification and color options matching an actual WooCommerce product
 */
function tpm_get_product_flash_details( $product_or_title, $cat_slug = '', $unit = 'unité' ) {
    if ( is_a( $product_or_title, 'WC_Product' ) ) {
        $title    = $product_or_title->get_name();
        $terms    = wp_get_post_terms( $product_or_title->get_id(), 'product_cat', ['fields' => 'slugs'] );
        $cat_slug = ! empty( $terms ) ? $terms[0] : '';
        $unit     = get_post_meta( $product_or_title->get_id(), '_unit', true ) ?: 'unité';
    } else {
        $title = (string) $product_or_title;
    }

    $lengths = [];
    $colors  = [];
    $length_label = 'LONGUEUR / FORMAT';
    $color_label  = 'COULEUR / FINITION';

    // 1. Tôles et toiture
    if ( $cat_slug === 'toles-et-toiture' || preg_match( '/tôle|tole/iu', $title ) ) {
        $length_label = 'LONGUEUR DE COUPE';
        $color_label  = 'COULEUR RAL';
        $lengths = [
            'Standard 6.00m',
            'Sur-mesure 3.00m',
            'Sur-mesure 4.00m',
            'Sur-mesure 5.00m',
            'Sur-mesure 7.00m',
            'Sur-mesure 8.00m',
            'Sur-mesure 10.00m',
            'Sur-mesure 12.00m'
        ];
        if ( preg_match( '/nature|brut|alu 4n/iu', $title ) ) {
            $colors = [ 'Alu Naturel (Brut non laqué)' ];
        } else {
            $colors = [
                'Bordeaux RAL 3005',
                'Bleu Cendre RAL 5014',
                'Orange Terracotta',
                'Vert Olive RAL 6003',
                'Gris Anthracite RAL 7016'
            ];
        }
    }
    // 2. Accessoires toiture (Faîtières, Bandes, Rives, Gouttières, Noues)
    elseif ( $cat_slug === 'accessoires-toiture' || preg_match( '/fa[iî]ti[eè]re|bandes\s+ourl[eé]es|rives|goutti[eè]re|noues/iu', $title ) ) {
        $length_label = 'FORMAT / LONGUEUR';
        $color_label  = 'FINITION / COULEUR';
        $lengths = [
            'Élément Standard 2.00m',
            'Élément Standard 3.00m',
            'Découpe Sur-mesure au ml'
        ];
        if ( preg_match( '/pr[eé]laqu/iu', $title ) ) {
            $colors = [
                'Bordeaux RAL 3005',
                'Bleu Cendre RAL 5014',
                'Orange Terracotta',
                'Vert Olive RAL 6003'
            ];
        } elseif ( preg_match( '/nature|brut/iu', $title ) ) {
            $colors = [ 'Aluminium Naturel (Brut)' ];
        } else {
            $colors = [
                'Aluminium Naturel (Brut)',
                'Prélaqué Standard Usine'
            ];
        }
    }
    // 3. Fixations et étanchéité
    elseif ( $cat_slug === 'fixations-et-etancheite' || preg_match( '/vis|tirefond|tige|cavalier|toiturole|feutre|rondelle|plaquette/iu', $title ) ) {
        $length_label = 'DIMENSION / FORMAT';
        $color_label  = 'TYPE / FINITION';
        if ( preg_match( '/vis\s+auto/iu', $title ) ) {
            preg_match( '/6[Xx]\d+/', $title, $m );
            $dim = ! empty( $m[0] ) ? strtoupper( $m[0] ) : '6X70';
            $lengths = [ "Dimension {$dim} mm (Vis + Rondelle EPDM)" ];
            $colors  = [ 'Acier Cémenté Galvanisé / Zingué', 'Tête Laquée Couleur Toiture' ];
        } elseif ( preg_match( '/tirefond/iu', $title ) ) {
            preg_match( '/6[Xx]\d+/', $title, $m );
            $dim = ! empty( $m[0] ) ? strtoupper( $m[0] ) : '6X80';
            $lengths = [ "Dimension {$dim} mm (Paquet de 72 pcs)" ];
            $colors  = [ 'Acier Zingué Haute Résistance' ];
        } elseif ( preg_match( '/tige/iu', $title ) ) {
            $lengths = [ 'Dimension 6x300 mm (Filetage continu)' ];
            $colors  = [ 'Acier Zingué' ];
        } elseif ( preg_match( '/cavalier/iu', $title ) ) {
            $lengths = [ 'Boîte de 100 pièces (Pour bac 4N/5N/Tuile)' ];
            if ( preg_match( '/pr[eé]laqu/iu', $title ) ) {
                $colors = [ 'Prélaqué Bordeaux RAL 3005', 'Prélaqué Bleu Cendre', 'Prélaqué Terracotta', 'Prélaqué Vert Olive' ];
            } else {
                $colors = [ 'Aluminium Naturel' ];
            }
        } elseif ( preg_match( '/toiturole/iu', $title ) ) {
            $lengths = [ 'Rouleau de 10 mètres linéaires (Larg. 1m)' ];
            $colors  = [ 'Armature Bitume Étanche 900G' ];
        } elseif ( preg_match( '/feutre|rondelle|plaquette/iu', $title ) ) {
            $lengths = [ 'Boîte de 100 pièces' ];
            $colors  = [ 'Feutre Bitumé Imperméable' ];
        } else {
            $lengths = [ 'Format Standard Usine' ];
            $colors  = [ 'Standard Usine' ];
        }
    }
    // 4. Accessoires intérieurs (Carreaux, Douches, Éponges)
    elseif ( $cat_slug === 'accessoires-interieurs' || preg_match( '/carreau|[eé]ponge|douche/iu', $title ) ) {
        if ( preg_match( '/carreau/iu', $title ) ) {
            $length_label = 'FORMAT CARREAU';
            $color_label  = 'ASPECT / CHOIX';
            preg_match( '/\d+[Xx]\d+/', $title, $m );
            $dim = ! empty( $m[0] ) ? $m[0] . ' cm' : 'Standard';
            $lengths = [ "Format {$dim} (Vente au carton)" ];

            preg_match( '/Réf\s+([A-Z0-9]+)/i', $title, $ref_m );
            $ref = ! empty( $ref_m[1] ) ? "Réf. " . $ref_m[1] . " - " : "";
            $colors = [
                $ref . '1er Choix Certifié (Haute résistance)',
                $ref . 'Finition Émaillée Brillante / Satinée',
                $ref . 'Finition Mate Antidérapante'
            ];
        } elseif ( preg_match( '/douche/iu', $title ) ) {
            $length_label = 'MODÈLE & FORMAT';
            $color_label  = 'ALIMENTATION & FINITION';
            if ( preg_match( '/grand modèle|duo/iu', $title ) ) {
                $lengths = [ 'Grand Modèle — Multi-jets (Haute Puissance)' ];
            } elseif ( preg_match( '/petit modèle/iu', $title ) ) {
                $lengths = [ 'Petit Modèle — Compact Économique' ];
            } else {
                $lengths = [ 'Modèle Central Polyvalent' ];
            }
            $colors = [
                '220V - Blanc Sanitaire Finition Chrome',
                '220V - Standard Fabricant'
            ];
        } elseif ( preg_match( '/[eé]ponge/iu', $title ) ) {
            $length_label = 'CONDITIONNEMENT';
            $color_label  = 'TYPE DE MAILLE';
            if ( preg_match( '/25/iu', $title ) ) {
                $lengths = [ 'Sachet de 25 pièces' ];
            } else {
                $lengths = [ 'Sachet de 20 pièces' ];
            }
            if ( preg_match( '/non\s+doubl/iu', $title ) ) {
                $colors = [ 'Maille Simple Non Doublée (Acier Inox)' ];
            } else {
                $colors = [ 'Maille Renforcée Doublée (Longue Durée)' ];
            }
        } else {
            $length_label = 'FORMAT';
            $color_label  = 'FINITION';
            $lengths = [ 'Format Standard' ];
            $colors  = [ 'Standard' ];
        }
    } else {
        $lengths = [ 'Standard Usine' ];
        $colors  = [ 'Standard' ];
    }

    return [
        'length_label' => $length_label,
        'color_label'  => $color_label,
        'lengths'      => $lengths,
        'colors'       => $colors,
        'unit'         => $unit,
    ];
}

/**
 * Retrieve all products structured by categories for Flash Pro-Forma card
 */
function tpm_get_flash_proforma_groups() {
    $products = wc_get_products([
        'status'  => 'publish',
        'limit'   => -1,
        'orderby' => 'menu_order',
        'order'   => 'ASC'
    ]);

    $categories_order = [
        'toles-et-toiture'       => '1. Tôles & Couvertures BAC',
        'accessoires-toiture'    => '2. Accessoires Toiture & Faîtages',
        'fixations-et-etancheite'=> '3. Fixations, Vis & Étanchéité',
        'accessoires-interieurs' => '4. Accessoires Intérieurs (Carreaux, Douches, Éponges)'
    ];

    $grouped = [];
    foreach ($categories_order as $slug => $label) {
        $grouped[$slug] = ['label' => $label, 'products' => []];
    }
    $grouped['autre'] = ['label' => '5. Autres Références', 'products' => []];

    foreach ($products as $p) {
        $terms = wp_get_post_terms($p->get_id(), 'product_cat');
        $matched_slug = 'autre';
        foreach ($terms as $t) {
            if (isset($categories_order[$t->slug])) {
                $matched_slug = $t->slug;
                break;
            }
        }

        $unit = get_post_meta($p->get_id(), '_unit', true) ?: 'unité';
        $details = tpm_get_product_flash_details($p, $matched_slug, $unit);

        $grouped[$matched_slug]['products'][] = [
            'id'      => $p->get_id(),
            'name'    => $p->get_name(),
            'price'   => $p->get_price(),
            'unit'    => $unit,
            'sku'     => $p->get_sku() ?: ('TPM-' . $p->get_id()),
            'details' => $details,
        ];
    }

    return array_filter($grouped, function($g) {
        return ! empty($g['products']);
    });
}

/**
 * Retrieve comprehensive certified catalog PDF specifications for a single product
 */
function tpm_get_product_pdf_catalog_details( $product ) {
    if ( ! $product ) return [];

    $id    = $product->get_id();
    $title = $product->get_name();
    $sku   = $product->get_sku() ?: ('TPM-' . $id);
    $terms = wp_get_post_terms( $id, 'product_cat', ['fields' => 'slugs'] );
    $cat   = ! empty( $terms ) ? $terms[0] : '';
    $unit  = get_post_meta( $id, '_unit', true ) ?: 'unité';

    $pole_title = 'PÔLE INDUSTRIEL TPM SA';
    $pole_desc  = 'Matériaux certifiés fabriqués dans les usines de Douala PK12 et Bekoko selon les normes de solidité les plus strictes au Cameroun.';
    $spec       = 'Conforme au Cahier des Charges Usine TPM SA';
    $app        = 'Bâtiments industriels, commerciaux, chantiers BTP et résidences.';
    $garantie   = '"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ"';

    // 1. Tôles et toiture
    if ( $cat === 'toles-et-toiture' || preg_match( '/tôle|tole/iu', $title ) ) {
        $pole_title = 'PÔLE 1 : TÔLES DE COUVERTURE & BACS ALUMINIUM';
        $pole_desc  = 'Aciers prélaqués et aluminium de premier choix, épaisseurs réelles garanties (0.35mm, 0.50mm, 0.60mm). Nuancier officiel RAL disponible pour toitures résidentielles, commerciales et entrepôts industriels.';
        if ( preg_match( '/6\/10|0[,.]60/iu', $title ) ) {
            $spec = 'Alliage Aluminium 1er Choix — Épaisseur 0.60mm (6/10e réelle garantie anti-corrosion marine)';
            $app  = 'Couvertures industrielles lourdes, entrepôts grande portée, zones maritimes sévères et toitures durables.';
        } elseif ( preg_match( '/5\/10|0[,.]50/iu', $title ) ) {
            $spec = 'Alliage Aluminium 1er Choix — Épaisseur 0.50mm (5/10e réelle garantie avec protection double face)';
            $app  = 'Toitures résidentielles de grand standing, villas contemporaines, bâtiments commerciaux et administratifs.';
        } elseif ( preg_match( '/tuile/iu', $title ) ) {
            $spec = 'Tôle Tuile Nervurale D50 — Profilage ondulé haute résistance esthétique et anti-déformation';
            $app  = 'Villas haut standing, toitures architecturales contemporaines et résidences de prestige.';
        } elseif ( preg_match( '/d50/iu', $title ) ) {
            $spec = 'Profilage BAC D50 Renforcé — Rigidité mécanique accrue et capacité d\'écoulement maximale';
            $app  = 'Bâtiments industriels, hangars de stockage et charpentes métalliques espacées.';
        } elseif ( preg_match( '/b30/iu', $title ) ) {
            $spec = 'Tôles bacs prélaquées B30 (2ème choix contrôlé) — Rapport qualité/prix usine optimal';
            $app  = 'Clôtures de chantier, hangars de stockage agricole et toitures secondaires.';
        } else {
            $spec = 'Alliage Aluminium Standard Usine — Épaisseur 0.35mm / 0.33mm (Profils 4N, 5N et Ondulé 3M)';
            $app  = 'Couvertures résidentielles économiques, hangars, auvents et toitures polyvalentes.';
        }
    }
    // 2. Accessoires toiture
    elseif ( $cat === 'accessoires-toiture' || preg_match( '/fa[iî]ti[eè]re|bandes\s+ourl[eé]es|rives|goutti[eè]re|noues/iu', $title ) ) {
        $pole_title = 'PÔLE 2 : ACCESSOIRES DE TOITURE & PLIAGES INDUSTRIELS';
        $pole_desc  = 'Faîtières double pente, faîtières centrales, rives de faîtage, gouttières formées, noues et bavettes en aluminium et acier laqué garantissant l\'étanchéité absolue des arêtes et versants.';
        if ( preg_match( '/fa[iî]ti[eè]re/iu', $title ) ) {
            $spec = 'Pliage industriel sur-mesure — Arête faîtière étanche double pente ou centrale à recouvrement parfait';
            $app  = 'Jonction faîtage supérieur, protection sommitale de toitures bac et tôles ondulées contre les infiltrations.';
        } elseif ( preg_match( '/rive/iu', $title ) ) {
            $spec = 'Rive de faîtage profilée — Protection des rives latérales et pignons contre les bourrasques et le vent';
            $app  = 'Protection d\'extrémité contre les infiltrations d\'eau latérales et arrachements cycloniques.';
        } elseif ( preg_match( '/goutti[eè]re/iu', $title ) ) {
            $spec = 'Profilage alu continu — Collecte pluviale grand débit anti-rouille et anti-débordement';
            $app  = 'Collecte et canalisation des eaux de pluie en bas de pente pour la sauvegarde des façades et fondations.';
        } elseif ( preg_match( '/noue/iu', $title ) ) {
            $spec = 'Noue d\'étanchéité formée en aluminium de premier choix — Résistance aux forts débits d\'orage';
            $app  = 'Évacuation des eaux aux arêtes rentrantes et carrefours de versants de toiture.';
        } elseif ( preg_match( '/bande/iu', $title ) ) {
            $spec = 'Bande ourlée anti-ruissellement — Solin et finition de raccordement d\'étanchéité latérale';
            $app  = 'Raccord contre murs verticaux, jouées de lucarnes et protections de soubassements.';
        }
    }
    // 3. Fixations et étanchéité
    elseif ( $cat === 'fixations-et-etancheite' || preg_match( '/vis|tirefond|tige|cavalier|toiturole|feutre/iu', $title ) ) {
        $pole_title = 'PÔLE 3 : FIXATIONS ZINGUÉES & ÉTANCHÉITÉ';
        $pole_desc  = 'Tirefonds anticorrosion zingués au pas métrique, vis auto-foreuses pour pannes métalliques/bois, cavaliers d\'onde et rouleaux bitumés Toiturole 900G pour étanchéité absolue.';
        if ( preg_match( '/vis\s+auto/iu', $title ) ) {
            $spec = 'Acier cémenté haute résistance zingué avec rondelle néoprène EPDM d\'étanchéité vulcanisée';
            $app  = 'Fixation directe et rapide en sommet d\'onde sur pannes métalliques IPN/UAP ou pannes bois.';
        } elseif ( preg_match( '/tirefond/iu', $title ) ) {
            $spec = 'Acier zingué au pas métrique haute résistance à la traction avec plaquette et rondelle feutre';
            $app  = 'Fixation lourde et durable sur charpentes bois traditionnelles et pannes massives.';
        } elseif ( preg_match( '/cavalier/iu', $title ) ) {
            $spec = 'Cavalier profilé en aluminium ou prélaqué avec garniture néoprène anti-écrasement';
            $app  = 'Répartition optimale de la pression de serrage sur les ondes de tôles BAC 4N, 5N et Tuiles D50.';
        } elseif ( preg_match( '/toiturole/iu', $title ) ) {
            $spec = 'Membrane d\'étanchéité bitumée lourde 900G armée — Rouleau de 10m x 1m résistant aux UV tropicaux';
            $app  = 'Sous-toiture, solins, chéneaux maçonnés, raccords de cheminée et étanchéité générale de toiture.';
        } elseif ( preg_match( '/feutre|rondelle|plaquette/iu', $title ) ) {
            $spec = 'Feutre bitumé dense imprégné — Boîte de 100 pièces imperméables anti-suintement';
            $app  = 'Jointoiement étanche sous tête de tirefond et vis de fixation de toiture.';
        }
    }
    // 4. Accessoires intérieurs
    elseif ( $cat === 'accessoires-interieurs' || preg_match( '/carreau|[eé]ponge|douche/iu', $title ) ) {
        $pole_title = 'PÔLE 4 : ACCESSOIRES INTÉRIEURS, CARRELAGE & PLASTURGIE';
        $pole_desc  = 'Carreaux grès cérame italien et espagnol 1er choix certifié pour sols et murs, douches thérapeutiques haute puissance et quincaillerie.';
        if ( preg_match( '/carreau/iu', $title ) ) {
            $spec = 'Grès Cérame 1er Choix Certifié — Haute résistance à l\'abrasion (PEI IV/V) et absorption d\'eau minimale';
            $app  = 'Revêtement de sols intérieurs, extérieurs, terrasses, salons, pièces d\'eau et façades murales.';
        } elseif ( preg_match( '/douche/iu', $title ) ) {
            $spec = 'Douche thérapeutique à résistance blindée et régulation électronique millimétrée';
            $app  = 'Installations sanitaires résidentielles, hôtels, complexes hospitaliers et résidences de standing.';
        } elseif ( preg_match( '/[eé]ponge/iu', $title ) ) {
            $spec = 'Éponge métallique inox industrielle anti-oxydation pour récurage et entretien intensif';
            $app  = 'Entretien ménager, décapage de surfaces métalliques, cuisines collectives et chantiers.';
        }
    }

    $existing_desc = $product->get_description() ?: $product->get_short_description();

    return [
        'sku'         => $sku,
        'pole_title'  => $pole_title,
        'pole_desc'   => $pole_desc,
        'spec'        => $spec,
        'app'         => $app,
        'garantie'    => $garantie,
        'desc'        => $existing_desc ?: ($title . ' — Matériau industriel garanti certifié par TPM SA.'),
        'stock'       => 'Disponible en Stock Usine (Bekoko & Douala PK12) — Enlèvement Ex-Works immédiat ou livraison chantier',
        'pdf_url'     => home_url('/?download_tpm_catalog=1'),
        'unit'        => $unit,
    ];
}

/**
 * Stream Catalogue PDF directly with clean attachment headers to avoid browser insecure download blocks
 */
add_action('init', 'tpm_handle_catalog_download');
function tpm_handle_catalog_download() {
    if ( isset($_GET['download_tpm_catalog']) && $_GET['download_tpm_catalog'] === '1' ) {
        $pdf_path = WP_CONTENT_DIR . '/uploads/catalogue-general-tpm-sa-2026.pdf';
        if ( ! file_exists($pdf_path) ) {
            $pdf_path = get_template_directory() . '/assets/docs/catalogue-general-tpm-sa-2026.pdf';
        }
        if ( file_exists($pdf_path) ) {
            while ( ob_get_level() ) {
                ob_end_clean();
            }
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="Catalogue_General_TPM_SA_2026.pdf"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($pdf_path));
            readfile($pdf_path);
            exit;
        }
    }
}
