<?php
/**
 * @package Emphaino
 * @since Emphaino 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'emphaino' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<?php if ( ! is_search() && ( get_theme_mod('posts_layout') == 'one_col_full_posts' || has_post_format('link') || has_post_format('image') || has_post_format('status') || has_post_format('audio') || has_post_format('video') || has_post_format('quote') ) ): ?>
	<div class="entry-content">
		<?php if( has_post_thumbnail() && 'on' == get_theme_mod( 'full_posts_feat_img', emphaino_default_settings('full_posts_feat_img') ) ): ?>
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('full-width'); ?>
			</a>
		</div>
		<?php endif; // featured image ?>

		<?php the_content( __( 'More <span class="meta-nav">&rarr;</span>', 'emphaino' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links icon-docs">' . __( 'Pages:', 'emphaino' ), 'after' => '</div>' ) ); ?>
	
	</div><!-- .entry-content -->

	<?php else : ?>
	<div class="entry-summary">
		<?php if( has_post_thumbnail() ): ?>
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php 
					if( 'one_col_excerpts' == get_theme_mod('posts_layout') )
						the_post_thumbnail();
					else
						the_post_thumbnail('half-width');
				?>
			</a>
		</div>
		<?php endif; // featured image ?>

		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php emphaino_posted_on(); ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link icon-comment"><?php comments_popup_link( __( 'Leave a comment', 'emphaino' ), __( '1 Comment', 'emphaino' ), __( '% Comments', 'emphaino' ) ); ?></span>
		<?php endif; ?>

		<?php if( is_sticky() ) : ?>
		<span class="sticky-indicator icon-alert"><?php _e('Sticky Post', 'emphaino'); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'emphaino' ), '<span class="edit-link icon-pencil">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
