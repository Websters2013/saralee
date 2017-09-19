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
define('DB_NAME', 'websters_saralee');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'J|+u YlvGc[E_+=QqtTFSy#FK* hSTj,j2UKheSZ`%)15Iy9:7M6H{@PG:VntOK,');
define('SECURE_AUTH_KEY',  '^wOVsp@}O~n-kfOTi2A)0!608bi(;?HXscQ*,Je/`Em0uo#19FrIrH|7B[j*ozOM');
define('LOGGED_IN_KEY',    'a$;SqIZN7OOBL.1xADQEO&^(m?t^x-{8 T3ysT)DMHOym?<u9LQ+I}&~% x;ST[h');
define('NONCE_KEY',        'Oxs,lyYt!s%y.e.1?(${^Qd  ;mZz/!![0<M4hFZn7Dqg(8%8F=luT)LI><@%Jy.');
define('AUTH_SALT',        '^=N}Ko<RhcX1ua_(Rtl^_zn%l_F^xmuC-yh0;^VJ|U3wSowYeeMat2e/| B-HqnY');
define('SECURE_AUTH_SALT', 'LolB2%[v5mIlY]g1S[xX^5ri+#. #=npeHDwi}3 3TCTt:*g9x{!#wpQ#D5&A7<+');
define('LOGGED_IN_SALT',   'X`C/9jNd|[$at;gz+>2`o}c.?ie$$u*em^:QSs{2UH]lh3=%Szm)9gM8dgmn9:KG');
define('NONCE_SALT',       '/]qqH^dCsV1&QHu/Gt{FDGa&Z_xjM[z#mU]wLcK~7:0y3O-~Xw;= }::!eZyL5u2');

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
