<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php if( is_paged() ) emphaino_content_nav( 'nav-above' ); ?>

				<?php if ( 'dynamic_grid_excerpts' == get_theme_mod( 'posts_layout', emphaino_default_settings('posts_layout') ) ) echo '<div id="dynamic-grid" class="clearfix">'; ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>

				<?php if ( 'dynamic_grid_excerpts' == get_theme_mod( 'posts_layout', emphaino_default_settings('posts_layout') ) ) echo '</div> <!-- #dynamic-grid -->'; ?>

				<?php emphaino_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php if( get_theme_mod( 'sidebar_in_posts_index' ) == 'on' ) get_sidebar(); ?>
<?php get_footer(); ?>