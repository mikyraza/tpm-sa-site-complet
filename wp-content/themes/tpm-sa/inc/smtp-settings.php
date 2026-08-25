<?php
/**
 * inc/smtp-settings.php
 * Integrated SMTP Engine & Test Tool for TPM SA
 * Allows real email delivery to external inboxes (Gmail, Yahoo, Outlook) from Local or Production.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Configure PHPMailer to use SMTP if configured
 */
add_action( 'phpmailer_init', function( $phpmailer ) {
    $smtp_enabled = get_option( 'tpm_smtp_enabled', '0' );
    if ( $smtp_enabled !== '1' ) {
        return;
    }

    $host   = get_option( 'tpm_smtp_host', 'smtp.gmail.com' );
    $port   = get_option( 'tpm_smtp_port', '587' );
    $secure = get_option( 'tpm_smtp_secure', 'tls' );
    $user   = get_option( 'tpm_smtp_user', '' );
    $pass   = get_option( 'tpm_smtp_pass', '' );
    $from   = get_option( 'tpm_smtp_from_email', $user );
    $name   = get_option( 'tpm_smtp_from_name', 'TPM SA (Groupe CAC)' );

    if ( ! empty( $host ) && ! empty( $user ) ) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = $host;
        $phpmailer->SMTPAuth   = true;
        $phpmailer->Port       = intval( $port );
        $phpmailer->Username   = $user;
        $phpmailer->Password   = $pass;
        $phpmailer->SMTPSecure = ( $secure === 'none' ) ? false : $secure;
        $phpmailer->From       = ! empty( $from ) ? $from : $user;
        $phpmailer->FromName   = $name;
    }
} );

/**
 * Add Admin Menu for TPM SMTP Settings
 */
add_action( 'admin_menu', function() {
    add_options_page(
        'TPM Configuration SMTP & Emails',
        'TPM Emails (SMTP)',
        'manage_options',
        'tpm-smtp-settings',
        'tpm_render_smtp_settings_page'
    );
} );

/**
 * Register Settings
 */
add_action( 'admin_init', function() {
    register_setting( 'tpm_smtp_group', 'tpm_smtp_enabled' );
    register_setting( 'tpm_smtp_group', 'tpm_smtp_host' );
    register_setting( 'tpm_smtp_group', 'tpm_smtp_port' );
    register_setting( 'tpm_smtp_group', 'tpm_smtp_secure' );
    register_setting( 'tpm_smtp_group', 'tpm_smtp_user' );
    register_setting( 'tpm_smtp_group', 'tpm_smtp_pass' );
    register_setting( 'tpm_smtp_group', 'tpm_smtp_from_email' );
    register_setting( 'tpm_smtp_group', 'tpm_smtp_from_name' );
} );

/**
 * Render Admin Settings Page
 */
