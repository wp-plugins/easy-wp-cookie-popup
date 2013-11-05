<?php
/**
 * Constants used by this plugin
 * 
 * @package WPCOOKIES
 * 
 * @author jcpeden
 * @version 1.0.1
 * @since 1.0.0
 */

// The current version of this plugin
if( !defined( 'WPCOOKIES_VERSION' ) ) define( 'WPCOOKIES_VERSION', '1.0.1' );

// The directory the plugin resides in
if( !defined( 'WPCOOKIES_DIRNAME' ) ) define( 'WPCOOKIES_DIRNAME', dirname( dirname( __FILE__ ) ) );

// The URL path of this plugin
if( !defined( 'WPCOOKIES_URLPATH' ) ) define( 'WPCOOKIES_URLPATH', WP_PLUGIN_URL . "/" . plugin_basename( WPCOOKIES_DIRNAME ) );

if( !defined( 'IS_AJAX_REQUEST' ) ) define( 'IS_AJAX_REQUEST', ( !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) );