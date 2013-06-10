<?php
/**
 * Emphaino Theme Customizer
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since Emphaino 1.2
 */
function emphaino_customize_register( $wp_customize ) {

	/* Custom textarea control, used by footer text and custom css settings */

	class Emphaino_Customize_Textarea_Control extends WP_Customize_Control {
    	public $type = 'textarea';
 
    	public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}

	/* Theme specific sections */

	$wp_customize->add_section( 'logo_settings', array(
		'title' => __( 'Site Logo', 'emphaino' ),
		'priority' => 30,
		)
	);


	$wp_customize->add_section( 'content_settings', array(
		'title' => __( 'Content', 'emphaino' ),
		'priority' => 120,
		)
	);

	$wp_customize->add_section( 'widget_area_settings', array(
		'title' => __( 'Widget Area', 'emphaino' ),
		'priority' => 121,
		)
	);

	$wp_customize->add_section( 'footer_settings', array(
		'title' => __( 'Footer', 'emphaino' ),
		'priority' => 122,
		)
	);

	$wp_customize->add_section( 'other_settings', array(
		'title' => __( 'Other Settings', 'emphaino' ),
		'priority' => 200,
		)
	);



	/* Logo image setting */

	$wp_customize->add_setting( 'logo_image', array(
		'default' => emphaino_default_settings( 'logo_image' ),
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'emphaino_logo_image', array(
		'label'   => __( 'Logo Image (replaces site title and tagline)', 'emphaino' ),
		'section' => 'logo_settings',
		'settings' => 'logo_image',
		'priority' => 20
	) ) );


	/* Posts layout for blog home and archives */

	$wp_customize->add_setting( 'posts_layout', array(
		'default' => emphaino_default_settings( 'posts_layout' ),
		'capability' => 'edit_theme_options',
	) );


	$wp_customize->add_control( 'emphaino_posts_layout', array(
		'label'      => __( 'Layout for Blog Home and Archives', 'emphaino' ),
		'section'    => 'content_settings',
		'settings'   => 'posts_layout',
		'type'       => 'radio',
		'choices'    => array(
			'dynamic_grid_excerpts' => __('Dynamic Grid layout with excerpts', 'emphaino'),
			'one_col_excerpts' => __('One Column layout with excerpts', 'emphaino'),
			'one_col_full_posts' => __('One Column layout with full posts', 'emphaino'),
		),
	) );


	/* Option to automatically display featured image below entry title in single post displays */

	$wp_customize->add_setting( 'full_posts_feat_img', array(
		'default' => emphaino_default_settings( 'full_posts_feat_img' ),
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'emphaino_full_posts_feat_img', array(
		'label' => __( 'Featured Image in Full Post Displays', 'emphaino' ),
		'section' => 'content_settings',
		'settings' => 'full_posts_feat_img',
		'type' => 'checkbox',
	) );


	/* Sidebar visibility */

	$wp_customize->add_setting( 'sidebar_in_posts_index', array(
		'default' => emphaino_default_settings( 'sidebar_in_posts_index' ),
		'capability' => 'edit_theme_options',
	) );


	$wp_customize->add_control( 'emphaino_sidebar_in_posts_index', array(
		'label'      => __( 'Show Sidebar in Blog Home and Archives', 'emphaino' ),
		'section'    => 'widget_area_settings',
		'settings'   => 'sidebar_in_posts_index',
		'type'       => 'checkbox',
	) );


	/* Text that goes in the left hand side of the bottom bar */

	$wp_customize->add_setting( 'footer_text', array(
		'default' => emphaino_default_settings( 'footer_text' ),
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new Emphaino_Customize_Textarea_Control( $wp_customize, 'emphaino_footer_text', array(
		'label' => __( 'Footer Text', 'emphaino' ),
		'section' => 'footer_settings',
		'settings' => 'footer_text',
	) ) );


	/* Link color */

	$wp_customize->add_setting( 'link_color', array(
		'default' => emphaino_default_settings( 'link_color' ),
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'emphaino_link_color', array(
	    'label'   => __( 'Link Color', 'emphaino' ),
	    'section' => 'colors',
	    'settings'   => 'link_color',
	) ) );


	/* Option to have a non responsive layout */

	$wp_customize->add_setting( 'non_responsive', array(
		'default' => emphaino_default_settings( 'non_responsive' ),
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'emphaino_non_responsive', array(
		'label' => __( 'Disable Responsiveness', 'emphaino' ),
		'section' => 'other_settings',
		'settings' => 'non_responsive',
		'type' => 'checkbox',
	) );


	/* Option to disable google webfonts */

	$wp_customize->add_setting( 'disable_webfonts', array(
		'default' => emphaino_default_settings( 'disable_webfonts' ),
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'emphaino_disable_webfonts', array(
		'label' => __( 'Disable Google Webfonts', 'emphaino' ),
		'section' => 'other_settings',
		'settings' => 'disable_webfonts',
		'type' => 'checkbox',
	) );

	/* Option to disable the 'Back to Top' button */

	$wp_customize->add_setting( 'disable_backtotop', array(
		'default' => emphaino_default_settings( 'disable_backtotop' ),
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'emphaino_disable_backtotop', array(
		'label' => __( 'Disable "Back to Top" Button', 'emphaino' ),
		'section' => 'other_settings',
		'settings' => 'disable_backtotop',
		'type' => 'checkbox',
	) );


	/* Custom CSS */
	$wp_customize->add_setting( 'custom_css', array(
		'default' => emphaino_default_settings( 'custom_css' ),
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Emphaino_Customize_Textarea_Control( $wp_customize, 'emphaino_custom_css', array(
		'label' => __( 'Custom CSS', 'emphaino' ),
		'section' => 'other_settings',
		'settings' => 'custom_css',
	) ) );

	/* Redifining priorities of a couple of default sections */
	$wp_customize->get_section( 'background_image' )->priority = 150;
	$wp_customize->get_section( 'colors' )->priority = 151;

	/* Enabling live preview for site title, site description and their colors */
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'emphaino_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Emphaino 1.0
*/
function emphaino_customize_preview_js() {
	wp_enqueue_script( 'emphaino_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), wp_get_theme()->Version, true );
}
add_action( 'customize_preview_init', 'emphaino_customize_preview_js' );