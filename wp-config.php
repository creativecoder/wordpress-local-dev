<?php

/**
 * WordPress Local Development Config File, set to include the unique wp-config.php file from each
 * site in the local development environment.
 *
 * This allows you to run multiple sites off one instance of WordPress core files
 */

 if ( file_exists( dirname(__FILE__) . '/' . $_SERVER['SERVER_NAME'] . '/wp-config.php' ) ) {
 	require_once( dirname(__FILE__) . '/' . $_SERVER['SERVER_NAME'] . '/wp-config.php' );
 } else {
 	echo "Sorry, no configuration defined.";
 	die;
 }