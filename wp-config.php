<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hercastlelive' );

/** MySQL database username */
define( 'DB_USER', 'hercastle' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Fa5A{&B\bJDwu-(v' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'zu+k4cR>eBOSo!UaI8tnX<nX3<hk`ZqtPH_k]0hvI~`2MxN]{OEx|@C(Yx8`7Pjj' );
define( 'SECURE_AUTH_KEY',  'iZ5A%vOY_5+a</@k8`Q,0WH4znjaC]6I$N(7VZsv;gb|(^,xLZ)&3TP>TPx,{FpW' );
define( 'LOGGED_IN_KEY',    'pV}Gl%*x1S6kFlUk3<,B- lgc@(9bF*~<Zg0grT_r[Gx#BcK2vJW}ek|KkQo-`D=' );
define( 'NONCE_KEY',        '?94[5_~DLVpMbWW@%]Z`~%q.+5*/2#t5O#1Ml,X5]8{:50Y2I/jP5!EoE4t-vv(P' );
define( 'AUTH_SALT',        'NIfa(TG5#Pn[#NUv~58;fb_x?y(l/MkLlB*w95< ++E9FJE#-?yTea) ^~}idOXY' );
define( 'SECURE_AUTH_SALT', 'M9}lRi(|P5cKY!q0X.M1mH<9gPG7*3{nf$u;=KhSd}<$Tx!-S.@8M)q[iW:MA& _' );
define( 'LOGGED_IN_SALT',   '[h4m$H8+zCs/]hynp0k8sG/HjnB:.^~dfozd-VIYd&j}yC2%L3|s`X[?&?Kk7wuh' );
define( 'NONCE_SALT',       'R7JWnC}4V1cw9RW}(v!~#10*au _98&z?+b8M1y6OMRUPUT-r!HS|9Yb.&m)$+}K' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
