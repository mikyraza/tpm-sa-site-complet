/**
 * TPM SA (Groupe CAC) - Moteur Bilingue Ultra-Rapide (i18n)
 * Performance O(1) Hash Map (temps d'exécution < 1ms, zéro lag, zéro freeze).
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'tpm_site_lang';
    const DEFAULT_LANG = 'fr';

    const DICT_FR_TO_EN = {
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