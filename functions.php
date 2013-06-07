<?php
/**
 * Emphaino functions and definitions
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Emphaino 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 660; /* pixels */


/**
 * Default Settings
 *
 * @since Emphaino 1.0
 */
function emphaino_default_settings( $setting = '' )
{
	$defaults = array(
		'logo_image'            => '',
		'posts_layout'          => 'dynamic_grid_excerpts',
		'full_posts_feat_img'   => 'on',
		'sidebar_in_posts_index'=> false,
		'footer_text'           => '&copy; '. date('Y') .' '. get_bloginfo('name').'.',
		'link_color'			=> '#388ca4',
		'non_responsive'        => false,
		'disable_webfonts'      => false,
		'disable_backtotop'		=> false,
		'custom_css'            => '',
		'header_textcolor'      => '555',
		'background_image'      => get_template_directory_uri().'/images/fancy_deboss.png',
		/* Fancy Deboss by Daniel Beaton. http://subtlepatterns.com/fancy-deboss/ */
	);

	apply_filters( 'emphaino_default_settings', $defaults );

	if($setting) return $defaults[$setting];
	else return $defaults;
}


if ( ! function_exists( 'emphaino_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Emphaino 1.0
 */
function emphaino_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require get_template_directory() . '/inc/extras.php';

   /**
	* Customizer additions
    */
	require get_template_directory() . '/inc/customizer.php';

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'emphaino', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // Post thumbnail size for excerpts and search results
	add_image_size( 'half-width', 280, 9999 ); // Post thumbnail size for dynamic grid posts
	add_image_size( 'full-width', 660, 9999 ); // Post thumbnail size for full post displays

	$custom_header_args = array(
		'width'                  => 940,
		'height'                 => 140,
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => emphaino_default_settings('header_textcolor'),
		'wp-head-callback'       => 'emphaino_header_style',
		'admin-head-callback'    => 'emphaino_admin_header_style',
		'admin-preview-callback' => 'emphaino_admin_header_image',
	);
	add_theme_support( 'custom-header', $custom_header_args );

	$custom_background_args = array(
		'default-image' => emphaino_default_settings('background_image'),
	);
	add_theme_support( 'custom-background', $custom_background_args );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'emphaino' ),
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style.
	 */
	add_editor_style();

	/**
	 * This theme uses its own gallery styles.
	 */
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // emphaino_setup
add_action( 'after_setup_theme', 'emphaino_setup' );

/**
 * Register widgetized area
 *
 * @since Emphaino 1.0
 */
function emphaino_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'emphaino' ),
		'id' => 'footer-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar', 'emphaino' ),
		'description' => (get_theme_mod('sidebar_in_posts_index') == 'on')?__( 'Appears in blog home, archives, single posts and pages.', 'emphanio' ):__( 'Appears in single posts and pages.', 'emphaino' ),
		'id' => 'the-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'emphaino_widgets_init' );


/**
 * Enqueue webfonts
 *
 * @since Emphaino 1.0.4
 */
function emphaino_enqueue_webfonts() {
	$font_families[] = 'PT+Sans:400,700,400italic';
	$font_families[] = 'Bree+Serif';

	$protocol = is_ssl() ? 'https' : 'http';
	$query_args = array(
		'family' => implode( '|', $font_families ),
	);
	wp_enqueue_style( 'webfonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
}


/**
 * Enqueue scripts and styles
 */
function emphaino_scripts() {

	$theme  = wp_get_theme();

	if( get_theme_mod('disable_webfonts') != 'on' )
		emphaino_enqueue_webfonts();	

	wp_enqueue_style( 'style', get_stylesheet_uri(), false, $theme->Version, 'screen, projection' );

	wp_enqueue_style( 'print', get_template_directory_uri() . '/print.css', false, $theme->Version, 'print' );

	wp_enqueue_style( 'fontello', get_template_directory_uri() . '/lib/fontello/css/fontello.css', false, $theme->Version, 'all' );

	wp_register_style( 'ie-style', get_template_directory_uri() . '/ie.css', false, $theme->Version, 'screen, projection' );
	$GLOBALS['wp_styles']->add_data( 'ie-style', 'conditional', 'lt IE 9' );
	wp_enqueue_style( 'ie-style' );

	if( get_theme_mod('non_responsive') == 'on' )
		wp_enqueue_style( 'non-responsive', get_template_directory_uri() . '/non-responsive.css', false, $theme->Version, 'screen' );
	else
		wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), $theme->Version, true );

	wp_enqueue_script( 'jquery-masonry' );
	
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'emphaino-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), $theme->Version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'emphaino_scripts' );



/**
 * Custom styling, etc., that go in wp_head()
 * 
 * @since Emphaino 1.0
 */
function emphaino_head()
{
	echo '<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>';
	if( get_theme_mod('logo_image') ) {
?><style type="text/css">
.site-header .site-branding {
	position: absolute !important;
	clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
	clip: rect(1px, 1px, 1px, 1px);
}
</style>
<?php		
	}

	if( get_theme_mod( 'link_color' ) != emphaino_default_settings('link_color') ) {
?><style type="text/css">
a, .entry-title a:hover, #bottom-bar a {
	color: <?php echo get_theme_mod( 'link_color' ); ?>;
}
</style>
<?php		
	}
	if( $emphaino_custom_css = get_theme_mod('custom_css') ) {
?><style type="text/css" id="emphaino_custom_css">
<?php echo $emphaino_custom_css; ?>

</style>
<?php
	}
}
add_action( 'wp_head', 'emphaino_head' );





