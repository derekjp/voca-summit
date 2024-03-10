<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );


// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  // add_editor_style( get_stylesheet_directory_uri() . '/library/custom-style-editor.css' );
  add_editor_style( get_stylesheet_directory_uri() . '/custom-style-editor.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  //require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/*
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722

  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162

  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections

  // $wp_customize->remove_section('title_tagline');
  $wp_customize->remove_section('colors');
  $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');

  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!





/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}

add_action('wp_enqueue_scripts', 'bones_fonts');


//Custom styles to admin editor
function my_theme_add_editor_styles() {
    add_editor_style( 'custom-style-editor.css' );
}
add_action( 'admin_init', 'my_theme_add_editor_styles' );
// // add the actual editor selector:
require_once( 'library/custom-style-editor.php' );






//Add Custom Theme Options
function voca_customize_register($wp_customize){
  //Donation Banner
  $wp_customize->add_section('voca_per_header_banner', array(
        'title'    => __('Banner', 'voca'),
        'description' => 'Banner that appears above the page header.',
        'priority' => 120,
      ));
      //Is Banner On?
      $wp_customize->add_setting( 'banner_is_active', array(
        'default' => 'Check to turn banner on.',
        'capability' => 'edit_theme_options'
      ) );
      $wp_customize->add_control( 'banner_is_active', array(
        'label' => 'Check to turn banner on.',
        'section' => 'voca_per_header_banner',
        'type' => 'checkbox'
      ) );
      //What Color Banner?
      $wp_customize->add_setting( 'banner_color', array(
        'default' => 'What color Banner?',
        'capability' => 'edit_theme_options'
      ) );
      $wp_customize->add_control( 'banner_color', array(
        'label' => 'What color Banner?',
        'section' => 'voca_per_header_banner',
        'type' => 'radio',
        'choices'    => array(
            'orange-banner' => 'Orange (Default)',
            'teal-banner' => 'Teal',
            'black-banner' => 'Black',
        )
      ) );
      //Banner Text
      $wp_customize->add_setting( 'banner_text', array(
        'default' => 'Title Goes Here',
        'capability' => 'edit_theme_options'
      ) );
      $wp_customize->add_control( 'banner_text', array(
        'label' => 'Banner Text',
        'section' => 'voca_per_header_banner',
        'type' => 'text'
      ) );

      //Banner Link Text
      $wp_customize->add_setting( 'banner_link_text', array(
        'default' => 'Banner Link Text',
        'capability' => 'edit_theme_options'
      ) );
      $wp_customize->add_control( 'banner_link_text', array(
        'label' => 'Banner Text',
        'section' => 'voca_per_header_banner',
        'type' => 'text'
      ) );


      //Banner Link URL
      $wp_customize->add_setting( 'banner_link_url', array(
        'default' => 'www.donation-link.com',
        'capability' => 'edit_theme_options'
      ) );
      $wp_customize->add_control( 'banner_link_url', array(
        'label' => 'Banner URL. Use http or https for outside links ',
        'section' => 'voca_per_header_banner',
        'type' => 'text'
      ) );


    $wp_customize->add_section('summit_pre_footer', array(
        'title'    => __('Footer Top', 'voca'),
        'description' => 'Top section of the footer.',
        'priority' => 120,
    ));
    //Left Title
    $wp_customize->add_setting( 'footer_left_title', array(
      'default' => 'Title Goes Here',
      'capability' => 'edit_theme_options'
    ) );
    $wp_customize->add_control( 'footer_left_title', array(
      'label' => 'Footer Left Title',
      'section' => 'summit_pre_footer',
      'type' => 'text'
    ) );
    //Left Text
    $wp_customize->add_setting( 'footer_left_text', array(
      'default' => 'Text Goes Here',
      'capability' => 'edit_theme_options'
    ) );
    $wp_customize->add_control( 'footer_left_text', array(
      'label' => 'Footer Left Text',
      'section' => 'summit_pre_footer',
      'type' => 'textarea'
    ) );

    //Center Title
    $wp_customize->add_setting( 'footer_center_title', array(
      'default' => 'Title Goes Here',
      'capability' => 'edit_theme_options'
    ) );
    $wp_customize->add_control( 'footer_center_title', array(
      'label' => 'Footer Center Title',
      'section' => 'summit_pre_footer',
      'type' => 'text'
    ) );
    //Center Text
    $wp_customize->add_setting( 'footer_center_text', array(
      'default' => 'Text Goes Here',
      'capability' => 'edit_theme_options'
    ) );
    $wp_customize->add_control( 'footer_center_text', array(
      'label' => 'Footer Center Text',
      'section' => 'summit_pre_footer',
      'type' => 'textarea'
    ) );

    //Right Title
    $wp_customize->add_setting( 'footer_right_title', array(
      'default' => 'Title Goes Here',
      'capability' => 'edit_theme_options'
    ) );
    $wp_customize->add_control( 'footer_right_title', array(
      'label' => 'Footer Right Title',
      'section' => 'summit_pre_footer',
      'type' => 'text'
    ) );
    //Right Text
    $wp_customize->add_setting( 'footer_right_text', array(
      'default' => 'Text Goes Here',
      'capability' => 'edit_theme_options'
    ) );
    $wp_customize->add_control( 'footer_right_text', array(
      'label' => 'Footer Right Text',
      'section' => 'summit_pre_footer',
      'type' => 'textarea'
    ) );




     //Socail Links
    $wp_customize->add_section('voca_footer_links', array(
        'title'    => __('Footer Links', 'voca'),
        'description' => 'Links located in the footer.',
        'priority' => 121,
    ));

     //Facebook
    $wp_customize->add_setting( 'facebook_link', array(
     'default' => 'http://www.facebook.com/username',
     'capability' => 'edit_theme_options'
     ) );

     $wp_customize->add_control( 'facebook_link', array(
     'label' => 'Facebook',
     'section' => 'voca_footer_links',
     'type' => 'text'
     ) );

     //Instagram
     $wp_customize->add_setting( 'instagram_link', array(
    'default' => 'http://instagram.com/username',
    'capability' => 'edit_theme_options'
    ) );

    $wp_customize->add_control( 'instagram_link', array(
    'label' => 'Instagram',
    'section' => 'voca_footer_links',
    'type' => 'text'
    ) );


      //Twitter
      $wp_customize->add_setting( 'twitter_link', array(
     'default' => 'http://twitter.com/username',
     'capability' => 'edit_theme_options'
     ) );

     $wp_customize->add_control( 'twitter_link', array(
     'label' => 'Twitter',
     'section' => 'voca_footer_links',
     'type' => 'text'
     ) );

      //Donate
      $wp_customize->add_setting( 'donate_link', array(
     'default' => 'URL of VoCA Donation Page',
     'capability' => 'edit_theme_options'
     ) );

     $wp_customize->add_control( 'donate_link', array(
     'label' => 'Donate',
     'section' => 'voca_footer_links',
     'type' => 'text'
     ) );






}




