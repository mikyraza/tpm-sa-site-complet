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
 * Helper d'image produit contextuelle (Haute Définition Usine)
 */
function tpm_get_product_image_url( $product ) {
    $img_dir = get_template_directory_uri() . '/assets/images/';
    if ( ! $product ) return $img_dir . 'prod1_tole.jpg';

    $sku  = strtoupper( $product->get_sku() );
    $name = strtolower( $product->get_name() );

    // 1. Tôles et toiture
    if ( str_starts_with( $sku, 'TOL' ) || str_contains( $name, 'tôle' ) || str_contains( $name, 'tole' ) ) {
        return $img_dir . 'prod1_tole.jpg';
    }

    // 2. Accessoires toiture (Faîtières, rives, gouttières, bandes)
    if ( str_starts_with( $sku, 'ACC' ) || str_contains( $name, 'faîtière' ) || str_contains( $name, 'faitiere' ) || str_contains( $name, 'gouttière' ) || str_contains( $name, 'noue' ) || str_contains( $name, 'rive' ) || str_contains( $name, 'bande' ) ) {
        return $img_dir . 'prod3_faitiere.jpg';
    }

    // 3. Fixations et étanchéité
    if ( str_starts_with( $sku, 'FIX' ) || str_contains( $name, 'vis' ) || str_contains( $name, 'tirefond' ) || str_contains( $name, 'cavalier' ) || str_contains( $name, 'rondelle' ) ) {
        if ( str_contains( $name, 'pointe' ) ) return $img_dir . 'prod7_pointe.jpg';
        if ( str_contains( $name, 'toiturole' ) || str_contains( $name, 'joint' ) || str_contains( $name, 'feutre' ) || str_contains( $name, 'bitum' ) ) return $img_dir . 'prod5_joint.jpg';
        return $img_dir . 'prod2_fixation.jpg';
    }

    // 4. Intérieur & Emballages & Carreaux
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




