<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
/** The multiple website setting */
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress/abani');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress/abani');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'rosygroup_abani');

/** MySQL database username */
define('DB_USER', 'rosygroup_rosy');

/** MySQL database password */
define('DB_PASSWORD', '6GqbKx0t');

/** MySQL hostname */
define('DB_HOST', '42.117.2.24');

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
define('AUTH_KEY',         'l2.6a`Y:QJ3m|[!;+kJjls0,6$>Nj=UyIDmt5^m$spjSN8{-s$NT0^#vM]7D%Cn*');
define('SECURE_AUTH_KEY',  '}U*YZ<i*5tB=&+n+NMp&E)UQN|*J,++kqrB*~fzb&Qt9Ecl7N:JmD)|/~<4>0o_@');
define('LOGGED_IN_KEY',    '|4 LJ^}*Gp*f$Q*5e8+5$pWKd/CgBqEvb.^Ku,]5&-@[P*#U546+n+X.tI-WQ;[N');
define('NONCE_KEY',        'IwZD!Yr=PAw,F^Rv(]/z`#L+9/od[5yDlzmQR_;!VD*Nz0Do#(+(I37#{fp*vn S');
define('AUTH_SALT',        '<o&!BK-k0i4e6-n(T5B/$_jGrkYPH<)n bN4*`rKh%EQ[3DS-y+*yY/.w!f%s|n@');
define('SECURE_AUTH_SALT', 'Sk~6dTqz1ZbO803iDW)+ k-*D4%}@|$y2K-JD$) y].9yvUY95f=rjvdS1}Ju5tX');
define('LOGGED_IN_SALT',   'cp?l=|n9mFWLYatR6y /Y?N[GfzfMVZ>Q:NERyM!@x+|tU;c2B]Z6oDW<_zivmMZ');
define('NONCE_SALT',       'kqL%, &Q--z`^{FM;HL&p%3:ZI+I :rlc/Q-nWrf>UOqiTJ1Oh`H==$,%3fSkcSz');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
