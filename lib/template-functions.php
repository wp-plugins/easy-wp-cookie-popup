<?php
/**
 * Template functions for this plugin
 * 
 * Place all functions that may be usable in theme template files here.
 * 
 * @package WordpressCookies
 * 
 * @author jcpeden
 * @version 1.0.0
 * @since 1.0.0
 */

function cookie_popup() {
	global $WPCookies;
	if($WPCookies->get_option( 'position' ) == 'top') {
		$position = 'top';
	} else {
		$position = 'bottom';
	}
	echo '<div id="eu-cookie" class="' .$position .'">';
	echo '<div class="close-icon"><a href="#" id="closecookie" alt="Close"><img src="' .WPCOOKIES_URLPATH . "/images/close.png" .'" /></a></div>';
	if ( !function_exists ('icl_get_languages') ) {
		echo '<h3>' .addslashes($WPCookies->get_option( 'title' )) .'</h3>';
		echo '<p>' .addslashes($WPCookies->get_option( 'message' )) .'</p>';
	} else {
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		if( !empty( $languages ) ) {
			foreach ($languages as $l) {
				if($l['active']) {
					$id = $l['language_code'];
					echo '<h3>' .addslashes($WPCookies->get_option( 'title_lang_' .$id )) .'</h3>';
					echo '<p>' .addslashes($WPCookies->get_option( 'message_lang_' .$id )) .'</p>';
				}
			}
        }
    }
	echo '</div></div>';
}
add_action('wp_footer', 'cookie_popup');

function scripts() {
	global $WPCookies;
	wp_enqueue_script( $WPCookies->namespace ."-popup" );
}
add_action('wp_enqueue_scripts','scripts');

function styles() {
	global $WPCookies;
	wp_enqueue_style( $WPCookies->namespace ."-popup" );
}
add_action('wp_enqueue_scripts','styles');