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
 * You can view all defined constants with:
 * print_r(@get_defined_constants());
 *
 * @package WordPress
 */

/**
 * Define WordPress URLs if needed (all of these will override the settings in the wp_options table)
 */
 
/* URL where wordpress core files reside */
define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wordpress');
/* URL where people can reach your website */
define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME']);

/*
 * Define wp-content directory dynamically based on server name
 * This allows multiple sites to run off one set of core files
 */
/* Full local path for content directory */
define( 'WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content' );
/* URL of content directory */
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content' );

// ** Set plugin directory, if needed ** //
/* Local path to plugin directory */
//define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
/* URL of plugin directory */
//define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );

// ** Set uploads folder **//
//define( 'UPLOADS', WP_CONTENT_DIR . '/uploads' );

// ** MySQL settings - load unique db-config.php file for each separate site ** //
if ( file_exists( dirname(__FILE__) . '/' . $_SERVER['SERVER_NAME'] . '/db-config.php' ) ) {
	require_once( dirname(__FILE__) . '/' . $_SERVER['SERVER_NAME'] . '/db-config.php' );
} else {
	echo "Sorry, no configuration defined.";
	die;
}

// ** MySQL settings that are the same for all local sites ** //
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
define('AUTH_KEY',         '');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    '');
define('NONCE_KEY',        '');
define('AUTH_SALT',        '');
define('SECURE_AUTH_SALT', '');
define('LOGGED_IN_SALT',   '');
define('NONCE_SALT',       '');

/**#@-*/

// ** Additional WordPress settings ** //

/* Change interval for AJAX saves when editing posts */
//define('AUTOSAVE_INTERVAL', 160 );  // seconds

/* Specify number of post revisions to save (or disable with 'false') */
//define('WP_POST_REVISIONS', 3);

/* Specify number of days content is held in trash before being permanently deleted */
//define('EMPTY_TRASH_DAYS', 30 );  // default is 30 days; set to 0 to disable trash

/**
 * Set Cookie Domain
 * 
 * The domain set in the cookies for WordPress can be specified for those with unusual domain
 * setups. One reason is if subdomains are used to serve static content. To prevent WordPress
 * cookies from being sent with each request to static content on your subdomain you can set
 * the cookie domain to your non-static domain only.
 */
//define('COOKIE_DOMAIN', 'www.askapache.com');

/**
 * Disable Plugin and Theme Editor
 *
 * Warning: may break plugins that rely on current_user_can('edit_plugins')
 */
//define('DISALLOW_FILE_EDIT',true);

/*
 * Disable Plugin and Theme Update Installation
 * 
 * Blocks users being able to use the plugin and theme installation/update functionality
 * from the WordPress admin area. Also disallows the theme and plugin editors
 */
//define('DISALLOW_FILE_MODS',true);

// ** Enable WordPress Multisite ** //
//define('WP_ALLOW_MULTISITE', true);

/**
 * WP_CRON Settings
 */
/* Disable cron entirely */
//define('DISABLE_WP_CRON',true);

/* Make sure a cron process cannot run more than once every so many seconds */
//define('WP_CRON_LOCK_TIMEOUT',60);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
 
/*
 * Will cause all PHP errors, notices, and warnings to be displayed, as well as
 * WordPress depreciated notices
 */
 
define('WP_DEBUG', true); // or false
if (WP_DEBUG) {
  
	/* Set PHP error and error log settings */
	//@ini_set('log_errors','Off');
	//@ini_set('display_errors','On');
	//@ini_set('error_reporting', E_ALL );
	//@ini_set('error_log','/home/example.com/logs/php_error.log');
	
	/*
	 * This will log all errors notices and warnings to a file called debug.log in
	 * wp-content only when WP_DEBUG is true. if Apache does not have write permission, 
	 * you may need to create the file first and set the appropriate permissions (i.e. use 666).
	 */
	define('WP_DEBUG_LOG', false);
	
	/* Display notices or not (set logging to true if this is false) */
	define('WP_DEBUG_DISPLAY', true);
	/* Matching php settings, if needed */
	//@ini_set('display_errors', 0);

	/*
	* Save database queries to an array that can be displayed
	* Note that this will have a performance impact on the site
	*
	* Access these through $wpdb->queries
	*/
	//define('SAVEQUERIES', true);
	
	// ** Script Debugging ** //
	/*
	 * If true, changes made to the scriptname.dev.js and filename.dev.css files in the
	 * wp-includes/js, wp-includes/css, wp-admin/js, and wp-admin/css directories will be
	 * reflected on your site.
	 */
	//define('SCRIPT_DEBUG', true);
	
	/*
	 * Disable javascript concatenation in admin area
	 */
	//define('CONCATENATE_SCRIPTS', false);
}

// ** Server Setting Overrides ** //

// ** Increase PHP memory limit settings, if possible/needed ** //
//define('WP_MEMORY_LIMIT', '64M');

/* Change PHP memory limit in WordPress administration area */
//define('WP_MAX_MEMORY_LIMIT', '256M');

/* Attempt to override default file permissions */
//define('FS_CHMOD_DIR', (0755 & ~ umask()));
//define('FS_CHMOD_FILE', (0644 & ~ umask()));

/**
 * Enable Automatic Database Repair
 * Note that this can be accessed at /wp-admin/maint/repair.php even when not logged in
 */
//define('WP_ALLOW_REPAIR', true);

/**
 * Do Not Upgrade Global Tables
 * Prevents upgrade functions from doing expensive database queries on global tables
 *
 * Particularly useful for sites with large user and usermeta tables, so the database upgrade
 * can be done manually
 *
 * Also useful for installations that share user tables between bbPress and WordPress installs
 * Where only one site should be the upgrade master
 */
//define('DO_NOT_UPGRADE_GLOBAL_TABLES', true);

/**
 * Custom User and Usermeta Tables
 *
 * Defined a custom user and usermeta table that can be used for multiple instances of WordPress
 */
//define('CUSTOM_USER_TABLE', $table_prefix.'my_users');
//define('CUSTOM_USER_META_TABLE', $table_prefix.'my_usermeta');

/**
 * SSL
 */
/* Force SSL Login */
//define('FORCE_SSL_LOGIN',true);

/* Force SSL for Logins and Admin */
//define('FORCE_SSL_ADMIN',true);

// ** Caching - include the wp-content/advanced-cache.php script ** //
define('WP_CACHE', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
