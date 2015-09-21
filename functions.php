<?php
/**
 * Functions
 *
 * Core functionality and initial theme setup
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */

/**
 * WordPress Globals
 */
global $wp_version;

/**
 * Modify output of change custom background callback (see theme.php)
 * via @https://code.tutsplus.com/articles/modifying-custom-background-feature-for-any-html-element-you-want--wp-25901
 */
if ( ! function_exists( 'infrastrukt_custom_background' ) ) :

  function infrastrukt_custom_background() {
    $background = get_background_image();
    $color      = get_background_color();

    if ( ! $background && ! $color )
      return;

    $style = $color ? "background-color: #$color;" : '';

    if ( $background ) {
      $image = " background-image: url('$background');";

      $repeat = get_theme_mod( 'background_repeat', 'repeat' );
      if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
        $repeat = 'repeat';
        $repeat = " background-repeat: $repeat;";

      $position = get_theme_mod( 'background_position_x', 'left' );
      if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
        $position = 'left';
        $position = " background-position: top $position;";

      $attachment = get_theme_mod( 'background_attachment', 'scroll' );
      if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
        $attachment = 'scroll';
        $attachment = " background-attachment: $attachment;";

      $size = get_theme_mod( 'background_size', 'auto' );
      if ( ! in_array( $size, array( 'auto', 'cover', 'contain' ) ) )
        $size = 'auto';
        $size = " -webkit-background-size: $size; -moz-background-size: $size; -o-background-size: $size; background-size: $size;";

      $style .= $image . $repeat . $position . $attachment . $size;
    }?>
    <style type="text/css" id="custom-background-css">
    .custom-background { <?php echo trim( $style ); ?> }
    </style>
    <?php
  }

endif;

/**
 * Initialize Infrastrukt for WordPress
 */
if ( ! function_exists( 'infrastrukt_setup' ) ) :

  function infrastrukt_setup() {

    // Content Width
    /*
    Sizes:
      40em  up to 640px   small
      64em  up to 1024px  medium
      90em  up to 1440px  large
      120em up to 1920px  x-large
      120.063em+  1921px+ xx-large
    */
    if ( ! isset( $content_width ) ) $content_width = 970;

    // Language Translations
    load_theme_textdomain( 'infrastrukt', get_template_directory() . '/languages' );

    // Custom Editor Style Support
    add_editor_style();

    // Wordpress handles title tag
    add_theme_support( 'title-tag' );

    // Support for Featured Images
    add_theme_support( 'post-thumbnails' );

    // Additional image sizes
/*    add_image_size( 'background-small', 400, 300, true );
    add_image_size( 'background-medium', 600, 450, true );
    add_image_size( 'background-large', 800, 533, true );
    add_image_size( 'background-larger', 1000, 750, true );
    add_image_size( 'background-largest', 1200, 900, true );*/

    // Automatic Feed Links
    add_theme_support( 'automatic-feed-links' );

    // Add additional custom post types
    function infrastrukt_custom_posts() {
      $args = array(
        'label' => 'Standard, Left Sidebar',
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => false,
        'query_var' => true,
        'menu_icon' => 'dashicons-align-left',
        'supports' => array(
          'title',
          'editor',
          'excerpt',
          'trackbacks',
          'custom-fields',
          'comments',
          'revisions',
          'thumbnail',
          'author',
          'page-attributes',)
          );
      register_post_type( 'left-sidebar', $args );
    }

    //add_action( 'init', 'infrastrukt_custom_posts' );



    // Post Formats
    add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat' ) );

    // Custom Background
    add_theme_support( 'custom-background', array(
      'wp-head-callback'    => 'infrastrukt_custom_background',
      'default-color'       => 'fff' ) );

    // Custom Header
    add_theme_support( 'custom-header', array(
      'default-text-color'  => '#000',
      'header-text'         => true,
      'height'              => '200',
      'uploads'             => true,
    ) );

  }

  add_action( 'after_setup_theme', 'infrastrukt_setup' );

endif;

/**
 * Enqueue Scripts and Styles for Front-End
 */

if ( ! function_exists( 'infrastrukt_js' ) ) :

  function infrastrukt_js() {

    if (!is_admin()) {
      /**
       * LOAD JS
       */
      wp_enqueue_script( 'infrastrukt-js', get_template_directory_uri().'/js/app.js', array('jquery'), '1.0', true);
      if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    }
  }

  add_action( 'wp_enqueue_scripts', 'infrastrukt_js' );

endif;

