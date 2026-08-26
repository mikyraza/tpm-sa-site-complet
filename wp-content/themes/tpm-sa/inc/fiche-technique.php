<?php
/**
 * wp-content/themes/tpm-sa/inc/fiche-technique.php
 * Générateur officiel des Fiches Techniques Certifiées TPM SA (Groupe CAC)
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

    // 1. TÔLES ET TOITURE
    if ( $cat_slug === 'toles-et-toiture' || preg_match( '/tôle|tole/iu', $title ) ) {
        $pole = 'Pôle 1 : Tôles de Couverture & Bacs Aluminium';
        if ( preg_match( '/tuile/iu', $title ) ) {
            $category    = 'Tôles de Couverture Nervurées Style Tuile Architecturale';
            $material    = 'Aluminium Prélaqué Cuit au Four Haute Densité';
            $profil      = 'Profil Ondulé Tuile Nervurale D50 Renforcé';
            $epaisseur   = '0,50 mm réel garanti';
            $finition    = 'Prélaquage Polyester Haute Résistance UV (Bordeaux RAL 3005, Terracotta, etc.)';
            $longueurs   = '2,00 m à 6,00 m (ou profilage continu jusqu\'à 12 m)';
            $description = "La tôle Tuile nervurale prélaquée D50 allie l'élégance intemporelle des toitures traditionnelles en terre cuite à la légèreté et l'inaltérabilité de l'aluminium. Son profilage exclusif confère aux résidences un cachet architectural prestigieux tout en garantissant une étanchéité parfaite face aux pluies torrentielles.";
            $avantages   = [
                "Esthétique haut de gamme apportant une plus-value visuelle immédiate au bâtiment.",
                "Profilage renforcé résistant aux déformations mécaniques et aux vents violents.",
                "Traitement thermolaqué inaltérable protégeant contre la décoloration solaire équatoriale.",
                "Poids réduit divisant par 5 la charge sur la charpente par rapport aux tuiles maçonnées."
            ];
            $applications = "Villas résidentielles de standing, hôtels, résidences privées et édifices de prestige.";
            $pose         = "Vissage au sommet d'ondes avec vis auto-foreuses laquées et cavaliers assortis. Pente minimale conseillée : 10%.";
        } elseif ( preg_match( '/d50/iu', $title ) ) {
            $category    = 'Tôles Industrielles Haute Rigidité (Profil D50)';
            $material    = 'Aluminium Prélaqué 1er Choix';
            $profil      = 'Profil BAC D50 à ondes profondes trapézoïdales';
            $epaisseur   = '0,50 mm réel garanti';
            $finition    = 'Prélaquage Polyester Double Face Haute Durabilité';
            $longueurs   = 'Sur-mesure de 2,00 m à 12,00 m au centimètre près';
            $description = "Profilé avec des nervures profondes de 50 mm, le BAC D50 est conçu pour franchir de très grandes portées entre pannes sans aucun risque de fléchissement. Il est le standard par excellence des bâtiments industriels et des grandes surfaces de stockage.";
            $avantages   = [
                "Moment d'inertie exceptionnel autorisant un écartement maximal des pannes de charpente.",
                "Capacité d'évacuation hydraulique hors normes pour les toitures à faible pente.",
                "Rigidité structurelle permettant la circulation sécurisée lors de l'entretien de toiture.",
                "Garantie anticorrosion totale sous atmosphère industrielle et côtière."
            ];
            $applications = "Hangars industriels, usines, entrepôts logistiques, supermarchés et gymnases.";
            $pose         = "Fixation sur pannes métalliques IPN/IPE avec vis auto-foreuses 6x70 et cavaliers renforcés D50.";
        } elseif ( preg_match( '/6\/10|0[,.]60/iu', $title ) ) {
            $is_prelaque = preg_match( '/pr[eé]laqu/iu', $title );
            $category    = 'Toitures Calibre Lourd Haute Résistance (Épaisseur 6/10e)';
            $material    = $is_prelaque ? 'Aluminium Prélaqué Cuit au Four' : 'Aluminium Naturel Massif 1er Choix';
            $profil      = 'Profil BACS Nervuré ou Ondulé Sinusoïdal';
            $epaisseur   = '6/10ème de millimètre (0,60 mm massif réel garanti)';
            $finition    = $is_prelaque ? 'Prélaquage Teintes RAL Cuit au Four' : 'Aluminium Brut Naturel Inaltérable';
            $longueurs   = '2,00 m à 12,00 m sur profilage continu';
            $description = "Avec son épaisseur de 0,60 mm réel, cette tôle constitue le sommet de la robustesse mécanique. Insensible aux chutes de branches, aux déformations dues au vent et aux agressions du climat littoral, elle offre une durée de vie supérieure à 50 ans sans aucune altération.";
            $avantages   = [
                "Épaisseur massive de 0,60 mm offrant une indéformabilité totale aux surcharges.",
                "Résistance absolue aux embruns marins salins et à la corrosion tropicale.",
                "Affaiblissement acoustique supérieur atténuant l'impact sonore des fortes averses.",
                "Investissement patrimonial pérenne sans aucun entretien nécessaire."
            ];
            $applications = "Bâtiments côtiers (Douala, Kribi, Limbé), infrastructures portuaires, villas de maître et usines chimiques.";
            $pose         = "Fixation robuste sur charpente bois ou métallique par vis auto-foreuses ou tirefonds 6x80 zingués.";
        } elseif ( preg_match( '/5\/10|0[,.]50/iu', $title ) ) {
            $is_prelaque = preg_match( '/pr[eé]laqu/iu', $title );
            $category    = 'Toitures Calibre Médium Renforcé (Épaisseur 5/10e)';
            $material    = $is_prelaque ? 'Aluminium Prélaqué Haute Durabilité' : 'Aluminium Brut Naturel Premier Choix';
            $profil      = 'Profil BACS 4N/5N ou Profil Ondulé';
            $epaisseur   = '5/10ème de millimètre (0,50 mm massif réel)';
            $finition    = $is_prelaque ? 'Prélaquage Polyester Haute Brillance (Bordeaux, Bleu, Vert)' : 'Aluminium Brut Brillant / Satiné';
            $longueurs   = 'Coupe sur mesure de 2,00 m à 12,00 m';
            $description = "Épaisseur plébiscitée par les constructeurs et architectes au Cameroun, la tôle 5/10e (0,50 mm) conjugue une excellente tenue mécanique face aux dépressions de vent et un rapport coût/durabilité optimal pour les toitures pérennes.";
            $avantages   = [
                "Épaisseur réelle 0,50 mm éliminant tout risque de gondolement sous la chaleur.",
                "Excellente planéité des versants de toiture et esthétique contemporaine nette.",
                "Totalement inoxydable, insensible aux pluies équatoriales acides.",
                "Conformité intégrale aux spécifications de durabilité BTP du Cameroun."
            ];
            $applications = "Résidences individuelles, immeubles de rapport, écoles, hôpitaux et bâtiments administratifs.";
            $pose         = "Fixation sur sommet d'onde avec tirefonds 6x60 / 6x80 ou vis auto-foreuses avec cavaliers et rondelles feutre.";
        } elseif ( preg_match( '/b30/iu', $title ) ) {
            $category    = 'Tôles Bacs Prélaquées Économiques (Gamme B30 2ème Choix)';
            $material    = 'Acier Galvanisé Prélaqué Contrôlé';
            $profil      = 'Profil Nervuré B30';
            $epaisseur   = '0,30 mm à 0,35 mm';
            $finition    = 'Prélaqué Couleur Standard Usine';
            $longueurs   = 'Longueurs standards disponibles en parc usine';
            $description = "Solution économique contrôlée par les ingénieurs TPM SA, la tôle B30 2ème choix permet de réaliser des couvertures et clôtures étanches à coût maîtrisé pour les projets agricoles, hangars temporaires et chantiers.";
            $avantages   = [
                "Tarif ultra-compétitif au mètre linéaire direct fabricant.",
                "Couverture étanche immédiate pour bâtiments utilitaires et clôtures.",
                "Maniabilité et légèreté facilitant la mise en place manuelle rapide.",
                "Contrôle qualité usine assurant l'intégrité de la barrière anticorrosion."
            ];
            $applications = "Clôtures de sécurité de chantiers, hangars agricoles, auvents de stockage et abris d'élevage.";
            $pose         = "Pose sur pannes légères avec vis à tête hexagonale et rondelles d'étanchéité néoprène.";
        } elseif ( preg_match( '/ondul[eé]e.*3m/iu', $title ) ) {
            $category    = 'Tôles Ondulées Traditionnelles Calibrées';
            $material    = 'Aluminium Naturel Haute Pureté';
            $profil      = 'Profil Sinusoïdal Régulier (Ondes continues)';
            $epaisseur   = '0,35 mm nominal';
            $finition    = 'Aluminium Brut Naturel Inaltérable';
            $longueurs   = 'Format calibré pratique de 3,00 mètres';
            $description = "Le modèle historique le plus diffusé pour l'habitat traditionnel et rural. Son format calibré de 3 mètres facilite le transport en véhicule utilitaire et sa pose rapide sur charpente bois simple sans engin de levage.";
            $avantages   = [
                "Format 3,00 m ultra-maniable réduisant les coûts logistiques de transport.",
                "Profil ondulé assurant un écoulement fluide et régulier des eaux pluviales.",
                "100% Inoxydable, garantissant plus de 30 ans de service sans rouille.",
                "Rapport qualité/prix imbattable pour l'habitat économique."
            ];
            $applications = "Habitations individuelles, toitures agricoles, annexes, vérandas et clôtures.";
            $pose         = "Recouvrement transversal d'une onde et demi, recouvrement longitudinal de 15 à 20 cm, fixation par tirefonds.";
        } else {
            // Bac 4N/5N 0,35
            $is_prelaque = preg_match( '/pr[eé]laqu/iu', $title );
            $category    = 'Tôles de Couverture Nervurées BACS Aluminium (Profil 4N & 5N)';
            $material    = $is_prelaque ? 'Aluminium Prélaqué Thermodurci' : 'Aluminium Pur Premier Choix';
            $profil      = '4 Nervures (4N) ou 5 Nervures (5N) avec rainure anti-capillarité';
            $epaisseur   = '0,35 mm nominal direct usine';
            $finition    = $is_prelaque ? 'Prélaquage Polyester Cuit au Four Teintes RAL' : 'Aluminium Brut Naturel Brillant / Satiné';
            $longueurs   = '2,00 m à 6,00 m standard (ou sur-mesure jusqu\'à 12 m)';
            $description = "La tôle BAC en aluminium 4N et 5N est la référence incontournable de la toiture industrielle et résidentielle au Cameroun. Ses nervures trapézoïdales profondes lui confèrent une rigidité structurelle élevée, une excellente portée entre pannes et une évacuation rapide des fortes averses équatoriales.";
            $avantages   = [
                "Rigidité structurelle trapézoïdale résistant aux vents et aux fortes charges pluviales.",
                "100% Inoxydable : insensibilité totale à la rouille sous climat tropical.",
                "Rainure latérale de sécurité brevetée empêchant les remontées d'eau par capillarité.",
                "Légèreté structurelle diminuant les contraintes de charge sur la charpente."
            ];
            $applications = "Hangars, entrepôts, toitures résidentielles, ateliers, marchés et complexes commerciaux.";
            $pose         = "Fixation au sommet des nervures avec vis auto-foreuses ou tirefonds 6x60 / 6x80 avec cavaliers alu et rondelles d'étanchéité.";
        }
    }
    // 2. ACCESSOIRES TOITURE
    elseif ( $cat_slug === 'accessoires-toiture' || preg_match( '/fa[iî]ti[eè]re|bandes\s+ourl[eé]es|rives|goutti[eè]re|noues/iu', $title ) ) {
        $pole = 'Pôle 2 : Accessoires de Toiture & Pliages Industriels';
        if ( preg_match( '/fa[iî]ti[eè]re/iu', $title ) ) {
            $is_crantee  = preg_match( '/crant/iu', $title );
            $is_centrale = preg_match( '/centrale/iu', $title );
            $category    = $is_centrale ? 'Accessoires de Faîtage Central & Crête de Toiture' : 'Faîtières Double Pente d\'Étanchéité Supérieure';
            $material    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Aluminium Prélaqué Cuit au Four' : 'Aluminium Naturel 1er Choix';
            $profil      = $is_crantee ? 'Faîtière crantée épousant l\'onde exacte de la tôle BAC' : 'Profil angulaire lisse double pente ou demi-ronde centrale';
            $epaisseur   = preg_match( '/5\/10/iu', $title ) ? '0,50 mm (5/10e massif)' : (preg_match( '/0[,.]40/iu', $title ) ? '0,40 mm' : '0,35 mm standard');
            $finition    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Prélaquage Polyester Teintes RAL' : 'Aluminium Brut Naturel Inoxydable';
            $longueurs   = '2,00 m et 3,00 m standard (ou sur-mesure au ml)';
            $description = "Élément d'étanchéité supérieur posé sur la ligne de faîte reliant les versants opposés de la toiture. Elle forme une barrière hermétique absolue contre les infiltrations d'eau de pluie, les poussières et les bourrasques de vent sous le comble.";
            $avantages   = [
                "Herméticité totale au sommet de toiture, point le plus exposé aux intempéries.",
                "Aluminium pur inoxydable éliminant tout risque de rouille ou de dégradation.",
                "Pliage industriel régulier garantissant un recouvrement net et propre.",
                "Teinte coordonnée avec les tôles pour une finition architecturale soignée."
            ];
            $applications = "Faîtage sommital de maisons, hangars, villas et toitures à deux versants ou plus.";
            $pose         = "Pose avec recouvrement longitudinal de 15 cm minimum, vissage sur sommet d'onde avec vis et rondelles bitumées.";
        } elseif ( preg_match( '/rive/iu', $title ) ) {
            $category    = 'Accessoires de Rive Latérale & Finition de Pignon';
            $material    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Aluminium / Acier Prélaqué' : 'Aluminium Naturel 1er Choix';
            $profil      = 'Pliage en équerre avec goutte d\'eau rabattue anti-ruissellement';
            $epaisseur   = preg_match( '/5\/10/iu', $title ) ? '0,50 mm' : (preg_match( '/0[,.]40/iu', $title ) ? '0,40 mm' : '0,35 mm');
            $finition    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Prélaquage Polyester Cuit au Four' : 'Aluminium Brut Naturel';
            $longueurs   = '2,00 m et 3,00 m (ou découpe sur-mesure)';
            $description = "La rive de faîtage habille les extrémités latérales du toit (pignons). Elle protège la charpente contre les pluies battantes de côté et empêche le vent de s'engouffrer sous la couverture, prévenant tout risque d'arrachement.";
            $avantages   = [
                "Protection décisive contre l'arrachement de la toiture sous les vents violents.",
                "Protection étanche des planches de rive en bois contre la pourriture pluviale.",
                "Ligne esthétique parfaite fermant élégamment les bordures de toiture.",
                "Pose rapide par vissage latéral et supérieur sur la première onde de tôle."
            ];
            $applications = "Rives latérales de bâtiments industriels, maisons individuelles et entrepôts.";
            $pose         = "Fixation sur la planche de rive avec vis à bois étanches et liaison sur la tôle avec vis auto-foreuses.";
        } elseif ( preg_match( '/goutti[eè]re/iu', $title ) ) {
            $category    = 'Évacuation Pluviale & Collecte des Eaux de Toiture';
            $material    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Aluminium Prélaqué Cuit au Four' : 'Aluminium Brut Naturel';
            $profil      = 'Profil profilé semi-ouvert grand débit avec ourlet rigide';
            $epaisseur   = preg_match( '/5\/10/iu', $title ) ? '0,50 mm' : '0,35 mm nominal';
            $finition    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Prélaqué Couleur Résistant UV' : 'Aluminium Naturel';
            $longueurs   = '2,00 m à 4,00 m ou profilage continu';
            $description = "Gouttière formée en continu en aluminium inoxydable conçue pour collecter et évacuer de grands débits d'eau de pluie. Elle préserve les fondations, évite l'érosion des abords du bâtiment et empêche les éclaboussures sur les murs.";
            $avantages   = [
                "Collecte grand débit évacuant sans débordement les averses tropicales intenses.",
                "Inoxydable : durée de vie illimitée sans perçage par la rouille.",
                "Protection des façades, crépis et fondations contre le ravinement des eaux.",
                "Système complet compatible avec crochets, naissances et tuyaux de descente."
            ];
            $applications = "Bas de pente de toitures résidentielles, commerciales et industrielles.";
            $pose         = "Fixation sur crochets bandeaux tous les 50 cm avec pente minimale d'écoulement de 5 mm par mètre.";
        } elseif ( preg_match( '/noue/iu', $title ) ) {
            $category    = 'Accessoires d\'Étanchéité d\'Arête Rentrante (Noues)';
            $material    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Aluminium Prélaqué' : 'Aluminium Naturel Pur';
            $profil      = 'Pliage en V ouvert avec ailes larges et relevés d\'étanchéité';
            $epaisseur   = preg_match( '/5\/10/iu', $title ) ? '0,50 mm' : '0,35 mm';
            $finition    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Prélaqué Polyester' : 'Aluminium Brut';
            $longueurs   = '2,00 m et 3,00 m standard';
            $description = "Pièce maîtresse de canalisation d'eau située à l'intersection rentrante de deux versants de toiture. La noue TPM SA canalise les flux convergents vers l'égout ou la gouttière en garantissant une étanchéité sans faille.";
            $avantages   = [
                "Canalisation sécurisée des plus forts volumes d'eau de ruissellement convergent.",
                "Relevés latéraux empêchant tout débordement sous les tôles de couverture.",
                "Matériau aluminium inaltérable résistant aux frottements continus de l'eau.",
                "Parfaite adaptabilité à tous les angles de pente de toiture."
            ];
            $applications = "Carrefours et rencontres de versants de toiture en V rentrant.";
            $pose         = "Pose sur plancher de noue continu en bois, recouvrement de 20 cm dans le sens de la pente.";
        } else {
            // Bandes ourlées
            $category    = 'Accessoires de Solin & Raccordement Mural de Toiture';
            $material    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Aluminium / Acier Prélaqué' : 'Aluminium Naturel 1er Choix (Brut)';
            $profil      = 'Développé 0.33 m à 0.35 m avec boudin ourlet anti-goutte';
            $epaisseur   = preg_match( '/5\/10/iu', $title ) ? '0,50 mm' : (preg_match( '/0[,.]40/iu', $title ) ? '0,40 mm' : '0,35 mm');
            $finition    = preg_match( '/pr[eé]laqu/iu', $title ) ? 'Prélaquage Polyester Cuit au Four' : 'Aluminium Brut Inoxydable';
            $longueurs   = '2,00 m et 3,00 m standard (ou sur-mesure au ml)';
            $description = "La bande ourlée en aluminium assure la jonction étanche entre la toiture en tôles et les parois verticales (murs de pignon, acrotères, cheminées). Son bord replié en forme de boudin (ourlet) rigidifie la pièce métallique, empêche le déchirement par le vent et crée une barrière mécanique contre les remontées d'eau par capillarité.";
            $avantages   = [
                "Étanchéité périphérique totale contre les infiltrations pluviales latérales.",
                "Ourlet de bordure anti-goutte évitant le ruissellement d'eau sur la maçonnerie.",
                "Résistance exceptionnelle à la corrosion tropicale et aux environnements humides.",
                "Pose rapide avec solin maçonné ou mastic d'étanchéité polyuréthane."
            ];
            $applications = "Jonctions toiture-murs, acrotères, cheminées et lucarnes.";
            $pose         = "Fixation contre le mur à l'aide de vis et chevilles étanches avec joint d'étanchéité supérieur, recouvrement de 10 cm minimum.";
        }
    }
    // 3. FIXATIONS ET ÉTANCHÉITÉ
    elseif ( $cat_slug === 'fixations-et-etancheite' || preg_match( '/vis|tirefond|tige|cavalier|toiturole|feutre/iu', $title ) ) {
        $pole = 'Pôle 3 : Fixations Zinguées & Étanchéité';
        if ( preg_match( '/vis\s+auto/iu', $title ) ) {
            preg_match( '/6[Xx]\d+/', $title, $m );
            $dim = ! empty( $m[0] ) ? strtoupper( $m[0] ) : '6X70';
            $category    = 'Visserie Industrielle & Fixation Rapide Haute Cadence';
            $material    = 'Acier Cémenté Trempé Haute Dureté Zingué Anticorrosion';
            $profil      = "Vis auto-foreuse pointe forêt avec tête hexagonale à embase";
            $epaisseur   = "Diamètre de tige Ø 6,3 mm ({$dim} mm de longueur)";
            $finition    = 'Électro-zingage haute protection ou tête laquée couleur toiture';
            $longueurs   = 'Vente à la pièce ou boîte distributrice de 100 / 500 pcs';
            $description = "Les vis auto-foreuses TPM SA permettent une fixation ultra-rapide en une seule opération : perçage de la tôle et de la panne, taraudage et serrage étanche. Équipées d'une rondelle vulcanisée avec joint néoprène EPDM, elles garantissent une étanchéité absolue sans suintement d'eau.";
            $avantages   = [
                "Perçage direct ultra-rapide sans pré-perçage manuel dans l'acier ou le bois.",
                "Rondelle métallique vulcanisée avec élastomère EPDM garantissant l'étanchéité au vissage.",
                "Traitement électro-zingué anticorrosion résistant aux atmosphères tropicales.",
                "Tête hexagonale assurant une prise parfaite sans rippage de la visseuse."
            ];
            $applications = "Fixation de tôles bacs et ondulées sur pannes métalliques IPN/UAP ou pannes bois.";
            $pose         = "Vissage à l'aide d'une visseuse avec embout douille hexagonale calibrée, sans écraser excessivement la rondelle EPDM.";
        } elseif ( preg_match( '/tirefond/iu', $title ) ) {
            preg_match( '/6[Xx]\d+/', $title, $m );
            $dim = ! empty( $m[0] ) ? strtoupper( $m[0] ) : '6X80';
            $category    = 'Tirefonds d\'Ancrage Lourd pour Charpentes Bois';
            $material    = 'Acier Forgé Zingué à Chaud au Pas Métrique';
            $profil      = 'Filetage hélicoïdal profond à pointe conique spéciale bois';
            $epaisseur   = "Diamètre calibré Ø 6,0 mm (Longueur {$dim} mm)";
            $finition    = 'Traitement de surface zingué brillant anticorrosion';
            $longueurs   = 'Conditionnement usine en paquets calibrés de 72 pièces';
            $description = "Le tirefond à bois zingué TPM SA est la fixation traditionnelle par excellence pour ancrer solidement les tôles de toiture dans les charpentes massives en bois. Son filetage profond s'ancre au cœur des fibres de bois pour offrir une résistance à l'arrachement inégalée face aux tempêtes.";
            $avantages   = [
                "Filetage hélicoïdal profond assurant une tenue mécanique extrême à l'arrachement.",
                "Traitement de surface zingué résistant à l'oxydation en milieu tropical humide.",
                "Tête hexagonale forgée permettant un serrage puissant à la clé plate ou à pipe.",
                "Fourni avec garniture d'étanchéité pour prévenir tout suintement autour de la tige."
            ];
            $applications = "Fixation de toitures sur pannes en bois dur ou semi-dur (Iroko, Ayous, Bilinga, etc.).";
            $pose         = "Serrage modéré à la clé sans forcer pour ne pas foirer le taraudage dans le bois. Associer impérativement un cavalier.";
        } elseif ( preg_match( '/cavalier/iu', $title ) ) {
            $is_prelaque = preg_match( '/pr[eé]laqu/iu', $title );
            $category    = 'Accessoires de Fixation & Répartition de Charge';
            $material    = $is_prelaque ? 'Aluminium Embouti Prélaqué Polyester Cuit au Four' : 'Aluminium Pur Embouti Haute Résistance Inoxydable';
            $profil      = 'Forme trapézoïdale épousant le profil exact de l\'onde de tôle';
            $epaisseur   = '1,0 mm à 1,2 mm';
            $finition    = $is_prelaque ? 'Prélaquage Teintes RAL Coordonnées' : 'Aluminium Brut Naturel';
            $longueurs   = 'Boîtes distributrices scellées de 100 pièces';
            $description = "Les cavaliers en aluminium sont des pièces indispensables de la fixation de toiture sur sommet d'onde. Conçus pour épouser exactement la forme de la tôle, ils répartissent la pression de serrage sur une grande surface, évitant l'écrasement de la tôle tout en renforçant la résistance à l'arrachement sous vents violents.";
            $avantages   = [
                "Répartition optimale de la force de serrage sans écraser les nervures de la tôle.",
                "100% Inoxydable en aluminium pur, éliminant tout risque de corrosion galvanique.",
                "Renforce considérablement la résistance au vent et aux tempêtes (anti-arrachement).",
                "Assure une assise rigide et stable pour les rondelles d'étanchéité bitumées."
            ];
            $applications = "Pose de tôles bacs 4N, 5N et Tuiles D50 sur charpentes bois ou métalliques.";
            $pose         = "Positionner le cavalier au sommet de chaque nervure fixée, intercaler la plaquette d'étanchéité et insérer la vis au centre.";
        } elseif ( preg_match( '/toiturole/iu', $title ) ) {
            $category    = 'Étanchéité Bitumineuse Lourde & Chéneaux';
            $material    = 'Armature composite haute résistance imprégnée de bitume élastomère pur';
            $profil      = 'Rouleau continu de membrane souple auto-protégée 900G';
            $epaisseur   = 'Épaisseur lourde armée certifiée 900 g/m²';
            $finition    = 'Surface bitumée hydrofuge haute imperméabilité';
            $longueurs   = 'Rouleau de 10 mètres linéaires (Largeur 1,00 m)';
            $description = "La Toiturole 900G est une membrane d'étanchéité bitumineuse lourde prête à l'emploi conçue pour assurer l'imperméabilité absolue des toitures, sous-toitures, chéneaux maçonnés, solins et noues. Elle crée une barrière hermétique infranchissable contre l'eau sous climat tropical.";
            $avantages   = [
                "Imperméabilité absolue sous forte colonne d'eau et pluie continue.",
                "Armature interne résistante aux déchirures mécaniques et aux micro-mouvements.",
                "Excellente résistance au vieillissement thermique et aux rayons UV solaires.",
                "Facilité de mise en œuvre à froid ou à chaud pour joints parfaits."
            ];
            $applications = "Étanchéité de toitures-terrasses, chéneaux en béton, sous-toitures, solins et réparations.";
            $pose         = "Pose par marouflage avec colle bitumineuse ou soudage à la flamme, recouvrement des lés de 10 cm minimum.";
        } elseif ( preg_match( '/tige/iu', $title ) ) {
            $category    = 'Tiges Filetées de Serrage & Tirants Métalliques';
            $material    = 'Acier Doux Galvanisé / Zingué au Pas Métrique';
            $profil      = 'Filetage continu métrique régulier';
            $epaisseur   = 'Diamètre Ø 6,0 mm (Filetage M6)';
            $finition    = 'Traitement zingué anticorrosion';
            $longueurs   = 'Longueur standard calibrée de 300 mm (0,30 m)';
            $description = "Tiges filetées M6 de 300 mm conçues pour les fixations traversantes sur charpentes épaisses, le tirant de pannes et l'assemblage de profilés métalliques nécessitant un serrage par écrou-rondelle ajustable.";
            $avantages   = [
                "Filetage continu permettant un réglage millimétré du serrage sur toute la longueur.",
                "Acier résistant à la traction et au cisaillement.",
                "Traitement zingué protégeant la tige contre la rouille en milieu humide.",
                "Découpable à la scie à métaux à la longueur désirée sur le chantier."
            ];
            $applications = "Assemblages de charpente, fixations de profilés traversants et tirants de toiture.";
            $pose         = "Mise en place à travers les pièces percées, serrage avec deux écrous M6 et rondelles larges.";
        } else {
            // Feutres / Rondelles / Plaquettes
            $category    = 'Joints & Éléments d\'Étanchéité Compressibles';
            $material    = 'Feutre naturel dense imprégné à cœur de bitume élastomère pur';
            $profil      = 'Rondelle ou plaquette découpée calibrée pour vis et tirefonds';
            $epaisseur   = '2,5 mm à 3,0 mm';
            $finition    = 'Feutre bitumineux souple haute compressibilité';
            $longueurs   = 'Boîtes distributrices scellées de 100 pièces';
            $description = "Les rondelles et plaquettes en feutre bitumé constituent la barrière d'étanchéité maîtresse entre la fixation et la tôle. Sous l'effet du serrage, le bitume flue légèrement pour obturer hermétiquement le trou de perçage et combler toute micro-irrégularité, empêchant toute infiltration d'eau.";
            $avantages   = [
                "Étanchéité auto-obturante sous la pression de serrage.",
                "Amortit les vibrations sonores et absorbe les micros-dilatations thermiques de la tôle.",
                "Résistance exceptionnelle aux températures élevées sous toiture tropicale (> 80°C).",
                "Conserve son élasticité et son imperméabilité pendant des décennies."
            ];
            $applications = "Sous tête de tirefonds, vis et cavaliers sur toitures métalliques.";
            $pose         = "Intercaler entre le cavalier et la tôle ou sous la tête de vis avant le serrage définitif.";
        }
    }
    // 4. ACCESSOIRES INTÉRIEURS (CARRELAGE, DOUCHES, ÉPONGES)
    else {
        $pole = 'Pôle 4 : Accessoires Intérieurs, Carrelage & Sanitaire';
        if ( preg_match( '/douche/iu', $title ) ) {
            $category    = 'Équipements Sanitaires & Balnéothérapie';
            $material    = 'Corps thermoplastique haute isolation & Résistance blindée cuivre/inox';
            $profil      = 'Diffuseur multijets orientable avec régulateur thermique électronique';
            $epaisseur   = 'Alimentation 220V standard (Puissance 5500W - 7500W)';
            $finition    = 'Blanc Sanitaire Brillant & Finition Chrome Haut Standing';
            $longueurs   = 'Ensemble complet avec flexible, bras mural et inverseur';
            $description = "Les douches thérapeutiques distribuées par TPM SA offrent un confort balnéaire exceptionnel et un soulagement musculaire immédiat grâce à leur système de chauffe instantané et leurs jets d'eau relaxants. Équipées d'une résistance blindée de haute sécurité et d'un contrôle thermique millimétré, elles assurent une eau à température parfaite tout en optimisant la consommation d'eau et d'électricité.";
            $avantages   = [
                "Chauffe instantanée continue : eau chaude immédiate à volonté sans préchauffage.",
                "Sécurité électrique absolue certifiée : double mise à la terre et chambre étanche isolée.",
                "Jets thérapeutiques multizones tonifiants stimulant la circulation sanguine.",
                "Corps thermoplastique insensible au calcaire et aux variations de pression d'eau."
            ];
            $applications = "Salles de bains résidentielles, villas, hôtels de prestige, centres sportifs et cliniques.";
            $pose         = "Raccordement hydraulique 1/2 pouce standard et alimentation électrique 220V directe sur disjoncteur différentiel dédié (32A).";
        } elseif ( preg_match( '/[eé]ponge/iu', $title ) ) {
            $category    = 'Quincaillerie & Abrasifs Métalliques Industriels';
            $material    = 'Fils d\'acier inoxydable pur qualité marine AISI 430/304';
            $profil      = 'Spirale métallique continue souple et indémaillable';
            $epaisseur   = 'Fil d\'acier calibré ultra-résistant';
            $finition    = 'Acier inoxydable brillant inaltérable';
            $longueurs   = preg_match( '/25/iu', $title ) ? 'Sachet scellé de 25 pièces usine' : 'Sachet scellé de 20 pièces usine';
            $description = "Éponges métalliques en acier inoxydable haute performance fabriquées pour le décapage intensif, le récurage des métaux et le nettoyage industriel lourd. Leur maillage spécial élimine les résidus les plus tenaces sans rouiller ni se défaire, conservant leur élasticité et leur pouvoir abrasif dans le temps.";
            $avantages   = [
                "100% Inoxydable : ne rouille jamais, même immergée en milieu salin ou humide.",
                "Longue durée de vie : maille robuste résistant à l'usure et à l'effilochage.",
                "Efficacité redoutable sur les surfaces métalliques, marmites et chaudronnerie.",
                "Conditionnement économique en sachets usine sous blister scellé."
            ];
            $applications = "Nettoyage de chantiers, ateliers métallurgiques, cuisines collectives et entretien domestique.";
            $pose         = "Utilisation directe avec eau et détergent ou solvants de nettoyage courants.";
        } else {
            // Carrelage
            preg_match( '/\d+[Xx]\d+/', $title, $m );
            $dim = ! empty( $m[0] ) ? $m[0] . ' cm' : '60x60 cm';
            $category    = 'Grès Cérame Certifié / Revêtement Sol & Mur Intérieur/Extérieur';
            $material    = 'Grès Cérame Haute Densité (Pleine masse émaillée 1er Choix Certifié)';
            $profil      = "Format calibré {$dim} (Bords rectifiés 90° autorisant des joints fins)";
            $epaisseur   = '8,5 mm à 10,5 mm selon format';
            $finition    = 'Émaillé Haute Résistance (Finition Brillante Polie, Satinée ou Mate Antidérapante)';
            $longueurs   = "Conditionnement au carton usine scellé";
            $description = "Carrelage en grès cérame de premier choix sélectionné par TPM SA pour ses qualités mécaniques supérieures et son esthétique irréprochable. Sa porosité quasi-nulle (absorption d'eau E < 0,1%) et sa haute résistance au poinçonnement en font le revêtement idéal pour sublimer les intérieurs et extérieurs sous climat équatorial.";
            $avantages   = [
                "Absorption d'eau minimale (Groupe BIa) : totalement insensible à l'humidité et aux moisissures.",
                "Haute résistance à l'abrasion (PEI IV/V) pour usage résidentiel et commercial intense.",
                "Surface vitrifiée anti-taches facile à nettoyer et inerte aux détergents et solvants.",
                "Stabilité absolue des couleurs et nuances inaltérables sous l'ensoleillement tropical."
            ];
            $applications = "Salons, séjours, cuisines, salles d'eau, terrasses, boutiques et halls d'accueil.";
            $pose         = "Pose collée au mortier-colle C2TE sur chape ciment nivelée et sèche, avec joints hydrofuges de 2 mm.";
        }
    }

    return [
        'ref'          => $ref,
        'title'        => $title,
        'designation'  => $designation,
        'category'     => $category,
        'pole'         => $pole,
        'material'     => $material,
        'profil'       => $profil,
        'epaisseur'    => $epaisseur,
        'finition'     => $finition,
        'longueurs'    => $longueurs,
        'description'  => $description,
        'avantages'    => $avantages,
        'applications' => $applications,
        'pose'         => $pose,
        'unit'         => $unit,
        'stock'        => 'Disponible en Stock Permanent (Usines Bekoko & Douala PK12)',
        'norme'        => 'Norme Camerounaise (NC) & ISO 9001:2015 • Garantie de Durabilité'
    ];
}
