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
define('DB_NAME', 'i1875670_wp2');

/** MySQL database username */
define('DB_USER', 'i1875670_wp2');

/** MySQL database password */
define('DB_PASSWORD', 'B&QV@iramSzN3Ymc(~.18((1');

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
define('AUTH_KEY',         'ikkCbVcju3reFkxvsORCrgtglmtzPCCesPCzlMYl1R7B9c8mRenn1CAXdxvmhHtE');
define('SECURE_AUTH_KEY',  'AaHtasduB4CRTFcl9hzUC2oF9ewnQz3snyKHIY4GUJrY06s70lzGyoDL9Ob5HzGr');
define('LOGGED_IN_KEY',    'DFHw0WUU4UGhPwtc9l3cM9SoTKEHm7ZjWOwFGH6xR4Zp7cbQmZEKBDbMNeT8EReT');
define('NONCE_KEY',        'QoXyazJL5VKhhnrbQXC5oRyOSIDEdtmx5vy2gxTmHCiZ8YivIeAzYkZdXBKphfrg');
define('AUTH_SALT',        'W48MKBVIGlUtxAkrb7bSH4VdIqbaJdUJP5dXGajRItOpVIue6KS2IfJWD6HcwMJe');
define('SECURE_AUTH_SALT', '4dQ26lUncMo0ppaF53uN40G8fkViBDu9ryikWndZAyGbwj2VxbzTIsNIQVGiPJ0R');
define('LOGGED_IN_SALT',   '9eyd9Im9xgbrmQJQJydrPjMbROF9NiOjoPArT5mgAGUxV3vZn4vercmVK9YyXShC');
define('NONCE_SALT',       'fqZ3ail2vw8QGHs69GiMGJMsM4CPFNgDxt7Z6FNSRQe5i2qsFGGetONDOJaCYP63');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
