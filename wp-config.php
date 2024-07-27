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
define( 'DB_NAME', 'defaultdb' );

/** Database username */
define( 'DB_USER', 'doadmin' );

/** Database password */
define( 'DB_PASSWORD', 'AVNS_1JZ-o6jm_uU1P2y8k_d' );

/** Database hostname */
define( 'DB_HOST', 'dbaas-db-6785785-do-user-17348183-0.h.db.ondigitalocean.com:25060' );

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
define( 'AUTH_KEY',         'sgm59%BOqE@UT 43/W4ZT!;]qq$((h0?OG,^.#@f/Q^R,`oIJgL}k@3OsJLSBd_^' );
define( 'SECURE_AUTH_KEY',  '1zMi2mA70&i+AY_%Fm;_/*RFFG#J(LR^GZ+ilB`8$Yo8Nd(Y<Q+i1URp]Au)2y)z' );
define( 'LOGGED_IN_KEY',    'XE(pb>+(TSUdBoDp.^6(K2$L+z#-EFgI{jPF,=[rDAygaonPSVZl aZZ=!jTbRT~' );
define( 'NONCE_KEY',        '.VP;H<**DoF8-&wnvFTbs cY-IOB:%pOX(@*2zU`;Y`&V9ZH}X(N) @mGsFo?y#V' );
define( 'AUTH_SALT',        '+ckdA5x;psM+A1t0u)Y3ONFgxToZY{scm#|E_HiCEb v&Ls[o~yRfwK82_AW}8=p' );
define( 'SECURE_AUTH_SALT', '(-De[TDXzQ)1Il}y<,gkU#y(|]gXHVchuPU+^&7,[>6Q.SF(!gB+iqKM-dCOb,}Q' );
define( 'LOGGED_IN_SALT',   '7 >>7PA~nVtB$/+xSdmj$`l}`Aw{dho}9 crX*(na+nYOUcSFV{3 ye6*9zN#_.f' );
define( 'NONCE_SALT',       'TdH%Dydxu2BLDBYSUA<>uV|86&eGvle6D(<zGJx6M(Ur>_9*{mTNDAxjXK~sRY_8' );

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
