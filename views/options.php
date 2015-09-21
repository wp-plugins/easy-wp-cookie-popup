<script type="text/javascript">var __namespace = '<?php echo $namespace; ?>';</script>

    
    <h2 class="header"><?php echo $page_title; ?></h2>

    <!-- Display update message if options have been updated -->
    <?php if( isset( $_GET['message'] ) ): ?>
        <div id="message" class="updated below-h2"><p><?php _e('Options successfully updated!', $namespace); ?></p></div>
    <?php endif; ?>

    <div class="config-wrap">

        <p><?php _e('Enter your message below and choose where you want to display it on your site.', $namespace); ?></p>

          <?php //Load WPML translations if they exist
    if ( function_exists ('icl_get_languages') ) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if( !empty( $languages ) ) {
            
            //Get first array value
            $first = current($languages);
            $id = $first['language_code'];

            // Set default tab to first array value
            if( isset( $_GET[ 'tab' ] ) ) {  
                $active_tab = $_GET[ 'tab' ];  
            }
            $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : $id; ?>

            <!-- Build navigation tabs -->
            <h2 class="nav-tab-wrapper">  
            <?php foreach($languages as $l) {
                $id = $l['language_code'];
                $translated_name = $l['translated_name']; ?>
                <a href="?page=<?php echo $namespace; ?>&tab=<?php echo $id; ?>" class="nav-tab <?php echo $active_tab == $id ? 'nav-tab-active' : ''; ?>"><?php echo $translated_name .' ' .__('Popup', $namespace);?></a>  
            <?php } ?>
            </h2>

        <?php }
    } ?>  

        <form action="" method="post" id="<?php echo $namespace; ?>-form">
        <div id="content">
            <?php wp_nonce_field( $namespace . "-update-options" ); ?>
                
             <?php if ( !function_exists ('icl_get_languages') ) { ?>
            
            <div class="highlight">
                <h3><?php _e('Cookie Notification Message', $namespace); ?></h3>
                <p><textarea rows="5" name="data[message]"><?php echo ($this->get_option( 'message' ) ); ?></textarea></p>
                <p><em><?php _e('This box accepts HTML', $namespace); ?>.</em></p>
            </div>
        
        <?php } else { 
            foreach ($languages as $l) {
                //Get the language code id
                $id = $l['language_code']; ?>
                
                <div class="input_wrapper <?php if( $active_tab == $id ) { echo 'active'; } ?>">

                    <h3><?php _e('Enable/Disable', $namespace); ?></h3>     
                    <p><input type="radio" name="data[disable_lang_<?php echo $id; ?>]" value="1" <?php if( $this->get_option( 'disable_lang_' .$id ) == '1') echo 'checked'; ?>> <label><?php esc_html_e('Enable in this language', $namespace); ?></label></p>
                    <p><input type="radio" name="data[disable_lang_<?php echo $id; ?>]" value="0" <?php if( $this->get_option( 'disable_lang_' .$id ) == '0') echo 'checked'; ?>> <label><?php esc_html_e('Disable in this language', $namespace); ?></label></p>               

                    <h3><?php _e('Title', $namespace); ?></h3>
                    <p><input type="text" name="data[title_lang_<?php echo $id; ?>]" value="<?php echo stripslashes($this->get_option( 'title_lang_' .$id )); ?>" /></p>
                    
                    <h3><?php _e('Message', $namespace); ?></h3>
                    <p><em><?php _e('This box accepts HTML', $namespace); ?>.</em></p>
                    <p><textarea columns='22' rows='10' name="data[message_lang_<?php echo $id; ?>]"><?php echo stripslashes($this->get_option( 'message_lang_' .$id ) ); ?></textarea></p>
                </div>

            <?php }

        } ?>

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
            <h2 class="promo"><?php _e('Ready to Upgrade?', $namespace); ?></h2>
            <ul>
	            <li><?php _e('Premium 24/7 Support', $namespace); ?></li>
	            <li><?php _e('Translate your cookie notification message using WPML', $namespace); ?></li>
	            <li><?php _e('Customise the styles, timing and positioning of your cookie popup', $namespace); ?></li>
	            <li><?php _e('100% money-back refund if you aren\'t happy', $namespace); ?></li>
	            <li><?php _e('Upgrade instantly for just $3/month', $namespace); ?></li>
            </ul>
            <p><a class="button-primary" href="http://wpcookiespopup.com"><?php _e('Upgrade Now', $namespace); ?></a></p>
        </div>
        <div class="widget">
            <h2 class="promo"><?php _e('Need Help?', $namespace); ?></h2>
            <p><?php _e('Please raise any issues with this plugin in the', $namespace); ?> <a href="https://wordpress.org/support/plugin/easy-wp-cookie-popup"><?php _e('support forum', $namespace); ?></a>.</p>
        </div>
    </div>
    </form>