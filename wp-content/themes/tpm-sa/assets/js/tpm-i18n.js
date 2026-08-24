/**
 * TPM SA (Groupe CAC) - Moteur Bilingue Universel avec Cache Textuel d'Origine
 * Garantie de traduction bidirectionnelle parfaite sans aucun mélange ni corruption.
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'tpm_site_lang';
    const DEFAULT_LANG = 'fr';

    // Dictionnaire bilingue maître trié par longueur décroissante
    const DICT_FR_TO_EN = {
    "Pionnier de la transformation industrielle en Afrique Centrale, TPM SA (Groupe CAC) fabrique des tôles BAC haute résistance, des faîtières & accessoires de toiture, des sacs tissés en polypropylène et distribue des matériaux de second œuvre pour les grands chantiers BTP et le secteur commercial.": "A pioneer of industrial manufacturing in Central Africa, TPM SA (CAC Group) manufactures high-strength BAC roofing sheets, ridge caps & roofing accessories, woven polypropylene bags, and distributes finishing materials for major construction projects and the commercial sector.",
    "Depuis 1976, TPM SA fabrique et approvisionne les plus grands chantiers BTP, quincailleries et entreprises du Cameroun et de la zone CEMAC en Tôles BAC prélaquées 0.50mm, accessoires de toiture, Sacs PP tissés et carrelage.": "Since 1976, TPM SA manufactures and supplies the largest construction sites, hardware stores, and enterprises across Cameroon and the CEMAC zone with 0.50mm pre-painted BAC roofing sheets, roofing accessories, woven PP bags, and tiles.",
    "Nos installations sont conçues pour accueillir des véhicules de grand gabarit afin de faciliter vos approvisionnements en matériaux de construction et structures métalliques.": "Our facilities are engineered to accommodate heavy-duty vehicles for seamless loading of construction materials and steel structures.",
    "Leader camerounais dans le profilage de tôles BAC prélaquées, la fabrication de fixations industrielles, l'extrusion de sacs PP et le zingage unique en Afrique Centrale.": "Cameroonian leader in pre-painted BAC roofing sheets profiling, industrial fasteners manufacturing, PP bag extrusion, and specialized hot-dip galvanizing in Central Africa.",
    "Vous n'avez pas encore ajouté d'articles à votre devis. Explorez notre catalogue pour composer votre sélection de tôles, accessoires ou fixations.": "You haven't added items to your quote yet. Explore our catalog to select roofing sheets, accessories, or fasteners.",
    "Faîtière de couronnement double pente alu et prélaquée haute précision, replis anti-goutte étanches et profilage 2 mètres pour toitures.": "High-precision double-slope aluminium and pre-painted capping ridge with watertight anti-drip folds for 2-meter roofs.",
    "Sacs en Polypropylène (PP) tissé ultra-résistants pour emballage de ciment, sable, gravier, produits agricoles et agro-industriels 50kg.": "Ultra-resistant woven polypropylene (PP) bags for packaging cement, sand, gravel, agricultural, and industrial products 50kg.",
    "Bande bitumineuse adhésive renforcée aluminium pour solins de toiture, arêtes de faîtage et joints d'étanchéité haute température.": "Aluminium-reinforced adhesive bitumen strip for roof flashings, ridge edges, and high-temperature watertight joints.",
    "Tôle BAC profilée en acier galvanisé prélaqué haute durabilité 0.50mm selon nuancier officiel RAL 3005, ondulée BTP et calepinée.": "High-durability 0.50mm pre-painted galvanized steel BAC sheet according to official RAL 3005 color chart, corrugated and custom-sized.",
    "Tirefonds complets comprenant vis auto-foreuse haute charge 6x80mm zinguée avec cavaliers aluminium et rondelles d'étanchéité EPDM.": "Complete lag screws with heavy-duty zinc-plated 6x80mm self-drilling screws, aluminium saddles, and EPDM sealing washers.",
    "Demandes de devis sur mesure, suivi de production et enlèvement de commandes. Nos équipes industrielles sont à votre disposition.": "Custom quote requests, production monitoring, and order pickups. Our industrial teams are at your service.",
    "Faîtières crantées double pente, faîtières non crantées, rives alu, gouttières étanches et noues façonnées en atelier.": "Notched double-slope ridge caps, plain ridge caps, aluminium bargeboards, watertight gutters, and workshop valleys.",
    "Tirefonds complets 6x80\/6x100, cavaliers alu néoprène, rouleaux bitumés Toiturole 900G et vis auto-foreuses zinguées.": "Complete 6x80\/6x100 lag screws, neoprene aluminium saddles, Toiturole 900G bitumen rolls, and zinc-plated self-drilling screws.",
    "Sacs PP tissés 50kg\/25kg usine Bekoko, carrelages grès cérame italien\/espagnol, douches sanitaires et second œuvre.": "Woven PP 50kg\/25kg bags Bekoko factory, Italian\/Spanish porcelain stoneware tiles, sanitary showers, and finishing works.",
    "Tôle BAC aluminium prélaqué 0.50mm, profilage ondulé, nervuré D50\/B30 et découpes sur mesure selon nuancier RAL.": "0.50mm pre-painted aluminium BAC sheet, corrugated and ribbed D50\/B30 profiles with custom cuts.",
    "Prestations industrielles d'électro-zingage 800 VA, outillage de couverture, quincaillerie lourde et chantiers BTP.": "800 VA industrial electro-galvanizing services, roofing tools, heavy hardware, and construction sites.",
    "Fabrication directe sur nos sites de Bekoko et PK12 selon les normes de solidité les plus strictes au Cameroun.": "Direct manufacturing at our Bekoko and PK12 sites adhering to Cameroon's highest structural standards.",
    "Remplissez le formulaire ci-dessous pour une prise en charge rapide par nos équipes techniques ou commerciales.": "Fill in the form below for rapid assistance from our technical or sales teams.",
    "Fixations complètes à tirefonds, cavaliers étanches, rouleaux bitumés Toiturole 900G et vis auto-foreuses.": "Complete lag screw fixings, waterproof saddles, Toiturole 900G bitumen rolls, and self-drilling screws.",
    "Une capacité industrielle combinée unique au Cameroun pour répondre aux exigences des plus grands projets.": "A unique combined industrial capacity in Cameroon meeting the highest requirements of major projects.",
    "Commandes au mètre linéaire sur-mesure pour tôles BAC, emballages PP tissés et tarification dégressive.": "Custom cut-to-length orders for roofing sheets, woven PP sacks, and tiered volume pricing.",
    "Profilage nervuré haute résistance avec revêtement multicouche anti-UV et anti-corrosion tropicale.": "High-strength ribbed profile with multi-layer anti-UV and tropical anti-corrosion coating.",
    "Faîtières double pente, faîtières crantées, demi-rives, rives, gouttières et noues sur-mesure.": "Double-slope ridge caps, notched ridge caps, half-ridges, bargeboards, gutters, and custom valleys.",
    "Carrelage grès cérame italien et espagnol pour sols et murs, douches thérapeutiques Zagonel.": "Italian and Spanish porcelain stoneware tiles for floors and walls, Zagonel therapeutic showers.",
    "Gamme d'emballages en sacs tissés en PP (50kg, 25kg, ciment, agroalimentaire et industrie).": "Range of woven PP bag packaging (50kg, 25kg, cement, agrifood, and industrial).",
    "Joignez directement le département adapté à votre demande pour un traitement express.": "Contact the appropriate department directly for express processing.",
    "Nos conseillers techniques sont disponibles sur WhatsApp pour une assistance directe.": "Our technical advisors are available on WhatsApp for direct assistance.",
    "Nos équipes technico-commerciales sont prêtes à étudier vos cahiers des charges.": "Our technical and sales teams are ready to analyze your project specifications.",
    "Rechercher un article (ex: Tôle BAC 0.50mm, Faîtière, Sac PP 50kg, Vis 6×80…)": "Search for an item (e.g. 0.50mm Roofing Sheet, Ridge Cap, 50kg PP Bag, 6×80 Screw…)",
    "Nos ingénieurs d'études chiffrent vos bordereaux de toiture sous 2 heures.": "Our structural engineers calculate your roofing schedules within 2 hours.",
    "LE LEADER DE LA MÉTALLURGIE &amp; DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
    "LE LEADER DE LA MÉTALLURGIE & DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
    "\"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ\"": "\"SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEED DURABILITY\"",
    "50 Ans d'Excellence Métallurgique &amp; de Plasturgie au Cameroun.": "50 Years of Metallurgical & Plastics Excellence in Cameroon.",
    "Besoin d'une Facture Pro-Forma officielle ou d'une cotation B2B ?": "Need an official Pro-Forma invoice or B2B quote?",
    "Une transparence totale pour vos déductions de TVA et audits BTP": "Total transparency for your VAT deductions and construction audits",
    "50 Ans d'Excellence Métallurgique & de Plasturgie au Cameroun.": "50 Years of Metallurgical & Plastics Excellence in Cameroon.",
    "50 ans d'engagement pour l'autonomie productive du Cameroun": "50 years of commitment to Cameroon's industrial self-reliance",
    "✔ Conforme à la réglementation fiscale du Cameroun": "✔ Fully compliant with Cameroon tax regulations",
    "Document Pro-Forma Officiel B2B — Valable 30 Jours": "Official B2B Pro-Forma Document — Valid 30 Days",
    "Document Pro-Forma Officiel B2B - Valable 30 Jours": "Official B2B Pro-Forma Document - Valid 30 Days",
    "Plans, bordereaux de métrés ou fiches techniques": "Blueprints, quantity schedules or technical datasheets",
    "Télécharger les Certificats Fiscaux & Documents": "Download Fiscal Certificates & Documents",
    "USINE MÉTALLURGIQUE &amp; PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
    "Cliquez ou glissez vos fichiers ici (Max 10MB)": "Click or drag your files here (Max 10MB)",
    "Ajustement immédiat des devis usine en 2 min": "Instant factory quote calculation in 2 min",
    "2 Sites de Production Stratégiques à Douala": "2 Strategic Production Sites in Douala",
    "CONTACT & GÉOLOCALISATION DE L'USINE TPM SA": "CONTACT & GEOLOCATION OF TPM SA FACTORY",
    "Votre Panier Pro-Forma est actuellement vide": "Your Pro-Forma Quote is currently empty",
    "Consulter l'Inventaire Complet (58 Articles)": "Browse Full Inventory (58 Products)",
    "USINE MÉTALLURGIQUE & PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
    "58 Références Industrielles Direct Usine": "58 Direct Factory Industrial References",
    "Télécharger le Catalogue Général (PDF)": "Download General Catalog (PDF)",
    "Ex: Tôle bac alu, faîtière, tirefond...": "E.g.: Alu roofing sheet, ridge cap, lag screw...",
    "Conception Industrielle & Numérique CEMAC": "CEMAC Industrial & Digital Design",
    "Expéditions Grand Nord & CEMAC : 24h\/48h": "Grand North & CEMAC Dispatch: 24h\/48h",
    "Nos 4 Domaines d'Activité Industrielle": "Our 4 Industrial Activity Sectors",
    "Nos 6 Domaines d'Activité Industrielle": "Our Industrial Activity Sectors",
    "L'Éventail de nos Lignes de Production": "Our Production Lines Overview",
    "Consulter les 58 références usine TPM": "Browse all 58 TPM factory references",
    "FONDÉ PAR M. NJIPNGANG • DEPUIS 1976": "FOUNDED BY MR. NJIPNGANG • SINCE 1976",
    "Comptoir PK12 : Lun - Sam 08h00 - 17h00": "PK12 Counter: Mon - Sat 08:00 AM - 05:00 PM",
    "Ouvrir l'Itinéraire GPS (Google Maps)": "Open GPS Directions (Google Maps)",
    "Usine Bekoko : Lun - Ven 07h30 - 18h00": "Bekoko Factory: Mon - Fri 07:30 AM - 06:00 PM",
    "CONTACT & GÉOLOCALISATION DE L'USINE": "CONTACT & FACTORY GEOLOCATION",
    "Bureau d'Études & Calepinage Toiture": "Engineering & Roofing Layout",
    "Logistique & Enlèvement Usine Bekoko": "Logistics & Factory Pickup Bekoko",
    "Générer mon Devis Pro-Forma Direct": "Generate Instant Pro-Forma Quote",
    "Télécharger Fiche Entreprise (PDF)": "Download Company Profile (PDF)",
    "Accessoires Intérieurs & Plasturgie": "Interior Accessories & Plastics",
    "Articles Phares Disponible en Stock": "Featured Products Available in Stock",
    "Voir les 22 articles intérieurs »": "View all 22 interior items »",
    "Approvisionnement Gros Chantier BTP": "Major Construction Site Supply",
    "VOTRE FACTURE PRO-FORMA OFFICIELLE": "YOUR OFFICIAL PRO-FORMA INVOICE",
    "CAPACITÉS & GAMMES DE FABRICATION": "MANUFACTURING CAPACITIES & RANGES",
    "Transmettre au Commercial WhatsApp": "Send to WhatsApp Sales Representative",
    "NIU (Numéro d'Identifiant Unique)": "TIN (Taxpayer Identification Number)",
    "Pièces Jointes (PDF, DWG, Images)": "Attachments (PDF, DWG, Images)",
    "Gouvernance & Conformité Fiscale": "Governance & Fiscal Compliance",
    "Prêt à Collaborer avec TPM SA ?": "Ready to Partner with TPM SA?",
    "Contacter la Direction Générale": "Contact Executive Management",
    "Continuer vos ajouts au catalogue": "Continue adding items from catalog",
    "Accessoires Intérieurs & Sacs PP": "Interior Accessories & PP Bags",
    "Catalogue Général (58 Articles)": "General Catalog (58 Items)",
    "Télécharger ma Pro-Forma (PDF)": "Download Pro-Forma (PDF)",
    "Télécharger le Catalogue (PDF)": "Download Catalog (PDF)",
    "Numéro NIU \/ N° Contribuable :": "Tax ID (TIN):",
    "Message \/ Détails de la demande": "Message \/ Request Details",
    "Faîtières, Rives & Gouttières": "Ridge Caps, Bargeboards & Gutters",
    "Station Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA Station",
    "Approvisionnement Chantiers BTP": "Construction Worksite Supply",
    "Enlèvement véhicules légers:": "Light vehicle pickup:",
    "Besoin d'un Devis Sur Mesure ?": "Need a Custom Quote?",
    "Explorer le Catalogue Officiel": "Explore Official Catalog",
    "ENVOYER MON MESSAGE À L'USINE": "SEND MY MESSAGE TO THE FACTORY",
    "Paiement Sécurisé \/ Virement": "Secure Payment \/ Bank Transfer",
    "Nom de l'Entreprise \/ Client :": "Company \/ Customer Name:",
    "Lieu de Livraison \/ Chantier :": "Delivery Location \/ Site:",
    "Logistique & Enlèvement Usine": "Logistics & Factory Pickup",
    "Fixations Complètes & Pointes": "Complete Fasteners & Nails",
    "Voir le Catalogue Tôles PK12": "View PK12 Roofing Catalog",
    "GÉNÉRER MA PRO-FORMA EN PDF": "GENERATE PRO-FORMA PDF",
    "Valider la Commande Usine →": "Confirm Factory Order →",
    "Bureau d'Études \/ Calepinage": "Engineering & Roofing Layout",
    "Quincaillerie & Outillage BTP": "Hardware & Construction Tools",
    "USINE HISTORIQUE N°1 (PK12)": "HISTORIC FACTORY #1 (PK12)",
    "Commercial & Devis Pro-Forma": "Sales & Pro-Forma Quotes",
    "PÔLES DE PRODUCTION TPM SA": "TPM SA PRODUCTION HUBS",
    "Nos Canaux de Communication": "Our Communication Channels",
    "Notre Histoire Industrielle": "Our Industrial History",
    "Explorer le Catalogue Usine": "Explore Factory Catalog",
    "Support WhatsApp Commercial": "Commercial WhatsApp Support",
    "Mettre à jour la Pro-Forma": "Update Pro-Forma",
    "Sélectionnez un service...": "Select a department...",
    "contact@votre-entreprise.cm": "contact@your-company.cm",
    "Ex: Entreprise BTP Cameroun": "E.g.: Cameroon Construction Ltd",
    "Sacs PP Blancs 50kg \/ 100kg": "White PP Bags 50kg \/ 100kg",
    "Accès Poids Lourds Garanti": "Heavy Duty Truck Access Guaranteed",
    "GÉNÉRATEUR PRO-FORMA B2B": "B2B PRO-FORMA GENERATOR",
    "Coordonnées de l'Acheteur": "Buyer \/ Company Details",
    "WhatsApp Commercial Direct": "Direct Commercial WhatsApp",
    "Voir les 17 accessoires »": "View all 17 accessories »",
    "Fixations et étanchéité": "Fasteners & Waterproofing",
    "Demande de Pro-Forma Flash": "Flash Pro-Forma Request",
    "Accès Poids Lourds Ouvert": "Heavy Duty Truck Access Open",
    "CATALOGUE OFFICIEL TPM SA": "OFFICIAL TPM SA CATALOG",
    "Valider la Commande Usine": "Confirm Factory Order",
    "Tarif HT \/ Boîte 100 pcs": "Price Excl. Tax \/ Box 100 pcs",
    "Fixations & Étanchéité": "Fasteners & Waterproofing",
    "Fixations & étanchéité": "Fasteners & Waterproofing",
    "Carrelages & Revêtements": "Tiles & Floor Coverings",
    "Localiser l'Usine Bekoko": "Locate Bekoko Factory",
    "Localiser le Site Bekoko": "Locate Bekoko Site",
    "Mettre à jour le panier": "Update Cart",
    "Voir les 10 fixations »": "View all 10 fasteners »",
    "Voir les Carreaux & Sols": "View Tiles & Floors",
    "SÉLECTIONNER UN ARTICLE": "SELECT AN ITEM",
    "Téléphone \/ WhatsApp :": "Phone \/ WhatsApp:",
    "Rechercher un produit...": "Search for a product...",
    "Tôles & Couvertures BAC": "Roofing Sheets & BAC Coverings",
    "Carreaux & Emballages PP": "Tiles & PP Packaging",
    "INVENTAIRE DIRECT USINE": "DIRECT FACTORY INVENTORY",
    "FLASH PRO-FORMA EXPRESS": "FLASH PRO-FORMA EXPRESS",
    "Décompte Financier B2B": "B2B Financial Summary",
    "Générer une Pro-Forma": "Generate Pro-Forma",
    "Ajouter à la Pro-Forma": "Add to Pro-Forma",
    "Voir les 10 Tôles Bacs": "View 10 Roofing Sheets",
    "Voir les 17 Accessoires": "View 17 Accessories",
    "Voir les Sacs PP Bekoko": "View Bekoko PP Bags",
    "Longueur personnalisée": "Custom Length",
    "Découpe au Centimètre": "Cut to Centimeter",
    "PÔLE N°1 • 10 RÉF.": "SECTOR #1 • 10 ITEMS",
    "PÔLE N°2 • 17 RÉF.": "SECTOR #2 • 17 ITEMS",
    "PÔLE N°3 • 10 RÉF.": "SECTOR #3 • 10 ITEMS",
    "PÔLE N°4 • 22 RÉF.": "SECTOR #4 • 22 ITEMS",
    "Total des articles HT :": "Items Subtotal Excl. Tax:",
    "TVA Cameroun (19.25%) :": "Cameroon VAT (19.25%):",
    "Articles Sélectionnés": "Selected Items",
    "Accessoires intérieurs": "Interior Accessories & Bags",
    "Emballages & Plastiques": "Packaging & Plastics",
    "Carreaux & Revêtements": "Tiles & Floor Coverings",
    "Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA",
    "Tous droits réservés.": "All rights reserved.",
    "Zone Bekoko (1 500 m²)": "Bekoko Zone (1,500 m²)",
    "SÉLECTION D'ACTIVITÉ": "CATEGORY SELECTION",
    "CONTACTER SUR WHATSAPP": "CONTACT ON WHATSAPP",
    "Générer ma Pro-Forma": "Generate Pro-Forma",
    "Connexion \/ Mon Compte": "Login \/ My Account",
    "Livraison Rapide CEMAC": "Fast CEMAC Delivery",
    "COMPLEXE N°2 (BEKOKO)": "INDUSTRIAL COMPLEX #2 (BEKOKO)",
    "Tarif HT \/ m linéaire": "Price Excl. Tax \/ lin. meter",
    "Tarif HT \/ Rouleau 10m": "Price Excl. Tax \/ 10m Roll",
    "Tarif HT \/ Lot 500 pcs": "Price Excl. Tax \/ Pack 500 pcs",
    "Frais de Manutention :": "Handling Charges:",
    "Accessoires de Toiture": "Roofing Accessories",
    "Tôles BAC & Ondulées": "Roofing Sheets & Corrugated",
    "Lun-Ven: 07h30 - 18h00": "Mon-Fri: 07:30 AM - 06:00 PM",
    "Lun-Sam: 08h00 - 17h00": "Mon-Sat: 08:00 AM - 05:00 PM",
    "Demander un Devis B2B": "Request B2B Quote",
    "Accéder au Catalogue": "Browse Catalog",
    "Voir les 10 Fixations": "View 10 Fasteners",
    "Voir les 10 tôles »": "View all 10 roofing sheets »",
    "Voir la Quincaillerie": "View Hardware",
    "Épaisseur Certifiée": "Certified Thickness",
    "Usines: PK12 & Bekoko": "Factories: PK12 & Bekoko",
    "TOTAL GÉNÉRAL TTC :": "GRAND TOTAL INCL. TAX:",
    "Article \/ Référence": "Item \/ Reference",
    "Carreaux & Sanitaires": "Tiles & Sanitaryware",
    "Accès camions > 12m:": "Truck access > 12m:",
    "Services & Pro-Forma": "Services & Pro-Forma",
    "Horaires d'Ouverture": "Opening Hours",
    "Mon Panier Pro-Forma": "My Pro-Forma Quote",
    "Continuer mes achats": "Continue shopping",
    "Voir les 22 Articles": "View 22 Interior Products",
    "PK12 & Bekoko Douala": "PK12 & Bekoko Douala",
    "Tarif HT \/ Pièce 2m": "Price Excl. Tax \/ 2m Piece",
    "Nom \/ Raison Sociale": "Full Name \/ Company Name",
    "Tôles & Couvertures": "Roofing Sheets & Coverings",
    "Envoyer une Demande": "Send an Inquiry",
    "Informations Usines": "Factory Information",
    "Détails du Produit": "Product Details",
    "Tradition 1976-2026": "Tradition 1976-2026",
    "Email Professionnel": "Work Email",
    "Email Facturation :": "Billing Email:",
    "Accessoires toiture": "Roofing Accessories",
    "Accessoires Toiture": "Roofing Accessories",
    "Quincaillerie & BTP": "Hardware & Construction",
    "Horaires de charge:": "Loading hours:",
    "Ex: M052217435713Q": "E.g.: M052217435713Q",
    "mètres linéaires": "linear meters",
    "Mon Espace Client": "My Customer Account",
    "Ajouter au Panier": "Add to Cart",
    "Conformité CEMAC": "CEMAC Compliance",
    "Service Concerné": "Department \/ Service",
    "Tôles et toiture": "Roofing Sheets & Roofing",
    "Tôles et Toiture": "Roofing Sheets & Roofing",
    "Tôles & Toitures": "Roofing Sheets & Roofing",
    "Vente au détail:": "Retail sales:",
    "Espace Devis B2B": "B2B Quote Portal",
    "Panier Pro-Forma": "Pro-Forma Quote",
    "Prix Unitaire HT": "Unit Price Excl. Tax",
    "Numéro WhatsApp": "WhatsApp Number",
    "mètre linéaire": "linear meter",
    "Vider le panier": "Clear quote",
    "Voir le produit": "View product",
    "Fiche Technique": "Technical Specs",
    "Total HT (FCFA)": "Total Excl. Tax (FCFA)",
    "Spécifications": "Specifications",
    "Sites & Accès": "Sites & Access",
    "En Stock Usine": "In Factory Stock",
    "Tarif Usine HT": "Factory Price Excl. Tax",
    "Total Ligne HT": "Line Total Excl. Tax",
    "Article & Réf": "Item & SKU",
    "SUPPORT DIRECT": "DIRECT SUPPORT",
    "COMPTOIR PK12": "PK12 TRADE COUNTER",
    "Devis sous 2h": "Quote within 2h",
    "Pont bascule:": "Weighbridge:",
    "Nos Produits": "Our Products",
    "PME Agréée": "Certified Enterprise",
    "+ TVA 19.25%": "+ 19.25% VAT",
    "Inclus Usine": "Factory Included",
    "USINE BEKOKO": "BEKOKO FACTORY",
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
    "PÔLE N°1": "SECTOR #1",
    "PÔLE N°2": "SECTOR #2",
    "PÔLE N°3": "SECTOR #3",
    "PÔLE N°4": "SECTOR #4",
    "PÔLE N°5": "SECTOR #5",
    "PÔLE N°6": "SECTOR #6",
    "Disponible": "Available",
    "Faîtière": "Ridge Cap",
    "Gouttière": "Gutter",
    "Carrelages": "Tiles",
    "Plasturgie": "Plastics",
    "Galvanisé": "Galvanized",
    "Prélaqué": "Pre-painted",
    "Nervurées": "Ribbed",
    "Vert Olive": "Olive Green",
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

    // Table ordonnée pour remplacement multi-passe
    const SORTED_PAIRS = Object.entries(DICT_FR_TO_EN).sort((a, b) => b[0].length - a[0].length);

    // Dépôt de mémoire pour conserver le texte original (Français natif serveur)
    const originalTextMap = new WeakMap();
    const originalAttrMap = new WeakMap();

    function getActiveLanguage() {
        return localStorage.getItem(STORAGE_KEY) || DEFAULT_LANG;
    }

    function setActiveLanguage(lang) {
        localStorage.setItem(STORAGE_KEY, lang);
        document.cookie = STORAGE_KEY + '=' + lang + ';path=/;max-age=31536000;SameSite=Lax';
    }

    function translateStringToEN(str) {
        if (!str || typeof str !== 'string') return str;
        let result = str;
        for (let i = 0; i < SORTED_PAIRS.length; i++) {
            const [fr, en] = SORTED_PAIRS[i];
            if (result.includes(fr)) {
                result = result.split(fr).join(en);
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

        // Mettre à jour le libellé du Panier Pro-Forma
        const cartBadgeEl = document.querySelector('.cart-badge-count');
        const count = cartBadgeEl ? cartBadgeEl.textContent.trim() : '0';
        const cartLabels = document.querySelectorAll('.cart-button-label');
        cartLabels.forEach(el => {
            el.innerHTML = isEn ? ('My Pro-Forma Quote (<span class="cart-badge-count">' + count + '</span>)') : ('Mon Panier Pro-Forma (<span class="cart-badge-count">' + count + '</span>)');
        });
    }

    // Capture et initialisation de l'état français original
    function snapshotOriginals() {
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
            if (!originalTextMap.has(node)) {
                originalTextMap.set(node, node.nodeValue);
            }
        }

        // Éléments avec attributs
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

    // Appliquer la traduction à partir du texte français original pur
    function applyTranslation(targetLang) {
        snapshotOriginals();

        const isEn = (targetLang === 'en');

        // Traduction des nœuds de texte
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
            const rawFR = originalTextMap.get(node);
            if (rawFR !== undefined) {
                node.nodeValue = isEn ? translateStringToEN(rawFR) : rawFR;
            }
        }

        // Traduction des options, boutons et attributs
        const elements = document.querySelectorAll('input, textarea, select, option, button, [title], [aria-label], [alt]');
        elements.forEach(el => {
            const snap = originalAttrMap.get(el);
            if (snap) {
                if (snap.text !== null && el.tagName === 'OPTION') {
                    el.textContent = isEn ? translateStringToEN(snap.text) : snap.text;
                }
                if (snap.value !== null) {
                    el.value = isEn ? translateStringToEN(snap.value) : snap.value;
                }
                if (snap.placeholder !== null) {
                    el.placeholder = isEn ? translateStringToEN(snap.placeholder) : snap.placeholder;
                }
                if (snap.title !== null) {
                    el.title = isEn ? translateStringToEN(snap.title) : snap.title;
                }
                if (snap.ariaLabel !== null) {
                    el.setAttribute('aria-label', isEn ? translateStringToEN(snap.ariaLabel) : snap.ariaLabel);
                }
                if (snap.alt !== null) {
                    el.alt = isEn ? translateStringToEN(snap.alt) : snap.alt;
                }
            }
        });
    }

    // Commutation globale de langue
    window.setTPMLanguage = function (lang) {
        if (lang !== 'fr' && lang !== 'en') lang = 'fr';
        setActiveLanguage(lang);
        updateButtonsUI(lang);
        applyTranslation(lang);
        window.dispatchEvent(new CustomEvent('tpm_language_changed', { detail: { lang } }));
    };

    // Initialisation au chargement de la page
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
            applyTranslation('en');
        }

        // Observer les ajouts dynamiques (panier, filtres)
        if (window.MutationObserver && document.body) {
            const observer = new MutationObserver(function (mutations) {
                let hasNew = false;
                for (let i = 0; i < mutations.length; i++) {
                    if (mutations[i].addedNodes && mutations[i].addedNodes.length > 0) {
                        hasNew = true;
                        break;
                    }
                }
                if (hasNew) {
                    const currentLang = getActiveLanguage();
                    if (currentLang === 'en') {
                        applyTranslation('en');
                    }
                }
            });
            observer.observe(document.body, { childList: true, subtree: true });
        }
    });

})();