function my_mce_buttons_2($buttons) {
  /**
   * Add in a core button that's disabled by default
   */
  $buttons[] = 'superscript';
  $buttons[] = 'subscript';

  return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');




add_action('customize_register', 'voca_customize_register');






// CMB2
/**
 * Get the bootstrap!
 */
if ( file_exists( __DIR__ . '/cmb2/init.php' ) ) {
  require_once __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once __DIR__ . '/CMB2/init.php';
}


//Add Title 1
add_action( 'cmb2_admin_init', 'vidoeTitleOne' );
function vidoeTitleOne() {
	$prefix = 'titleOne';
	$cmb = new_cmb2_box( array(
		'id'            => 'title1',
		'title'         => __( 'Section Title - One', 'cmb2' ),
		'object_types'  => array( 'page', ),
    'show_on'      => array( 'key' => 'page-template', 'value' => 'video.php' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Title', 'cmb2' ),
		'desc'       => __( '(optional)', 'cmb2' ),
		'id'         => $prefix . 'text',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats',
	) );
}
//End of Title 1


//Add Metabox: Video Grid
add_action( 'cmb2_admin_init', 'video_grid_repeat_group_top' );
function video_grid_repeat_group_top() {
	$prefix = '_vocaVideo_';
	$videoGrid = new_cmb2_box( array(
		'id'            => 'video_grid_repeat_group_top',
		'title'         => __( 'Video Grid', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
    'show_on'      => array( 'key' => 'page-template', 'value' => 'video.php' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
	) );
//Start Group
$video_grid_field_id = $videoGrid->add_field( array(
  'id'          => 'video_grid_repeat_group_top',
  'type'        => 'group',
  'description' => __( 'Generates reusable form entries', 'cmb2' ),
  // 'repeatable'  => false, // use false if you want non-repeatable group
  'options'     => array(
    'group_title'   => __( 'Video Block {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
    'add_button'    => __( 'Add Another Video Block', 'cmb2' ),
    'remove_button' => __( 'Remove Video Block', 'cmb2' ),
    'sortable'      => true,
  ),
) );
//Group Fields
$videoGrid->add_group_field( $video_grid_field_id, array(
  'name' => 'Video URL',
  'id'   => 'video_url',
  'type' => 'text',
) );
$videoGrid->add_group_field( $video_grid_field_id, array(
  'name' => 'Title',
  'id'   => 'title',
  'type' => 'text',
) );
$videoGrid->add_group_field( $video_grid_field_id, array(
  'name' => 'Description',
  'description' => 'Write a short description for this entry',
  'id'   => 'description',
  'type' => 'textarea_small',
) );
}//End Metabox: Video Grid



//Add Title 2
add_action( 'cmb2_admin_init', 'vidoeTitleTwo' );
function vidoeTitleTwo() {
	$prefix = 'titleTwo';
	$cmb = new_cmb2_box( array(
		'id'            => 'title2',
		'title'         => __( 'Section Title - Two', 'cmb2' ),
		'object_types'  => array( 'page', ),
    'show_on'      => array( 'key' => 'page-template', 'value' => 'video.php' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Title', 'cmb2' ),
		'desc'       => __( '(optional)', 'cmb2' ),
		'id'         => $prefix . 'text',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats',
	) );
}
//End of Title 2



//Add Metabox: Video Feature
add_action( 'cmb2_admin_init', 'voca_video_feature_metabox' );
function voca_video_feature_metabox() {
	$prefix = '_vocaVideoFeature_';
	$videoFeature = new_cmb2_box( array(
		'id'            => 'video_feature_metabox',
		'title'         => __( 'Video Feature', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
    'show_on'      => array( 'key' => 'page-template', 'value' => 'video.php' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
	) );

  //Start Group: Video Feature
  $video_feature_field_id = $videoFeature->add_field( array(
  	'id'          => 'video_feature_repeat_group',
  	'type'        => 'group',
  	'description' => __( 'Generates reusable form entries', 'cmb2' ),
  	// 'repeatable'  => false, // use false if you want non-repeatable group
  	'options'     => array(
  		'group_title'   => __( 'Video Feature {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
  		'add_button'    => __( 'Add Another Video Feature', 'cmb2' ),
  		'remove_button' => __( 'Remove Video Feature', 'cmb2' ),
  		'sortable'      => true,
  	),
  ) );
  //Group Fields
  $videoFeature->add_group_field( $video_feature_field_id, array(
    'name' => 'Video URL',
    'id'   => 'video_url',
    'type' => 'text',
  ) );
  $videoFeature->add_group_field( $video_feature_field_id, array(
  	'name' => 'Title',
  	'id'   => 'title',
  	'type' => 'text',
  ) );
  $videoFeature->add_group_field( $video_feature_field_id, array(
  	'name' => 'Description',
  	'description' => 'Write a short description for this entry',
  	'id'   => 'description',
  	'type' => 'textarea_small',
  ) );
}//End Metabox: Video Feature


//Add Title 3
add_action( 'cmb2_admin_init', 'vidoeTitleThree' );
function vidoeTitleThree() {
	$prefix = 'titleThree';
	$cmb = new_cmb2_box( array(
		'id'            => 'title3',
		'title'         => __( 'Section Title - Three', 'cmb2' ),
		'object_types'  => array( 'page', ),
    'show_on'      => array( 'key' => 'page-template', 'value' => 'video.php' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Title', 'cmb2' ),
		'desc'       => __( '(optional)', 'cmb2' ),
		'id'         => $prefix . 'text',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats',
	) );
}
//End of Title 3

//Add Metabox: Video Grid - Bottom
add_action( 'cmb2_admin_init', 'voca_video_grid_bottom' );
function voca_video_grid_bottom() {
	$prefix = '_vocaVideo_';
	$videoGrid = new_cmb2_box( array(
		'id'            => 'video_grid_bottom_metabox',
		'title'         => __( 'Video Grid - Bottom', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
    'show_on'      => array( 'key' => 'page-template', 'value' => 'video.php' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
	) );
//Start Group
$video_grid_field_id = $videoGrid->add_field( array(
  'id'          => 'video_grid_repeat_group_bottom',
  'type'        => 'group',
  'description' => __( 'Generates reusable form entries', 'cmb2' ),
  // 'repeatable'  => false, // use false if you want non-repeatable group
  'options'     => array(
    'group_title'   => __( 'Video Block {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
    'add_button'    => __( 'Add Another Video Block', 'cmb2' ),
    'remove_button' => __( 'Remove Video Block', 'cmb2' ),
    'sortable'      => true,
  ),
) );
//Group Fields
$videoGrid->add_group_field( $video_grid_field_id, array(
  'name' => 'Video URL',
  'id'   => 'video_url',
  'type' => 'text',
) );
$videoGrid->add_group_field( $video_grid_field_id, array(
  'name' => 'Title',
  'id'   => 'title',
  'type' => 'text',
) );
$videoGrid->add_group_field( $video_grid_field_id, array(
  'name' => 'Description',
  'description' => 'Write a short description for this entry',
  'id'   => 'description',
  'type' => 'textarea_small',
) );
}//End Metabox: Video Grid


//Video Hero Metabox
add_action( 'cmb2_admin_init', 'videoHero' );
function videoHero() {
	$prefix = 'videoHero';
	$cmb = new_cmb2_box( array(
		'id'            => 'videoHero',
		'title'         => __( 'Video Hero', 'cmb2' ),
		'object_types'  => array( 'page', ),
    // 'show_on'      => array( 'key' => 'page-template'),
		'context'       => 'side',
		'priority'      => 'low',
		'show_names'    => true,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Video Hero', 'cmb2' ),
		'desc'       => __( 'Video Hero will disable Featured Image (optional)', 'cmb2' ),
		'id'         => $prefix . 'video',
		'type'       => 'file',
		'show_on_cb' => 'cmb2_hide_if_no_cats',
	) );
}
//End of Video Hero Metabox



//Video Single Page
//Add Metabox: Video Single Feature
add_action( 'cmb2_admin_init', 'voca_videosingle_feature_metabox' );
function voca_videosingle_feature_metabox() {
	$prefix = '_vocaVideoSingleFeature_';
	$videoSingleFeature = new_cmb2_box( array(
		'id'            => 'videosingle_feature_metabox',
		'title'         => __( 'Video Feature', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
    'show_on'      => array( 'key' => 'page-template', 'value' => 'video-single.php' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
	) );

  //Start Group: Video Single Feature
  $videosingle_feature_field_id = $videoSingleFeature->add_field( array(
  	'id'          => 'videosingle_feature_repeat_group',
  	'type'        => 'group',
  	'description' => __( 'Generates reusable form entries', 'cmb2' ),
  	// 'repeatable'  => false, // use false if you want non-repeatable group
  	'options'     => array(
  		'group_title'   => __( 'Video Feature {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
  		'add_button'    => __( 'Add Another Video Feature', 'cmb2' ),
  		'remove_button' => __( 'Remove Video Feature', 'cmb2' ),
  		'sortable'      => true,
  	),
  ) );
  //Group Fields
  $videoSingleFeature->add_group_field( $videosingle_feature_field_id, array(
    'name' => 'Video URL',
    'id'   => 'video_url',
    'type' => 'text',
  ) );
  $videoSingleFeature->add_group_field( $videosingle_feature_field_id, array(
  	'name' => 'Title',
  	'id'   => 'title',
  	'type' => 'text',
  ) );
  $videoSingleFeature->add_group_field( $videosingle_feature_field_id, array(
  	'name' => 'Description',
  	'description' => 'Write a short description for this entry',
  	'id'   => 'description',
  	'type' => 'textarea_small',
  ) );
}//End Metabox: Video Single Feature



/* DON'T DELETE THIS CLOSING TAG */ ?>
