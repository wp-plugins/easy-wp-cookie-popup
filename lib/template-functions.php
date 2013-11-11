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
	} ?>
	<div id="eu-cookie" class="<?php echo $position; ?>">
		<div class="close-icon">
			<a href="#" id="closecookie" alt="Close"><img src="<?php echo WPCOOKIES_URLPATH; ?>/images/close.png" /></a>
		</div>
		<?php if ( !function_exists ('icl_get_languages') ) { ?>
			<h3><?php echo ($WPCookies->get_option( 'title' )); ?></h3>
			<p><?php echo ($WPCookies->get_option( 'message' )); ?></p>
		<?php } else {
			$languages = icl_get_languages('skip_missing=0&orderby=code');
			if( !empty( $languages ) ) {
				foreach ($languages as $l) {
					if($l['active']) {
						$id = $l['language_code']; ?>
						<h3><?php echo ($WPCookies->get_option( 'title_lang_' .$id )); ?></h3>
						<p><?php echo ($WPCookies->get_option( 'message_lang_' .$id )); ?></p>
					<?php }
				}
	        }
	    } ?>
		</div>
	</div>
<?php }
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

/**
	* Load Presstrends tracking code 
	* 
	* @uses wp_get_theme()
	* @uses get_theme_data()
	* @uses get_stylesheet_directory()
	* @uses get_plugins()
	* @uses get_plugin_data()
	* @uses wp_remote_get()
	* @uses set_transient()
	*
*/

function cookies_load_presstrends() {
	global $WPCookies;
	if($WPCookies->get_option( 'presstrends' ) == 'enabled') {
		// PressTrends Account API Key
		$api_key = 'rwiyhqfp7eioeh62h6t3ulvcghn2q8cr7j5x';
		$auth    = '13xmuig5z9cxijdepezqd8i8nh2nqllx6';

		// Start of Metrics
		global $wpdb;
		$data = get_transient( 'presstrends_cache_data' );
		if ( !$data || $data == '' ) {
			$api_base = 'http://api.presstrends.io/index.php/api/pluginsites/update/auth/';
			$url      = $api_base . $auth . '/api/' . $api_key . '/';

			$count_posts    = wp_count_posts();
			$count_pages    = wp_count_posts( 'page' );
			$comments_count = wp_count_comments();

			// wp_get_theme was introduced in 3.4, for compatibility with older versions, let's do a workaround for now.
			if ( function_exists( 'wp_get_theme' ) ) {
				$theme_data = wp_get_theme();
				$theme_name = urlencode( $theme_data->Name );
			} else {
				$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
				$theme_name = $theme_data['Name'];
			}

			$plugin_name = '&';
			foreach ( get_plugins() as $plugin_info ) {
				$plugin_name .= $plugin_info['Name'] . '&';
			}
			// CHANGE __FILE__ PATH IF LOCATED OUTSIDE MAIN PLUGIN FILE
			$plugin_data         = get_plugin_data( __FILE__ );
			$posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0" );
			$data                = array(
				'url'             => stripslashes( str_replace( array( 'http://', '/', ':' ), '', site_url() ) ),
				'posts'           => $count_posts->publish,
				'pages'           => $count_pages->publish,
				'comments'        => $comments_count->total_comments,
				'approved'        => $comments_count->approved,
				'spam'            => $comments_count->spam,
				'pingbacks'       => $wpdb->get_var( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'" ),
				'post_conversion' => ( $count_posts->publish > 0 && $posts_with_comments > 0 ) ? number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' ) : 0,
				'theme_version'   => $plugin_data['Version'],
				'theme_name'      => $theme_name,
				'site_name'       => str_replace( ' ', '', get_bloginfo( 'name' ) ),
				'plugins'         => count( get_option( 'active_plugins' ) ),
				'plugin'          => urlencode( $plugin_name ),
				'wpversion'       => get_bloginfo( 'version' ),
			);

			foreach ( $data as $k => $v ) {
				$url .= $k . '/' . $v . '/';
			}
			wp_remote_get( $url );
			set_transient( 'presstrends_cache_data', $data, 60 * 60 * 24 );
		}
	}
}
add_action('admin_init', 'cookies_load_presstrends' );