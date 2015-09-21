<div class="postbox" style="display: block;">
	<div class="inside">
		<div class="highlight">
		    <h3><?php _e('Cookie Notification Message', $namespace); ?></h3>
		    <p><textarea rows="5" name="data[message]"><?php echo ($this->get_option( 'message' ) ); ?></textarea></p>
		    <p><em><?php _e('This box accepts HTML', $namespace); ?>.</em></p>
		</div>
	</div>
</div>