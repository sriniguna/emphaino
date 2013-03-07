<?php
/**
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

	<footer class="entry-meta">
		<?php emphaino_posted_on(); ?>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'emphaino' ) );
			if ( $categories_list && emphaino_categorized_blog() ) :
		?>
		<span class="cat-links icon-folder">
			<?php printf( __( 'Posted in %1$s', 'emphaino' ), $categories_list ); ?>
		</span>
		<?php endif; // End if categories ?>

		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'emphaino' ) );
			if ( $tags_list ) :
		?>
		<span class="tags-links icon-tag">
			<?php printf( __( 'Tagged %1$s', 'emphaino' ), $tags_list ); ?>
		</span>
		<?php endif; // End if $tags_list ?>

		<span class="permalink icon-link"><a href="<?php echo get_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php _e('Post Permalink', 'emphaino'); ?></a></span>

		<?php edit_post_link( __( 'Edit', 'emphaino' ), '<span class="edit-link icon-pencil">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
