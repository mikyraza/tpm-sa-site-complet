<?php
/**
 * Template Name: Page Contact TPM SA
 * page-contact.php - Contact & Géolocalisation de l'Usine TPM SA
 * Faithful, pixel-accurate implementation of the official design.
 */

get_header();

$theme_img_uri = get_template_directory_uri() . '/assets/images/';

// Handle Form Submission
$form_submitted = false;
$form_success   = false;
$form_msg       = '';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['tpm_contact_nonce'] ) && wp_verify_nonce( $_POST['tpm_contact_nonce'], 'tpm_contact_action' ) ) {
    $form_submitted = true;
    $nom     = sanitize_text_field( $_POST['nom'] ?? '' );
    $niu     = sanitize_text_field( $_POST['niu'] ?? '' );
    $email   = sanitize_email( $_POST['email'] ?? '' );
    $phone   = sanitize_text_field( $_POST['phone'] ?? '' );
    $service = sanitize_text_field( $_POST['service'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( ! empty( $nom ) && ! empty( $email ) && ! empty( $message ) ) {
        // Prepare email notification to commercial
        $to = 'cac_vis3@yahoo.fr';
        $subject = "[Contact Web TPM SA] Demande de {$nom} - Service {$service}";
        $body = "Nouvelle demande de contact via le site web :\n\n"
              . "Nom / Raison Sociale : {$nom}\n"
              . "NIU : {$niu}\n"
              . "Email : {$email}\n"
              . "Téléphone / WhatsApp : {$phone}\n"
              . "Service Concerné : {$service}\n\n"
              . "Message :\n{$message}\n\n"
              . "---\nEnvoyé depuis http://mpcac.local/contact/";
        
        $headers = [
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $email
        ];

        @wp_mail( $to, $subject, $body, $headers );
        $form_success = true;
        $form_msg = "Votre message a été transmis avec succès à notre direction commerciale. Un conseiller vous répondra sous 2h.";
    } else {
        $form_msg = "Veuillez remplir tous les champs obligatoires (*).";
    }
}
?>

<main id="primary" class="site-main flex-grow bg-slate-50 font-sans">

    <!-- ═══════════════════════════════════════════════════════════
         1. HERO SECTION & BADGES
         ═══════════════════════════════════════════════════════════ -->
    <section class="relative bg-tpm-slate text-white py-16 md:py-24 overflow-hidden border-b border-gray-800">
        <!-- Background Image with Dark Industrial Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo esc_url( $theme_img_uri . 'bg_tpm_facade.jpg' ); ?>" 
                 alt="TPM SA Siège & Usine Principale" 
                 class="w-full h-full object-cover object-center opacity-35"/>
            <div class="absolute inset-0 bg-gradient-to-t from-tpm-navy via-tpm-navy/85 to-tpm-navy/70"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="max-w-4xl space-y-4">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white uppercase tracking-tight leading-tight">
                    CONTACT &amp; GÉOLOCALISATION DE L'USINE TPM SA
                </h1>
                <p class="text-sm sm:text-base text-gray-300 max-w-3xl leading-relaxed font-normal">
                    Demandes de devis sur mesure, suivi de production et enlèvement de commandes. Nos équipes industrielles sont à votre disposition.
                </p>
            </div>

            <!-- 3 Glassmorphism Schedule Badges -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                <!-- Badge 1: Usine Bekoko -->
                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-lg px-4 py-3 flex items-center gap-3 text-xs">
                    <span class="material-symbols-outlined text-tpm-orange text-[20px] shrink-0">schedule</span>
                    <div>
                        <div class="font-black text-white uppercase tracking-wider text-[11px]">USINE BEKOKO</div>
                        <div class="text-gray-300 font-medium">Lun-Ven: 07h30 - 18h00</div>
                    </div>
                </div>

                <!-- Badge 2: Comptoir PK12 -->
                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-lg px-4 py-3 flex items-center gap-3 text-xs">
                    <span class="material-symbols-outlined text-tpm-orange text-[20px] shrink-0">storefront</span>
                    <div>
                        <div class="font-black text-white uppercase tracking-wider text-[11px]">COMPTOIR PK12</div>
                        <div class="text-gray-300 font-medium">Lun-Sam: 08h00 - 17h00</div>
                    </div>
                </div>

                <!-- Badge 3: WhatsApp -->
                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-lg px-4 py-3 flex items-center gap-3 text-xs">
                    <span class="material-symbols-outlined text-emerald-400 text-[20px] shrink-0">chat</span>
                    <div>
                        <div class="font-black text-white uppercase tracking-wider text-[11px]">ASSISTANCE WHATSAPP</div>
                        <div class="text-emerald-300 font-semibold">Réponse Rapide</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         2. DEPARTMENT CARDS (3 COLUMNS)
         ═══════════════════════════════════════════════════════════ -->
    <section class="py-12 md:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Card 1: Commercial & Devis -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <div class="relative h-48 bg-slate-200 overflow-hidden">
                        <img src="<?php echo esc_url( $theme_img_uri . 'bg_tpm_corrugating_machine.jpg' ); ?>" 
                             alt="Commercial &amp; Devis Ligne de Profilage" 
                             loading="lazy"
                             decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm text-gray-800 text-[11px] font-bold px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Réponse sous 2h
                        </span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                        <div>
                            <h2 class="text-lg font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Commercial &amp; Devis
                            </h2>
                            <div class="mt-3 space-y-2 text-xs font-semibold text-gray-700">
                                <a href="tel:+237696340008" class="flex items-center gap-2 hover:text-tpm-orange transition-colors">
                                    <span class="material-symbols-outlined text-[16px] text-tpm-navy">call</span>
                                    <span>+237 696 34 00 08 / +237 691 53 75 14</span>
                                </a>
                                <a href="https://wa.me/237655705866" target="_blank" class="flex items-center gap-2 text-emerald-600 hover:text-emerald-700 transition-colors font-bold">
                                    <span class="material-symbols-outlined text-[16px]">chat</span>
                                    <span>WhatsApp Business (+237 655 70 58 66)</span>
                                </a>
                                <a href="mailto:commercial@tpm-sa.com" class="flex items-center gap-2 hover:text-tpm-orange transition-colors text-gray-600">
                                    <span class="material-symbols-outlined text-[16px] text-tpm-navy">mail</span>
                                    <span>commercial@tpm-sa.com</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Bureau d'Études -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <div class="relative h-48 bg-slate-200 overflow-hidden">
                        <img src="<?php echo esc_url( $theme_img_uri . 'bg_tpm_crane_coils.jpg' ); ?>" 
                             alt="Bureau d'Études Parc Bobines" 
                             loading="lazy"
                             decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm text-gray-800 text-[11px] font-bold px-3 py-1 rounded-full shadow">
                            Étude technique gratuite
                        </span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                        <div>
                            <h2 class="text-lg font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Bureau d'Études
                            </h2>
                            <div class="mt-3 space-y-2 text-xs font-semibold text-gray-700">
                                <a href="tel:+237691537514" class="flex items-center gap-2 hover:text-tpm-orange transition-colors">
                                    <span class="material-symbols-outlined text-[16px] text-tpm-navy">call</span>
                                    <span>+237 691 53 75 14</span>
                                </a>
                                <a href="mailto:etudes@tpm-sa.com" class="flex items-center gap-2 hover:text-tpm-orange transition-colors text-gray-600">
                                    <span class="material-symbols-outlined text-[16px] text-tpm-navy">mail</span>
                                    <span>etudes@tpm-sa.com</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Logistique & Enlèvement -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <div class="relative h-48 bg-slate-200 overflow-hidden">
                        <img src="<?php echo esc_url( $theme_img_uri . 'bg_tpm_aluminum_coil.jpg' ); ?>" 
                             alt="Logistique &amp; Enlèvement Bobine Alu" 
                             loading="lazy"
                             decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm text-gray-800 text-[11px] font-bold px-3 py-1 rounded-full shadow">
                            Enlèvement Usine Bekoko
                        </span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                        <div>
                            <h2 class="text-lg font-black text-tpm-navy group-hover:text-tpm-orange transition-colors">
                                Logistique &amp; Enlèvement
                            </h2>
                            <div class="mt-3 space-y-2 text-xs font-semibold text-gray-700">
                                <a href="tel:+237696340008" class="flex items-center gap-2 hover:text-tpm-orange transition-colors">
                                    <span class="material-symbols-outlined text-[16px] text-tpm-navy">call</span>
                                    <span>+237 696 34 00 08</span>
                                </a>
                                <a href="mailto:logistique@tpm-sa.com" class="flex items-center gap-2 hover:text-tpm-orange transition-colors text-gray-600">
                                    <span class="material-symbols-outlined text-[16px] text-tpm-navy">mail</span>
                                    <span>logistique@tpm-sa.com</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         3. SITES & ACCÈS (MAP + SITE CARDS)
         ═══════════════════════════════════════════════════════════ -->
    <section class="py-12 md:py-16 bg-white border-t border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Left: Interactive Real Google Maps Display Card (Format Idéal) -->
                <div class="lg:col-span-6 relative rounded-2xl overflow-hidden border border-gray-300 shadow-xl bg-slate-100 flex flex-col justify-between" style="min-height: 540px !important;">
                    
                    <!-- Top Site Switcher Bar -->
                    <div class="bg-tpm-navy text-white px-4 sm:px-6 py-3 flex flex-wrap items-center justify-between gap-2 border-b-2 border-tpm-orange shrink-0">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-tpm-orange text-[20px]">location_on</span>
                            <span class="text-xs sm:text-sm font-black uppercase tracking-wider text-white">Localisation GPS Certifiée</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs">
                            <button type="button" 
                                    onclick="switchTpmMap('pk12')" 
                                    id="map-btn-pk12"
                                    class="px-3.5 py-1.5 rounded-lg font-bold transition bg-tpm-orange text-white shadow-sm cursor-pointer">
                                PK12 (Siège)
                            </button>
                            <button type="button" 
                                    onclick="switchTpmMap('bekoko')" 
                                    id="map-btn-bekoko"
                                    class="px-3.5 py-1.5 rounded-lg font-bold transition bg-white/10 hover:bg-white/20 text-gray-200 cursor-pointer">
                                Bekoko (Usine)
                            </button>
                        </div>
                    </div>

                    <!-- Interactive Google Maps Iframe (Format Idéal 460px) -->
                    <div class="relative w-full bg-slate-200 overflow-hidden flex-grow" style="height: 460px !important; min-height: 460px !important;">
                        <iframe id="tpm-google-map"
                                src="https://maps.google.com/maps?q=4.05989,9.78403+(TPM+SA+-+Groupe+CAC+Douala+PK12)&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                class="w-full h-full border-0"
                                style="width: 100% !important; height: 100% !important; border: none !important;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Géolocalisation TPM SA Douala">
                        </iframe>
                    </div>

                    <!-- Bottom Bar: Centralized Direct GPS Navigation Button -->
                    <div class="bg-slate-50 border-t border-gray-200 p-3.5 flex items-center justify-center shrink-0">
                        <a href="https://www.google.com/maps/dir/?api=1&amp;destination=4.05989,9.78403" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           id="map-directions-link"
                           class="inline-flex items-center justify-center gap-2 bg-tpm-orange hover:bg-orange-700 text-white font-black px-8 py-3 rounded-xl text-xs sm:text-sm uppercase tracking-wider transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <span class="material-symbols-outlined text-[18px]">near_me</span>
                            <span>Ouvrir l'Itinéraire GPS (Google Maps)</span>
                        </a>
                    </div>

                </div>

                <!-- Right: Sites Info & Requirements -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="space-y-3">
                        <h2 class="text-2xl sm:text-3xl font-black text-tpm-navy">Sites &amp; Accès</h2>
                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                            Nos installations sont conçues pour accueillir des véhicules de grand gabarit afin de faciliter vos approvisionnements en matériaux de construction et structures métalliques.
                        </p>
                    </div>

                    <!-- Site 1: Usine Principale - Bekoko -->
                    <div class="bg-slate-50 border border-gray-200 rounded-xl p-5 shadow-sm space-y-3 hover:border-tpm-orange/60 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-orange-100 text-tpm-orange flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[22px]">factory</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-tpm-navy">Usine Principale - Bekoko</h3>
                                <p class="text-xs text-gray-500">Zone Industrielle de Bekoko, Douala, Cameroun</p>
                            </div>
                        </div>
                        <ul class="space-y-1.5 pl-12 text-xs text-gray-700 font-medium">
                            <li class="flex items-center gap-2">
                                <span class="text-tpm-orange font-bold">▪</span>
                                <span>Accès camions &gt; 12m: <strong class="text-emerald-700">Oui</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-tpm-orange font-bold">▪</span>
                                <span>Pont bascule: <strong class="text-emerald-700">Disponible</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-tpm-orange font-bold">▪</span>
                                <span>Horaires de charge: <strong>08h00 - 16h00</strong></span>
                            </li>
                        </ul>
                    </div>

                    <!-- Site 2: Comptoir Commercial - PK12 -->
                    <div class="bg-slate-50 border border-gray-200 rounded-xl p-5 shadow-sm space-y-3 hover:border-tpm-orange/60 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[22px]">storefront</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-tpm-navy">Comptoir Commercial - PK12</h3>
                                <p class="text-xs text-gray-500">Axe Lourd Douala-Yaoundé, PK12</p>
                            </div>
                        </div>
                        <ul class="space-y-1.5 pl-12 text-xs text-gray-700 font-medium">
                            <li class="flex items-center gap-2">
                                <span class="text-tpm-orange font-bold">▪</span>
                                <span>Vente au détail: <strong class="text-emerald-700">Oui</strong></span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-tpm-orange font-bold">▪</span>
                                <span>Enlèvement véhicules légers: <strong class="text-emerald-700">Oui</strong></span>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         4. ENVOYER UNE DEMANDE (B2B CONTACT FORM)
         ═══════════════════════════════════════════════════════════ -->
    <section class="py-16 md:py-20 bg-[#F4F6FB]" id="formulaire">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center space-y-2 mb-10">
                <h2 class="text-2xl sm:text-3xl font-black text-tpm-navy">Envoyer une Demande</h2>
                <p class="text-xs sm:text-sm text-gray-600 max-w-xl mx-auto">
                    Remplissez le formulaire ci-dessous pour une prise en charge rapide par nos équipes techniques ou commerciales.
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xl p-6 sm:p-10">

                <?php if ( $form_submitted ) : ?>
                    <div class="mb-6 p-4 rounded-xl text-xs font-bold <?php echo $form_success ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-red-50 text-red-800 border border-red-200'; ?>">
                        <?php echo esc_html( $form_msg ); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="#formulaire" class="space-y-5" enctype="multipart/form-data">
                    <?php wp_nonce_field( 'tpm_contact_action', 'tpm_contact_nonce' ); ?>

                    <!-- Row 1: Nom & NIU -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="contact-nom" class="block text-xs font-bold text-gray-700">
                                Nom / Raison Sociale <span class="text-tpm-orange">*</span>
                            </label>
                            <input type="text" 
                                   id="contact-nom" 
                                   name="nom" 
                                   required 
                                   placeholder="Ex: Entreprise BTP Cameroun" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-tpm-orange focus:border-tpm-orange transition outline-none"/>
                        </div>

                        <div class="space-y-1.5">
                            <label for="contact-niu" class="block text-xs font-bold text-gray-700">
                                NIU (Numéro d'Identifiant Unique)
                            </label>
                            <input type="text" 
                                   id="contact-niu" 
                                   name="niu" 
                                   placeholder="Ex: M052217435713Q" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-tpm-orange focus:border-tpm-orange transition outline-none"/>
                        </div>
                    </div>

                    <!-- Row 2: Email & WhatsApp -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="contact-email" class="block text-xs font-bold text-gray-700">
                                Email Professionnel <span class="text-tpm-orange">*</span>
                            </label>
                            <input type="email" 
                                   id="contact-email" 
                                   name="email" 
                                   required 
                                   placeholder="contact@votre-entreprise.cm" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-tpm-orange focus:border-tpm-orange transition outline-none"/>
                        </div>

                        <div class="space-y-1.5">
                            <label for="contact-phone" class="block text-xs font-bold text-gray-700">
                                Numéro WhatsApp
                            </label>
                            <input type="tel" 
                                   id="contact-phone" 
                                   name="phone" 
                                   placeholder="+237 6XX XX XX XX" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-tpm-orange focus:border-tpm-orange transition outline-none"/>
                        </div>
                    </div>

                    <!-- Row 3: Service Concerné -->
                    <div class="space-y-1.5">
                        <label for="contact-service" class="block text-xs font-bold text-gray-700">
                            Service Concerné <span class="text-tpm-orange">*</span>
                        </label>
                        <div class="relative">
                            <select id="contact-service" 
                                    name="service" 
                                    required 
                                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs appearance-none focus:ring-2 focus:ring-tpm-orange focus:border-tpm-orange transition outline-none font-medium text-gray-700">
                                <option value="" disabled selected>Sélectionnez un service...</option>
                                <option value="Commercial & Devis Pro-Forma">Commercial &amp; Devis Pro-Forma</option>
                                <option value="Bureau d'Études / Calepinage">Bureau d'Études &amp; Calepinage Toiture</option>
                                <option value="Logistique & Enlèvement Usine">Logistique &amp; Enlèvement Usine Bekoko</option>
                                <option value="Station Électro-Zingage 800 VA">Station Électro-Zingage 800 VA</option>
                                <option value="Approvisionnement Gros Chantier BTP">Approvisionnement Gros Chantier BTP</option>
                            </select>
                            <span class="material-symbols-outlined text-[18px] text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                        </div>
                    </div>

                    <!-- Row 4: Message -->
                    <div class="space-y-1.5">
                        <label for="contact-message" class="block text-xs font-bold text-gray-700">
                            Message / Détails de la demande <span class="text-tpm-orange">*</span>
                        </label>
                        <textarea id="contact-message" 
                                  name="message" 
                                  rows="4" 
                                  required 
                                  placeholder="Décrivez votre besoin : types de tôles, profilages, longueurs, accessoires de faîtage, délais de chantier..." 
                                  class="w-full px-3.5 py-2.5 bg-slate-50 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-tpm-orange focus:border-tpm-orange transition outline-none"></textarea>
                    </div>

                    <!-- Row 5: File Upload Dropzone -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-700">
                            Pièces Jointes (PDF, DWG, Images)
                        </label>
                        <label for="contact-file" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl bg-slate-50 hover:bg-slate-100 hover:border-tpm-orange cursor-pointer transition">
                            <span class="material-symbols-outlined text-3xl text-gray-400 mb-1">upload_file</span>
                            <span class="text-xs text-gray-600 font-medium">Cliquez ou glissez vos fichiers ici (Max 10MB)</span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Plans, bordereaux de métrés ou fiches techniques</span>
                            <input type="file" id="contact-file" name="attachment" class="hidden" accept=".pdf,.dwg,.jpg,.jpeg,.png,.zip"/>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-extrabold py-3.5 px-6 rounded-lg uppercase tracking-wider text-xs transition-colors flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                        <span>ENVOYER MON MESSAGE À L'USINE</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </button>
                </form>

            </div>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         5. BOTTOM BANNER: "BESOIN D'UNE RÉPONSE IMMÉDIATE?"
         ═══════════════════════════════════════════════════════════ -->
    <section class="bg-slate-50 py-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center md:text-left">
                <h3 class="text-lg sm:text-xl font-bold text-tpm-navy">Besoin d'une réponse immédiate?</h3>
                <p class="text-xs text-gray-600 font-medium">Nos conseillers techniques sont disponibles sur WhatsApp pour une assistance directe.</p>
            </div>
            
            <a href="https://wa.me/237655705866" 
               target="_blank" 
               class="bg-[#25D366] hover:bg-[#1ebd59] text-white font-black px-6 py-3.5 rounded-lg text-xs uppercase tracking-wider flex items-center gap-2 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 shrink-0">
                <span class="material-symbols-outlined text-[18px]">chat</span>
                <span>CONTACTER SUR WHATSAPP</span>
            </a>
        </div>
    </section>

</main>

<script>
function switchTpmMap(site) {
    const mapIframe = document.getElementById('tpm-google-map');
    const btnPk12   = document.getElementById('map-btn-pk12');
    const btnBekoko = document.getElementById('map-btn-bekoko');
    const dirLink   = document.getElementById('map-directions-link');

    if (site === 'pk12') {
        if (mapIframe) mapIframe.src = 'https://maps.google.com/maps?q=4.05989,9.78403+(TPM+SA+-+Groupe+CAC+Douala+PK12)&t=&z=15&ie=UTF8&iwloc=B&output=embed';
        if (btnPk12) {
            btnPk12.className = 'px-3 py-1.5 rounded-md font-bold transition bg-tpm-orange text-white shadow-sm cursor-pointer';
        }
        if (btnBekoko) {
            btnBekoko.className = 'px-3 py-1.5 rounded-md font-bold transition bg-white/10 hover:bg-white/20 text-gray-200 cursor-pointer';
        }
        if (dirLink) dirLink.href = 'https://www.google.com/maps/dir/?api=1&destination=4.05989,9.78403';
    } else if (site === 'bekoko') {
        if (mapIframe) mapIframe.src = 'https://maps.google.com/maps?q=4.11500,9.57900+(Usine+TPM+SA+Bekoko)&t=&z=15&ie=UTF8&iwloc=B&output=embed';
        if (btnBekoko) {
            btnBekoko.className = 'px-3 py-1.5 rounded-md font-bold transition bg-tpm-orange text-white shadow-sm cursor-pointer';
        }
        if (btnPk12) {
            btnPk12.className = 'px-3 py-1.5 rounded-md font-bold transition bg-white/10 hover:bg-white/20 text-gray-200 cursor-pointer';
        }
        if (dirLink) dirLink.href = 'https://www.google.com/maps/dir/?api=1&destination=4.11500,9.57900';
    }
}
</script>

<?php get_footer(); ?>
