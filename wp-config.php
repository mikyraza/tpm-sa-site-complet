<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname (Auto-detect active Local by Flywheel port) */
$tpm_db_port = '10011';
if ( function_exists( 'fsockopen' ) ) {
    $fp = @fsockopen( '127.0.0.1', 10011, $errno, $errstr, 0.05 );
    if ( $fp ) {
        fclose( $fp );
        $tpm_db_port = '10011';
    } else {
        $fp2 = @fsockopen( '127.0.0.1', 10010, $errno, $errstr, 0.05 );
        if ( $fp2 ) {
            fclose( $fp2 );
            $tpm_db_port = '10010';
        }
    }
}
define( 'DB_HOST', '127.0.0.1:' . $tpm_db_port );

define( 'WP_MEMORY_LIMIT', '512M' );
define( 'DISABLE_WP_CRON', true );
define( 'WP_HTTP_BLOCK_EXTERNAL', true );
define( 'WP_ACCESSIBLE_HOSTS', 'mpcac.local,127.0.0.1,localhost' );


/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '>z4;#M+wGExP{H>|IsZ c~qBw>S|)@9XwD u97,n(mCEq215;>A0#H:Yoes~$Y<v' );
define( 'SECURE_AUTH_KEY',   '_%(K1G_FXx&/fdgG#,Lz[WSCcrGOC_~,9s4|soK=zf-sQ5C<~I@^cqZcD!*gv8v[' );
define( 'LOGGED_IN_KEY',     'J7*jQx~Vn%ZrRN^lBcL^=<:1I=H4YH^FH7xOrAX@TFQMui*Vq`DA<^Yt_UC1Appr' );
define( 'NONCE_KEY',         '_nx+UOb2Gkl?#f_S??bz[QxN+e3oT!y4p!$[Y&OB16UTVM~!g_:Ayf`Qh>3PujGI' );
define( 'AUTH_SALT',         'Otp&0##T{k^zlZtR.c>g11)Zn#ed3%_14uApY>/;zIpe _cbjH*ud0 VZM<_=9hC' );
define( 'SECURE_AUTH_SALT',  '.|m[bS~w<:`+Y.+rRpt#pe<<Fm|C}w%tQdOsOMO/G1rFoc}rAX[JLjd#-GB~Iys+' );
define( 'LOGGED_IN_SALT',    'e`a6i0~,+jK4<bz3E#O{cjs[bg${_q6q:@sEDP4TrWrHSeQ~^>/]`eZTB7@K;X6`' );
define( 'NONCE_SALT',        '3A*G(?~@`.(J!<8>.S5<Gd*J}5*eZsEd-9`2^?5Hv[LJPcdWhQo.+2j9*[eb>FAo' );
define( 'WP_CACHE_KEY_SALT', 'j0xu*8J/7<{yUJ}z@PLjl<No6$xv!g9iNpaW5k>t^0Eg*3w1Ap{=%qx1cc%Fywyy' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
