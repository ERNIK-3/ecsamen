<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'PWJUFS|>XNi%WutSD+39Y$Z,0}:)-Z$g4$nI{JP;:;;% }b9Y/vm_h(l_kl,%n1=' );
define( 'SECURE_AUTH_KEY',  ':]L#|Oc:PzapF`#qx1xv.L&tC!?Ixzj *Gg[dGsv QB_3Fy@aBXSL9&!90z*ld[D' );
define( 'LOGGED_IN_KEY',    'KlZ~uBvmU`@p{Y;w r!*uk(M9h86!g;N?vG&ctO/RZ>_/ 6Tn06an,Zje[H!Sv]u' );
define( 'NONCE_KEY',        'L;;L+j62.IGUUG<:(TEa`JBM[Wnx9j8QzvXTikxX/__]_]l+o8-5[dh1_8P#6;rU' );
define( 'AUTH_SALT',        ' #jK) 9}gx*Qct}vC{)<T{+i_x_dg_46 BIF2#5dT..$nZ*/R<3wgy5Wyn.h2_ 4' );
define( 'SECURE_AUTH_SALT', '@,G}-S7`c.LL6V@:voaAT<vz`+ZxP7N@1{6xWCX<S|sKYMC+K(u^F#:>MXaU5/C7' );
define( 'LOGGED_IN_SALT',   'UG^:,.#{Uoo8)Y`;#8(<<8+l[zEPY6ek+#.lk:r_b#40C7e|;,j%PF]yiQYq8;WC' );
define( 'NONCE_SALT',       'R//^%0/[YIU=v/knLmyS;5|%<Yj6*;(uZK:%klVwDCRXu=-JflW+7T;n,!b:ckE~' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
