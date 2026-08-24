/**
 * TPM SA (Groupe CAC) - Moteur Bilingue Haute Performance (i18n)
 * Exécution ultra-rapide (sans freeze UI), avec snapshot pristine WeakMap.
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'tpm_site_lang';
    const DEFAULT_LANG = 'fr';

    const DICT_FR_TO_EN = {
    "Pionnier de la transformation industrielle en Afrique Centrale, TPM SA (Groupe CAC) fabrique des tôles BAC haute résistance, des faîtières & accessoires de toiture, des sacs tissés en polypropylène et distribue des matériaux de second œuvre pour les grands chantiers BTP et le secteur commercial.": "A pioneer of industrial manufacturing in Central Africa, TPM SA (CAC Group) manufactures high-strength BAC roofing sheets, ridge caps & roofing accessories, woven polypropylene bags, and distributes finishing materials for major construction projects and the commercial sector.",
    "PIONNIER DE LA TRANSFORMATION INDUSTRIELLE EN AFRIQUE CENTRALE, TPM SA (GROUPE CAC) FABRIQUE DES TôLES BAC HAUTE RéSISTANCE, DES FAîTIèRES & ACCESSOIRES DE TOITURE, DES SACS TISSéS EN POLYPROPYLèNE ET DISTRIBUE DES MATéRIAUX DE SECOND œUVRE POUR LES GRANDS CHANTIERS BTP ET LE SECTEUR COMMERCIAL.": "A PIONEER OF INDUSTRIAL MANUFACTURING IN CENTRAL AFRICA, TPM SA (CAC GROUP) MANUFACTURES HIGH-STRENGTH BAC ROOFING SHEETS, RIDGE CAPS & ROOFING ACCESSORIES, WOVEN POLYPROPYLENE BAGS, AND DISTRIBUTES FINISHING MATERIALS FOR MAJOR CONSTRUCTION PROJECTS AND THE COMMERCIAL SECTOR.",
    "Depuis 1976, TPM SA fabrique et approvisionne les plus grands chantiers BTP, quincailleries et entreprises du Cameroun et de la zone CEMAC en Tôles BAC prélaquées 0.50mm, accessoires de toiture, Sacs PP tissés et carrelage.": "Since 1976, TPM SA manufactures and supplies major construction sites, hardware stores, and companies across Cameroon and the CEMAC zone with 0.50mm pre-painted BAC roofing sheets, roofing accessories, woven PP bags, and tiles.",
    "DEPUIS 1976, TPM SA FABRIQUE ET APPROVISIONNE LES PLUS GRANDS CHANTIERS BTP, QUINCAILLERIES ET ENTREPRISES DU CAMEROUN ET DE LA ZONE CEMAC EN TôLES BAC PRéLAQUéES 0.50MM, ACCESSOIRES DE TOITURE, SACS PP TISSéS ET CARRELAGE.": "SINCE 1976, TPM SA MANUFACTURES AND SUPPLIES MAJOR CONSTRUCTION SITES, HARDWARE STORES, AND COMPANIES ACROSS CAMEROON AND THE CEMAC ZONE WITH 0.50MM PRE-PAINTED BAC ROOFING SHEETS, ROOFING ACCESSORIES, WOVEN PP BAGS, AND TILES.",
    "Nos installations sont conçues pour accueillir des véhicules de grand gabarit afin de faciliter vos approvisionnements en matériaux de construction et structures métalliques.": "Our facilities are engineered to accommodate heavy-duty vehicles for seamless loading of construction materials and steel structures.",
    "NOS INSTALLATIONS SONT CONçUES POUR ACCUEILLIR DES VéHICULES DE GRAND GABARIT AFIN DE FACILITER VOS APPROVISIONNEMENTS EN MATéRIAUX DE CONSTRUCTION ET STRUCTURES MéTALLIQUES.": "OUR FACILITIES ARE ENGINEERED TO ACCOMMODATE HEAVY-DUTY VEHICLES FOR SEAMLESS LOADING OF CONSTRUCTION MATERIALS AND STEEL STRUCTURES.",
    "Leader camerounais dans le profilage de tôles BAC prélaquées, la fabrication de fixations industrielles, l'extrusion de sacs PP et le zingage unique en Afrique Centrale.": "Cameroonian leader in pre-painted BAC roofing sheets profiling, industrial fasteners manufacturing, PP bag extrusion, and specialized hot-dip galvanizing in Central Africa.",
    "LEADER CAMEROUNAIS DANS LE PROFILAGE DE TôLES BAC PRéLAQUéES, LA FABRICATION DE FIXATIONS INDUSTRIELLES, L'EXTRUSION DE SACS PP ET LE ZINGAGE UNIQUE EN AFRIQUE CENTRALE.": "CAMEROONIAN LEADER IN PRE-PAINTED BAC ROOFING SHEETS PROFILING, INDUSTRIAL FASTENERS MANUFACTURING, PP BAG EXTRUSION, AND SPECIALIZED HOT-DIP GALVANIZING IN CENTRAL AFRICA.",
    "Vous n'avez pas encore ajouté d'articles à votre devis. Explorez notre catalogue pour composer votre sélection de tôles, accessoires ou fixations.": "You haven't added items to your quote yet. Explore our catalog to select roofing sheets, accessories, or fasteners.",
    "VOUS N'AVEZ PAS ENCORE AJOUTé D'ARTICLES à VOTRE DEVIS. EXPLOREZ NOTRE CATALOGUE POUR COMPOSER VOTRE SéLECTION DE TôLES, ACCESSOIRES OU FIXATIONS.": "YOU HAVEN'T ADDED ITEMS TO YOUR QUOTE YET. EXPLORE OUR CATALOG TO SELECT ROOFING SHEETS, ACCESSORIES, OR FASTENERS.",
    "Faîtière de couronnement double pente alu et prélaquée haute précision, replis anti-goutte étanches et profilage 2 mètres pour toitures.": "High-precision double-slope aluminium and pre-painted capping ridge with watertight anti-drip folds for 2-meter roofs.",
    "FAîTIèRE DE COURONNEMENT DOUBLE PENTE ALU ET PRéLAQUéE HAUTE PRéCISION, REPLIS ANTI-GOUTTE éTANCHES ET PROFILAGE 2 MèTRES POUR TOITURES.": "HIGH-PRECISION DOUBLE-SLOPE ALUMINIUM AND PRE-PAINTED CAPPING RIDGE WITH WATERTIGHT ANTI-DRIP FOLDS FOR 2-METER ROOFS.",
    "Sacs en Polypropylène (PP) tissé ultra-résistants pour emballage de ciment, sable, gravier, produits agricoles et agro-industriels 50kg.": "Ultra-resistant woven polypropylene (PP) bags for packaging cement, sand, gravel, agricultural, and industrial products 50kg.",
    "SACS EN POLYPROPYLèNE (PP) TISSé ULTRA-RéSISTANTS POUR EMBALLAGE DE CIMENT, SABLE, GRAVIER, PRODUITS AGRICOLES ET AGRO-INDUSTRIELS 50KG.": "ULTRA-RESISTANT WOVEN POLYPROPYLENE (PP) BAGS FOR PACKAGING CEMENT, SAND, GRAVEL, AGRICULTURAL, AND INDUSTRIAL PRODUCTS 50KG.",
    "Bande bitumineuse adhésive renforcée aluminium pour solins de toiture, arêtes de faîtage et joints d'étanchéité haute température.": "Aluminium-reinforced adhesive bitumen strip for roof flashings, ridge edges, and high-temperature watertight joints.",
    "BANDE BITUMINEUSE ADHéSIVE RENFORCéE ALUMINIUM POUR SOLINS DE TOITURE, ARêTES DE FAîTAGE ET JOINTS D'éTANCHéITé HAUTE TEMPéRATURE.": "ALUMINIUM-REINFORCED ADHESIVE BITUMEN STRIP FOR ROOF FLASHINGS, RIDGE EDGES, AND HIGH-TEMPERATURE WATERTIGHT JOINTS.",
    "Tôle BAC profilée en acier galvanisé prélaqué haute durabilité 0.50mm selon nuancier officiel RAL 3005, ondulée BTP et calepinée.": "High-durability 0.50mm pre-painted galvanized steel BAC sheet according to official RAL 3005 color chart, corrugated and custom-sized.",
    "TôLE BAC PROFILéE EN ACIER GALVANISé PRéLAQUé HAUTE DURABILITé 0.50MM SELON NUANCIER OFFICIEL RAL 3005, ONDULéE BTP ET CALEPINéE.": "HIGH-DURABILITY 0.50MM PRE-PAINTED GALVANIZED STEEL BAC SHEET ACCORDING TO OFFICIAL RAL 3005 COLOR CHART, CORRUGATED AND CUSTOM-SIZED.",
    "Tirefonds complets comprenant vis auto-foreuse haute charge 6x80mm zinguée avec cavaliers aluminium et rondelles d'étanchéité EPDM.": "Complete lag screws with heavy-duty zinc-plated 6x80mm self-drilling screws, aluminium saddles, and EPDM sealing washers.",
    "TIREFONDS COMPLETS COMPRENANT VIS AUTO-FOREUSE HAUTE CHARGE 6X80MM ZINGUéE AVEC CAVALIERS ALUMINIUM ET RONDELLES D'éTANCHéITé EPDM.": "COMPLETE LAG SCREWS WITH HEAVY-DUTY ZINC-PLATED 6X80MM SELF-DRILLING SCREWS, ALUMINIUM SADDLES, AND EPDM SEALING WASHERS.",
    "Demandes de devis sur mesure, suivi de production et enlèvement de commandes. Nos équipes industrielles sont à votre disposition.": "Custom quote requests, production monitoring, and order pickups. Our industrial teams are at your service.",
    "DEMANDES DE DEVIS SUR MESURE, SUIVI DE PRODUCTION ET ENLèVEMENT DE COMMANDES. NOS éQUIPES INDUSTRIELLES SONT à VOTRE DISPOSITION.": "CUSTOM QUOTE REQUESTS, PRODUCTION MONITORING, AND ORDER PICKUPS. OUR INDUSTRIAL TEAMS ARE AT YOUR SERVICE.",
    "Faîtières crantées double pente, faîtières non crantées, rives alu, gouttières étanches et noues façonnées en atelier.": "Notched double-slope ridge caps, plain ridge caps, aluminium bargeboards, watertight gutters, and workshop valleys.",
    "FAîTIèRES CRANTéES DOUBLE PENTE, FAîTIèRES NON CRANTéES, RIVES ALU, GOUTTIèRES éTANCHES ET NOUES FAçONNéES EN ATELIER.": "NOTCHED DOUBLE-SLOPE RIDGE CAPS, PLAIN RIDGE CAPS, ALUMINIUM BARGEBOARDS, WATERTIGHT GUTTERS, AND WORKSHOP VALLEYS.",
    "Tirefonds complets 6x80\/6x100, cavaliers alu néoprène, rouleaux bitumés Toiturole 900G et vis auto-foreuses zinguées.": "Complete 6x80\/6x100 lag screws, neoprene aluminium saddles, Toiturole 900G bitumen rolls, and zinc-plated self-drilling screws.",
    "TIREFONDS COMPLETS 6X80\/6X100, CAVALIERS ALU NéOPRèNE, ROULEAUX BITUMéS TOITUROLE 900G ET VIS AUTO-FOREUSES ZINGUéES.": "COMPLETE 6X80\/6X100 LAG SCREWS, NEOPRENE ALUMINIUM SADDLES, TOITUROLE 900G BITUMEN ROLLS, AND ZINC-PLATED SELF-DRILLING SCREWS.",
    "Sacs PP tissés 50kg\/25kg usine Bekoko, carrelages grès cérame italien\/espagnol, douches sanitaires et second œuvre.": "Woven PP 50kg\/25kg bags Bekoko factory, Italian\/Spanish porcelain stoneware tiles, sanitary showers, and finishing works.",
    "SACS PP TISSéS 50KG\/25KG USINE BEKOKO, CARRELAGES GRèS CéRAME ITALIEN\/ESPAGNOL, DOUCHES SANITAIRES ET SECOND œUVRE.": "WOVEN PP 50KG\/25KG BAGS BEKOKO FACTORY, ITALIAN\/SPANISH PORCELAIN STONEWARE TILES, SANITARY SHOWERS, AND FINISHING WORKS.",
    "Tôle BAC aluminium prélaqué 0.50mm, profilage ondulé, nervuré D50\/B30 et découpes sur mesure selon nuancier RAL.": "0.50mm pre-painted aluminium BAC sheet, corrugated and ribbed D50\/B30 profiles with custom cuts.",
    "TôLE BAC ALUMINIUM PRéLAQUé 0.50MM, PROFILAGE ONDULé, NERVURé D50\/B30 ET DéCOUPES SUR MESURE SELON NUANCIER RAL.": "0.50MM PRE-PAINTED ALUMINIUM BAC SHEET, CORRUGATED AND RIBBED D50\/B30 PROFILES WITH CUSTOM CUTS.",
    "Prestations industrielles d'électro-zingage 800 VA, outillage de couverture, quincaillerie lourde et chantiers BTP.": "800 VA industrial electro-galvanizing services, roofing tools, heavy hardware, and construction sites.",
    "PRESTATIONS INDUSTRIELLES D'éLECTRO-ZINGAGE 800 VA, OUTILLAGE DE COUVERTURE, QUINCAILLERIE LOURDE ET CHANTIERS BTP.": "800 VA INDUSTRIAL ELECTRO-GALVANIZING SERVICES, ROOFING TOOLS, HEAVY HARDWARE, AND CONSTRUCTION SITES.",
    "Fabrication directe sur nos sites de Bekoko et PK12 selon les normes de solidité les plus strictes au Cameroun.": "Direct manufacturing at our Bekoko and PK12 sites adhering to Cameroon's highest structural standards.",
    "FABRICATION DIRECTE SUR NOS SITES DE BEKOKO ET PK12 SELON LES NORMES DE SOLIDITé LES PLUS STRICTES AU CAMEROUN.": "DIRECT MANUFACTURING AT OUR BEKOKO AND PK12 SITES ADHERING TO CAMEROON'S HIGHEST STRUCTURAL STANDARDS.",
    "Remplissez le formulaire ci-dessous pour une prise en charge rapide par nos équipes techniques ou commerciales.": "Fill in the form below for rapid assistance from our technical or sales teams.",
    "REMPLISSEZ LE FORMULAIRE CI-DESSOUS POUR UNE PRISE EN CHARGE RAPIDE PAR NOS éQUIPES TECHNIQUES OU COMMERCIALES.": "FILL IN THE FORM BELOW FOR RAPID ASSISTANCE FROM OUR TECHNICAL OR SALES TEAMS.",
    "Fixations complètes à tirefonds, cavaliers étanches, rouleaux bitumés Toiturole 900G et vis auto-foreuses.": "Complete lag screw fixings, waterproof saddles, Toiturole 900G bitumen rolls, and self-drilling screws.",
    "FIXATIONS COMPLèTES à TIREFONDS, CAVALIERS éTANCHES, ROULEAUX BITUMéS TOITUROLE 900G ET VIS AUTO-FOREUSES.": "COMPLETE LAG SCREW FIXINGS, WATERPROOF SADDLES, TOITUROLE 900G BITUMEN ROLLS, AND SELF-DRILLING SCREWS.",
    "Une capacité industrielle combinée unique au Cameroun pour répondre aux exigences des plus grands projets.": "A unique combined industrial capacity in Cameroon meeting the highest requirements of major projects.",
    "UNE CAPACITé INDUSTRIELLE COMBINéE UNIQUE AU CAMEROUN POUR RéPONDRE AUX EXIGENCES DES PLUS GRANDS PROJETS.": "A UNIQUE COMBINED INDUSTRIAL CAPACITY IN CAMEROON MEETING THE HIGHEST REQUIREMENTS OF MAJOR PROJECTS.",
    "Commandes au mètre linéaire sur-mesure pour tôles BAC, emballages PP tissés et tarification dégressive.": "Custom cut-to-length orders for roofing sheets, woven PP sacks, and tiered volume pricing.",
    "COMMANDES AU MèTRE LINéAIRE SUR-MESURE POUR TôLES BAC, EMBALLAGES PP TISSéS ET TARIFICATION DéGRESSIVE.": "CUSTOM CUT-TO-LENGTH ORDERS FOR ROOFING SHEETS, WOVEN PP SACKS, AND TIERED VOLUME PRICING.",
    "Profilage nervuré haute résistance avec revêtement multicouche anti-UV et anti-corrosion tropicale.": "High-strength ribbed profile with multi-layer anti-UV and tropical anti-corrosion coating.",
    "PROFILAGE NERVURé HAUTE RéSISTANCE AVEC REVêTEMENT MULTICOUCHE ANTI-UV ET ANTI-CORROSION TROPICALE.": "HIGH-STRENGTH RIBBED PROFILE WITH MULTI-LAYER ANTI-UV AND TROPICAL ANTI-CORROSION COATING.",
    "Faîtières double pente, faîtières crantées, demi-rives, rives, gouttières et noues sur-mesure.": "Double-slope ridge caps, notched ridge caps, half-ridges, bargeboards, gutters, and custom valleys.",
    "FAîTIèRES DOUBLE PENTE, FAîTIèRES CRANTéES, DEMI-RIVES, RIVES, GOUTTIèRES ET NOUES SUR-MESURE.": "DOUBLE-SLOPE RIDGE CAPS, NOTCHED RIDGE CAPS, HALF-RIDGES, BARGEBOARDS, GUTTERS, AND CUSTOM VALLEYS.",
    "Carrelage grès cérame italien et espagnol pour sols et murs, douches thérapeutiques Zagonel.": "Italian and Spanish porcelain stoneware tiles for floors and walls, Zagonel therapeutic showers.",
    "CARRELAGE GRèS CéRAME ITALIEN ET ESPAGNOL POUR SOLS ET MURS, DOUCHES THéRAPEUTIQUES ZAGONEL.": "ITALIAN AND SPANISH PORCELAIN STONEWARE TILES FOR FLOORS AND WALLS, ZAGONEL THERAPEUTIC SHOWERS.",
    "Gamme d'emballages en sacs tissés en PP (50kg, 25kg, ciment, agroalimentaire et industrie).": "Range of woven PP bag packaging (50kg, 25kg, cement, agrifood, and industrial).",
    "GAMME D'EMBALLAGES EN SACS TISSéS EN PP (50KG, 25KG, CIMENT, AGROALIMENTAIRE ET INDUSTRIE).": "RANGE OF WOVEN PP BAG PACKAGING (50KG, 25KG, CEMENT, AGRIFOOD, AND INDUSTRIAL).",
    "Joignez directement le département adapté à votre demande pour un traitement express.": "Contact the appropriate department directly for express processing.",
    "JOIGNEZ DIRECTEMENT LE DéPARTEMENT ADAPTé à VOTRE DEMANDE POUR UN TRAITEMENT EXPRESS.": "CONTACT THE APPROPRIATE DEPARTMENT DIRECTLY FOR EXPRESS PROCESSING.",
    "Nos conseillers techniques sont disponibles sur WhatsApp pour une assistance directe.": "Our technical advisors are available on WhatsApp for direct assistance.",
    "NOS CONSEILLERS TECHNIQUES SONT DISPONIBLES SUR WHATSAPP POUR UNE ASSISTANCE DIRECTE.": "OUR TECHNICAL ADVISORS ARE AVAILABLE ON WHATSAPP FOR DIRECT ASSISTANCE.",
    "Nos équipes technico-commerciales sont prêtes à étudier vos cahiers des charges.": "Our technical and sales teams are ready to analyze your project specifications.",
    "NOS éQUIPES TECHNICO-COMMERCIALES SONT PRêTES à éTUDIER VOS CAHIERS DES CHARGES.": "OUR TECHNICAL AND SALES TEAMS ARE READY TO ANALYZE YOUR PROJECT SPECIFICATIONS.",
    "Rechercher un article (ex: Tôle BAC 0.50mm, Faîtière, Sac PP 50kg, Vis 6×80…)": "Search for an item (e.g. 0.50mm Roofing Sheet, Ridge Cap, 50kg PP Bag, 6×80 Screw…)",
    "RECHERCHER UN ARTICLE (EX: TôLE BAC 0.50MM, FAîTIèRE, SAC PP 50KG, VIS 6×80…)": "SEARCH FOR AN ITEM (E.G. 0.50MM ROOFING SHEET, RIDGE CAP, 50KG PP BAG, 6×80 SCREW…)",
    "Nos ingénieurs d'études chiffrent vos bordereaux de toiture sous 2 heures.": "Our structural engineers calculate your roofing schedules within 2 hours.",
    "NOS INGéNIEURS D'éTUDES CHIFFRENT VOS BORDEREAUX DE TOITURE SOUS 2 HEURES.": "OUR STRUCTURAL ENGINEERS CALCULATE YOUR ROOFING SCHEDULES WITHIN 2 HOURS.",
    "LE LEADER DE LA MÉTALLURGIE &amp; DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
    "LE LEADER DE LA MÉTALLURGIE &AMP; DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
    "LE LEADER DE LA MÉTALLURGIE & DES MATÉRIAUX INDUSTRIELS AU CAMEROUN.": "THE LEADER IN METALLURGY & INDUSTRIAL MATERIALS IN CAMEROON.",
    "\"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ\"": "\"SOLID BUILDINGS = SOLID MATERIALS WITH GUARANTEED DURABILITY\"",
    "50 Ans d'Excellence Métallurgique &amp; de Plasturgie au Cameroun.": "50 Years of Metallurgical & Plastics Excellence in Cameroon.",
    "50 ANS D'EXCELLENCE MéTALLURGIQUE &AMP; DE PLASTURGIE AU CAMEROUN.": "50 YEARS OF METALLURGICAL & PLASTICS EXCELLENCE IN CAMEROON.",
    "Besoin d'une Facture Pro-Forma officielle ou d'une cotation B2B ?": "Need an official Pro-Forma invoice or B2B quote?",
    "BESOIN D'UNE FACTURE PRO-FORMA OFFICIELLE OU D'UNE COTATION B2B ?": "NEED AN OFFICIAL PRO-FORMA INVOICE OR B2B QUOTE?",
    "Une transparence totale pour vos déductions de TVA et audits BTP": "Total transparency for your VAT deductions and construction audits",
    "UNE TRANSPARENCE TOTALE POUR VOS DéDUCTIONS DE TVA ET AUDITS BTP": "TOTAL TRANSPARENCY FOR YOUR VAT DEDUCTIONS AND CONSTRUCTION AUDITS",
    "50 Ans d'Excellence Métallurgique & de Plasturgie au Cameroun.": "50 Years of Metallurgical & Plastics Excellence in Cameroon.",
    "50 ANS D'EXCELLENCE MéTALLURGIQUE & DE PLASTURGIE AU CAMEROUN.": "50 YEARS OF METALLURGICAL & PLASTICS EXCELLENCE IN CAMEROON.",
    "50 ans d'engagement pour l'autonomie productive du Cameroun": "50 years of commitment to Cameroon's industrial self-reliance",
    "50 ANS D'ENGAGEMENT POUR L'AUTONOMIE PRODUCTIVE DU CAMEROUN": "50 YEARS OF COMMITMENT TO CAMEROON'S INDUSTRIAL SELF-RELIANCE",
    "✔ Conforme à la réglementation fiscale du Cameroun": "✔ Fully compliant with Cameroon tax regulations",
    "✔ CONFORME à LA RéGLEMENTATION FISCALE DU CAMEROUN": "✔ FULLY COMPLIANT WITH CAMEROON TAX REGULATIONS",
    "Document Pro-Forma Officiel B2B — Valable 30 Jours": "Official B2B Pro-Forma Document — Valid 30 Days",
    "DOCUMENT PRO-FORMA OFFICIEL B2B — VALABLE 30 JOURS": "OFFICIAL B2B PRO-FORMA DOCUMENT — VALID 30 DAYS",
    "Document Pro-Forma Officiel B2B - Valable 30 Jours": "Official B2B Pro-Forma Document - Valid 30 Days",
    "DOCUMENT PRO-FORMA OFFICIEL B2B - VALABLE 30 JOURS": "OFFICIAL B2B PRO-FORMA DOCUMENT - VALID 30 DAYS",
    "Plans, bordereaux de métrés ou fiches techniques": "Blueprints, quantity schedules or technical datasheets",
    "PLANS, BORDEREAUX DE MéTRéS OU FICHES TECHNIQUES": "BLUEPRINTS, QUANTITY SCHEDULES OR TECHNICAL DATASHEETS",
    "Télécharger les Certificats Fiscaux & Documents": "Download Fiscal Certificates & Documents",
    "TéLéCHARGER LES CERTIFICATS FISCAUX & DOCUMENTS": "DOWNLOAD FISCAL CERTIFICATES & DOCUMENTS",
    "USINE MÉTALLURGIQUE &amp; PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
    "USINE MÉTALLURGIQUE &AMP; PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
    "Cliquez ou glissez vos fichiers ici (Max 10MB)": "Click or drag your files here (Max 10MB)",
    "CLIQUEZ OU GLISSEZ VOS FICHIERS ICI (MAX 10MB)": "CLICK OR DRAG YOUR FILES HERE (MAX 10MB)",
    "Ajustement immédiat des devis usine en 2 min": "Instant factory quote calculation in 2 min",
    "AJUSTEMENT IMMéDIAT DES DEVIS USINE EN 2 MIN": "INSTANT FACTORY QUOTE CALCULATION IN 2 MIN",
    "2 Sites de Production Stratégiques à Douala": "2 Strategic Production Sites in Douala",
    "2 SITES DE PRODUCTION STRATéGIQUES à DOUALA": "2 STRATEGIC PRODUCTION SITES IN DOUALA",
    "CONTACT & GÉOLOCALISATION DE L'USINE TPM SA": "CONTACT & GEOLOCATION OF TPM SA FACTORY",
    "Votre Panier Pro-Forma est actuellement vide": "Your Pro-Forma Quote is currently empty",
    "VOTRE PANIER PRO-FORMA EST ACTUELLEMENT VIDE": "YOUR PRO-FORMA QUOTE IS CURRENTLY EMPTY",
    "Consulter l'Inventaire Complet (58 Articles)": "Browse Full Inventory (58 Products)",
    "CONSULTER L'INVENTAIRE COMPLET (58 ARTICLES)": "BROWSE FULL INVENTORY (58 PRODUCTS)",
    "USINE MÉTALLURGIQUE & PLASTURGIE CAMEROUN": "METALLURGICAL & PLASTICS FACTORY CAMEROON",
    "58 Références Industrielles Direct Usine": "58 Direct Factory Industrial References",
    "58 RéFéRENCES INDUSTRIELLES DIRECT USINE": "58 DIRECT FACTORY INDUSTRIAL REFERENCES",
    "Télécharger le Catalogue Général (PDF)": "Download General Catalog (PDF)",
    "TéLéCHARGER LE CATALOGUE GéNéRAL (PDF)": "DOWNLOAD GENERAL CATALOG (PDF)",
    "Ex: Tôle bac alu, faîtière, tirefond...": "E.g.: Alu roofing sheet, ridge cap, lag screw...",
    "EX: TôLE BAC ALU, FAîTIèRE, TIREFOND...": "E.G.: ALU ROOFING SHEET, RIDGE CAP, LAG SCREW...",
    "Conception Industrielle & Numérique CEMAC": "CEMAC Industrial & Digital Design",
    "CONCEPTION INDUSTRIELLE & NUMéRIQUE CEMAC": "CEMAC INDUSTRIAL & DIGITAL DESIGN",
    "Expéditions Grand Nord & CEMAC : 24h\/48h": "Grand North & CEMAC Dispatch: 24h\/48h",
    "EXPéDITIONS GRAND NORD & CEMAC : 24H\/48H": "GRAND NORTH & CEMAC DISPATCH: 24H\/48H",
    "Nos 4 Domaines d'Activité Industrielle": "Our 4 Industrial Activity Sectors",
    "NOS 4 DOMAINES D'ACTIVITé INDUSTRIELLE": "OUR 4 INDUSTRIAL ACTIVITY SECTORS",
    "Nos 6 Domaines d'Activité Industrielle": "Our Industrial Activity Sectors",
    "NOS 6 DOMAINES D'ACTIVITé INDUSTRIELLE": "OUR INDUSTRIAL ACTIVITY SECTORS",
    "L'Éventail de nos Lignes de Production": "Our Production Lines Overview",
    "L'ÉVENTAIL DE NOS LIGNES DE PRODUCTION": "OUR PRODUCTION LINES OVERVIEW",
    "Consulter les 58 références usine TPM": "Browse all 58 TPM factory references",
    "CONSULTER LES 58 RéFéRENCES USINE TPM": "BROWSE ALL 58 TPM FACTORY REFERENCES",
    "FONDÉ PAR M. NJIPNGANG • DEPUIS 1976": "FOUNDED BY MR. NJIPNGANG • SINCE 1976",
    "Comptoir PK12 : Lun - Sam 08h00 - 17h00": "PK12 Counter: Mon - Sat 08:00 AM - 05:00 PM",
    "COMPTOIR PK12 : LUN - SAM 08H00 - 17H00": "PK12 COUNTER: MON - SAT 08:00 AM - 05:00 PM",
    "Ouvrir l'Itinéraire GPS (Google Maps)": "Open GPS Directions (Google Maps)",
    "OUVRIR L'ITINéRAIRE GPS (GOOGLE MAPS)": "OPEN GPS DIRECTIONS (GOOGLE MAPS)",
    "Usine Bekoko : Lun - Ven 07h30 - 18h00": "Bekoko Factory: Mon - Fri 07:30 AM - 06:00 PM",
    "USINE BEKOKO : LUN - VEN 07H30 - 18H00": "BEKOKO FACTORY: MON - FRI 07:30 AM - 06:00 PM",
    "CONTACT & GÉOLOCALISATION DE L'USINE": "CONTACT & FACTORY GEOLOCATION",
    "Bureau d'Études & Calepinage Toiture": "Engineering & Roofing Layout",
    "BUREAU D'ÉTUDES & CALEPINAGE TOITURE": "ENGINEERING & ROOFING LAYOUT",
    "Logistique & Enlèvement Usine Bekoko": "Logistics & Factory Pickup Bekoko",
    "LOGISTIQUE & ENLèVEMENT USINE BEKOKO": "LOGISTICS & FACTORY PICKUP BEKOKO",
    "Générer mon Devis Pro-Forma Direct": "Generate Instant Pro-Forma Quote",
    "GéNéRER MON DEVIS PRO-FORMA DIRECT": "GENERATE INSTANT PRO-FORMA QUOTE",
    "Télécharger Fiche Entreprise (PDF)": "Download Company Profile (PDF)",
    "TéLéCHARGER FICHE ENTREPRISE (PDF)": "DOWNLOAD COMPANY PROFILE (PDF)",
    "Accessoires Intérieurs & Plasturgie": "Interior Accessories & Plastics",
    "ACCESSOIRES INTéRIEURS & PLASTURGIE": "INTERIOR ACCESSORIES & PLASTICS",
    "Articles Phares Disponible en Stock": "Featured Products Available in Stock",
    "ARTICLES PHARES DISPONIBLE EN STOCK": "FEATURED PRODUCTS AVAILABLE IN STOCK",
    "Voir les 22 articles intérieurs »": "View all 22 interior items »",
    "VOIR LES 22 ARTICLES INTéRIEURS »": "VIEW ALL 22 INTERIOR ITEMS »",
    "Approvisionnement Gros Chantier BTP": "Major Construction Site Supply",
    "APPROVISIONNEMENT GROS CHANTIER BTP": "MAJOR CONSTRUCTION SITE SUPPLY",
    "VOTRE FACTURE PRO-FORMA OFFICIELLE": "YOUR OFFICIAL PRO-FORMA INVOICE",
    "CAPACITÉS & GAMMES DE FABRICATION": "MANUFACTURING CAPACITIES & RANGES",
    "Transmettre au Commercial WhatsApp": "Send to WhatsApp Sales Representative",
    "TRANSMETTRE AU COMMERCIAL WHATSAPP": "SEND TO WHATSAPP SALES REPRESENTATIVE",
    "NIU (Numéro d'Identifiant Unique)": "TIN (Taxpayer Identification Number)",
    "NIU (NUMéRO D'IDENTIFIANT UNIQUE)": "TIN (TAXPAYER IDENTIFICATION NUMBER)",
    "Pièces Jointes (PDF, DWG, Images)": "Attachments (PDF, DWG, Images)",
    "PIèCES JOINTES (PDF, DWG, IMAGES)": "ATTACHMENTS (PDF, DWG, IMAGES)",
    "Gouvernance & Conformité Fiscale": "Governance & Fiscal Compliance",
    "GOUVERNANCE & CONFORMITé FISCALE": "GOVERNANCE & FISCAL COMPLIANCE",
    "Prêt à Collaborer avec TPM SA ?": "Ready to Partner with TPM SA?",
    "PRêT à COLLABORER AVEC TPM SA ?": "READY TO PARTNER WITH TPM SA?",
    "Contacter la Direction Générale": "Contact Executive Management",
    "CONTACTER LA DIRECTION GéNéRALE": "CONTACT EXECUTIVE MANAGEMENT",
    "Continuer vos ajouts au catalogue": "Continue adding items from catalog",
    "CONTINUER VOS AJOUTS AU CATALOGUE": "CONTINUE ADDING ITEMS FROM CATALOG",
    "Accessoires Intérieurs & Sacs PP": "Interior Accessories & PP Bags",
    "ACCESSOIRES INTéRIEURS & SACS PP": "INTERIOR ACCESSORIES & PP BAGS",
    "Catalogue Général (58 Articles)": "General Catalog (58 Items)",
    "CATALOGUE GéNéRAL (58 ARTICLES)": "GENERAL CATALOG (58 ITEMS)",
    "Télécharger ma Pro-Forma (PDF)": "Download Pro-Forma (PDF)",
    "TéLéCHARGER MA PRO-FORMA (PDF)": "DOWNLOAD PRO-FORMA (PDF)",
    "Télécharger le Catalogue (PDF)": "Download Catalog (PDF)",
    "TéLéCHARGER LE CATALOGUE (PDF)": "DOWNLOAD CATALOG (PDF)",
    "Numéro NIU \/ N° Contribuable :": "Tax ID (TIN):",
    "NUMéRO NIU \/ N° CONTRIBUABLE :": "TAX ID (TIN):",
    "Message \/ Détails de la demande": "Message \/ Request Details",
    "MESSAGE \/ DéTAILS DE LA DEMANDE": "MESSAGE \/ REQUEST DETAILS",
    "Faîtières, Rives & Gouttières": "Ridge Caps, Bargeboards & Gutters",
    "FAîTIèRES, RIVES & GOUTTIèRES": "RIDGE CAPS, BARGEBOARDS & GUTTERS",
    "Station Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA Station",
    "STATION ÉLECTRO-ZINGAGE 800 VA": "ELECTRO-GALVANIZING 800 VA STATION",
    "Approvisionnement Chantiers BTP": "Construction Worksite Supply",
    "APPROVISIONNEMENT CHANTIERS BTP": "CONSTRUCTION WORKSITE SUPPLY",
    "Besoin d'un Devis Sur Mesure ?": "Need a Custom Quote?",
    "BESOIN D'UN DEVIS SUR MESURE ?": "NEED A CUSTOM QUOTE?",
    "Explorer le Catalogue Officiel": "Explore Official Catalog",
    "EXPLORER LE CATALOGUE OFFICIEL": "EXPLORE OFFICIAL CATALOG",
    "ENVOYER MON MESSAGE À L'USINE": "SEND MY MESSAGE TO THE FACTORY",
    "Paiement Sécurisé \/ Virement": "Secure Payment \/ Bank Transfer",
    "PAIEMENT SéCURISé \/ VIREMENT": "SECURE PAYMENT \/ BANK TRANSFER",
    "Nom de l'Entreprise \/ Client :": "Company \/ Customer Name:",
    "NOM DE L'ENTREPRISE \/ CLIENT :": "COMPANY \/ CUSTOMER NAME:",
    "Lieu de Livraison \/ Chantier :": "Delivery Location \/ Site:",
    "LIEU DE LIVRAISON \/ CHANTIER :": "DELIVERY LOCATION \/ SITE:",
    "Logistique & Enlèvement Usine": "Logistics & Factory Pickup",
    "LOGISTIQUE & ENLèVEMENT USINE": "LOGISTICS & FACTORY PICKUP",
    "Fixations Complètes & Pointes": "Complete Fasteners & Nails",
    "FIXATIONS COMPLèTES & POINTES": "COMPLETE FASTENERS & NAILS",
    "Voir le Catalogue Tôles PK12": "View PK12 Roofing Catalog",
    "VOIR LE CATALOGUE TôLES PK12": "VIEW PK12 ROOFING CATALOG",
    "GÉNÉRER MA PRO-FORMA EN PDF": "GENERATE PRO-FORMA PDF",
    "Valider la Commande Usine →": "Confirm Factory Order →",
    "VALIDER LA COMMANDE USINE →": "CONFIRM FACTORY ORDER →",
    "Bureau d'Études \/ Calepinage": "Engineering & Roofing Layout",
    "BUREAU D'ÉTUDES \/ CALEPINAGE": "ENGINEERING & ROOFING LAYOUT",
    "Quincaillerie & Outillage BTP": "Hardware & Construction Tools",
    "QUINCAILLERIE & OUTILLAGE BTP": "HARDWARE & CONSTRUCTION TOOLS",
    "USINE HISTORIQUE N°1 (PK12)": "HISTORIC FACTORY #1 (PK12)",
    "Commercial & Devis Pro-Forma": "Sales & Pro-Forma Quotes",
    "COMMERCIAL & DEVIS PRO-FORMA": "SALES & PRO-FORMA QUOTES",
    "PÔLES DE PRODUCTION TPM SA": "TPM SA PRODUCTION HUBS",
    "Nos Canaux de Communication": "Our Communication Channels",
    "NOS CANAUX DE COMMUNICATION": "OUR COMMUNICATION CHANNELS",
    "Notre Histoire Industrielle": "Our Industrial History",
    "NOTRE HISTOIRE INDUSTRIELLE": "OUR INDUSTRIAL HISTORY",
    "Explorer le Catalogue Usine": "Explore Factory Catalog",
    "EXPLORER LE CATALOGUE USINE": "EXPLORE FACTORY CATALOG",
    "Support WhatsApp Commercial": "Commercial WhatsApp Support",
    "SUPPORT WHATSAPP COMMERCIAL": "COMMERCIAL WHATSAPP SUPPORT",
    "Mettre à jour la Pro-Forma": "Update Pro-Forma",
    "METTRE à JOUR LA PRO-FORMA": "UPDATE PRO-FORMA",
    "Sélectionnez un service...": "Select a department...",
    "SéLECTIONNEZ UN SERVICE...": "SELECT A DEPARTMENT...",
    "Sacs PP Blancs 50kg \/ 100kg": "White PP Bags 50kg \/ 100kg",
    "SACS PP BLANCS 50KG \/ 100KG": "WHITE PP BAGS 50KG \/ 100KG",
    "GÉNÉRATEUR PRO-FORMA B2B": "B2B PRO-FORMA GENERATOR",
    "Coordonnées de l'Acheteur": "Buyer \/ Company Details",
    "COORDONNéES DE L'ACHETEUR": "BUYER \/ COMPANY DETAILS",
    "WhatsApp Commercial Direct": "Direct Commercial WhatsApp",
    "WHATSAPP COMMERCIAL DIRECT": "DIRECT COMMERCIAL WHATSAPP",
    "Voir les 17 accessoires »": "View all 17 accessories »",
    "VOIR LES 17 ACCESSOIRES »": "VIEW ALL 17 ACCESSORIES »",
    "Fixations et étanchéité": "Fasteners & Waterproofing",
    "FIXATIONS ET éTANCHéITé": "FASTENERS & WATERPROOFING",
    "Demande de Pro-Forma Flash": "Flash Pro-Forma Request",
    "DEMANDE DE PRO-FORMA FLASH": "FLASH PRO-FORMA REQUEST",
    "CATALOGUE OFFICIEL TPM SA": "OFFICIAL TPM SA CATALOG",
    "Valider la Commande Usine": "Confirm Factory Order",
    "VALIDER LA COMMANDE USINE": "CONFIRM FACTORY ORDER",
    "Tarif HT \/ Boîte 100 pcs": "Price Excl. Tax \/ Box 100 pcs",
    "TARIF HT \/ BOîTE 100 PCS": "PRICE EXCL. TAX \/ BOX 100 PCS",
    "Fixations & Étanchéité": "Fasteners & Waterproofing",
    "FIXATIONS & ÉTANCHéITé": "FASTENERS & WATERPROOFING",
    "Fixations & étanchéité": "Fasteners & Waterproofing",
    "FIXATIONS & éTANCHéITé": "FASTENERS & WATERPROOFING",
    "Carrelages & Revêtements": "Tiles & Floor Coverings",
    "CARRELAGES & REVêTEMENTS": "TILES & FLOOR COVERINGS",
    "Localiser l'Usine Bekoko": "Locate Bekoko Factory",
    "LOCALISER L'USINE BEKOKO": "LOCATE BEKOKO FACTORY",
    "Localiser le Site Bekoko": "Locate Bekoko Site",
    "LOCALISER LE SITE BEKOKO": "LOCATE BEKOKO SITE",
    "Mettre à jour le panier": "Update Cart",
    "METTRE à JOUR LE PANIER": "UPDATE CART",
    "Voir les 10 fixations »": "View all 10 fasteners »",
    "VOIR LES 10 FIXATIONS »": "VIEW ALL 10 FASTENERS »",
    "Voir les Carreaux & Sols": "View Tiles & Floors",
    "VOIR LES CARREAUX & SOLS": "VIEW TILES & FLOORS",
    "SÉLECTIONNER UN ARTICLE": "SELECT AN ITEM",
    "Téléphone \/ WhatsApp :": "Phone \/ WhatsApp:",
    "TéLéPHONE \/ WHATSAPP :": "PHONE \/ WHATSAPP:",
    "Rechercher un produit...": "Search for a product...",
    "RECHERCHER UN PRODUIT...": "SEARCH FOR A PRODUCT...",
    "Tôles & Couvertures BAC": "Roofing Sheets & BAC Coverings",
    "TôLES & COUVERTURES BAC": "ROOFING SHEETS & BAC COVERINGS",
    "Carreaux & Emballages PP": "Tiles & PP Packaging",
    "CARREAUX & EMBALLAGES PP": "TILES & PP PACKAGING",
    "INVENTAIRE DIRECT USINE": "DIRECT FACTORY INVENTORY",
    "FLASH PRO-FORMA EXPRESS": "FLASH PRO-FORMA EXPRESS",
    "Décompte Financier B2B": "B2B Financial Summary",
    "DéCOMPTE FINANCIER B2B": "B2B FINANCIAL SUMMARY",
    "Générer une Pro-Forma": "Generate Pro-Forma",
    "GéNéRER UNE PRO-FORMA": "GENERATE PRO-FORMA",
    "Ajouter à la Pro-Forma": "Add to Pro-Forma",
    "AJOUTER à LA PRO-FORMA": "ADD TO PRO-FORMA",
    "Voir les 10 Tôles Bacs": "View 10 Roofing Sheets",
    "VOIR LES 10 TôLES BACS": "VIEW 10 ROOFING SHEETS",
    "Voir les 17 Accessoires": "View 17 Accessories",
    "VOIR LES 17 ACCESSOIRES": "VIEW 17 ACCESSORIES",
    "Voir les Sacs PP Bekoko": "View Bekoko PP Bags",
    "VOIR LES SACS PP BEKOKO": "VIEW BEKOKO PP BAGS",
    "Longueur personnalisée": "Custom Length",
    "LONGUEUR PERSONNALISéE": "CUSTOM LENGTH",
    "Découpe au Centimètre": "Cut to Centimeter",
    "DéCOUPE AU CENTIMèTRE": "CUT TO CENTIMETER",
    "PÔLE N°1 • 10 RÉF.": "SECTOR #1 • 10 ITEMS",
    "PÔLE N°2 • 17 RÉF.": "SECTOR #2 • 17 ITEMS",
    "PÔLE N°3 • 10 RÉF.": "SECTOR #3 • 10 ITEMS",
    "PÔLE N°4 • 22 RÉF.": "SECTOR #4 • 22 ITEMS",
    "Total des articles HT :": "Items Subtotal Excl. Tax:",
    "TOTAL DES ARTICLES HT :": "ITEMS SUBTOTAL EXCL. TAX:",
    "TVA Cameroun (19.25%) :": "Cameroon VAT (19.25%):",
    "TVA CAMEROUN (19.25%) :": "CAMEROON VAT (19.25%):",
    "Articles Sélectionnés": "Selected Items",
    "ARTICLES SéLECTIONNéS": "SELECTED ITEMS",
    "Accessoires intérieurs": "Interior Accessories & Bags",
    "ACCESSOIRES INTéRIEURS": "INTERIOR ACCESSORIES & BAGS",
    "Emballages & Plastiques": "Packaging & Plastics",
    "EMBALLAGES & PLASTIQUES": "PACKAGING & PLASTICS",
    "Carreaux & Revêtements": "Tiles & Floor Coverings",
    "CARREAUX & REVêTEMENTS": "TILES & FLOOR COVERINGS",
    "Électro-Zingage 800 VA": "Electro-Galvanizing 800 VA",
    "ÉLECTRO-ZINGAGE 800 VA": "ELECTRO-GALVANIZING 800 VA",
    "Tous droits réservés.": "All rights reserved.",
    "TOUS DROITS RéSERVéS.": "ALL RIGHTS RESERVED.",
    "SÉLECTION D'ACTIVITÉ": "CATEGORY SELECTION",
    "CONTACTER SUR WHATSAPP": "CONTACT ON WHATSAPP",
    "Générer ma Pro-Forma": "Generate Pro-Forma",
    "GéNéRER MA PRO-FORMA": "GENERATE PRO-FORMA",
    "Connexion \/ Mon Compte": "Login \/ My Account",
    "CONNEXION \/ MON COMPTE": "LOGIN \/ MY ACCOUNT",
    "Livraison Rapide CEMAC": "Fast CEMAC Delivery",
    "LIVRAISON RAPIDE CEMAC": "FAST CEMAC DELIVERY",
    "COMPLEXE N°2 (BEKOKO)": "INDUSTRIAL COMPLEX #2 (BEKOKO)",
    "Tarif HT \/ m linéaire": "Price Excl. Tax \/ lin. meter",
    "TARIF HT \/ M LINéAIRE": "PRICE EXCL. TAX \/ LIN. METER",
    "Tarif HT \/ Rouleau 10m": "Price Excl. Tax \/ 10m Roll",
    "TARIF HT \/ ROULEAU 10M": "PRICE EXCL. TAX \/ 10M ROLL",
    "Tarif HT \/ Lot 500 pcs": "Price Excl. Tax \/ Pack 500 pcs",
    "TARIF HT \/ LOT 500 PCS": "PRICE EXCL. TAX \/ PACK 500 PCS",
    "Frais de Manutention :": "Handling Charges:",
    "FRAIS DE MANUTENTION :": "HANDLING CHARGES:",
    "Accessoires de Toiture": "Roofing Accessories",
    "ACCESSOIRES DE TOITURE": "ROOFING ACCESSORIES",
    "Tôles BAC & Ondulées": "Roofing Sheets & Corrugated",
    "TôLES BAC & ONDULéES": "ROOFING SHEETS & CORRUGATED",
    "Demander un Devis B2B": "Request B2B Quote",
    "DEMANDER UN DEVIS B2B": "REQUEST B2B QUOTE",
    "Accéder au Catalogue": "Browse Catalog",
    "ACCéDER AU CATALOGUE": "BROWSE CATALOG",
    "Voir les 10 Fixations": "View 10 Fasteners",
    "VOIR LES 10 FIXATIONS": "VIEW 10 FASTENERS",
    "Voir les 10 tôles »": "View all 10 roofing sheets »",
    "VOIR LES 10 TôLES »": "VIEW ALL 10 ROOFING SHEETS »",
    "Voir la Quincaillerie": "View Hardware",
    "VOIR LA QUINCAILLERIE": "VIEW HARDWARE",
    "Épaisseur Certifiée": "Certified Thickness",
    "ÉPAISSEUR CERTIFIéE": "CERTIFIED THICKNESS",
    "Usines: PK12 & Bekoko": "Factories: PK12 & Bekoko",
    "USINES: PK12 & BEKOKO": "FACTORIES: PK12 & BEKOKO",
    "TOTAL GÉNÉRAL TTC :": "GRAND TOTAL INCL. TAX:",
    "Article \/ Référence": "Item \/ Reference",
    "ARTICLE \/ RéFéRENCE": "ITEM \/ REFERENCE",
    "Carreaux & Sanitaires": "Tiles & Sanitaryware",
    "CARREAUX & SANITAIRES": "TILES & SANITARYWARE",
    "Services & Pro-Forma": "Services & Pro-Forma",
    "SERVICES & PRO-FORMA": "SERVICES & PRO-FORMA",
    "Horaires d'Ouverture": "Opening Hours",
    "HORAIRES D'OUVERTURE": "OPENING HOURS",
    "Mon Panier Pro-Forma": "My Pro-Forma Quote",
    "MON PANIER PRO-FORMA": "MY PRO-FORMA QUOTE",
    "Continuer mes achats": "Continue shopping",
    "CONTINUER MES ACHATS": "CONTINUE SHOPPING",
    "Voir les 22 Articles": "View 22 Interior Products",
    "VOIR LES 22 ARTICLES": "VIEW 22 INTERIOR PRODUCTS",
    "PK12 & Bekoko Douala": "PK12 & Bekoko Douala",
    "PK12 & BEKOKO DOUALA": "PK12 & BEKOKO DOUALA",
    "Tarif HT \/ Pièce 2m": "Price Excl. Tax \/ 2m Piece",
    "TARIF HT \/ PIèCE 2M": "PRICE EXCL. TAX \/ 2M PIECE",
    "Nom \/ Raison Sociale": "Full Name \/ Company Name",
    "NOM \/ RAISON SOCIALE": "FULL NAME \/ COMPANY NAME",
    "Tôles & Couvertures": "Roofing Sheets & Coverings",
    "TôLES & COUVERTURES": "ROOFING SHEETS & COVERINGS",
    "Envoyer une Demande": "Send an Inquiry",
    "ENVOYER UNE DEMANDE": "SEND AN INQUIRY",
    "Informations Usines": "Factory Information",
    "INFORMATIONS USINES": "FACTORY INFORMATION",
    "Détails du Produit": "Product Details",
    "DéTAILS DU PRODUIT": "PRODUCT DETAILS",
    "Tradition 1976-2026": "Tradition 1976-2026",
    "TRADITION 1976-2026": "TRADITION 1976-2026",
    "Email Professionnel": "Work Email",
    "EMAIL PROFESSIONNEL": "WORK EMAIL",
    "Email Facturation :": "Billing Email:",
    "EMAIL FACTURATION :": "BILLING EMAIL:",
    "Accessoires toiture": "Roofing Accessories",
    "ACCESSOIRES TOITURE": "ROOFING ACCESSORIES",
    "Accessoires Toiture": "Roofing Accessories",
    "Quincaillerie & BTP": "Hardware & Construction",
    "QUINCAILLERIE & BTP": "HARDWARE & CONSTRUCTION",
    "mètres linéaires": "linear meters",
    "MèTRES LINéAIRES": "LINEAR METERS",
    "Mon Espace Client": "My Customer Account",
    "MON ESPACE CLIENT": "MY CUSTOMER ACCOUNT",
    "Ajouter au Panier": "Add to Cart",
    "AJOUTER AU PANIER": "ADD TO CART",
    "Conformité CEMAC": "CEMAC Compliance",
    "CONFORMITé CEMAC": "CEMAC COMPLIANCE",
    "Service Concerné": "Department \/ Service",
    "SERVICE CONCERNé": "DEPARTMENT \/ SERVICE",
    "Tôles et toiture": "Roofing Sheets & Roofing",
    "TôLES ET TOITURE": "ROOFING SHEETS & ROOFING",
    "Tôles et Toiture": "Roofing Sheets & Roofing",
    "Tôles & Toitures": "Roofing Sheets & Roofing",
    "TôLES & TOITURES": "ROOFING SHEETS & ROOFING",
    "Espace Devis B2B": "B2B Quote Portal",
    "ESPACE DEVIS B2B": "B2B QUOTE PORTAL",
    "Panier Pro-Forma": "Pro-Forma Quote",
    "PANIER PRO-FORMA": "PRO-FORMA QUOTE",
    "Prix Unitaire HT": "Unit Price Excl. Tax",
    "PRIX UNITAIRE HT": "UNIT PRICE EXCL. TAX",
    "Numéro WhatsApp": "WhatsApp Number",
    "NUMéRO WHATSAPP": "WHATSAPP NUMBER",
    "mètre linéaire": "linear meter",
    "MèTRE LINéAIRE": "LINEAR METER",
    "Vider le panier": "Clear quote",
    "VIDER LE PANIER": "CLEAR QUOTE",
    "Voir le produit": "View product",
    "VOIR LE PRODUIT": "VIEW PRODUCT",
    "Fiche Technique": "Technical Specs",
    "FICHE TECHNIQUE": "TECHNICAL SPECS",
    "Total HT (FCFA)": "Total Excl. Tax (FCFA)",
    "TOTAL HT (FCFA)": "TOTAL EXCL. TAX (FCFA)",
    "Spécifications": "Specifications",
    "SPéCIFICATIONS": "SPECIFICATIONS",
    "Sites & Accès": "Sites & Access",
    "SITES & ACCèS": "SITES & ACCESS",
    "En Stock Usine": "In Factory Stock",
    "EN STOCK USINE": "IN FACTORY STOCK",
    "Tarif Usine HT": "Factory Price Excl. Tax",
    "TARIF USINE HT": "FACTORY PRICE EXCL. TAX",
    "Total Ligne HT": "Line Total Excl. Tax",
    "TOTAL LIGNE HT": "LINE TOTAL EXCL. TAX",
    "Article & Réf": "Item & SKU",
    "ARTICLE & RéF": "ITEM & SKU",
    "Nos Produits": "Our Products",
    "NOS PRODUITS": "OUR PRODUCTS",
    "L'Entreprise": "About Us",
    "L'ENTREPRISE": "ABOUT US",
    "PME Agréée": "Certified Enterprise",
    "PME AGRééE": "CERTIFIED ENTERPRISE",
    "+ TVA 19.25%": "+ 19.25% VAT",
    "Inclus Usine": "Factory Included",
    "INCLUS USINE": "FACTORY INCLUDED",
    "Métallurgie": "Metallurgy",
    "MéTALLURGIE": "METALLURGY",
    "Prélaquées": "Pre-painted",
    "PRéLAQUéES": "PRE-PAINTED",
    "Alu brillant": "Glossy Alu",
    "ALU BRILLANT": "GLOSSY ALU",
    "+ Pro-Forma": "+ Add to Quote",
    "+ PRO-FORMA": "+ ADD TO QUOTE",
    "Faîtières": "Ridge Caps",
    "FAîTIèRES": "RIDGE CAPS",
    "Gouttières": "Gutters",
    "GOUTTIèRES": "GUTTERS",
    "Galvanisée": "Galvanized",
    "GALVANISéE": "GALVANIZED",
    "Prélaquée": "Pre-painted",
    "PRéLAQUéE": "PRE-PAINTED",
    "Bleu Cendre": "Ash Blue",
    "BLEU CENDRE": "ASH BLUE",
    "Mon Panier": "My Cart",
    "MON PANIER": "MY CART",
    "Rechercher": "Search",
    "RECHERCHER": "SEARCH",
    "Faîtière": "Ridge Cap",
    "FAîTIèRE": "RIDGE CAP",
    "Gouttière": "Gutter",
    "GOUTTIèRE": "GUTTER",
    "Carrelages": "Tiles",
    "CARRELAGES": "TILES",
    "Plasturgie": "Plastics",
    "PLASTURGIE": "PLASTICS",
    "Galvanisé": "Galvanized",
    "GALVANISé": "GALVANIZED",
    "Prélaqué": "Pre-painted",
    "PRéLAQUé": "PRE-PAINTED",
    "Nervurées": "Ribbed",
    "NERVURéES": "RIBBED",
    "Vert Olive": "Olive Green",
    "VERT OLIVE": "OLIVE GREEN",
    "Catalogue": "Catalog",
    "CATALOGUE": "CATALOG",
    "Quantité": "Quantity",
    "QUANTITé": "QUANTITY",
    "Longueur:": "Length:",
    "LONGUEUR:": "LENGTH:",
    "Tirefonds": "Lag Screws",
    "TIREFONDS": "LAG SCREWS",
    "Cavaliers": "Saddle Washers",
    "CAVALIERS": "SADDLE WASHERS",
    "Carrelage": "Tile",
    "CARRELAGE": "TILE",
    "Ondulées": "Corrugated",
    "ONDULéES": "CORRUGATED",
    "Nervurée": "Ribbed",
    "NERVURéE": "RIBBED",
    "Livraison": "Delivery",
    "LIVRAISON": "DELIVERY",
    "Chercher": "Search",
    "CHERCHER": "SEARCH",
    "En Stock": "In Stock",
    "EN STOCK": "IN STOCK",
    "Couleur:": "Color:",
    "COULEUR:": "COLOR:",
    "rouleaux": "rolls",
    "ROULEAUX": "ROLLS",
    "Tirefond": "Lag Screw",
    "TIREFOND": "LAG SCREW",
    "Cavalier": "Saddle Washer",
    "CAVALIER": "SADDLE WASHER",
    "Carreaux": "Tiles",
    "CARREAUX": "TILES",
    "Ondulée": "Corrugated",
    "ONDULéE": "CORRUGATED",
    "Nervuré": "Ribbed",
    "NERVURé": "RIBBED",
    "Ateliers": "Workshops",
    "ATELIERS": "WORKSHOPS",
    "Boutique": "Shop",
    "BOUTIQUE": "SHOP",
    "Paiement": "Payment",
    "PAIEMENT": "PAYMENT",
    "Garantie": "Warranty",
    "GARANTIE": "WARRANTY",
    "Qualité": "Quality",
    "QUALITé": "QUALITY",
    "Accueil": "Home",
    "ACCUEIL": "HOME",
    "Contact": "Contact Us",
    "CONTACT": "CONTACT US",
    "2 SITES": "2 SITES",
    "100% NC": "100% NC",
    "Dispo :": "Avail.:",
    "DISPO :": "AVAIL.:",
    "Actions": "Actions",
    "ACTIONS": "ACTIONS",
    "unités": "units",
    "UNITéS": "UNITS",
    "boîtes": "boxes",
    "BOîTES": "BOXES",
    "paquets": "packs",
    "PAQUETS": "PACKS",
    "rouleau": "roll",
    "ROULEAU": "ROLL",
    "pièces": "pieces",
    "PIèCES": "PIECES",
    "Boulons": "Bolts",
    "BOULONS": "BOLTS",
    "Pointes": "Nails",
    "POINTES": "NAILS",
    "Ondulé": "Corrugated",
    "ONDULé": "CORRUGATED",
    "Bordeau": "Bordeaux",
    "BORDEAU": "BORDEAUX",
    "Atelier": "Workshop",
    "ATELIER": "WORKSHOP",
    "50 ANS": "50 YEARS",
    "Action": "Action",
    "ACTION": "ACTION",
    "unité": "unit",
    "UNITé": "UNIT",
    "boîte": "box",
    "BOîTE": "BOX",
    "paquet": "pack",
    "PAQUET": "PACK",
    "pièce": "piece",
    "PIèCE": "PIECE",
    "Tôles": "Roofing Sheets",
    "TôLES": "ROOFING SHEETS",
    "Boulon": "Bolt",
    "BOULON": "BOLT",
    "Pointe": "Nail",
    "POINTE": "NAIL",
    "Usines": "Factories",
    "USINES": "FACTORIES",
    "Panier": "Quote \/ Cart",
    "PANIER": "QUOTE \/ CART",
    "Compte": "Account",
    "COMPTE": "ACCOUNT",
    "Client": "Customer",
    "CLIENT": "CUSTOMER",
    "Tôle": "Roofing Sheet",
    "TôLE": "ROOFING SHEET",
    "Rives": "Bargeboards",
    "RIVES": "BARGEBOARDS",
    "Noues": "Valleys",
    "NOUES": "VALLEYS",
    "Rouge": "Red",
    "ROUGE": "RED",
    "Usine": "Factory",
    "USINE": "FACTORY",
    "Devis": "Quote",
    "DEVIS": "QUOTE",
    "Tarif": "Rate",
    "TARIF": "RATE",
    "Total": "Total",
    "TOTAL": "TOTAL",
    "lots": "batches",
    "LOTS": "BATCHES",
    "Rive": "Bargeboard",
    "RIVE": "BARGEBOARD",
    "Noue": "Valley",
    "NOUE": "VALLEY",
    "Prix": "Price",
    "PRIX": "PRICE",
    "lot": "batch",
    "LOT": "BATCH"
};

    // Création de la liste des clés triées par longueur
    const KEYS = Object.keys(DICT_FR_TO_EN);

    // Fonction pour échapper les caractères spéciaux regex
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    // Construction d'une REGEX globale optimisée
    const REGEX_PARSER = new RegExp(KEYS.map(escapeRegExp).join('|'), 'g');

    // Dépôts de mémoire pour l'état pristine français d'origine
    const originalTextMap = new WeakMap();
    const originalAttrMap = new WeakMap();

    function getActiveLanguage() {
        return localStorage.getItem(STORAGE_KEY) || DEFAULT_LANG;
    }

    function setActiveLanguage(lang) {
        localStorage.setItem(STORAGE_KEY, lang);
        document.cookie = STORAGE_KEY + '=' + lang + ';path=/;max-age=31536000;SameSite=Lax';
    }

    // Traduction ultra-rapide en 1 passe regex O(N)
    function translateText(str) {
        if (!str || typeof str !== 'string') return str;
        return str.replace(REGEX_PARSER, matched => DICT_FR_TO_EN[matched] || matched);
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

        // Mettre à jour le texte du panier
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

    // Application de la langue (instantannée, < 2ms)
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
            const rawFR = originalTextMap.get(node);
            if (rawFR !== undefined) {
                node.nodeValue = isEn ? translateText(rawFR) : rawFR;
            }
        }

        // Attributs & Options
        const elements = document.querySelectorAll('input, textarea, select, option, button, [title], [aria-label], [alt]');
        elements.forEach(el => {
            const snap = originalAttrMap.get(el);
            if (snap) {
                if (snap.text !== null && el.tagName === 'OPTION') {
                    el.textContent = isEn ? translateText(snap.text) : snap.text;
                }
                if (snap.value !== null) {
                    el.value = isEn ? translateText(snap.value) : snap.value;
                }
                if (snap.placeholder !== null) {
                    el.placeholder = isEn ? translateText(snap.placeholder) : snap.placeholder;
                }
                if (snap.title !== null) {
                    el.title = isEn ? translateText(snap.title) : snap.title;
                }
                if (snap.ariaLabel !== null) {
                    el.setAttribute('aria-label', isEn ? translateText(snap.ariaLabel) : snap.ariaLabel);
                }
                if (snap.alt !== null) {
                    el.alt = isEn ? translateText(snap.alt) : snap.alt;
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
        }
    });

})();