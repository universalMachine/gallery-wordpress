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
define('DB_NAME', 'imageDb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'QQAAZZ1wwssxx#');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1:3306');

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
#define('AUTH_KEY',         'put your unique phrase here');
#define('SECURE_AUTH_KEY',  'put your unique phrase here');
#define('LOGGED_IN_KEY',    'put your unique phrase here');
#define('NONCE_KEY',        'put your unique phrase here');
#define('AUTH_SALT',        'put your unique phrase here');
#define('SECURE_AUTH_SALT', 'put your unique phrase here');
#define('LOGGED_IN_SALT',   'put your unique phrase here');
#define('NONCE_SALT',       'put your unique phrase here');

define('AUTH_KEY',         'kS*eu6s|3kPUa&6[1b!uI&j&%RuZjf[4Sd.L+ cLDY?Q-(:vHiOO`2W.pYR42~/t');
define('SECURE_AUTH_KEY',  'IZ8`E9X}3Nm(rkSkv2,!LO4AQW&.n<#w<*Dj-w3Y?Y_~_zcZ{6ey!N7l8UL9YVo|');
define('LOGGED_IN_KEY',    'B*vNc?K-2n^|`6+rYLVY+2QJy=zH+gV>K>H0**yrG)P8^O!-7Z$.;<lt@VV%Z5*N');
define('NONCE_KEY',        'f{29H+Tz:pW/^)>E9g0529vp>-=60dOrWn0657_Y|6S5UO)3%%Blc4ceJD4t.~+{');
define('AUTH_SALT',        ']P>YZrfvf+OYy?4wm:IuO,C$P+2%|Jo>bKdB4};P6Jlxc$<*me|=fv.^0ZAij`vk');
define('SECURE_AUTH_SALT', 'J3}hC%99J8K2|J!~cTk^oa;DZ.W*j[CU@I2-dXtCE/nR=4p(Y$CQ4C>3?O=:Q|!+');
define('LOGGED_IN_SALT',   '!?+{+)-)|l,1 MSYCu1(S,c9SM7z.PU}pHLwtI4;>#BS{J)Ejp-:]R#rWYB[-U&^');
define('NONCE_SALT',       '-)_Ys!^4Nf} V$zfCuh?JHrL_2@Uc-VKsIx4AOj[MR<aG]n+RP;kA|GXS ,i4bOO');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
