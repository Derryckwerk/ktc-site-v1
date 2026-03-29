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

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'HW.kh<Cf<}{1HF[S&}u4-Gy^P^ZO>|*sjT:IQih5MYh6tc|&L>P?{k5<cnRRrdbN' );
define( 'SECURE_AUTH_KEY',   '(!Pwpta(NdM*9[H0(U;1A.3$vO ~Pbi5@[HO0bQBU2QALH=EY4<l^DzNqSHy%(^J' );
define( 'LOGGED_IN_KEY',     '}S5_MUsqrQ#L t8vxHcdMspGIk[aJxpxa.7buGHJ|F3ulwD*U>0-{wa447#/ZfId' );
define( 'NONCE_KEY',         '_%yyj} )iD;!,#gr<zF!m=gAE3!wy?Z-wR8+adJQy#PJ|LYBKm5%YU UD5qg@c -' );
define( 'AUTH_SALT',         'fU=4!06i,-J=6+R(fBZ*m-Y (=;bA~rYlQ:^hDP}$6Jx&8:;bf(Ly0eiG 3V/M]^' );
define( 'SECURE_AUTH_SALT',  '=qQ5k{;l>f`jX-Ov5+/W|^%!+y-WT2V|Y{!XCEJCBqEY573B5dP:fZD<cp@4g^w=' );
define( 'LOGGED_IN_SALT',    '4iw/gtt.uLq(#]5N!WeF8#c,(#D4e>3R+C%CxjU&WT2wYw9l&C-Wol4)uj!Tru/~' );
define( 'NONCE_SALT',        ':H<r6y.=VI;_.X,PW>apD%bJM_07eZC$c`;]Ug{t=ePzd}[>/iFVi<do({_6Kjy0' );
define( 'WP_CACHE_KEY_SALT', '3._rpWPIsvgDyxxY!|?3?Q{G/fE81(98Q.^%*@:Qq{<bt07N2eB;Q^c%e6#yAp)@' );


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
