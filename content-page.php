<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php if( has_post_thumbnail() && 'on' == get_theme_mod( 'full_posts_feat_img', emphaino_default_settings('full_posts_feat_img') ) ): ?>
		<div class="featured-image">
			<?php the_post_thumbnail('full-width'); ?>
		</div>
		<?php endif; // featured image ?>

		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links icon-docs">' . __( 'Pages:', 'emphaino' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'emphaino' ), '<footer class="entry-meta"><span class="edit-link icon-pencil">', '</span></footer>' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
