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
                    <option value="1" <?php if($options['jquery_cdn'] == "1"){ echo "selected"; } ?>>
                        Google AJAX API jQuery CDN
                    </option>
                    <option value="2" <?php if($options['jquery_cdn'] == "2"){ echo "selected"; } ?>>
                        jQuery CDN
                    </option>
                    <option value="3" <?php if($options['jquery_cdn'] == "3"){ echo "selected"; } ?>>
                        Microsoft jQuery CDN
                    </option>
                    <option value="4" <?php if($options['jquery_cdn'] == "4"){ echo "selected"; } ?>>
                        CDNJS
                    </option>
                    <option value="5" <?php if($options['jquery_cdn'] == "5"){ echo "selected"; } ?>>
                        Local jQuery (Infrastrukt Theme)
                    </option>
                    <option value="6" <?php if($options['jquery_cdn'] == "6"){ echo "selected"; } ?>>
                        Local jQuery (Wordpress)
                    </option>
                    <option value="7" <?php if($options['jquery_cdn'] == "7"){ echo "selected"; } ?>>
                        None (not recommended)
                    </option>
                </select>
                
                <?php // HIDE EXTRA OPTIONS FOR SELECTIONS 6 & 7 ABOVE
                if($options['jquery_cdn'] == "6" || $options['jquery_cdn'] == "7"){
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
                    <option value="1" <?php if($options['jquery_migrate'] == "1"){ echo "selected"; } ?>>
                        jQuery CDN
                    </option>
                    <option value="2" <?php if($options['jquery_migrate'] == "2"){ echo "selected"; } ?>>
                        Microsoft jQuery CDN
                    </option>
                    <option value="3" <?php if($options['jquery_migrate'] == "3"){ echo "selected"; } ?>>
                        CDNJS
                    </option>
                    <option value="4" <?php if($options['jquery_migrate'] == "4"){ echo "selected"; } ?>>
                        Local (Infrastrukt Theme)
                    </option>
                    <option value="5" <?php if($options['jquery_migrate'] == "5"){ echo "selected"; } ?>>
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
        if ($( "#infrastruktjquerySelect option:selected" ).val() == "6" || $( "#infrastruktjquerySelect option:selected" ).val() == "7") {
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
        $options['jquery_cdn'] = "1";
    }

    if($options['jquery_migrate'] == "0" || !$options['jquery_migrate']){ 
        $options['jquery_migrate'] = "1";
    }
    
    if($options['jquery_cdn'] != "6"){
        if($options['jquery_cdn'] == "1"){
            $jquery = '//ajax.googleapis.com/ajax/libs/jquery/' . $jquery_version . '/jquery.min.js';
        }

        if($options['jquery_cdn'] == "2"){
            $jquery = '//code.jquery.com/jquery-' . $jquery_version . '.min.js';
        }

        if($options['jquery_cdn'] == "3"){
            $jquery = '//ajax.aspnetcdn.com/ajax/jquery/jquery-' . $jquery_version . '.min.js';
        }

        if($options['jquery_cdn'] == "4"){
            $jquery = '//cdnjs.cloudflare.com/ajax/libs/jquery/' . $jquery_version . '/jquery.min.js';
        }

        if($options['jquery_cdn'] == "5"){
            $jquery = get_template_directory_uri() . '/lib/jquery/jquery-' . $jquery_version . '.min.js';
        }
        // JQUERY MIGRATE
        if($options['jquery_migrate'] == "1"){
            $jqueryMigrate = '//code.jquery.com/jquery-migrate-' . $jquery_migrate_version . '.min.js';
        }
        if($options['jquery_migrate'] == "2"){
            $jqueryMigrate = '//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-' . $jquery_migrate_version . '.min.js';
        }
        if($options['jquery_migrate'] == "3"){
            $jqueryMigrate = '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/' . $jquery_migrate_version . '/jquery-migrate.min.js';
        }
        if($options['jquery_migrate'] == "4"){
            $jqueryMigrate = get_template_directory_uri() . '/lib/jquery/jquery-migrate-' . $jquery_migrate_version . '.min.js';
        }

        if($options['jquery_cdn'] == "1" || $options['jquery_cdn'] == "2"
           || $options['jquery_cdn'] == "3" || $options['jquery_cdn'] == "4" || $options['jquery_cdn'] == "5"){
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
                    
                    wp_enqueue_script( 'jquery-migrate-cdn', $jqueryMigrate, array('jquery'), $jquery_migrate_version,$jquery_in_footer );
                }
            }
            add_action('init', 'infrastrukt_loader_init');
        }
        
        if($options['jquery_cdn'] == "7"){
            function infrastrukt_loader_init(){
                if (!is_admin()){
                    wp_deregister_script('jquery');
                }
            }
            add_action('init', 'infrastrukt_loader_init');
        }
    }  
?>