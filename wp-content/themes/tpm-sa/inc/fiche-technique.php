<?php
/**
 * wp-content/themes/tpm-sa/inc/fiche-technique.php
 * Générateur officiel des Fiches Techniques Certifiées TPM SA (Groupe CAC)
 * Conforme au standard certifié de Fiche Technique Industrielle (2 Pages)
 */

defined( 'ABSPATH' ) || exit;

/**
 * Construit la Fiche Technique complète et certifiée d'un produit TPM SA
 */
function tpm_get_product_fiche_technique( $product ) {
    if ( ! $product ) return [];

    $id       = $product->get_id();
    $title    = $product->get_name();
    $sku      = $product->get_sku() ?: ('TPM-' . $id);
    $unit     = get_post_meta( $id, '_unit', true ) ?: 'unité';
    $terms    = wp_get_post_terms( $id, 'product_cat', ['fields' => 'slugs'] );
    $cat_slug = ! empty( $terms ) ? $terms[0] : '';

    $ref          = $sku;
    $designation  = $title;
    $category     = 'Matériaux de Construction Métallurgiques & BTP';
    $pole         = 'Pôle Industriel TPM SA';
    $material     = 'Aluminium de Premier Choix / Acier Certifié';
    $profil       = 'Profilage Industriel Conforme aux Normes Camerounaises';
    $epaisseur    = 'Épaisseur Réelle Contrôlée en Laboratoire Usine';
    $finition     = 'Finition Industrielle Protégée';
    $longueurs    = 'Formats standards usine ou découpe sur-mesure au centimètre près';
    $description  = $product->get_description() ?: $product->get_short_description();
    $avantages    = [
        "Matières premières certifiées 1er choix pour une durabilité maximale au Cameroun.",
        "Haute résistance mécanique et protection éprouvée contre la corrosion marine et tropicale.",
        "Précision dimensionnelle stricte garantissant une pose rapide et sans ajustement sur chantier.",
        "Disponibilité permanente et enlèvement immédiat aux usines de Douala PK12 et Bekoko."
    ];
    $applications = "Bâtiments industriels, hangars de stockage, complexes commerciaux et résidences de standing.";
    $pose         = "Pose conforme aux règles de l'art BTP et aux spécifications techniques TPM SA.";

    $product_family = 'tole';
    $ral_swatches = [
        ['name' => 'Bleu Outremer', 'ral' => 'RAL 5002', 'hex' => '#1D4ED8'],
        ['name' => 'Rouge Tuile / Basque', 'ral' => 'RAL 3004/3011', 'hex' => '#881337'],
        ['name' => 'Vert Mousse', 'ral' => 'RAL 6005', 'hex' => '#14532D'],
        ['name' => 'Gris Anthracite', 'ral' => 'RAL 7016', 'hex' => '#334155'],
        ['name' => 'Brun Chocolat', 'ral' => 'RAL 8017', 'hex' => '#451A03'],
    ];

    // =========================================================================
    // 1. TÔLES ET COUVERTURE (SHEETS)
    // =========================================================================
    if ( $cat_slug === 'toles-et-toiture' || preg_match( '/tôle|tole/iu', $title ) ) {
        $product_family = 'tole';
        $pole = 'Pôle 1 : Tôles de Couverture & Bacs Aluminium';

        if ( preg_match( '/tuile/iu', $title ) ) {
            $category        = 'Tôles de Couverture Nervurées Style Tuile Architecturale';
            $material        = 'Aluminium Prélaqué Cuit au Four Haute Densité';
            $profil          = 'Profil Ondulé Tuile Nervurale D50 Renforcé';
            $epaisseur       = '0,50 mm réel garanti';
            $epaisseur_val   = '0,50 mm';
            $finition        = 'Prélaquage Polyester Haute Résistance UV (Bordeaux RAL 3005, Terracotta, etc.)';
            $longueurs       = '2,00 m à 6,00 m (ou profilage continu jusqu\'à 12 m)';
            $header_title    = "TÔLES TUILE NERVURALE PRÉLAQUÉE D50 ARCHITECTURALE (0,50 MM)";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Couverture Résidentielle de Standing";
            $commercial_desc = "La tôle Tuile nervurale prélaquée D50 allie l'élégance intemporelle des toitures traditionnelles en terre cuite à la légèreté et l'inaltérabilité de l'aluminium pur. Son profilage exclusif confère aux résidences et édifices de prestige un cachet architectural de grand standing tout en assurant une imperméabilité absolue et un écoulement parfait face aux tornades équatoriales.";
            $pills = [
                "FINITION PRÉLAQUÉE AU FOUR",
                "PROFIL TUILE D50 NERVURÉ",
                "ÉPAISSEUR 0,50 MM RÉEL",
                "100% INOXYDABLE",
                "ESTHÉTIQUE PRESTIGE"
            ];
            $points_forts = [
                ['icon' => 'palette', 'title' => 'Esthétique Tuile & Teintes Nobles', 'desc' => 'Cachet architectural tuile romane sans les contraintes de poids ni de fragilité des matériaux maçonnés.'],
                ['icon' => 'shield', 'title' => 'Zéro Rouille / Double Barrière', 'desc' => 'Aluminium premier choix allié à un laquage polyester thermodurci inaltérable sous fort ensoleillement.'],
                ['icon' => 'architecture', 'title' => 'Rigidité Structurelle Renforcée', 'desc' => 'Nervurage D50 apportant une résistance remarquable aux vents violents et charges de toiture.'],
                ['icon' => 'feather', 'title' => 'Division de Charge Charpente', 'desc' => 'Poids 5 fois plus léger que la tuile en terre cuite, générant de substantielles économies sur le bois d\'œuvre.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Tôle Tuile Nervurale D50', 'Norme / Tolérance Usine'],
                'rows' => [
                    ['label' => 'Matériau de base', 'bac' => 'Alliage Aluminium Première Fusion', 'ondu' => 'Norme Camerounaise (NC)'],
                    ['label' => 'Revêtement de surface', 'bac' => 'Prélaquage Polyester / PVDF (25 µm)', 'ondu' => 'Résistance UV certifiée'],
                    ['label' => 'Épaisseur nominale', 'bac' => '0,50 mm massif garanti', 'ondu' => 'Tolérance micrométrique'],
                    ['label' => 'Type de profilage', 'bac' => 'Ondes trapézoïdales profil tuile D50', 'ondu' => 'Pas régulier 350 mm'],
                    ['label' => 'Largeur totale / utile', 'bac' => 'Totale : 1050 mm | Utile : 950 mm', 'ondu' => 'Recouvrement 1 nervure'],
                    ['label' => 'Coloris disponibles', 'bac' => 'Bordeaux Tuile (RAL 3005), Bleu, Vert, Noir', 'ondu' => 'Nuancier standard RAL'],
                    ['label' => 'Longueurs de commande', 'bac' => '2,00 m à 6,00 m (découpe sur mesure)', 'ondu' => 'Au centimètre près'],
                    ['label' => 'Pente minimale conseillée', 'bac' => '≥ 10% (environ 6°)', 'ondu' => 'Écoulement garanti'],
                    ['label' => 'Entraxe recommandé pannes', 'bac' => '70 cm maximum', 'ondu' => 'Conforme règles BTP']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de pose', 'text' => 'Montage de bas en haut (de l\'égout vers le faîtage), en sens opposé aux vents dominants.'],
                ['label' => 'Recouvrement', 'text' => 'Recouvrement latéral d\'une nervure complète avec joint d\'étanchéité, raccord transversal de 15 à 20 cm.'],
                ['label' => 'Fixation étanche laquée', 'text' => 'Fixer obligatoirement sur les sommets de nervures avec vis auto-foreuses laquées assorties et cavaliers prélaqués.'],
                ['label' => 'Accessoires assortis', 'text' => 'Faîtières crantées assorties profil D50, rives d\'extrémité et bandes d\'égout prélaquées coordonnées.']
            ];
        } elseif ( preg_match( '/d50/iu', $title ) ) {
            $category        = 'Tôles Industrielles Haute Rigidité (Profil D50)';
            $material        = 'Aluminium Prélaqué 1er Choix';
            $profil          = 'Profil BAC D50 à ondes profondes trapézoïdales';
            $epaisseur       = '0,50 mm réel garanti';
            $epaisseur_val   = '0,50 mm';
            $finition        = 'Prélaquage Polyester Double Face Haute Durabilité';
            $longueurs       = 'Sur-mesure de 2,00 m à 12,00 m au centimètre près';
            $header_title    = "TÔLES BACS INDUSTRIELLES HAUTE RIGIDITÉ PROFIL D50 (0,50 MM)";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Bâtiments Industriels & Grandes Portées";
            $commercial_desc = "Profilé avec des nervures profondes de 50 mm, le BAC D50 est spécialement conçu pour franchir de très grandes portées entre pannes de charpente sans aucun risque de fléchissement. Référence par excellence des hangars logistiques, usines et supermarchés, il assure un débit d'évacuation pluviale maximal sous les pluies tropicales les plus intenses.";
            $pills = [
                "NERVURES PROFONDES 50 MM",
                "PORTÉES JUSQU'À 1,50 M",
                "ÉPAISSEUR 0,50 MM RÉEL",
                "DÉBIT HYDRAULIQUE MAX",
                "ZÉRO ROUILLE"
            ];
            $points_forts = [
                ['icon' => 'architecture', 'title' => 'Inertie & Grandes Portées', 'desc' => 'Nervures de 50 mm autorisant un espacement maximal des pannes de charpente, réduisant le coût global.'],
                ['icon' => 'shield', 'title' => 'Résistance aux Surcharges', 'desc' => 'Rigidité structurelle exceptionnelle permettant la circulation sécurisée du personnel d\'entretien de toiture.'],
                ['icon' => 'water_drop', 'title' => 'Évacuation Pluviale Haute Capacité', 'desc' => 'Profil de canalisation profond évitant tout débordement latéral même sous les fortes averses équatoriales.'],
                ['icon' => 'palette', 'title' => 'Finitions & Teintes Durables', 'desc' => 'Laquage au four résistant aux atmosphères industrielles acides et aux projections maritimes côtières.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Tôle BAC D50 Haute Rigidité', 'Norme / Tolérance Usine'],
                'rows' => [
                    ['label' => 'Matériau de base', 'bac' => 'Alliage Aluminium 1ère Fusion Haute Résistance', 'ondu' => 'Contrôle laboratoire'],
                    ['label' => 'Revêtement de surface', 'bac' => 'Prélaquage Polyester / PVDF (20-25 µm)', 'ondu' => 'Garantie anti-écaillage'],
                    ['label' => 'Épaisseur nominale', 'bac' => '0,50 mm réel certifié', 'ondu' => 'Zéro compromis'],
                    ['label' => 'Profondeur de nervure', 'bac' => '50 mm (H=50 mm avec raidisseurs)', 'ondu' => 'Inertie maximale'],
                    ['label' => 'Largeur utile / totale', 'bac' => 'Utile : ~850 mm | Totale : ~920 mm', 'ondu' => 'Conforme standard'],
                    ['label' => 'Longueurs disponibles', 'bac' => 'De 2,00 m à 12,00 m continu', 'ondu' => 'Sur-mesure exact'],
                    ['label' => 'Entraxe maximal pannes', 'bac' => 'Jusqu\'à 1,20 m à 1,50 m selon charge', 'ondu' => 'Économie charpente'],
                    ['label' => 'Pente minimale conseillée', 'bac' => '≥ 5% (très faible pente acceptée)', 'ondu' => 'Étanchéité totale']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de pose', 'text' => 'Alignement rigoureux des tôles avec recouvrement d\'une nervure complète dans le sens de la pente.'],
                ['label' => 'Fixation sur charpente', 'text' => 'Fixer sur pannes métalliques IPN/IPE ou pannes bois avec vis auto-foreuses 6x70 et cavaliers renforcés D50.'],
                ['label' => 'Serrage', 'text' => 'Serrage calibré assurant la compression du joint néoprène sans déformer la nervure haute.'],
                ['label' => 'Finitions', 'text' => 'Associer des faîtières à crans profonds D50 et des rives de bardage coordonnées.']
            ];
        } elseif ( preg_match( '/6\/10|0[,.]60/iu', $title ) ) {
            $is_prelaque     = preg_match( '/pr[eé]laqu/iu', $title );
            $category        = 'Toitures Calibre Lourd Haute Résistance (Épaisseur 6/10e)';
            $material        = $is_prelaque ? 'Aluminium Prélaqué Cuit au Four' : 'Aluminium Naturel Massif 1er Choix';
            $profil          = 'Profil BACS Nervuré ou Ondulé Sinusoïdal';
            $epaisseur       = '0,60 mm massif réel garanti';
            $epaisseur_val   = '0,60 mm';
            $finition        = $is_prelaque ? 'Prélaquage Teintes RAL Cuit au Four' : 'Aluminium Brut Naturel Inaltérable';
            $longueurs       = '2,00 m à 12,00 m sur profilage continu';
            $header_title    = "TÔLES BACS & ONDULÉES ALUMINIUM MASSIF 6/10E (0,60 MM)";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Toitures Calibre Lourd & Environnements Agressifs";
            $commercial_desc = "Avec son épaisseur massive de 0,60 mm réel garanti, cette tôle constitue le sommet absolu de la robustesse mécanique et de la durabilité. Insensible aux chutes de branches, aux déformations sous les dépressions cycloniques et aux embruns salins côtiers, elle offre une durée de vie prouvée de plus de 50 ans sans aucune trace d'oxydation.";
            $pills = [
                "ÉPAISSEUR MASSIVE 0,60 MM",
                "INDÉFORMABLE AUX CHOCS",
                "RÉSISTANCE CORROSION MARINE",
                "ISOLATION ACOUSTIQUE SUPÉRIEURE",
                "DURABILITÉ > 50 ANS"
            ];
            $points_forts = [
                ['icon' => 'shield', 'title' => 'Épaisseur Massive 6/10e', 'desc' => 'Solidité incomparable face aux surcharges, grêle, chutes d\'objets et vents violents du littoral.'],
                ['icon' => 'verified', 'title' => 'Garantie Zéro Corrosion Côtière', 'desc' => 'Spécialement recommandée pour Douala, Kribi, Limbé et les installations portuaires exposées aux embruns.'],
                ['icon' => 'volume_down', 'title' => 'Atténuation Phonique Supérieure', 'desc' => 'Masse surfacique supérieure amortissant efficacement le bruit des fortes précipitations sur la toiture.'],
                ['icon' => 'architecture', 'title' => 'Profilage Continu sur Mesure', 'desc' => 'Profilage usine jusqu\'à 12 mètres sans raccord intermédiaire, éliminant tout risque d\'infiltration.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Tôle Alu 6/10e Naturelle', 'Tôle Alu 6/10e Prélaquée'],
                'rows' => [
                    ['label' => 'Matériau de base', 'bac' => 'Aluminium Pur 1ère Fusion', 'ondu' => 'Aluminium Pur + Laquage Four'],
                    ['label' => 'Épaisseur nominale', 'bac' => '0,60 mm réel (6/10e)', 'ondu' => '0,60 mm réel (6/10e)'],
                    ['label' => 'Revêtement', 'bac' => 'Couche naturelle d\'alumine passive', 'ondu' => 'Polyester thermodurci 25 µm'],
                    ['label' => 'Profils disponibles', 'bac' => 'BAC trapézoïdal 4N/5N ou Ondulé', 'ondu' => 'BAC trapézoïdal 4N/5N ou Ondulé'],
                    ['label' => 'Largeur totale / utile', 'bac' => 'Totale : 1000 mm | Utile : 880-920 mm', 'ondu' => 'Totale : 1000 mm | Utile : 880-920 mm'],
                    ['label' => 'Coloris', 'bac' => 'Alu Naturel Brillant Inaltérable', 'ondu' => 'Nuancier RAL (Bleu, Rouge, Vert, etc.)'],
                    ['label' => 'Durée de vie estimée', 'bac' => '> 50 ans sans entretien', 'ondu' => '> 50 ans sans entretien'],
                    ['label' => 'Entraxe des pannes', 'bac' => 'Jusqu\'à 1,00 m à 1,20 m', 'ondu' => 'Jusqu\'à 1,00 m à 1,20 m']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de pose', 'text' => 'Montage de bas vers le haut avec recouvrement latéral de 1 à 1,5 onde selon exposition.'],
                ['label' => 'Fixation robuste', 'text' => 'Fixation sur charpente par tirefonds 6x80 zingués (bois) ou vis auto-foreuses 6x70 laquées (métal).'],
                ['label' => 'Cavaliers indispensables', 'text' => 'Intercaler systématiquement des cavaliers en aluminium épais et des rondelles bitumées.'],
                ['label' => 'Raccords de faîtage', 'text' => 'Associer des faîtières 5/10e ou 6/10e de même nuance pour une étanchéité parfaite.']
            ];
        } elseif ( preg_match( '/5\/10|0[,.]50/iu', $title ) ) {
            $is_prelaque     = preg_match( '/pr[eé]laqu/iu', $title );
            $category        = 'Toitures Calibre Médium Renforcé (Épaisseur 5/10e)';
            $material        = $is_prelaque ? 'Aluminium Prélaqué Haute Durabilité' : 'Aluminium Brut Naturel Premier Choix';
            $profil          = 'Profil BACS 4N/5N ou Profil Ondulé';
            $epaisseur       = '0,50 mm massif réel garanti';
            $epaisseur_val   = '0,50 mm';
            $finition        = $is_prelaque ? 'Prélaquage Polyester Haute Brillance (Bordeaux, Bleu, Vert)' : 'Aluminium Brut Satiné';
            $longueurs       = 'Coupe sur mesure de 2,00 m à 12,00 m';
            $header_title    = "TÔLES BACS & ONDULÉES ALUMINIUM 5/10E (0,50 MM)";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Couverture Résidentielle & Chantiers BTP";
            $commercial_desc = "Standard d'excellence plébiscité par les constructeurs et architectes au Cameroun, la tôle 5/10e (0,50 mm) conjugue une tenue mécanique exemplaire face aux dépressions de vent et un rapport coût/durabilité optimal pour les toitures pérennes. Son épaisseur réelle contrôlée élimine tout risque de gondolement sous la chaleur équatoriale.";
            $pills = [
                "ÉPAISSEUR STANDARD 0,50 MM",
                "PLANÉITÉ REMARQUABLE",
                "100% INOXYDABLE",
                "FINITION NATURE OU PRÉLAQUÉE",
                "GARANTIE DE DURABILITÉ"
            ];
            $points_forts = [
                ['icon' => 'architecture', 'title' => 'Planéité & Rigidité 0,50 mm', 'desc' => 'Épaisseur réelle 0,50 mm garantissant des versants parfaitement rectilignes sans affaissement.'],
                ['icon' => 'shield', 'title' => 'Zéro Oxydation sous Pluies Acides', 'desc' => 'Aluminium de première fusion insensible aux pluies équatoriales acides et aux UV intenses.'],
                ['icon' => 'palette', 'title' => 'Rendu Visuel Contemporain', 'desc' => 'Disponible en finition brillante naturelle inaltérable ou laquée multicouche au nuancier RAL.'],
                ['icon' => 'local_shipping', 'title' => 'Disponibilité Immédiate PK12/Bekoko', 'desc' => 'Parc de profilage permanent permettant un chargement sur camion immédiat à l\'usine.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Tôle Bac Alu 5/10e Nature', 'Tôle Bac Alu 5/10e Prélaquée'],
                'rows' => [
                    ['label' => 'Matériau de base', 'bac' => 'Alliage Aluminium 1ère Fusion', 'ondu' => 'Alliage Aluminium 1ère Fusion'],
                    ['label' => 'Épaisseur nominale', 'bac' => '0,50 mm (5/10e)', 'ondu' => '0,50 mm (5/10e)'],
                    ['label' => 'Revêtement', 'bac' => 'Brut naturel inaltérable', 'ondu' => 'Prélaquage four Polyester / PVDF'],
                    ['label' => 'Profilage', 'bac' => 'Nervures 4N ou 5N renforcées', 'ondu' => 'Nervures 4N ou 5N renforcées'],
                    ['label' => 'Largeur utile / totale', 'bac' => 'Utile : ~850-920 mm | Totale : ~1000 mm', 'ondu' => 'Utile : ~850-920 mm | Totale : ~1000 mm'],
                    ['label' => 'Pente conseillée', 'bac' => '≥ 7% à 10%', 'ondu' => '≥ 7% à 10%'],
                    ['label' => 'Entraxe pannes', 'bac' => '70 cm à 90 cm maximum', 'ondu' => '70 cm à 90 cm maximum']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de pose', 'text' => 'Pose de bas en haut face aux vents pluvieux dominants.'],
                ['label' => 'Recouvrement', 'text' => 'Recouvrement latéral d\'une nervure complète avec joint EPDM, raccord transversal de 15 à 20 cm.'],
                ['label' => 'Fixation étanche', 'text' => 'Fixation sur sommet d\'onde avec vis auto-foreuses ou tirefonds avec cavaliers assortis.'],
                ['label' => 'Accessoires', 'text' => 'Compléter avec les faîtières 5/10e et rives coordonnées de la gamme TPM SA.']
            ];
        } elseif ( preg_match( '/b30/iu', $title ) ) {
            $category        = 'Tôles Bacs Prélaquées Économiques (Gamme B30 2ème Choix)';
            $material        = 'Acier Galvanisé Prélaqué Contrôlé';
            $profil          = 'Profil Nervuré B30 Économique';
            $epaisseur       = '0,30 mm à 0,35 mm';
            $epaisseur_val   = '0,30 mm';
            $finition        = 'Prélaqué Couleur Standard Usine';
            $longueurs       = 'Longueurs standards disponibles en parc usine';
            $header_title    = "TÔLES BACS PRÉLAQUÉES ÉCONOMIQUES GAMME B30";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Clôtures de Chantier & Hangars Agricoles";
            $commercial_desc = "Solution économique contrôlée par les ingénieurs de TPM SA, la tôle B30 2ème choix permet de réaliser des couvertures et clôtures étanches à coût maîtrisé pour les projets agricoles, hangars temporaires, clôtures de sécurité de chantier et annexes utilitaires.";
            $pills = [
                "PRIX DIRECT FABRICANT",
                "ÉCONOMIQUE & RENTABLE",
                "PROFIL NERVURÉ B30",
                "POSE RAPIDE ET MANIABLE",
                "STOCK DISPONIBLE"
            ];
            $points_forts = [
                ['icon' => 'payments', 'title' => 'Tarif Ultra-Compétitif Direct Usine', 'desc' => 'Le meilleur coût au mètre carré pour sécuriser des chantiers ou couvrir des bâtiments secondaires.'],
                ['icon' => 'speed', 'title' => 'Maniabilité & Pose Immédiate', 'desc' => 'Poids plume facilitant la manipulation par une équipe réduite sans engin de levage.'],
                ['icon' => 'shield', 'title' => 'Étanchéité Immédiate Contrôlée', 'desc' => 'Contrôle qualité usine assurant l\'intégrité de la barrière protectrice anticorrosion.'],
                ['icon' => 'fence', 'title' => 'Idéal pour Clôtures Sécurisées', 'desc' => 'Permet de délimiter rapidement les périmètres de construction avec une excellente tenue au vent.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Tôle Bac B30 Économique', 'Tolérance Usine'],
                'rows' => [
                    ['label' => 'Matériau de base', 'bac' => 'Acier galvanisé prélaqué', 'ondu' => 'Contrôle usine TPM SA'],
                    ['label' => 'Épaisseur', 'bac' => '0,30 mm à 0,35 mm', 'ondu' => 'Gamme économique'],
                    ['label' => 'Profilage', 'bac' => 'Nervuré trapézoïdal B30', 'ondu' => 'Profil standard'],
                    ['label' => 'Largeur totale / utile', 'bac' => 'Totale : ~900 mm | Utile : ~800 mm', 'ondu' => 'Recouvrement 1 nervure'],
                    ['label' => 'Usage conseillé', 'bac' => 'Clôtures, abris agricoles, annexes', 'ondu' => 'BTP & Agriculture']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de pose', 'text' => 'Fixation verticale pour clôtures ou inclinée pour toitures secondaires.'],
                ['label' => 'Recouvrement', 'text' => 'Recouvrement d\'une nervure complète avec vis auto-perceuses à rondelles néoprène.'],
                ['label' => 'Support', 'text' => 'Pose sur lisses en bois ou tubes métalliques légers.'],
                ['label' => 'Sécurité', 'text' => 'Port de gants recommandé lors de la manipulation des tôles découpées.']
            ];
        } elseif ( preg_match( '/ondul[eé]e.*3m/iu', $title ) ) {
            $category        = 'Tôles Ondulées Traditionnelles Calibrées';
            $material        = 'Aluminium Naturel Haute Pureté';
            $profil          = 'Profil Sinusoïdal Régulier (Ondes continues)';
            $epaisseur       = '0,35 mm nominal';
            $epaisseur_val   = '0,35 mm';
            $finition        = 'Aluminium Brut Naturel Inaltérable';
            $longueurs       = 'Format calibré pratique de 3,00 mètres';
            $header_title    = "TÔLE ONDULÉE ALUMINIUM 0,35 MM FORMAT 3 MÈTRES";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Couverture Traditionnelle Sinusoïdale Calibrée";
            $commercial_desc = "Le modèle historique et incontournable pour l'habitat traditionnel et les habitations rurales au Cameroun. Son format calibré de 3 mètres facilite grandement le transport en véhicule utilitaire et assure une pose rapide sur charpente en bois simple, sans aucun engin de levage.";
            $pills = [
                "FORMAT 3,00 M ULTRA-PRATIQUE",
                "ALUMINIUM PUR INOXYDABLE",
                "ÉCOULEMENT SINUSOÏDAL PARFAIT",
                "RAPPORT QUALITÉ/PRIX IMBATTABLE",
                "DURABILITÉ > 30 ANS"
            ];
            $points_forts = [
                ['icon' => 'local_shipping', 'title' => 'Transport Aisé Format 3m', 'desc' => 'Se charge facilement sur pick-up ou véhicule utilitaire sans dépasser du gabarit routier.'],
                ['icon' => 'shield', 'title' => '100% Inoxydable Garanti', 'desc' => 'Aluminium pur résistant à l\'humidité tropicale et aux pluies sans jamais développer de rouille.'],
                ['icon' => 'water_drop', 'title' => 'Évacuation Fluide & Continue', 'desc' => 'Ondes sinusoïdales classiques canalisant immédiatement l\'eau de pluie vers les gouttières.'],
                ['icon' => 'build', 'title' => 'Pose Facile sur Charpente Bois', 'desc' => 'Se cloue ou se visse directement sur chevrons ou pannes bois ordinaires avec tirefonds et rondelles.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Tôle Ondulée Alu 3,00 m', 'Tolérance Usine'],
                'rows' => [
                    ['label' => 'Matériau de base', 'bac' => 'Aluminium 1ère fusion pur', 'ondu' => 'Norme Camerounaise (NC)'],
                    ['label' => 'Longueur calibrée', 'bac' => '3,00 mètres exacts', 'ondu' => 'Tolérance ± 5 mm'],
                    ['label' => 'Épaisseur', 'bac' => '0,35 mm nominal', 'ondu' => 'Léger et maniable'],
                    ['label' => 'Pas d\'onde', 'bac' => '76 mm (Hauteur 18 mm)', 'ondu' => 'Ondes sinusoïdales régulières'],
                    ['label' => 'Largeur utile', 'bac' => '~800 mm à 850 mm', 'ondu' => 'Recouvrement 1,5 à 2 ondes']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de pose', 'text' => 'Montage de bas en haut avec recouvrement transversal de 15 cm minimum.'],
                ['label' => 'Recouvrement latéral', 'text' => '1,5 à 2 ondes selon la force des vents de la région.'],
                ['label' => 'Fixation', 'text' => 'Fixer impérativement au sommet d\'onde avec des pointes de toiture à rondelle feutre ou tirefonds 6x60.'],
                ['label' => 'Faîtage', 'text' => 'Associer des faîtières alu ondulées ou double pente 0.35 mm.']
            ];
        } else {
            // Tôle Bac Alu 4N et 5N standard (0,35 mm)
            $category        = 'Tôles Bacs & Ondulées Aluminium Standard (0,35 mm)';
            $material        = 'Alliage Aluminium de Première Fusion';
            $profil          = 'Profil BACS Trapézoïdal 4N / 5N ou Profil Ondulé';
            $epaisseur       = '0,35 mm nominal garanti';
            $epaisseur_val   = '0,35 mm';
            $finition        = 'Aluminium Brut Naturel ou Prélaqué Four Polyester';
            $longueurs       = 'Standards (2m, 3m, 4m, 5m, 6m) ou découpe sur-mesure';
            $header_title    = "TÔLES BACS & ONDULÉES ALUMINIUM PRÉLAQUÉES 0,35 MM";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Couverture et Bardage Esthétique";
            $commercial_desc = "Les Tôles Bacs et Ondulées en Aluminium Prélaquées d'épaisseur 0,35 mm associent la durabilité absolue de l'aluminium pur à l'élégance contemporaine d'un laquage multicouche au four (Polyester / PVDF). Conçues pour valoriser l'architecture de vos toitures résidentielles, commerciales et industrielles, elles offrent une garantie anticorrosion totale (zéro rouille) et une haute tenue des teintes contre les rayons UV sous tous les climats (côtiers, tropicaux, équatoriaux).";
            $pills = [
                "FINITION PRÉLAQUÉE AU FOUR",
                "PROFIL BAC OU ONDULÉ",
                "ÉPAISSEUR 0,35 MM",
                "100% INOXYDABLE",
                "COULEURS RAL VARIÉES"
            ];
            $points_forts = [
                ['icon' => 'palette', 'title' => 'Esthétique Haut de Gamme & Teintes UV', 'desc' => 'Laquage polyester thermodurci (25 µm) assurant un rendu brillant ou mat uniforme, résistant à la décoloration sous fort ensoleillement.'],
                ['icon' => 'shield', 'title' => 'Zéro Rouille / Double Protection', 'desc' => 'Barrière anticorrosion double : laque protectrice extérieure + couche naturelle d\'alumine. Aucune oxydation en milieu marin ou humide.'],
                ['icon' => 'architecture', 'title' => 'Choix de Forme : Bac ou Ondulé', 'desc' => 'Bac : Lignes trapézoïdales modernes et rigidité renforcée. Ondulé : Ondes sinusoïdales traditionnelles et écoulement fluide.'],
                ['icon' => 'feather', 'title' => 'Légèreté & Économie de Charpente', 'desc' => 'Poids plume facilitant la manutention et réduisant considérablement la charge sur les pannes bois ou métalliques.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Tôle Bac Alu Prélaquée (4N / 5N)', 'Tôle Ondulée Alu Prélaquée'],
                'rows' => [
                    ['label' => 'Matériau de base', 'bac' => 'Alliage Aluminium Première Fusion', 'ondu' => 'Alliage Aluminium Première Fusion'],
                    ['label' => 'Revêtement de surface', 'bac' => 'Prélaquage Polyester / PVDF (20-25 µm face avant, 5-7 µm verso)', 'ondu' => 'Prélaquage Polyester / PVDF (20-25 µm face avant, 5-7 µm verso)'],
                    ['label' => 'Épaisseur nominale', 'bac' => '0,35 mm', 'ondu' => '0,35 mm'],
                    ['label' => 'Type de profilage', 'bac' => 'Nervures trapézoïdales (4N ou 5N) avec raidisseurs', 'ondu' => 'Ondes sinusoïdales classiques (Pas 76 mm / H 18 mm)'],
                    ['label' => 'Largeur totale / utile', 'bac' => 'Totale : ~950 à 1050 mm | Utile : ~850 à 950 mm', 'ondu' => 'Totale : ~900 à 1000 mm | Utile : ~800 à 850 mm'],
                    ['label' => 'Coloris disponibles', 'bac' => 'Bleu Outremer, Rouge Tuile, Vert Mousse, Gris Anthracite, Brun', 'ondu' => 'Bleu Outremer, Rouge Tuile, Vert Mousse, Gris Anthracite, Brun'],
                    ['label' => 'Longueurs disponibles', 'bac' => 'Standards (2m, 3m, 4m, 5m, 6m) ou Découpe sur-mesure', 'ondu' => 'Standards (2m, 3m, 4m, 5m, 6m) ou Découpe sur-mesure'],
                    ['label' => 'Pente minimale conseillée', 'bac' => '≥ 7% à 10%', 'ondu' => '≥ 10% (environ 6°)'],
                    ['label' => 'Entraxe recommandé pannes', 'bac' => '70 cm à 90 cm maximum', 'ondu' => '60 cm à 80 cm maximum']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de pose', 'text' => 'Montage du bas vers le haut (égout vers faîtage), à l\'opposé des vents pluvieux dominants.'],
                ['label' => 'Recouvrement', 'text' => '1 nervure trapézoïdale complète (profil Bac) ou 1,5 à 2 ondes (profil Ondulé). Raccord longitudinal : 15 à 20 cm.'],
                ['label' => 'Fixation étanche laquée', 'text' => 'Fixer impérativement au sommet de nervure / onde avec vis autoperceuses laquées à la teinte de la tôle, pontets/cavaliers prélaqués et joints d\'étanchéité EPDM.'],
                ['label' => 'Accessoires assortis', 'text' => 'Faîtières laquées crantées, rives d\'extrémité, bandes d\'égout et vis laquées couleur RAL coordonnée.']
            ];
        }

    // =========================================================================
    // 2. ACCESSOIRES DE TOITURE (RIDGE CAPS, FLASHINGS, GUTTERS, VALLEYS)
    // =========================================================================
    } elseif ( $cat_slug === 'accessoires-toiture' || preg_match( '/fa[iî]ti[eè]re|rive|goutti[eè]re|noue|bande/iu', $title ) ) {
        $product_family = 'accessoire';
        $pole = 'Pôle 2 : Accessoires de Finition & Étanchéité de Toiture';

        $is_prelaque = preg_match( '/pr[eé]laqu/iu', $title );
        $epaisseur_val = '0,35 mm';
        if ( preg_match( '/5\/10/iu', $title ) ) $epaisseur_val = '0,50 mm';
        elseif ( preg_match( '/0[,.]40/iu', $title ) ) $epaisseur_val = '0,40 mm';

        if ( preg_match( '/fa[iî]ti[eè]re/iu', $title ) ) {
            $is_centrale     = preg_match( '/centrale/iu', $title );
            $category        = $is_centrale ? 'Faîtières Centrales Profilées pour Arête de Faîtage' : 'Faîtières Non Crantées Double Pente Polyvalentes';
            $header_title    = "FAÎTIÈRES ALUMINIUM " . ($is_centrale ? "CENTRALES" : "DOUBLE PENTE") . " ({$epaisseur_val})" . ($is_prelaque ? " PRÉLAQUÉES" : " NATURELLES");
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Jonctions de Crête et Étanchéité de Faîtage";
            $commercial_desc = "Pièce de finition capitale pour la longévité de votre bâtiment, la faîtière en aluminium TPM SA coiffe la crête sommitale de la toiture à l'intersection des deux versants. Façonnée avec des ailes larges et un pliage haute précision, elle bloque hermétiquement toutes les pénétrations d'eaux pluviales poussées par le vent et préserve intégralement la charpente sous-jacente.";
            $pills = [
                "ALUMINIUM PUR 1ER CHOIX",
                "DOUBLE PENTE ÉTANCHE",
                "ÉPAISSEUR " . strtoupper($epaisseur_val),
                "100% INOXYDABLE",
                $is_prelaque ? "FINITION RAL ASSORTIE" : "FINITION NATURE BRILLANTE"
            ];
            $points_forts = [
                ['icon' => 'shield', 'title' => 'Étanchéité Sommitale Absolue', 'desc' => 'Relevés et largeur d\'ailes conçus pour faire barrière aux rafales pluvieuses les plus violentes.'],
                ['icon' => 'verified', 'title' => 'Inaltérabilité Marine & Tropicale', 'desc' => 'Aluminium premier choix inattaquable par la rouille, éliminant tout besoin d\'entretien périodique.'],
                ['icon' => 'architecture', 'title' => 'Adaptabilité d\'Angle Souple', 'desc' => 'Pliage industriel souple permettant d\'épouser naturellement les pentes de toiture de 5° à 45°.'],
                ['icon' => 'palette', 'title' => 'Harmonie & Esthétique Toiture', 'desc' => 'Finitions coordonnées aux teintes de vos tôles BAC pour un rendu architectural net et valorisant.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Spécification Faîtière Usine', 'Tolérance / Norme BTP'],
                'rows' => [
                    ['label' => 'Matériau de base', 'bac' => 'Aluminium Premier Choix', 'ondu' => 'Norme Camerounaise (NC)'],
                    ['label' => 'Épaisseur nominale', 'bac' => $epaisseur_val, 'ondu' => 'Contrôle micrométrique'],
                    ['label' => 'Développé total', 'bac' => '330 mm à 350 mm (0.33 / 0.35 ml)', 'ondu' => 'Ailes couvrantes 160 mm'],
                    ['label' => 'Longueur d\'élément', 'bac' => '2,00 m à 3,00 m standard (ou sur mesure)', 'ondu' => 'Emboîtement régulier'],
                    ['label' => 'Finition de surface', 'bac' => $is_prelaque ? 'Prélaquage Polyester UV' : 'Aluminium Brut Naturel', 'ondu' => 'Couleur coordonnée RAL'],
                    ['label' => 'Recouvrement conseillé', 'bac' => '15 à 20 cm dans le sens du vent', 'ondu' => 'Étanchéité parfaite']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de montage', 'text' => 'Commencer la pose à l\'extrémité opposée aux vents dominants avec recouvrement de 15 cm minimum.'],
                ['label' => 'Alignement', 'text' => 'Tendre un cordeau de guidage sur toute la ligne faîtière pour garantir une arête parfaitement rectiligne.'],
                ['label' => 'Fixation mécanique', 'text' => 'Visser à travers la faîtière dans les sommets d\'onde de la tôle à l\'aide de vis auto-foreuses avec rondelles EPDM.'],
                ['label' => 'Accessoires complémentaires', 'text' => 'Possibilité d\'intercaler un closoir ventilé pour optimiser l\'aération sous toiture.']
            ];
        } elseif ( preg_match( '/rive/iu', $title ) ) {
            $header_title    = "RIVES DE FAÎTAGE ET DE BARDAGE EN ALUMINIUM ({$epaisseur_val})" . ($is_prelaque ? " PRÉLAQUÉES" : "");
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Habillage de Pignon & Protection Latérale";
            $commercial_desc = "La rive de faîtage en aluminium TPM SA habille et protège les extrémités latérales de la toiture (pignons). Elle forme une barrière impénétrable contre les pluies battantes de côté et empêche le vent de s'engouffrer sous la couverture, écartant ainsi tout risque de soulèvement ou d'arrachement de la toiture.";
            $pills = ["ANTI-ARRACHEMENT AU VENT", "PLIAGE DOUBLE RIGIDITÉ", "ÉPAISSEUR " . strtoupper($epaisseur_val), "100% INOXYDABLE", "FINITION SOIGNÉE"];
            $points_forts = [
                ['icon' => 'air', 'title' => 'Barrière Anti-Soulèvement', 'desc' => 'Empêche l\'effet d\'aspiration du vent sous les berges de toiture lors des orages tropicaux.'],
                ['icon' => 'shield', 'title' => 'Protection des Boiseries de Rive', 'desc' => 'Protège les planches de rive contre le pourrissement et les attaques d\'humidité continue.'],
                ['icon' => 'architecture', 'title' => 'Finition Latérale Nette', 'desc' => 'Offre une ligne architecturale droite et élégante fermant le profil ouvert des tôles de couverture.'],
                ['icon' => 'build', 'title' => 'Pose Facile & Rapide', 'desc' => 'Fixation latérale et supérieure combinée pour un maintien indéboulonnable sur la charpente.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Rive de Faîtage TPM SA', 'Norme / Tolérance'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Aluminium Premier Choix', 'ondu' => 'Alliage haute tenue'],
                    ['label' => 'Épaisseur', 'bac' => $epaisseur_val, 'ondu' => 'Garantie d\'usine'],
                    ['label' => 'Développé', 'bac' => '330 mm à 350 mm avec rejet d\'eau', 'ondu' => 'Pliage anti-goutte'],
                    ['label' => 'Longueur', 'bac' => '2,00 m à 3,00 m', 'ondu' => 'Coupe d\'usine nette'],
                    ['label' => 'Coloris', 'bac' => $is_prelaque ? 'Nuancier RAL coordonné' : 'Aluminium Naturel', 'ondu' => 'Teinte identique aux tôles']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de pose', 'text' => 'Poser de bas en haut du pignon avec recouvrement longitudinal de 10 à 15 cm.'],
                ['label' => 'Fixation', 'text' => 'Visser sur la planche de rive en façade et sur la première onde de la tôle au sommet.'],
                ['label' => 'Étanchéité', 'text' => 'Utiliser des vis auto-foreuses laquées avec joint EPDM pour éviter tout suintement.']
            ];
        } elseif ( preg_match( '/goutti[eè]re/iu', $title ) ) {
            $header_title    = "GOUTTIÈRES EN ALUMINIUM PROFILÉES GRAND DÉBIT ({$epaisseur_val})" . ($is_prelaque ? " PRÉLAQUÉES" : "");
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Collecte & Évacuation des Eaux Pluviales";
            $commercial_desc = "Formées en continu en aluminium pur inoxydable, les gouttières TPM SA sont conçues pour capter et évacuer d'importants volumes d'eau pluviale. Leur profil avec boudin de renfort garantit une rigidité maximale sans déformation sous le poids de l'eau, protégeant vos fondations et vos crépis de façade contre le ravinement.";
            $pills = ["COLLECTE GRAND DÉBIT", "ALUMINIUM ÉPAIS INOXYDABLE", "BOUDIN RIGIDIFICATEUR", "ZÉRO FISSURE NI ROUILLE", "LONGUEURS CONTINUES"];
            $points_forts = [
                ['icon' => 'water_drop', 'title' => 'Capacité d\'Évacuation Supérieure', 'desc' => 'Profil généreux évitant tout débordement lors des averses tropicales violentes.'],
                ['icon' => 'shield', 'title' => 'Inaltérabilité Totale à la Rouille', 'desc' => 'Ne rouille jamais contrairement aux gouttières en acier galvanisé ordinaire.'],
                ['icon' => 'architecture', 'title' => 'Ourlet de Renfort Extérieur', 'desc' => 'Boudin tubulaire conférant une résistance exceptionnelle sans flexion entre crochets.'],
                ['icon' => 'foundation', 'title' => 'Préservation des Fondations', 'desc' => 'Évacue les eaux loin des murs porteurs, prévenant fissures et humidité ascensionnelle.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Gouttière Aluminium TPM SA', 'Norme / Tolérance'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Aluminium 1ère Fusion Haute Pureté', 'ondu' => 'Inaltérable'],
                    ['label' => 'Épaisseur', 'bac' => $epaisseur_val, 'ondu' => 'Rigidité sous charge d\'eau'],
                    ['label' => 'Développé', 'bac' => '330 mm / 350 mm semi-ouvert', 'ondu' => 'Profil grand débit'],
                    ['label' => 'Pente minimale requise', 'bac' => '5 mm par mètre linéaire', 'ondu' => 'Écoulement par gravité'],
                    ['label' => 'Espacement des crochets', 'bac' => '40 cm à 50 cm maximum', 'ondu' => 'Tenue mécanique sans affaissement']
                ]
            ];
            $guide_pose = [
                ['label' => 'Pente d\'écoulement', 'text' => 'Régler la hauteur des crochets pour respecter une pente descendante de 5 mm par mètre vers la descente.'],
                ['label' => 'Fixation', 'text' => 'Fixer les crochets bandeaux tous les 50 cm maximum sur la planche d\'égout.'],
                ['label' => 'Jonctions', 'text' => 'Emboîter les éléments sur 5 cm avec cordon de mastic polyuréthane d\'étanchéité et rivets pop alu.']
            ];
        } else {
            // Noues ou Bandes ourlées
            $header_title    = strtoupper($title) . " EN ALUMINIUM ({$epaisseur_val})";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Solins & Étanchéités Spéciales";
            $commercial_desc = "Conçues pour les jonctions étanches complexes (solins contre murs, cheminées, rencontres de versants en V), les noues et bandes ourlées en aluminium TPM SA garantissent une barrière mécanique absolue contre les remontées d'eau par capillarité et les fortes précipitations tropicales.";
            $pills = ["ALUMINIUM PREMIER CHOIX", "BOUDIN ANTI-GOUTTE", "ÉPAISSEUR " . strtoupper($epaisseur_val), "100% INOXYDABLE", "ÉTANCHÉITÉ MURALE"];
            $points_forts = [
                ['icon' => 'water_drop', 'title' => 'Barrière Étanche Capillaire', 'desc' => 'Empêche l\'eau de remonter sous les tôles le long des parois maçonnées.'],
                ['icon' => 'shield', 'title' => 'Aluminium Massif Inoxydable', 'desc' => 'Dure toute la vie du bâtiment sans perçage par la corrosion.'],
                ['icon' => 'architecture', 'title' => 'Pliage Calibré & Ourlet', 'desc' => 'Ourlet boudiné rigidifiant la pièce et facilitant la fixation régulière.'],
                ['icon' => 'palette', 'title' => 'Raccord Visuel Parfait', 'desc' => 'S\'intègre harmonieusement avec la couverture pour une finition professionnelle.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Spécification TPM SA', 'Norme'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Aluminium Premier Choix', 'ondu' => 'Norme Camerounaise (NC)'],
                    ['label' => 'Épaisseur', 'bac' => $epaisseur_val, 'ondu' => 'Contrôle usine'],
                    ['label' => 'Développé', 'bac' => '330 mm à 350 mm', 'ondu' => 'Développé utile réglementaire'],
                    ['label' => 'Longueur', 'bac' => '2,00 m à 3,00 m (ou au ml)', 'ondu' => 'Coupe nette'],
                    ['label' => 'Finitions', 'bac' => $is_prelaque ? 'Prélaquage RAL' : 'Aluminium Brut Naturel', 'ondu' => 'Assorti aux tôles']
                ]
            ];
            $guide_pose = [
                ['label' => 'Préparation', 'text' => 'Dépoussiérer la maçonnerie et vérifier l\'alignement de la ligne de solin.'],
                ['label' => 'Fixation', 'text' => 'Cheviller contre le mur tous les 30 cm et garnir la gorge supérieure de mastic d\'étanchéité.'],
                ['label' => 'Recouvrement', 'text' => 'Prévoir 10 cm de chevauchement minimum entre deux longueurs consécutives.']
            ];
        }

    // =========================================================================
    // 3. FIXATIONS ET ÉTANCHÉITÉ (FASTENERS & WATERPROOFING)
    // =========================================================================
    } elseif ( $cat_slug === 'fixations-et-etancheite' || preg_match( '/vis|tirefond|cavalier|toiturole|feutre|tige/iu', $title ) ) {
        $product_family = 'fixation';
        $pole = 'Pôle 3 : Fixations Zinguées & Étanchéité de Toiture';

        if ( preg_match( '/vis\s+auto/iu', $title ) ) {
            $header_title    = strtoupper($title) . " HAUTE PERFORMANCE AVEC JOINT EPDM";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Fixation Rapide sur Pannes Métalliques & Bois";
            $commercial_desc = "Les vis auto-foreuses traitées TPM SA permettent une fixation ultra-rapide en une seule passe : perçage de la tôle et de la panne métallique/bois, taraudage et compression étanche. Équipées d'une rondelle vulcanisée avec joint en élastomère EPDM inaltérable, elles garantissent un blocage hermétique empêchant toute infiltration pluviale.";
            $pills = ["POINTE FOREUSE TREMPÉE", "ACIER ZINGUÉ ANTICORROSION", "JOINT ÉLASTOMÈRE EPDM", "PERÇAGE SANS AVANT-TROU", "TÊTE HEXAGONALE RENFORCÉE"];
            $points_forts = [
                ['icon' => 'bolt', 'title' => 'Pose Directe sans Avant-Trou', 'desc' => 'Pointe forêt usinée avec précision traversant tôle aluminium et profilé acier sans pré-perçage.'],
                ['icon' => 'water_drop', 'title' => 'Étanchéité EPDM Vulcanisé', 'desc' => 'Joint élastomère haute élasticité garantissant une étanchéité sans faille durant des décennies.'],
                ['icon' => 'shield', 'title' => 'Revêtement Électro-Zingué Robuste', 'desc' => 'Traitement anticorrosion éliminant tout risque de grippage ou de rouille prématurée.'],
                ['icon' => 'build', 'title' => 'Tête Hexagonale Anti-Rippage', 'desc' => 'Prise d\'entraînement optimale à la visseuse limitant l\'usure des embouts et accélérant la pose.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Vis Auto-Foreuse 6X60', 'Vis Auto-Foreuse 6X70'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Acier Carbone Cémenté Trempé', 'ondu' => 'Acier Carbone Cémenté Trempé'],
                    ['label' => 'Diamètre de tige', 'bac' => 'Ø 6,3 mm au filetage', 'ondu' => 'Ø 6,3 mm au filetage'],
                    ['label' => 'Longueur sous tête', 'bac' => '60 mm', 'ondu' => '70 mm (recommandé D50 / Tuile)'],
                    ['label' => 'Capacité de perçage', 'bac' => 'Acier jusqu\'à 6 mm / Bois massif', 'ondu' => 'Acier jusqu\'à 6 mm / Bois massif'],
                    ['label' => 'Joint d\'étanchéité', 'bac' => 'Rondelle vulcanisée EPDM Ø 16 mm', 'ondu' => 'Rondelle vulcanisée EPDM Ø 16 mm'],
                    ['label' => 'Finition', 'bac' => 'Zingué brillant ou laqué teinte RAL', 'ondu' => 'Zingué brillant ou laqué teinte RAL'],
                    ['label' => 'Couple de serrage conseillé', 'bac' => '8 à 10 Nm (sans écraser le joint)', 'ondu' => '8 à 10 Nm (sans écraser le joint)']
                ]
            ];
            $guide_pose = [
                ['label' => 'Emplacement de vissage', 'text' => 'Fixer impérativement au sommet d\'onde ou de nervure pour garantir l\'évacuation naturelle des eaux.'],
                ['label' => 'Outillage', 'text' => 'Utiliser une visseuse électrique débrayable munie d\'une douille hexagonale aimantée adaptée.'],
                ['label' => 'Réglage du serrage', 'text' => 'Serrer jusqu\'à légère expansion visible du joint EPDM sous la rondelle, sans écraser la tôle.'],
                ['label' => 'Densité recommandée', 'text' => 'Compter en moyenne 3 à 5 fixations par mètre carré selon la zone de vent et l\'exposition.']
            ];
        } elseif ( preg_match( '/tirefond/iu', $title ) ) {
            $header_title    = strtoupper($title) . " ZINGUÉ POUR CHARPENTE BOIS";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Ancrage Lourd et Haute Résistance à l'Arrachement";
            $commercial_desc = "Le tirefond à bois zingué TPM SA est la fixation maîtresse historique pour l'ancrage solide des toitures métalliques dans les charpentes massives en bois dur ou semi-dur (Iroko, Ayous, Bilinga). Son filetage hélicoïdal profond pénètre au cœur des fibres de bois pour offrir une résistance à l'arrachement exceptionnelle face aux tornades.";
            $pills = ["ACIER FORGÉ HAUTE RÉSISTANCE", "FILETAGE PROFOND BOIS", "TRAITEMENT ZINGUÉ BRILLANT", "RÉSISTANCE CYCLONIQUE", "PAQUET CALIBRÉ 72 PCS"];
            $points_forts = [
                ['icon' => 'anchor', 'title' => 'Ancrage Puissant dans le Bois', 'desc' => 'Filet agressif assurant une prise inaltérable au cœur de la panne de charpente en bois.'],
                ['icon' => 'shield', 'title' => 'Protection Électro-Zinguée', 'desc' => 'Revêtement protecteur contre l\'humidité et la pourriture acide du bois humide.'],
                ['icon' => 'hardware', 'title' => 'Tête Hexagonale Forgée', 'desc' => 'Permet un serrage ferme et puissant à la clé à pipe sans déformer l\'empreinte métallique.'],
                ['icon' => 'inventory_2', 'title' => 'Conditionnement Pro de 72 pcs', 'desc' => 'Paquet scellé pratique calibré pour approvisionner facilement les équipes de couvreurs sur chantier.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Tirefond 6X60 (x72)', 'Tirefond 6X80 (x72)'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Acier Forgé Zingué au Pas Métrique', 'ondu' => 'Acier Forgé Zingué au Pas Métrique'],
                    ['label' => 'Diamètre nominal', 'bac' => 'Ø 6,0 mm', 'ondu' => 'Ø 6,0 mm'],
                    ['label' => 'Longueur sous tête', 'bac' => '60 mm (toitures courantes)', 'ondu' => '80 mm (fortes nervures / pannes épaisses)'],
                    ['label' => 'Tête', 'bac' => 'Hexagonale 10 mm', 'ondu' => 'Hexagonale 10 mm'],
                    ['label' => 'Conditionnement', 'bac' => 'Boîte / Paquet scellé de 72 pièces', 'ondu' => 'Boîte / Paquet scellé de 72 pièces'],
                    ['label' => 'Accessoire indispensable', 'bac' => 'Associer cavalier alu + rondelle feutre', 'ondu' => 'Associer cavalier alu + rondelle feutre']
                ]
            ];
            $guide_pose = [
                ['label' => 'Pré-perçage bois', 'text' => 'Un avant-trou de 3,5 mm est conseillé dans les bois très durs pour éviter de fendre la panne.'],
                ['label' => 'Association de pièces', 'text' => 'Enfiler d\'abord la rondelle ou le cavalier sur le tirefond avant l\'insertion dans l\'onde de tôle.'],
                ['label' => 'Serrage manuel', 'text' => 'Serrer à la clé sans à-coup pour écraser fermement la rondelle d\'étanchéité bitumée.'],
                ['label' => 'Vérification', 'text' => 'S\'assurer de la compression uniforme sans jeu sous la tête de fixation.']
            ];
        } elseif ( preg_match( '/toiturole/iu', $title ) ) {
            $header_title    = "MEMBRANE BITUMINEUSE D'ÉTANCHÉITÉ TOITUROLE 900G (ROULEAU 10M)";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Chéneaux, Solins & Toitures-Terrasses";
            $commercial_desc = "La Toiturole 900G est une membrane d'étanchéité bitumineuse lourde prête à l'emploi conçue pour assurer l'imperméabilité absolue des toitures, sous-toitures, chéneaux en béton, noues et solins muraux. Armée d'une matrice composite indéchirable imprégnée de bitume élastomère pur, elle résiste aux fortes chaleurs sans craqueler.";
            $pills = ["ÉTANCHÉITÉ BITUMINEUSE 900G", "ARMATURE INDÉCHIRABLE", "ROULEAU CONTINU 10 M", "RÉSISTANCE AUX UV SOLAIRES", "APPLICATION MULTI-SURFACES"];
            $points_forts = [
                ['icon' => 'water_drop', 'title' => 'Imperméabilité Totale sous Forte Colonne d\'Eau', 'desc' => 'Bloque hermétiquement les infiltrations dans les caniveaux et chéneaux pluviaux.'],
                ['icon' => 'shield', 'title' => 'Résistance aux Déformations Thermiques', 'desc' => 'Bitume élastomère absorbant les dilatations du béton et du métal sans fissuration.'],
                ['icon' => 'straighten', 'title' => 'Rouleau 10m x 1m Facile à Dérouler', 'desc' => 'Mise en œuvre rapide avec un minimum de joints pour couvrir de larges surfaces.'],
                ['icon' => 'wb_sunny', 'title' => 'Tenue Supérieure à la Chaleur (> 90°C)', 'desc' => 'Ne coule pas sous le soleil tropical et conserve sa souplesse étanche durablement.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Spécification Toiturole 900G', 'Norme BTP'],
                'rows' => [
                    ['label' => 'Matière active', 'bac' => 'Bitume élastomère pur avec charges minérales', 'ondu' => 'Hydrofuge certifié'],
                    ['label' => 'Masse surfacique', 'bac' => '900 g/m² d\'armature lourde', 'ondu' => 'Haute étanchéité'],
                    ['label' => 'Dimensions rouleau', 'bac' => 'Longueur : 10 m | Largeur : 1 m (Surface : 10 m²)', 'ondu' => 'Format standard'],
                    ['label' => 'Mise en œuvre', 'bac' => 'À froid (colle bitumineuse) ou au chalumeau', 'ondu' => 'Polyvalent'],
                    ['label' => 'Recouvrement des lés', 'bac' => '10 cm minimum sur les rives longitudinales', 'ondu' => 'Règle DTU']
                ]
            ];
            $guide_pose = [
                ['label' => 'Préparation support', 'text' => 'Nettoyer, brosser et sécher parfaitement le support avant la pose (appliquer un primaire si nécessaire).'],
                ['label' => 'Déroulage & marouflage', 'text' => 'Dérouler la membrane en marouflant du centre vers les bords pour chasser les bulles d\'air.'],
                ['label' => 'Jonctions étanches', 'text' => 'Assurer un recouvrement d\'au moins 10 cm entre bandes avec collage minutieux des lisières.']
            ];
        } else {
            // Cavaliers, rondelles feutres, tiges filetées
            $header_title    = strtoupper($title) . " POUR ÉTANCHÉITÉ DE TOITURE";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Accessoires de Fixation & Répartition de Pression";
            $commercial_desc = "Éléments indispensables de la fixation professionnelle de toiture, ces accessoires certifiés TPM SA assurent la répartition idéale de la pression de serrage, amortissent les micro-vibrations dues au vent et créent une barrière étanche hermétique autour du trou de perçage.";
            $pills = ["RÉPARTITION DE CHARGE", "ABSORPTION ACOUSTIQUE", "ÉTANCHÉITÉ SOUS TÊTE", "ALUMINIUM OU FEUTRE BITUMÉ", "CONDITIONNEMENT PRO"];
            $points_forts = [
                ['icon' => 'verified', 'title' => 'Répartition Optimale du Serrage', 'desc' => 'Évite l\'écrasement ou la déformation des nervures de tôle lors du vissage énergique.'],
                ['icon' => 'water_drop', 'title' => 'Étanchéité Auto-Obturante', 'desc' => 'Le matériau flue légèrement sous compression pour sceller le perçage à 100%.'],
                ['icon' => 'shield', 'title' => 'Inoxydable & Compatible Aluminium', 'desc' => 'Élimine tout risque de corrosion galvanique entre la tôle et la vis.'],
                ['icon' => 'air', 'title' => 'Renfort Anti-Arrachement', 'desc' => 'Augmente la surface d\'appui de la fixation face aux fortes dépressions cycloniques.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Spécification Usine TPM SA', 'Tolérance'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => $material, 'ondu' => 'Norme Camerounaise (NC)'],
                    ['label' => 'Dimensions', 'bac' => $profil, 'ondu' => 'Ajustement précis à l\'onde'],
                    ['label' => 'Épaisseur', 'bac' => $epaisseur, 'ondu' => 'Contrôle calibré'],
                    ['label' => 'Conditionnement', 'bac' => $longueurs, 'ondu' => 'Boîtes étanches distributrices']
                ]
            ];
            $guide_pose = [
                ['label' => 'Pose', 'text' => 'Positionner le cavalier au sommet de nervure avant d\'insérer la fixation traversante.'],
                ['label' => 'Serrage', 'text' => 'Serrer jusqu\'à calage parfait sans forcer pour préserver l\'élasticité du joint.']
            ];
        }

    // =========================================================================
    // 4. ACCESSOIRES INTÉRIEURS : CARRELAGE & REVÊTEMENTS (TILES)
    // =========================================================================
    } elseif ( preg_match( '/carreau|carrelage/iu', $title ) ) {
        $product_family = 'carrelage';
        $pole = 'Pôle 4 : Carrelages, Sanitaires & Matériaux Intérieurs';

        $is_sol = preg_match( '/sol/iu', $title );
        $is_murs = preg_match( '/mur/iu', $title );
        $header_title    = strtoupper($title) . " HAUTE RÉSISTANCE";
        $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Revêtement " . ($is_sol ? "de Sols Intérieurs & Extérieurs" : "Mural Décoratif & Pièces d'Eau");
        $commercial_desc = "Sélectionné rigoureusement par TPM SA auprès des meilleures usines certifiées (Italie, Espagne, usines partenaires contrôlées), ce carrelage en grès cérame vitrifié de premier choix allie une esthétique raffinée à une résistance mécanique extrême. Sa très faible porosité (absorption d'eau < 0,1%) et son émail haute dureté le rendent insensible à l'humidité équatoriale, aux taches et au trafic intense.";
        $pills = [
            "GRÈS CÉRAME 1ER CHOIX",
            $is_sol ? "TRAFIC INTENSE (PEI IV/V)" : "FAÏENCE MURALE HAUT DE GAMME",
            "POROSITÉ QUASI-NULLE < 0,1%",
            "RÉSISTANCE AUX RAYURES & TACHES",
            "CONDITIONNEMENT AU CARTON SCELLÉ"
        ];
        $points_forts = [
            ['icon' => 'grid_view', 'title' => 'Esthétique Minérale de Prestige', 'desc' => 'Finitions rectifiées, nuances élégantes et brillance durable valorisant salons, terrasses et salles de bains.'],
            ['icon' => 'water_drop', 'title' => 'Absorption d\'Eau Négligeable (E < 0.1%)', 'desc' => 'Totalement imperméable : ne moisit jamais, n\'absorbe aucune graisse et ne s\'altère pas avec le temps.'],
            ['icon' => 'shield', 'title' => 'Résistance Élevée au Poinçonnement', 'desc' => 'Supporte les passages intensifs, chutes d\'objets et frottements de meubles sans aucune fissure.'],
            ['icon' => 'cleaning_services', 'title' => 'Entretien Simple & Hygiène Parfaite', 'desc' => 'Surface émaillée vitrifiée nettoyable en un passage, inerte aux détergents et désinfectants courants.']
        ];
        $specs_table = [
            'headers' => ['Paramètre Technique', 'Spécification Carrelage TPM SA', 'Norme ISO 13006'],
            'rows' => [
                ['label' => 'Classification', 'bac' => 'Grès Cérame Émaillé Groupe BIa', 'ondu' => 'Conforme ISO 13006'],
                ['label' => 'Absorption d\'eau', 'bac' => 'E ≤ 0,08% (porosité ultra-faible)', 'ondu' => 'Norme : E ≤ 0,5%'],
                ['label' => 'Résistance à l\'abrasion', 'bac' => $is_sol ? 'Classe PEI IV à PEI V (trafic lourd)' : 'Classe PEI II/III mural', 'ondu' => 'Haute durabilité'],
                ['label' => 'Résistance à la flexion', 'bac' => '≥ 35 N/mm² (charge de rupture > 1500 N)', 'ondu' => 'Très haute résistance'],
                ['label' => 'Résistance aux taches', 'bac' => 'Classe 5 (facilement lavable à l\'eau)', 'ondu' => 'Inaltérable'],
                ['label' => 'Conditionnement', 'bac' => 'Cartons scellés avec calage protecteur', 'ondu' => 'Vente au m² / carton']
            ]
        ];
        $guide_pose = [
            ['label' => 'Support', 'text' => 'La chape ou le mur doit être parfaitement sec, propre, plan et dépoussiéré avant l\'encollage.'],
            ['label' => 'Mortier-colle', 'text' => 'Utiliser un mortier-colle de classe C2TE avec double encollage pour les carreaux de grand format (≥ 40x40 cm).'],
            ['label' => 'Jointoiement', 'text' => 'Respecter un joint d\'au moins 2 mm entre carreaux avec un mortier de jointoiement hydrofuge de qualité.'],
            ['label' => 'Nettoyage de fin de chantier', 'text' => 'Nettoyer les résidus de ciment immédiatement à l\'éponge humide avant prise définitive.']
        ];

    // =========================================================================
    // 5. ACCESSOIRES INTÉRIEURS : DOUCHES THÉRAPEUTIQUES & ÉPONGES
    // =========================================================================
    } elseif ( preg_match( '/douche/iu', $title ) ) {
        $product_family = 'douche';
        $pole = 'Pôle 4 : Sanitaires & Confort Domestique';

        $header_title    = strtoupper($title) . " HAUT DE GAMME";
        $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Sanitaires Électriques & Confort Hydrothérapique";
        $commercial_desc = "Appareil sanitaire d'ingénierie brésilienne de renommée internationale, la douche thérapeutique TPM SA offre un débit d'eau chaude régulé et apaisant instantané. Dotée d'un sélecteur multi-températures sécurisé et d'un diffuseur d'eau grand format, elle allie confort balnéo et sécurité électrique absolue conforme aux normes CE.";
        $pills = ["CHAUFFE INSTANTANÉE DIRECTE", "SÉLECTEUR MULTI-TEMPÉRATURES", "SÉCURITÉ ÉLECTRIQUE CONFORME CE", "DIFFUSEUR GRAND FORMAT", "ÉCONOMIE D'ÉNERGIE & D'EAU"];
        $points_forts = [
            ['icon' => 'shower', 'title' => 'Eau Chaude Immédiate sans Ballon', 'desc' => 'Chauffe l\'eau instantanément au passage sans gaspillage d\'énergie en veille.'],
            ['icon' => 'thermostat', 'title' => 'Régulation Précise de la Chaleur', 'desc' => 'Bouton de sélection multizone pour ajuster la température au degré souhaité.'],
            ['icon' => 'electric_bolt', 'title' => 'Système de Sécurité & Mise à la Terre', 'desc' => 'Résistance blindée et raccordement terre obligatoire prévenant tout risque électrique.'],
            ['icon' => 'water', 'title' => 'Jets Thérapeutiques Relaxants', 'desc' => 'Buses anticalcaires diffusant une pluie bienfaisante favorisant la détente musculaire.']
        ];
        $specs_table = [
            'headers' => ['Paramètre Technique', 'Spécification Sanitaire TPM SA', 'Norme'],
            'rows' => [
                ['label' => 'Tension nominale', 'bac' => '220 V / 240 V ~ 50/60 Hz', 'ondu' => 'Réseau Cameroun Eneo'],
                ['label' => 'Puissance réglable', 'bac' => '4400 W à 7500 W selon modèle', 'ondu' => 'Chauffe rapide'],
                ['label' => 'Pression d\'eau de service', 'bac' => '10 à 400 kPa (0,1 à 4 bar)', 'ondu' => 'Compatible gravité et surpresseur'],
                ['label' => 'Raccordement hydraulique', 'bac' => 'Filetage standard 1/2" mâle', 'ondu' => 'Standard plomberie'],
                ['label' => 'Disjoncteur recommandé', 'bac' => 'Disjoncteur différentiel 32 A / 40 A', 'ondu' => 'Câble 4 mm² à 6 mm²']
            ]
        ];
        $guide_pose = [
            ['label' => 'Alimentation électrique', 'text' => 'Tirer une ligne électrique dédiée directe depuis le tableau avec disjoncteur différentiel 30 mA et mise à la terre.'],
            ['label' => 'Raccordement d\'eau', 'text' => 'Faire couler l\'eau à travers l\'appareil éteint pendant 1 minute avant de brancher le courant (mise en eau indispensable).'],
            ['label' => 'Fixation', 'text' => 'Visser le bras de douche avec ruban téflon sur l\'arrivée d\'eau sans forcer sur le boîtier.']
        ];
    } elseif ( preg_match( '/[eé]ponge/iu', $title ) ) {
        $product_family = 'eponge';
        $pole = 'Pôle 4 : Entretien Industriel & Quincaillerie BTP';

        $header_title    = strtoupper($title) . " HAUTE EFFICACITÉ";
        $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Récurage Industriel & Décapage Métallique";
        $commercial_desc = "Fabriquées à partir de fil d'acier inoxydable de première qualité selon des procédés de tréfilage de haute précision, les éponges métalliques TPM SA offrent un pouvoir abrasif exceptionnel pour le décapage, le récurage de surfaces dures et le nettoyage de matériel de chantier sans se désagréger ni rouiller.";
        $pills = ["ACIER INOX INALTÉRABLE", "SPIRALES DOUBLES OU SIMPLES", "POUVOIR DÉCAPANT SUPÉRIEUR", "NE ROUILLE JAMAIS", "SACHET REVENDEUR CONDENSÉ"];
        $points_forts = [
            ['icon' => 'clean_hands', 'title' => 'Décapage sans Rayures Profondes', 'desc' => 'Forme de ruban spiralé éliminant les incrustations tenaces sans entamer le support métallique.'],
            ['icon' => 'shield', 'title' => 'Inox Véritable Anti-Rouille', 'desc' => 'Peut rester immergé dans l\'eau savonneuse sans jamais développer d\'oxydation brune.'],
            ['icon' => 'handyman', 'title' => 'Tenue Mécanique sans Émiettement', 'desc' => 'Ne perd pas de particules métalliques dangereuses, garantissant une hygiène parfaite.'],
            ['icon' => 'storefront', 'title' => 'Conditionnement Prêt pour Quincaillerie', 'desc' => 'Sachets distributeurs étanches de 20 ou 25 pièces avec tarification de gros très attractive.']
        ];
        $specs_table = [
            'headers' => ['Paramètre Technique', 'Éponge Non Doublée (x25)', 'Éponge Doublée (x20)'],
            'rows' => [
                ['label' => 'Matière première', 'bac' => 'Fil d\'acier inoxydable pur tréfilé', 'ondu' => 'Fil inox + âme mousse renforcée'],
                ['label' => 'Format & ergonomie', 'bac' => 'Pelote spiralée ronde compacte', 'ondu' => 'Coussin avec doublure prise en main'],
                ['label' => 'Résistance à l\'oxydation', 'bac' => '100% inoxydable dans l\'eau', 'ondu' => '100% inoxydable dans l\'eau'],
                ['label' => 'Conditionnement', 'bac' => 'Sachet scellé de 25 pièces', 'ondu' => 'Sachet scellé de 20 pièces']
            ]
        ];
        $guide_pose = [
            ['label' => 'Utilisation', 'text' => 'Humidifier l\'éponge avec de l\'eau ou du détergent avant frottement pour maximiser l\'efficacité abrasive.'],
            ['label' => 'Rinçage', 'text' => 'Rincer à l\'eau claire après utilisation et essorer pour une réutilisation longue durée.']
        ];
    } else {
        // Plasturgie / Sacs PP et autres
        $product_family = 'sac_pp';
        $pole = 'Pôle 2 : Plasturgie Industrielle & Emballages Polypropylène';

        $header_title    = strtoupper($title) . " RENFORCÉ";
        $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Emballages Industriels & Agro-Alimentaires";
        $commercial_desc = "Tissés sur métiers circulaires de haute cadence à partir de granulés de polypropylène pur vierge aux usines TPM SA de Douala Bekoko, les sacs PP offrent une résistance à la rupture exceptionnelle pour le conditionnement, le transport et le stockage de denrées agricoles (cacao, café, farine, céréales) et de matériaux de construction (sable, gravier, ciment).";
        $pills = ["PP VIERGE HAUTE TÉNACITÉ", "TISSAGE CIRCULAIRE SANS COUTURE", "TRAITEMENT STABILISÉ ANTI-UV", "CHARGE UTILE GARANTIE", "CONFORMITÉ AGRO-ALIMENTAIRE"];
        $points_forts = [
            ['icon' => 'fitness_center', 'title' => 'Résistance à la Rupture & Déchirure', 'desc' => 'Tissage croisé chaîne/trame supportant des chutes d\'une hauteur de 2 mètres sans éclatement.'],
            ['icon' => 'wb_sunny', 'title' => 'Stabilisation Anti-UV Tropicale', 'desc' => 'Traitement spécifique dans la masse évitant la dégradation du plastique au soleil équatorial.'],
            ['icon' => 'shield', 'title' => 'Protection Anti-Humidité des Denrées', 'desc' => 'Préserve les produits stockés contre l\'humidité extérieure et les poussières de transport.'],
            ['icon' => 'local_shipping', 'title' => 'Capacité Industrielle Forte Cadence', 'desc' => 'Production continue garantissant la livraison de dizaines de milliers d\'unités sans rupture.']
        ];
        $specs_table = [
            'headers' => ['Paramètre Technique', 'Spécification Sac PP TPM SA', 'Norme'],
            'rows' => [
                ['label' => 'Matière première', 'bac' => '100% Polypropylène (PP) Vierge de 1ère Fusion', 'ondu' => 'Qualité certifiée'],
                ['label' => 'Armure de tissage', 'bac' => 'Tissage circulaire régulier sans couture latérale', 'ondu' => 'Haute densité'],
                ['label' => 'Ourlet de fond', 'bac' => 'Couture double point de chaînette renforcée', 'ondu' => 'Anti-fuite'],
                ['label' => 'Ouverture haute', 'bac' => 'Coupe à chaud anti-effilochage (ourlet simple)', 'ondu' => 'Fermeture facile'],
                ['label' => 'Usage conseillé', 'bac' => 'Cacao, café, céréales, ciment, sable, minerais', 'ondu' => 'Multi-usages']
            ]
        ];
        $guide_pose = [
            ['label' => 'Remplissage', 'text' => 'Ne pas dépasser la charge nominale certifiée du sac pour préserver les coutures lors de la manutention.'],
            ['label' => 'Fermeture', 'text' => 'Coudre à la machine à coudre portative de sac avec fil de fermeture polyester TPM SA.'],
            ['label' => 'Stockage', 'text' => 'Empiler sur palettes en quinconce dans un entrepôt aéré et abrité de la pluie battante.']
        ];
    }

    // ONLY the actual standard roofing sheets (Tôles Bacs & Ondulées) have the authentic blueprint diagram
    // For all other products, details are rendered purely in text form without repeated/generic diagrams
    $has_proper_diagram = false;
    if ( ( $cat_slug === 'toles-et-toiture' || preg_match( '/tôle|tole/iu', $title ) ) && ! preg_match( '/tuile/iu', $title ) ) {
        $has_proper_diagram = true;
    }

    // Tailored storage, handling & warranty guidelines in text form
    if ( $product_family === 'tole' || $product_family === 'accessoire' ) {
        $stockage_info = [
            'stockage'    => "Stocker à plat sous abri sec et bien aéré, sur cales en bois surélevées du sol. Éviter le contact avec le sol humide.",
            'manutention' => "Porter des gants de protection anti-coupure. Porter les éléments à deux personnes sans les faire frotter pour préserver la finition.",
            'garantie'    => "Garantie usine TPM SA contre toute corrosion perforante. Conforme Norme Camerounaise (NC) & ISO 9001:2015."
        ];
    } elseif ( $product_family === 'fixation' ) {
        $stockage_info = [
            'stockage'    => "Conserver dans les boîtes ou paquets d'origine scellés, dans un local sec et tempéré à l'abri de l'humidité.",
            'manutention' => "Vérifier la bonne assise du joint EPDM avant serrage. Utiliser des douilles hexagonales calibrées sans jeu.",
            'garantie'    => "Garantie de résistance mécanique à l'arrachement et protection anticorrosion électro-zinguée certifiée."
        ];
    } elseif ( $product_family === 'carrelage' ) {
        $stockage_info = [
            'stockage'    => "Stocker les cartons verticalement sur chant sur palettes stables, à l'abri des intempéries et des chocs.",
            'manutention' => "Manipuler les cartons avec précaution pour éviter l'ébréchage des arêtes. Vérifier les calibres et bains avant pose.",
            'garantie'    => "Carrelage premier choix garanti sans défaut de surface (Groupe BIa). Conforme norme internationale ISO 13006."
        ];
    } elseif ( $product_family === 'douche' ) {
        $stockage_info = [
            'stockage'    => "Conserver dans l'emballage protecteur d'origine dans un endroit sec jusqu'au moment du raccordement.",
            'manutention' => "Ne pas tirer sur les conducteurs électriques. Réaliser impérativement la mise en eau avant la première mise sous tension.",
            'garantie'    => "Garantie constructeur TPM SA contre tout défaut d'assemblage ou de composant électrique."
        ];
    } else {
        $stockage_info = [
            'stockage'    => "Conserver dans un magasin sec, propre et ventilé, à l'écart des sources de chaleur et du soleil direct continu.",
            'manutention' => "Manipuler les conditionnements sans les traîner au sol afin de préserver l'intégrité des emballages.",
            'garantie'    => "Qualité industrielle contrôlée en laboratoire usine TPM SA à Douala Bekoko & PK12."
        ];
    }

    return [
        'has_proper_diagram' => $has_proper_diagram,
        'stockage_info'      => $stockage_info,
        'ref'              => $ref,
        'title'            => $title,
        'designation'      => $designation,
        'category'         => $category,
        'pole'             => $pole,
        'material'         => $material,
        'profil'           => $profil,
        'epaisseur'        => $epaisseur,
        'epaisseur_val'    => $epaisseur_val ?? '0,35 mm',
        'finition'         => $finition,
        'longueurs'        => $longueurs,
        'description'      => $description,
        'commercial_desc'  => $commercial_desc,
        'avantages'        => $avantages,
        'applications'     => $applications,
        'pose'             => $pose,
        'unit'             => $unit,
        'stock'            => 'Disponible en Stock Permanent (Usines Bekoko & Douala PK12)',
        'norme'            => 'Norme Camerounaise (NC) & ISO 9001:2015 • Garantie de Durabilité',
        'product_family'   => $product_family,
        'header_title'     => $header_title,
        'header_subtitle'  => $header_subtitle,
        'pills'            => $pills,
        'points_forts'     => $points_forts,
        'specs_table'      => $specs_table,
        'guide_pose'       => $guide_pose,
        'ral_swatches'     => $ral_swatches
    ];
}