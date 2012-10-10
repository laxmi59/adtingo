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
define('DB_NAME', 'adtingo_changes');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '}i{P#[MGXF+M]C^9%R|8-=Pth+,&4ab:n-N5K?0OY-h8-a`BA4DkNK;cSj!xAhX^');
define('SECURE_AUTH_KEY',  '9%g(Fe`-e-/0[nwfmc+#V-N OY-9%`l}HY=|[ItNsQ~^[V9A0v>pnLRMfAH1]qKA');
define('LOGGED_IN_KEY',    'X=oF&QJ|{87gVs-+_O d^gI|#fM#KF&%5kqmWm3Sy!_?is SwA0=,*~6x+cex5)w');
define('NONCE_KEY',        '}|#0B.@p@ErRLMsZ1+5]A%L6OWa;,}7Ev zjOl$jL-|f6Vh^W-Eh1}Ht>@b+A$fK');
define('AUTH_SALT',        'N,UziQG=H.#l[;h+~|o0_(l1p%oo~`*Y{}KzC2/3woBbr|adK}AC]abZEi+S|1t[');
define('SECURE_AUTH_SALT', '0tt82bB@W`;*+h[%b*}a&6uy;,jd5tQ$5+~:4ro+M`W S76PFahX0b7eTKN_W$zp');
define('LOGGED_IN_SALT',   'As|Fa{n{Bd$)SUfu@(Q]HM]5<{-KoneH c5?y%u3V3g$w|n,;=>o+B~(cQzx?D20');
define('NONCE_SALT',       'vvLf0E9T~)[eYRz~Tom9*sM)IOi&AH;5Bei8uWhc9wleQs7h+]0|@5v}wjQwWnZ=');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
