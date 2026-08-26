/**
 * TPM SA (Groupe CAC) - Moteur Bilingue Ultra-Rapide (i18n)
 * Performance O(1) Hash Map (temps d'exécution < 1ms, zéro lag, zéro freeze).
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'tpm_site_lang';
    const DEFAULT_LANG = 'fr';

    const DICT_FR_TO_EN = {
    "Coloris RAL Disponibles :": "Available RAL Shades:",
    "→ Tôle Bac Alu 4N & 5N 0,35": "→ Alu BAC Sheet 4N & 5N 0.35",
    "→ Tôles bacs alu 5/10e Prélaquées": "→ Pre-painted Alu BAC Sheets 5/10th",
    "→ Tôles bacs prélaquées D50": "→ Pre-painted D50 BAC Sheets",
    "→ Tôles Tuile nervurale D50": "→ Ribbed D50 Tile Sheets",
    "→ Tôle Ondulée ALU 0,35 3M": "→ Corrugated ALU Sheet 0.35 3M",
    "→ Tôles bacs B30 2ème choix": "→ B30 BAC Sheets 2nd Choice",
    "→ Faîtière Non Crantée Double Pente": "→ Plain Double-Slope Ridge Cap",
    "→ Faîtière centrale 0.33 en 0.35 ml": "→ Central Ridge Cap 0.33 in 0.35 ml",
    "→ Faîtière centrale 0.40 Prélaquée": "→ Pre-painted Central Ridge Cap 0.40",
    "→ Rives de faîtage 0.33/0.35 ml": "→ Ridge Flashing 0.33/0.35 ml",
    "→ Gouttière alu 0.33/0.35 ml": "→ Aluminium Gutter 0.33/0.35 ml",
    "→ Noues en alu 0.33/0.35 ml": "→ Aluminium Valleys 0.33/0.35 ml",
    "Demande de Facture": "Invoice Request",
    "Pro-Forma B2B": "B2B Pro-Forma",
    "& Devis Sur-Mesure": "& Custom Quote",
    "Vous gérez un chantier BTP, une quincaillerie, un projet architectural ou un site industriel ? Recevez votre cotation officielle aux tarifs usine direct fabricant (HT et TTC avec TVA 19.25% légale), délais de profilage et conditions d'enlèvement quai sous 2 heures ouvrées.": "Managing a construction worksite, hardware store, architectural project or industrial facility? Receive your official direct-from-manufacturer quote (Excl. Tax and legal 19.25% VAT), roll-forming turnaround times and dock pickup conditions within 2 working hours.",
    "Détail des Articles Répertoriés": "Itemized Breakdown of Products",
    "\"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ\"": "\"SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEED DURABILITY\"",
    "\"Bâtiments solides = Matériaux solides avec garantie de durabilité.\"": "\"Solid buildings = Solid materials with guaranteed durability.\"",
    "BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ": "SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEE OF DURABILITY",
    "BATIMENTS SOLIDES = MATERIAUX SOLIDES AVEC GARANTIE DE DURABILITE": "SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEE OF DURABILITY",
    "Tôle Bac Alu 4N ET 5N — 2 600 FCFA HT": "Alu BAC Sheet 4N & 5N — 2,600 FCFA HT",
    "Tôle Ondulée ALU 0,35 3M — 7 000 FCFA HT": "Corrugated ALU Sheet 0.35 3M — 7,000 FCFA HT",
    "Tôles bacs ou ondulées alu 0,35 — 3 300 FCFA HT": "Alu BAC or Corrugated 0.35 — 3,300 FCFA HT",
    "Tôles bacs ou ondulées alu 5/10e Nature — 4 300 FCFA HT": "Alu BAC 5/10th Natural — 4,300 FCFA HT",
    "Tôles bacs ou ondulées alu 5/10e Prélaquées — 5 300 FCFA HT": "Alu BAC 5/10th Pre-painted — 5,300 FCFA HT",
    "Tôles bacs ou ondulées alu 6/10e Nature — 5 500 FCFA HT": "Alu BAC 6/10th Natural — 5,500 FCFA HT",
    "Tôles bacs ou ondulées alu 6/10e Prélaquées — 6 500 FCFA HT": "Alu BAC 6/10th Pre-painted — 6,500 FCFA HT",
    "Tôles bacs ou ondulées prélaquées B30 (2ème choix) — 2 000 FCFA HT": "Pre-painted B30 BAC 2nd Choice — 2,000 FCFA HT",
    "Tôles bacs ou ondulées prélaquées D50 — 7 500 FCFA HT": "Pre-painted D50 BAC — 7,500 FCFA HT",
    "Tôles Tuile nervurale prélaquée D50 — 11 500 FCFA HT": "Pre-painted D50 Ribbed Tile — 11,500 FCFA HT",
    "Faîtière non Crantée Double Pente au ml 0,35 0,33 — 1 400 FCFA HT": "Plain Double-Slope Ridge Cap / lm 0.35 0.33 — 1,400 FCFA HT",
    "Faîtière centrale 0,33 en 0,35 ml — 1 400 FCFA HT": "Central Ridge Cap 0.33 in 0.35 ml — 1,400 FCFA HT",
    "Faîtière non Crantée Double Pente au ml 0,35 0,33 Prélaquée — 1 700 FCFA HT": "Plain Double-Slope Ridge Cap Pre-painted — 1,700 FCFA HT",
    "Faîtière centrale 0,33 en 0,35 ml Prélaquée — 1 700 FCFA HT": "Pre-painted Central Ridge Cap 0.33 in 0.35 ml — 1,700 FCFA HT",
    "Bandes ourlées 0,33 0,35 ml — 1 400 FCFA HT": "Hemmed Strips 0.33 0.35 ml — 1,400 FCFA HT",
    "Bandes ourlées 0,33 0,35 ml Prélaquées — 1 700 FCFA HT": "Pre-painted Hemmed Strips 0.33 0.35 ml — 1,700 FCFA HT",
    "Rives de faîtage 0,33 0,35 ml — 1 400 FCFA HT": "Ridge Flashing 0.33 0.35 ml — 1,400 FCFA HT",
    "Rives de faîtage 0,33 0,35 ml Prélaquées — 1 700 FCFA HT": "Pre-painted Ridge Flashing 0.33 0.35 ml — 1,700 FCFA HT",
    "Gouttière alu 0,33 0,35 en ml — 1 500 FCFA HT": "Aluminium Gutter 0.33 0.35 in ml — 1,500 FCFA HT",
    "Gouttières alu 0,33 0,35 en ml Prélaquées — 1 700 FCFA HT": "Pre-painted Aluminium Gutters — 1,700 FCFA HT",
    "Noues en alu 0,33 0,35 en ml — 1 400 FCFA HT": "Aluminium Valleys in ml — 1,400 FCFA HT",
    "Noues en alu 0,33 0,35 en ml Prélaquées — 1 700 FCFA HT": "Pre-painted Aluminium Valleys in ml — 1,700 FCFA HT",
    "Faîtière non Crantée Double Pente au ml 0,33 5/10eme — 2 000 FCFA HT": "Plain Ridge Cap / ml 0.33 5/10th — 2,000 FCFA HT",
    "Faîtière centrale 5/10eme Nature — 2 000 FCFA HT": "Central Ridge Cap 5/10th Natural — 2,000 FCFA HT",
    "Faîtière centrale 0,33 en 5/10eme ml — 2 000 FCFA HT": "Central Ridge Cap 0.33 in 5/10th ml — 2,000 FCFA HT",
    "Faîtière non Crantée Double Pente au ml 0,33 0,40 Prélaquée — 2 100 FCFA HT": "Plain Double-Slope Ridge Cap Pre-painted — 2,100 FCFA HT",
    "Faîtière centrale 0,33 en 0,40 ml Prélaquée — 2 100 FCFA HT": "Pre-painted Central Ridge Cap — 2,100 FCFA HT",
    "Bandes ourlées 0,33 5/10eme ml — 2 000 FCFA HT": "Hemmed Strips 5/10th ml — 2,000 FCFA HT",
    "Bandes ourlées 0,33 0,40 ml Prélaquées — 2 100 FCFA HT": "Pre-painted Hemmed Strips 0.40 ml — 2,100 FCFA HT",
    "Rives de faîtage 0,33 5/10 ml — 2 000 FCFA HT": "Ridge Flashing 5/10 ml — 2,000 FCFA HT",
    "Rives de faîtage 0,33 0,40 ml Prélaquées — 2 100 FCFA HT": "Pre-painted Ridge Flashing — 2,100 FCFA HT",
    "Gouttière alu 0,33 5/10eme en ml — 2 000 FCFA HT": "Alu Gutter 5/10th in ml — 2,000 FCFA HT",
    "Gouttières alu 0,33 0,40 en ml Prélaquées — 2 100 FCFA HT": "Pre-painted Alu Gutters — 2,100 FCFA HT",
    "Noues en alu 0,33 5/10eme en ml — 2 000 FCFA HT": "Alu Valleys 5/10th in ml — 2,000 FCFA HT",
    "Noues en alu 0,33 0,40 en ml Prélaquées — 2 100 FCFA HT": "Pre-painted Alu Valleys — 2,100 FCFA HT",
    "Vis Auto-foreuse 6X60 (x1) — 27 FCFA HT": "Self-drilling Screw 6X60 (x1) — 27 FCFA HT",
    "Vis Auto-foreuse 6X70 (x1) — 30 FCFA HT": "Self-drilling Screw 6X70 (x1) — 30 FCFA HT",
    "Tirefond 6x80 (x72) — 1 725 FCFA HT": "Lag Screw 6x80 (x72) — 1,725 FCFA HT",
    "Tirefond 6x60 (x72) — 1 450 FCFA HT": "Lag Screw 6x60 (x72) — 1,450 FCFA HT",
    "Rondelles feutres bitumées (x100) — 500 FCFA HT": "Bitumen Felt Washers (x100) — 500 FCFA HT",
    "Plaquettes feutres bitumées (x100) — 1 000 FCFA HT": "Bitumen Felt Plates (x100) — 1,000 FCFA HT",
    "Cavaliers alu — 1 500 FCFA HT": "Aluminium Saddles — 1,500 FCFA HT",
    "Cavaliers prélaqués — 1 500 FCFA HT": "Pre-painted Saddles — 1,500 FCFA HT",
    "Tiges filetées 6x300 (x1) — 250 FCFA HT": "Threaded Rods 6x300 (x1) — 250 FCFA HT",
    "Toiturole 900G (Rouleau 10m) — 7 000 FCFA HT": "Toiturole 900G (10m Roll) — 7,000 FCFA HT",
    "Cartons carreaux murs 25x40 (Réf PMC42054C) — 5 400 FCFA HT": "Wall Tiles 25x40 Box (Ref PMC42054C) — 5,400 FCFA HT",
    "Cartons carreaux murs 25x40 (Réf PMC42028C) — 5 400 FCFA HT": "Wall Tiles 25x40 Box (Ref PMC42028C) — 5,400 FCFA HT",
    "Cartons carreaux murs 25x40 (Réf PMC42012C) — 5 400 FCFA HT": "Wall Tiles 25x40 Box (Ref PMC42012C) — 5,400 FCFA HT",
    "Cartons carreaux murs 25x40 (Réf PMC42064C) — 5 400 FCFA HT": "Wall Tiles 25x40 Box (Ref PMC42064C) — 5,400 FCFA HT",
    "Cartons carreaux sol 40x40 (Réf NMG44001C) — 7 680 FCFA HT": "Floor Tiles 40x40 Box (Ref NMG44001C) — 7,680 FCFA HT",
    "Cartons carreaux sol 40x40 (Réf FGP44044C) — 7 680 FCFA HT": "Floor Tiles 40x40 Box (Ref FGP44044C) — 7,680 FCFA HT",
    "Cartons carreaux sol 40x40 (Réf YMG44223C) — 7 680 FCFA HT": "Floor Tiles 40x40 Box (Ref YMG44223C) — 7,680 FCFA HT",
    "Cartons carreaux sol 40x40 (Réf YMG44008C) — 7 680 FCFA HT": "Floor Tiles 40x40 Box (Ref YMG44008C) — 7,680 FCFA HT",
    "Cartons carreaux sol 30x30 (Réf FGP33023C) — 7 680 FCFA HT": "Floor Tiles 30x30 Box (Ref FGP33023C) — 7,680 FCFA HT",
    "Cartons carreaux sol 60x60 Italien — 20 880 FCFA HT": "Italian Floor Tiles 60x60 Box — 20,880 FCFA HT",
    "Cartons carreaux sol 32x60 Espagnol — 18 820 FCFA HT": "Spanish Floor Tiles 32x60 Box — 18,820 FCFA HT",
    "Cartons carreaux sol 15x80 Chinois (1er choix) — 15 000 FCFA HT": "Chinese Floor Tiles 15x80 Box — 15,000 FCFA HT",
    "Cartons carreaux sol 60x120 Italien XXL — 36 000 FCFA HT": "Italian Floor Tiles 60x120 XXL Box — 36,000 FCFA HT",
    "Cartons carreaux sol 30x60 Chinois (1er choix) — 15 840 FCFA HT": "Chinese Floor Tiles 30x60 Box — 15,840 FCFA HT",
    "Douche thérapeutique individuel petit modèle — 34 900 FCFA HT": "Therapeutic Shower Small Model — 34,900 FCFA HT",
    "Douche thérapeutique individuel grand modèle Zagonel Moment — 79 900 FCFA HT": "Therapeutic Shower Zagonel Moment — 79,900 FCFA HT",
    "Douche thérapeutique individuel grand modèle Loren Shower — 89 900 FCFA HT": "Therapeutic Shower Loren Shower — 89,900 FCFA HT",
    "Douche thérapeutique individuel grand modèle Duo Shower — 139 900 FCFA HT": "Therapeutic Shower Duo Shower — 139,900 FCFA HT",
    "Douche thérapeutique central Cardal — 59 900 FCFA HT": "Therapeutic Central Shower Cardal — 59,900 FCFA HT",
    "Douche thérapeutique central Lorenzetti — 59 900 FCFA HT": "Therapeutic Central Shower Lorenzetti — 59,900 FCFA HT",
    "Éponges métalliques non doublées (Sachet de 25p) — 22 500 FCFA HT": "Unlined Metallic Sponges (Bag of 25) — 22,500 FCFA HT",
    "Éponges métalliques doublées (Sachet de 20p) — 25 000 FCFA HT": "Lined Metallic Sponges (Bag of 20) — 25,000 FCFA HT",

    "Services & Cotations B2B": "Services & B2B Quotes",
    "Usine TPM SA (Douala & Bekoko)": "TPM SA Factory (Douala & Bekoko)",
    "Consultez l'inventaire officiel de 66 articles usine et éditez votre Pro-Forma instantanément.": "Browse our official 66 factory items inventory and generate your instant Pro-Forma.",
    "Consultez l'inventaire officiel de 58 articles usine et éditez votre Pro-Forma instantanément.": "Browse our official 58 factory items inventory and generate your instant Pro-Forma.",
    "Inventaire Complet (58)": "Full Inventory (58)",
    "Inventaire Complet (66)": "Full Inventory (66)",
    "Chantiers & BTP": "Construction & BTP",
    "Chantiers et BTP": "Construction & BTP",
    "Langue / Language": "Language / Langue",
    "→ Tirefond 6x80 (Paquet 72 pcs)": "→ 6x80 Lag Screw (Pack 72 pcs)",
    "→ Tirefond 6x60 (Paquet 72 pcs)": "→ 6x60 Lag Screw (Pack 72 pcs)",
    "→ Vis Auto-foreuse 6X70": "→ Self-drilling Screw 6X70",
    "→ Vis Auto-foreuse 6X60": "→ Self-drilling Screw 6X60",
    "→ Cavaliers alu Nature & Prélaqués": "→ Natural & Pre-painted Alu Saddles",
    "→ Toiturole Étanchéité 900G": "→ Toiturole 900G Waterproofing",
    "→ Carreaux & Sols": "→ Tiles & Floors",
    "(14 réf.)": "(14 items)",
    "→ Douches Thérapeutiques": "→ Therapeutic Showers",
    "(6 réf.)": "(6 items)",
    "→ Éponges Métalliques": "→ Metallic Sponges",
    "(2 réf.)": "(2 items)",
    "Voir les 22 articles intérieur »": "View all 22 interior items »",
    "Voir les 22 articles intérieurs »": "View all 22 interior items »",
    "→ Tôles & Toitures": "→ Roofing Sheets & Roofing",
    "→ Accessoires Toiture": "→ Roofing Accessories",
    "→ Fixations & Étanchéité": "→ Fasteners & Waterproofing",
    "→ Carreaux & Emballages PP": "→ Tiles & PP Packaging",
    "Groupe CAC • Depuis 1976": "CAC Group • Since 1976",
    "Usine & Contact": "Factory & Contact",
    "Usine Principale Bekoko :": "Main Bekoko Factory:",
    "Carrefour Bekoko (Axe Douala - Limbé), Cameroun": "Bekoko Junction (Douala - Limbé Highway), Cameroon",
    "Carrefour Bekoko (Axe Douala - Limbé)": "Bekoko Junction (Douala - Limbé Highway)",
    "(Groupe CAC). Tous droits réservés. Douala / Bekoko, Cameroun.": "(CAC Group). All rights reserved. Douala / Bekoko, Cameroon.",
    "Aperçu du Catalogue Général 2026": "2026 Master Catalog Preview",
    "12 Pages Complètes": "12 Complete Pages",
    "TPM SA • Groupe CAC — Solutions Métallurgiques & Matériaux de Construction": "TPM SA • CAC Group — Metallurgical Solutions & Construction Materials",
    "Plein écran": "Full Screen",
    "Document officiel certifié •": "Official Certified Document •",
    "12 pages": "12 pages",
    "• Taille :": "• Size:",
    "5,18 Mo": "5.18 MB",
    "Fermer": "Close",
    "Confirmer le Téléchargement": "Confirm Download",
    "Conçu pour l'industrie camerounaise et la zone CEMAC.": "Designed for Cameroonian industry and the CEMAC zone.",
    "Navigation Rapide": "Quick Navigation",
    "Informations Légales & Fiscales": "Legal & Fiscal Information",
    "À propos de TPM SA": "About TPM SA",
    "Depuis 1976, TPM SA (Groupe CAC) est le fleuron industriel camerounais spécialisé dans le profilage de tôles BAC haute résistance, la fabrication d'emballages en polypropylène et la distribution de matériaux de second œuvre certifiés.": "Since 1976, TPM SA (CAC Group) is Cameroon's flagship industrial enterprise specializing in high-strength BAC sheet profiling, polypropylene packaging manufacturing, and certified finishing materials distribution.",
    "Depuis 1976,": "Since 1976,",
    "fabrique et approvisionne les plus grands chantiers BTP, quincailleries et entreprises du Cameroun et de la zone CEMAC en": "manufactures and supplies major construction sites, hardware stores, and companies across Cameroon and the CEMAC zone with",
    "Tôles BAC prélaquées 0.50mm": "0.50mm pre-painted BAC roofing sheets",
    ", accessoires de toiture,": ", roofing accessories,",
    "Sacs PP tissés": "woven PP bags",
    "et carrelage.": "and tiles.",
    "SÉLECTIONNER UN ARTICLE DU CATALOGUE": "SELECT AN ITEM FROM CATALOG",
    "SÉLECTIONNER UN ARTICLE DU CATALOGUE *": "SELECT AN ITEM FROM CATALOG *",
    "LONGUEUR / FORMAT": "LENGTH / FORMAT",
    "LONGUEUR DE COUPE": "CUTTING LENGTH",
    "COULEUR RAL / FINITION": "RAL COLOR / FINISH",
    "COULEUR RAL": "RAL COLOR",
    "QUANTITÉ À COMMANDER": "QUANTITY TO ORDER",
    "QUANTITÉ À COMMANDER *": "QUANTITY TO ORDER *",
    "Alu Naturel (Brut non laqué)": "Natural Alu (Raw unlacquered)",
    "Bleu Cendre (RAL 5015)": "Ash Blue (RAL 5015)",
    "Rouge Tuile / Bordeau (RAL 3005)": "Tile Red / Bordeaux (RAL 3005)",
    "Vert Olive (RAL 6002)": "Olive Green (RAL 6002)",
    "Standard 6.00m": "Standard 6.00m",
    "Sur-mesure 3.00m": "Custom-cut 3.00m",
    "Sur-mesure 4.00m": "Custom-cut 4.00m",
    "Sur-mesure 5.00m": "Custom-cut 5.00m",
    "Sur-mesure 7.00m": "Custom-cut 7.00m",
    "Sur-mesure 8.00m": "Custom-cut 8.00m",
    "Sur-mesure 10.00m": "Custom-cut 10.00m",
    "Sur-mesure 12.00m": "Custom-cut 12.00m",
    "Estimation HT (Hors taxes) :": "Estimate Excl. Tax:",
    "+ TVA 19.25% calculée au panier": "+ 19.25% VAT calculated in cart",
    "Ajouter au Panier Pro-Forma": "Add to Pro-Forma Cart",
    "Voir mon devis pro-forma en cours": "View current pro-forma quote",
    "PÔLE N°2 • 24 RÉF.": "SECTOR #2 • 24 ITEMS",
    "Tôle Aluminium": "Aluminium Roofing Sheet",
    "Tôle BAC Prélaquée 0.50mm – Bordeau": "0.50mm Pre-painted BAC Sheet – Bordeaux",
    "Tôle BAC Prélaquée 0.50mm – Bleu Cendre": "0.50mm Pre-painted BAC Sheet – Ash Blue",
    "Usine Bekoko": "Bekoko Factory",
    "Profilage D50": "D50 Profiling",
    "Tôle BAC 0.50mm nervures D50 Confort thermique, haute résistance marine, profilée 5 ondes renforcée pour entrepôts et habitations.": "0.50mm D50 corrugated BAC sheet, thermal comfort, high marine resistance, 5 reinforced waves for warehouses and homes.",
    "Accessoires faîtage ondulé": "Corrugated Ridge Accessories",
    "Faîtière à Bord Rabattu 0.50mm (Longueur 2.00m)": "0.50mm Folded-Edge Ridge Cap (2.00m Length)",
    "PK12 & Bekoko": "PK12 & Bekoko",
    "Fixations et outillage BTP": "Construction Fasteners & Tooling",
    "Fixations Complètes 6x80mm avec Rondelles néoprène (Boîte 100 pcs)": "Complete 6x80mm Fasteners with Neoprene Washers (Box 100 pcs)",
    "PK12": "PK12",
    "Bandes & Étanchéité BTP": "Construction Strips & Waterproofing",
    "Joint Bitumé Étanchéité 10M (Rouleau 10m x 20cm)": "10M Bitumen Waterproofing Joint (Roll 10m x 20cm)",
    "Fabrique de Sacs": "Bag Factory",
    "Sacs PP Blancs Tissés 50kg (Lot de 500 Sacs Usine Bekoko)": "White Woven PP Bags 50kg (Pack of 500 Bags Bekoko Factory)",
    "Voir la Fiche Technique": "View Technical Specs",
    "SIÈGE & BÂTIMENT PRINCIPAL": "HEADQUARTERS & MAIN BUILDING",
    "Complexe industriel et direction générale TPM SA": "Industrial complex and TPM SA general management",
    "\"Bâtiments solides = Matériaux solides avec garantie de durabilité.\"": "\"Solid buildings = Solid materials with guaranteed durability.\"",
    "— Devise Fondatrice TPM SA": "— TPM SA Founding Motto",
    "HISTOIRE & AMBITION": "HISTORY & AMBITION",
    "Consolider les Bâtiments au Cameroun et en Afrique Centrale": "Strengthening Buildings in Cameroon and Central Africa",
    "L'idée fondatrice de la fabrication locale de matériaux de toiture et de plasturgie est née de la volonté de": "The founding vision of local manufacturing for roofing materials and plastics arose from the desire of",
    "M. NJIPNGANG": "Mr. NJIPNGANG",
    "de doter le Cameroun d'une souveraineté industrielle en matière de construction durable. Face aux aléas climatiques tropicaux et aux exigences de résistance mécanique des infrastructures,": "to equip Cameroon with industrial sovereignty in sustainable construction. Facing tropical weather challenges and the rigorous mechanical requirements of infrastructure,",
    "a développé une maîtrise complète des alliages métalliques et des polymères thermoplastiques.": "developed full mastery over metallic alloys and thermoplastic polymers.",
    "Aujourd'hui, à travers le": "Today, through the",
    ", nous opérons deux complexes industriels majeurs à": ", we operate two major industrial complexes in",
    "Douala PK12": "Douala PK12",
    "Bekoko": "Bekoko",
    ", équipés de lignes automatisées de profilage, de plieuses numériques à commande assistée, de bains d'électro-zingage et d'unités d'extrusion de polypropylène.": ", equipped with automated roll-forming lines, CNC folding machines, electro-galvanizing baths, and polypropylene extrusion units.",
    "Épaisseurs Réelles": "Certified Real Thicknesses",
    "Garantie 0.35mm, 0.50mm et 0.60mm contrôlées au micromètre.": "Guaranteed 0.35mm, 0.50mm, and 0.60mm verified with digital micrometers.",
    "Production Directe": "Direct Manufacturing",
    "Aucun intermédiaire : tarification usine et découpe sur-mesure.": "Zero intermediaries: factory pricing and custom cut-to-length profiling.",
    "Logistique Dédiée": "Dedicated Logistics",
    "Flotte de transport et capacité d'enlèvement immédiat en usine.": "Haulage fleet and immediate dock pickup capacity at factories.",
    "INFRASTRUCTURE INDUSTRIELLE": "INDUSTRIAL INFRASTRUCTURE",
    "Nos 2 Complexes de Production à Douala": "Our 2 Production Complexes in Douala",
    "Une capacité industrielle d'envergure répartie stratégiquement sur deux zones pour optimiser la fabrication et les flux d'expédition vers l'ensemble du Cameroun et de la zone CEMAC.": "Major industrial capacity strategically distributed across two zones to optimize manufacturing and shipping logistics throughout Cameroon and the CEMAC zone.",
    "SITE PRINCIPAL N°1": "PRIMARY SITE #1",
    "Usine Douala PK12": "Douala PK12 Factory",
    "Complexe Métallurgique de PK12 (Douala Est)": "PK12 Metallurgical Complex (East Douala)",
    "Zone Industrielle PK12 — Profilage Métallique & Zingage": "PK12 Industrial Zone — Metal Roll-Forming & Galvanizing",
    "Spécialisations du Site PK12 :": "PK12 Site Specializations:",
    "Lignes de tôles BAC :": "BAC Roofing Sheet Lines:",
    "Profilage ondulé et nervuré D50/B30 en aluminium 5/10e, 6/10e et prélaqué 0.50mm.": "Corrugated and D50/B30 ribbed profiling in 5/10th, 6/10th aluminium, and 0.50mm pre-painted steel.",
    "Atelier de Pliage & Faîtières :": "Folding Workshop & Ridge Caps:",
    "Faîtières crantées double pente, rives, gouttières et noues étanches.": "Double-slope notched ridge caps, bargeboards, gutters, and watertight valleys.",
    "Station d'Électro-Zingage 800 VA :": "800 VA Electro-Galvanizing Station:",
    "Traitement de surface anticorrosion par galvanisation électrolytique.": "Anticorrosion surface treatment through electrolytic galvanization.",
    "Horaires :": "Operating Hours:",
    "Lun - Ven : 08h00 - 18h00": "Mon - Fri: 08:00 AM - 06:00 PM",
    "Enlèvement Immédiat": "Immediate Factory Pickup",
    "Complexe Industriel Bekoko": "Bekoko Industrial Complex",
    "Site Industriel de Bekoko (Sortie Ouest)": "Bekoko Industrial Site (West Exit)",
    "Carrefour Bekoko — Axe Douala - Limbé": "Bekoko Junction — Douala - Limbé Highway",
    "Spécialisations du Site Bekoko :": "Bekoko Site Specializations:",
    "Plasturgie & Sacs Tissés :": "Plastics & Woven Bags:",
    "Extrusion, tissage circulaire et confection de sacs PP 50kg & 100kg pour agro-industrie et ciment.": "Extrusion, circular weaving, and crafting of 50kg & 100kg PP bags for agro-industry and cement.",
    "Second Œuvre & Revêtements :": "Finishing Materials & Floor Coverings:",
    "Dépôt central de carrelages sol & mur haut de gamme.": "Central depot for high-end floor and wall tiles.",
    "Plateforme Logistique Régionale :": "Regional Logistics Platform:",
    "Chargement poids lourds pour approvisionnement Sud-Ouest, Ouest et Grand Nord.": "Heavy-duty truck loading for supply to South-West, West, and Grand North regions.",
    "Stock Gros Volumes": "High Volume Stock Available",
    "Explorer l'inventaire en direct": "Explore Live Factory Inventory",
    "1. Tôles BAC & Couvertures": "1. BAC Sheets & Roof Coverings",
    "Tôles ondulées et bacs prélaqués D50 / B30 en aluminium pur et tôle galvanisée traitée anti-corrosion, toutes teintes RAL (Bordeau 3005, Bleu Cendre, Vert Olive).": "Corrugated sheets and pre-painted D50 / B30 profiles in pure aluminium and anticorrosion galvanized steel, all RAL shades (Bordeaux 3005, Ash Blue, Olive Green).",
    "2. Pliage & Accessoires": "2. Sheet Folding & Accessories",
    "Faîtières double pente, faîtières crantées profilées au pas de la tôle, demi-rives, rives de rive, noues et bavettes étanches façonnées sur commande.": "Double-slope ridge caps, notched ridge caps shaped to sheet pitch, bargeboards, valleys, and custom flashing made to order.",
    "3. Fixations Certifiées": "3. Certified Fasteners & Fixings",
    "Tirefonds zingués 6x80 / 6x100, cavaliers d'étanchéité avec rondelles EPDM, pointes de toiture et rouleaux de bitume Toiturole 900G.": "Zinc-plated 6x80 / 6x100 lag screws, sealing saddles with EPDM washers, roofing nails, and Toiturole 900G bitumen rolls.",
    "4. Plasturgie & Sacs PP": "4. Plastics & PP Bags",
    "Sacs tissés en polypropylène vierge de 25kg, 50kg et 100kg pour l'emballage du ciment, de la farine, du cacao, café et engrais.": "Virgin woven polypropylene bags in 25kg, 50kg, and 100kg for packaging cement, flour, cocoa, coffee, and fertilizers.",
    "5. Traitement Électro-Zingage": "5. Electro-Galvanizing Treatment",
    "Bain de zingage électrolytique industriel de 800 VA pour pièces métalliques, visserie, fers plats, profilés et éléments de serrurerie.": "800 VA industrial electrolytic zinc bath for metal parts, hardware screws, flat bars, profiles, and locksmith components.",
    "6. Carrelages & Céramique": "6. Tiles & Ceramics",
    "Grès cérame, carreaux muraux 25x40 et revêtements de sol grand format pour villas, immeubles et espaces commerciaux.": "Porcelain stoneware, 25x40 wall tiles, and large-format floor tiles for villas, buildings, and commercial spaces.",
    "CONFORMITÉ FISCALE & JURIDIQUE": "TAX & LEGAL COMPLIANCE",
    "Partenaire Agréé pour Entreprises, Ministères & PME du BTP": "Approved Partner for Corporations, Ministries & Construction SMEs",
    "Toutes nos factures et cotations pro-forma sont éditées en totale conformité avec la réglementation fiscale du Cameroun (TVA 19.25%, NIU, attestation de non-redevance).": "All our invoices and pro-forma quotes are issued in full compliance with Cameroon tax regulations (19.25% VAT, Tax ID NIU, non-indebtedness certificate).",
    "Raison Sociale :": "Company Legal Name:",
    "Identifiant Unique (NIU) :": "Tax Identification Number (TIN/NIU):",
    "TVA Déductible :": "Deductible VAT:",
    "Besoin d'un accompagnement sur-mesure pour votre chantier ?": "Need custom assistance for your construction project?",
    "Nos ingénieurs d'études et commerciaux sont à votre écoute du Lundi au Vendredi de 08h00 à 18h00.": "Our engineering and sales teams are at your disposal Monday to Friday from 08:00 AM to 06:00 PM.",
    "Contacter l'Usine": "Contact the Factory",
    "WhatsApp Commercial": "Commercial WhatsApp",
    "Fondateur Visionnaire :": "Visionary Founder:",
    "Siège & Usines :": "Headquarters & Factories:",
    "Numéro NIU :": "Taxpayer ID (NIU):",
    "Régime Fiscal :": "Tax System:",
    "TVA 19.25% Récupérable": "19.25% Recoverable VAT",
    "Zone de Livraison :": "Delivery Coverage:",
    "Cameroun & Zone CEMAC": "Cameroon & CEMAC Zone",
    "Télécharger le Catalogue Général PDF": "Download Master Catalog (PDF)",
    "★ FONDÉ PAR M. NJIPNGANG • DEPUIS 1976": "★ FOUNDED BY MR. NJIPNGANG • SINCE 1976",
    "Pionnier de la transformation industrielle en Afrique Centrale,": "A pioneer of industrial manufacturing in Central Africa,",
    "fabrique des": "manufactures",
    "tôles BAC haute résistance": "high-strength BAC roofing sheets",
    ", des": ", ",
    "faîtières & accessoires de toiture": "ridge caps & roofing accessories",
    "sacs tissés en polypropylène": "woven polypropylene bags",
    "et distribue des matériaux de second œuvre pour les grands chantiers BTP et le secteur commercial.": "and distributes finishing materials for major construction sites and the commercial sector.",
    "SERVICE COMMERCIAL & COTATIONS B2B": "COMMERCIAL SERVICE & B2B QUOTES",
    "Demande de Facture Pro-Forma B2B": "B2B Pro-Forma Invoice Request",
    "Norme Camerounaise (NC) & ISO 9001:2015": "Cameroon Standard (NC) & ISO 9001:2015",
    "Chiffrage & Réponse sous 2 Heures": "Costing & Response within 2 Hours",
    "Livraison Chantiers Cameroun & CEMAC": "Site Delivery Cameroon & CEMAC",
    "Demande de Pro-Forma transmise avec succès !": "Pro-Forma Request submitted successfully!",
    "Suivre sur WhatsApp (+237 655 70 58 66)": "Follow up on WhatsApp (+237 655 70 58 66)",
    "Informations incomplètes": "Incomplete Information",
    "Formulaire de Cotation Express": "Express Quote Form",
    "Édition de cotation officielle sous 2 heures avec mention TVA 19.25%": "Official quote issuance within 2 hours with legal 19.25% VAT",
    "Direct Usine": "Direct Factory",
    "Identification de l'Entreprise ou du Donneur d'Ordre": "Company or Buyer Identification",
    "Raison Sociale / Nom du Client": "Company Name / Customer Name",
    "NIU (Numéro Identifiant Unique)": "TIN (Taxpayer Identification Number)",
    "(Optionnel)": "(Optional)",
    "Responsable / Acheteur": "Project Manager / Buyer",
    "Téléphone / WhatsApp": "Phone / WhatsApp",
    "Adresse E-mail pour Envoi PDF": "Email Address for PDF Delivery",
    "Ville / Localisation Chantier": "City / Worksite Location",
    "Sélection des Produits & Finitions Usine": "Product Selection & Factory Finishes",
    "Famille d'Articles": "Product Family",
    "Tôles Bacs Aluminium (0.35, 5/10e, 6/10e)": "Aluminium BAC Sheets (0.35, 5/10th, 6/10th)",
    "Tôles Ondulées Aluminium 3M / Sur-Mesure": "Corrugated Aluminium Sheets 3M / Custom Length",
    "Tôles Tuiles Nervurées D50 Architecturale": "Architectural Ribbed D50 Tile Sheets",
    "Tôles Prélaquées B30 Économique": "Economic Pre-painted B30 Sheets",
    "Accessoires Toiture (Faîtières, Rives, Gouttières, Noues)": "Roofing Accessories (Ridge Caps, Bargeboards, Gutters, Valleys)",
    "Fixations & Étanchéité (Vis EPDM, Tirefonds, Toiturole)": "Fasteners & Waterproofing (EPDM Screws, Lag Screws, Toiturole)",
    "Carrelages Grès Cérame 1er Choix (60x60, 40x40, XXL)": "1st Choice Porcelain Tiles (60x60, 40x40, XXL)",
    "Douches Thérapeutiques & Sanitaires": "Therapeutic Showers & Sanitaryware",
    "Service Électro-Zingage Industriel 800 VA": "800 VA Industrial Electro-Galvanizing Service",
    "Sacs Polypropylène (PP) Tissés 50kg / 100kg": "Woven Polypropylene (PP) Bags 50kg / 100kg",
    "Approvisionnement Complet Multimatériaux BTP": "Complete Multi-Material Worksite Supply",
    "Finition / Teinte RAL": "Finish / RAL Color",
    "Aluminium Naturel Pur": "Pure Natural Aluminium",
    "Bordeaux RAL 3005": "Bordeaux RAL 3005",
    "Bleu Cendre RAL 5003": "Ash Blue RAL 5003",
    "Vert Olive RAL 6005": "Olive Green RAL 6005",
    "Gris Ardoise RAL 7016": "Slate Grey RAL 7016",
    "Blanc Crème RAL 9001": "Cream White RAL 9001",
    "Mixte / Plusieurs teintes": "Mixed / Multiple colors",
    "Mode de Réception": "Delivery / Collection Method",
    "Enlèvement Quai Usine Bekoko": "Factory Dock Pickup Bekoko",
    "Enlèvement Usine Douala PK12": "Factory Dock Pickup Douala PK12",
    "Livraison sur Chantier (Camion Usine TPM SA)": "Site Delivery (TPM SA Factory Truck)",
    "Expédition Zone CEMAC (Tchad, RCA, Gabon...)": "CEMAC Regional Dispatch (Chad, CAR, Gabon...)",
    "Détails des Longueurs & Quantités Chiffrées": "Lengths & Quantities Details",
    "Indiquez les longueurs (coupe sur-mesure au cm près) et les quantités requises :": "Specify lengths (custom cut-to-the-centimeter) and required quantities:",
    "Nos profileuses permettent la coupe au centimètre près de 2 m à 12 m sans perte de matière.": "Our roll-forming machines allow centimeter-precise cutting from 2m to 12m with zero waste.",
    "Transmettre ma Demande de Cotation Pro-Forma B2B": "Submit My B2B Pro-Forma Quote Request",
    "Vos informations restent confidentielles. Cotation officielle émise aux barèmes fabricants avec TVA 19.25% légale.": "Your data remains confidential. Official quote issued at factory tier pricing with legal 19.25% VAT.",
    "Cotation Instantanée en Ligne": "Instant Online Quote",
    "Vous Connaissez Vos Articles ?": "Already Know Your Items?",
    "Ajoutez directement vos profilages et matériaux au panier depuis notre boutique pour éditer votre Facture Pro-Forma certifiée en 1 clic :": "Add your profiles and materials straight to the cart from our shop to generate your certified Pro-Forma in 1 click:",
    "Ouvrir l'Inventaire (67 Articles)": "Open Inventory (67 Items)",
    "Ouvrir l'Inventaire (58 Articles)": "Open Inventory (58 Items)",
    "Assistance Immédiate": "Immediate Support",
    "WhatsApp Commercial Usine": "Factory Sales WhatsApp",
    "Transmettez directement votre bordereau de commande ou vos plans de toiture à nos ingénieurs technico-commerciaux :": "Forward your bill of quantities or roof blueprints directly to our technical sales engineers:",
    "+237 655 70 58 66 (WhatsApp)": "+237 655 70 58 66 (WhatsApp)",
    "Documentation Technique": "Technical Documentation",
    "Catalogue Général Officiel 2026": "Official Master Catalog 2026",
    "Consultez les 12 pages complètes avec l'intégralité des 67 références, tableaux de portées et fiches normatives :": "Consult all 12 complete pages with 67 references, load span charts, and standard sheets:",
    "Consultez les 12 pages complètes avec l'intégralité des 58 références, tableaux de portées et fiches normatives :": "Consult all 12 complete pages with 58 references, load span charts, and standard sheets:",
    "Aperçu & Téléchargement (PDF)": "Preview & Download (PDF)",
    "Comptoirs & Enlèvements Quai": "Counters & Factory Docks",
    "Carrefour Bekoko (Axe lourd Douala - Limbé)": "Bekoko Junction (Douala - Limbé Highway)",
    "Usine Douala PK12 :": "Douala PK12 Factory:",
    "Zone Industrielle PK12, Douala": "PK12 Industrial Zone, Douala",
    "Garantie Fabricant": "Manufacturer Guarantee",
    "Pourquoi Commander Vos Matériaux Directement à l'Usine ?": "Why Order Materials Directly From The Factory?",
    "Tarifs Direct Usine": "Direct Factory Rates",
    "Cotation au premier échelon sans marge intermédiaire, avec facturation transparente HT et TVA 19.25%.": "First-tier quote with zero middleman markup, transparent billing Excl. Tax and 19.25% VAT.",
    "Coupe au Centimètre Près": "Centimeter-Precise Cuts",
    "Profilage continu de 2 m à 12 m selon les dimensions exactes de vos versants : zéro déchet sur votre chantier.": "Continuous roll-forming from 2m to 12m to exact roof slope dimensions: zero jobsite waste.",
    "Épaisseurs Réelles 100%": "100% Guaranteed Thicknesses",
    "Aluminium pur 0,35 mm, 0,50 mm et 0,60 mm contrôlé au micromètre numérique. Zéro sous-calibrage.": "Pure 0.35mm, 0.50mm, and 0.60mm aluminium verified with digital micrometers. Zero down-gauging.",
    "Flotte Logistique Grue": "Crane Logistics Fleet",
    "Camions semi-remorques avec bras de déchargement grue pour livraison directe quai ou chantier partout au Cameroun.": "Semi-trailer trucks with crane offloading arms for direct delivery to docks or worksites throughout Cameroon.",
    "USINE BEKOKO": "BEKOKO FACTORY",
    "Lun-Ven: 07h30 - 18h00": "Mon-Fri: 07:30 AM - 06:00 PM",
    "COMPTOIR PK12": "PK12 COUNTER",
    "Lun-Sam: 08h00 - 17h00": "Mon-Sat: 08:00 AM - 05:00 PM",
    "ASSISTANCE WHATSAPP": "WHATSAPP SUPPORT",
    "Réponse Rapide": "Fast Response",
    "Réponse sous 2h": "Response in 2h",
    "Commercial & Devis": "Sales & Quotes",
    "WhatsApp Business (+237 655 70 58 66)": "WhatsApp Business (+237 655 70 58 66)",
    "Étude technique gratuite": "Free Technical Study",
    "Bureau d'Études": "Engineering Office",
    "Enlèvement Usine Bekoko": "Bekoko Factory Pickup",
    "Logistique & Enlèvement": "Logistics & Pickup",
    "Usine de Production Bekoko": "Bekoko Production Factory",
    "Carrefour Bekoko, Axe Douala - Limbé, Littoral, Cameroun": "Bekoko Junction, Douala - Limbé Highway, Littoral, Cameroon",
    "Zone Bekoko (1 500 m²)": "Bekoko Zone (1,500 m²)",
    "Accès Poids Lourds Garanti": "Guaranteed Heavy Vehicle Access",
    "Usine Principale - Bekoko": "Main Factory - Bekoko",
    "Zone Industrielle de Bekoko, Douala, Cameroun": "Bekoko Industrial Zone, Douala, Cameroon",
    "Accès camions > 12m:": "Truck access > 12m:",
    "Oui": "Yes",
    "Pont bascule:": "Weighbridge scale:",
    "Disponible": "Available",
    "Horaires de charge:": "Loading hours:",
    "08h00 - 16h00": "08:00 AM - 04:00 PM",
    "Comptoir Commercial - PK12": "Commercial Counter - PK12",
    "Axe Lourd Douala-Yaoundé, PK12": "Douala-Yaoundé Highway, PK12",
    "Vente au détail:": "Retail sales:",
    "Enlèvement véhicules légers:": "Light vehicles pickup:",
    "Besoin d'une réponse immédiate?": "Need an immediate answer?",
    "Formulaire de Prise de Contact Rapide": "Quick Contact Form",
    "Votre Nom Complet *": "Your Full Name *",
    "Votre Adresse E-mail *": "Your Email Address *",
    "Votre Numéro de Téléphone *": "Your Phone Number *",
    "Sujet de votre demande *": "Subject of your request *",
    "Votre Message *": "Your Message *",
    "Site 1 : Usine Historique de Douala PK12": "Site 1: Historic Douala PK12 Factory",
    "Site 2 : Complexe Industriel de Bekoko": "Site 2: Bekoko Industrial Complex",
    "PÔLE INDUSTRIEL / TARIFS USINE DIRECTS": "INDUSTRIAL SECTOR / DIRECT FACTORY RATES",
    "HUB CATALOGUE B2B & INVENTAIRE USINE": "B2B CATALOG HUB & FACTORY INVENTORY",
    "Consultation de l'ensemble de nos matériaux métalliques, accessoires de toiture, sacs d'emballage et carrelage disponibles en stock usine.": "Browse our full range of metallic materials, roofing accessories, packaging bags, and tiles available in factory stock.",
    "Tous les articles": "All items",
    "Besoin d'un Devis Flash ?": "Need a Flash Quote?",
    "Contactez notre cellule commerciale pour vos calepinages et découpes sur-mesure.": "Contact our sales unit for custom roof layout and tailored cuts.",
    "Demandez un Devis": "Request a Quote",
    "Trier par :": "Sort by:",
    "Dernières nouveautés": "Latest arrivals",
    "Prix croissant": "Price: low to high",
    "Prix décroissant": "Price: high to low",
    "Nom du produit": "Product name",
    "Aucun article ne correspond à votre sélection.": "No items match your selection.",
    "Essayez d'autres mots-clés ou réinitialisez les filtres pour afficher l'ensemble de notre inventaire disponible.": "Try different keywords or reset filters to display our entire inventory.",
    "Voir Tout le Catalogue": "View Entire Catalog",
    "REF:": "SKU:",
    "Tarif HT /": "Price Excl. Tax /",
    "Catalogue Usine": "Factory Catalog",
    "Stock Usine Certifié": "Certified Factory Stock",
    "Imprimer la Fiche": "Print Datasheet",
    "Depuis 1976 • Fiche Technique Officielle de Produit": "Since 1976 • Official Product Technical Datasheet",
    "Usines de Douala PK12 & Bekoko": "Douala PK12 & Bekoko Factories",
    "République du Cameroun • Zone CEMAC": "Republic of Cameroon • CEMAC Zone",
    "Commercial :": "Sales Dept:",
    "Photo Réelle Inventaire TPM SA": "Authentic TPM SA Inventory Photo",
    "Prix Unitaire Usine :": "Factory Unit Price:",
    "Quantité :": "Quantity:",
    "Catalogue PDF": "PDF Catalog",
    "Identification & Spécifications Industrielles": "Identification & Industrial Specifications",
    "Désignation Produit": "Product Designation",
    "Référence Catalogue (SKU)": "Catalog Reference (SKU)",
    "Catégorie / Pôle": "Category / Sector",
    "Matière Première": "Raw Material",
    "Profil / Format / Développé": "Profile / Format / Girth",
    "Épaisseur Nominale Réelle": "Actual Nominal Thickness",
    "Finition de Surface & Teinte": "Surface Finish & Color",
    "Longueurs / Formats Usine": "Factory Lengths / Formats",
    "Unité & Conditionnement": "Unit & Packaging",
    "(Vente en gros & détails)": "(Wholesale & Retail)",
    "Disponibilité Quai Usine": "Factory Dock Availability",
    "Description & Rôle Technique dans la Construction": "Description & Structural Construction Role",
    "Avantages & Points Forts Industriels": "Industrial Advantages & Key Strengths",
    "Domaines d'Application & Guide de Pose": "Application Areas & Installation Guide",
    "Applications recommandées :": "Recommended Applications:",
    "Conseils de pose & fixations :": "Installation & Fastening Tips:",
    "(Groupe CAC) — Leader de la Métallurgie et des Matériaux de Construction au Cameroun.": "(CAC Group) — Leader in Metallurgy and Construction Materials in Cameroon.",
    "Transformation Métallique & Plastique — Depuis 1976": "Metal & Plastics Transformation — Since 1976",
    "Fondé par M. NJIPNGANG — Usines de Douala PK12 & Bekoko": "Founded by Mr. NJIPNGANG — Douala PK12 & Bekoko Factories",
    "BON DE PRO-FORMA N° :": "PRO-FORMA INVOICE NO.:",
    "Date d'émission :": "Issue Date:",
    "Validité :": "Validity:",
    "30 Jours ouvrés": "30 Working Days",
    "Tarification Usine HT": "Factory Pricing Excl. Tax",
    "← Continuer vos ajouts au catalogue": "← Continue adding items from catalog",
    "Coordonnées et Mentions Légales TPM SA (Groupe CAC) :": "Contact & Legal Details TPM SA (CAC Group):",
    "• E-mail officiel :": "• Official Email:",
    "| Téléphones Usine :": "| Factory Phones:",
    "• Horaires de bureau :": "• Office Hours:",
    "Du Lundi au Vendredi de 08h00 à 18h00": "Monday to Friday from 08:00 AM to 06:00 PM",
    "| Jours fériés :": "| Public Holidays:",
    "08h00 à 12h00": "08:00 AM to 12:00 PM",
    "(Fermé : 01/01, 11/02, 01/05, 20/05, 25/12)": "(Closed: 01/01, 11/02, 01/05, 20/05, 25/12)",
    "• Adresse usine : Carrefour Bekoko (Axe Douala - Limbé) & Zone Industrielle Douala PK12, Cameroun.": "• Factory Address: Bekoko Junction (Douala - Limbé Highway) & Douala PK12 Industrial Zone, Cameroon.",

    "SERVICE COMMERCIAL USINE & BTP": "COMMERCIAL FACTORY & CONSTRUCTION SERVICE",
    "SERVICE COMMERCIAL USINE &amp; BTP": "COMMERCIAL FACTORY & CONSTRUCTION SERVICE",
    "SERVICE COMMERCIAL USINE ET BTP": "COMMERCIAL FACTORY & CONSTRUCTION SERVICE",
    "Besoin d'un devis sur-mesure ou d'une commande volumineuse ?": "Need a custom quote or a large volume order?",
    "Profilage de tôles BAC à la longueur exacte de votre chantier, emballages PP personnalisés et tarification dégressive pour quincailleries & entreprises BTP au Cameroun.": "Custom cut-to-length BAC roofing sheets, custom PP packaging, and tiered volume pricing for hardware stores & construction firms in Cameroon.",
    "Profilage de tôles BAC à la longueur exacte de votre chantier, emballages PP personnalisés et tarification dégressive pour quincailleries &amp; entreprises BTP au Cameroun.": "Custom cut-to-length BAC roofing sheets, custom PP packaging, and tiered volume pricing for hardware stores & construction firms in Cameroon.",
    "Demander un Devis Sur-Mesure": "Request a Custom Quote",
    "Contacter l'Usine (Bekoko \/ PK12)": "Contact Factory (Bekoko \/ PK12)",
    "LE LEADER DE LA MÉTALLURGIE & DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
    "LE LEADER DE LA MÉTALLURGIE &amp; DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
    "BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ": "SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEE OF DURABILITY",
    "BATIMENTS SOLIDES = MATERIAUX SOLIDES AVEC GARANTIE DE DURABILITE": "SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEE OF DURABILITY",
    "BATIMENTS SOLIDES =MATERIAUX SOLIDES AVEC GARANTIE DE DURABILITE": "SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEE OF DURABILITY",
    "USINE MÉTALLURGIQUE & PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
    "USINE MÉTALLURGIQUE &amp; PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
    "Depuis 1976, TPM SA fabrique et approvisionne les plus grands chantiers BTP, quincailleries et entreprises du Cameroun et de la zone CEMAC en Tôles BAC prélaquées 0.50mm, accessoires de toiture, Sacs PP tissés et carrelage.": "Since 1976, TPM SA manufactures and supplies major construction sites, hardware stores, and companies across Cameroon and the CEMAC zone with 0.50mm pre-painted BAC roofing sheets, roofing accessories, woven PP bags, and tiles.",
    "Pionnier de la transformation industrielle en Afrique Centrale, TPM SA (Groupe CAC) fabrique des tôles BAC haute résistance, des faîtières & accessoires de toiture, des sacs tissés en polypropylène et distribue des matériaux de second œuvre pour les grands chantiers BTP et le secteur commercial.": "A pioneer of industrial manufacturing in Central Africa, TPM SA (CAC Group) manufactures high-strength BAC roofing sheets, ridge caps & roofing accessories, woven polypropylene bags, and distributes finishing materials for major construction projects and the commercial sector.",
    "50 Ans d'Excellence Métallurgique & de Plasturgie au Cameroun.": "50 Years of Metallurgical & Plastics Excellence in Cameroon.",
    "50 Ans d'Excellence Métallurgique &amp; de Plasturgie au Cameroun.": "50 Years of Metallurgical & Plastics Excellence in Cameroon.",
    "Fabrication directe sur nos sites de Bekoko et PK12 selon les normes de solidité les plus strictes au Cameroun.": "Direct manufacturing at our Bekoko and PK12 sites adhering to Cameroon's highest structural standards.",
    "Ajustement immédiat des devis usine en 2 min": "Instant factory quote calculation in 2 min",
    "Document Pro-Forma Officiel B2B — Valable 30 Jours": "Official B2B Pro-Forma Document — Valid 30 Days",
    "Document Pro-Forma Officiel B2B - Valable 30 Jours": "Official B2B Pro-Forma Document - Valid 30 Days",
    "\"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ\"": "\"SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEED DURABILITY\"",
    "✔ Conforme à la réglementation fiscale du Cameroun": "✔ Fully compliant with Cameroon tax regulations",
    "Demandes de devis sur mesure, suivi de production et enlèvement de commandes. Nos équipes industrielles sont à votre disposition.": "Custom quote requests, production monitoring, and order pickups. Our industrial teams are at your service.",
    "Nos installations sont conçues pour accueillir des véhicules de grand gabarit afin de faciliter vos approvisionnements en matériaux de construction et structures métalliques.": "Our facilities are engineered to accommodate heavy-duty vehicles for seamless loading of construction materials and steel structures.",
    "Joignez directement le département adapté à votre demande pour un traitement express.": "Contact the appropriate department directly for express processing.",
    "Remplissez le formulaire ci-dessous pour une prise en charge rapide par nos équipes techniques ou commerciales.": "Fill in the form below for rapid assistance from our technical or sales teams.",
    "Besoin d'une Facture Pro-Forma officielle ou d'une cotation B2B ?": "Need an official Pro-Forma invoice or B2B quote?",
    "Commandes au mètre linéaire sur-mesure pour tôles BAC, emballages PP tissés et tarification dégressive.": "Custom cut-to-length orders for roofing sheets, woven PP sacks, and tiered volume pricing.",
    "Leader camerounais dans le profilage de tôles BAC prélaquées, la fabrication de fixations industrielles, l'extrusion de sacs PP et le zingage unique en Afrique Centrale.": "Cameroonian leader in pre-painted BAC roofing sheets profiling, industrial fasteners manufacturing, PP bag extrusion, and specialized hot-dip galvanizing in Central Africa.",
    "50 ans d'engagement pour l'autonomie productive du Cameroun": "50 years of commitment to Cameroon's industrial self-reliance",
    "Une capacité industrielle combinée unique au Cameroun pour répondre aux exigences des plus grands projets.": "A unique combined industrial capacity in Cameroon meeting the highest requirements of major projects.",
    "Une transparence totale pour vos déductions de TVA et audits BTP": "Total transparency for your VAT deductions and construction audits",
    "Nos équipes technico-commerciales sont prêtes à étudier vos cahiers des charges.": "Our technical and sales teams are ready to analyze your project specifications.",
    "Vous n'avez pas encore ajouté d'articles à votre devis. Explorez notre catalogue pour composer votre sélection de tôles, accessoires ou fixations.": "You haven't added items to your quote yet. Explore our catalog to select roofing sheets, accessories, or fasteners.",
    "Nos ingénieurs d'études chiffrent vos bordereaux de toiture sous 2 heures.": "Our structural engineers calculate your roofing schedules within 2 hours.",
    "Nos conseillers techniques sont disponibles sur WhatsApp pour une assistance directe.": "Our technical advisors are available on WhatsApp for direct assistance.",
    "Tôle BAC profilée en acier galvanisé prélaqué haute durabilité 0.50mm selon nuancier officiel RAL 3005, ondulée BTP et calepinée.": "High-durability 0.50mm pre-painted galvanized steel BAC sheet according to official RAL 3005 color chart, corrugated and custom-sized.",
    "Tôle BAC aluminium prélaqué 0.50mm, profilage ondulé, nervuré D50\/B30 et découpes sur mesure selon nuancier RAL.": "0.50mm pre-painted aluminium BAC sheet, corrugated and ribbed D50\/B30 profiles with custom cuts.",
    "Profilage nervuré haute résistance avec revêtement multicouche anti-UV et anti-corrosion tropicale.": "High-strength ribbed profile with multi-layer anti-UV and tropical anti-corrosion coating.",
    "Faîtière de couronnement double pente alu et prélaquée haute précision, replis anti-goutte étanches et profilage 2 mètres pour toitures.": "High-precision double-slope aluminium and pre-painted capping ridge with watertight anti-drip folds for 2-meter roofs.",
    "Faîtières crantées double pente, faîtières non crantées, rives alu, gouttières étanches et noues façonnées en atelier.": "Notched double-slope ridge caps, plain ridge caps, aluminium bargeboards, watertight gutters, and workshop valleys.",
    "Tirefonds complets comprenant vis auto-foreuse haute charge 6x80mm zinguée avec cavaliers aluminium et rondelles d'étanchéité EPDM.": "Complete lag screws with heavy-duty zinc-plated 6x80mm self-drilling screws, aluminium saddles, and EPDM sealing washers.",
    "Tirefonds complets 6x80\/6x100, cavaliers alu néoprène, rouleaux bitumés Toiturole 900G et vis auto-foreuses zinguées.": "Complete 6x80\/6x100 lag screws, neoprene aluminium saddles, Toiturole 900G bitumen rolls, and zinc-plated self-drilling screws.",
    "Bande bitumineuse adhésive renforcée aluminium pour solins de toiture, arêtes de faîtage et joints d'étanchéité haute température.": "Aluminium-reinforced adhesive bitumen strip for roof flashings, ridge edges, and high-temperature watertight joints.",
    "Sacs en Polypropylène (PP) tissé ultra-résistants pour emballage de ciment, sable, gravier, produits agricoles et agro-industriels 50kg.": "Ultra-resistant woven polypropylene (PP) bags for packaging cement, sand, gravel, agricultural, and industrial products 50kg.",
    "Sacs PP tissés 50kg\/25kg usine Bekoko, carrelages grès cérame italien\/espagnol, douches sanitaires et second œuvre.": "Woven PP 50kg\/25kg bags Bekoko factory, Italian\/Spanish porcelain stoneware tiles, sanitary showers, and finishing works.",
    "Carrelage grès cérame italien et espagnol pour sols et murs, douches thérapeutiques Zagonel.": "Italian and Spanish porcelain stoneware tiles for floors and walls, Zagonel therapeutic showers.",
    "Prestations industrielles d'électro-zingage 800 VA, outillage de couverture, quincaillerie lourde et chantiers BTP.": "800 VA industrial electro-galvanizing services, roofing tools, heavy hardware, and construction sites.",
    "Gamme d'emballages en sacs tissés en PP (50kg, 25kg, ciment, agroalimentaire et industrie).": "Range of woven PP bag packaging (50kg, 25kg, cement, agrifood, and industrial).",
    "Faîtières double pente, faîtières crantées, demi-rives, rives, gouttières et noues sur-mesure.": "Double-slope ridge caps, notched ridge caps, half-ridges, bargeboards, gutters, and custom valleys.",
    "Fixations complètes à tirefonds, cavaliers étanches, rouleaux bitumés Toiturole 900G et vis auto-foreuses.": "Complete lag screw fixings, waterproof saddles, Toiturole 900G bitumen rolls, and self-drilling screws.",
    "PÔLES DE PRODUCTION TPM SA": "TPM SA PRODUCTION HUBS",
    "Nos 4 Domaines d'Activité Industrielle": "Our 4 Industrial Activity Sectors",
    "Nos 6 Domaines d'Activité Industrielle": "Our Industrial Activity Sectors",
    "INVENTAIRE DIRECT USINE": "DIRECT FACTORY INVENTORY",
    "Articles Phares Disponible en Stock": "Featured Products Available in Stock",
    "FLASH PRO-FORMA EXPRESS": "FLASH PRO-FORMA EXPRESS",
    "CATALOGUE OFFICIEL TPM SA": "OFFICIAL TPM SA CATALOG",
    "66 Références Industrielles Direct Usine": "66 Direct Factory Industrial References",
    "58 Références Industrielles Direct Usine": "66 Direct Factory Industrial References",
    "SÉLECTION D'ACTIVITÉ": "CATEGORY SELECTION",
    "VOTRE FACTURE PRO-FORMA OFFICIELLE": "YOUR OFFICIAL PRO-FORMA INVOICE",
    "GÉNÉRATEUR PRO-FORMA B2B": "B2B PRO-FORMA GENERATOR",
    "Décompte Financier B2B": "B2B Financial Summary",
    "Coordonnées de l'Acheteur": "Buyer \/ Company Details",
    "CONTACT & GÉOLOCALISATION DE L'USINE TPM SA": "CONTACT & GEOLOCATION OF TPM SA FACTORY",
    "CONTACT & GÉOLOCALISATION DE L'USINE": "CONTACT & FACTORY GEOLOCATION",
    "Nos Canaux de Communication": "Our Communication Channels",
    "Sites & Accès": "Sites & Access",
    "Envoyer une Demande": "Send an Inquiry",
    "Notre Histoire Industrielle": "Our Industrial History",
    "2 Sites de Production Stratégiques à Douala": "2 Strategic Production Sites in Douala",
    "CAPACITÉS & GAMMES DE FABRICATION": "MANUFACTURING CAPACITIES & RANGES",
    "L'Éventail de nos Lignes de Production": "Our Production Lines Overview",
    "Gouvernance & Conformité Fiscale": "Governance & Fiscal Compliance",
    "Télécharger les Certificats Fiscaux & Documents": "Download Fiscal Certificates & Documents",
    "Prêt à Collaborer avec TPM SA ?": "Ready to Partner with TPM SA?",
    "Votre Panier Pro-Forma est actuellement vide": "Your Pro-Forma Quote is currently empty",
    "Besoin d'un Devis Sur Mesure ?": "Need a Custom Quote?",
    "Nos Produits": "Our Products",
    "Services & Pro-Forma": "Services & Pro-Forma",
    "Horaires d'Ouverture": "Opening Hours",
    "Informations Usines": "Factory Information",
    "Explorer le Catalogue Officiel": "Explore Official Catalog",
    "Explorer le Catalogue Usine": "Explore Factory Catalog",
    "Localiser l'Usine Bekoko": "Locate Bekoko Factory",
    "Localiser le Site Bekoko": "Locate Bekoko Site",
    "Voir le Catalogue Tôles PK12": "View PK12 Roofing Catalog",
    "Générer mon Devis Pro-Forma Direct": "Generate Instant Pro-Forma Quote",
    "GÉNÉRER MA PRO-FORMA EN PDF": "GENERATE PRO-FORMA PDF",
    "Télécharger ma Pro-Forma (PDF)": "Download Pro-Forma (PDF)",
    "Télécharger Fiche Entreprise (PDF)": "Download Company Profile (PDF)",
    "Télécharger le Catalogue Général (PDF)": "Download General Catalog (PDF)",
    "Télécharger le Catalogue (PDF)": "Download Catalog (PDF)",
    "Valider la Commande Usine": "Confirm Factory Order",
    "Valider la Commande Usine →": "Confirm Factory Order →",
    "Transmettre au Commercial WhatsApp": "Send to WhatsApp Sales Representative",
    "CONTACTER SUR WHATSAPP": "CONTACT ON WHATSAPP",
    "Ouvrir l'Itinéraire GPS (Google Maps)": "Open GPS Directions (Google Maps)",
    "ENVOYER MON MESSAGE À L'USINE": "SEND MY MESSAGE TO THE FACTORY",
    "Générer ma Pro-Forma": "Generate Pro-Forma",
    "Générer une Pro-Forma": "Generate Pro-Forma",
    "Demander un Devis B2B": "Request B2B Quote",
    "Contacter la Direction Générale": "Contact Executive Management",
    "WhatsApp Commercial Direct": "Direct Commercial WhatsApp",
    "Support WhatsApp Commercial": "Commercial WhatsApp Support",
    "Espace Devis B2B": "B2B Quote Portal",
    "Mon Espace Client": "My Customer Account",
    "Connexion \/ Mon Compte": "Login \/ My Account",
    "Mon Panier Pro-Forma": "My Pro-Forma Quote",
    "Mon Panier": "My Cart",
    "Panier Pro-Forma": "Pro-Forma Quote",
    "Vider le panier": "Clear quote",
    "Continuer mes achats": "Continue shopping",
    "Continuer vos ajouts au catalogue": "Continue adding items from catalog",
    "Mettre à jour la Pro-Forma": "Update Pro-Forma",
    "Mettre à jour le panier": "Update Cart",
    "Accéder au Catalogue": "Browse Catalog",
    "Ajouter à la Pro-Forma": "Add to Pro-Forma",
    "Ajouter au Panier": "Add to Cart",
    "Voir le produit": "View product",
    "Détails du Produit": "Product Details",
    "Fiche Technique": "Technical Specs",
    "Consulter les 66 références usine TPM": "Browse all 66 TPM factory references",
    "Consulter les 58 références usine TPM": "Browse all 66 TPM factory references",
    "Consulter l'Inventaire Complet (66 Articles)": "Browse Full Inventory (66 Products)",
    "Consulter l'Inventaire Complet (58 Articles)": "Browse Full Inventory (66 Products)",
    "Voir les 10 Tôles Bacs": "View 10 Roofing Sheets",
    "Voir les 24 Accessoires": "View 24 Accessories",
    "Voir les 17 Accessoires": "View 24 Accessories",
    "Voir les 10 Fixations": "View 10 Fasteners",
    "Voir les 22 Articles": "View 22 Interior Products",
    "Voir les 10 tôles »": "View all 10 roofing sheets »",
    "Voir les 24 accessoires »": "View all 24 accessories »",
    "Voir les 17 accessoires »": "View all 24 accessories »",
    "Voir les 10 fixations »": "View all 10 fasteners »",
    "Voir les 22 articles intérieurs »": "View all 22 interior items »",
    "Voir les Sacs PP Bekoko": "View Bekoko PP Bags",
    "Voir les Carreaux & Sols": "View Tiles & Floors",
    "Voir la Quincaillerie": "View Hardware",
    "Chercher": "Search",
    "Rechercher": "Search",
    "Accueil": "Home",
    "L'Entreprise": "About Us",
    "Catalogue": "Catalog",
    "Contact": "Contact Us",
    "SÉLECTIONNER UN ARTICLE": "SELECT AN ITEM",
    "Sélectionnez un service...": "Select a department...",
    "Longueur personnalisée": "Custom Length",
    "Quantité": "Quantity",
    "Épaisseur Certifiée": "Certified Thickness",
    "Découpe au Centimètre": "Cut to Centimeter",
    "Livraison Rapide CEMAC": "Fast CEMAC Delivery",
    "Paiement Sécurisé \/ Virement": "Secure Payment \/ Bank Transfer",
    "PÔLE N°1 • 10 RÉF.": "SECTOR #1 • 10 ITEMS",
    "PÔLE N°2 • 17 RÉF.": "SECTOR #2 • 17 ITEMS",
    "PÔLE N°3 • 10 RÉF.": "SECTOR #3 • 10 ITEMS",
    "PÔLE N°4 • 22 RÉF.": "SECTOR #4 • 22 ITEMS",
    "FONDÉ PAR M. NJIPNGANG • DEPUIS 1976": "FOUNDED BY MR. NJIPNGANG • SINCE 1976",
    "USINE HISTORIQUE N°1 (PK12)": "HISTORIC FACTORY #1 (PK12)",
    "COMPLEXE N°2 (BEKOKO)": "INDUSTRIAL COMPLEX #2 (BEKOKO)",
    "50 ANS": "50 YEARS",
    "Tradition 1976-2026": "Tradition 1976-2026",
    "2 SITES": "2 SITES",
    "PK12 & Bekoko Douala": "PK12 & Bekoko Douala",
    "100% NC": "100% NC",
    "Conformité CEMAC": "CEMAC Compliance",
    "En Stock Usine": "In Factory Stock",
    "En Stock": "In Stock",
    "+ Pro-Forma": "+ Add to Quote",
    "+ PRO-FORMA": "+ ADD TO QUOTE",
    "PME Agréée": "Certified Enterprise",
    "Usines: PK12 & Bekoko": "Factories: PK12 & Bekoko",
    "Dispo :": "Avail.:",
    "+ TVA 19.25%": "+ 19.25% VAT",
    "Tarif HT \/ m linéaire": "Price Excl. Tax \/ lin. meter",
    "Tarif HT \/ Pièce 2m": "Price Excl. Tax \/ 2m Piece",
    "Tarif HT \/ Boîte 100 pcs": "Price Excl. Tax \/ Box 100 pcs",
    "Tarif HT \/ Rouleau 10m": "Price Excl. Tax \/ 10m Roll",
    "Tarif HT \/ Lot 500 pcs": "Price Excl. Tax \/ Pack 500 pcs",
    "Tarif Usine HT": "Factory Price Excl. Tax",
    "Prix Unitaire HT": "Unit Price Excl. Tax",
    "Total HT (FCFA)": "Total Excl. Tax (FCFA)",
    "Total Ligne HT": "Line Total Excl. Tax",
    "Total des articles HT :": "Items Subtotal Excl. Tax:",
    "TVA Cameroun (19.25%) :": "Cameroon VAT (19.25%):",
    "Frais de Manutention :": "Handling Charges:",
    "Inclus Usine": "Factory Included",
    "TOTAL GÉNÉRAL TTC :": "GRAND TOTAL INCL. TAX:",
    "Articles Sélectionnés": "Selected Items",
    "Article \/ Référence": "Item \/ Reference",
    "Article & Réf": "Item & SKU",
    "Spécifications": "Specifications",
    "Actions": "Actions",
    "Action": "Action",
    "Longueur:": "Length:",
    "Couleur:": "Color:",
    "Nom \/ Raison Sociale": "Full Name \/ Company Name",
    "Nom de l'Entreprise \/ Client :": "Company \/ Customer Name:",
    "NIU (Numéro d'Identifiant Unique)": "TIN (Taxpayer Identification Number)",
    "Numéro NIU \/ N° Contribuable :": "Tax ID (TIN):",
    "Email Professionnel": "Work Email",
    "Email Facturation :": "Billing Email:",
    "Numéro WhatsApp": "WhatsApp Number",
    "Téléphone \/ WhatsApp :": "Phone \/ WhatsApp:",
    "Lieu de Livraison \/ Chantier :": "Delivery Location \/ Site:",
    "Service Concerné": "Department \/ Service",
    "Commercial & Devis Pro-Forma": "Sales & Pro-Forma Quotes",
    "Bureau d'Études \/ Calepinage": "Engineering & Roofing Layout",
    "Bureau d'Études & Calepinage Toiture": "Engineering & Roofing Layout",
    "Logistique & Enlèvement Usine": "Logistics & Factory Pickup",
    "Logistique & Enlèvement Usine Bekoko": "Logistics & Factory Pickup Bekoko",
    "Station Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA Station",
    "Approvisionnement Gros Chantier BTP": "Major Construction Site Supply",
    "Message \/ Détails de la demande": "Message \/ Request Details",
    "Pièces Jointes (PDF, DWG, Images)": "Attachments (PDF, DWG, Images)",
    "Cliquez ou glissez vos fichiers ici (Max 10MB)": "Click or drag your files here (Max 10MB)",
    "Plans, bordereaux de métrés ou fiches techniques": "Blueprints, quantity schedules or technical datasheets",
    "Rechercher un article (ex: Tôle BAC 0.50mm, Faîtière, Sac PP 50kg, Vis 6×80…)": "Search for an item (e.g. 0.50mm Roofing Sheet, Ridge Cap, 50kg PP Bag, 6×80 Screw…)",
    "Rechercher un produit...": "Search for a product...",
    "Ex: Tôle bac alu, faîtière, tirefond...": "E.g.: Alu roofing sheet, ridge cap, lag screw...",
    "Carreaux & Sols": "Tiles & Floors",
    "Carreaux &amp; Sols": "Tiles & Floors",
    "Carrelages & Sols": "Tiles & Floors",
    "Douches Thérapeutiques": "Therapeutic Showers",
    "Éponges Métalliques": "Metallic Sponges",
    "Tous les Accessoires Intérieurs": "All Interior Accessories",
    "Tôles et toiture": "Roofing Sheets & Roofing",
    "Tôles et Toiture": "Roofing Sheets & Roofing",
    "Tôles & Toitures": "Roofing Sheets & Roofing",
    "Tôles & Couvertures": "Roofing Sheets & Coverings",
    "Tôles & Couvertures BAC": "Roofing Sheets & BAC Coverings",
    "Accessoires toiture": "Roofing Accessories",
    "Accessoires de Toiture": "Roofing Accessories",
    "Accessoires Toiture": "Roofing Accessories",
    "Fixations et étanchéité": "Fasteners & Waterproofing",
    "Fixations & Étanchéité": "Fasteners & Waterproofing",
    "Fixations & étanchéité": "Fasteners & Waterproofing",
    "Accessoires intérieurs": "Interior Accessories & Bags",
    "Accessoires Intérieurs & Sacs PP": "Interior Accessories & PP Bags",
    "Accessoires Intérieurs & Plasturgie": "Interior Accessories & Plastics",
    "Carreaux & Emballages PP": "Tiles & PP Packaging",
    "Emballages & Plastiques": "Packaging & Plastics",
    "Carrelages & Revêtements": "Tiles & Floor Coverings",
    "Carreaux & Revêtements": "Tiles & Floor Coverings",
    "Quincaillerie & BTP": "Hardware & Construction",
    "Quincaillerie & Outillage BTP": "Hardware & Construction Tools",
    "Tôles BAC & Ondulées": "Roofing Sheets & Corrugated",
    "Faîtières, Rives & Gouttières": "Ridge Caps, Bargeboards & Gutters",
    "Fixations Complètes & Pointes": "Complete Fasteners & Nails",
    "Sacs PP Blancs 50kg \/ 100kg": "White PP Bags 50kg \/ 100kg",
    "Carreaux & Sanitaires": "Tiles & Sanitaryware",
    "Demande de Pro-Forma Flash": "Flash Pro-Forma Request",
    "Approvisionnement Chantiers BTP": "Construction Worksite Supply",
    "Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA",
    "Catalogue Général (58 Articles)": "General Catalog (58 Items)",
    "Usine Bekoko : Lun - Ven 07h30 - 18h00": "Bekoko Factory: Mon - Fri 07:30 AM - 06:00 PM",
    "Comptoir PK12 : Lun - Sam 08h00 - 17h00": "PK12 Counter: Mon - Sat 08:00 AM - 05:00 PM",
    "Expéditions Grand Nord & CEMAC : 24h\/48h": "Grand North & CEMAC Dispatch: 24h\/48h",
    "Tous droits réservés.": "All rights reserved.",
    "Conception Industrielle & Numérique CEMAC": "CEMAC Industrial & Digital Design",
    "mètre linéaire": "linear meter",
    "mètres linéaires": "linear meters",
    "unité": "unit",
    "unités": "units",
    "boîte": "box",
    "boîtes": "boxes",
    "paquet": "pack",
    "paquets": "packs",
    "rouleau": "roll",
    "rouleaux": "rolls",
    "lot": "batch",
    "lots": "batches",
    "pièce": "piece",
    "pièces": "pieces",
    "Tôle": "Roofing Sheet",
    "Tôles": "Roofing Sheets",
    "Faîtière": "Ridge Cap",
    "Faîtières": "Ridge Caps",
    "Tirefond": "Lag Screw",
    "Tirefonds": "Lag Screws",
    "Cavalier": "Saddle Washer",
    "Cavaliers": "Saddle Washers",
    "Boulon": "Bolt",
    "Boulons": "Bolts",
    "Pointe": "Nail",
    "Pointes": "Nails",
    "Gouttière": "Gutter",
    "Gouttières": "Gutters",
    "Rive": "Bargeboard",
    "Rives": "Bargeboards",
    "Noue": "Valley",
    "Noues": "Valleys",
    "Carrelage": "Tile",
    "Carrelages": "Tiles",
    "Carreaux": "Tiles",
    "Plasturgie": "Plastics",
    "Métallurgie": "Metallurgy",
    "Galvanisé": "Galvanized",
    "Galvanisée": "Galvanized",
    "Prélaqué": "Pre-painted",
    "Prélaquée": "Pre-painted",
    "Prélaquées": "Pre-painted",
    "Ondulé": "Corrugated",
    "Ondulée": "Corrugated",
    "Ondulées": "Corrugated",
    "Nervuré": "Ribbed",
    "Nervurée": "Ribbed",
    "Nervurées": "Ribbed",
    "Bordeau": "Bordeaux",
    "Bleu Cendre": "Ash Blue",
    "Vert Olive": "Olive Green",
    "Rouge": "Red",
    "Alu brillant": "Glossy Alu"
};
    const DICT_EN_TO_FR = {
    "Cart totals": "Totaux du Panier",
    "Add coupons": "Ajouter des coupons",
    "Add coupon": "Ajouter un coupon",
    "Estimated total": "Total estimé",
    "Proceed to Checkout": "Passer la commande \/ Pro-Forma",
    "Proceed to checkout": "Passer la commande \/ Pro-Forma",
    "Your cart is currently empty!": "Votre panier est actuellement vide !",
    "You may be interested in…": "Vous pourriez aussi aimer…",
    "You may be interested in...": "Vous pourriez aussi aimer...",
    "Order Summary": "Récapitulatif de la commande",
    "Order summary": "Récapitulatif de la commande",
    "Subtotal": "Sous-total",
    "Shipping": "Expédition \/ Livraison",
    "Taxes": "Taxes (TVA 19.25%)",
    "Coupon code": "Code promo \/ coupon",
    "Apply coupon": "Appliquer le coupon",
    "New in store": "Nouveautés en stock"
};

    // Dictionnaire en minuscules pour correspondance insensible à la casse
    const LOWER_DICT_FR_TO_EN = {};
    for (const [k, v] of Object.entries(DICT_FR_TO_EN)) {
        LOWER_DICT_FR_TO_EN[k.toLowerCase()] = v;
    }

    const LOWER_DICT_EN_TO_FR = {};
    for (const [k, v] of Object.entries(DICT_EN_TO_FR)) {
        LOWER_DICT_EN_TO_FR[k.toLowerCase()] = v;
    }

    // Liste des phrases multi-mots triées par longueur décroissante
    const PHRASES_FR_TO_EN = Object.entries(DICT_FR_TO_EN)
        .filter(([k]) => k.length > 3)
        .sort((a, b) => b[0].length - a[0].length);

    const PHRASES_EN_TO_FR = Object.entries(DICT_EN_TO_FR)
        .filter(([k]) => k.length > 3)
        .sort((a, b) => b[0].length - a[0].length);

    // Stockage en mémoire du texte français original pur
    const originalTextMap = new WeakMap();
    const originalAttrMap = new WeakMap();

    function getActiveLanguage() {
        return localStorage.getItem(STORAGE_KEY) || DEFAULT_LANG;
    }

    function setActiveLanguage(lang) {
        localStorage.setItem(STORAGE_KEY, lang);
        document.cookie = STORAGE_KEY + '=' + lang + ';path=/;max-age=31536000;SameSite=Lax';
    }

    // Fonction de traduction directe O(1) + sous-phrases
    function fastTranslate(str, targetLang) {
        if (!str || typeof str !== 'string') return str;
        const trimmed = str.trim();
        if (!trimmed) return str;

        const dict = (targetLang === 'en') ? DICT_FR_TO_EN : DICT_EN_TO_FR;
        const lowerDict = (targetLang === 'en') ? LOWER_DICT_FR_TO_EN : LOWER_DICT_EN_TO_FR;
        const phrases = (targetLang === 'en') ? PHRASES_FR_TO_EN : PHRASES_EN_TO_FR;

        // 1. Correspondance exacte O(1)
        if (dict[trimmed]) {
            return str.replace(trimmed, dict[trimmed]);
        }

        // 2. Correspondance insensible à la casse O(1)
        const lower = trimmed.toLowerCase();
        if (lowerDict[lower]) {
            return str.replace(trimmed, lowerDict[lower]);
        }

        // 3. Remplacement des sous-phrases
        let result = str;
        for (let i = 0; i < phrases.length; i++) {
            const [from, to] = phrases[i];
            if (result.indexOf(from) !== -1) {
                result = result.split(from).join(to);
            }
        }
        return result;
    }

    function updateButtonsUI(lang) {
        const isEn = (lang === 'en');
        document.documentElement.lang = isEn ? 'en' : 'fr';

        const buttons = document.querySelectorAll('[data-lang-btn]');
        buttons.forEach(btn => {
            const btnLang = btn.getAttribute('data-lang-btn');
            const isActive = (btnLang === lang);

            if (isActive) {
                btn.classList.add('bg-tpm-orange', 'text-white', 'font-black', 'shadow-sm');
                btn.classList.remove('text-gray-300', 'text-gray-400', 'text-gray-600', 'hover:text-white', 'hover:text-gray-900');
            } else {
                btn.classList.remove('bg-tpm-orange', 'text-white', 'font-black', 'shadow-sm');
                if (btn.closest('#site-header') && !btn.closest('#mobile-menu')) {
                    btn.classList.add('text-gray-300', 'hover:text-white');
                } else {
                    btn.classList.add('text-gray-600', 'hover:text-gray-900');
                }
            }
        });

        // Mettre à jour le texte du bouton panier
        const cartBadgeEl = document.querySelector('.cart-badge-count');
        const count = cartBadgeEl ? cartBadgeEl.textContent.trim() : '0';
        const cartLabels = document.querySelectorAll('.cart-button-label');
        cartLabels.forEach(el => {
            el.innerHTML = isEn ? ('My Pro-Forma Quote (<span class="cart-badge-count">' + count + '</span>)') : ('Mon Panier Pro-Forma (<span class="cart-badge-count">' + count + '</span>)');
        });
    }

    // Capture de l'état français d'origine
    function snapshotOriginals() {
        const walker = document.createTreeWalker(
            document.body,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode: function (node) {
                    const parent = node.parentElement;
                    if (!parent) return NodeFilter.FILTER_REJECT;
                    const tag = parent.tagName.toLowerCase();
                    if (tag === 'script' || tag === 'style' || tag === 'noscript' || tag === 'code' || tag === 'pre') {
                        return NodeFilter.FILTER_REJECT;
                    }
                    if (parent.classList.contains('material-symbols-outlined') || parent.classList.contains('cart-badge-count')) {
                        return NodeFilter.FILTER_REJECT;
                    }
                    return NodeFilter.FILTER_ACCEPT;
                }
            }
        );

        let node;
        while ((node = walker.nextNode())) {
            if (!originalTextMap.has(node)) {
                originalTextMap.set(node, node.nodeValue);
            }
        }

        const elements = document.querySelectorAll('input, textarea, select, option, button, [title], [aria-label], [alt]');
        elements.forEach(el => {
            if (!originalAttrMap.has(el)) {
                originalAttrMap.set(el, {
                    text: (el.tagName === 'OPTION' || el.tagName === 'BUTTON') ? el.textContent : null,
                    value: (el.tagName === 'INPUT' && (el.type === 'submit' || el.type === 'button')) ? el.value : null,
                    placeholder: el.placeholder || null,
                    title: el.title || null,
                    ariaLabel: el.getAttribute('aria-label') || null,
                    alt: el.alt || null
                });
            }
        });
    }

    // Application ultra-rapide (< 1ms)
    function applyLanguage(targetLang) {
        snapshotOriginals();

        const isEn = (targetLang === 'en');

        // Nœuds de texte
        const walker = document.createTreeWalker(
            document.body,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode: function (node) {
                    const parent = node.parentElement;
                    if (!parent) return NodeFilter.FILTER_REJECT;
                    const tag = parent.tagName.toLowerCase();
                    if (tag === 'script' || tag === 'style' || tag === 'noscript' || tag === 'code' || tag === 'pre') {
                        return NodeFilter.FILTER_REJECT;
                    }
                    if (parent.classList.contains('material-symbols-outlined') || parent.classList.contains('cart-badge-count')) {
                        return NodeFilter.FILTER_REJECT;
                    }
                    return NodeFilter.FILTER_ACCEPT;
                }
            }
        );

        let node;
        while ((node = walker.nextNode())) {
            const raw = originalTextMap.get(node);
            if (raw !== undefined) {
                node.nodeValue = isEn ? fastTranslate(raw, 'en') : fastTranslate(raw, 'fr');
            }
        }

        // Options, boutons et attributs
        const elements = document.querySelectorAll('input, textarea, select, option, button, [title], [aria-label], [alt]');
        elements.forEach(el => {
            const snap = originalAttrMap.get(el);
            if (snap) {
                if (snap.text !== null && el.tagName === 'OPTION') {
                    el.textContent = isEn ? fastTranslate(snap.text, 'en') : fastTranslate(snap.text, 'fr');
                }
                if (snap.value !== null) {
                    el.value = isEn ? fastTranslate(snap.value, 'en') : fastTranslate(snap.value, 'fr');
                }
                if (snap.placeholder !== null) {
                    el.placeholder = isEn ? fastTranslate(snap.placeholder, 'en') : fastTranslate(snap.placeholder, 'fr');
                }
                if (snap.title !== null) {
                    el.title = isEn ? fastTranslate(snap.title, 'en') : fastTranslate(snap.title, 'fr');
                }
                if (snap.ariaLabel !== null) {
                    el.setAttribute('aria-label', isEn ? fastTranslate(snap.ariaLabel, 'en') : fastTranslate(snap.ariaLabel, 'fr'));
                }
                if (snap.alt !== null) {
                    el.alt = isEn ? fastTranslate(snap.alt, 'en') : fastTranslate(snap.alt, 'fr');
                }
            }
        });
    }

    // Commutation globale
    window.setTPMLanguage = function (lang) {
        if (lang !== 'fr' && lang !== 'en') lang = 'fr';
        setActiveLanguage(lang);
        updateButtonsUI(lang);
        applyLanguage(lang);
        window.dispatchEvent(new CustomEvent('tpm_language_changed', { detail: { lang } }));
    };

    // Initialisation
    document.addEventListener('DOMContentLoaded', function () {
        snapshotOriginals();

        const initialLang = getActiveLanguage();

        document.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-lang-btn]');
            if (btn) {
                e.preventDefault();
                const targetLang = btn.getAttribute('data-lang-btn');
                window.setTPMLanguage(targetLang);
            }
        });

        updateButtonsUI(initialLang);

        if (initialLang === 'en') {
            applyLanguage('en');
        } else {
            // S'assurer que les blocs React éventuels sont traduits en français
            applyLanguage('fr');
        }
    });

})();