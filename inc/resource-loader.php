<?php

/**
 * RESOURCE LOADER
 *
 * borrowed liberally from @http://plugins.svn.wordpress.org/wp-jquery-cdn/trunk/
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */

function infrastrukt_loader_options_init(){
        register_setting( 'infrastrukt_loader_options', 'infrastrukt_loader' );
    }
    add_action('admin_init', 'infrastrukt_loader_options_init' );

    function infrastrukt_loader_menu(){
        add_menu_page('Resource Loader', 'Resource Loader', 'manage_options', 'infrastrukt-loader.php', 'infrastrukt_loader');
    }
    add_action('admin_menu', 'infrastrukt_loader_menu');

    function infrastrukt_loader(){
        if(!current_user_can('manage_options')){
            wp_die( __('You do not have sufficient permissions to access this page.') );
        } ?>
        <!-- <link rel="stylesheet" href="<?php //echo plugins_url(); ?>/wp-jquery-cdn/options.css" type="text/css" /> -->
        <style>
            .inline {display:inline;}
            .hide {display:none;}
        </style>
        <h1>Infrastrukt Resource Loader</h1>
        <form id="options-form" method="post" action="options.php">
            <fieldset>
                <?php settings_fields('infrastrukt_loader_options'); ?>
                <?php $options = get_option('infrastrukt_loader'); ?>
                <label for="infrastrukt_loader[jquery_cdn]">jQuery:</label>
                <select type="select" name="infrastrukt_loader[jquery_cdn]" id="infrastruktjquerySelect">
                    <option value="infrastrukt" <?php if($options['jquery_cdn'] == "infrastrukt"){ echo "selected"; } ?>>
                        Local (Infrastrukt Theme)
                    </option>
                    <option value="wp" <?php if($options['jquery_cdn'] == "wp"){ echo "selected"; } ?>>
                        Local (Wordpress)
                    </option>
                    <option value="microsoft" <?php if($options['jquery_cdn'] == "microsoft"){ echo "selected"; } ?>>
                        Microsoft jQuery CDN
                    </option>
                    <option value="cdnjs" <?php if($options['jquery_cdn'] == "cdnsj"){ echo "selected"; } ?>>
                        CDNJS
                    </option>
                    <option value="jquery" <?php if($options['jquery_cdn'] == "jquery"){ echo "selected"; } ?>>
                        jQuery CDN
                    </option>
                    <option value="google" <?php if($options['jquery_cdn'] == "google"){ echo "selected"; } ?>>
                        Google AJAX API jQuery CDN
                    </option>
                    <option value="none" <?php if($options['jquery_cdn'] == "none"){ echo "selected"; } ?>>
                        None (not recommended)
                    </option>
                </select>
                
                <?php // HIDE EXTRA OPTIONS FOR SELECTIONS LOCAL WP OR NONE
                if($options['jquery_cdn'] == "none" || $options['jquery_cdn'] == "wp"){
                    $selectedClass = 'hide';
                }
                ?>
                <div id="jqueryOptions" class="inline <?php echo $selectedClass ?>">
                    <?php if($options['jquery_version']){ $jquery_version = $options['jquery_version']; } ?>
                    <label for="infrastrukt_loader[jquery_version]">Version:</label> 
                    <select name="infrastrukt_loader[jquery_version]">
                        <option value="2.0.3"  <?php if($options['jquery_version'] == "2.0.3") { echo "selected"; } ?>>2.0.3</option>
                        <option value="2.0.2"  <?php if($options['jquery_version'] == "2.0.2") { echo "selected"; } ?>>2.0.2</option>
                        <option value="1.10.2" <?php if($options['jquery_version'] == "1.10.2"){ echo "selected"; } ?>>1.10.2</option>
                        <option value="1.10.1" <?php if($options['jquery_version'] == "1.10.1"){ echo "selected"; } ?>>1.10.1</option>
                        <option value="1.9.1"  <?php if($options['jquery_version'] == "1.9.1") { echo "selected"; } ?>>1.9.1</option>
                        <option value="1.8.3"  <?php if($options['jquery_version'] == "1.8.3") { echo "selected"; } ?>>1.8.3</option>
                        <option value="1.7.2"  <?php if($options['jquery_version'] == "1.7.2") { echo "selected"; } ?>>1.7.2</option>
                        <option value="1.6.4"  <?php if($options['jquery_version'] == "1.6.4") { echo "selected"; } ?>>1.6.4</option>
                    </select>
                </div><!--#jqueryOptions-->
            </fieldset>
            <fieldset id="jqueryMigrate" class="<?php echo $selectedClass ?>">
                <?php if($options['jquery_migrate']){ $jquery_migrate = $options['jquery_migrate']; } ?>
                <label for="infrastrukt_loader[jquery_migrate]">jQuery Migrate</label>
                <select type="select" name="infrastrukt_loader[jquery_migrate]">
                    <option value="infrastrukt" <?php if($options['jquery_migrate'] == "infrastrukt"){ echo "selected"; } ?>>
                        Local (Infrastrukt Theme)
                    </option>
                    <option value="microsoft" <?php if($options['jquery_migrate'] == "microsoft"){ echo "selected"; } ?>>
                        Microsoft jQuery CDN
                    </option>
                    <option value="cdnjs" <?php if($options['jquery_migrate'] == "cdnjs"){ echo "selected"; } ?>>
                        CDNJS
                    </option>
                    <option value="jquery" <?php if($options['jquery_migrate'] == "jquery"){ echo "selected"; } ?>>
                        jQuery CDN
                    </option>
                    <option value="none" <?php if($options['jquery_migrate'] == "none"){ echo "selected"; } ?>>
                        None
                    </option>
                </select>
                <?php if($options['jquery_migrate_version']){ $jquery_migrate_version = $options['jquery_migrate_version']; } ?>
                <label for="infrastrukt_loader[jquery_migrate_version]">Version:</label> 
                <select name="infrastrukt_loader[jquery_migrate_version]">
                    <option value="1.2.1"  <?php if($options['jquery_migrate_version'] == "1.2.1") { echo "selected"; } ?>>1.2.1</option>
                    <option value="1.1.1"  <?php if($options['jquery_migrate_version'] == "1.1.1") { echo "selected"; } ?>>1.1.1</option>
                </select>
            </fieldset>
            <fieldset id="jqueryLoadPosition" class="<?php echo $selectedClass ?>">
                <p>Load jQuery in top or bottom of page?</p>
                <?php $jquery_position = $options['jquery_position']; ?>
                <?php if($jquery_position['jquery_position']){ $jquery_position = $options['jquery_position']; } ?>
                <input type="radio" name="infrastrukt_loader[jquery_position]" value="top" <?php if($options['jquery_position'] == "top") { echo "checked"; } ?>>Top (WordPress default)
                <input type="radio" name="infrastrukt_loader[jquery_position]" value="bottom" <?php if($options['jquery_position'] == "bottom") { echo "checked"; } ?>>Bottom
            </fieldset>
            <fieldset id="modernizrOptions">
                <?php if($options['modernizr']){ $modernizr = $options['modernizr']; } ?>
                <label for="infrastrukt_loader[modernizr]">Modernizr:</label>
                <select type="select" name="infrastrukt_loader[modernizr]">
                    <option value="infrastrukt" <?php if($options['modernizr'] == "infrastrukt"){ echo "selected"; } ?>>
                        Local (Infrastrukt Theme)
                    </option>
                    <option value="cdnjs" <?php if($options['modernizr'] == "cdnjs"){ echo "selected"; } ?>>
                        CDNJS
                    </option>
                    <option value="none" <?php if($options['modernizr'] == "none"){ echo "selected"; } ?>>
                        None
                    </option>
                </select>
                <?php if($options['modernizr_version']){ $modernizr_version = $options['modernizr_version']; } ?>
                <label for="infrastrukt_loader[modernizr_version]">Version:</label> 
                <select name="infrastrukt_loader[modernizr_version]">
                    <option value="2.7.1"  <?php if($options['modernizr_version'] == "2.7.1") { echo "selected"; } ?>>2.7.1</option>
                    <option value="2.7.0"  <?php if($options['modernizr_version'] == "2.7.0") { echo "selected"; } ?>>2.7.0</option>
                    <option value="2.6.2"  <?php if($options['modernizr_version'] == "2.6.2") { echo "selected"; } ?>>2.6.2</option>
                </select>
            </fieldset>
            <fieldset>
                <p class="submit">
                    <button type="submit" class="button-primary"><?php _e('Save Changes') ?></button>
                </p>
            </fieldset>
        </form>
<script>
jQuery(function($){
    $('#infrastruktjquerySelect').on('change', function(){
        $t = $(this);
        if ($( "#infrastruktjquerySelect option:selected" ).val() == "wp" || $( "#infrastruktjquerySelect option:selected" ).val() == "none") {
            console.log('Hide additional jQuery options…');
            $('#jqueryOptions,#jqueryMigrate,#jqueryLoadPosition').addClass('hide');
        } else {
            console.log('Show additional jQuery options…');
            $('#jqueryOptions,#jqueryMigrate,#jqueryLoadPosition').removeClass('hide');
        }
        //console.log('something new selected…');
    });
});
</script>

<?php

    } // end function infrastrukt_loader()

    $options = get_option('infrastrukt_loader');
    $jquery_position = $options['jquery_position'];
    $jquery_version = $options['jquery_version'];
    $jquery_migrate = $options['jquery_migrate'];
    $jquery_migrate_version = $options['jquery_migrate_version'];
    $modernizr = $options['modernizr'];
    $modernizr_version = $options['modernizr_version'];

    // JQUERY LOAD POSITION
    if($options['jquery_position'] == 'bottom'){
        $jquery_in_footer = true;
        $jquery_dependency = null;
    } else if($options['jquery_position'] == 'top') {
        $jquery_in_footer = false;
        $jquery_dependency = array('modernizr');
    }
    
    // JQUERY CDN OPTIONS
    if($options['jquery_cdn'] == "0" || !$options['jquery_cdn']){ 
        $options['jquery_cdn'] = "wp";
    }

    if($options['jquery_migrate'] == "0" || !$options['jquery_migrate']){ 
        $options['jquery_migrate'] = "none";
    }

    if($options['modernizr'] == "0" || !$options['modernizr']){ 
        $options['modernizr'] = "infrastrukt";
    }
    // MODERNIZR
    if($options['modernizr'] != "none"){
        if($options['modernizr'] == "infrastrukt"){
            $modernizr = get_template_directory_uri() . '/lib/modernizr/' . $modernizr_version . '/modernizr.min.js';
        }
        if($options['modernizr'] == "cdnjs"){
            $modernizr = '//cdnjs.cloudflare.com/ajax/libs/modernizr/' . $modernizr_version . '/modernizr.min.js';
        }

        function infrastrukt_modernizr_init(){
            if (!is_admin()){
                global $modernizr;
                global $modernizr_version;
                wp_enqueue_script('modernizr',$modernizr, null, $modernizr_version, false);
            }
        }
        add_action('init', 'infrastrukt_modernizr_init');
    }
    
    if($options['jquery_cdn'] != "wp"){
        if($options['jquery_cdn'] == "google"){
            $jquery = '//ajax.googleapis.com/ajax/libs/jquery/' . $jquery_version . '/jquery.min.js';
        }

        if($options['jquery_cdn'] == "jquery"){
            $jquery = '//code.jquery.com/jquery-' . $jquery_version . '.min.js';
        }

        if($options['jquery_cdn'] == "microsoft"){
            $jquery = '//ajax.aspnetcdn.com/ajax/jquery/jquery-' . $jquery_version . '.min.js';
        }

        if($options['jquery_cdn'] == "cdnjs"){
            $jquery = '//cdnjs.cloudflare.com/ajax/libs/jquery/' . $jquery_version . '/jquery.min.js';
        }

        if($options['jquery_cdn'] == "infrastrukt"){
            $jquery = get_template_directory_uri() . '/lib/jquery/jquery-' . $jquery_version . '.min.js';
        }
        // JQUERY MIGRATE
        if($options['jquery_migrate'] == "jquery"){
            $jqueryMigrate = '//code.jquery.com/jquery-migrate-' . $jquery_migrate_version . '.min.js';
        }
        if($options['jquery_migrate'] == "microsoft"){
            $jqueryMigrate = '//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-' . $jquery_migrate_version . '.min.js';
        }
        if($options['jquery_migrate'] == "cdnjs"){
            $jqueryMigrate = '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/' . $jquery_migrate_version . '/jquery-migrate.min.js';
        }
        if($options['jquery_migrate'] == "infrastrukt"){
            $jqueryMigrate = get_template_directory_uri() . '/lib/jquery/jquery-migrate-' . $jquery_migrate_version . '.min.js';
        }

        if($options['jquery_cdn'] != "none"){
            function infrastrukt_loader_init(){
                if (!is_admin()){
                    global $jquery;
                    global $jquery_version;
                    global $jquery_migrate_version;
                    global $jqueryMigrate;
                    global $jquery_dependency;
                    global $jquery_in_footer;
                    wp_deregister_script('jquery');
                    wp_enqueue_script('jquery',$jquery, $jquery_dependency, $jquery_version, $jquery_in_footer);
                    //wp_enqueue_script( 'jquery' );
                    if($options['jquery_migrate'] != "none"){
                    wp_enqueue_script( 'jquery-migrate-cdn', $jqueryMigrate, array('jquery'), $jquery_migrate_version,$jquery_in_footer );
                    }
                }
            }
            add_action('init', 'infrastrukt_loader_init');
        }
        
        if($options['jquery_cdn'] == "none"){
            function infrastrukt_loader_init(){
                if (!is_admin()){
                    wp_deregister_script('jquery');
                }
            }
            add_action('init', 'infrastrukt_loader_init');
        }
    }  
?>