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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ak1' );

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
define( 'AUTH_KEY',         '!YwR<:}tJLZw?/~aWqk#tB{GXkQ>JrO$MqX)2NyRsD@QZz=C(I_v5TIb:KM.$SJS' );
define( 'SECURE_AUTH_KEY',  '*da-9qp[ >[: A9_%y/H3`N&52n.IhCJU*@FXg}TQc^J 1@EpH,`D2K7V9O]f?]&' );
define( 'LOGGED_IN_KEY',    'NW37~S7nmD[SF9Q?RiomoEbf.)q7[bsl|;2[E&fX#J`tTA[0Vj$,J,W=KXY}}r B' );
define( 'NONCE_KEY',        '_VBl+lj~@FVKRpUBu-;Bp-M{#qPu3dVRK0Kn-h`A#6=oeFbIMiSqJ+Rscz+84[s$' );
define( 'AUTH_SALT',        'XO<la$.Db]r2K^[*S52VB olj`%A|:QB-In8:(SzdQVO_i(3?G=W5`I}/DTm3ADL' );
define( 'SECURE_AUTH_SALT', '9t~|-wf#*THO998F/2k59]<p]k3=-(EDZ2SI<}xPH8,_E/uQK>$x2!fknNx7(E=0' );
define( 'LOGGED_IN_SALT',   'H!jcV!F;ItmVa!nhQq[KVT5!8Y+KLB4H8bxC&E`%`!GvZo~w=5JT`z`QUT}[vw d' );
define( 'NONCE_SALT',       'vPVuC 8nILdP?`qARf=|RNS)2vlIaN#Ct]WyP_eD*@QFhBjxY[wHl]z)IZg93C*v' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
