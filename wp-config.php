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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'coupencart' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         ';,HobJ~@ACXe!%v@+nF/h1-_6an(JQ{r%[&L.g-&.cfmyiF?:7Dolv>D`K.tp!?b' );
define( 'SECURE_AUTH_KEY',  ')ku[SELB_$nj^oa#^v>C~L_Beu!~JQ =&YjY<)8NFIYf>`K%Tgg?rQVew7i,K,>f' );
define( 'LOGGED_IN_KEY',    '!>i;H{[!T-c?dcVlOEJ*6]9&a+@y`+q@jMjAN(#I(0Fu$*<MG>GXf0!vr71Re4p:' );
define( 'NONCE_KEY',        '!^Bv]0;cWWD9p&y*5vPR$J*-Y)r&,xh>-zuGX_:1q@M7hMfz619EQhY{ntkN}DAg' );
define( 'AUTH_SALT',        'k6|u&zMFwUl4f6B/UGpC-)rV{HiGhYFB4r|BwJ62LO,]e+gHe xm:T$x/oZ^t2yh' );
define( 'SECURE_AUTH_SALT', 'tJeUs +p/0Su%{Q!4aGYS`=0g#W,Wgy|uHe:x~G8Y7H&2%c4N ^BGGA2LTylQ%=p' );
define( 'LOGGED_IN_SALT',   'i7W>~x~:p#+SNwF gm8##6;s`;VYMnOhlGu=+!4IXou<Xcp<n[y>/fi_/Pb` yD8' );
define( 'NONCE_SALT',       'v>(w $vHlWHEGDOYY~3a4-(6i.!6,m4XV9p#%ZS}`uV)ACGp)@w`T~Qi$eajm_1{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', trur );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
