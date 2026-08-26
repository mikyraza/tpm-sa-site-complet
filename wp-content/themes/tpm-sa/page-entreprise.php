<?php
/**
 * Template Name: Page L'Entreprise
 * page-entreprise.php - TPM SA (Groupe CAC)
 * Présentation officielle de la société, son histoire, ses 2 sites de production et sa vision industrielle.
 */

get_header();

$theme_img_uri   = get_template_directory_uri() . '/assets/images/';
$shop_url        = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
$cart_url        = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');
$contact_url     = home_url('/contact/');
$catalog_pdf_url = content_url('/uploads/catalogue-general-tpm-sa-2026.pdf');
?>

<main id="primary" class="site-main flex-grow bg-slate-50 font-sans">

    <!-- ═════════════════════════════════════════════════════════════
         1. HERO HEADER: L'ENTREPRISE TPM SA (GROUPE CAC)
         ═════════════════════════════════════════════════════════════ -->
    <section class="relative bg-tpm-slate text-white py-14 lg:py-20 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo esc_url($theme_img_uri . 'bg_tpm_aluminum_coil.jpg'); ?>" 
                 alt="TPM SA Bobine Aluminium & Usine de Production" 
                 class="w-full h-full object-cover opacity-25"/>
            <div class="absolute inset-0 bg-gradient-to-r from-tpm-navy/95 via-tpm-navy/90 to-tpm-navy/80"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="text-xs text-gray-300 flex items-center gap-2 mb-6 font-medium">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-tpm-orange transition-colors">Accueil</a>
                <span>›</span>
                <span class="text-white font-bold">L'Entreprise</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
                
                <!-- Left: Headline & Genesis -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-tpm-orange/20 border border-tpm-orange/40 text-tpm-orange font-bold text-[11px] uppercase tracking-wider">
                        ★ FONDÉ PAR M. NJIPNGANG • DEPUIS 1976
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight uppercase tracking-tight">
                        50 Ans d'Excellence Métallurgique &amp; de Plasturgie au Cameroun.
                    </h1>

                    <p class="text-sm sm:text-base text-gray-300 max-w-2xl leading-relaxed">
                        Pionnier de la transformation industrielle en Afrique Centrale, <strong>TPM SA (Groupe CAC)</strong> fabrique des <strong>tôles BAC haute résistance</strong>, des <strong>faîtières &amp; accessoires de toiture</strong>, des <strong>sacs tissés en polypropylène</strong> et distribue des matériaux de second œuvre pour les grands chantiers BTP et le secteur commercial.
                    </p>

                    <!-- Core Metrics Grid -->
                    <div class="grid grid-cols-3 gap-3 pt-2">
                        <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-4 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-tpm-orange tracking-tight">50 ANS</div>
                            <div class="text-[10px] sm:text-xs text-gray-300 font-semibold uppercase mt-0.5">Tradition 1976-2026</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-4 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">2 SITES</div>
                            <div class="text-[10px] sm:text-xs text-gray-300 font-semibold uppercase mt-0.5">PK12 &amp; Bekoko Douala</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-4 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-white tracking-tight">100% NC</div>
                            <div class="text-[10px] sm:text-xs text-gray-300 font-semibold uppercase mt-0.5">Conformité CEMAC</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Official Card -->
                <div class="lg:col-span-5">
                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 sm:p-8 space-y-5 shadow-2xl text-white">
                        <div class="flex items-center gap-4 border-b border-white/15 pb-4">
                            <div class="w-14 h-14 bg-tpm-orange rounded-xl flex items-center justify-center font-black text-2xl text-white shrink-0 shadow-lg">
                                TPM
                            </div>
                            <div>
                                <h3 class="font-extrabold text-lg text-white leading-tight">TPM SA (Groupe CAC)</h3>
                                <p class="text-xs text-gray-300 font-medium">Transformation Métallique &amp; Plastique</p>
                            </div>
                        </div>

                        <div class="space-y-3 text-xs text-gray-200">
                            <div class="flex justify-between items-center py-1 border-b border-white/10">
                                <span class="text-gray-400">Fondateur Visionnaire :</span>
                                <strong class="text-white">M. NJIPNGANG</strong>
                            </div>
                            <div class="flex justify-between items-center py-1 border-b border-white/10">
                                <span class="text-gray-400">Siège &amp; Usines :</span>
                                <strong class="text-white">Douala (PK12 &amp; Bekoko)</strong>
                            </div>
                            <div class="flex justify-between items-center py-1 border-b border-white/10">
                                <span class="text-gray-400">Numéro NIU :</span>
                                <strong class="text-tpm-orange font-mono">M052217435713Q</strong>
                            </div>
                            <div class="flex justify-between items-center py-1 border-b border-white/10">
                                <span class="text-gray-400">Régime Fiscal :</span>
                                <strong class="text-white">TVA 19.25% Récupérable</strong>
                            </div>
                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-400">Zone de Livraison :</span>
                                <strong class="text-emerald-400">Cameroun &amp; Zone CEMAC</strong>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="javascript:void(0)" onclick="openCataloguePreview()" class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-extrabold py-3 px-4 rounded-lg transition-colors text-center flex items-center justify-center gap-2 text-xs uppercase tracking-wider shadow-lg cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                Télécharger le Catalogue Général PDF
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═════════════════════════════════════════════════════════════
         2. HISTOIRE, VISION & ENGAGEMENT QUALITÉ
         ═════════════════════════════════════════════════════════════ -->
    <section class="py-16 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left: Factory Image with Badge -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-xl border border-gray-200 aspect-[4/3]">
                        <img src="<?php echo esc_url($theme_img_uri . 'main_building.jpg'); ?>" 
                             alt="Bâtiment Principal &amp; Siège TPM SA" 
                             class="w-full h-full object-cover"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-tpm-orange block mb-1">SIÈGE &amp; BÂTIMENT PRINCIPAL</span>
                            <p class="text-xs font-semibold text-gray-200">Complexe industriel et direction générale TPM SA</p>
                        </div>
                    </div>
                    <!-- Floating Quote Box -->
                    <div class="hidden sm:block absolute -bottom-6 -right-6 bg-tpm-navy text-white p-5 rounded-xl shadow-2xl border-2 border-tpm-orange max-w-xs">
                        <p class="text-xs font-bold italic leading-snug">
                            "Bâtiments solides = Matériaux solides avec garantie de durabilité."
                        </p>
                        <span class="text-[10px] text-tpm-orange uppercase tracking-wider font-extrabold mt-2 block">
                            — Devise Fondatrice TPM SA
                        </span>
                    </div>
                </div>

                <!-- Right: Detailed Narrative -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="space-y-2">
                        <span class="text-xs uppercase font-extrabold tracking-wider text-tpm-orange">HISTOIRE &amp; AMBITION</span>
                        <h2 class="text-2xl sm:text-3xl font-black text-tpm-navy uppercase tracking-tight">
                            Consolider les Bâtiments au Cameroun et en Afrique Centrale
                        </h2>
                    </div>

                    <p class="text-sm text-gray-600 leading-relaxed">
                        L'idée fondatrice de la fabrication locale de matériaux de toiture et de plasturgie est née de la volonté de <strong>M. NJIPNGANG</strong> de doter le Cameroun d'une souveraineté industrielle en matière de construction durable. Face aux aléas climatiques tropicaux et aux exigences de résistance mécanique des infrastructures, <strong>TPM SA</strong> a développé une maîtrise complète des alliages métalliques et des polymères thermoplastiques.
                    </p>

                    <p class="text-sm text-gray-600 leading-relaxed">
                        Aujourd'hui, à travers le <strong>Groupe CAC</strong>, nous opérons deux complexes industriels majeurs à <strong>Douala PK12</strong> et <strong>Bekoko</strong>, équipés de lignes automatisées de profilage, de plieuses numériques à commande assistée, de bains d'électro-zingage et d'unités d'extrusion de polypropylène.
                    </p>

                    <!-- 3 Pillars Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4">
                        <div class="p-4 bg-slate-50 rounded-xl border border-gray-200 space-y-2">
                            <div class="w-9 h-9 bg-orange-100 text-tpm-orange rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">verified</span>
                            </div>
                            <h4 class="font-bold text-xs text-tpm-navy uppercase">Épaisseurs Réelles</h4>
                            <p class="text-[11px] text-gray-500 leading-tight">Garantie 0.35mm, 0.50mm et 0.60mm contrôlées au micromètre.</p>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-xl border border-gray-200 space-y-2">
                            <div class="w-9 h-9 bg-blue-100 text-tpm-navy rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">factory</span>
                            </div>
                            <h4 class="font-bold text-xs text-tpm-navy uppercase">Production Directe</h4>
                            <p class="text-[11px] text-gray-500 leading-tight">Aucun intermédiaire : tarification usine et découpe sur-mesure.</p>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-xl border border-gray-200 space-y-2">
                            <div class="w-9 h-9 bg-emerald-100 text-emerald-700 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">local_shipping</span>
                            </div>
                            <h4 class="font-bold text-xs text-tpm-navy uppercase">Logistique Dédiée</h4>
                            <p class="text-[11px] text-gray-500 leading-tight">Flotte de transport et capacité d'enlèvement immédiat en usine.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═════════════════════════════════════════════════════════════
         3. LES 2 SITES DE PRODUCTION : DOUALA PK12 & BEKOKO
         ═════════════════════════════════════════════════════════════ -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <div class="text-center space-y-3 max-w-2xl mx-auto">
                <span class="text-xs uppercase font-extrabold tracking-wider text-tpm-orange">INFRASTRUCTURE INDUSTRIELLE</span>
                <h2 class="text-2xl sm:text-3xl font-black text-tpm-navy uppercase tracking-tight">
                    Nos 2 Complexes de Production à Douala
                </h2>
                <p class="text-xs sm:text-sm text-gray-600">
                    Une capacité industrielle d'envergure répartie stratégiquement sur deux zones pour optimiser la fabrication et les flux d'expédition vers l'ensemble du Cameroun et de la zone CEMAC.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- SITE 1: DOUALA PK12 -->
                <div class="bg-white rounded-2xl border-2 border-tpm-navy overflow-hidden shadow-md flex flex-col justify-between">
                    <div>
                        <!-- Header with Image Banner -->
                        <div class="relative h-48 bg-tpm-navy overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'bg_tpm_corrugating_machine.jpg'); ?>" alt="Usine TPM Douala PK12 Ligne de Profilage" class="w-full h-full object-cover opacity-75"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/60 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-tpm-orange text-white font-black text-xs px-3 py-1 rounded shadow uppercase tracking-wider">
                                SITE PRINCIPAL N°1
                            </div>
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-xl font-extrabold uppercase">Usine Douala PK12</h3>
                                <p class="text-xs text-gray-300">Zone Industrielle PK12 — Profilage Métallique &amp; Zingage</p>
                            </div>
                        </div>

                        <!-- Site Specs -->
                        <div class="p-6 space-y-4">
                            <div class="space-y-2 text-xs text-gray-600">
                                <p class="font-semibold text-tpm-navy text-sm">Spécialisations du Site PK12 :</p>
                                <ul class="space-y-2">
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-tpm-orange text-base shrink-0">check_circle</span>
                                        <span><strong>Lignes de tôles BAC :</strong> Profilage ondulé et nervuré D50/B30 en aluminium 5/10e, 6/10e et prélaqué 0.50mm.</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-tpm-orange text-base shrink-0">check_circle</span>
                                        <span><strong>Atelier de Pliage &amp; Faîtières :</strong> Faîtières crantées double pente, rives, gouttières et noues étanches.</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-tpm-orange text-base shrink-0">check_circle</span>
                                        <span><strong>Station d'Électro-Zingage 800 VA :</strong> Traitement de surface anticorrosion par galvanisation électrolytique.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="p-3.5 bg-slate-50 rounded-xl border border-gray-200 text-xs flex justify-between items-center font-mono">
                                <span class="text-gray-500">Horaires : <strong>Lun - Ven : 08h00 - 18h00</strong></span>
                                <span class="text-tpm-orange font-bold">Enlèvement Immédiat</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        <a href="<?php echo esc_url($shop_url); ?>" class="w-full bg-tpm-navy hover:bg-tpm-orange text-white font-bold py-3 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-2">
                            <span>Voir le Catalogue Tôles PK12</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- SITE 2: CARREFOUR BEKOKO -->
                <div class="bg-white rounded-2xl border-2 border-tpm-orange overflow-hidden shadow-md flex flex-col justify-between">
                    <div>
                        <!-- Header with Image Banner -->
                        <div class="relative h-48 bg-tpm-navy overflow-hidden">
                            <img src="<?php echo esc_url($theme_img_uri . 'bg_tpm_facade.jpg'); ?>" alt="Complexe Industriel Bekoko Siège & Usine" class="w-full h-full object-cover opacity-80"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/60 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-emerald-600 text-white font-black text-xs px-3 py-1 rounded shadow uppercase tracking-wider">
                                COMPLEXE N°2 (BEKOKO)
                            </div>
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-xl font-extrabold uppercase">Complexe Industriel Bekoko</h3>
                                <p class="text-xs text-gray-300">Carrefour Bekoko — Axe Douala - Limbé</p>
                            </div>
                        </div>

                        <!-- Site Specs -->
                        <div class="p-6 space-y-4">
                            <div class="space-y-2 text-xs text-gray-600">
                                <p class="font-semibold text-tpm-navy text-sm">Spécialisations du Site Bekoko :</p>
                                <ul class="space-y-2">
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-emerald-600 text-base shrink-0">check_circle</span>
                                        <span><strong>Plasturgie &amp; Sacs Tissés :</strong> Extrusion, tissage circulaire et confection de sacs PP 50kg &amp; 100kg pour agro-industrie et ciment.</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-emerald-600 text-base shrink-0">check_circle</span>
                                        <span><strong>Second Œuvre &amp; Revêtements :</strong> Dépôt central de carrelages sol &amp; mur haut de gamme.</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-emerald-600 text-base shrink-0">check_circle</span>
                                        <span><strong>Plateforme Logistique Régionale :</strong> Chargement poids lourds pour approvisionnement Sud-Ouest, Ouest et Grand Nord.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="p-3.5 bg-slate-50 rounded-xl border border-gray-200 text-xs flex justify-between items-center font-mono">
                                <span class="text-gray-500">Horaires : <strong>Lun - Ven : 08h00 - 18h00</strong></span>
                                <span class="text-emerald-700 font-bold">Stock Gros Volumes</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        <a href="<?php echo esc_url($contact_url); ?>" class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-bold py-3 px-4 rounded-lg text-xs transition-colors flex items-center justify-center gap-2">
                            <span>Localiser le Site Bekoko</span>
                            <span class="material-symbols-outlined text-sm">location_on</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═════════════════════════════════════════════════════════════
         4. LES 6 DOMAINES DE PRODUCTION INDUSTRIELLE
         ═════════════════════════════════════════════════════════════ -->
    <section class="py-16 bg-white border-t border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-gray-200 pb-6">
                <div>
                    <span class="text-xs uppercase font-extrabold tracking-wider text-tpm-orange">CAPACITÉS &amp; GAMMES DE FABRICATION</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-tpm-navy uppercase tracking-tight">
                        L'Éventail de nos Lignes de Production
                    </h2>
                </div>
                <a href="<?php echo esc_url($shop_url); ?>" class="text-xs font-bold text-tpm-navy hover:text-tpm-orange transition-colors flex items-center gap-1">
                    <span>Explorer l'inventaire en direct</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- 1. Tôles BAC & Toiture -->
                <div class="p-6 bg-slate-50 rounded-xl border border-gray-200 space-y-3 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-orange-100 text-tpm-orange rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">roofing</span>
                    </div>
                    <h3 class="font-extrabold text-base text-tpm-navy">1. Tôles BAC &amp; Couvertures</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Tôles ondulées et bacs prélaqués D50 / B30 en aluminium pur et tôle galvanisée traitée anti-corrosion, toutes teintes RAL (Bordeau 3005, Bleu Cendre, Vert Olive).
                    </p>
                </div>

                <!-- 2. Accessoires de Toiture -->
                <div class="p-6 bg-slate-50 rounded-xl border border-gray-200 space-y-3 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-indigo-100 text-tpm-navy rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">hardware</span>
                    </div>
                    <h3 class="font-extrabold text-base text-tpm-navy">2. Pliage &amp; Accessoires</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Faîtières double pente, faîtières crantées profilées au pas de la tôle, demi-rives, rives de rive, noues et bavettes étanches façonnées sur commande.
                    </p>
                </div>

                <!-- 3. Fixations & Étanchéité -->
                <div class="p-6 bg-slate-50 rounded-xl border border-gray-200 space-y-3 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">construction</span>
                    </div>
                    <h3 class="font-extrabold text-base text-tpm-navy">3. Fixations Certifiées</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Tirefonds zingués 6x80 / 6x100, cavaliers d'étanchéité avec rondelles EPDM, pointes de toiture et rouleaux de bitume Toiturole 900G.
                    </p>
                </div>

                <!-- 4. Emballages Polypropylène -->
                <div class="p-6 bg-slate-50 rounded-xl border border-gray-200 space-y-3 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-amber-100 text-amber-800 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">inventory_2</span>
                    </div>
                    <h3 class="font-extrabold text-base text-tpm-navy">4. Plasturgie &amp; Sacs PP</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Sacs tissés en polypropylène vierge de 25kg, 50kg et 100kg pour l'emballage du ciment, de la farine, du cacao, café et engrais.
                    </p>
                </div>

                <!-- 5. Électro-Zingage Industriel -->
                <div class="p-6 bg-slate-50 rounded-xl border border-gray-200 space-y-3 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-sky-100 text-sky-800 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">electric_bolt</span>
                    </div>
                    <h3 class="font-extrabold text-base text-tpm-navy">5. Traitement Électro-Zingage</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Bain de zingage électrolytique industriel de 800 VA pour pièces métalliques, visserie, fers plats, profilés et éléments de serrurerie.
                    </p>
                </div>

                <!-- 6. Carrelage & Second Œuvre -->
                <div class="p-6 bg-slate-50 rounded-xl border border-gray-200 space-y-3 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-rose-100 text-rose-800 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">grid_view</span>
                    </div>
                    <h3 class="font-extrabold text-base text-tpm-navy">6. Carrelages &amp; Céramique</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Grès cérame, carreaux muraux 25x40 et revêtements de sol grand format pour villas, immeubles et espaces commerciaux.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ═════════════════════════════════════════════════════════════
         5. ENGAGEMENT FISCAL, CONFORMITÉ & CONTACTS
         ═════════════════════════════════════════════════════════════ -->
    <section class="py-16 bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-gray-200 p-8 sm:p-12 shadow-sm space-y-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center border-b border-gray-200 pb-8">
                    <div class="lg:col-span-8 space-y-2">
                        <span class="text-xs uppercase font-extrabold tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                            CONFORMITÉ FISCALE &amp; JURIDIQUE
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black text-tpm-navy uppercase">
                            Partenaire Agréé pour Entreprises, Ministères &amp; PME du BTP
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                            Toutes nos factures et cotations pro-forma sont éditées en totale conformité avec la réglementation fiscale du Cameroun (TVA 19.25%, NIU, attestation de non-redevance).
                        </p>
                    </div>
                    <div class="lg:col-span-4 bg-slate-50 p-4 rounded-xl border border-gray-200 text-xs space-y-1 font-mono">
                        <p class="text-gray-500">Raison Sociale : <strong class="text-tpm-navy">TPM SA (Groupe CAC)</strong></p>
                        <p class="text-gray-500">Identifiant Unique (NIU) : <strong class="text-tpm-orange">M052217435713Q</strong></p>
                        <p class="text-gray-500">TVA Déductible : <strong class="text-emerald-700">19.25%</strong></p>
                    </div>
                </div>

                <!-- Contacts and CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-2">
                    <div class="space-y-1 text-center sm:text-left">
                        <h4 class="font-extrabold text-tpm-navy text-sm sm:text-base">Besoin d'un accompagnement sur-mesure pour votre chantier ?</h4>
                        <p class="text-xs text-gray-500">Nos ingénieurs d'études et commerciaux sont à votre écoute du Lundi au Vendredi de 08h00 à 18h00.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 shrink-0">
                        <a href="<?php echo esc_url($contact_url); ?>" class="bg-tpm-navy hover:bg-slate-900 text-white font-bold px-6 py-3 rounded-lg text-xs uppercase tracking-wider transition-colors shadow">
                            Contacter l'Usine
                        </a>
                        <a href="https://wa.me/237696340008" target="_blank" class="bg-[#25D366] hover:bg-[#1ebd59] text-white font-bold px-6 py-3 rounded-lg text-xs uppercase tracking-wider flex items-center gap-2 transition-colors shadow">
                            <span class="material-symbols-outlined text-[18px]">chat</span>
                            WhatsApp Commercial
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();
