/**
 * TPM SA (Groupe CAC) - Moteur Bilingue Français / Anglais (i18n)
 * Système de traduction instantanée temps réel sans rechargement de page.
 * Par défaut : Français (FR). Clic sur switch -> Anglais (EN).
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'tpm_site_lang';
    const DEFAULT_LANG = 'fr';

    // Dictionnaire bilingue Français -> Anglais
    const DICTIONARY = {
        // --- TOPBAR & HEADER ---
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

        // --- PLACEHOLDERS ---
        "Rechercher un article (ex: Tôle BAC 0.50mm, Faîtière, Sac PP 50kg, Vis 6×80…)": "Search for an item (e.g. 0.50mm Roofing Sheet, Ridge Cap, 50kg PP Bag, 6×80 Screw…)",
        "Rechercher un produit...": "Search for a product...",
        "Ex: Tôle bac alu, faîtière, tirefond...": "E.g.: Alu roofing sheet, ridge cap, lag screw...",
        "contact@votre-entreprise.cm": "contact@your-company.cm",
        "Ex: Entreprise BTP Cameroun": "E.g.: Cameroon Construction Ltd",
        "Ex: M052217435713Q": "E.g.: M052217435713Q",

        // --- MEGA MENU & CATEGORIES ---
        "Tôles et toiture": "Roofing Sheets & Roofing",
        "Tôles & Couvertures": "Roofing Sheets & Coverings",
        "Tôles & Couvertures BAC": "Roofing Sheets & BAC Coverings",
        "Accessoires toiture": "Roofing Accessories",
        "Accessoires de Toiture": "Roofing Accessories",
        "Accessoires de toiture": "Roofing Accessories",
        "Fixations et étanchéité": "Fasteners & Waterproofing",
        "Fixations & Étanchéité": "Fasteners & Waterproofing",
        "Fixations & étanchéité": "Fasteners & Waterproofing",
        "Accessoires intérieurs": "Interior Accessories & Bags",
        "Accessoires Intérieurs & Sacs PP": "Interior Accessories & PP Bags",
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

        // --- HOMEPAGE HERO & STATS ---
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
        "Longueur personnalisée": "Custom Length",
        "Quantité": "Quantity",
        "Générer mon Devis Pro-Forma Direct": "Generate Instant Pro-Forma Quote",
        "Épaisseur Certifiée": "Certified Thickness",
        "Découpe au Centimètre": "Cut to Centimeter",
        "Livraison Rapide CEMAC": "Fast CEMAC Delivery",
        "Paiement Sécurisé / Virement": "Secure Payment / Transfer",

        // --- PRODUCTION POLES (4 POLES) ---
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

        // --- FEATURED INVENTORY & PRODUCTS ---
        "INVENTAIRE DIRECT USINE": "DIRECT FACTORY INVENTORY",
        "Articles Phares Disponible en Stock": "Featured Products Available in Stock",
        "Consulter les 58 références usine TPM": "Browse all 58 TPM factory references",
        "En Stock Usine": "In Factory Stock",
        "En Stock": "In Stock",
        "+ Pro-Forma": "+ Pro-Forma",
        "Tarif HT / m linéaire": "Price Excl. Tax / lin. meter",
        "Tarif HT / Pièce 2m": "Price Excl. Tax / 2m Piece",
        "Tarif HT / Boîte 100 pcs": "Price Excl. Tax / Box 100 pcs",
        "Tarif HT / Rouleau 10m": "Price Excl. Tax / 10m Roll",
        "Tarif HT / Lot 500 pcs": "Price Excl. Tax / Pack 500 pcs",
        "Dispo :": "Avail.:",
        "+ TVA 19.25%": "+ 19.25% VAT",
        "Usine Bekoko": "Bekoko Factory",
        "Comptoir PK12": "PK12 Trade Counter",
        "PK12 & Bekoko": "PK12 & Bekoko",

        // --- CATALOGUE & SHOP ---
        "CATALOGUE OFFICIEL TPM SA": "OFFICIAL TPM SA CATALOG",
        "58 Références Industrielles Direct Usine": "58 Direct Factory Industrial References",
        "SÉLECTION D'ACTIVITÉ": "CATEGORY SELECTION",
        "Rechercher un produit...": "Search for a product...",
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
        "Nos ingénieurs d'études chiffrent vos bordereaux de toiture sous 2 heures.": "Our structural engineers estimate your roofing schedules within 2 hours.",
        "Demander un Devis B2B": "Request B2B Quote",
        "Ajouter à la Pro-Forma": "Add to Pro-Forma",
        "Ajouter au Panier": "Add to Cart",
        "Voir le produit": "View product",
        "Détails du Produit": "Product Details",
        "Fiche Technique": "Technical Specs",

        // --- L'ENTREPRISE (ABOUT US) ---
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

        // --- CONTACT PAGE ---
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
        "Sélectionnez un service...": "Select a department...",
        "Commercial & Devis Pro-Forma": "Commercial & Pro-Forma Quotes",
        "Bureau d'Études / Calepinage": "Engineering & Roofing Layout",
        "Logistique & Enlèvement Usine": "Logistics & Factory Pickup",
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

        // --- CART & PRO-FORMA GENERATOR ---
        "VOTRE FACTURE PRO-FORMA OFFICIELLE": "YOUR OFFICIAL PRO-FORMA INVOICE",
        "GÉNÉRATEUR PRO-FORMA B2B": "B2B PRO-FORMA GENERATOR",
        "Articles Sélectionnés": "Selected Items",
        "Article / Référence": "Item / Reference",
        "Prix Unitaire HT": "Unit Price Excl. Tax",
        "Total Ligne HT": "Line Total Excl. Tax",
        "Actions": "Actions",
        "Total Hors Taxes (HT) :": "Subtotal Excl. Tax (HT):",
        "TVA Réglementaire (19.25%) :": "Statutory VAT (19.25%):",
        "NET À PAYER TTC :": "TOTAL INCL. TAX (TTC):",
        "Coordonnées de l'Acheteur": "Buyer / Company Details",
        "Nom de l'Entreprise / Client :": "Company / Customer Name:",
        "Numéro NIU / N° Contribuable :": "Tax ID (TIN):",
        "Téléphone / WhatsApp :": "Phone / WhatsApp:",
        "Email Facturation :": "Billing Email:",
        "Lieu de Livraison / Chantier :": "Delivery Location / Site:",
        "GÉNÉRER MON PDF PRO-FORMA OFFICIEL": "GENERATE MY OFFICIAL PRO-FORMA PDF",
        "ENVOYER LE BON DE COMMANDE SUR WHATSAPP": "SEND ORDER ON WHATSAPP",
        "Vider le panier": "Clear quote",
        "Continuer mes achats": "Continue shopping",
        "Votre Panier Pro-Forma est actuellement vide.": "Your Pro-Forma Quote is currently empty.",
        "Consulter le catalogue pour ajouter des tôles, accessoires ou emballages.": "Browse our catalog to add roofing sheets, accessories, or packaging.",
        "Accéder au Catalogue": "Browse Catalog",

        // --- FOOTER ---
        "Besoin d'une Facture Pro-Forma officielle ou d'une cotation B2B ?": "Need an official Pro-Forma invoice or B2B quote?",
        "Commandes au mètre linéaire sur-mesure pour tôles BAC, emballages PP tissés et tarification dégressive.": "Custom cut-to-length orders for roofing sheets, woven PP sacks, and tiered volume pricing.",
        "WhatsApp Commercial Direct": "Direct Commercial WhatsApp",
        "Générer ma Pro-Forma": "Generate Pro-Forma",
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

    // Récupérer la langue active
    function getActiveLanguage() {
        return localStorage.getItem(STORAGE_KEY) || DEFAULT_LANG;
    }

    // Sauvegarder la langue
    function setActiveLanguage(lang) {
        localStorage.setItem(STORAGE_KEY, lang);
        document.cookie = `${STORAGE_KEY}=${lang};path=/;max-age=31536000;SameSite=Lax`;
    }

    // Mettre à jour l'apparence des boutons de commutation
    function updateSwitcherButtons(lang) {
        const isEn = (lang === 'en');
        document.documentElement.lang = isEn ? 'en' : 'fr';

        // Boutons Desktop & Mobile
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
    }

    // Traduction récursive des nœuds textuels du DOM
    function translateDOM(targetLang) {
        const dict = (targetLang === 'en') ? DICTIONARY : REVERSE_DICTIONARY;

        // Fonction auxiliaire pour traduire une chaîne exacte ou partielle
        function getTranslation(str) {
            if (!str) return null;
            const trimmed = str.trim();
            if (!trimmed) return null;

            // 1. Correspondance exacte
            if (dict[trimmed]) {
                return str.replace(trimmed, dict[trimmed]);
            }

            // 2. Sous-phrases clés
            for (const [key, val] of Object.entries(dict)) {
                if (key.length > 5 && trimmed.includes(key)) {
                    return str.replace(key, val);
                }
            }

            return null;
        }

        // Parcours de tous les nœuds de texte
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
            const translated = getTranslation(textNode.nodeValue);
            if (translated !== null) {
                textNode.nodeValue = translated;
            }
        });

        // Options in select dropdowns
        const options = document.querySelectorAll('option');
        options.forEach(opt => {
            const tr = getTranslation(opt.textContent);
            if (tr) opt.textContent = tr;
        });

        // Submit inputs and buttons
        const submitInputs = document.querySelectorAll('input[type="submit"], input[type="button"]');
        submitInputs.forEach(btn => {
            if (btn.value) {
                const tr = getTranslation(btn.value);
                if (tr) btn.value = tr;
            }
        });

        // Traduction des attributs (placeholder, title, value)
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(el => {
            if (el.placeholder) {
                const tr = getTranslation(el.placeholder);
                if (tr) el.placeholder = tr;
            }
            if (el.title) {
                const tr = getTranslation(el.title);
                if (tr) el.title = tr;
            }
        });

        // Traduction des boutons avec attributs title ou aria-label
        const titledElements = document.querySelectorAll('[title], [aria-label]');
        titledElements.forEach(el => {
            if (el.title) {
                const tr = getTranslation(el.title);
                if (tr) el.title = tr;
            }
            if (el.getAttribute('aria-label')) {
                const tr = getTranslation(el.getAttribute('aria-label'));
                if (tr) el.setAttribute('aria-label', tr);
            }
        });
    }

    // Appliquer une langue
    window.setTPMLanguage = function (lang) {
        if (lang !== 'fr' && lang !== 'en') lang = 'fr';
        setActiveLanguage(lang);
        updateSwitcherButtons(lang);
        translateDOM(lang);
        window.dispatchEvent(new CustomEvent('tpm_language_changed', { detail: { lang } }));
    };

    // Initialisation au chargement du DOM
    document.addEventListener('DOMContentLoaded', function () {
        const initialLang = getActiveLanguage();

        // Attacher les écouteurs de clics sur les boutons
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-lang-btn]');
            if (btn) {
                e.preventDefault();
                const targetLang = btn.getAttribute('data-lang-btn');
                window.setTPMLanguage(targetLang);
            }
        });

        // Mettre à jour l'état initial des boutons
        updateSwitcherButtons(initialLang);

        // Si la langue enregistrée est l'anglais, traduire la page
        if (initialLang === 'en') {
            translateDOM('en');
        }
    });

})();
