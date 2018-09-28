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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dev_austad' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', '172.20.0.2' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD', 'direct');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'X)CVQ:`<:O%o{Xh.u=OsEq;:QD8l{De/ya6^;i +N=[{&~,$(|! ~,uLDM>Qy>)N' );
define( 'SECURE_AUTH_KEY',  'l/=vh^ c?$$Y(GF=$=48U4A~e `M6Ew%6za>;>/K@lWgiQGHk`RtnpV_n~!EKYcg' );
define( 'LOGGED_IN_KEY',    '%l[MuQ_0rb6QLWHKgT0I|@a4?>p#@F1*Y>7c3=^8`=rtcDpnt}0$Dn8iYS,sYu)2' );
define( 'NONCE_KEY',        ')F$BC3lUb7Whtn0Pm]i,N&bmBx~FzTn3^`.I]fvLh`4@M)HfDe!s` +:L@VjKA:*' );
define( 'AUTH_SALT',        '0&_w88/-I+3]S@1;+rincBRQg0-1e`{4-:p]RU7I$5d[`-Ahi@;n]S8HD`f0]qd`' );
define( 'SECURE_AUTH_SALT', '!^{#1<g79$A:g*G:m|VU_SQI[{.T<YMqW%,f:W-]j_bCBb08wG>mfSV*V4tGH4sB' );
define( 'LOGGED_IN_SALT',   'x;F4$lzN4c2hDO/x`?,r$:Ora-]fj$Z+J b,_L<)Ju[X~3}!QsjY0*51&,5MvK8v' );
define( 'NONCE_SALT',       '-5.8&.I@5J^$NiqL4X3yUS4/}<|@S%qpGAthA0FdJ{Sy]PR3Io2bM^C-o]vdC2R ' );

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
// define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
