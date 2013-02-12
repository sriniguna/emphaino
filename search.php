<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'emphaino' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php emphaino_content_nav( 'nav-above' ); ?>

				<?php if ( 'dynamic_grid_excerpts' == get_theme_mod( 'posts_layout', emphaino_default_settings('posts_layout') ) ) echo '<div id="dynamic-grid" class="clearfix">'; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>
	
				<?php if ( 'dynamic_grid_excerpts' == get_theme_mod( 'posts_layout', emphaino_default_settings('posts_layout') ) ) echo '</div> <!-- #dynamic-grid -->'; ?>

				<?php emphaino_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_footer(); ?>