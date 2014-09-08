<?php
/**
 * Template functions for this plugin
 * 
 * Place all functions that may be usable in theme template files here.
 * 
 * @package WordpressCookies
 * 
 * @author jcpeden
 * @version 1.3.0
 * @since 1.0.0
 */

function cookie_popup() {
	if (!is_admin()) {
		global $WPCookies;

		/* Get position of popup */
		if($WPCookies->get_option( 'position' ) == 'top') {
			$position = 'top';
		} else {
			$position = 'bottom';
		} 

		/* If WPML is inactive, load default popup */
		if ( !function_exists ('icl_get_languages') ) { ?>
			<div id="eu-cookie" class="<?php echo $position; ?>">
				<a href="javascript:void(0)" class="close-icon"><i class="fa fa-times"></i><span>Close cookie popup</span></a>
				<h3><?php echo ($WPCookies->get_option( 'title' )); ?></h3>
				<p><?php echo ($WPCookies->get_option( 'message' )); ?></p>
			</div>
		<?php } else {

			/* If WPML is active, load language specific popup */
			$languages = icl_get_languages('skip_missing=0&orderby=code');
			if( !empty( $languages ) ) {
				foreach ($languages as $l) {
					if($l['active']) {
						$id = $l['language_code']; 

						/* Display popup if enabled for language */
						if ($WPCookies->get_option( 'disable_lang_' .$id ) == 1) { ?>
							<div id="eu-cookie" class="<?php echo $position; ?>">
								<div class="close-icon">
									<a href="javascript:void(0)" class="close-icon">X<span>Close cookie popup</span></a>
								</div>
								<h3><?php echo ($WPCookies->get_option( 'title_lang_' .$id )); ?></h3>
								<p><?php echo ($WPCookies->get_option( 'message_lang_' .$id )); ?></p>
							</div>
						<?php }
					}
				}
	        }
	    } 
	}
}
add_action('wp_footer', 'cookie_popup');