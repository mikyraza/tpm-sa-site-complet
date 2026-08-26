<?php
/**
 * Template Name: Page Devis Sur-Mesure & Pro-Forma B2B
 * Template Post Type: page
 * 
 * page-devis-sur-mesure.php
 * Espace Commercial & Demande de Facture Pro-Forma B2B TPM SA (Groupe CAC)
 */

get_header();

$theme_img_uri   = get_template_directory_uri() . '/assets/images/';
$catalog_pdf_url = content_url('/uploads/catalogue-general-tpm-sa-2026.pdf');
$shop_url        = wc_get_page_permalink('shop');

// Handle Form Submission
$form_submitted = false;
$form_success   = false;
$form_msg       = '';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['tpm_proforma_nonce'] ) && wp_verify_nonce( $_POST['tpm_proforma_nonce'], 'tpm_proforma_action' ) ) {
    $form_submitted = true;
    
    $company     = sanitize_text_field( $_POST['company'] ?? '' );
    $niu         = sanitize_text_field( $_POST['niu'] ?? '' );
    $buyer_name  = sanitize_text_field( $_POST['buyer_name'] ?? '' );
    $phone       = sanitize_text_field( $_POST['phone'] ?? '' );
    $email       = sanitize_email( $_POST['email'] ?? '' );
    $city        = sanitize_text_field( $_POST['city'] ?? '' );
    $category    = sanitize_text_field( $_POST['category'] ?? '' );
    $finition    = sanitize_text_field( $_POST['finition'] ?? '' );
    $delivery    = sanitize_text_field( $_POST['delivery'] ?? '' );
    $specs       = sanitize_textarea_field( $_POST['specs'] ?? '' );

    if ( ! empty( $company ) && ! empty( $phone ) && ! empty( $email ) && ! empty( $specs ) ) {
        // 1. Send notification email to admin / sales department
        $admin_email = 'cac_vis3@yahoo.fr';
        $subject_admin = "[Devis B2B TPM SA] Demande Pro-Forma de {$company} - {$category}";
        
        $body_admin = "NOUVELLE DEMANDE DE FACTURE PRO-FORMA B2B VIA LE SITE WEB :\n\n"
                    . "---------------------------------------------------------\n"
                    . "INFORMATIONS CLIENT / ENTREPRISE :\n"
                    . "Raison Sociale / Client : {$company}\n"
                    . "Numéro NIU              : " . ($niu ?: 'Non renseigné') . "\n"
                    . "Contact Acheteur        : {$buyer_name}\n"
                    . "Téléphone / WhatsApp    : {$phone}\n"
                    . "Adresse E-mail          : {$email}\n"
                    . "Ville / Chantier        : {$city}\n\n"
                    . "SPÉCIFICATIONS PRODUITS :\n"
                    . "Famille Principale      : {$category}\n"
                    . "Finition / Coloris      : {$finition}\n"
                    . "Mode de Réception       : {$delivery}\n\n"
                    . "DÉTAIL DES LONGUEURS & QUANTITÉS :\n"
                    . "{$specs}\n\n"
                    . "---------------------------------------------------------\n"
                    . "Date : " . current_time('d/m/Y H:i:s') . "\n"
                    . "Source : Page Devis Sur-Mesure TPM SA (www.tpm-sa.cm)";
        
        $headers_admin = [
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $email
        ];
        
        @wp_mail( $admin_email, $subject_admin, $body_admin, $headers_admin );

        // 2. Send professional confirmation email to the client
        $subject_client = "Confirmation de votre demande de Pro-Forma B2B — TPM SA (Groupe CAC)";
        $body_client = "Cher(e) {$buyer_name} ({$company}),\n\n"
                     . "Nous accusons réception de votre demande de cotation / Facture Pro-Forma officielle chez TPM SA (Groupe CAC).\n\n"
                     . "RÉCAPITULATIF DE VOTRE DEMANDE :\n"
                     . "• Société : {$company}\n"
                     . "• Famille : {$category}\n"
                     . "• Finition : {$finition}\n"
                     . "• Ville / Chantier : {$city}\n"
                     . "• Spécifications : {$specs}\n\n"
                     . "Notre service commercial examine actuellement les longueurs et tonnages demandés pour appliquer les meilleurs barèmes usine HT et TTC (avec TVA 19.25% déductible).\n\n"
                     . "Un ingénieur technico-commercial vous contactera par e-mail ou WhatsApp ({$phone}) sous 2 heures ouvrées avec votre Facture Pro-Forma certifiée.\n\n"
                     . "Besoin d'un traitement urgent ? Contactez immédiatement l'usine :\n"
                     . "WhatsApp Usine : +237 655 70 58 66 | Téléphone : +237 696 34 00 08\n\n"
                     . "Bien cordialement,\n"
                     . "Administration des Ventes — TPM SA (Groupe CAC)\n"
                     . "Usines de Douala PK12 & Bekoko\n"
                     . "www.tpm-sa.cm";

        $headers_client = [
            'Content-Type: text/plain; charset=UTF-8',
            'From: TPM SA Commercial <commercial@tpm-sa.cm>'
        ];

        @wp_mail( $email, $subject_client, $body_client, $headers_client );

        $form_success = true;
        $form_msg = "Votre demande de Facture Pro-Forma B2B a été transmise avec succès ! Un e-mail de confirmation vous a été envoyé et un technico-commercial vous transmettra votre chiffrage officiel sous 2 heures.";
    } else {
        $form_msg = "Veuillez remplir tous les champs obligatoires indiqués par un astérisque (*).";
    }
}
?>

