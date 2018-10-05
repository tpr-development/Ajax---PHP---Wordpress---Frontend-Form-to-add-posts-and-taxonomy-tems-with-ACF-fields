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
define('DB_NAME', 'thePurchaseTool');

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
define('AUTH_KEY',         'SGFtS$n0uRe nZ|2atq-ijn?+Z)Of[{Vboo{?en~yfO_5NnrH G>5wO_l.0_{&4M');
define('SECURE_AUTH_KEY',  'F[ro{q!7]UiNSO(IweI~4i@!0+nTFs_73?5jM>iV_x:7Ze$kELTIzJ n1EB J&sB');
define('LOGGED_IN_KEY',    ']t0bCBryxgHOI@8KQ}n.nfDWPm|]{pE(^^Yx72kZqpUv[mB4@qZz&{TMTAI-95di');
define('NONCE_KEY',        'tbA8e|l$c*.)M@SA{`@L(aj8tx`=GfHQj3*3j8/z<9Va7<Mu~+wn7qofYp%|.1s1');
define('AUTH_SALT',        '.0@)<B9bi.:jnsx1.)_>T/CHF!z0>^.wiu`=2lG$#a#5JA[}_$75Erf/|h`gv>t6');
define('SECURE_AUTH_SALT', 'm2/J$aDnSc7lsO:|W[wfPnrzXtK=pLiI[8GfC~rQ;RhV@7ZMR8ORq0]pZ681j{A7');
define('LOGGED_IN_SALT',   'N1/C$B|G8h-i~4g{cv{na?`eYp&p&Hi|hOXK#!0TOoKIb@3bWdgq~@`xO@XdhTU=');
define('NONCE_SALT',       'Ow6s:kwj]6Ht03(4kLHsu$:9sNdf[qzD{Lz`+=SGe90hhg5Zo?GRG)>T.qoYLIX ');

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

define( 'WP_MEMORY_LIMIT', '256M' );
