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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'celebrityblog' );

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
define( 'AUTH_KEY',         'i79HxKjx,I5lvxHbK6*N}LTyJ0{H0a4}:o7Wb{QT9vi;L&r-*R57h*fO=va wF=%' );
define( 'SECURE_AUTH_KEY',  'SM`S~n4!m~N/S3&_Btip,)KuY;G&Z=)c)kl&+f#{s4SrUKET%~2q}uFt!9#-q60m' );
define( 'LOGGED_IN_KEY',    'IganrLg.(0_.LpY!Q$FKe|Kb:z,vXoftjUWo=eB{,ei`kXhbnw=:zH)rJn,)@r47' );
define( 'NONCE_KEY',        'Uw<ZO(.CjNQ{[Z[To.ALaYM#?Qs7lDChWogTf:#M {*2[Vt[|+l=onSoxg6kSe#L' );
define( 'AUTH_SALT',        'S}ZDq5-FluJ>u5g`NgLlf%m|5HMoZo6S#+}5uwWWe]Y%etIVCjl}8*8/LE+wMAUo' );
define( 'SECURE_AUTH_SALT', 'n$SnG$|yg7SXk5cV^L*4|D]ynq1Z %.%xU}rUiz3 eq,^:f_k7pck%wrp=#nArSe' );
define( 'LOGGED_IN_SALT',   '2D]>BJ 8$% y{ibp_z$w5xcjiNX8Rt#JQkV}qVW=>@$M5j!Y3xGVYCh8`Afm3*8t' );
define( 'NONCE_SALT',       ' Dvq/^ntPfOBH()SJILLojh7.kdNjHp%XhiW8m%=~qgjW_[UB)/?HXA fclb{B0t' );

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