<main id="primary" class="site-main flex-grow bg-slate-50 font-sans">

    <!-- ═══════════════════════════════════════════════════════════
         1. HERO SECTION : EN-TÊTE COMMERCIAL & COTATIONS B2B
         ═══════════════════════════════════════════════════════════ -->
    <section class="relative bg-tpm-slate text-white py-12 md:py-16 overflow-hidden border-b border-gray-800 shadow-inner">
        <!-- Fond décoratif avec motifs subtils -->
        <div class="absolute inset-0 z-0 opacity-15 pointer-events-none">
            <div class="absolute inset-0 bg-[radial-gradient(#D84B1F_1px,transparent_1px)] [background-size:20px_20px]"></div>
        </div>
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-tpm-orange/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl">
                <!-- Badge Catégorie -->
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/15 text-tpm-orange text-xs font-black tracking-widest uppercase mb-4">
                    <span class="material-symbols-outlined text-[18px]">factory</span>
                    Service Commercial &amp; Cotations B2B
                </div>

                <!-- Grand Titre -->
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white uppercase tracking-tight leading-tight mb-4">
                    Demande de Facture <span class="text-tpm-orange">Pro-Forma B2B</span> &amp; Devis Sur-Mesure
                </h1>

                <!-- Paragraphe descriptif -->
                <p class="text-sm sm:text-base text-gray-300 leading-relaxed max-w-3xl">
                    Vous gérez un chantier BTP, une quincaillerie, un projet architectural ou un site industriel ? Recevez votre cotation officielle aux tarifs usine direct fabricant (HT et TTC avec TVA 19.25% légale), délais de profilage et conditions d'enlèvement quai sous 2 heures ouvrées.
                </p>

                <!-- Points Forts Certifications -->
                <div class="mt-6 flex flex-wrap items-center gap-4 sm:gap-6 text-xs text-gray-300 font-semibold">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-400 text-[18px]">verified</span>
                        <span>Norme Camerounaise (NC) &amp; ISO 9001:2015</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-400 text-[18px]">speed</span>
                        <span>Chiffrage &amp; Réponse sous 2 Heures</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-400 text-[18px]">local_shipping</span>
                        <span>Livraison Chantiers Cameroun &amp; CEMAC</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         2. CONTENU PRINCIPAL : FORMULAIRE & SIDEBAR D'ASSISTANCE
         ═══════════════════════════════════════════════════════════ -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
        
        <!-- Messages de statut (Succès ou Erreur) -->
        <?php if ( $form_submitted ): ?>
            <?php if ( $form_success ): ?>
                <div class="mb-8 p-6 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl text-emerald-900 shadow-md flex items-start gap-4 animate-fadeIn">
                    <span class="material-symbols-outlined text-emerald-600 text-3xl shrink-0 mt-0.5">check_circle</span>
                    <div>
                        <h4 class="font-extrabold text-base mb-1">Demande de Pro-Forma transmise avec succès !</h4>
                        <p class="text-sm text-emerald-800 leading-relaxed"><?php echo esc_html( $form_msg ); ?></p>
                        <div class="mt-3 flex items-center gap-3">
                            <a href="https://wa.me/237655705866" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-900 bg-emerald-100 hover:bg-emerald-200 px-3 py-1.5 rounded-md transition">
                                <span class="material-symbols-outlined text-[16px]">chat</span>
                                Suivre sur WhatsApp (+237 655 70 58 66)
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="mb-8 p-5 bg-red-50 border-l-4 border-red-500 rounded-xl text-red-900 shadow-md flex items-start gap-3 animate-fadeIn">
                    <span class="material-symbols-outlined text-red-600 text-2xl shrink-0">error</span>
                    <div>
                        <h4 class="font-bold text-sm">Informations incomplètes</h4>
                        <p class="text-xs text-red-700"><?php echo esc_html( $form_msg ); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

            <!-- ── COLONNE GAUCHE : FORMULAIRE DE COTATION PRO-FORMA (8 COLS) ── -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    
                    <!-- En-tête du Formulaire -->
                    <div class="bg-gradient-to-r from-tpm-navy to-slate-900 text-white px-6 sm:px-8 py-5 flex items-center justify-between border-b-2 border-tpm-orange">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-tpm-orange/20 border border-tpm-orange/40 flex items-center justify-center text-tpm-orange">
                                <span class="material-symbols-outlined text-2xl">request_quote</span>
                            </div>
                            <div>
                                <h2 class="text-lg sm:text-xl font-black uppercase text-white m-0 tracking-wide">
                                    Formulaire de Cotation Express
                                </h2>
                                <p class="text-xs text-gray-300 m-0 mt-0.5">Édition de cotation officielle sous 2 heures avec mention TVA 19.25%</p>
                            </div>
                        </div>
                        <span class="hidden sm:inline-block bg-white/10 text-[10px] font-mono font-bold px-2.5 py-1 rounded text-white border border-white/15 uppercase">
                            Direct Usine
                        </span>
                    </div>

                    <!-- Corps du Formulaire -->
                    <form method="post" action="<?php echo esc_url( get_permalink() ); ?>" class="p-6 sm:p-8 space-y-6">
                        <?php wp_nonce_field( 'tpm_proforma_action', 'tpm_proforma_nonce' ); ?>

                        <!-- ÉTAPE 1 : IDENTIFICATION CLIENT / ENTREPRISE -->
                        <div>
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-200">
                                <span class="w-6 h-6 rounded-full bg-tpm-orange text-white text-xs font-black flex items-center justify-center">1</span>
                                <h3 class="text-xs sm:text-sm font-black uppercase text-tpm-navy tracking-wider m-0">
                                    Identification de l'Entreprise ou du Donneur d'Ordre
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                                <div>
                                    <label for="company" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                        Raison Sociale / Nom du Client <span class="text-tpm-orange">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-[18px]">business</span>
                                        <input type="text" id="company" name="company" required 
                                               placeholder="Ex: Entreprise BTP Cameroun SARL ou M. Mbarga" 
                                               class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs font-bold text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none" />
                                    </div>
                                </div>

                                <div>
                                    <label for="niu" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                        NIU (Numéro Identifiant Unique) <span class="text-gray-400 font-normal">(Optionnel)</span>
                                    </label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-[18px]">badge</span>
                                        <input type="text" id="niu" name="niu" 
                                               placeholder="Ex: M052217435713Q (pour facturation légale)" 
                                               class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs font-bold text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none" />
                                    </div>
                                </div>

                                <div>
                                    <label for="buyer_name" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                        Responsable / Acheteur <span class="text-tpm-orange">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-[18px]">person</span>
                                        <input type="text" id="buyer_name" name="buyer_name" required 
                                               placeholder="Ex: Ing. Jean-Paul Kamga" 
                                               class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs font-bold text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none" />
                                    </div>
                                </div>

                                <div>
                                    <label for="phone" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                        Téléphone / WhatsApp <span class="text-tpm-orange">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-[18px]">phone</span>
                                        <input type="tel" id="phone" name="phone" required 
                                               placeholder="Ex: +237 655 70 58 66" 
                                               class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs font-bold text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none" />
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                        Adresse E-mail pour Envoi PDF <span class="text-tpm-orange">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-[18px]">mail</span>
                                        <input type="email" id="email" name="email" required 
                                               placeholder="Ex: direction@entreprise.cm" 
                                               class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs font-bold text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none" />
                                    </div>
                                </div>

                                <div>
                                    <label for="city" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                        Ville / Localisation Chantier <span class="text-tpm-orange">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-[18px]">location_on</span>
                                        <input type="text" id="city" name="city" required 
                                               placeholder="Ex: Douala, Yaoundé, Kribi, Bafoussam, Garoua" 
                                               class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs font-bold text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ÉTAPE 2 : MATÉRIAUX SOUHAITÉS & FINITIONS -->
                        <div>
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-200">
                                <span class="w-6 h-6 rounded-full bg-tpm-navy text-white text-xs font-black flex items-center justify-center">2</span>
                                <h3 class="text-xs sm:text-sm font-black uppercase text-tpm-navy tracking-wider m-0">
                                    Sélection des Produits &amp; Finitions Usine
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label for="category" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                        Famille d'Articles <span class="text-tpm-orange">*</span>
                                    </label>
                                    <select id="category" name="category" required class="w-full px-3 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs font-bold text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none cursor-pointer">
                                        <option value="Tôles Bacs Aluminium (0.35, 5/10e, 6/10e)">Tôles Bacs Aluminium (0.35, 5/10e, 6/10e)</option>
                                        <option value="Tôles Ondulées Aluminium 3M / Sur-Mesure">Tôles Ondulées Aluminium 3M / Sur-Mesure</option>
                                        <option value="Tôles Tuiles Nervurées D50 Architecturale">Tôles Tuiles Nervurées D50 Architecturale</option>
                                        <option value="Tôles Prélaquées B30 Économique">Tôles Prélaquées B30 Économique</option>
                                        <option value="Accessoires Toiture (Faîtières, Rives, Gouttières, Noues)">Accessoires Toiture (Faîtières, Rives, Gouttières, Noues)</option>
                                        <option value="Fixations &amp; Étanchéité (Vis EPDM, Tirefonds, Toiturole)">Fixations &amp; Étanchéité (Vis EPDM, Tirefonds, Toiturole)</option>
                                        <option value="Carrelages Grès Cérame 1er Choix (60x60, 40x40, XXL)">Carrelages Grès Cérame 1er Choix (60x60, 40x40, XXL)</option>
                                        <option value="Douches Thérapeutiques &amp; Sanitaires">Douches Thérapeutiques &amp; Sanitaires</option>
                                        <option value="Service Électro-Zingage Industriel 800 VA">Service Électro-Zingage Industriel 800 VA</option>
                                        <option value="Sacs Polypropylène (PP) Tissés 50kg / 100kg">Sacs Polypropylène (PP) Tissés 50kg / 100kg</option>
                                        <option value="Approvisionnement Complet Multimatériaux BTP">Approvisionnement Complet Multimatériaux BTP</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="finition" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                        Finition / Teinte RAL
                                    </label>
                                    <select id="finition" name="finition" class="w-full px-3 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs font-bold text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none cursor-pointer">
                                        <option value="Aluminium Naturel Pur">Aluminium Naturel Pur</option>
                                        <option value="Bordeaux RAL 3005">Bordeaux RAL 3005</option>
                                        <option value="Bleu Cendre RAL 5003">Bleu Cendre RAL 5003</option>
                                        <option value="Vert Olive RAL 6005">Vert Olive RAL 6005</option>
                                        <option value="Gris Ardoise RAL 7016">Gris Ardoise RAL 7016</option>
                                        <option value="Blanc Crème RAL 9001">Blanc Crème RAL 9001</option>
                                        <option value="Mixte / Plusieurs teintes">Mixte / Plusieurs teintes</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="delivery" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                        Mode de Réception <span class="text-tpm-orange">*</span>
                                    </label>
                                    <select id="delivery" name="delivery" required class="w-full px-3 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs font-bold text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none cursor-pointer">
                                        <option value="Enlèvement Quai Usine Bekoko">Enlèvement Quai Usine Bekoko</option>
                                        <option value="Enlèvement Usine Douala PK12">Enlèvement Usine Douala PK12</option>
                                        <option value="Livraison sur Chantier (Camion Usine TPM SA)">Livraison sur Chantier (Camion Usine TPM SA)</option>
                                        <option value="Expédition Zone CEMAC (Tchad, RCA, Gabon...)">Expédition Zone CEMAC (Tchad, RCA, Gabon...)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- ÉTAPE 3 : QUANTITÉS, LONGUEURS & INSTRUCTIONS -->
                        <div>
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-200">
                                <span class="w-6 h-6 rounded-full bg-tpm-navy text-white text-xs font-black flex items-center justify-center">3</span>
                                <h3 class="text-xs sm:text-sm font-black uppercase text-tpm-navy tracking-wider m-0">
                                    Détails des Longueurs &amp; Quantités Chiffrées <span class="text-tpm-orange">*</span>
                                </h3>
                            </div>

                            <div>
                                <label for="specs" class="block text-xs font-extrabold uppercase text-tpm-navy mb-1.5">
                                    Indiquez les longueurs (coupe sur-mesure au cm près) et les quantités requises :
                                </label>
                                <textarea id="specs" name="specs" rows="4" required 
                                          placeholder="Exemple :&#10;• 50 tôles BAC Alu 5/10e prélaquées Bordeaux de 6,50 m&#10;• 30 tôles de 4,20 m&#10;• 12 faîtières double pente crantées 0.35&#10;• 3 paquets de tirefonds 6x80 (216 pcs)&#10;• 1 rouleau Toiturole 900G 10m" 
                                          class="w-full p-3.5 bg-slate-50 border border-gray-300 rounded-xl text-xs font-mono text-gray-800 focus:bg-white focus:border-tpm-orange focus:ring-2 focus:ring-tpm-orange/20 transition outline-none leading-relaxed"></textarea>
                                <p class="text-[11px] text-gray-500 mt-1.5 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[15px] text-tpm-orange">straighten</span>
                                    <span>Nos profileuses permettent la coupe au centimètre près de 2 m à 12 m sans perte de matière.</span>
                                </p>
                            </div>
                        </div>

                        <!-- BOUTON DE SOUMISSION -->
                        <div class="pt-3 border-t border-gray-200">
                            <button type="submit" class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-black py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2.5 text-xs sm:text-sm uppercase tracking-wider cursor-pointer">
                                <span class="material-symbols-outlined text-[22px]">send</span>
                                <span>Transmettre ma Demande de Cotation Pro-Forma B2B</span>
                            </button>
                            <div class="mt-3 flex items-center justify-center gap-2 text-[11px] text-gray-500 text-center">
                                <span class="material-symbols-outlined text-[15px] text-emerald-600">lock</span>
                                <span>Vos informations restent confidentielles. Cotation officielle émise aux barèmes fabricants avec TVA 19.25% légale.</span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- ── COLONNE DROITE : SIDEBAR D'ASSISTANCE & CANAUX DIRECTS (4 COLS) ── -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- CARTE 1 : FLASH PRO-FORMA EN LIGNE AUTOMATIQUE -->
                <div class="bg-gradient-to-br from-tpm-navy to-[#120b2e] text-white p-6 rounded-2xl shadow-xl border border-white/10 relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-tpm-orange/15 rounded-full blur-2xl"></div>
                    
                    <div class="flex items-center gap-2.5 text-tpm-orange font-bold text-xs uppercase tracking-wider mb-3">
                        <span class="material-symbols-outlined text-[20px]">bolt</span>
                        Cotation Instantanée en Ligne
                    </div>
                    <h3 class="text-base font-black uppercase text-white mb-2 leading-snug">
                        Vous Connaissez Vos Articles ?
                    </h3>
                    <p class="text-xs text-gray-300 mb-5 leading-relaxed">
                        Ajoutez directement vos profilages et matériaux au panier depuis notre boutique pour éditer votre Facture Pro-Forma certifiée en 1 clic :
                    </p>
                    <a href="<?php echo esc_url($shop_url); ?>" class="w-full bg-white hover:bg-gray-100 text-tpm-navy font-extrabold py-3 px-4 rounded-xl text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 transition shadow-md">
                        <span class="material-symbols-outlined text-[18px]">storefront</span>
                        <span>Ouvrir l'Inventaire (67 Articles)</span>
                    </a>
                </div>

                <!-- CARTE 2 : WHATSAPP DIRECT SERVICE COMMERCIAL -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-emerald-200 relative overflow-hidden">
                    <div class="flex items-center gap-2.5 text-emerald-700 font-bold text-xs uppercase tracking-wider mb-2">
                        <span class="material-symbols-outlined text-[20px] text-[#25D366]">chat</span>
                        Assistance Immédiate
                    </div>
                    <h3 class="text-base font-black text-tpm-navy mb-2">
                        WhatsApp Commercial Usine
                    </h3>
                    <p class="text-xs text-gray-600 mb-4 leading-relaxed">
                        Transmettez directement votre bordereau de commande ou vos plans de toiture à nos ingénieurs technico-commerciaux :
                    </p>
                    <a href="https://wa.me/237655705866?text=Bonjour%20TPM%20SA,%20je%20souhaite%20une%20cotation%20pour%20mon%20chantier." target="_blank" class="w-full bg-[#25D366] hover:bg-[#1ebd59] text-white font-extrabold py-3 px-4 rounded-xl text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 transition shadow-md">
                        <span class="material-symbols-outlined text-[18px]">send</span>
                        <span>+237 655 70 58 66 (WhatsApp)</span>
                    </a>
                </div>

                <!-- CARTE 3 : TÉLÉCHARGER LE CATALOGUE OFFICIEL AVEC APERÇU -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                    <div class="flex items-center gap-2.5 text-tpm-orange font-bold text-xs uppercase tracking-wider mb-2">
                        <span class="material-symbols-outlined text-[20px]">menu_book</span>
                        Documentation Technique
                    </div>
                    <h3 class="text-base font-black text-tpm-navy mb-2">
                        Catalogue Général Officiel 2026
                    </h3>
                    <p class="text-xs text-gray-600 mb-4 leading-relaxed">
                        Consultez les 12 pages complètes avec l'intégralité des 67 références, tableaux de portées et fiches normatives :
                    </p>
                    <button type="button" onclick="openCataloguePreview()" class="w-full bg-slate-100 hover:bg-slate-200 text-tpm-navy font-extrabold py-3 px-4 rounded-xl text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 transition border border-gray-300 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px] text-tpm-orange">visibility</span>
                        <span>Aperçu &amp; Téléchargement (PDF)</span>
                    </button>
                </div>

                <!-- CARTE 4 : COORDONNÉES COMPTOIRS USINES -->
                <div class="bg-slate-100 p-5 rounded-2xl border border-gray-200 text-xs text-gray-700 space-y-3">
                    <h4 class="font-extrabold text-tpm-navy uppercase text-[11px] tracking-wider flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-tpm-orange text-[16px]">pin_drop</span>
                        Comptoirs &amp; Enlèvements Quai
                    </h4>
                    <div class="space-y-2 text-[11px]">
                        <div>
                            <strong class="text-tpm-navy block">Usine Principale Bekoko :</strong>
                            Carrefour Bekoko (Axe lourd Douala - Limbé)
                        </div>
                        <div>
                            <strong class="text-tpm-navy block">Usine Douala PK12 :</strong>
                            Zone Industrielle PK12, Douala
                        </div>
                    </div>
                    <div class="pt-2 border-t border-gray-300 flex justify-between items-center text-[10px] text-gray-500 font-mono">
                        <span>NIU: M052217435713Q</span>
                        <span>TVA: 19.25%</span>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- ═══════════════════════════════════════════════════════════
         3. LES ENGAGEMENTS & AVANTAGES DU DIRECT USINE TPM SA
         ═══════════════════════════════════════════════════════════ -->
    <section class="bg-white py-12 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="text-xs font-black uppercase text-tpm-orange tracking-widest block mb-1">Garantie Fabricant</span>
                <h3 class="text-2xl font-black text-tpm-navy uppercase tracking-tight">Pourquoi Commander Vos Matériaux Directement à l'Usine ?</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="p-5 rounded-xl bg-slate-50 border border-gray-200 flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-xl bg-tpm-orange/15 text-tpm-orange flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-2xl">price_check</span>
                    </div>
                    <h4 class="font-extrabold text-sm text-tpm-navy mb-1.5 uppercase">Tarifs Direct Usine</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">Cotation au premier échelon sans marge intermédiaire, avec facturation transparente HT et TVA 19.25%.</p>
                </div>

                <div class="p-5 rounded-xl bg-slate-50 border border-gray-200 flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-xl bg-tpm-navy/15 text-tpm-navy flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-2xl">straighten</span>
                    </div>
                    <h4 class="font-extrabold text-sm text-tpm-navy mb-1.5 uppercase">Coupe au Centimètre Près</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">Profilage continu de 2 m à 12 m selon les dimensions exactes de vos versants : zéro déchet sur votre chantier.</p>
                </div>

                <div class="p-5 rounded-xl bg-slate-50 border border-gray-200 flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/15 text-emerald-600 flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-2xl">verified</span>
                    </div>
                    <h4 class="font-extrabold text-sm text-tpm-navy mb-1.5 uppercase">Épaisseurs Réelles 100%</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">Aluminium pur 0,35 mm, 0,50 mm et 0,60 mm contrôlé au micromètre numérique. Zéro sous-calibrage.</p>
                </div>

                <div class="p-5 rounded-xl bg-slate-50 border border-gray-200 flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/15 text-blue-600 flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-2xl">local_shipping</span>
                    </div>
                    <h4 class="font-extrabold text-sm text-tpm-navy mb-1.5 uppercase">Flotte Logistique Grue</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">Camions semi-remorques avec bras de déchargement grue pour livraison directe quai ou chantier partout au Cameroun.</p>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();
