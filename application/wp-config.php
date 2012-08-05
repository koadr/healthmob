<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {

    // Local Environment
    define('WP_ENV', 'local');
    define('WP_DEBUG', true);

    require( 'wp-config-local.php' );

} elseif ( file_exists( dirname( __FILE__ ) . '/wp-config-cruise.php' ) ) {

    // Playground Environment
    define('WP_ENV', 'cruise');
    define('WP_DEBUG', true);

    require( 'wp-config-cruise.php' );

} elseif ( file_exists( dirname( __FILE__ ) . '/wp-config-prod.php' ) ) {

    // Production Environment
    define('WP_ENV', 'prod');
    define('WP_DEBUG', false);

    require( 'wp-config-prod.php' );
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'gDA:Wj_f!`HR|N$F$PFV_sGQ-+pk+egexE+EoG(a@psnJC<o35sE.72C#*D/Ew[G');
define('SECURE_AUTH_KEY',  '~+0]3^r!l%x1@AJ`|0N|qyL~qO|Cf?/o%&M8qU] }bbw[?x1v*[g,+-{UoM?SW@c');
define('LOGGED_IN_KEY',    '`}O<Kyi!Zj%JVG yw~&@k9wn/+B%f#:cs{Gb$/dcFw8I))YjVk,|E5j?95(.A|>.');
define('NONCE_KEY',        ' {~U2tVxv)|z SG%=EM_up]DCcxnsB$z7<q@C1ST0t}@Hh.dKf9Nb}]RQ}+t^$yC');
define('AUTH_SALT',        'C(W9cF6k14Q!&|2lCZ]y?s}]L2S4>3b+#?AcL#< 4K`9.0&, O+iS_1%ckS.2 mM');
define('SECURE_AUTH_SALT', 'W^C8NJXL7{Hg,p>*PyD7WYDjAe8}SUnk<!Pn8b@tz$xl+&SMeV`IU-N/5L*lr#;(');
define('LOGGED_IN_SALT',   '[64B}T&!8yr$^W:aq-*h>bpFWSc5]s>^b~^boR%t@75XN(7(Olq`$/E2|+O:R@@I');
define('NONCE_SALT',       ' cK;Qm_-B-0AZ,w-k N6}<#Eeri!]_)-l.N~w#<#0sjLy:?vk*$PJ|+[_LUTN-ll');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