if ( ! function_exists( 'emphaino_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Emphaino 1.0
 */
function emphaino_header_style() {
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) : ?>
<style type="text/css" id="custom-header-css">
	.site-header .header-main {
		background: url('<?php echo esc_url( $header_image ); ?>') center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
</style>
	<?php endif;
	
	// If no custom options for text are set, let's bail
	if ( emphaino_default_settings('header_textcolor') == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
	.site-title,
	.site-description {
		position: absolute !important;
		clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
	.site-header .site-title a,
	.site-header .site-description {
		color: #<?php echo get_header_textcolor(); ?>;
	}
	<?php endif; ?>
</style>
	<?php
}
endif; // emphaino_header_style



if ( ! function_exists( 'emphaino_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Emphaino 1.0
 */
function emphaino_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
		width: 940px;
		<?php if (! get_theme_mod('logo_image') && 'blank' == get_header_textcolor() ) echo 'min-height: 78px;'; ?>
		padding: 30px 0 32px;
		text-align: center;
		background-color: rgba( 248, 248, 248, 0.7 );
		background-position: center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		-webkit-box-shadow: rgba(0, 0, 0, 0.1) 0 0 0 1px inset;
		-moz-box-shadow: rgba(0, 0, 0, 0.1) 0 0 0 1px inset;
		box-shadow: rgba(0, 0, 0, 0.1) 0 0 0 1px inset;
	}
	#headimg h1 {
		font-family: 'Bree Serif', serif;
		font-size: 40px;
		font-weight: normal;
	}
	#headimg h1 a {
		text-decoration: none;
		text-shadow: rgba(0, 0, 0, 0.2) 1px 1px 1px;
	}
	#desc {
		font: normal 14px "PT Sans", Verdana, Arial, sans-serif;
		text-shadow: rgba(0, 0, 0, 0.1) 0 0 1px;
	}
	#headimg img {
		max-height: 80px;
		width: auto;
		margin-bottom: -2px;
	}
	</style>
<?php
}
endif; // emphaino_admin_header_style

if ( ! function_exists( 'emphaino_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @since Emphaino 1.0
 */
function emphaino_admin_header_image() { 
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) {
		$header_style = " style=\"background-image: url('". esc_url( $header_image ) ."');\"";
	}
	else $header_style = "";
	?>
	<div id="headimg"<?php echo $header_style; ?>>
		<?php if( $logo_image = get_theme_mod('logo_image') ): ?>
		<a id="name" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo $logo_image; ?>" alt="<?php bloginfo( 'name' ); ?>" />
		</a>
		<?php else: ?>
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php endif; ?>
	</div>
<?php }
endif; // emphaino_admin_header_image

/**
 * Enqueues google fonts css for the custom header admin preview page.
 *
 * @since Emphaino 1.0
 */
function emphaino_custom_header_admin_scripts()
{
	if( 'appearance_page_custom-header' == get_current_screen()->id && get_theme_mod('disable_webfonts') != 'on' && !get_theme_mod('logo_image') && 'blank' !=  get_header_textcolor()) {
		emphaino_enqueue_webfonts();
	}
}
add_action( 'admin_enqueue_scripts', 'emphaino_custom_header_admin_scripts' );



/**
 * Adds a 'More' link at the end of the excrept.
 *
 * @since Emphaino 1.0
 */
function emphaino_excerpt_more( $more ) {
	global $post;
	return ' ...</p><p><a href="'. get_permalink($post->ID) .'" class="more-link">'. __('More <span class="meta-nav">&rarr;</span>', 'emphaino') .'</a>';
}
add_filter('excerpt_more', 'emphaino_excerpt_more');


/**
 * Custom classes for the body tag
 *
 * @since Emphaino 1.0
 */
function emphaino_body_class($classes)
{
	if( get_theme_mod('non_responsive') == 'on' )
		$classes[] = 'non-responsive';
	else 
		$classes[] = 'responsive';

	$header_image = get_header_image();
	if ( ! empty( $header_image ) )
		$classes[] = 'custom-header';
	else
		$classes[] = 'no-custom-header';

	if( 'blank' == get_header_textcolor() )
		$classes[] = 'header-text-hidden';

	if( get_theme_mod( 'logo_image' ) )
		$classes[] = 'has-logo-image';
	else
		$classes[] = 'no-logo-image';

	if( is_active_sidebar( 'the-sidebar' ) && !( ( is_home() || is_archive() ) && ( get_theme_mod( 'sidebar_in_posts_index' ) != 'on' ) ) )
		$classes[] = 'has-sidebar';
	else
		$classes[] = 'no-sidebar';

	if( ! is_singular() ) {
		$classes[] = str_replace( '_', '-', get_theme_mod( 'posts_layout', emphaino_default_settings('posts_layout') ) );
	}

	if( is_singular() && ! get_option('show_avatars') )
		$classes[] = 'no-comment-avatars';

	return $classes;
}

add_filter( 'body_class', 'emphaino_body_class' );

/**
 * Custom post classes.
 *
 * @since Emphaino 1.0
 */
function emphaino_post_class( $classes ) {
	if( has_post_thumbnail() ) // Check if the current post has a post thumbnail
		$classes[] = 'has-post-thumbnail';
	return $classes;
}
add_filter( 'post_class', 'emphaino_post_class' );

