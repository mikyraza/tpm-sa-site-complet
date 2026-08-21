<?php
/**
 * Script d'importation et de configuration WooCommerce TPM SA (Optimisé)
 */
require_once '/home/mikyraza/Local Sites/tpmcac/app/public/wp-load.php';

if ( ! class_exists( 'WooCommerce' ) ) {
    die( "WooCommerce n'est pas actif.\n" );
}

echo "=== 1. CONFIGURATION RÉGLAGES WOOCOMMERCE ===\n";

// Devise & Formats (XAF / FCFA)
update_option( 'woocommerce_currency', 'XAF' );
update_option( 'woocommerce_currency_pos', 'right_space' );
update_option( 'woocommerce_price_thousand_sep', ' ' );
update_option( 'woocommerce_price_decimal_sep', ',' );
update_option( 'woocommerce_price_num_decimals', 0 );

// TVA 19.25%
update_option( 'woocommerce_calc_taxes', 'yes' );
update_option( 'woocommerce_prices_include_tax', 'no' );
update_option( 'woocommerce_tax_display_shop', 'excl' );
update_option( 'woocommerce_tax_display_cart', 'excl' );
update_option( 'woocommerce_tax_total_display', 'itemized' );

global $wpdb;
$wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}woocommerce_tax_rates" );
$wpdb->insert(
    "{$wpdb->prefix}woocommerce_tax_rates",
    array(
        'tax_rate_country'  => 'CM',
        'tax_rate_state'    => '',
        'tax_rate'          => '19.2500',
        'tax_rate_name'     => 'TVA (19.25%)',
        'tax_rate_priority' => 1,
        'tax_rate_compound' => 0,
        'tax_rate_shipping' => 1,
        'tax_rate_order'    => 0,
        'tax_rate_class'    => '',
    )
);

// Activation BACS (Virement / Devis Pro-Forma B2B)
$bacs_settings = array(
    'enabled'     => 'yes',
    'title'       => 'Prise de Commande Pro-Forma B2B / Enlèvement Usine',
    'description' => 'Votre commande sera enregistrée sous forme de Bon Pro-Forma officiel B2B. Notre service commercial vous recontactera sous 2h pour la validation et les modalités d\'enlèvement usine ou livraison.',
    'instructions'=> 'Paiement par virement bancaire ou règlement à l\'enlèvement aux usines de Bekoko ou Douala PK12.',
);
update_option( 'woocommerce_bacs_settings', $bacs_settings );

echo "-> Devise, TVA (19.25%) et BACS configurés.\n";

echo "=== 2. CRÉATION DES 4 CATÉGORIES OFFICIELLES ===\n";

$categories = array(
    'toles-et-toiture'       => 'Tôles et toiture',
    'accessoires-toiture'    => 'Accessoires toiture',
    'fixations-et-etancheite'=> 'Fixations et étanchéité',
    'accessoires-interieurs' => 'Accessoires intérieurs',
);

$cat_ids = array();
foreach ( $categories as $slug => $name ) {
    $term = get_term_by( 'slug', $slug, 'product_cat' );
    if ( ! $term ) {
        $result = wp_insert_term( $name, 'product_cat', array( 'slug' => $slug ) );
        if ( ! is_wp_error( $result ) ) {
            $cat_ids[$slug] = $result['term_id'];
        }
    } else {
        $cat_ids[$slug] = $term->term_id;
    }
}
print_r( $cat_ids );

echo "=== 3. IMPORTATION DES ARTICLES RÉELS ===\n";

