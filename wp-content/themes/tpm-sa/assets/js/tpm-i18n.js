/**
 * TPM SA (Groupe CAC) - Moteur Bilingue Français / Anglais (i18n)
 * Traduction intégrale temps réel (Header, Cards, Footer, Panier Pro-Forma, Boutique).
 * Par défaut : Français (FR). Clic sur switch -> Anglais (EN).
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'tpm_site_lang';
    const DEFAULT_LANG = 'fr';

    // Dictionnaire bilingue complet (Français <-> Anglais)
    // Toutes les chaînes sont avec caractères standards (&, ', -, –)
    const DICTIONARY = {
        // --- 1. HEADER & TOPBAR ---
        "TPM SA — Douala PK12 & Bekoko": "TPM SA — Douala PK12 & Bekoko",
        "NIU : M052217435713Q": "TIN: M052217435713Q",
        "Mon Espace Client": "My Customer Account",
        "Connexion / Mon Compte": "Login / My Account",
        "Espace Devis B2B": "B2B Quote Portal",
        "Support WhatsApp Commercial": "Commercial WhatsApp Support",
        "Accueil": "Home",
        "L'Entreprise": "About Us",
        "Catalogue": "Catalog",
        "Contact": "Contact Us",
        "Mon Panier Pro-Forma": "My Pro-Forma Quote",
        "Rechercher": "Search",
        "Chercher": "Search",
        "Chantiers & BTP": "Construction & Worksites",
        "Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA",
        "Langue / Language": "Language",
        "Rechercher un article (ex: Tôle BAC 0.50mm, Faîtière, Sac PP 50kg, Vis 6×80…)": "Search for an item (e.g. 0.50mm Roofing Sheet, Ridge Cap, 50kg PP Bag, 6×80 Screw…)",
        "Rechercher un produit...": "Search for a product...",
        "Ex: Tôle bac alu, faîtière, tirefond...": "E.g.: Alu roofing sheet, ridge cap, lag screw...",

        // --- 2. MEGA MENU & CATEGORIES ---
        "Tôles et toiture": "Roofing Sheets & Roofing",
        "Tôles & Toitures": "Roofing Sheets & Roofing",
        "Tôles & Couvertures": "Roofing Sheets & Coverings",
        "Tôles & Couvertures BAC": "Roofing Sheets & BAC Coverings",
        "Accessoires toiture": "Roofing Accessories",
        "Accessoires de Toiture": "Roofing Accessories",
        "Accessoires Toiture": "Roofing Accessories",
        "Fixations et étanchéité": "Fasteners & Waterproofing",
        "Fixations & Étanchéité": "Fasteners & Waterproofing",
        "Accessoires intérieurs": "Interior Accessories & Bags",
        "Accessoires Intérieurs & Sacs PP": "Interior Accessories & PP Bags",
        "Carreaux & Emballages PP": "Tiles & PP Packaging",
        "Emballages & Plastiques": "Packaging & Plastics",
        "Carrelages & Revêtements": "Tiles & Floor Coverings",
        "Quincaillerie & BTP": "Hardware & Construction",
        "Tous les articles": "All Products",
        "Toutes les catégories": "All Categories",
        "Coloris RAL Disponibles :": "Available RAL Colors:",
        "Voir les 10 tôles »": "View all 10 roofing sheets »",
        "Voir les 17 accessoires »": "View all 17 accessories »",
        "Voir les 10 fixations »": "View all 10 fasteners »",
        "Voir les 22 articles intérieurs »": "View all 22 interior items »",
        "Prestations Industrielles & Gros Volumes": "Industrial Services & Bulk Volumes",
        "Station Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA Station",
        "Traitement anticorrosion par électrolyse pour armatures": "Electrolytic anti-corrosion treatment for metal frames",
        "Approvisionnement Chantiers BTP": "Construction Worksite Supply",
        "Logistique lourde et livraisons sur site CEMAC": "Heavy logistics and on-site delivery across CEMAC",
        "Consulter l'Inventaire Complet (58 Articles)": "Browse Full Inventory (58 Products)",
        "Catalogue Général (58 Articles)": "General Catalog (58 Items)",

        // --- 3. HOMEPAGE HERO & FLASH PRO-FORMA ---
        "USINE MÉTALLURGIQUE & PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
        "LE LEADER DE LA MÉTALLURGIE & DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
        "50 ANS": "50 YEARS",
        "Tradition 1976-2026": "Tradition 1976-2026",
        "2 SITES": "2 SITES",
        "PK12 & Bekoko Douala": "PK12 & Bekoko Douala",
        "100% NC": "100% NC",
        "Conformité CEMAC": "CEMAC Compliance",
        "Explorer le Catalogue Officiel": "Explore Official Catalog",
        "Localiser l'Usine Bekoko": "Locate Bekoko Factory",
        "FLASH PRO-FORMA EXPRESS": "FLASH PRO-FORMA EXPRESS",
        "Ajustement immédiat des devis usine en 2 min": "Instant factory quote calculation in 2 min",
        "SÉLECTIONNER UN ARTICLE": "SELECT AN ITEM",
        "Sélectionnez un service...": "Select a department...",
        "Longueur personnalisée": "Custom Length",
        "Quantité": "Quantity",
        "Générer mon Devis Pro-Forma Direct": "Generate Instant Pro-Forma Quote",
        "Épaisseur Certifiée": "Certified Thickness",
        "Découpe au Centimètre": "Cut to Centimeter",
        "Livraison Rapide CEMAC": "Fast CEMAC Delivery",
        "Paiement Sécurisé / Virement": "Secure Payment / Bank Transfer",

        // --- 4. HOMEPAGE PRODUCTION POLES ---
        "PÔLES DE PRODUCTION TPM SA": "TPM SA PRODUCTION HUBS",
        "Nos 4 Domaines d'Activité Industrielle": "Our 4 Industrial Activity Sectors",
        "Fabrication directe sur nos sites de Bekoko et PK12 selon les normes de solidité les plus strictes au Cameroun.": "Direct manufacturing at our Bekoko and PK12 sites adhering to Cameroon's highest structural standards.",
        "PÔLE N°1 • 10 RÉF.": "SECTOR #1 • 10 ITEMS",
        "PÔLE N°2 • 17 RÉF.": "SECTOR #2 • 17 ITEMS",
        "PÔLE N°3 • 10 RÉF.": "SECTOR #3 • 10 ITEMS",
        "PÔLE N°4 • 22 RÉF.": "SECTOR #4 • 22 ITEMS",
        "Voir les 10 Tôles Bacs": "View 10 Roofing Sheets",
        "Voir les 17 Accessoires": "View 17 Accessories",
        "Voir les 10 Fixations": "View 10 Fasteners",
        "Voir les 22 Articles": "View 22 Interior Products",

        // --- 5. CARDS (FEATURED PRODUCTS & SHOP ITEMS) ---
        "INVENTAIRE DIRECT USINE": "DIRECT FACTORY INVENTORY",
        "Articles Phares Disponible en Stock": "Featured Products Available in Stock",
        "Consulter les 58 références usine TPM": "Browse all 58 TPM factory references",
        "En Stock Usine": "In Factory Stock",
        "En Stock": "In Stock",
        "Dispo :": "Avail.:",
        "Usine Bekoko": "Bekoko Factory",
        "Comptoir PK12": "PK12 Trade Counter",
        "PK12 & Bekoko": "PK12 & Bekoko",
        "+ Pro-Forma": "+ Add to Quote",
        "+ PRO-FORMA": "+ ADD TO QUOTE",
        "Tarif HT / m linéaire": "Price Excl. Tax / lin. meter",
        "Tarif HT / Pièce 2m": "Price Excl. Tax / 2m Piece",
        "Tarif HT / Boîte 100 pcs": "Price Excl. Tax / Box 100 pcs",
        "Tarif HT / Rouleau 10m": "Price Excl. Tax / 10m Roll",
        "Tarif HT / Lot 500 pcs": "Price Excl. Tax / Pack 500 pcs",
        "+ TVA 19.25%": "+ 19.25% VAT",
        "mètre linéaire": "linear meter",
        "unité": "unit",
        "boîte": "box",
        "paquet": "pack",
        "rouleau": "roll",
        "lot": "batch",

        // Product Card Names & Descriptions
        "Tôle BAC Prélaquée 0.50mm – Bordeau": "Pre-painted 0.50mm BAC Roofing Sheet – Bordeaux",
        "Tôle BAC Prélaquée 0.50mm - Bordeau": "Pre-painted 0.50mm BAC Roofing Sheet - Bordeaux",
        "Tôle BAC profilée en acier galvanisé prélaqué haute durabilité 0.50mm selon nuancier officiel RAL 3005, ondulée BTP et calepinée.": "High-durability 0.50mm pre-painted galvanized steel BAC sheet according to official RAL 3005 color chart.",
        "Tôle BAC aluminium prélaqué 0.50mm, profilage ondulé, nervuré D50/B30 et découpes sur mesure selon nuancier RAL.": "0.50mm pre-painted aluminium BAC sheet, corrugated and ribbed D50/B30 profiles with custom cuts.",
        "Tôle BAC Aluminium Prélaquée 0.50mm – Bleu Cendre": "Pre-painted 0.50mm Aluminium BAC Sheet – Ash Blue",
        "Tôle BAC Aluminium Prélaquée 0.50mm - Bleu Cendre": "Pre-painted 0.50mm Aluminium BAC Sheet - Ash Blue",
        "Profilage nervuré haute résistance avec revêtement multicouche anti-UV et anti-corrosion tropicale.": "High-strength ribbed profile with multi-layer anti-UV and tropical anti-corrosion coating.",
        "Faîtière à Bord Rabattu 0.50mm (Longueur 2.00m)": "Folded-Edge Ridge Cap 0.50mm (Length 2.00m)",
        "Faîtière de couronnement double pente alu et prélaquée haute précision, replis anti-goutte étanches et profilage 2 mètres pour toitures.": "High-precision double-slope aluminium and pre-painted capping ridge with anti-drip folds for 2-meter roofs.",
        "Faîtières crantées double pente, faîtières non crantées, rives alu, gouttières étanches et noues façonnées en atelier.": "Notched double-slope ridge caps, plain ridge caps, aluminium bargeboards, watertight gutters and workshop valleys.",
        "Fixations Complètes 6x80mm avec Rondelles néoprène (Boîte 100 pcs)": "Complete 6x80mm Fasteners with Neoprene Washers (Box 100 pcs)",
        "Tirefonds complets comprenant vis auto-foreuse haute charge 6x80mm zinguée avec cavaliers aluminium et rondelles d'étanchéité EPDM.": "Complete lag screws with heavy-duty zinc-plated 6x80mm self-drilling screws, aluminium saddles and EPDM washers.",
        "Tirefonds complets 6x80/6x100, cavaliers alu néoprène, rouleaux bitumés Toiturole 900G et vis auto-foreuses zinguées.": "Complete 6x80/6x100 lag screws, neoprene aluminium saddles, Toiturole 900G bitumen rolls and zinc-plated screws.",
        "Joint Bitumé Étanchéité 10M (Rouleau 10m x 20cm)": "Bituminous Sealing Strip 10M (10m x 20cm Roll)",
        "Bande bitumineuse adhésive renforcée aluminium pour solins de toiture, arêtes de faîtage et joints d'étanchéité haute température.": "Aluminium-reinforced adhesive bitumen strip for roof flashings, ridge edges and high-temperature watertight joints.",
        "Sacs PP Blancs Tissés 50kg (Lot de 500 Sacs Usine Bekoko)": "White Woven PP Bags 50kg (Pack of 500 Bags Bekoko Plant)",
        "Sacs en Polypropylène (PP) tissé ultra-résistants pour emballage de ciment, sable, gravier, produits agricoles et agro-industriels 50kg.": "Ultra-resistant woven polypropylene (PP) bags for packaging cement, sand, gravel, agricultural and industrial goods 50kg.",
        "Sacs PP tissés 50kg/25kg usine Bekoko, carrelages grès cérame italien/espagnol, douches sanitaires et second œuvre.": "Woven PP 50kg/25kg bags Bekoko factory, Italian/Spanish porcelain stoneware tiles, sanitary showers and finishing work.",

        // --- 6. CATALOGUE & SHOP PAGE ---
        "CATALOGUE OFFICIEL TPM SA": "OFFICIAL TPM SA CATALOG",
        "58 Références Industrielles Direct Usine": "58 Direct Factory Industrial References",
        "SÉLECTION D'ACTIVITÉ": "CATEGORY SELECTION",
        "Filtrer par catégorie": "Filter by category",
        "Trier par": "Sort by",
        "Tri par défaut": "Default sorting",
        "Tri par popularité": "Sort by popularity",
        "Tri par tarif : croissant": "Sort by price: low to high",
        "Tri par tarif : décroissant": "Sort by price: high to low",
        "Affichage de": "Showing",
        "résultats": "results",
        "Page précédente": "Previous page",
        "Page suivante": "Next page",
        "Télécharger le Catalogue Général (PDF)": "Download General Catalog (PDF)",
        "Télécharger le Catalogue (PDF)": "Download Catalog (PDF)",
        "Besoin d'un Devis Sur Mesure ?": "Need a Custom Quote?",
        "Nos ingénieurs d'études chiffrent vos bordereaux de toiture sous 2 heures.": "Our structural engineers calculate your roofing schedules within 2 hours.",
        "Demander un Devis B2B": "Request B2B Quote",
        "Ajouter à la Pro-Forma": "Add to Pro-Forma",
        "Ajouter au Panier": "Add to Cart",
        "Voir le produit": "View product",
        "Détails du Produit": "Product Details",
        "Fiche Technique": "Technical Specs",

        // --- 7. CART & PRO-FORMA PAGE (/cart/) ---
        "Document Pro-Forma Officiel B2B — Valable 30 Jours": "Official B2B Pro-Forma Document — Valid 30 Days",
        "Document Pro-Forma Officiel B2B - Valable 30 Jours": "Official B2B Pro-Forma Document - Valid 30 Days",
        "Télécharger ma Pro-Forma (PDF)": "Download Pro-Forma (PDF)",
        "Valider la Commande Usine": "Confirm Factory Order",
        "Valider la Commande Usine →": "Confirm Factory Order →",
        "Transformation Métallique & Plastique — Depuis 1976": "Metallic & Plastics Transformation — Since 1976",
        "Fondé par M. NJIPNGANG — Usines de Douala PK12 & Bekoko": "Founded by Mr. NJIPNGANG — Douala PK12 & Bekoko Factories",
        "BON DE PRO-FORMA N° :": "PRO-FORMA INVOICE NO. :",
        "Date d'émission :": "Issue Date:",
        "Validité :": "Validity:",
        "30 Jours ouvrés": "30 Working Days",
        "\"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ\"": "\"SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEED DURABILITY\"",
        "Détail des Articles Répertoriés": "Detailed Listed Items",
        "Tarification Usine HT": "Factory Pricing Excl. Tax",
        "Article & Réf": "Item & SKU",
        "Spécifications": "Specifications",
        "Prix Unitaire HT": "Unit Price Excl. Tax",
        "Total HT (FCFA)": "Total Excl. Tax (FCFA)",
        "Action": "Action",
        "Longueur:": "Length:",
        "Couleur:": "Color:",
        "← Continuer vos ajouts au catalogue": "← Continue adding items from catalog",
        "Mettre à jour la Pro-Forma": "Update Pro-Forma",
        "Mettre à jour le panier": "Update Cart",
        "Décompte Financier B2B": "B2B Financial Summary",
        "Total des articles HT :": "Items Subtotal Excl. Tax:",
        "TVA Cameroun (19.25%) :": "Cameroon VAT (19.25%):",
        "Frais de Manutention :": "Handling Charges:",
        "Inclus Usine": "Factory Included",
        "TOTAL GÉNÉRAL TTC :": "GRAND TOTAL INCL. TAX:",
        "✔ Conforme à la réglementation fiscale du Cameroun": "✔ Compliant with Cameroon tax regulations",
        "GÉNÉRER MA PRO-FORMA EN PDF": "GENERATE PRO-FORMA PDF",
        "Transmettre au Commercial WhatsApp": "Send to WhatsApp Sales Representative",
        "Coordonnées et Mentions Légales TPM SA (Groupe CAC) :": "Contact Details & Legal Notice TPM SA (CAC Group):",
        "• E-mail officiel :": "• Official Email:",
        "| Téléphones Usine :": "| Factory Phones:",
        "• Horaires de bureau :": "• Office Hours:",
        "Du Lundi au Vendredi de 08h00 à 18h00": "Monday to Friday from 08:00 AM to 06:00 PM",
        "Jours fériés :": "Public Holidays:",
        "08h00 à 12h00": "08:00 AM to 12:00 PM",
        "(Fermé : 01/01, 11/02, 01/05, 20/05, 25/12)": "(Closed: 01/01, 11/02, 01/05, 20/05, 25/12)",
        "• Adresse usine : Carrefour Bekoko (Axe Douala - Limbé) & Zone Industrielle Douala PK12, Cameroun.": "• Factory Address: Bekoko Junction (Douala - Limbe Highway) & Douala PK12 Industrial Zone, Cameroon.",
        "Votre Panier Pro-Forma est actuellement vide": "Your Pro-Forma Quote is currently empty",
        "Vous n'avez pas encore ajouté d'articles à votre devis. Explorez notre catalogue pour composer votre sélection de tôles, accessoires ou fixations.": "You haven't added items to your quote yet. Explore our catalog to choose roofing sheets, accessories or fasteners.",
        "Explorer le Catalogue Usine": "Explore Factory Catalog",

        // --- 8. L'ENTREPRISE (ABOUT US) ---
        "FONDÉ PAR M. NJIPNGANG • DEPUIS 1976": "FOUNDED BY MR. NJIPNGANG • SINCE 1976",
        "50 Ans d'Excellence Métallurgique & de Plasturgie au Cameroun.": "50 Years of Metallurgical & Plastics Excellence in Cameroon.",
        "Fondateur Visionnaire :": "Visionary Founder:",
        "Siège & Usines :": "Headquarters & Factories:",
        "Douala (PK12 & Bekoko)": "Douala (PK12 & Bekoko)",
        "Numéro NIU :": "Tax ID (TIN):",
        "Régime Fiscal :": "Tax Regime:",
        "TVA 19.25% Récupérable": "19.25% Recoverable VAT",
        "Télécharger Fiche Entreprise (PDF)": "Download Company Profile (PDF)",
        "Contacter la Direction Générale": "Contact Executive Management",
        "Notre Histoire Industrielle": "Our Industrial History",
        "50 ans d'engagement pour l'autonomie productive du Cameroun": "50 years of commitment to Cameroon's industrial self-reliance",
        "2 Sites de Production Stratégiques à Douala": "2 Strategic Production Sites in Douala",
        "Une capacité industrielle combinée unique au Cameroun pour répondre aux exigences des plus grands projets.": "A unique combined industrial capacity in Cameroon meeting the highest project demands.",
        "USINE HISTORIQUE N°1 (PK12)": "HISTORIC FACTORY #1 (PK12)",
        "COMPLEXE N°2 (BEKOKO)": "INDUSTRIAL COMPLEX #2 (BEKOKO)",
        "Usine Historique Douala PK12": "Historic Douala PK12 Factory",
        "Complexe Industriel Bekoko": "Bekoko Industrial Complex",
        "Axe Lourd Douala-Yaoundé, PK12": "Douala-Yaoundé Main Highway, PK12",
        "Carrefour Bekoko — Axe Douala - Limbé": "Bekoko Junction — Douala - Limbe Highway",
        "CAPACITÉS & GAMMES DE FABRICATION": "MANUFACTURING CAPACITIES & RANGES",
        "L'Éventail de nos Lignes de Production": "Our Production Lines Overview",
        "Gouvernance & Conformité Fiscale": "Governance & Fiscal Compliance",
        "Une transparence totale pour vos déductions de TVA et audits BTP": "Total transparency for your VAT deductions and construction audits",
        "Télécharger les Certificats Fiscaux & Documents": "Download Fiscal Certificates & Documents",
        "Attestation Fiscale (DGI)": "Tax Compliance Certificate",
        "Certificat d'Immatriculation": "Business Registration",
        "Nuancier RAL Officiel TPM": "Official TPM RAL Color Chart",
        "Déclaration Douanière CEMAC": "CEMAC Customs Declaration",
        "Prêt à Collaborer avec TPM SA ?": "Ready to Partner with TPM SA?",
        "Nos équipes technico-commerciales sont prêtes à étudier vos cahiers des charges.": "Our technical and sales teams are ready to analyze your project specifications.",
        "Générer une Pro-Forma": "Generate Pro-Forma",

        // --- 9. CONTACT USINE ---
        "CONTACT & GÉOLOCALISATION DE L'USINE TPM SA": "CONTACT & GEOLOCATION OF TPM SA FACTORY",
        "Demandes de devis sur mesure, suivi de production et enlèvement de commandes. Nos équipes industrielles sont à votre disposition.": "Custom quote requests, production monitoring, and order pickups. Our industrial teams are at your service.",
        "USINE BEKOKO": "BEKOKO FACTORY",
        "Lun-Ven: 07h30 - 18h00": "Mon-Fri: 07:30 AM - 06:00 PM",
        "COMPTOIR PK12": "PK12 TRADE COUNTER",
        "Lun-Sam: 08h00 - 17h00": "Mon-Sat: 08:00 AM - 05:00 PM",
        "SUPPORT DIRECT": "DIRECT SUPPORT",
        "Devis sous 2h": "Quote within 2h",
        "Nos Canaux de Communication": "Our Communication Channels",
        "Joignez directement le département adapté à votre demande pour un traitement express.": "Contact the appropriate department directly for express handling.",
        "Direction Commerciale & Devis": "Sales & Quotation Department",
        "Bureau d'Études & Toitures": "Design Office & Roofing Calculations",
        "Logistique & Enlèvement Usine": "Logistics & Factory Pickup",
        "Sites & Accès": "Sites & Access",
        "Nos installations sont conçues pour accueillir des véhicules de grand gabarit afin de faciliter vos approvisionnements en matériaux de construction et structures métalliques.": "Our facilities are designed to accommodate large heavy-duty vehicles for easy loading of construction materials.",
        "Usine Principale - Bekoko": "Main Factory - Bekoko",
        "Comptoir Commercial - PK12": "Commercial Counter - PK12",
        "Zone Industrielle de Bekoko, Douala, Cameroun": "Bekoko Industrial Zone, Douala, Cameroon",
        "Accès camions > 12m:": "Truck access > 12m:",
        "Pont bascule:": "Weighbridge:",
        "Horaires de charge:": "Loading hours:",
        "Disponible": "Available",
        "Oui": "Yes",
        "Vente au détail:": "Retail counter:",
        "Enlèvement véhicules légers:": "Light vehicle pickup:",
        "Zone Bekoko (1 500 m²)": "Bekoko Zone (1,500 m²)",
        "Accès Poids Lourds Garanti": "Heavy Duty Truck Access Guaranteed",
        "Usine de Production Bekoko": "Bekoko Production Plant",
        "Carrefour Bekoko, Axe Douala - Limbé, Littoral, Cameroun": "Bekoko Junction, Douala - Limbe Highway, Littoral, Cameroon",
        "Ouvrir l'Itinéraire GPS (Google Maps)": "Open GPS Directions (Google Maps)",
        "Envoyer une Demande": "Send an Inquiry",
        "Remplissez le formulaire ci-dessous pour une prise en charge rapide par nos équipes techniques ou commerciales.": "Fill in the form below for rapid assistance from our technical or commercial teams.",
        "Nom / Raison Sociale": "Full Name / Company Name",
        "NIU (Numéro d'Identifiant Unique)": "TIN (Taxpayer Identification Number)",
        "Email Professionnel": "Work Email",
        "Numéro WhatsApp": "WhatsApp Number",
        "Service Concerné": "Department / Service",
        "Commercial & Devis Pro-Forma": "Commercial & Pro-Forma Quotes",
        "Bureau d'Études / Calepinage": "Engineering & Roofing Layout",
        "Approvisionnement Gros Chantier BTP": "Major Construction Site Supply",
        "Message / Détails de la demande": "Message / Inquiry Details",
        "Décrivez votre besoin : types de tôles, profilages, longueurs, accessoires de faîtage, délais de chantier...": "Describe your requirements: sheet types, profiling, lengths, ridge accessories, deadlines...",
        "Pièces Jointes (PDF, DWG, Images)": "Attachments (PDF, DWG, Images)",
        "Cliquez ou glissez vos fichiers ici (Max 10MB)": "Click or drag your files here (Max 10MB)",
        "Plans, bordereaux de métrés ou fiches techniques": "Blueprints, quantity schedules or technical datasheets",
        "ENVOYER MON MESSAGE À L'USINE": "SEND MY MESSAGE TO THE FACTORY",
        "Besoin d'une réponse immédiate?": "Need an immediate answer?",
        "Nos conseillers techniques sont disponibles sur WhatsApp pour une assistance directe.": "Our technical advisors are available on WhatsApp for direct assistance.",
        "CONTACTER SUR WHATSAPP": "CONTACT ON WHATSAPP",

        // --- 10. FOOTER SECTION ---
        "Besoin d'une Facture Pro-Forma officielle ou d'une cotation B2B ?": "Need an official Pro-Forma invoice or B2B quote?",
        "Commandes au mètre linéaire sur-mesure pour tôles BAC, emballages PP tissés et tarification dégressive.": "Custom cut-to-length orders for roofing sheets, woven PP sacks, and tiered volume pricing.",
        "WhatsApp Commercial Direct": "Direct Commercial WhatsApp",
        "Générer ma Pro-Forma": "Generate Pro-Forma",
        "Leader camerounais dans le profilage de tôles BAC prélaquées, la fabrication de fixations industrielles, l'extrusion de sacs PP et le zingage unique en Afrique Centrale.": "Cameroonian leader in pre-painted BAC roofing sheets, industrial fasteners manufacturing, PP bag extrusion and hot-dip galvanizing in Central Africa.",
        "PME Agréée": "Certified Enterprise",
        "Usines: PK12 & Bekoko": "Factories: PK12 & Bekoko",
        "Nos Produits": "Our Products",
        "Tôles BAC & Ondulées": "Roofing Sheets & Corrugated",
        "Faîtières, Rives & Gouttières": "Ridge Caps, Bargeboards & Gutters",
        "Fixations Complètes & Pointes": "Complete Fasteners & Nails",
        "Sacs PP Blancs 50kg / 100kg": "White PP Bags 50kg / 100kg",
        "Carreaux & Sanitaires": "Tiles & Sanitaryware",
        "Services & Pro-Forma": "Services & Pro-Forma",
        "Demande de Pro-Forma Flash": "Flash Pro-Forma Request",
        "Horaires d'Ouverture": "Opening Hours",
        "Usine Bekoko : Lun - Ven 07h30 - 18h00": "Bekoko Factory: Mon - Fri 07:30 AM - 06:00 PM",
        "Comptoir PK12 : Lun - Sam 08h00 - 17h00": "PK12 Counter: Mon - Sat 08:00 AM - 05:00 PM",
        "Expéditions Grand Nord & CEMAC : 24h/48h": "Grand North & CEMAC Dispatch: 24h/48h",
        "Tous droits réservés.": "All rights reserved.",
        "Conception Industrielle & Numérique CEMAC": "CEMAC Industrial & Digital Design"
    };

    // Construction du dictionnaire inverse (Anglais -> Français)
    const REVERSE_DICTIONARY = {};
    for (const [fr, en] of Object.entries(DICTIONARY)) {
        REVERSE_DICTIONARY[en] = fr;
    }

    // Récupérer les paires de traduction triées par longueur décroissante
    function getSortedTranslationPairs(targetLang) {
        const sourceDict = (targetLang === 'en') ? DICTIONARY : REVERSE_DICTIONARY;
        return Object.entries(sourceDict).sort((a, b) => b[0].length - a[0].length);
    }

    function getActiveLanguage() {
        return localStorage.getItem(STORAGE_KEY) || DEFAULT_LANG;
    }

    function setActiveLanguage(lang) {
        localStorage.setItem(STORAGE_KEY, lang);
        document.cookie = `${STORAGE_KEY}=${lang};path=/;max-age=31536000;SameSite=Lax`;
    }

    function updateSwitcherButtons(lang) {
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
        const cartBtnText = document.querySelectorAll('.cart-button-label');
        cartBtnText.forEach(el => {
            el.textContent = isEn ? `My Pro-Forma Quote (${count})` : `Mon Panier Pro-Forma (${count})`;
        });
    }

    // Traduction intelligente récursive de l'ensemble du DOM
    function translateDOM(targetLang) {
        const pairs = getSortedTranslationPairs(targetLang);

        function replaceText(str) {
            if (!str || typeof str !== 'string') return str;
            let result = str;

            for (let i = 0; i < pairs.length; i++) {
                const [sourceText, targetText] = pairs[i];
                if (result.includes(sourceText)) {
                    result = result.split(sourceText).join(targetText);
                }
            }
            return result;
        }

        // Parcours des nœuds de texte
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
                    // Ne pas modifier les chiffres purs du badge
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
            const updated = replaceText(original);
            if (updated !== original) {
                textNode.nodeValue = updated;
            }
        });

        // Traduction des options dans les listes déroulantes
        const options = document.querySelectorAll('option');
        options.forEach(opt => {
            const tr = replaceText(opt.textContent);
            if (tr !== opt.textContent) opt.textContent = tr;
        });

        // Traduction des boutons submit / input
        const submitInputs = document.querySelectorAll('input[type="submit"], input[type="button"]');
        submitInputs.forEach(btn => {
            if (btn.value) {
                const tr = replaceText(btn.value);
                if (tr !== btn.value) btn.value = tr;
            }
        });

        // Traduction des placeholders et titres
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(el => {
            if (el.placeholder) {
                const tr = replaceText(el.placeholder);
                if (tr !== el.placeholder) el.placeholder = tr;
            }
            if (el.title) {
                const tr = replaceText(el.title);
                if (tr !== el.title) el.title = tr;
            }
        });

        const titledElements = document.querySelectorAll('[title], [aria-label]');
        titledElements.forEach(el => {
            if (el.title) {
                const tr = replaceText(el.title);
                if (tr !== el.title) el.title = tr;
            }
            if (el.getAttribute('aria-label')) {
                const tr = replaceText(el.getAttribute('aria-label'));
                if (tr !== el.getAttribute('aria-label')) el.setAttribute('aria-label', tr);
            }
        });
    }

    // Fonction globale pour changer la langue
    window.setTPMLanguage = function (lang) {
        if (lang !== 'fr' && lang !== 'en') lang = 'fr';
        setActiveLanguage(lang);
        updateSwitcherButtons(lang);
        translateDOM(lang);
        window.dispatchEvent(new CustomEvent('tpm_language_changed', { detail: { lang } }));
    };

    // Initialisation au chargement de la page
    document.addEventListener('DOMContentLoaded', function () {
        const initialLang = getActiveLanguage();

        // Écouteur global pour tous les boutons de changement de langue
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-lang-btn]');
            if (btn) {
                e.preventDefault();
                const targetLang = btn.getAttribute('data-lang-btn');
                window.setTPMLanguage(targetLang);
            }
        });

        // Mettre à jour l'apparence des boutons
        updateSwitcherButtons(initialLang);

        // Si la langue est Anglais, appliquer la traduction
        if (initialLang === 'en') {
            translateDOM('en');
        }
    });

})();
