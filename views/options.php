<script type="text/javascript">var __namespace = '<?php echo $namespace; ?>';</script>

    
    <h2 class="header"><?php echo $page_title; ?></h2>

    <!-- Display update message if options have been updated -->
    <?php if( isset( $_GET['message'] ) ): ?>
        <div id="message" class="updated below-h2"><p><?php _e('Options successfully updated!', $namespace); ?></p></div>
    <?php endif; ?>

    <div class="config-wrap">

        <p>Easy WordPress Cookies Popup allows you to quickly and easily create a notification that your site uses cookies. Just enter your message below and choose where you want to display it on your site.</p>
        <p><em>Please <a href="http://localhost/wordpress/wp-admin/johncpeden.com/plugins/easy-wordpress-cookies-popup">upgrade to the premium version</a> for multi-language support or <a href="http://downloads.wordpress.org/plugin/easy-wp-cookie-popup.1.3.0.zip">downgrade to version 1.3.0 of the free plugin.</a></em></p>

        <form action="" method="post" id="<?php echo $namespace; ?>-form">
        <div id="content">
            <?php wp_nonce_field( $namespace . "-update-options" ); ?>
                
                <div class="highlight">
                    <h3><?php _e('Cookie Notification Message', $namespace); ?></h3>
                    <p><textarea rows="5" name="data[message]"><?php echo ($this->get_option( 'message' ) ); ?></textarea></p>
                    <p><em><?php _e('This box accepts HTML', $namespace); ?>.</em></p>
                </div>

            <div class="highlight secondary">
                <h3><?php _e('Notification Message Position', $namespace); ?></h3>
                <p><input type="radio" name="data[position]" value="top" <?php if($this->get_option( 'position' ) == 'top') echo 'checked'; ?>> <label><?php _e('Top', $namespace); ?></label></p>
                <p><input type="radio" name="data[position]" value="bottom" <?php if($this->get_option( 'position' ) == 'bottom') echo 'checked'; ?>> <label><?php _e('Bottom', $namespace); ?></label></p>
            </div>
            
            <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="<?php _e( "Save Changes", $namespace ); ?>" />
            </p>
        </div>
    </div>

    <div id="sidebar">
        <div class="widget">
            <h2 class="promo"><?php _e('Need support?', $namespace); ?></h2>
            <p><?php _e('If you are having problems with this plugin please talk about them in the', $namespace); ?> <a href="http://wordpress.org/support/plugin/wordpress-cookies"><?php _e('support forum', $namespace); ?></a>.</p>
        </div>

        <div class="widget">
            <h2 class="promo"><?php _e('Want more features?', $namespace); ?></h2>
            <ul>
                <li><?php _e('Multi-language support', $namespace); ?></li>
                <li><?php _e('Total control styling', $namespace); ?></li>
                <li><?php _e('Total control over animation', $namespace); ?></li>
            </ul>
            <p><a href="johncpeden.com/plugins/easy-wordpress-cookies-popup"><?php _e('Upgrade for just $24', $namespace); ?></a>.</p>
        </div>
    </div>
    </form>