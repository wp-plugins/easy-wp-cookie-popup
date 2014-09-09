<?php
/**
 * Template functions for this plugin
 * 
 * Place all functions that may be usable in theme template files here.
 * 
 * @package WordpressCookies
 * 
 * @author jcpeden
 * @version 1.4.0
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
		} ?>

		<div id="eu-cookie" class="<?php echo $position; ?>">
			<div class="popup-wrapper">
				<a href="javascript:void(0)" class="close-icon"><i class="fa fa-times"></i><span>Close cookie popup</span></a>
				<p><?php echo ($WPCookies->get_option( 'message' )); ?></p>
			</div>
		</div>

	<?php }
}
add_action('wp_footer', 'cookie_popup');