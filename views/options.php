<script type="text/javascript">var __namespace = '<?php echo $namespace; ?>';</script>
<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h2><?php echo $page_title; ?></h2>

    <?php //Load WPML translations if they exist
    if ( function_exists ('icl_get_languages') ) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if( !empty( $languages ) ) { ?>

            <!-- Build navigation tabs -->
            <h2 class="nav-tab-wrapper">  
            <?php foreach($languages as $l) {
                $id = $l['language_code'];
                $translated_name = $l['translated_name']; ?>
                <a href="?page=<?php echo $namespace; ?>&tab=<?php echo $id; ?>" class="nav-tab <?php echo $active_tab == '$id' ? 'nav-tab-active' : ''; ?>"><?php echo $translated_name .' ' .__('Popup', $namespace);?></a>  
            <?php } ?>
            </h2>

        <?php }

        //Get first array value
        reset($languages);
        $first = current($languages);
        $id = $first['language_code'];

        // Set default tab to first array value
        if( isset( $_GET[ 'tab' ] ) ) {  
            $active_tab = $_GET[ 'tab' ];  
        }
        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : $id;

    } ?>    

    <!-- Display update message if options have been updated -->
    <?php if( isset( $_GET['message'] ) ): ?>
        <div id="message" class="updated below-h2"><p><?php _e('Options successfully updated!', $namespace); ?></p></div>
    <?php endif; ?>

    <form action="" method="post" id="<?php echo $namespace; ?>-form">
    <div id="content">
        <?php wp_nonce_field( $namespace . "-update-options" ); ?>

        <?php if ( !function_exists ('icl_get_languages') ) { ?>

            <h3><?php _e('Title', $namespace); ?></h3>
            <p><input type="text" name="data[title]" value="<?php echo ($this->get_option( 'title' )); ?>" /></p>
            
            <h3><?php _e('Message', $namespace); ?></h3>
            <p><textarea columns='22' rows='10' name="data[message]"><?php echo ($this->get_option( 'message' ) ); ?></textarea></p>
        
        <?php } else { 
            foreach ($languages as $l) {
                //Get the language code id
                $id = $l['language_code']; ?>
                
                <div class="input_wrapper <?php if( $active_tab == $id ) { echo 'active'; } ?>">
                    <h3><?php _e('Title', $namespace); ?></h3>
                    <p><input type="text" name="data[title_lang_<?php echo $id; ?>]" value="<?php echo stripslashes($this->get_option( 'title_lang_' .$id )); ?>" /></p>
                    
                    <h3><?php _e('Message', $namespace); ?></h3>
                    <p><textarea columns='22' rows='10' name="data[message_lang_<?php echo $id; ?>]"><?php echo stripslashes($this->get_option( 'message_lang_' .$id ) ); ?></textarea></p>
                </div>

            <?php }

        } ?>

        <h3><?php _e('Position', $namespace); ?></h3>
        <p><input type="radio" name="data[position]" value="top" <?php if($this->get_option( 'position' ) == 'top') echo 'checked'; ?>> <label><?php _e('Top', $namespace); ?></label></p>
        <p><input type="radio" name="data[position]" value="bottom" <?php if($this->get_option( 'position' ) == 'bottom') echo 'checked'; ?>> <label><?php _e('Bottom', $namespace); ?></label></p>
        
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php _e( "Save Changes", $namespace ); ?>" />
        </p>
    </div>

    <div id="sidebar">
        <div class="widget">
            <h2 class="promo"><?php _e('Need support?', $namespace); ?></h2>
            <p><?php _e('If you are having problems with this plugin please talk about them in the', $namespace); ?> <a href="http://wordpress.org/support/plugin/wordpress-cookies"><?php _e('support forum', $namespace); ?></a>.</p>
        </div>
        <div class="widget">
            <h2 class="promo"><?php _e('Presstrends', $namespace); ?></h3>
                <p><?php _e('Help to improve Wordpress Cookies by enabling', $namespace); ?> <a href="http://www.presstrends.io" target="_blank">Presstrends</a>.</p>
            <p><input type="radio" name="data[presstrends]" value="enabled" <?php if($this->get_option( 'presstrends' ) == 'enabled') echo 'checked'; ?>> <label><?php _e('Enable', $namespace); ?></label></p>
            <p><input type="radio" name="data[presstrends]" value="disabled" <?php if($this->get_option( 'presstrends' ) == 'disabled') echo 'checked'; ?>> <label><?php _e('Disable', $namespace); ?></label></p>
            <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php _e( "Save Changes", $namespace ) ?>" />
        </p>
        </div>
    </div>
    </form>
</div>