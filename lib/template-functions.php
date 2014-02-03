<?php
/**
 * Template functions for this plugin
 * 
 * Place all functions that may be usable in theme template files here.
 * 
 * @package WordpressCookies
 * 
 * @author jcpeden
 * @version 1.0.5
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
			<a href="javascript:void(0)" id="closecookie"><span>close cookie popup<span></a>
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