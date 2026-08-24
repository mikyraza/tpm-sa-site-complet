/**
 * TPM SA (Groupe CAC) - Moteur Bilingue Universel Temps Réel (i18n)
 * Traduction 100% intégrale de chaque mot, titre, bouton, carte et pied de page.
 * Par défaut : Français (FR). Clic sur switch -> Anglais (EN).
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'tpm_site_lang';
    const DEFAULT_LANG = 'fr';

    // Dictionnaire bilingue maître trié par longueur décroissante
    const DICTIONARY = {
    "Depuis 1976, TPM SA fabrique et approvisionne les plus grands chantiers BTP, quincailleries et entreprises du Cameroun et de la zone CEMAC en Tôles BAC prélaquées 0.50mm, accessoires de toiture, Sacs PP tissés et carrelage.": "Since 1976, TPM SA manufactures and supplies major construction sites, hardware stores and companies across Cameroon and the CEMAC zone with 0.50mm pre-painted BAC roofing sheets, roofing accessories, woven PP bags and tiles.",
    "Nos installations sont conçues pour accueillir des véhicules de grand gabarit afin de faciliter vos approvisionnements en matériaux de construction et structures métalliques.": "Our facilities are designed to accommodate large heavy-duty vehicles for easy loading of construction materials.",
    "Leader camerounais dans le profilage de tôles BAC prélaquées, la fabrication de fixations industrielles, l'extrusion de sacs PP et le zingage unique en Afrique Centrale.": "Cameroonian leader in pre-painted BAC roofing sheets, industrial fasteners manufacturing, PP bag extrusion and hot-dip galvanizing in Central Africa.",
    "Vous n'avez pas encore ajouté d'articles à votre devis. Explorez notre catalogue pour composer votre sélection de tôles, accessoires ou fixations.": "You haven't added items to your quote yet. Explore our catalog to choose roofing sheets, accessories or fasteners.",
    "Demandes de devis sur mesure, suivi de production et enlèvement de commandes. Nos équipes industrielles sont à votre disposition.": "Custom quote requests, production monitoring and order pickups. Our industrial teams are at your service.",
    "Pionnier de la transformation industrielle en Afrique Centrale, TPM SA fabrique et approvisionne les plus grands chantiers BTP": "Pioneer of industrial manufacturing in Central Africa, TPM SA manufactures and supplies major construction worksites",
    "Fabrication directe sur nos sites de Bekoko et PK12 selon les normes de solidité les plus strictes au Cameroun.": "Direct manufacturing at our Bekoko and PK12 sites adhering to Cameroon's strictest durability standards.",
    "Remplissez le formulaire ci-dessous pour une prise en charge rapide par nos équipes techniques ou commerciales.": "Fill in the form below for rapid assistance from our technical or commercial teams.",
    "Une capacité industrielle combinée unique au Cameroun pour répondre aux exigences des plus grands projets.": "A unique combined industrial capacity in Cameroon meeting the highest project demands.",
    "Commandes au mètre linéaire sur-mesure pour tôles BAC, emballages PP tissés et tarification dégressive.": "Custom cut-to-length orders for roofing sheets, woven PP sacks, and tiered volume pricing.",
    "Joignez directement le département adapté à votre demande pour un traitement express.": "Contact the appropriate department directly for express handling.",
    "Nos conseillers techniques sont disponibles sur WhatsApp pour une assistance directe.": "Our technical advisors are available on WhatsApp for direct assistance.",
    "Nos équipes technico-commerciales sont prêtes à étudier vos cahiers des charges.": "Our technical and sales teams are ready to analyze your project specifications.",
    "LE LEADER DE LA MÉTALLURGIE &amp; DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
    "LE LEADER DE LA MÉTALLURGIE & DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
    "\"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ\"": "\"SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEED DURABILITY\"",
    "50 Ans d'Excellence Métallurgique &amp; de Plasturgie au Cameroun.": "50 Years of Metallurgical & Plastics Excellence in Cameroon.",
    "Besoin d'une Facture Pro-Forma officielle ou d'une cotation B2B ?": "Need an official Pro-Forma invoice or B2B quote?",
    "Une transparence totale pour vos déductions de TVA et audits BTP": "Total transparency for your VAT deductions and construction audits",
    "50 Ans d'Excellence Métallurgique & de Plasturgie au Cameroun.": "50 Years of Metallurgical & Plastics Excellence in Cameroon.",
    "INVENTAIRE DIRECT USINE : ARTICLES PHARES DISPONIBLE EN STOCK": "DIRECT FACTORY INVENTORY: FEATURED ITEMS IN STOCK",
    "50 ans d'engagement pour l'autonomie productive du Cameroun": "50 years of commitment to Cameroon's industrial self-reliance",
    "Carrefour Bekoko, Axe Douala - Limbé, Littoral, Cameroun": "Bekoko Junction, Douala - Limbe Highway, Littoral, Cameroon",
    "✔ Conforme à la réglementation fiscale du Cameroun": "✔ Compliant with Cameroon tax regulations",
    "Faîtière non crantée double pente 0.35\/0.33 nature": "Unnotched Double Slope Ridge Cap 0.35\/0.33 Natural",
    "Document Pro-Forma Officiel B2B — Valable 30 Jours": "Official B2B Pro-Forma Document — Valid 30 Days",
    "Document Pro-Forma Officiel B2B - Valable 30 Jours": "Official B2B Pro-Forma Document - Valid 30 Days",
    "Plans, bordereaux de métrés ou fiches techniques": "Blueprints, quantity schedules or technical datasheets",
    "Télécharger les Certificats Fiscaux & Documents": "Download Fiscal Certificates & Documents",
    "Faîtière crantée double pente 0.35\/0.33 nature": "Notched Double Slope Ridge Cap 0.35\/0.33 Natural",
    "Tôles bacs ou ondulées alu 5\/10e Prélaquées": "5\/10th Pre-painted Alu BAC or Corrugated Sheets",
    "USINE MÉTALLURGIQUE &amp; PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
    "Cliquez ou glissez vos fichiers ici (Max 10MB)": "Click or drag your files here (Max 10MB)",
    "Ajustement immédiat des devis usine en 2 min": "Instant factory quote calculation in 2 min",
    "Zone Industrielle de Bekoko, Douala, Cameroun": "Bekoko Industrial Zone, Douala, Cameroon",
    "2 Sites de Production Stratégiques à Douala": "2 Strategic Production Sites in Douala",
    "Consulter l'Inventaire Complet (58 Articles)": "Browse Full Inventory (58 Products)",
    "CONTACT & GÉOLOCALISATION DE L'USINE TPM SA": "CONTACT & GEOLOCATION OF TPM SA FACTORY",
    "Votre Panier Pro-Forma est actuellement vide": "Your Pro-Forma Quote is currently empty",
    "USINE MÉTALLURGIQUE & PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
    "58 Références Industrielles Direct Usine": "58 Direct Factory Industrial References",
    "Conception Industrielle & Numérique CEMAC": "CEMAC Industrial & Digital Design",
    "Expéditions Grand Nord & CEMAC : 24h\/48h": "Grand North & CEMAC Dispatch: 24h\/48h",
    "Tôles bacs prélaquées B30 2ème choix": "Pre-painted B30 2nd Choice BAC Sheets",
    "Nos 4 Domaines d'Activité Industrielle": "Our 4 Industrial Activity Sectors",
    "Nos 6 Domaines d'Activité Industrielle": "Our Industrial Activity Sectors",
    "Consulter les 58 références usine TPM": "Browse all 58 TPM factory references",
    "L'Éventail de nos Lignes de Production": "Our Production Lines Overview",
    "Comptoir PK12 : Lun - Sam 08h00 - 17h00": "PK12 Counter: Mon - Sat 08:00 AM - 05:00 PM",
    "FONDÉ PAR M. NJIPNGANG • DEPUIS 1976": "FOUNDED BY MR. NJIPNGANG • SINCE 1976",
    "Ouvrir l'Itinéraire GPS (Google Maps)": "Open GPS Directions (Google Maps)",
    "Usine Bekoko : Lun - Ven 07h30 - 18h00": "Bekoko Factory: Mon - Fri 07:30 AM - 06:00 PM",
    "CONTACT & GÉOLOCALISATION DE L'USINE": "CONTACT & FACTORY GEOLOCATION",
    "← Continuer vos ajouts au catalogue": "← Continue adding items from catalog",
    "Bureau d'Études & Calepinage Toiture": "Engineering & Roofing Layout",
    "Logistique & Enlèvement Usine Bekoko": "Logistics & Factory Pickup Bekoko",
    "Générer mon Devis Pro-Forma Direct": "Generate Instant Pro-Forma Quote",
    "Télécharger Fiche Entreprise (PDF)": "Download Company Profile (PDF)",
    "Accessoires Intérieurs & Plasturgie": "Interior Accessories & Plastics",
    "Articles Phares Disponible en Stock": "Featured Items Available in Stock",
    "Voir les 22 articles intérieurs »": "View all 22 interior items »",
    "Approvisionnement Gros Chantier BTP": "Major Construction Site Supply",
    "VOTRE FACTURE PRO-FORMA OFFICIELLE": "YOUR OFFICIAL PRO-FORMA INVOICE",
    "Transmettre au Commercial WhatsApp": "Send to WhatsApp Sales Representative",
    "CAPACITÉS & GAMMES DE FABRICATION": "MANUFACTURING CAPACITIES & RANGES",
    "NIU (Numéro d'Identifiant Unique)": "TIN (Taxpayer Identification Number)",
    "Pièces Jointes (PDF, DWG, Images)": "Attachments (PDF, DWG, Images)",
    "Tôles bacs alu 5\/10e Prélaquées": "5\/10th Pre-painted Alu BAC Sheets",
    "Cartons carreaux sol 60x60 italien": "Boxes 60x60 Italian Floor Tiles",
    "Catalogue Général (58 Articles)": "General Catalog (58 Items)",
    "Besoin d'une réponse immédiate?": "Need an immediate answer?",
    "Gouvernance & Conformité Fiscale": "Governance & Fiscal Compliance",
    "Prêt à Collaborer avec TPM SA ?": "Ready to Partner with TPM SA?",
    "Contacter la Direction Générale": "Contact Executive Management",
    "Continuer vos ajouts au catalogue": "Continue adding items from catalog",
    "Accessoires Intérieurs & Sacs PP": "Interior Accessories & PP Bags",
    "Faîtière à Bord Rabattu 0.50mm": "Folded Edge Ridge Cap 0.50mm",
    "Télécharger ma Pro-Forma (PDF)": "Download Pro-Forma (PDF)",
    "Numéro NIU \/ N° Contribuable :": "Tax ID (TIN):",
    "Message \/ Détails de la demande": "Message \/ Request Details",
    "Faîtières, Rives & Gouttières": "Ridge Caps, Bargeboards & Gutters",
    "Axe Lourd Douala-Yaoundé, PK12": "Douala-Yaoundé Main Highway, PK12",
    "Enlèvement véhicules légers:": "Light vehicle pickup:",
    "Station Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA Station",
    "Joint Bitumé Étanchéité 10M": "10M Bituminous Sealing Strip",
    "Logistique & Enlèvement Usine": "Logistics & Factory Pickup",
    "Explorer le Catalogue Officiel": "Explore Official Catalog",
    "ENVOYER MON MESSAGE À L'USINE": "SEND MY MESSAGE TO THE FACTORY",
    "Nom de l'Entreprise \/ Client :": "Company \/ Customer Name:",
    "Lieu de Livraison \/ Chantier :": "Delivery Location \/ Site:",
    "Paiement Sécurisé \/ Virement": "Secure Payment \/ Transfer",
    "Fixations Complètes & Pointes": "Complete Fasteners & Nails",
    "GÉNÉRER MA PRO-FORMA EN PDF": "GENERATE PRO-FORMA PDF",
    "Valider la Commande Usine →": "Confirm Factory Order →",
    "Direction Commerciale & Devis": "Sales & Quotation Department",
    "Déclaration Douanière CEMAC": "CEMAC Customs Declaration",
    "Voir le Catalogue Tôles PK12": "View PK12 Roofing Catalog",
    "Bureau d'Études \/ Calepinage": "Engineering & Roofing Layout",
    "Quincaillerie & Outillage BTP": "Hardware & Construction Tools",
    "Douche thérapeutique Zagonel": "Zagonel Therapeutic Shower",
    "USINE HISTORIQUE N°1 (PK12)": "HISTORIC FACTORY #1 (PK12)",
    "Usine Historique Douala PK12": "Historic Douala PK12 Factory",
    "Certificat d'Immatriculation": "Business Registration",
    "Commercial & Devis Pro-Forma": "Sales & Pro-Forma Quotes",
    "Tôles bacs prélaquées D50": "D50 Pre-painted BAC Sheets",
    "PÔLES DE PRODUCTION TPM SA": "TPM SA PRODUCTION HUBS",
    "Nos Canaux de Communication": "Our Communication Channels",
    "Bureau d'Études & Toitures": "Design Office & Roofing Calculations",
    "Notre Histoire Industrielle": "Our Industrial History",
    "Explorer le Catalogue Usine": "Explore Factory Catalog",
    "Mettre à jour la Pro-Forma": "Update Pro-Forma",
    "Support WhatsApp Commercial": "Commercial WhatsApp Support",
    "Accès Poids Lourds Garanti": "Heavy Duty Truck Access Guaranteed",
    "Sacs PP Blancs 50kg \/ 100kg": "White PP Bags 50kg \/ 100kg",
    "Tôle Bac Alu 4N ET 5N 0,35": "Alu 4N & 5N 0.35 Roofing Sheet",
    "Tôles bacs B30 2ème choix": "B30 2nd Choice BAC Sheets",
    "Tirefond 6x80 paquet 72 pcs": "Lag Screw 6x80 Pack 72 pcs",
    "Sacs PP Blancs Tissés 50kg": "White Woven PP Bags 50kg",
    "GÉNÉRATEUR PRO-FORMA B2B": "B2B PRO-FORMA GENERATOR",
    "Comptoir Commercial - PK12": "Commercial Counter - PK12",
    "Usine de Production Bekoko": "Bekoko Production Plant",
    "WhatsApp Commercial Direct": "Direct Commercial WhatsApp",
    "Complexe Industriel Bekoko": "Bekoko Industrial Complex",
    "Voir les 17 accessoires »": "View all 17 accessories »",
    "Accès Poids Lourds Ouvert": "Heavy Duty Truck Access Open",
    "Coordonnées de l'Acheteur": "Buyer \/ Company Details",
    "Fixations et étanchéité": "Fasteners & Waterproofing",
    "Demande de Pro-Forma Flash": "Flash Pro-Forma Request",
    "Tôle Bac Alu 4N & 5N 0,35": "Alu 4N & 5N 0.35 Roofing Sheet",
    "Tôles Tuile nervurale D50": "D50 Ribbed Tile Roofing Sheets",
    "Tôle Ondulée ALU 0,35 3M": "Corrugated ALU Sheet 0.35 3M",
    "CATALOGUE OFFICIEL TPM SA": "OFFICIAL TPM SA CATALOG",
    "Valider la Commande Usine": "Confirm Factory Order",
    "Usine Principale - Bekoko": "Main Factory - Bekoko",
    "Attestation Fiscale (DGI)": "Tax Compliance Certificate",
    "Nuancier RAL Officiel TPM": "Official TPM RAL Color Chart",
    "Tarif HT \/ Boîte 100 pcs": "Price Excl. Tax \/ Box 100 pcs",
    "Fixations & Étanchéité": "Fasteners & Waterproofing",
    "Fixations & étanchéité": "Fasteners & Waterproofing",
    "Carrelages & Revêtements": "Tiles & Floor Coverings",
    "Tirefonds complets 6x80mm": "Complete 6x80mm Lag Screws",
    "SÉLECTIONNER UN ARTICLE": "SELECT AN ITEM",
    "Mettre à jour le panier": "Update Cart",
    "Localiser l'Usine Bekoko": "Locate Bekoko Factory",
    "Localiser le Site Bekoko": "Locate Bekoko Site",
    "Voir les 10 fixations »": "View all 10 fasteners »",
    "TVA 19.25% Récupérable": "19.25% Recoverable VAT",
    "Téléphone \/ WhatsApp :": "Phone \/ WhatsApp:",
    "Tôles & Couvertures BAC": "Roofing Sheets & BAC Coverings",
    "Carreaux & Emballages PP": "Tiles & PP Packaging",
    "INVENTAIRE DIRECT USINE": "DIRECT FACTORY INVENTORY",
    "FLASH PRO-FORMA EXPRESS": "FLASH PRO-FORMA EXPRESS",
    "Décompte Financier B2B": "B2B Financial Summary",
    "Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA",
    "Voir les 10 Tôles Bacs": "View 10 Roofing Sheets",
    "Voir les 17 Accessoires": "View 17 Accessories",
    "Tous droits réservés.": "All rights reserved.",
    "PÔLE N°1 • 10 RÉF.": "SECTOR #1 • 10 ITEMS",
    "PÔLE N°2 • 17 RÉF.": "SECTOR #2 • 17 ITEMS",
    "PÔLE N°3 • 10 RÉF.": "SECTOR #3 • 10 ITEMS",
    "PÔLE N°4 • 22 RÉF.": "SECTOR #4 • 22 ITEMS",
    "Fondateur Visionnaire :": "Visionary Founder:",
    "Zone Bekoko (1 500 m²)": "Bekoko Zone (1,500 m²)",
    "Longueur personnalisée": "Custom Length",
    "Découpe au Centimètre": "Cut to Centimeter",
    "Total des articles HT :": "Items Subtotal Excl. Tax:",
    "TVA Cameroun (19.25%) :": "Cameroon VAT (19.25%):",
    "Articles Sélectionnés": "Selected Items",
    "Accessoires intérieurs": "Interior Accessories & Bags",
    "Emballages & Plastiques": "Packaging & Plastics",
    "Carreaux & Revêtements": "Tiles & Floor Coverings",
    "SÉLECTION D'ACTIVITÉ": "CATEGORY SELECTION",
    "CONTACTER SUR WHATSAPP": "CONTACT ON WHATSAPP",
    "Générer ma Pro-Forma": "Generate Pro-Forma",
    "COMPLEXE N°2 (BEKOKO)": "INDUSTRIAL COMPLEX #2 (BEKOKO)",
    "Connexion \/ Mon Compte": "Login \/ My Account",
    "Douala (PK12 & Bekoko)": "Douala (PK12 & Bekoko)",
    "Lun-Ven: 07h30 - 18h00": "Mon-Fri: 07:30 AM - 06:00 PM",
    "Lun-Sam: 08h00 - 17h00": "Mon-Sat: 08:00 AM - 05:00 PM",
    "Livraison Rapide CEMAC": "Fast CEMAC Delivery",
    "Tarif HT \/ m linéaire": "Price Excl. Tax \/ lin. meter",
    "Tarif HT \/ Rouleau 10m": "Price Excl. Tax \/ 10m Roll",
    "Tarif HT \/ Lot 500 pcs": "Price Excl. Tax \/ Pack 500 pcs",
    "Frais de Manutention :": "Handling Charges:",
    "Accessoires de Toiture": "Roofing Accessories",
    "Tôles BAC & Ondulées": "Roofing Sheets & Corrugated",
    "Voir les 10 Fixations": "View 10 Fasteners",
    "Voir les 10 tôles »": "View all 10 roofing sheets »",
    "Usines: PK12 & Bekoko": "Factories: PK12 & Bekoko",
    "Accès camions > 12m:": "Truck access > 12m:",
    "Épaisseur Certifiée": "Certified Thickness",
    "TOTAL GÉNÉRAL TTC :": "GRAND TOTAL INCL. TAX:",
    "Article \/ Référence": "Item \/ Reference",
    "Accéder au Catalogue": "Browse Catalog",
    "Carreaux & Sanitaires": "Tiles & Sanitaryware",
    "Mon Panier Pro-Forma": "My Pro-Forma Quote",
    "PK12 & Bekoko Douala": "PK12 & Bekoko Douala",
    "Voir les 22 Articles": "View 22 Interior Products",
    "Horaires d'Ouverture": "Opening Hours",
    "Nom \/ Raison Sociale": "Full Name \/ Company Name",
    "Tarif HT \/ Pièce 2m": "Price Excl. Tax \/ 2m Piece",
    "Continuer mes achats": "Continue shopping",
    "Tôles & Couvertures": "Roofing Sheets & Coverings",
    "Services & Pro-Forma": "Services & Pro-Forma",
    "Envoyer une Demande": "Send an Inquiry",
    "Tradition 1976-2026": "Tradition 1976-2026",
    "Horaires de charge:": "Loading hours:",
    "Email Professionnel": "Work Email",
    "Email Facturation :": "Billing Email:",
    "Accessoires toiture": "Roofing Accessories",
    "Accessoires Toiture": "Roofing Accessories",
    "Quincaillerie & BTP": "Hardware & Construction",
    "mètres linéaires": "linear meters",
    "Mon Espace Client": "My Customer Account",
    "Langue \/ Language": "Language",
    "Conformité CEMAC": "CEMAC Compliance",
    "Siège & Usines :": "Headquarters & Factories:",
    "Vente au détail:": "Retail sales:",
    "Service Concerné": "Department \/ Service",
    "Tôles et toiture": "Roofing Sheets & Roofing",
    "Tôles et Toiture": "Roofing Sheets & Roofing",
    "Tôles & Toitures": "Roofing Sheets & Roofing",
    "Espace Devis B2B": "B2B Quote Portal",
    "Panier Pro-Forma": "Pro-Forma Quote",
    "Régime Fiscal :": "Tax Regime:",
    "Numéro WhatsApp": "WhatsApp Number",
    "Prix Unitaire HT": "Unit Price Excl. Tax",
    "mètre linéaire": "linear meter",
    "Chantiers & BTP": "Construction & Worksites",
    "Total HT (FCFA)": "Total Excl. Tax (FCFA)",
    "Spécifications": "Specifications",
    "Vider le panier": "Clear quote",
    "Sites & Accès": "Sites & Access",
    "En Stock Usine": "In Factory Stock",
    "SUPPORT DIRECT": "DIRECT SUPPORT",
    "Tarif Usine HT": "Factory Price Excl. Tax",
    "Total Ligne HT": "Line Total Excl. Tax",
    "Article & Réf": "Item & SKU",
    "Toiturole 900g": "Toiturole 900g Bitumen Felt",
    "Numéro NIU :": "Tax ID (TIN):",
    "COMPTOIR PK12": "PK12 TRADE COUNTER",
    "Devis sous 2h": "Quote within 2h",
    "Pont bascule:": "Weighbridge:",
    "L'Entreprise": "About Us",
    "PME Agréée": "Certified Enterprise",
    "USINE BEKOKO": "BEKOKO FACTORY",
    "+ TVA 19.25%": "+ 19.25% VAT",
    "Inclus Usine": "Factory Included",
    "Nos Produits": "Our Products",
    "Sacs PP 50kg": "50kg PP Bags",
    "Métallurgie": "Metallurgy",
    "Prélaquées": "Pre-painted",
    "Alu brillant": "Glossy Alu",
    "+ Pro-Forma": "+ Add to Quote",
    "+ PRO-FORMA": "+ ADD TO QUOTE",
    "Faîtières": "Ridge Caps",
    "Gouttières": "Gutters",
    "Galvanisée": "Galvanized",
    "Prélaquée": "Pre-painted",
    "Bleu Cendre": "Ash Blue",
    "Mon Panier": "My Cart",
    "Rechercher": "Search",
    "Disponible": "Available",
    "Faîtière": "Ridge Cap",
    "Gouttière": "Gutter",
    "Carrelages": "Tiles",
    "Plasturgie": "Plastics",
    "Galvanisé": "Galvanized",
    "Prélaqué": "Pre-painted",
    "Nervurées": "Ribbed",
    "Vert Olive": "Olive Green",
    "Catalogue": "Catalog",
    "Quantité": "Quantity",
    "Longueur:": "Length:",
    "Tirefonds": "Lag Screws",
    "Cavaliers": "Saddle Washers",
    "Carrelage": "Tile",
    "Ondulées": "Corrugated",
    "Nervurée": "Ribbed",
    "Chercher": "Search",
    "En Stock": "In Stock",
    "Couleur:": "Color:",
    "rouleaux": "rolls",
    "Tirefond": "Lag Screw",
    "Cavalier": "Saddle Washer",
    "Carreaux": "Tiles",
    "Ondulée": "Corrugated",
    "Nervuré": "Ribbed",
    "Accueil": "Home",
    "Contact": "Contact Us",
    "2 SITES": "2 SITES",
    "100% NC": "100% NC",
    "Dispo :": "Avail.:",
    "Actions": "Actions",
    "unités": "units",
    "boîtes": "boxes",
    "paquets": "packs",
    "rouleau": "roll",
    "pièces": "pieces",
    "Boulons": "Bolts",
    "Pointes": "Nails",
    "Ondulé": "Corrugated",
    "Bordeau": "Bordeaux",
    "50 ANS": "50 YEARS",
    "Action": "Action",
    "unité": "unit",
    "boîte": "box",
    "paquet": "pack",
    "pièce": "piece",
    "Tôles": "Roofing Sheets",
    "Boulon": "Bolt",
    "Pointe": "Nail",
    "Tôle": "Roofing Sheet",
    "Rives": "Bargeboards",
    "Noues": "Valleys",
    "Rouge": "Red",
    "lots": "batches",
    "Rive": "Bargeboard",
    "Noue": "Valley",
    "Oui": "Yes",
    "Non": "No",
    "lot": "batch"
};

    // Dictionnaire inverse (Anglais -> Français)
    const REVERSE_DICTIONARY = {};
    for (const [fr, en] of Object.entries(DICTIONARY)) {
        REVERSE_DICTIONARY[en] = fr;
    }

    // Récupérer les paires de traduction
    function getSortedPairs(targetLang) {
        const sourceDict = (targetLang === 'en') ? DICTIONARY : REVERSE_DICTIONARY;
        return Object.entries(sourceDict).sort((a, b) => b[0].length - a[0].length);
    }

    function getActiveLanguage() {
        return localStorage.getItem(STORAGE_KEY) || DEFAULT_LANG;
    }

    function setActiveLanguage(lang) {
        localStorage.setItem(STORAGE_KEY, lang);
        document.cookie = STORAGE_KEY + '=' + lang + ';path=/;max-age=31536000;SameSite=Lax';
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

    // Traduction exhaustive récursive de tous les éléments du DOM
    function translateEntireDOM(targetLang) {
        const pairs = getSortedPairs(targetLang);

        function replaceMultiPass(str) {
            if (!str || typeof str !== 'string') return str;
            let result = str;

            for (let i = 0; i < pairs.length; i++) {
                const [from, to] = pairs[i];
                if (result.includes(from)) {
                    result = result.split(from).join(to);
                }
            }
            return result;
        }

        // Parcours de tous les nœuds de texte visibles
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
                    if (parent.classList.contains('material-symbols-outlined')) {
                        return NodeFilter.FILTER_REJECT;
                    }
                    if (parent.classList.contains('cart-badge-count')) {
                        return NodeFilter.FILTER_REJECT;
                    }
                    return NodeFilter.FILTER_ACCEPT;
                }
            }
        );

        let node;
        const textNodes = [];
        while ((node = walker.nextNode())) {
            textNodes.push(node);
        }

        textNodes.forEach(textNode => {
            const original = textNode.nodeValue;
            const updated = replaceMultiPass(original);
            if (updated !== original) {
                textNode.nodeValue = updated;
            }
        });

        // Traduction de toutes les options de select
        const options = document.querySelectorAll('option');
        options.forEach(opt => {
            const tr = replaceMultiPass(opt.textContent);
            if (tr !== opt.textContent) opt.textContent = tr;
        });

        // Traduction des boutons submit / input
        const submitInputs = document.querySelectorAll('input[type="submit"], input[type="button"]');
        submitInputs.forEach(btn => {
            if (btn.value) {
                const tr = replaceMultiPass(btn.value);
                if (tr !== btn.value) btn.value = tr;
            }
        });

        // Traduction des placeholders et titres
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(el => {
            if (el.placeholder) {
                const tr = replaceMultiPass(el.placeholder);
                if (tr !== el.placeholder) el.placeholder = tr;
            }
            if (el.title) {
                const tr = replaceMultiPass(el.title);
                if (tr !== el.title) el.title = tr;
            }
        });

        const titledElements = document.querySelectorAll('[title], [aria-label], [alt]');
        titledElements.forEach(el => {
            if (el.title) {
                const tr = replaceMultiPass(el.title);
                if (tr !== el.title) el.title = tr;
            }
            if (el.getAttribute('aria-label')) {
                const tr = replaceMultiPass(el.getAttribute('aria-label'));
                if (tr !== el.getAttribute('aria-label')) el.setAttribute('aria-label', tr);
            }
            if (el.alt) {
                const tr = replaceMultiPass(el.alt);
                if (tr !== el.alt) el.alt = tr;
            }
        });
    }

    // Fonction globale pour commuter la langue
    window.setTPMLanguage = function (lang) {
        if (lang !== 'fr' && lang !== 'en') lang = 'fr';
        setActiveLanguage(lang);
        updateButtonsUI(lang);
        translateEntireDOM(lang);
        window.dispatchEvent(new CustomEvent('tpm_language_changed', { detail: { lang } }));
    };

    // Exécution au chargement du DOM
    document.addEventListener('DOMContentLoaded', function () {
        const initialLang = getActiveLanguage();

        // Écouteur sur tous les boutons data-lang-btn
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
            translateEntireDOM('en');
        }
    });

})();