if ( ! function_exists( 'infrastrukt_css' ) ) :

  function infrastrukt_css() {

    if (!is_admin()) {

      if (get_theme_mod( 'infrastrukt_menu_type' ) == "sparkletown"):
        $infrastrukt_dependency =  array( 'dashicons' );
      else:
        $infrastrukt_dependency =  array();
      endif;

      // Load infrastrukt CSS
      wp_enqueue_style( 'infrastrukt', get_template_directory_uri().'/style.css', $infrastrukt_dependency, '1.0', 'all' );

      // Load Google Fonts API
      wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700', array('infrastrukt'), '1.0', 'all' );
    }
  }

  add_action( 'wp_enqueue_scripts', 'infrastrukt_css' );

endif;

/**
 * Register Navigation Menus
 */

if ( ! function_exists( 'infrastrukt_menus' ) ) :

  // Register wp_nav_menus
  function infrastrukt_menus() {

    register_nav_menus(
      array(
        'menu-one'      => __( 'Menu One', 'infrastrukt' ),
        'menu-two'      => __( 'Menu Two', 'infrastrukt' ),
        'social'        => __( 'Social Menu', 'infrastrukt' )
      )
    );

  }

  add_action( 'init', 'infrastrukt_menus' );

endif;

if ( ! function_exists( 'infrastrukt_page_menu' ) ) :

  function infrastrukt_page_menu() {

    $args = array(
    'sort_column' => 'menu_order, post_title',
    'menu_class'  => 'large-12 columns',
    'include'     => '',
    'exclude'     => '',
    'echo'        => true,
    'show_home'   => false,
    'link_before' => '',
    'link_after'  => ''
    );

    wp_page_menu($args);

  }

endif;

/**
 * Sparkletown Navigation Menu (incomplete)
 */

if ( ! function_exists( 'sparkletown_menu' ) ) :

  function sparkletown_menu() {

    $cleanermenu = wp_nav_menu( array(
      'theme_location'  => 'menu-one',  // we've registered a theme location in functions.php
      'container'       => false,       // this is usually a div outside the menu ul, we don't need it
      'items_wrap'      => '<nav id="%1$s" class="%2$s">%3$s</nav>', // replacing the ul with nav
      'echo'            => false, // don't display it just yet, instead we're storing it in the variable $cleanermenu
    ) );

    // Find the closing bracket of each li and the opening of the link, then all instances of "li"
    $find = array('><a','li');
    // Replace the former with nothing (a.k.a. delete) and the latter with "a"
    $replace = array('','a');
    echo str_replace( $find, $replace, $cleanermenu );

  }

endif;

/**
 * Off Canvas Navigation Menus
 */

if ( ! function_exists( 'offcanvas_menu' ) ) :

  function offcanvas_menu($themelocation,$menutext,$containerclass) {

    $ocmenu = wp_nav_menu( array(
      'theme_location'  => $themelocation,
      'menu_class'      => 'off-canvas-list',
      'container'       => 'nav',
      'container_class' => $containerclass,
      'fallback_cb'     => 'wp_page_menu',
      'items_wrap'      => '<ul id="%1$s" class="%2$s"><li><label>%a</label></li>%3$s</ul>',
      'echo'            => false,
      'walker'          => new infrastrukt_navigation()
    ) );

    $find     = '<label></label>';
    $replace  = '<label>'. $menutext . '</label>';
    echo str_replace( $find, $replace, $ocmenu );

  }

endif;

/**
 * Navigation Menu Adjustments
 */

// Add class to navigation sub-menu
Class infrastrukt_navigation extends Walker_Nav_Menu {

  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown\">\n";
  }

  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    $id_field = $this->db_fields['id'];
    if ( !empty( $children_elements[ $element->$id_field ] ) ) {
      $element->classes[] = 'has-dropdown';
    }
    Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }

}

/**
 * Create pagination
 */

if ( ! function_exists( 'infrastrukt_pagination' ) ) :

  function infrastrukt_pagination() {

    global $wp_query;
    $big = 999999999;

    $links = paginate_links( array(
      'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format'    => '?paged=%#%',
      'prev_next' => true,
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
      'current'   => max( 1, get_query_var('paged') ),
      'total'     => $wp_query->max_num_pages,
      'type'      => 'list'
    ));

    $pagination = str_replace('page-numbers','pagination',$links);
    echo $pagination;

  }

endif;

/**
 * Register Sidebars
 */

