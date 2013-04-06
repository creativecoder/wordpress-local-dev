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
 * Define type of server
 *
 * Depending on the type other stuff can be configured
 * Note: Define them all, don't skip one if other is already defined
 */

define( 'CONFIG_PATH', dirname(__FILE__) ); // cache it for multiple use
define( 'WP_LOCAL_SERVER', file_exists( CONFIG_PATH . '/local-config.php' ) );
define( 'WP_DEV_SERVER', file_exists( CONFIG_PATH . '/dev-config.php' ) || file_exists( CONFIG_PATH . '/../dev-config.php' ) );
define( 'WP_STAGING_SERVER', file_exists( CONFIG_PATH . '/staging-config.php' ) || file_exists( CONFIG_PATH . '/../staging-config.php' ) );

/**
 * Load DB credentials according to development environment
 * Place 
 */

if ( WP_LOCAL_SERVER )
	require CONFIG_PATH . '/local-config.php';
elseif ( file_exists( CONFIG_PATH . '/dev-config.php' ) )
	require CONFIG_PATH . '/dev-config.php';
elseif ( file_exists( CONFIG_PATH . '/../dev-config.php' ) )
	require CONFIG_PATH . '/../dev-config.php';
elseif ( file_exists( CONFIG_PATH . '/staging-config.php' ) )
	require CONFIG_PATH . '/staging-config.php';
elseif ( file_exists( CONFIG_PATH . '/../staging-config.php' ) )
	require CONFIG_PATH . '/../staging-config.php';
elseif ( file_exists( CONFIG_PATH . '/../production-config.php' ) )
	require CONFIG_PATH . '/../production-config.php';
else
	require CONFIG_PATH . '/production-config.php';

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

if ( WP_LOCAL_SERVER || WP_DEV_SERVER ) {
	define( 'WP_DEBUG', true );
} else {
	define( 'WP_DEBUG', false );
}

if (WP_DEBUG) {

	/* Set PHP error and error log settings to override server settings, if needed*/
	//@ini_set('log_errors','Off');
	//@ini_set('display_errors','On');
	//@ini_set('error_reporting', E_ALL );
	//@ini_set('error_log','/home/example.com/logs/php_error.log');
	
	/*
	 * This will log all errors notices and warnings to a file called debug.log in
	 * wp-content only when WP_DEBUG is true. if Apache does not have write permission, 
	 * you may need to create the file first and set the appropriate permissions (i.e. use 666).
	 */
	@ini_set('error_log', CONFIG_PATH . '/php_error.log');
	define('WP_DEBUG_LOG', true);
	
	
	/* Display notices or not (set logging to true if this is false) */
	define('WP_DEBUG_DISPLAY', true);
	/* Matching php settings, if needed */
	//@ini_set('display_errors', 0); // or 1 to turn on error display

	/*
	* Save database queries to an array that can be displayed
	* Note that this will have a performance impact on the site
	*
	* Access these through $wpdb->queries
	*/
	define('SAVEQUERIES', true);
	
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
define( 'WP_CONTENT_DIR', CONFIG_PATH . '/wp-content' );
/* URL of content directory */
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content' );

// ** Set plugin directory, if needed ** //
/* Local path to plugin directory */
//define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
/* URL of plugin directory */
//define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );

// ** Set mu-plugins directory, if needed ** //
/* Local path to mu-plugin directory */
//define( 'WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/mu-plugins' );
/* URL of plugin -mudirectory */
//define( 'WPMU_PLUGIN_URL', WP_CONTENT_URL . '/mu-plugins' );

// ** Set uploads folder **//
//define( 'UPLOADS', WP_CONTENT_DIR . '/uploads' );

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
//define('SUBDOMAIN_INSTALL', false);
//define('DOMAIN_CURRENT_SITE', $_SERVER['SERVER_NAME'] );
//define('PATH_CURRENT_SITE', '/');
//define('SITE_ID_CURRENT_SITE', 1);
//define('BLOG_ID_CURRENT_SITE', 1);

/* Domain mapping plugin */
//define( 'SUNRISE', 'on' );

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
