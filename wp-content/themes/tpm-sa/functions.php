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
    // Google Fonts
    wp_enqueue_style( 'tpm-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap',
        array(), null );

    // Material Symbols
    wp_enqueue_style( 'tpm-material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
        array(), null );

    // Theme main stylesheet
    wp_enqueue_style( 'tpm-sa-style', get_stylesheet_uri(), array(), '1.0.2' );

    // Theme JS
    wp_enqueue_script( 'tpm-sa-scripts',
        get_template_directory_uri() . '/assets/js/main.js',
        array(), '1.0.2', true );

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
}
add_action( 'wp_enqueue_scripts', 'tpm_sa_scripts', 100 );

// Supprimer le CSS global-styles injecté inline
remove_action( 'wp_head', 'wp_global_styles_render_svg_filters' );
add_filter( 'wp_get_global_stylesheet', '__return_empty_string' );
remove_action( 'wp_head', '_admin_bar_bump_cb' );
add_filter( 'show_admin_bar', '__return_false' );

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
 * Sauvegarder les attributs Flash Pro-Forma (Longueur, Couleur)
 */
add_filter('woocommerce_add_cart_item_data', function($cart_item_data, $product_id, $variation_id) {
    if (!empty($_POST['flash-length'])) {
        $cart_item_data['flash_length'] = sanitize_text_field($_POST['flash-length']);
    }
    if (!empty($_POST['flash-color'])) {
        $cart_item_data['flash_color'] = sanitize_text_field($_POST['flash-color']);
    }
    return $cart_item_data;
}, 10, 3);

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
    if ( ! $product ) return get_template_directory_uri() . '/assets/images/prod1_tole.jpg';
    
    $thumb_id = $product->get_image_id();
    if ( $thumb_id ) {
        $img = wp_get_attachment_image_url( $thumb_id, 'large' );
        if ( $img ) return $img;
    }

    $sku  = strtoupper( $product->get_sku() );
    $name = strtolower( $product->get_name() );
    $img_dir = get_template_directory_uri() . '/assets/images/';

    // 1. Tôles et toiture
    if ( str_starts_with( $sku, 'TOL' ) || str_contains( $name, 'tôle' ) || str_contains( $name, 'tole' ) ) {
        return $img_dir . 'prod1_tole.jpg';
    }

    // 2. Accessoires toiture
    if ( str_starts_with( $sku, 'ACC' ) || str_contains( $name, 'faîtière' ) || str_contains( $name, 'faitiere' ) || str_contains( $name, 'gouttière' ) || str_contains( $name, 'noue' ) || str_contains( $name, 'rive' ) ) {
        return $img_dir . 'prod3_faitiere.jpg';
    }

    // 3. Fixations et étanchéité
    if ( str_starts_with( $sku, 'FIX' ) || str_contains( $name, 'vis' ) || str_contains( $name, 'tirefond' ) || str_contains( $name, 'cavalier' ) || str_contains( $name, 'rondelle' ) ) {
        if ( str_contains( $name, 'pointe' ) ) return $img_dir . 'prod7_pointe.jpg';
        if ( str_contains( $name, 'toiturole' ) || str_contains( $name, 'joint' ) || str_contains( $name, 'feutre' ) ) return $img_dir . 'prod5_joint.jpg';
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