function tpm_render_smtp_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $test_sent = false;
    $test_error = '';

    // Handle Test Email Dispatch
    if ( isset( $_POST['tpm_send_test_email'] ) && check_admin_referer( 'tpm_test_email_nonce' ) ) {
        $test_recipient = sanitize_email( $_POST['test_email_recipient'] );
        if ( is_email( $test_recipient ) ) {
            $subject = 'TPM SA — Test de Connexion Emailing & Commandes';
            $message = '
            <div style="background-color:#f1f5f9; padding:20px; font-family:Helvetica,Arial,sans-serif;">
                <div style="max-width:550px; margin:0 auto; background-color:#ffffff; border-radius:10px; border:2px solid #1C1340; padding:25px;">
                    <h2 style="color:#1C1340; margin-top:0;">TPM SA (Groupe CAC)</h2>
                    <p style="color:#059669; font-weight:bold; font-size:16px;">✔ Le serveur SMTP fonctionne parfaitement !</p>
                    <p style="color:#475569; font-size:13px; line-height:1.5;">Ce message confirme que votre site WordPress envoie désormais des reçus officiels directement vers les boîtes emails externes (Gmail, Yahoo, Outlook, etc.).</p>
                    <p style="font-size:11px; color:#94a3b8; border-top:1px solid #e2e8f0; padding-top:10px; margin-top:20px;">Usines de Douala PK12 & Bekoko • Cameroun</p>
                </div>
            </div>';
            $headers = array( 'Content-Type: text/html; charset=UTF-8' );

            $mail_success = wp_mail( $test_recipient, $subject, $message, $headers );
            if ( $mail_success ) {
                $test_sent = true;
            } else {
                global $phpmailer;
                $test_error = isset( $phpmailer->ErrorInfo ) ? $phpmailer->ErrorInfo : 'Échec de l\'envoi du test.';
            }
        } else {
            $test_error = 'Veuillez saisir une adresse email valide pour le test.';
        }
    }

    $enabled = get_option( 'tpm_smtp_enabled', '0' );
    $host    = get_option( 'tpm_smtp_host', 'smtp.gmail.com' );
    $port    = get_option( 'tpm_smtp_port', '587' );
    $secure  = get_option( 'tpm_smtp_secure', 'tls' );
    $user    = get_option( 'tpm_smtp_user', '' );
    $pass    = get_option( 'tpm_smtp_pass', '' );
    $from    = get_option( 'tpm_smtp_from_email', 'cac_vis3@yahoo.fr' );
    $name    = get_option( 'tpm_smtp_from_name', 'TPM SA (Groupe CAC)' );
    ?>
    <div class="wrap" style="max-width:850px;">
        <h1 style="color:#1C1340; font-weight:900;">Configuration Envoi Emails &amp; Reçus de Commandes (SMTP)</h1>
        
        <div style="background:#fff; border-left:4px solid #D84B1F; padding:15px; margin:20px 0; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <p style="margin:0; font-size:13px; color:#334155;">
                <strong>ℹ️ En environnement local (Local by Flywheel) :</strong><br>
                Par défaut, WordPress stocke tous les emails générés dans l'outil interne <strong>Mailpit</strong> de l'application Local (onglet <em>Tools > Mailpit</em>).<br>
                Pour que les clients reçoivent <strong>réellement</strong> les emails dans leur boîte de réception externe (ex: <code>@gmail.com</code> ou <code>@yahoo.fr</code>), activez l'envoi SMTP ci-dessous avec votre compte Gmail (Mot de passe d'application) ou un relais SMTP gratuit (ex: Brevo / Sendinblue).
            </p>
        </div>

        <?php if ( $test_sent ) : ?>
            <div class="notice notice-success is-dismissible" style="padding:10px 15px; font-weight:bold; font-size:14px;">
                ✔ Email de test envoyé avec succès à <?php echo esc_html( $_POST['test_email_recipient'] ); ?> !
            </div>
        <?php elseif ( ! empty( $test_error ) ) : ?>
            <div class="notice notice-error" style="padding:10px 15px; font-weight:bold;">
                ❌ Erreur lors du test : <?php echo esc_html( $test_error ); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="options.php" style="background:#fff; padding:25px; border-radius:8px; border:1px solid #e2e8f0; margin-top:20px;">
            <?php settings_fields( 'tpm_smtp_group' ); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row">Activer l'envoi SMTP réel</th>
                    <td>
                        <label>
                            <input type="checkbox" name="tpm_smtp_enabled" value="1" <?php checked( $enabled, '1' ); ?> />
                            <strong>Activer l'expédition externe via SMTP</strong> (Désactive la rétention locale)
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Hôte SMTP (Host)</th>
                    <td>
                        <input type="text" name="tpm_smtp_host" value="<?php echo esc_attr( $host ); ?>" class="regular-text" placeholder="smtp.gmail.com" />
                        <p class="description">Pour Gmail : <code>smtp.gmail.com</code> | Pour Brevo : <code>smtp-relay.brevo.com</code></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Port SMTP</th>
                    <td>
                        <input type="number" name="tpm_smtp_port" value="<?php echo esc_attr( $port ); ?>" style="width:100px;" />
                        <p class="description">Généralement <code>587</code> (TLS) ou <code>465</code> (SSL).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Chiffrement / Sécurité</th>
                    <td>
                        <select name="tpm_smtp_secure">
                            <option value="tls" <?php selected( $secure, 'tls' ); ?>>TLS (Recommandé - Port 587)</option>
                            <option value="ssl" <?php selected( $secure, 'ssl' ); ?>>SSL (Port 465)</option>
                            <option value="none" <?php selected( $secure, 'none' ); ?>>Aucun</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Identifiant / Email SMTP</th>
                    <td>
                        <input type="text" name="tpm_smtp_user" value="<?php echo esc_attr( $user ); ?>" class="regular-text" placeholder="votre-email@gmail.com" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Mot de passe SMTP</th>
                    <td>
                        <input type="password" name="tpm_smtp_pass" value="<?php echo esc_attr( $pass ); ?>" class="regular-text" placeholder="••••••••••••••••" />
                        <p class="description">Pour Gmail : utilisez un <strong>Mot de passe d'application</strong> généré depuis votre compte Google (Sécurité &gt; Validation en 2 étapes &gt; Mots de passe des applications).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Email de l'expéditeur</th>
                    <td>
                        <input type="email" name="tpm_smtp_from_email" value="<?php echo esc_attr( $from ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Nom de l'expéditeur</th>
                    <td>
                        <input type="text" name="tpm_smtp_from_name" value="<?php echo esc_attr( $name ); ?>" class="regular-text" />
                    </td>
                </tr>
            </table>

            <?php submit_button( 'Enregistrer la configuration SMTP' ); ?>
        </form>

        <!-- TEST DISPATCH BOX -->
        <div style="background:#f8fafc; padding:20px; border-radius:8px; border:1px solid #cbd5e1; margin-top:30px;">
            <h3 style="margin-top:0; color:#1C1340;">🧪 Tester l'envoi d'un email</h3>
            <p style="font-size:12px; color:#475569;">Envoyez un email de test pour vous assurer que les reçus de commande arrivent bien dans votre boîte Gmail/Yahoo.</p>
            
            <form method="post" action="" style="display:flex; gap:10px; align-items:center;">
                <?php wp_nonce_field( 'tpm_test_email_nonce' ); ?>
                <input type="email" name="test_email_recipient" value="ngockrejoice44@gmail.com" style="min-width:280px; padding:6px 10px;" required />
                <button type="submit" name="tpm_send_test_email" class="button button-primary" style="background:#D84B1F; border-color:#D84B1F;">
                    Envoyer l'email de test →
                </button>
            </form>
        </div>
    </div>
    <?php
}