if ( ! function_exists( 'infrastrukt_widgets' ) ) :

  function infrastrukt_widgets() {

    // Sidebar Left
    register_sidebar( array(
        'id'            => 'infrastrukt_sidebar_left',
        'name'          => __( 'Sidebar Left', 'infrastrukt' ),
        'description'   => __( 'This sidebar is located on the left side.', 'infrastrukt' ),
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
      ) );

    // Sidebar Right
    register_sidebar( array(
        'id'            => 'infrastrukt_sidebar_right',
        'name'          => __( 'Sidebar Right', 'infrastrukt' ),
        'description'   => __( 'This sidebar is located on the right side.', 'infrastrukt' ),
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
      ) );

    // Sidebar Footer Column One
    register_sidebar( array(
        'id'            => 'infrastrukt_sidebar_footer_one',
        'name'          => __( 'Sidebar Footer One', 'infrastrukt' ),
        'description'   => __( 'This sidebar is located in column one of your theme footer.', 'infrastrukt' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
      ) );

    // Sidebar Footer Column Two
    register_sidebar( array(
        'id'            => 'infrastrukt_sidebar_footer_two',
        'name'          => __( 'Sidebar Footer Two', 'infrastrukt' ),
        'description'   => __( 'This sidebar is located in column two of your theme footer.', 'infrastrukt' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
      ) );

    // Sidebar Footer Column Three
    register_sidebar( array(
        'id'            => 'infrastrukt_sidebar_footer_three',
        'name'          => __( 'Sidebar Footer Three', 'infrastrukt' ),
        'description'   => __( 'This sidebar is located in column three of your theme footer.', 'infrastrukt' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
      ) );

    // Sidebar Footer Column Four
    register_sidebar( array(
        'id'            => 'infrastrukt_sidebar_footer_four',
        'name'          => __( 'Sidebar Footer Four', 'infrastrukt' ),
        'description'   => __( 'This sidebar is located in column four of your theme footer.', 'infrastrukt' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
      ) );

  }

  add_action( 'widgets_init', 'infrastrukt_widgets' );

endif;

/**
 * Custom Avatar Classes
 */

if ( ! function_exists( 'infrastrukt_avatar_css' ) ) :

  function infrastrukt_avatar_css($class) {
    $class = str_replace("class='avatar", "class='author_gravatar left ", $class) ;
    return $class;
  }

  add_filter('get_avatar','infrastrukt_avatar_css');

endif;

/**
 * Custom Post Excerpt
 * shamelessly borrowed from wp-includes/formatting.php.
 */

if ( ! function_exists( 'infrastrukt_excerpt' ) ) :

  function infrastrukt_excerpt($text) {
    $raw_excerpt = $text;
    if ( '' == $text ) {
      $text           = get_the_content('');
      $text           = strip_shortcodes( $text );
      $text           = apply_filters( 'the_content', $text );
      $text           = str_replace(']]>', ']]&gt;', $text);
      $excerpt_length = apply_filters( 'excerpt_length', 66 );
      $excerpt_more   = apply_filters( 'excerpt_more', ' ' . '[&hellip;]<nav class="excerpt text-center"><a href="'.get_permalink($post->ID) .'" class="button small">' . __('Read more', 'infrastrukt') . '</a></nav>' );
      $text           = wp_trim_words( $text, $excerpt_length, $excerpt_more );
    }
    return apply_filters( 'infrastrukt_excerpt', $text, $raw_excerpt );
  }

  remove_filter('get_the_excerpt', 'wp_trim_excerpt');
  add_filter('get_the_excerpt', 'infrastrukt_excerpt');

endif;

/**
 * Comments Template
 */

if ( ! function_exists( 'infrastrukt_comment' ) ) :

  function infrastrukt_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case 'pingback' :
      case 'trackback' :
      // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
      <p><?php _e( 'Pingback:', 'infrastrukt' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'infrastrukt' ), '<span>', '</span>' ); ?></p>
    <?php
      break;
      default :
      global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <header>
          <?php
            echo "<span class='th alignleft'>";
            echo get_avatar( $comment, 44 );
            echo "</span>";
            printf( '%2$s %1$s',
              get_comment_author_link(),
              ( $comment->user_id === $post->post_author ) ? '<span class="label">' . __( 'Post Author', 'infrastrukt' ) . '</span>' : ''
            );
            printf( '<br><a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
              esc_url( get_comment_link( $comment->comment_ID ) ),
              get_comment_time( 'c' ),
              sprintf( __( '%1$s at %2$s', 'infrastrukt' ), get_comment_date(), get_comment_time() )
            );
          ?>
        </header>

        <?php if ( '0' == $comment->comment_approved ) : ?>
          <p><?php _e( 'Your comment is awaiting moderation.', 'infrastrukt' ); ?></p>
        <?php endif; ?>

        <section>
          <?php comment_text(); ?>
        </section><!-- .comment-content -->

        <div class="reply">
          <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'infrastrukt' ), 'after' => ' &darr; <br><br>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

        </div>
      </article>
    <?php
    break;
    endswitch;
  }
endif;

/**
 * Remove Class from Sticky Post
 */

if ( ! function_exists( 'infrastrukt_remove_sticky' ) ) :

  function infrastrukt_remove_sticky($classes) {
    $classes = array_diff($classes, array("sticky"));
    return $classes;
  }

  add_filter('post_class','infrastrukt_remove_sticky');

endif;

/**
 * Retrieve Shortcodes
 * @http://fwp.drewsymo.com/shortcodes/
 */
get_template_part( 'shortcodes' );

/**
 * ADD ROOTS HEAD CLEANUP
 * @http://benword.com/how-to-hide-that-youre-using-wordpress/
 */

if ( ! function_exists( 'roots_head_cleanup' ) ) :

  function roots_head_cleanup() {
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

    add_filter('use_default_gallery_style', '__return_null');
  }

  add_action('init', 'roots_head_cleanup');
endif;

if ( ! function_exists( 'infrastrukt_customize' ) ) :

  function infrastrukt_customize($wp_customize) {

  // BEGIN INFRASTRUKT MENU TYPE
  $wp_customize->add_section( 'infrastrukt_menus', array(
    'title'          => __( 'Menu Type', 'infrastrukt' ),
    'priority'       => 34,
  ) );

  $wp_customize->add_setting( 'infrastrukt_menu_type', array(
    'default'        => 'default',
    'type'           => 'theme_mod',
    'capability'     => 'edit_theme_options',
      //'transport'      => 'postMessage',
  ) );

  $wp_customize->add_control( 'infrastrukt_menu_type', array(
    'label'           => __( 'Menu Type', 'infrastrukt' ),
    'section'         => 'infrastrukt_menus',
    'settings'        => 'infrastrukt_menu_type',
    'type'            => 'radio',
    'choices'         => array(
             'topbar' => 'Top Bar',
          'offcanvas' => 'Off-Canvas',
        'sparkletown' => 'Sparkletown',
        ),
  ) );

    $wp_customize->add_section( 'infrastrukt_topbar_settings', array(
      'title'           => __( 'Top Bar Settings', 'infrastrukt' ),
      'priority'        => 35,
    ) );

    $wp_customize->add_setting( 'topbar_position', array(
      'default'         => 'default',
      'type'            => 'theme_mod',
      'capability'      => 'edit_theme_options',
      'sanitize_callback' => '',
    ) );

    $wp_customize->add_control( 'topbar_position', array(
        'label'         => __( 'Top Bar Position', 'infrastrukt' ),
        'section'       => 'infrastrukt_topbar_settings',
        'settings'      => 'topbar_position',
        'type'          => 'radio',
        'choices'       => array(
              ''        => 'Default',
              'sticky'  => 'Sticky',
              'fixed'   => 'Fixed',
              ),
    ) );

    $wp_customize->add_setting( 'contain_to_grid', array(
      'default'           => '',
      'type'              => 'theme_mod',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => '',
    ) );

    $wp_customize->add_control( 'contain_to_grid', array(
      'label'           => 'Contain To Grid',
      'section'         => 'infrastrukt_topbar_settings',
      'type'            => 'checkbox',
      'value'           => 'contain_to_grid',
    ) );

    $wp_customize->add_setting( 'clickable_menu', array(
      'default'           => '',
      'type'              => 'theme_mod',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => '',
    ) );

    $wp_customize->add_control( 'clickable_menu', array(
      'label'           => 'Clickable Top Bar',
      'section'         => 'infrastrukt_topbar_settings',
      'type'            => 'checkbox',
    ) );

    $wp_customize->add_setting( 'set_menu_title', array(
      'default'           => 'Menu',
      'type'              => 'theme_mod',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => '',
    ) );

    $wp_customize->add_control( 'set_menu_title', array(
      'label'           => 'Set Menu Title',
      'section'         => 'infrastrukt_topbar_settings',
      'type'            => 'text',
    ) );

    $wp_customize->add_setting( 'background_size', array(
      'default'           => 'auto',
      'type'              => 'theme_mod',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => '',
    ) );

    $wp_customize->add_control( 'background_size', array(
      'label'           => 'Background Size',
      'section'         => 'background_image',
      'type'            => 'radio',
      'choices'         => array(
              'auto'    => 'Auto',
              'cover'   => 'Cover',
              'contain' => 'Contain',
              ),
    ) );

  // BEGIN OFFCANVAS
  $wp_customize->add_section( 'infrastrukt_offcanvas_settings', array(
    'title'          => __( 'Off-Canvas Settings', 'infrastrukt' ),
    'priority'       => 37,
  ) );

  $wp_customize->add_setting( 'offcanvas_position', array(
    'default'        => 'default',
    'type'           => 'theme_mod',
    'capability'     => 'edit_theme_options',
  ) );

  $wp_customize->add_control( 'offcanvas_position', array(
      'label'       => __( 'Off-Canvas Menu Position', 'infrastrukt' ),
      'section'     => 'infrastrukt_offcanvas_settings',
      'settings'    => 'offcanvas_position',
      'type'        => 'radio',
      'choices'     => array(
          'left'    => 'Left',
          'right'   => 'Right',
          'both'    => 'Both',
          ),
  ) );

  $wp_customize->add_setting( 'infrastrukt_offcanvas_2', array(
    'default'        => '',
    'type'           => 'theme_mod',
    'capability'     => 'edit_theme_options',
  ) );

  $wp_customize->add_control( 'infrastrukt_offcanvas_2', array(
    'label'   => '',
    'section' => 'infrastrukt_offcanvas_settings',
    'type'    => 'checkbox',
    'value'   => 'contain_to_grid',
  ) );

  $wp_customize->add_setting( 'infrastrukt_offcanvas_menu_left_label', array(
    'default'        => 'Left Menu',
    'type'           => 'theme_mod',
    'capability'     => 'edit_theme_options',
  ) );

  $wp_customize->add_control( 'infrastrukt_offcanvas_menu_left_label', array(
    'label'   => 'Set Left Menu Title',
    'section' => 'infrastrukt_offcanvas_settings',
    'type'    => 'text',
  ) );

  $wp_customize->add_setting( 'infrastrukt_offcanvas_menu_right_label', array(
    'default'        => 'Right Menu',
    'type'           => 'theme_mod',
    'capability'     => 'edit_theme_options',
  ) );

  $wp_customize->add_control( 'infrastrukt_offcanvas_menu_right_label', array(
    'label'   => 'Set Right Menu Title',
    'section' => 'infrastrukt_offcanvas_settings',
    'type'    => 'text',
  ) );

  }

  add_action('customize_register', 'infrastrukt_customize');

endif;

/**
 * DEFAULT COLUMNS
 */
if ( ! function_exists( 'infrastrukt_foundation_columns' ) ) :

  function infrastrukt_foundation_columns() {
    $foundationCols = "column columns small-12 medium-12 large-12";
    return $foundationCols;
  }

  function infrastrukt_main_push() {
    $foundationCols = "column columns small-12 medium-12 large-9 large-push-3";
    return $foundationCols;
  }

  function infrastrukt_sidebar_pull() {
    $foundationCols = "column columns small-12 medium-12 large-3 large-pull-9";
    return $foundationCols;
  }

  function infrastrukt_main() {
    $foundationCols = "column columns small-12 medium-12 large-9";
    return $foundationCols;
  }

  function infrastrukt_sidebar() {
    $foundationCols = "column columns small-12 medium-12 large-3";
    return $foundationCols;
  }

endif;

/**
 * COPYRIGHT CODE
 */
function copyright_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'copyright_section',
        array(
            'title' => 'Copyright',
            'description' => 'Customize copyright text in footer.',
            'priority' => 40,
        )
    );

  $wp_customize->add_setting(
      'copyright_textbox',
      array(
          'default' => 'Default copyright text',
      )
  );

  $wp_customize->add_control(
      'copyright_textbox',
      array(
          'label' => 'Copyright text',
          'section' => 'copyright_section',
          'type' => 'text',
      )
  );

  $wp_customize->add_setting(
      'hide_copyright'
  );

  $wp_customize->add_control(
      'hide_copyright',
      array(
          'type' => 'checkbox',
          'label' => 'Hide copyright text',
          'section' => 'copyright_section',
      )
  );

}
add_action( 'customize_register', 'copyright_customizer' );


/**
 * INFRASTRUKT RESOURCE LOADER
 */
require get_template_directory() . '/inc/resource-loader.php';

// livereload for dev environment
// via @http://robandlauren.com/2014/02/05/live-reload-grunt-wordpress/
if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
  wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
  wp_enqueue_script('livereload');
}

?>
