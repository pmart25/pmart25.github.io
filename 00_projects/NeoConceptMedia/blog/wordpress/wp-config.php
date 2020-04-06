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
define('DB_NAME', 'a7010140_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '7{l-BlXJ-wN!/&;9ytS5JZ2N5tp%~q1;s{h2SwAHTq?Y|#<2=Hzl&lYmmSt`vp2{');
define('SECURE_AUTH_KEY',  'tD~.$h9@.+q@D&HN%f%~-9-AP)!Mc& l^*vow5[5tA=f|d:T4Uj_3<;&cNnXW=J1');
define('LOGGED_IN_KEY',    ':$*TwA5m$|R([  v@%I`id1!OSB623y1TRK#}5J}Kkmbi~uUdCbVZa2S.N{2enT.');
define('NONCE_KEY',        'm(JGPP,g4T-@DjO@n#&;TF?B3K,{KKv<)/M$f!V5l_4)7VX6^zOF60,!K>W6DH?i');
define('AUTH_SALT',        '_AE] $$[%>UhV?i.GpPPZL @s7d~u5c|FmLa,w6;H=.[S=Y(JuF?Asctwg)I^vl_');
define('SECURE_AUTH_SALT', 'u/GjH _bS*r+i8IAD5M<|T9=3YnFgT.F7N3|CR=[2@9)(T2=e#FA6j8g1FfcuvQa');
define('LOGGED_IN_SALT',   'MgO/(G6eNchbiQ(<+7W9Br-_lLkjm{lrPUO[HVeXAMN}@g@eQ@9`:Ww-3JewP+hX');
define('NONCE_SALT',       'yU+G1JEb!5;0G+S7Z86R&O>!1k& 4{KCpI#lAvHOBq1=>^>)vq0b-Tawu-J{uHD[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ads_wp';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