$raw_products = array(
    // 1. TÔLES ET TOITURE
    array('sku'=>'TOL-001','name'=>'Tôle Bac Alu 4N ET 5N 0,35','desc'=>'0,35 EN ML - Aluminium Nature','price'=>2600,'cat'=>'toles-et-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>1000),
    array('sku'=>'TOL-002','name'=>'Tôle Ondulée ALU 0,35 3M','desc'=>'0,35 3M - Feuille de 3 mètres','price'=>7000,'cat'=>'toles-et-toiture','color'=>'NATURE','unit'=>'feuille 3m','stock'=>100),
    array('sku'=>'TOL-003','name'=>'Tôles bacs ou ondulées alu 0,35 prélaquées','desc'=>'0,35 en ML prélaqué','price'=>3300,'cat'=>'toles-et-toiture','color'=>'VERT, BORDEAU, BLEU ARDOISE, TERACOTA','unit'=>'mètre linéaire','stock'=>1000),
    array('sku'=>'TOL-004','name'=>'Tôles bacs ou ondulées alu 5/10e Nature','desc'=>'5/10eme en ML Nature','price'=>4300,'cat'=>'toles-et-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>200),
    array('sku'=>'TOL-005','name'=>'Tôles bacs ou ondulées alu 5/10e Prélaquées','desc'=>'5/10eme en ML Prélaqué','price'=>5300,'cat'=>'toles-et-toiture','color'=>'VERT, BORDEAU, BLEU ARDOISE, TERACOTA','unit'=>'mètre linéaire','stock'=>500),
    array('sku'=>'TOL-006','name'=>'Tôles bacs ou ondulées alu 6/10e Nature','desc'=>'6/10eme en ML Nature','price'=>5500,'cat'=>'toles-et-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>300),
    array('sku'=>'TOL-007','name'=>'Tôles bacs ou ondulées alu 6/10e Prélaquées','desc'=>'6/10eme en ML Prélaqué','price'=>6500,'cat'=>'toles-et-toiture','color'=>'VERT, BORDEAU, BLEU ARDOISE, TERACOTA','unit'=>'mètre linéaire','stock'=>400),
    array('sku'=>'TOL-008','name'=>'Tôles bacs prélaquées B30 2ème choix','desc'=>'B30 2EME CHOIX AU ML','price'=>2000,'cat'=>'toles-et-toiture','color'=>'BORDEAU ET BLEU ARDOISE','unit'=>'mètre linéaire','stock'=>1000),
    array('sku'=>'TOL-009','name'=>'Tôles bacs prélaquées D50','desc'=>'D50 EN ML Haute Résistance','price'=>7500,'cat'=>'toles-et-toiture','color'=>'BORDEAU, BLEU CIEL ET ORANGE','unit'=>'mètre linéaire','stock'=>5000),
    array('sku'=>'TOL-010','name'=>'Tôles Tuile nervurale prélaquée D50','desc'=>'D50 EN ML Profil Tuile Design','price'=>11500,'cat'=>'toles-et-toiture','color'=>'BORDEAU, BLEU CIEL ET ORANGE','unit'=>'mètre linéaire','stock'=>1500),

    // 2. ACCESSOIRES TOITURE
    array('sku'=>'ACC-001','name'=>'Faîtière non Crantée Double Pente 0.35/0.33 Nature','desc'=>'Au ML 0,35 0,33 Nature','price'=>1400,'cat'=>'accessoires-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>500),
    array('sku'=>'ACC-002','name'=>'Faîtière centrale 0.33 en 0.35 ml Nature','desc'=>'Centrale 0,33 en 0,35 ml Nature','price'=>1400,'cat'=>'accessoires-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>500),
    array('sku'=>'ACC-003','name'=>'Faîtière non Crantée Double Pente 0.35/0.33 Prélaquée','desc'=>'Au ML 0,35 0,33 Prélaquée','price'=>1700,'cat'=>'accessoires-toiture','color'=>'BORDEAU, BLEU ARDOISE, VERT, TERACOTA','unit'=>'mètre linéaire','stock'=>500),
    array('sku'=>'ACC-004','name'=>'Faîtière centrale 0.33 en 0.35 ml Prélaquée','desc'=>'Centrale 0,33 en 0,35 ml Prélaquée','price'=>1700,'cat'=>'accessoires-toiture','color'=>'BORDEAU, BLEU ARDOISE, VERT, TERACOTA','unit'=>'mètre linéaire','stock'=>500),
    array('sku'=>'ACC-005','name'=>'Bandes ourlées 0.33/0.35 ml Nature','desc'=>'0,33 0,35 ml Nature','price'=>1400,'cat'=>'accessoires-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>300),
    array('sku'=>'ACC-006','name'=>'Bandes ourlées 0.33/0.35 ml Prélaquées','desc'=>'0,33 0,35 ml Prélaquées','price'=>1700,'cat'=>'accessoires-toiture','color'=>'BORDEAU, BLEU ARDOISE, VERT, TERACOTA','unit'=>'mètre linéaire','stock'=>300),
    array('sku'=>'ACC-007','name'=>'Rives de faîtage 0.33/0.35 ml Nature','desc'=>'0,33 0,35 ml Nature','price'=>1400,'cat'=>'accessoires-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>300),
    array('sku'=>'ACC-008','name'=>'Rives de faîtage 0.33/0.35 ml Prélaquées','desc'=>'0,33 0,35 ml Prélaquées','price'=>1700,'cat'=>'accessoires-toiture','color'=>'BORDEAU, BLEU ARDOISE, VERT, TERACOTA','unit'=>'mètre linéaire','stock'=>300),
    array('sku'=>'ACC-009','name'=>'Gouttière alu 0.33/0.35 ml Nature','desc'=>'Gouttière alu 0,33 0,35 Nature','price'=>1500,'cat'=>'accessoires-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>400),
    array('sku'=>'ACC-010','name'=>'Gouttières alu 0.33/0.35 ml Prélaquées','desc'=>'Gouttière alu 0,33 0,35 Prélaquées','price'=>1700,'cat'=>'accessoires-toiture','color'=>'BORDEAU, BLEU ARDOISE, VERT, TERACOTA','unit'=>'mètre linéaire','stock'=>400),
    array('sku'=>'ACC-011','name'=>'Noues en alu 0.33/0.35 ml Nature','desc'=>'Noues alu 0,33 0,35 Nature','price'=>1400,'cat'=>'accessoires-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>250),
    array('sku'=>'ACC-012','name'=>'Noues en alu 0.33/0.35 ml Prélaquées','desc'=>'Noues alu 0,33 0,35 Prélaquées','price'=>1700,'cat'=>'accessoires-toiture','color'=>'BORDEAU, BLEU ARDOISE, VERT, TERACOTA','unit'=>'mètre linéaire','stock'=>250),
    array('sku'=>'ACC-013','name'=>'Faîtière non Crantée 5/10eme Nature','desc'=>'Au ML 0,33 5/10eme Nature','price'=>2000,'cat'=>'accessoires-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>300),
    array('sku'=>'ACC-014','name'=>'Faîtière centrale 5/10eme Nature','desc'=>'Centrale 0,33 en 5/10eme Nature','price'=>2000,'cat'=>'accessoires-toiture','color'=>'NATURE','unit'=>'mètre linéaire','stock'=>300),
    array('sku'=>'ACC-015','name'=>'Faîtière non Crantée 0.40 Prélaquée','desc'=>'Au ML 0,33 0,40 Prélaquée','price'=>2100,'cat'=>'accessoires-toiture','color'=>'BORDEAU, BLEU ARDOISE, VERT, TERACOTA','unit'=>'mètre linéaire','stock'=>300),
    array('sku'=>'ACC-016','name'=>'Faîtière centrale 0.40 Prélaquée','desc'=>'Centrale 0,33 0,40 Prélaquée','price'=>2100,'cat'=>'accessoires-toiture','color'=>'BORDEAU, BLEU ARDOISE, VERT, TERACOTA','unit'=>'mètre linéaire','stock'=>300),

    // 3. FIXATIONS ET ÉTANCHÉITÉ
    array('sku'=>'FIX-001','name'=>'Vis Auto-foreuse 6X60','desc'=>'Vis Auto-foreuse 6X60 à l\'unité','price'=>27,'cat'=>'fixations-et-etancheite','color'=>'ALU','unit'=>'unité','stock'=>85000),
    array('sku'=>'FIX-002','name'=>'Vis Auto-foreuse 6X70','desc'=>'Vis Auto-foreuse 6X70 à l\'unité','price'=>30,'cat'=>'fixations-et-etancheite','color'=>'ALU','unit'=>'unité','stock'=>50000),
    array('sku'=>'FIX-003','name'=>'Tirefond 6x80 (Paquet 72 pcs)','desc'=>'Tirefond 6x80 conditionné en paquet de 72 pièces','price'=>1725,'cat'=>'fixations-et-etancheite','color'=>'GALVA','unit'=>'paquet 72 pcs','stock'=>504),
    array('sku'=>'FIX-004','name'=>'Tirefond 6x60 (Paquet 72 pcs)','desc'=>'Tirefond 6x60 conditionné en paquet de 72 pièces','price'=>1450,'cat'=>'fixations-et-etancheite','color'=>'GALVA','unit'=>'paquet 72 pcs','stock'=>2280),
    array('sku'=>'FIX-005','name'=>'Rondelles feutres bitumées (Boîte 100 pcs)','desc'=>'Boîte de 100 rondelles feutres bitumées','price'=>500,'cat'=>'fixations-et-etancheite','color'=>'NOIR','unit'=>'boîte 100 pcs','stock'=>1000),
    array('sku'=>'FIX-006','name'=>'Plaquettes feutres bitumées (Boîte 100 pcs)','desc'=>'Boîte de 100 plaquettes feutres bitumées','price'=>1000,'cat'=>'fixations-et-etancheite','color'=>'NOIR','unit'=>'boîte 100 pcs','stock'=>1000),
    array('sku'=>'FIX-007','name'=>'Cavaliers alu Nature','desc'=>'Cavaliers alu Nature à l\'unité','price'=>1500,'cat'=>'fixations-et-etancheite','color'=>'NATURE','unit'=>'unité','stock'=>2000),
    array('sku'=>'FIX-008','name'=>'Cavaliers alu Prélaqués','desc'=>'Cavaliers alu prélaqués','price'=>1500,'cat'=>'fixations-et-etancheite','color'=>'VERT FORET, BLEU ARDOISE, BORDEAU, TERACOTTA','unit'=>'unité','stock'=>2000),
    array('sku'=>'FIX-009','name'=>'Tiges filetées 6x300 Alu Nature','desc'=>'Tiges filetées 6x300 à la pièce','price'=>250,'cat'=>'fixations-et-etancheite','color'=>'ALU NATURE','unit'=>'pièce','stock'=>3000),
    array('sku'=>'FIX-010','name'=>'Toiturole 900G','desc'=>'Toiturole 900G rouleau étanchéité toiture','price'=>7000,'cat'=>'fixations-et-etancheite','color'=>'NOIR','unit'=>'rouleau','stock'=>500),

    // 4. ACCESSOIRES INTÉRIEURS
    array('sku'=>'INT-001','name'=>'Cartons Carreaux Murs 25X40 REF PMC42054C','desc'=>'Carreaux Murale 25X40 Verony','price'=>5400,'cat'=>'accessoires-interieurs','color'=>'BLANC/GRIS','unit'=>'carton','stock'=>98),
    array('sku'=>'INT-002','name'=>'Cartons Carreaux Murs 25X40 REF PMC42028C','desc'=>'Carreaux Murale 25X40 Verony','price'=>5400,'cat'=>'accessoires-interieurs','color'=>'BEIGE','unit'=>'carton','stock'=>87),
    array('sku'=>'INT-003','name'=>'Cartons Carreaux Murs 25X40 REF PMC42012C','desc'=>'Carreaux Murale 25X40 Verony','price'=>5400,'cat'=>'accessoires-interieurs','color'=>'BLANC','unit'=>'carton','stock'=>90),
    array('sku'=>'INT-004','name'=>'Cartons Carreaux Murs 25X40 REF PMC42064C','desc'=>'Carreaux Murale 25X40 Verony','price'=>5400,'cat'=>'accessoires-interieurs','color'=>'BLEU','unit'=>'carton','stock'=>81),
    array('sku'=>'INT-005','name'=>'Cartons Carreaux Sol 40X40 REF NMG44001C','desc'=>'Carreaux Sol Grès 40X40','price'=>7680,'cat'=>'accessoires-interieurs','color'=>'GRIS','unit'=>'carton','stock'=>240),
    array('sku'=>'INT-006','name'=>'Cartons Carreaux Sol 40X40 REF FGP44044C','desc'=>'Carreaux Sol Grès 40X40','price'=>7680,'cat'=>'accessoires-interieurs','color'=>'BEIGE','unit'=>'carton','stock'=>26),
    array('sku'=>'INT-007','name'=>'Cartons Carreaux Sol 40X40 REF YMG44223C','desc'=>'Carreaux Sol Grès 40X40','price'=>7680,'cat'=>'accessoires-interieurs','color'=>'MARRON','unit'=>'carton','stock'=>125),
    array('sku'=>'INT-008','name'=>'Cartons Carreaux Sol 40X40 REF YMG44008C','desc'=>'Carreaux Sol Grès 40X40','price'=>7680,'cat'=>'accessoires-interieurs','color'=>'CREME','unit'=>'carton','stock'=>135),
    array('sku'=>'INT-009','name'=>'Cartons Carreaux Sol 30X30 REF FGP33023C','desc'=>'Carreaux Sol Grès 30X30','price'=>7680,'cat'=>'accessoires-interieurs','color'=>'GRIS','unit'=>'carton','stock'=>15),
    array('sku'=>'INT-010','name'=>'Cartons Carreaux Sol 60X60 Italien','desc'=>'Grès Cérame 60X60 Italien 1er Choix','price'=>20880,'cat'=>'accessoires-interieurs','color'=>'MARBRE BLANC','unit'=>'carton','stock'=>100),
    array('sku'=>'INT-011','name'=>'Cartons Carreaux Sol 32X60 Espagnole','desc'=>'Carreaux Sol 32X60 Import Espagne','price'=>18820,'cat'=>'accessoires-interieurs','color'=>'BEIGE','unit'=>'carton','stock'=>80),
    array('sku'=>'INT-012','name'=>'Cartons Carreaux Sol 15X80 1er Choix Chinois','desc'=>'Parquet Céramique 15X80','price'=>15000,'cat'=>'accessoires-interieurs','color'=>'BOIS NATUR','unit'=>'carton','stock'=>150),
    array('sku'=>'INT-013','name'=>'Cartons Carreaux Sol 60X120 Italien','desc'=>'Grès Cérame 60X120 Grand Format Italien','price'=>36000,'cat'=>'accessoires-interieurs','color'=>'MARBRE NOIR/BLANC','unit'=>'carton','stock'=>50),
    array('sku'=>'INT-014','name'=>'Cartons Carreaux Sol 30X60 1er Choix Chinois','desc'=>'Carreaux Sol 30X60 1er Choix','price'=>15840,'cat'=>'accessoires-interieurs','color'=>'GRIS CLAIR','unit'=>'carton','stock'=>120),
    array('sku'=>'INT-015','name'=>'Douche Thérapeutique Astra/Cardal Petit Modèle','desc'=>'Douche Thérapeutique Individuel Petit Modèle (Astra, Doccia, Cardal, Maxi Ducha)','price'=>34900,'cat'=>'accessoires-interieurs','color'=>'BLANC','unit'=>'unité','stock'=>30),
    array('sku'=>'INT-016','name'=>'Douche Thérapeutique Zagonel Moment Grand Modèle','desc'=>'Douche Thérapeutique Individuel Grand Modèle Zagonel Moment','price'=>79900,'cat'=>'accessoires-interieurs','color'=>'BLANC/CHROME','unit'=>'unité','stock'=>20),
    array('sku'=>'INT-017','name'=>'Douche Thérapeutique Loren Shower Grand Modèle','desc'=>'Douche Thérapeutique Individuel Grand Modèle Loren Shower','price'=>89900,'cat'=>'accessoires-interieurs','color'=>'BLANC/CHROME','unit'=>'unité','stock'=>25),
    array('sku'=>'INT-018','name'=>'Douche Thérapeutique Duo Shower Grand Modèle','desc'=>'Douche Thérapeutique Individuel Grand Modèle Duo Shower','price'=>139900,'cat'=>'accessoires-interieurs','color'=>'CHROME','unit'=>'unité','stock'=>15),
    array('sku'=>'INT-019','name'=>'Douche Thérapeutique Central Cardal','desc'=>'Chauffe-eau Douche Thérapeutique Central Cardal','price'=>59900,'cat'=>'accessoires-interieurs','color'=>'BLANC','unit'=>'unité','stock'=>10),
    array('sku'=>'INT-020','name'=>'Douche Thérapeutique Central Lorenzetti','desc'=>'Chauffe-eau Douche Thérapeutique Central Lorenzetti','price'=>59900,'cat'=>'accessoires-interieurs','color'=>'BLANC','unit'=>'unité','stock'=>10),
    array('sku'=>'INT-021','name'=>'Éponges Métalliques Non Doublées (Sachet de 25p)','desc'=>'Sachet de 25 pièces éponges métalliques industrielles TPM','price'=>22500,'cat'=>'accessoires-interieurs','color'=>'ALU','unit'=>'sachet 25p','stock'=>28),
    array('sku'=>'INT-022','name'=>'Éponges Métalliques Doublées (Sachet de 20p)','desc'=>'Sachet de 20 pièces éponges métalliques doublées renforcées TPM','price'=>25000,'cat'=>'accessoires-interieurs','color'=>'ALU','unit'=>'sachet 20p','stock'=>50),
);

$imported = 0;
foreach ( $raw_products as $p ) {
    $existing_id = wc_get_product_id_by_sku( $p['sku'] );
    if ( $existing_id ) {
        $product = wc_get_product( $existing_id );
    } else {
        $product = new WC_Product_Simple();
    }

    $product->set_sku( $p['sku'] );
    $product->set_name( $p['name'] );
    $product->set_description( $p['desc'] );
    $product->set_short_description( $p['desc'] );
    $product->set_regular_price( $p['price'] );
    $product->set_manage_stock( true );
    $product->set_stock_quantity( $p['stock'] );
    $product->set_stock_status( 'instock' );

    // Catégorie
    if ( isset( $cat_ids[$p['cat']] ) ) {
        $product->set_category_ids( array( $cat_ids[$p['cat']] ) );
    }

    // Sauvegarde & Metas
    $product_id = $product->save();
    update_post_meta( $product_id, '_unit', $p['unit'] );
    update_post_meta( $product_id, '_colors', $p['color'] );

    // Featured
    if ( in_array( $p['sku'], array( 'TOL-001', 'TOL-003', 'ACC-001', 'FIX-001', 'FIX-003', 'INT-010' ) ) ) {
        $product->set_featured( true );
        $product->save();
    }

    $imported++;
}

echo "=== IMPORTATION TERMINÉE : $imported PRODUITS IMPORTÉS AVEC SUCCÈS ===\n";
