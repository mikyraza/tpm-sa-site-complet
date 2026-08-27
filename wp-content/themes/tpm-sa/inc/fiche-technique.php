<?php
/**
 * wp-content/themes/tpm-sa/inc/fiche-technique.php
 * Générateur officiel des Fiches Techniques Certifiées TPM SA (Groupe CAC)
 * Conforme au standard certifié de Fiche Technique Industrielle (2 Pages)
 * Avec croquis cotés et dimensions réelles uniques pour chaque produit
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
    $diagram_type   = 'tole_bac';
    $diagram_title  = 'CROQUIS COTÉ & GÉOMÉTRIE DU PROFIL';
    $has_proper_diagram = true;

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
            $diagram_type    = 'tole_tuile';
            $diagram_title   = 'PROFIL EN COUPE COTÉ : TÔLE TUILE NERVURALE D50';
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
            $pills = ["FINITION PRÉLAQUÉE AU FOUR", "PROFIL TUILE D50 NERVURÉ", "ÉPAISSEUR 0,50 MM RÉEL", "100% INOXYDABLE", "ESTHÉTIQUE PRESTIGE"];
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
            $diagram_type    = 'tole_d50';
            $diagram_title   = 'PROFIL EN COUPE COTÉ : TÔLE INDUSTRIELLE BAC D50';
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
            $pills = ["NERVURES PROFONDES 50 MM", "PORTÉES JUSQU'À 1,50 M", "ÉPAISSEUR 0,50 MM RÉEL", "DÉBIT HYDRAULIQUE MAX", "ZÉRO ROUILLE"];
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
            $diagram_type    = 'tole_610';
            $diagram_title   = 'PROFIL EN COUPE COTÉ : TÔLE CALIBRE LOURD 6/10E (0,60 MM)';
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
            $pills = ["ÉPAISSEUR MASSIVE 0,60 MM", "INDÉFORMABLE AUX CHOCS", "RÉSISTANCE CORROSION MARINE", "ISOLATION ACOUSTIQUE SUPÉRIEURE", "DURABILITÉ > 50 ANS"];
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
            $diagram_type    = 'tole_510';
            $diagram_title   = 'PROFIL EN COUPE COTÉ : TÔLE STANDARD 5/10E (0,50 MM)';
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
            $pills = ["ÉPAISSEUR STANDARD 0,50 MM", "PLANÉITÉ REMARQUABLE", "100% INOXYDABLE", "FINITION NATURE OU PRÉLAQUÉE", "GARANTIE DE DURABILITÉ"];
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
            $diagram_type    = 'tole_b30';
            $diagram_title   = 'PROFIL EN COUPE COTÉ : TÔLE ÉCONOMIQUE B30';
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
            $pills = ["PRIX DIRECT FABRICANT", "ÉCONOMIQUE & RENTABLE", "PROFIL NERVURÉ B30", "POSE RAPIDE ET MANIABLE", "STOCK DISPONIBLE"];
            $points_forts = [
                ['icon' => 'payments', 'title' => 'Tarif Ultra-Compétitif', 'desc' => 'Le meilleur ratio coût/surface couverte pour les projets à budget serré.'],
                ['icon' => 'fence', 'title' => 'Idéal pour Clôtures de Sécurité', 'desc' => 'Permet de ceinturer rapidement des terrains et chantiers de construction.'],
                ['icon' => 'speed', 'title' => 'Mise en Œuvre Rapide', 'desc' => 'Plaques légères manuportables pour une fixation express sur chevrons ou tubes acier.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Spécification Gamme B30', 'Norme Usine'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Acier galvanisé prélaqué', 'ondu' => 'Contrôle TPM SA'],
                    ['label' => 'Épaisseur indicative', 'bac' => '0,30 mm - 0,35 mm', 'ondu' => 'Tolérance usine'],
                    ['label' => 'Hauteur nervure', 'bac' => '25 mm', 'ondu' => 'Pas 200 mm'],
                    ['label' => 'Largeur utile', 'bac' => '~800 mm', 'ondu' => 'Recouvrement 1 nervure']
                ]
            ];
            $guide_pose = [
                ['label' => 'Usage conseillé', 'text' => 'Clôtures de chantier, hangars de séchage, abris provisoires et toitures secondaires.'],
                ['label' => 'Fixation', 'text' => 'Fixer avec vis auto-foreuses ou pointes à tôle avec rondelles bitumées.']
            ];
        } elseif ( preg_match( '/ondul/iu', $title ) ) {
            $diagram_type    = 'tole_ondulee';
            $diagram_title   = 'PROFIL EN COUPE COTÉ : TÔLE ONDULÉE SINUSOÏDALE 76/18';
            $category        = 'Tôles Ondulées Traditionnelles Aluminium Pur 0,35 mm';
            $material        = 'Alliage Aluminium Pur Inaltérable';
            $profil          = 'Profil Sinusoïdal Ondulé Standard 76/18';
            $epaisseur       = '0,35 mm réel garanti';
            $epaisseur_val   = '0,35 mm';
            $finition        = 'Aluminium Naturel Brillant Miroir';
            $longueurs       = 'Format standard 3,00 m (ou coupe sur mesure)';
            $header_title    = "TÔLES ONDULÉES ALUMINIUM 0,35 MM (FORMAT 3M & SUR-MESURE)";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Couverture Traditionnelle & Rénovation";
            $commercial_desc = "Classique intemporel de la construction au Cameroun, la tôle ondulée sinusoïdale TPM SA en aluminium 0,35 mm offre une évacuation naturelle fluide des eaux pluviales et une pose intuitive sans outillage lourd.";
            $pills = ["PROFIL ONDULÉ 76/18", "ÉPAISSEUR 0,35 MM GARANTIE", "100% INOXYDABLE", "LÉGÈRETÉ & MANIABILITÉ", "FORMAT 3 MÈTRES"];
            $points_forts = [
                ['icon' => 'waves', 'title' => 'Ondes Sinusoïdales 76/18', 'desc' => 'Profil classique facilitant l\'évacuation rapide des fortes pluies tropicales.'],
                ['icon' => 'shield', 'title' => 'Aluminium Inaltérable', 'desc' => 'Ne rouille jamais, même sous forte humidité côtière.'],
                ['icon' => 'construction', 'title' => 'Pose Traditionnelle Facile', 'desc' => 'Se fixe aisément sur charpente bois par tirefonds ou pointes torsadées.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Tôle Ondulée Alu 0,35 mm', 'Tolérance'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Aluminium Pur 1ère Fusion', 'ondu' => 'Certifié NC'],
                    ['label' => 'Pas d\'onde / Hauteur', 'bac' => 'Pas = 76 mm | Hauteur = 18 mm', 'ondu' => 'Standard NF'],
                    ['label' => 'Largeur utile / totale', 'bac' => 'Utile : ~836 mm | Totale : ~900 mm', 'ondu' => 'Recouvrement 1,5 onde'],
                    ['label' => 'Longueur standard', 'bac' => '3,00 mètres en stock usine', 'ondu' => '± 2 mm']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de pose', 'text' => 'De bas en haut en commençant à l\'opposé des vents pluvieux dominants.'],
                ['label' => 'Recouvrement latéral', 'text' => '1 onde et demie pour assurer une étanchéité parfaite face aux vents violents.']
            ];
        } else {
            // Tôle Bac Alu 4N ET 5N 0,35
            $diagram_type    = 'tole_bac';
            $diagram_title   = 'PROFIL EN COUPE COTÉ : TÔLE BAC TRAPÉZOÏDALE 4N & 5N (0,35 MM)';
            $category        = 'Tôles Bacs Trapézoïdales Aluminium 0,35 mm (4N & 5N)';
            $material        = 'Alliage Aluminium 1ère Fusion 0,35 mm';
            $profil          = 'Profil BACS 4 Nervures (4N) ou 5 Nervures (5N)';
            $epaisseur       = '0,35 mm réel garanti';
            $epaisseur_val   = '0,35 mm';
            $finition        = 'Aluminium Naturel ou Prélaqué';
            $longueurs       = '2,00 m à 12,00 m (découpe sur mesure)';
            $header_title    = "TÔLES BACS ALUMINIUM 4N & 5N (0,35 MM)";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Couverture Résidentielle & Tertiaire";
            $commercial_desc = "Modèle le plus vendu de notre pôle tôlerie, le bac alu 4N et 5N en calibre 0,35 mm allie légèreté extrême, tenue aux intempéries et coût direct fabricant imbattable pour tous types d'habitations et bâtiments commerciaux.";
            $pills = ["PROFIL TRAPÉZOÏDAL 4N/5N", "ÉPAISSEUR 0,35 MM CERTIFIÉE", "DÉCOUPE SUR MESURE JUSQU'À 12M", "100% INOXYDABLE", "PRIX USINE DIRECT"];
            $points_forts = [
                ['icon' => 'architecture', 'title' => 'Profil Trapézoïdal Rigide', 'desc' => 'Nervures trapézoïdales assurant une excellente inertie et un écoulement optimal.'],
                ['icon' => 'shield', 'title' => 'Inoxydabilité Absolue', 'desc' => 'Résiste indéfiniment à l\'humidité tropicale et à l\'air salin du littoral camerounais.'],
                ['icon' => 'straighten', 'title' => 'Longueur à la Demande', 'desc' => 'Découpe sur-mesure au centimètre près à l\'usine de Douala pour limiter les chutes sur chantier.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', 'Spécification Bac 4N/5N 0,35', 'Norme Usine'],
                'rows' => [
                    ['label' => 'Alliage de base', 'bac' => 'Aluminium 1ère Fusion contrôlé', 'ondu' => 'Norme NC'],
                    ['label' => 'Épaisseur', 'bac' => '0,35 mm réel certifié', 'ondu' => 'Micrométrique'],
                    ['label' => 'Hauteur nervure', 'bac' => '25 à 28 mm avec raidisseurs', 'ondu' => 'Rigidité max'],
                    ['label' => 'Largeur utile / totale', 'bac' => 'Utile : ~880 mm | Totale : ~1000 mm', 'ondu' => '1 nervure recouv.']
                ]
            ];
            $guide_pose = [
                ['label' => 'Pose sur pannes', 'text' => 'Entraxe de pannes conseillé de 60 à 80 cm.'],
                ['label' => 'Fixation', 'text' => 'Fixer sur sommet de nervure avec vis auto-foreuses et cavaliers étanches.']
            ];
        }
    }

    // =========================================================================
    // 2. ACCESSOIRES DE TOITURE (ROOFING ACCESSORIES)
    // =========================================================================
    elseif ( $cat_slug === 'accessoires-toiture' || preg_match( '/fa[iî]ti[eè]re|rive|goutti[eè]re|noue|bande/iu', $title ) ) {
        $product_family = 'accessoire';
        $pole = 'Pôle 1 : Accessoires de Finition & Étanchéité de Toiture';

        $is_prelaque = preg_match( '/pr[eé]laqu/iu', $title );
        $finition    = $is_prelaque ? 'Aluminium Prélaqué Four Nuancier RAL' : 'Aluminium Brut Naturel Brillant';
        $gauge       = '0,35 mm';
        if ( preg_match( '/0[,.]40|0\.40/iu', $title ) ) $gauge = '0,40 mm';
        elseif ( preg_match( '/5\/10/iu', $title ) ) $gauge = '0,50 mm (5/10e)';

        if ( preg_match( '/fa[iî]ti[eè]re/iu', $title ) ) {
            $is_centrale = preg_match( '/centrale/iu', $title );
            $diagram_type = $is_centrale ? 'acc_faitiere_centrale' : 'acc_faitiere_double';
            $diagram_title = $is_centrale ? "SCHÉMA TECHNIQUE COTÉ : FAÎTIÈRE CENTRALE BOMBÉE ($gauge)" : "SCHÉMA TECHNIQUE COTÉ : FAÎTIÈRE NON CRANTÉE DOUBLE PENTE ($gauge)";
            $category = $is_centrale ? 'Faîtières Centrales Bombées Profilées' : 'Faîtières Non Crantées Double Pente';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Jonction de Faîtage Étanche";
            $commercial_desc = "Élément capital du couronnement de toiture, la faîtière TPM SA ($gauge) assure la jonction étanche entre les deux versants opposés du toit, empêchant toute infiltration d'eau de pluie battante et protégeant la charpente faîtière contre le pourrissement.";
            $pills = ["DÉVELOPPÉ 330/350 MM", "ÉPAISSEUR " . strtoupper($gauge), "AILES AVEC OURLETS RIGIDES", "ZÉRO CORROSION", "LONGUEUR AU ML"];
            $points_forts = [
                ['icon' => 'roofing', 'title' => 'Étanchéité Parfaite du Faîte', 'desc' => 'Recouvrement large des deux versants protégeant la panne faîtière.'],
                ['icon' => 'shield', 'title' => 'Ourlets Anti-Goutte d\'Eau', 'desc' => 'Bords repliés évitant le retour d\'eau par capillarité sous le faîtage.'],
                ['icon' => 'straighten', 'title' => 'Ajustement d\'Angle Universel', 'desc' => 'Pliage usine calibré adaptable aux pentes de 15° à 45°.']
            ];
            $specs_table = [
                'headers' => ['Spécification', 'Valeur Faîtière TPM SA', 'Tolérance'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Aluminium 1er choix ' . ($is_prelaque ? 'Prélaqué' : 'Naturel'), 'ondu' => 'Qualité usine'],
                    ['label' => 'Épaisseur réelle', 'bac' => $gauge, 'ondu' => 'Certifiée'],
                    ['label' => 'Développé total', 'bac' => '330 mm à 400 mm (selon modèle)', 'ondu' => '± 2 mm'],
                    ['label' => 'Ailes latérales', 'bac' => '150 mm à 180 mm chacune', 'ondu' => 'Recouvrement optimal'],
                    ['label' => 'Conditionnement', 'bac' => 'Vente au mètre linéaire (ml)', 'ondu' => 'Sur mesure']
                ]
            ];
            $guide_pose = [
                ['label' => 'Sens de montage', 'text' => 'Poser de l\'opposé des vents de pluie vers la direction du vent dominant.'],
                ['label' => 'Recouvrement', 'text' => 'Recouvrement minimum de 15 cm entre deux faîtières consécutives avec mastic d\'étanchéité.'],
                ['label' => 'Fixation', 'text' => 'Fixer sur les sommets d\'ondes des tôles sous-jacentes avec vis à joint EPDM.']
            ];
        } elseif ( preg_match( '/rive/iu', $title ) ) {
            $diagram_type = 'acc_rive';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ : RIVE DE FAÎTAGE ET PIGNON ($gauge)";
            $category = 'Rives de Faîtage & Bandes de Pignon Latérales';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Finition des Rives de Pignon";
            $commercial_desc = "La rive de toiture TPM SA protège les chevrons de pignon et les planches de rive contre les infiltrations d'eau latérales et les rafales de vent équatoriales susceptibles de soulever la toiture en rive.";
            $pills = ["PROTECTION DE PIGNON", "ÉPAISSEUR " . strtoupper($gauge), "RECOUVREMENT PARFAIT", "OURLET GOUTTE D'EAU", "DISPONIBLE AU ML"];
            $points_forts = [
                ['icon' => 'border_right', 'title' => 'Protection Totale de Rive', 'desc' => 'Couvre la planche de rive et la dernière onde de tôle latérale.'],
                ['icon' => 'shield', 'title' => 'Tenue Anti-Arrachement', 'desc' => 'Fixation robuste bloquant les prises au vent en bordure de toit.'],
                ['icon' => 'palette', 'title' => 'Finition Harmonisée', 'desc' => 'Nuance assortie aux tôles de toiture pour une esthétique soignée.']
            ];
            $specs_table = [
                'headers' => ['Paramètre', 'Spécification Rive TPM SA', 'Norme'],
                'rows' => [
                    ['label' => 'Matière', 'bac' => 'Alu pur ' . ($is_prelaque ? 'Prélaqué RAL' : 'Naturel'), 'ondu' => 'NC certifié'],
                    ['label' => 'Épaisseur', 'bac' => $gauge, 'ondu' => 'Calibrée'],
                    ['label' => 'Retombée verticale', 'bac' => '100 mm à 120 mm', 'ondu' => 'Couvre-bois'],
                    ['label' => 'Recouvrement toiture', 'bac' => '140 mm à 160 mm', 'ondu' => 'Anti-infiltration']
                ]
            ];
            $guide_pose = [
                ['label' => 'Montage', 'text' => 'Poser de bas en haut le long du rampant de pignon avec recouvrement de 10 cm.'],
                ['label' => 'Fixation', 'text' => 'Visser sur la face supérieure dans l\'onde de tôle et sur la face latérale dans le bois.']
            ];
        } elseif ( preg_match( '/goutti[eè]re/iu', $title ) ) {
            $diagram_type = 'acc_gouttiere';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ : GOUTTIÈRE ALU PROFILÉE ($gauge)";
            $category = 'Gouttières Aluminium pour Évacuation Pluviale';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Collecte & Évacuation des Eaux Pluviales";
            $commercial_desc = "Profilée en aluminium inaltérable aux usines TPM SA, la gouttière assure une collecte rapide et sans débordement des eaux de pluie de toiture pour préserver les façades, fondations et terrasses de votre bâtiment.";
            $pills = ["DÉVELOPPÉ 330/350 MM", "BOUDIN TUBULAIRE RIGIDIFICATEUR", "ÉPAISSEUR " . strtoupper($gauge), "ZÉRO PERFORATION ROUILLE", "DÉBIT HYDRAULIQUE MAX"];
            $points_forts = [
                ['icon' => 'water_drop', 'title' => 'Collecte Haut Débit', 'desc' => 'Profil profond canalisant les trombes d\'eau tropicales sans déborder.'],
                ['icon' => 'architecture', 'title' => 'Boudin de Renfort Ø 16 mm', 'desc' => 'Ourlet tubulaire frontal conférant une rigidité longitudinale exceptionnelle.'],
                ['icon' => 'shield', 'title' => 'Inoxydable à Vie', 'desc' => 'Ne subit aucune rouille même en cas de stagnation prolongée de feuilles humides.']
            ];
            $specs_table = [
                'headers' => ['Spécification', 'Gouttière Alu TPM SA', 'Tolérance'],
                'rows' => [
                    ['label' => 'Alliage', 'bac' => 'Aluminium 1ère fusion ' . ($is_prelaque ? 'Laqué' : 'Brut'), 'ondu' => 'Inaltérable'],
                    ['label' => 'Épaisseur', 'bac' => $gauge, 'ondu' => 'Garantie'],
                    ['label' => 'Développé', 'bac' => '330 mm / 350 mm', 'ondu' => 'Diamètre 125-140 mm'],
                    ['label' => 'Pente conseillée', 'bac' => '5 mm par mètre linéaire', 'ondu' => 'Écoulement fluide']
                ]
            ];
            $guide_pose = [
                ['label' => 'Crochets de fixation', 'text' => 'Poser des crochets tous les 40 à 50 cm maximum avec une pente régulière vers la descente.'],
                ['label' => 'Jonctions', 'text' => 'Emboîter les tronçons de gouttière avec un joint silicone polyuréthane étanche et rivets alu.']
            ];
        } elseif ( preg_match( '/noue/iu', $title ) ) {
            $diagram_type = 'acc_noue';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ : NOUE EN ALU EN V ($gauge)";
            $category = 'Noues en Aluminium pour Jonction Rentrant de Versants';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Chenaux d'Angle Rentrant";
            $commercial_desc = "La noue en aluminium TPM SA forme le chenal d'évacuation étanche à l'intersection de deux pans de toiture formant un angle rentrant. Son pliage en V avec relevés d'étanchéité évite tout refoulement latéral sous les tôles.";
            $pills = ["CANAL D'ÉVACUATION EN V", "RELEVÉS D'ÉTANCHÉITÉ 30 MM", "ÉPAISSEUR " . strtoupper($gauge), "ANTI-REFOULEMENT", "ALUMINIUM PUR"];
            $points_forts = [
                ['icon' => 'waves', 'title' => 'Canalisation Centrale Large', 'desc' => 'Collecte le confluent des deux versants vers l\'égout sans turbulence.'],
                ['icon' => 'shield', 'title' => 'Double Pince Latérale', 'desc' => 'Relevés latéraux bloquant les remontées d\'eau sous forte dépression de vent.'],
                ['icon' => 'verified', 'title' => 'Durabilité Totale', 'desc' => 'Aluminium massif insensible aux résidus végétaux et à l\'acidité des pluies.']
            ];
            $specs_table = [
                'headers' => ['Paramètre', 'Noue Alu TPM SA', 'Norme'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Alu pur 1ère fusion ' . ($is_prelaque ? 'Prélaqué' : 'Naturel'), 'ondu' => 'Qualité usine'],
                    ['label' => 'Épaisseur', 'bac' => $gauge, 'ondu' => 'Certifiée'],
                    ['label' => 'Développé total', 'bac' => '330 mm à 400 mm', 'ondu' => 'Large chenal'],
                    ['label' => 'Relevé latéral', 'bac' => '25 mm à 30 mm avec pince 10 mm', 'ondu' => 'Anti-refoulement']
                ]
            ];
            $guide_pose = [
                ['label' => 'Pose sur fonçure', 'text' => 'Poser impérativement sur une fonçure en planches de bois continue le long de la ligne de noue.'],
                ['label' => 'Recouvrement', 'text' => 'Recouvrir de bas en haut avec 20 cm minimum de chevauchement entre les pièces.']
            ];
        } else {
            // Bandes ourlées / bavettes
            $diagram_type = 'acc_bande_ourlee';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ : BANDE OURLÉE & SOLIN D'ÉTANCHÉITÉ ($gauge)";
            $category = 'Bandes Ourlées & Solins de Raccord Mural';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Raccordement Toiture / Façade Maçonnée";
            $commercial_desc = "La bande ourlée TPM SA assure la jonction étanche entre la couverture en tôles et un mur maçonné vertical (acrotère, mur pignon mitoyen). Son ourlet rigidifié canalise l'eau sans goutter le long des enduits.";
            $pills = ["OURLET RIGIDE D'ÉGOUT", "RELEVÉ MURAL D'ENGRAVURE", "ÉPAISSEUR " . strtoupper($gauge), "ÉTANCHÉITÉ MURALE", "ALU INALTÉRABLE"];
            $points_forts = [
                ['icon' => 'architecture', 'title' => 'Jonction Mur/Toit Imperméable', 'desc' => 'Élimine les infiltrations au droit des murs verticaux maçonnés.'],
                ['icon' => 'shield', 'title' => 'Ourlet Boudiné Résistant', 'desc' => 'Confère une rigidité parfaite à la bavette inférieure qui plaque sur la tôle.'],
                ['icon' => 'palette', 'title' => 'Teintes Coordonnées', 'desc' => 'Disponible en alu naturel ou prélaqué assorti à la toiture.']
            ];
            $specs_table = [
                'headers' => ['Spécification', 'Bande Ourlée TPM SA', 'Norme'],
                'rows' => [
                    ['label' => 'Matière', 'bac' => 'Aluminium 1er choix ' . ($is_prelaque ? 'Prélaqué' : 'Nature'), 'ondu' => 'NC'],
                    ['label' => 'Épaisseur', 'bac' => $gauge, 'ondu' => 'Garantie'],
                    ['label' => 'Relevé mural', 'bac' => '60 mm à 80 mm pour engravure', 'ondu' => 'Standard BTP'],
                    ['label' => 'Bavette tombante', 'bac' => '120 mm à 150 mm avec ourlet Ø 12 mm', 'ondu' => 'Plaquage parfait']
                ]
            ];
            $guide_pose = [
                ['label' => 'Engravure', 'text' => 'Engraver le relevé supérieur dans la maçonnerie et garnir d\'un mastic élastomère de calfeutrement.'],
                ['label' => 'Fixation basse', 'text' => 'Visser l\'extrémité sur le sommet de nervure de tôle avec vis étanche.']
            ];
        }
    }

    // =========================================================================
    // 3. FIXATIONS ET ÉTANCHÉITÉ
    // =========================================================================
    elseif ( $cat_slug === 'fixations-et-etancheite' || preg_match( '/vis|tirefond|cavalier|toiturole|rondelle|plaquette|tige/iu', $title ) ) {
        $product_family = 'fixation';
        $pole = 'Pôle 1 : Systèmes de Fixation Certifiés & Étanchéité';

        if ( preg_match( '/vis.*auto/iu', $title ) ) {
            $is_70 = preg_match( '/70/iu', $title );
            $dim_text = $is_70 ? '6X70' : '6X60';
            $diagram_type = $is_70 ? 'fix_vis_6x70' : 'fix_vis_6x60';
            $diagram_title = "DESSIN TECHNIQUE COTÉ : VIS AUTO-FOREUSE $dim_text AVEC RONDELLE EPDM";
            $category = 'Vis Auto-Foreuses Industrielles avec Rondelle EPDM';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Fixation Rapide sur Panne Métallique / Bois";
            $commercial_desc = "Conçue pour un vissage direct haute performance sans avant-trou, la vis auto-foreuse TPM SA $dim_text intègre une pointe forêt trempée et une rondelle vulcanisée Inox-EPDM assurant une étanchéité hydrofuge absolue sous les pires intempéries.";
            $pills = ["POINTE FORÊT AUTO-PERCEUSE", "FILETAGE Ø 6,3 MM", "RONDELLE VULCANISÉE EPDM", "TRAITEMENT ANTICORROSION", "TÊTE HEXAGONALE 8 MM"];
            $points_forts = [
                ['icon' => 'bolt', 'title' => 'Pointe Forêt Perçage Direct', 'desc' => 'Perce en une seule opération la tôle aluminium et la panne acier jusqu\'à 6 mm d\'épaisseur.'],
                ['icon' => 'water_drop', 'title' => 'Étanchéité Élastomère EPDM', 'desc' => 'Rondelle vulcanisée ne séchant pas et conservant son élasticité sous UV tropicaux.'],
                ['icon' => 'shield', 'title' => 'Traitement Galvanique Renforcé', 'desc' => 'Zingage de classe supérieure résistant à la corrosion saline.']
            ];
            $specs_table = [
                'headers' => ['Paramètre Technique', "Vis Auto-Foreuse $dim_text", 'Norme'],
                'rows' => [
                    ['label' => 'Diamètre nominal', 'bac' => 'Ø 6,3 mm (Filet trempé)', 'ondu' => 'DIN 7504-K'],
                    ['label' => 'Longueur sous tête', 'bac' => ($is_70 ? '70 mm' : '60 mm'), 'ondu' => '± 0,5 mm'],
                    ['label' => 'Empreinte tête', 'bac' => 'Hexagonale 8 mm à collerette Ø 14 mm', 'ondu' => 'ISO Standard'],
                    ['label' => 'Pointe', 'bac' => 'Forêt #3 capacité de perçage 2 à 6 mm', 'ondu' => 'Acier cémenté'],
                    ['label' => 'Rondelle d\'étanchéité', 'bac' => 'Alu/Inox avec joint EPDM Ø 16 mm x 3 mm', 'ondu' => 'Inaltérable']
                ]
            ];
            $guide_pose = [
                ['label' => 'Outillage', 'text' => 'Utiliser une visseuse débrayable équipée d\'un embout magnétique 6 pans de 8 mm.'],
                ['label' => 'Couple de serrage', 'text' => 'Serrer jusqu\'à écrasement d\'environ 1 mm du joint EPDM sans dépasser la collerette métallique.']
            ];
        } elseif ( preg_match( '/tirefond/iu', $title ) ) {
            $is_80 = preg_match( '/80/iu', $title );
            $dim_text = $is_80 ? '6X80' : '6X60';
            $diagram_type = $is_80 ? 'fix_tirefond_6x80' : 'fix_tirefond_6x60';
            $diagram_title = "DESSIN TECHNIQUE COTÉ : TIREFOND À BOIS ZINGUÉ $dim_text (BOÎTE 72 PCS)";
            $category = 'Tirefonds à Bois Zingués pour Charpente Traditionnelle';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Fixation Forte Charge sur Charpente Bois";
            $commercial_desc = "Le tirefond zingué TPM SA $dim_text est l'organe d'ancrage de référence pour sceller fermement les tôles ondulées et bacs sur pannes en bois dur d'Afrique (Bilinga, Iroko, Tali). Son filetage à pas large offre une résistance à l'arrachement exceptionnelle lors des rafales de tornades.";
            $pills = ["ACIER ÉLECTRO-ZINGUÉ CLASSE 4.8", "FILETAGE BOIS LARGE", "TÊTE HEXAGONALE 10 MM", "RÉSISTANCE ARRACHEMENT MAX", "PAQUET DE 72 PIÈCES"];
            $points_forts = [
                ['icon' => 'carpenter', 'title' => 'Ancrage Puissant dans le Bois', 'desc' => 'Filet agressif garantissant une prise indéboulonnable dans toutes les essences de bois.'],
                ['icon' => 'shield', 'title' => 'Revêtement Zingué Anti-Rouille', 'desc' => 'Protection éprouvée contre la corrosion et les tanins corrosifs du bois d\'œuvre.'],
                ['icon' => 'inventory_2', 'title' => 'Conditionnement Chantier 72 pcs', 'desc' => 'Boîtes étanches de 72 pièces pratiques pour la gestion des approvisionnements.']
            ];
            $specs_table = [
                'headers' => ['Spécification', "Tirefond $dim_text TPM SA", 'Norme'],
                'rows' => [
                    ['label' => 'Diamètre de tige', 'bac' => 'Ø 6,0 mm', 'ondu' => 'DIN 571'],
                    ['label' => 'Longueur sous tête', 'bac' => ($is_80 ? '80 mm' : '60 mm'), 'ondu' => '± 1 mm'],
                    ['label' => 'Longueur filetage bois', 'bac' => ($is_80 ? '55 mm' : '42 mm'), 'ondu' => 'Pas large'],
                    ['label' => 'Tête', 'bac' => 'Hexagonale 10 mm (Clé de 10)', 'ondu' => 'Forgée'],
                    ['label' => 'Matière', 'bac' => 'Acier au carbone électro-zingué', 'ondu' => 'Classe 4.8']
                ]
            ];
            $guide_pose = [
                ['label' => 'Pré-perçage', 'text' => 'Effectuer un avant-trou de Ø 4 mm dans les bois durs pour éviter l\'éclatement de la panne.'],
                ['label' => 'Montage', 'text' => 'Associer impérativement un cavalier alu et une rondelle feutre bitumée avant vissage.']
            ];
        } elseif ( preg_match( '/cavalier/iu', $title ) ) {
            $is_prelaque = preg_match( '/pr[eé]laqu/iu', $title );
            $diagram_type = $is_prelaque ? 'fix_cavalier_prelaque' : 'fix_cavalier_nature';
            $diagram_title = "DESSIN TECHNIQUE COTÉ : CAVALIER D'ÉTANCHÉITÉ ALU " . ($is_prelaque ? 'PRÉLAQUÉ' : 'NATURE');
            $category = 'Cavaliers de Répartition & Étanchéité en Aluminium';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Serrage Réparti sur Sommet d'Onde";
            $commercial_desc = "Embouti dans un aluminium épais de premier choix aux usines TPM SA, le cavalier épouse rigoureusement le profil trapézoïdal ou ondulé de la tôle pour répartir la pression de serrage sans écraser la nervure et garantir une étanchéité pérenne.";
            $pills = ["ALUMINIUM ÉPAIS HAUTE RÉSISTANCE", "FORME TRAPÉZOÏDALE PARFAITE", "TROU DE PASSAGE Ø 6,5 MM", "FINITION NATURE OU LAQUÉE", "RÉPARTITION DE PRESSION"];
            $points_forts = [
                ['icon' => 'dashboard_customize', 'title' => 'Profilage Épousant l\'Onde', 'desc' => 'Évite la déformation ou l\'enfoncement de la nervure haute de la tôle sous le serrage.'],
                ['icon' => 'shield', 'title' => 'Inoxydable & Durable', 'desc' => 'Ne crée aucun couple galvanique avec la tôle aluminium de couverture.'],
                ['icon' => 'palette', 'title' => 'Disponible en Teintes RAL', 'desc' => 'Finition laquée au four identique aux tôles pour une toiture harmonieuse.']
            ];
            $specs_table = [
                'headers' => ['Paramètre', 'Cavalier Alu TPM SA', 'Norme'],
                'rows' => [
                    ['label' => 'Matériau', 'bac' => 'Aluminium 1ère fusion embouti ' . ($is_prelaque ? 'Prélaqué' : 'Naturel'), 'ondu' => 'Qualité usine'],
                    ['label' => 'Épaisseur métal', 'bac' => '1,0 mm à 1,2 mm massif', 'ondu' => 'Indéformable'],
                    ['label' => 'Perçage central', 'bac' => 'Ø 6,5 mm calibré pour vis/tirefond de 6 mm', 'ondu' => 'Centré'],
                    ['label' => 'Largeur d\'appui', 'bac' => '35 mm à 42 mm selon modèle', 'ondu' => 'Assise stable']
                ]
            ];
            $guide_pose = [
                ['label' => 'Positionnement', 'text' => 'Placer le cavalier au sommet de chaque nervure fixée au-dessus de la rondelle bitumée.'],
                ['label' => 'Serrage', 'text' => 'Serrer modérément sans déformer les ailes latérales du cavalier.']
            ];
        } elseif ( preg_match( '/toiturole/iu', $title ) ) {
            $diagram_type = 'fix_toiturole';
            $diagram_title = "SCHÉMA EN COUPE & STRUCTURE MULTICOUCHE : TOITUROLE ÉTANCHÉITÉ 900G";
            $category = 'Membranes Bitumineuses d\'Étanchéité Toiturole 900G';
            $header_title = "TOITUROLE ÉTANCHÉITÉ 900G (ROULEAU 10M)";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Étanchéité de Toitures-Terrasses & Noues";
            $commercial_desc = "Membrane élastomère SBS haute résistance renforcée d'une armature non-tissée de 900 g/m², Toiturole assure une barrière imperméable absolue pour l'étanchéité des toitures plates, terrasses maçonnées, sous-toitures et habillages de noues encaissées face aux pluies torrentielles.";
            $pills = ["ARMATURE RENFORCÉE 900 G/M²", "BITUME ÉLASTOMÈRE SBS SOUPLE", "ROULEAU 10 MÈTRES X 1 MÈTRE", "IMPERMÉABILITÉ TOTALE", "APPLICATION CHAUD OU FROID"];
            $points_forts = [
                ['icon' => 'layers', 'title' => 'Armature Non-Tissée 900 g/m²', 'desc' => 'Résistance exceptionnelle aux contraintes de dilatation thermique et de poinçonnement.'],
                ['icon' => 'water_drop', 'title' => 'Imperméabilité Totale Certifiée', 'desc' => 'Bloque 100% des infiltrations d\'eau stagnante sur dalles et toitures terrasses.'],
                ['icon' => 'wb_sunny', 'title' => 'Élasticité Haute Température', 'desc' => 'Formulation bitumineuse SBS ne devenant pas cassante sous le climat tropical.']
            ];
            $specs_table = [
                'headers' => ['Caractéristique', 'Toiturole 900G TPM SA', 'Norme'],
                'rows' => [
                    ['label' => 'Masse surfacique', 'bac' => '900 g/m² d\'armature haute densité', 'ondu' => 'Conforme BTP'],
                    ['label' => 'Dimensions rouleau', 'bac' => '10,00 m de longueur x 1,00 m de largeur', 'ondu' => '10 m² utiles'],
                    ['label' => 'Épaisseur', 'bac' => '2,5 mm à 3,0 mm', 'ondu' => 'Tolérance ± 0,2 mm'],
                    ['label' => 'Liant bitumineux', 'bac' => 'Bitume SBS modifié aux polymères', 'ondu' => 'Élastomère']
                ]
            ];
            $guide_pose = [
                ['label' => 'Préparation support', 'text' => 'Nettoyer et sécher le support maçonné ou bois. Appliquer un primaire d\'imprégnation à froid.'],
                ['label' => 'Recouvrement', 'text' => 'Prévoir un recouvrement longitudinal de 8 à 10 cm entre lés consécutifs et souder les joints.']
            ];
        } elseif ( preg_match( '/tige.*filet/iu', $title ) ) {
            $diagram_type = 'fix_tige_6x300';
            $diagram_title = "DESSIN TECHNIQUE COTÉ : TIGE FILETÉE ZINGUÉE M6X300 AVEC ÉCROUS";
            $category = 'Tiges Filetées Métriques en Acier Zingué';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Traversée de Charpente & Tirants";
            $commercial_desc = "Tige filetée en acier haute résistance zingué au pas métrique ISO M6 x 300 mm, idéale pour les traversées de charpentes épaisses, la fixation de suspentes et l'ancrage sécurisé des éléments de toiture.";
            $pills = ["FILETAGE MÉTRIQUE M6", "LONGUEUR 300 MM", "ACIER ZINGUÉ ANTICORROSION", "MONTAGE TRAVERSANT", "RÉSISTANCE MÉCANIQUE"];
            $points_forts = [
                ['icon' => 'straighten', 'title' => 'Longueur 300 mm Confortable', 'desc' => 'Traverse les madriers de charpente et empilages de poutres sans limitation.'],
                ['icon' => 'shield', 'title' => 'Zingage Anti-Corrosion', 'desc' => 'Protège le filetage contre l\'oxydation pour un démontage ou resserrage facile.'],
                ['icon' => 'build', 'title' => 'Découpe Facile sur Chantier', 'desc' => 'Peut être recoupée à la longueur exacte requise à la scie à métaux.']
            ];
            $specs_table = [
                'headers' => ['Spécification', 'Tige Filetée 6x300 TPM SA', 'Norme'],
                'rows' => [
                    ['label' => 'Filetage nominal', 'bac' => 'ISO Métrique M6 (Pas 1,0 mm)', 'ondu' => 'DIN 975'],
                    ['label' => 'Longueur totale', 'bac' => '300 mm', 'ondu' => '± 1,5 mm'],
                    ['label' => 'Nuance acier', 'bac' => 'Acier électro-zingué classe 4.8', 'ondu' => 'Haute ténacité']
                ]
            ];
            $guide_pose = [
                ['label' => 'Montage', 'text' => 'Percer le bois à Ø 6,5 mm, insérer la tige avec rondelles larges d\'appui sous les écrous de part et d\'autre.']
            ];
        } else {
            // Plaquettes et rondelles feutres
            $is_plaquette = preg_match( '/plaquette/iu', $title );
            $diagram_type = $is_plaquette ? 'fix_plaquette_feutre' : 'fix_rondelle_feutre';
            $diagram_title = "DESSIN TECHNIQUE COTÉ : " . ($is_plaquette ? 'PLAQUETTES FEUTRES BITUMÉES (BOÎTE 100 PCS)' : 'RONDELLES FEUTRES BITUMÉES (BOÎTE 100 PCS)');
            $category = 'Rondelles & Plaquettes Feutres Bitumées d\'Étanchéité';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Joint Étanche Sous Cavalier";
            $commercial_desc = "Fabriquées à partir de feutre dense imprégné de bitume hydrofuge, ces rondelles et plaquettes s'intercalent sous les têtes de fixations ou cavaliers pour créer un joint souple et indéformable qui colmate immédiatement le trou de perçage.";
            $pills = ["FEUTRE IMPRÉGNÉ BITUME", "COLMATAGE IMMÉDIAT DU PERÇAGE", "BOÎTE DE 100 PIÈCES", "INDÉFORMABLE AUX UV", "ÉTANCHÉITÉ ÉPROUVÉE"];
            $points_forts = [
                ['icon' => 'water_drop', 'title' => 'Joint Bitumineux Auto-Colmatant', 'desc' => 'Le bitume flue légèrement sous la pression pour boucher hermétiquement l\'orifice.'],
                ['icon' => 'shield', 'title' => 'Protection Anti-Choc Métal/Métal', 'desc' => 'Évite le contact direct agressif entre la rondelle métallique et la tôle alu.']
            ];
            $specs_table = [
                'headers' => ['Paramètre', 'Spécification TPM SA', 'Norme'],
                'rows' => [
                    ['label' => 'Matière', 'bac' => 'Feutre haute densité imprégné de bitume élastomère', 'ondu' => 'Hydrofuge'],
                    ['label' => 'Dimensions', 'bac' => ($is_plaquette ? 'Plaquette rectangulaire 25 x 35 mm' : 'Rondelle circulaire Ø 25 mm'), 'ondu' => 'Trou Ø 6,5 mm'],
                    ['label' => 'Conditionnement', 'bac' => 'Boîte scellée de 100 unités', 'ondu' => 'Prêt à poser']
                ]
            ];
            $guide_pose = [
                ['label' => 'Pose', 'text' => 'Placer systématiquement sous le cavalier alu avant d\'enfiler le tirefond ou la vis.']
            ];
        }
    }

    // =========================================================================
    // 4. CARREAUX SOLS & MURS (TILES)
    // =========================================================================
    elseif ( $cat_slug === 'carreaux-et-sols' || preg_match( '/carreau|faience|sol|mur/iu', $title ) ) {
        $product_family = 'carrelage';
        $pole = 'Pôle 3 : Carrelage Cérame Haute Densité & Faïences Décoratives';

        if ( preg_match( '/mur|25x40|25&#215;40/iu', $title ) ) {
            $diagram_type = 'carrelage_mur_25x40';
            $diagram_title = "PLAN COTÉ DU CARREAU & CALEPINAGE MURAL : FAÏENCE 25X40 CM";
            $category = 'Faïences Murales Émaillées Décoratives 25x40 cm';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Revêtement Mural Cuisines & Salles de Bain";
            $commercial_desc = "Faïence murale céramique 1er choix format 25x40 cm avec émail vitrifié brillant ou satiné haute brillance. Conçue pour sublimer les murs de salles de bain, douches et crédences de cuisine tout en offrant une facilité d'entretien absolue et une imperméabilité totale aux projections d'eau.";
            $pills = ["FORMAT MURAL 25X40 CM", "ÉMAIL VITRIFIÉ BRILLANT", "PREMIER CHOIX SANS DÉFAUT", "FACILITÉ D'ENTRETIEN", "CARTOUCHE 1.5 M²"];
            $points_forts = [
                ['icon' => 'sparkles', 'title' => 'Émail Vitrifié Haute Brillance', 'desc' => 'Surface lisse antitaches empêchant l\'adhérence du calcaire et des graisses.'],
                ['icon' => 'water_drop', 'title' => 'Imperméabilité Murale Totale', 'desc' => 'Protège efficacement les cloisons contre les infiltrations d\'eau de douche.'],
                ['icon' => 'cleaning_services', 'title' => 'Nettoyage Instantané', 'desc' => 'Se nettoie d\'un simple coup d\'éponge sans altération des motifs décoratifs.']
            ];
            $specs_table = [
                'headers' => ['Spécification', 'Faïence Murale 25x40 TPM SA', 'Norme ISO 13006'],
                'rows' => [
                    ['label' => 'Format nominal', 'bac' => '250 mm x 400 mm', 'ondu' => 'Tolérance ± 0,5%'],
                    ['label' => 'Épaisseur', 'bac' => '7,0 mm', 'ondu' => 'Groupe BIII'],
                    ['label' => 'Finition surface', 'bac' => 'Émaillée brillante avec décors haute définition', 'ondu' => 'Résistance rayures'],
                    ['label' => 'Absorption d\'eau', 'bac' => 'E > 10% (Pâte blanche poreuse murale)', 'ondu' => 'Adhérence colle max'],
                    ['label' => 'Conditionnement', 'bac' => 'Carton de 15 pièces (1,50 m²)', 'ondu' => 'Poids ~18 kg']
                ]
            ];
            $guide_pose = [
                ['label' => 'Colle', 'text' => 'Utiliser un mortier-colle blanc C1TE pour carrelage mural.'],
                ['label' => 'Jointoiement', 'text' => 'Joints réguliers de 2 mm avec croisillons et mortier à joint hydrofuge.']
            ];
        } elseif ( preg_match( '/15x80|15&#215;80/iu', $title ) ) {
            $diagram_type = 'carrelage_parquet_15x80';
            $diagram_title = "PLAN COTÉ DU CARREAU & CALEPINAGE PARQUET : LAME BOIS 15X80 CM";
            $category = 'Grès Cérame Effet Parquet Bois Naturel 15x80 cm';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Sol Effet Bois Chaleureux & Inaltérable";
            $commercial_desc = "Grès cérame émaillé format lame de parquet 15x80 cm reproduisant fidèlement le veinage, la texture et la chaleur du bois naturel noble (Merisier, Chêne, Noyer) sans les contraintes d'usure, de rayure ni de sensibilité à l'eau du parquet traditionnel.";
            $pills = ["FORMAT LAME 15X80 CM", "EFFET BOIS VEINÉ ULTRA-RÉALISTE", "GRÈS CÉRAME INDÉFORMABLE", "CLASSE R10 ANTIDÉRAPANT", "CARTOUCHE 1.2 M²"];
            $points_forts = [
                ['icon' => 'forest', 'title' => 'Chaleur du Bois / Force du Cérame', 'desc' => 'Esthétique parquet bois sans aucun risque de gonflement à l\'eau ni attaque de termites.'],
                ['icon' => 'footprint', 'title' => 'Surface Antidérapante R10', 'desc' => 'Adhérence sécurisée idéale pour séjours, chambres, terrasses et salles d\'eau.'],
                ['icon' => 'shield', 'title' => 'Résistance au Trafic Intense', 'desc' => 'Résiste aux talons aiguilles, griffes d\'animaux et déplacements de meubles lourds.']
            ];
            $specs_table = [
                'headers' => ['Paramètre', 'Lame Parquet Cérame 15x80', 'Norme'],
                'rows' => [
                    ['label' => 'Format', 'bac' => '150 mm x 800 mm', 'ondu' => 'Rectifié'],
                    ['label' => 'Épaisseur', 'bac' => '9,0 mm', 'ondu' => 'Groupe BIa'],
                    ['label' => 'Absorption d\'eau', 'bac' => 'E ≤ 0,5% (Grès cérame vitrifié)', 'ondu' => 'Imperméable'],
                    ['label' => 'Résistance à la flexion', 'bac' => '≥ 35 N/mm²', 'ondu' => 'Très haute charge']
                ]
            ];
            $guide_pose = [
                ['label' => 'Calepinage conseillé', 'text' => 'Pose décalée au tiers (1/3 maximum) ou en chevrons pour un rendu parquet authentique.'],
                ['label' => 'Joint', 'text' => 'Joint fin de 2 mm de teinte coordonnée à la nuance de bois.']
            ];
        } elseif ( preg_match( '/60x120|60&#215;120/iu', $title ) ) {
            $diagram_type = 'carrelage_xxl_60x120';
            $diagram_title = "PLAN COTÉ DU CARREAU & COUPE RECTIFIÉE : GRAND FORMAT XXL 60X120 CM";
            $category = 'Grès Cérame Grand Format XXL Rectifié 60x120 cm';
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Sols & Murs de Prestige Grand Format";
            $commercial_desc = "Dalles géantes en grès cérame pleine masse 60x120 cm bords rectifiés effet Marbre Breccia et Calacatta. Réduit drastiquement le nombre de joints pour créer une impression d'espace spectaculaire et une continuité visuelle prestigieuse dans les halls et salons d'exception.";
            $pills = ["GRAND FORMAT XXL 60X120 CM", "BORDS RECTIFIÉS 90°", "EFFET MARBRE CONTINU", "GRÈS PLEINE MASSE", "PRESTIGE ARCHITECTURAL"];
            $points_forts = [
                ['icon' => 'fullscreen', 'title' => 'Effet Grand Espace Sans Raccord', 'desc' => 'Dalles de 1,20 m réduisant de 50% les lignes de joints pour une pureté architecturale totale.'],
                ['icon' => 'diamond', 'title' => 'Bords Rectifiés au Laser', 'desc' => 'Permet la réalisation de micro-joints fins de 1,5 à 2 mm quasi invisibles.'],
                ['icon' => 'shield', 'title' => 'Résistance Extrême à l\'Abrasion', 'desc' => 'Conçu pour les halls d\'hôtels, concessions automobiles et villas de grand standing.']
            ];
            $specs_table = [
                'headers' => ['Spécification', 'Grès Cérame XXL 60x120', 'Norme ISO 13006'],
                'rows' => [
                    ['label' => 'Dimensions réelles', 'bac' => '600 mm x 1200 mm rectifié laser', 'ondu' => 'Tolérance ± 0,1%'],
                    ['label' => 'Épaisseur', 'bac' => '10,5 mm haute densité', 'ondu' => 'Indéformable'],
                    ['label' => 'Absorption d\'eau', 'bac' => 'E ≤ 0,1% (Porcelanato vitrifié)', 'ondu' => 'Zéro tache'],
                    ['label' => 'Conditionnement', 'bac' => 'Carton de 2 pièces (1,44 m²)', 'ondu' => 'Poids ~34 kg']
                ]
            ];
            $guide_pose = [
                ['label' => 'Double encollage', 'text' => 'Double encollage obligatoire (support + dos du carreau) avec mortier-colle déformable C2TE S1.'],
                ['label' => 'Nivellement', 'text' => 'Utiliser impérativement des croisillons autonivelants à vis ou cales pour une planéité parfaite.']
            ];
        } else {
            // Carreaux sols 60x60, 40x40, 30x30
            $is_60 = preg_match( '/60x60|60&#215;60|32x60|30x60/iu', $title );
            $is_40 = preg_match( '/40x40|40&#215;40/iu', $title );
            $dim_str = $is_60 ? '60x60 cm' : ($is_40 ? '40x40 cm' : '30x30 cm');
            $diagram_type = $is_60 ? 'carrelage_sol_60x60' : ($is_40 ? 'carrelage_sol_40x40' : 'carrelage_sol_30x30');
            $diagram_title = "PLAN COTÉ DU CARREAU & CALEPINAGE DE SOL : FORMAT $dim_str";
            $category = "Grès Cérame Sol Intérieur & Extérieur $dim_str";
            $header_title = strtoupper($title);
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Revêtement de Sol Haute Fréquentation";
            $commercial_desc = "Grès cérame émaillé premier choix format $dim_str offrant une résistance exemplaire au passage, aux chocs et aux taches pour tous les espaces de vie intérieurs, bureaux et terrasses couvertes.";
            $pills = ["FORMAT UNIVERSEL $dim_str", "GRÈS CÉRAME PREMIER CHOIX", "RÉSISTANCE RAYURES & CHOCS", "FACILE À NETTOYER", "QUALITÉ CONTRÔLÉE"];
            $points_forts = [
                ['icon' => 'grid_view', 'title' => 'Polyvalence & Esthétique', 'desc' => 'S\'adapte harmonieusement à toutes les pièces de la maison et locaux commerciaux.'],
                ['icon' => 'shield', 'title' => 'Résistance PEI IV / V', 'desc' => 'Émail robuste résistant à l\'abrasion continue sans ternir au fil des années.']
            ];
            $specs_table = [
                'headers' => ['Paramètre', "Carreau Sol $dim_str TPM SA", 'Norme'],
                'rows' => [
                    ['label' => 'Format', 'bac' => $dim_str, 'ondu' => 'Tolérance ± 0,3%'],
                    ['label' => 'Épaisseur', 'bac' => ($is_60 ? '9,5 mm' : ($is_40 ? '8,0 mm' : '7,5 mm')), 'ondu' => 'Groupe BIa'],
                    ['label' => 'Absorption', 'bac' => 'E ≤ 0,5% (Résistance taches classe 5)', 'ondu' => 'Imperméable']
                ]
            ];
            $guide_pose = [
                ['label' => 'Pose', 'text' => 'Poser sur chape sèche et dépoussiérée avec mortier-colle C2.'],
                ['label' => 'Joints', 'text' => 'Prévoir des joints de 2 à 3 mm avec croisillons calibrés.']
            ];
        }
    }

    // =========================================================================
    // 5. DOUCHES THÉRAPEUTIQUES
    // =========================================================================
    elseif ( $cat_slug === 'douches-therapeutiques' || preg_match( '/douche/iu', $title ) ) {
        $product_family = 'douche';
        $pole = 'Pôle 4 : Sanitaires & Douches Thérapeutiques Électroniques';

        if ( preg_match( '/lorenzetti|blind/iu', $title ) ) {
            $diagram_type = 'douche_lorenzetti_advanced';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ & CHAMBRE BLINDÉE : LORENZETTI ADVANCED";
            $category = 'Douche Thérapeutique Électronique Lorenzetti Advanced Blindée';
            $header_title = "DOUCHE THÉRAPEUTIQUE CENTRAL LORENZETTI ADVANCED BLINDÉ";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Douche Hydrothérapique Résistance Blindée";
            $commercial_desc = "Le sommet de la technologie brésilienne Lorenzetti : équipée d'une résistance blindée hermétique en acier inoxydable évitant tout contact direct avec l'eau, elle est spécialement recommandée pour les eaux dures ou forages au Cameroun. Son variateur électronique permet un réglage continu de la température au degré près.";
            $pills = ["RÉSISTANCE BLINDÉE INOX", "VARIATEUR ÉLECTRONIQUE PROGRESSIF", "IDÉAL EAU DE FORAGE / CALCAIRE", "GRAND DIFFUSEUR 23 CM", "SÉCURITÉ IP24"];
            $points_forts = [
                ['icon' => 'shield', 'title' => 'Résistance Blindée Inaltérable', 'desc' => 'Élément chauffant blindé dans un tube inox hermétique résistant à l\'entartrage des eaux de forage.'],
                ['icon' => 'tune', 'title' => 'Régulation Électronique au Degré Près', 'desc' => 'Tige de commande déportée permettant de faire varier la température de façon fluide et progressive.'],
                ['icon' => 'shower', 'title' => 'Large Ciel de Pluie 23 cm', 'desc' => 'Jets d\'eau enveloppants massant le corps pour une relaxation musculaire thérapeutique totale.']
            ];
            $specs_table = [
                'headers' => ['Caractéristique Technique', 'Lorenzetti Advanced Blindée', 'Norme Sécurité'],
                'rows' => [
                    ['label' => 'Tension / Puissance', 'bac' => '220V ~ 50/60 Hz | 6000W à 7500W', 'ondu' => 'Disjoncteur 32A/40A'],
                    ['label' => 'Dimensions produit', 'bac' => 'Longueur 49,8 cm x Largeur 23,0 cm x H 11,0 cm', 'ondu' => 'Poids ~1,4 kg'],
                    ['label' => 'Type d\'élément chauffant', 'bac' => 'Résistance blindée en tube Inox (Zéro contact eau)', 'ondu' => 'Durabilité x5'],
                    ['label' => 'Pression d\'utilisation', 'bac' => '10 à 400 kPa (1 à 40 m.c.a. / 0,1 à 4 bar)', 'ondu' => 'Multi-pressions'],
                    ['label' => 'Raccordement eau', 'bac' => 'Filetage 1/2" mâle avec canule intégrée', 'ondu' => 'Sans bras apparent'],
                    ['label' => 'Indice de protection', 'bac' => 'IP24 (Protection projections d\'eau)', 'ondu' => 'Certifié ABNT / NC']
                ]
            ];
            $guide_pose = [
                ['label' => 'Raccordement électrique', 'text' => 'Câblage direct depuis le tableau électrique avec conducteurs cuivre 6 mm² et disjoncteur différentiel 30 mA dédié.'],
                ['label' => 'Mise en eau impérative', 'text' => 'Faire couler l\'eau pendant 1 minute avant de brancher le courant électrique afin de purger l\'air de la chambre de chauffe.'],
                ['label' => 'Mise à la terre', 'text' => 'Raccorder obligatoirement le conducteur de terre vert/jaune au piquet de terre du bâtiment.']
            ];
        } elseif ( preg_match( '/cardal/iu', $title ) ) {
            $diagram_type = 'douche_cardal_central';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ & RACCORDEMENT MULTI-POINTS : CARDAL CENTRAL";
            $category = 'Chauffe-Eau Instantané Centralisé Multi-Points Cardal';
            $header_title = "DOUCHE THÉRAPEUTIQUE CENTRALISÉE CARDAL MULTI-POINTS";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Alimentation Simultanée Douche & Lavabo";
            $commercial_desc = "Système de chauffe-eau instantané centralisé compact Cardal conçu pour alimenter en eau chaude sous pression plusieurs points d'eau simultanés (douche, lavabo, bidet) sans ballon d'eau encombrant et avec déclenchement automatique au débit.";
            $pills = ["ALIMENTATION MULTI-POINTS", "CHÂSSIS COMPACT CUBIQUE", "DÉCLENCHEMENT AUTOMATIQUE", "ÉNERGIE À LA DEMANDE", "PUISSANCE 6500W"];
            $points_forts = [
                ['icon' => 'hub', 'title' => 'Distribution Multi-Postes', 'desc' => 'Alimente simultanément le pommeau de douche et le mitigeur de lavabo de la salle de bain.'],
                ['icon' => 'savings', 'title' => 'Économie d\'Énergie Zéro Perte', 'desc' => 'Chauffe l\'eau instantanément uniquement lors de l\'ouverture du robinet sans veille continue.']
            ];
            $specs_table = [
                'headers' => ['Paramètre', 'Cardal Centralisé TPM SA', 'Norme'],
                'rows' => [
                    ['label' => 'Puissance nominale', 'bac' => '220V | 5500W - 6500W', 'ondu' => 'Disjoncteur 32A'],
                    ['label' => 'Dimensions châssis', 'bac' => 'H 180 mm x L 150 mm x P 120 mm', 'ondu' => 'Ultra compact'],
                    ['label' => 'Entrée / Sortie eau', 'bac' => 'Filetages 1/2" mâle avec clapets antiretour', 'ondu' => 'Standard plomberie']
                ]
            ];
            $guide_pose = [
                ['label' => 'Installation murale', 'text' => 'Fixer sous lavabo ou en applique murale avec flexibles blindés 1/2" haute température.']
            ];
        } elseif ( preg_match( '/duo.*shower/iu', $title ) ) {
            $diagram_type = 'douche_duo_shower';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ : DUO SHOWER GRAND MODÈLE (DOUBLE JET PLUIE & DIRECTIONNEL)";
            $category = 'Douche Thérapeutique 2-en-1 Duo Shower Grand Modèle';
            $header_title = "DOUCHE THÉRAPEUTIQUE INDIVIDUELLE DUO SHOWER GRAND MODÈLE";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale avec Double Diffuseur Pluie & Jet Massant";
            $commercial_desc = "Le système d'exception 2-en-1 Duo Shower réunit un ciel de pluie extra-large de 25 cm pour un arrosage doux et enveloppant, ainsi qu'un jet directionnel orientable haute pression pour le massage localisé du dos et de la nuque.";
            $pills = ["DOUBLE JET 2-EN-1", "CIEL DE PLUIE Ø 25 CM", "JET DIRECTIONNEL ORIENTABLE", "RÉGULATEUR ÉLECTRONIQUE", "DESIGN PRESTIGE"];
            $points_forts = [
                ['icon' => 'shower', 'title' => 'Ciel de Pluie + Jet Focalisé', 'desc' => 'Bascule instantanée d\'un geste entre pluie relaxante et jet puissant de massage.'],
                ['icon' => 'tune', 'title' => 'Commande Électronique Linéaire', 'desc' => 'Ajustement micrométrique de la température d\'eau tiède à très chaude.']
            ];
            $specs_table = [
                'headers' => ['Spécification', 'Duo Shower Grand Modèle', 'Norme'],
                'rows' => [
                    ['label' => 'Puissance', 'bac' => '220V | 6800W à 7500W', 'ondu' => 'Disjoncteur 40A'],
                    ['label' => 'Diffuseur pluie', 'bac' => 'Largeur 250 mm avec picots silicone anticalcaire', 'ondu' => 'Nettoyage aisé'],
                    ['label' => 'Bras d\'extension', 'bac' => 'Longueur 450 mm renforcé', 'ondu' => 'Fixation murale 1/2"']
                ]
            ];
            $guide_pose = [
                ['label' => 'Montage mural', 'text' => 'Visser le raccord 1/2" sur l\'attente murale, purger l\'eau avant tout raccordement électrique.']
            ];
        } elseif ( preg_match( '/loren.*shower/iu', $title ) ) {
            $diagram_type = 'douche_loren_shower';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ : LOREN SHOWER GRAND MODÈLE 20X20 CM";
            $category = 'Douche Thérapeutique Loren Shower Grand Modèle';
            $header_title = "DOUCHE THÉRAPEUTIQUE INDIVIDUELLE LOREN SHOWER GRAND MODÈLE";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale Design Carré Épuré & Bras Intégré";
            $commercial_desc = "Design moderne carré 20x20 cm avec grand bras mural intégré et sélecteur de 4 températures confortables pour une douche revigorante au quotidien.";
            $pills = ["DESIGN CARRÉ 20X20 CM", "4 TEMPÉRATURES DE SAISON", "BRAS MURAL INTÉGRÉ 35 CM", "DURABILITÉ ÉPROUVÉE", "INSTALLATION RAPIDE"];
            $points_forts = [
                ['icon' => 'crop_square', 'title' => 'Design Carré Contemporain', 'desc' => 'Lignes droites épurées rehaussant l\'élégance de la salle de bain.'],
                ['icon' => 'thermostat', 'title' => '4 Niveaux de Température', 'desc' => 'Bascule simple Froid / Tiède / Chaud / Très Chaud.']
            ];
            $specs_table = [
                'headers' => ['Caractéristique', 'Loren Shower Grand Modèle', 'Norme'],
                'rows' => [
                    ['label' => 'Puissance', 'bac' => '220V | 5500W - 6800W', 'ondu' => '32A'],
                    ['label' => 'Tête de douche', 'bac' => '200 mm x 200 mm carrée', 'ondu' => 'Pluie large']
                ]
            ];
            $guide_pose = [
                ['label' => 'Raccordement', 'text' => 'Raccord direct 1/2" mural sans bras additionnel. Câblage 6 mm².']
            ];
        } elseif ( preg_match( '/zagonel/iu', $title ) ) {
            $diagram_type = 'douche_zagonel_moment';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ : DOUCHE ÉLECTRONIQUE ZAGONEL MOMENT";
            $category = 'Douche Thérapeutique Électronique Zagonel Moment';
            $header_title = "DOUCHE THÉRAPEUTIQUE ZAGONEL MOMENT ÉLECTRONIQUE";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale avec Témoin LED de Température";
            $commercial_desc = "Dotée d'un variateur progressif linéaire rotatif et d'un indicateur lumineux de température, la douche Zagonel Moment garantit un confort thermique absolu en toute sécurité.";
            $pills = ["VARIATEUR ROTATIF LINÉAIRE", "INDICATEUR LUMINEUX LED", "SYSTÈME MICRO-PULVÉRISATION", "SÉCURITÉ ANTI-CHOC", "ÉLÉMENT CHAUFFANT RAPIDE"];
            $points_forts = [
                ['icon' => 'light_mode', 'title' => 'Indicateur LED Température', 'desc' => 'Visualisation immédiate du niveau de chauffe pour éviter les brûlures.'],
                ['icon' => 'water', 'title' => 'Micro-Jets Thérapeutiques', 'desc' => 'Diffusion ultra-fine stimulant la circulation sanguine.']
            ];
            $specs_table = [
                'headers' => ['Paramètre', 'Zagonel Moment Électronique', 'Norme'],
                'rows' => [
                    ['label' => 'Puissance', 'bac' => '220V | 5500W - 7500W progressif', 'ondu' => 'Disjoncteur 32A'],
                    ['label' => 'Longueur totale', 'bac' => '380 mm x Largeur 160 mm', 'ondu' => 'Compacte']
                ]
            ];
            $guide_pose = [
                ['label' => 'Pose', 'text' => 'Visser sur manchon 1/2", remplir d\'eau, puis brancher sur alimentation protégée.']
            ];
        } else {
            // Maxi Ducha petit modèle
            $diagram_type = 'douche_maxi_ducha';
            $diagram_title = "SCHÉMA TECHNIQUE COTÉ : MAXI DUCHA COMPACT 3 TEMPÉRATURES";
            $category = 'Douche Thérapeutique Compacte Maxi Ducha 3 Températures';
            $header_title = "DOUCHE THÉRAPEUTIQUE INDIVIDUELLE PETIT MODÈLE MAXI DUCHA";
            $header_subtitle = "Fiche Descriptive Technique & Commerciale Modèle Économique & Robuste";
            $commercial_desc = "Le chauffe-eau de douche le plus populaire et éprouvé : compact, économique et ultra-fiable avec sélecteur 3 températures pour une eau chaude instantanée au meilleur prix.";
            $pills = ["MODÈLE COMPACT ÉCONOMIQUE", "3 TEMPÉRATURES (CHAUD/TIÈDE/FROID)", "RÉSISTANCE REMPLAÇABLE RAPIDE", "RACCORDEMENT 1/2\"", "FIABILITÉ ÉPROUVÉE"];
            $points_forts = [
                ['icon' => 'payments', 'title' => 'Prix Très Abordable', 'desc' => 'Le meilleur rapport qualité/prix pour équiper toutes les salles d\'eau.'],
                ['icon' => 'build', 'title' => 'Maintenance Facile', 'desc' => 'Résistance facilement remplaçable disponible en pièces détachées chez TPM SA.']
            ];
            $specs_table = [
                'headers' => ['Caractéristique', 'Maxi Ducha Petit Modèle', 'Norme'],
                'rows' => [
                    ['label' => 'Puissance', 'bac' => '220V | 4600W - 5500W', 'ondu' => 'Disjoncteur 25A/32A'],
                    ['label' => 'Diamètre diffuseur', 'bac' => 'Ø 140 mm dôme compact', 'ondu' => '1/2" femelle']
                ]
            ];
            $guide_pose = [
                ['label' => 'Installation', 'text' => 'Visser sur bras de douche 1/2", purger l\'eau avant de mettre sous tension. Câbles 4 mm² mini.']
            ];
        }
    }

    // =========================================================================
    // 6. ÉPONGES MÉTALLIQUES ET AUTRES
    // =========================================================================
    elseif ( preg_match( '/[eé]ponge/iu', $title ) ) {
        $product_family = 'eponge';
        $pole = 'Pôle 1 : Abrasifs Industriels & Éponges Métalliques Inox';

        $is_double = preg_match( '/doubl/iu', $title );
        $diagram_type = $is_double ? 'eponge_doublee' : 'eponge_non_doublee';
        $diagram_title = "DESSIN TECHNIQUE & MICROSTRUCTURE DU TISSAGE : " . ($is_double ? 'ÉPONGE MÉTALLIQUE DOUBLÉE (20 PCS)' : 'ÉPONGE MÉTALLIQUE INOX (25 PCS)');
        $category = 'Éponges Métalliques Inox Industrielles & Ménagères';
        $header_title = strtoupper($title);
        $header_subtitle = "Fiche Descriptive Technique & Commerciale pour Décapage Industriel & Entretien Lourd";
        $commercial_desc = "Tressées en fil d'acier inoxydable pur AISI 430 tréfilé sans aspérité coupante, les éponges métalliques TPM SA garantissent un décapage puissant sans rayer les métaux et sans s'effilocher au contact des graisses cuites et dépôts tenaces.";
        $pills = ["100% INOX AISI 430 PUR", "TISSAGE SPIRALÉ ANTI-EFFILOCHAGE", "ZÉRO ROUILLE DANS L'EAU", "POUVOIR DÉCAPANT SUPÉRIEUR", $is_double ? "SACHET DE 20 PCS" : "SACHET DE 25 PCS"];
        $points_forts = [
            ['icon' => 'cleaning_services', 'title' => 'Décapage Extrême Sans Effort', 'desc' => 'Élimine instantanément les résidus brûlés, rouille de surface et graisses carbonisées.'],
            ['icon' => 'shield', 'title' => 'Inoxydable Même Immergée', 'desc' => 'Fil d\'acier inoxydable ne rouillant jamais et ne laissant pas de traces de rouille sur les éviers.'],
            ['icon' => 'fitness_center', 'title' => 'Tressage Haute Densité', 'desc' => 'Conserve son volume compact sous forte pression manuelle sans se déliter.']
        ];
        $specs_table = [
            'headers' => ['Spécification', 'Éponge Inox TPM SA', 'Norme'],
            'rows' => [
                ['label' => 'Matériau', 'bac' => 'Acier Inoxydable AISI 430 / 304 pur', 'ondu' => 'Alimentaire'],
                ['label' => 'Structure fil', 'bac' => 'Ruban plat spiralé sans arête coupante pour les mains', 'ondu' => 'Anti-blessure'],
                ['label' => 'Dimensions / Poids', 'bac' => ($is_double ? 'Coussin doublé 110 x 70 x 30 mm (45g)' : 'Sphère compacte Ø 85 mm (40g)'), 'ondu' => 'Gros modèle'],
                ['label' => 'Conditionnement', 'bac' => ($is_double ? 'Sachet de 20 pièces' : 'Sachet de 25 pièces'), 'ondu' => 'Scellé']
            ]
        ];
        $guide_pose = [
            ['label' => 'Utilisation', 'text' => 'Humidifier avec de l\'eau et un peu de détergent avant frottement pour décupler l\'effet décapant.'],
            ['label' => 'Rinçage', 'text' => 'Rincer abondamment à l\'eau claire après chaque usage et laisser égoutter.']
        ];
    } else {
        // Plasturgie / Sacs PP et autres
        $product_family = 'sac_pp';
        $pole = 'Pôle 2 : Plasturgie Industrielle & Emballages Polypropylène';
        $diagram_type = 'sac_pp_tisse';
        $diagram_title = "PLAN COTÉ & COUTURE DE FOND : SAC POLYPROPYLÈNE TISSÉ RENFORCÉ";

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
                ['label' => 'Armure de tissage', 'bac' => 'Tissage circulaire régulier sans couture latérale', 'ondu' => 'Haute densité 10x10'],
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
        'diagram_type'       => $diagram_type,
        'diagram_title'      => $diagram_title,
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