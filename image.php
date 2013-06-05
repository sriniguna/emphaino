<?php
/**
 * The template for displaying image attachments.
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */

get_header();
?>

		<div id="primary" class="content-area image-attachment">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">

						<div class="entry-attachment">
							<div class="attachment">
								<?php
									/**
									 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
									 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
									 */
									$attachments = array_values( get_children( array( 
										'post_parent' => $post->post_parent,
										'post_status' => 'inherit',
										'post_type' => 'attachment',
										'post_mime_type' => 'image',
										'order' => 'ASC',
										'orderby' => 'menu_order ID'
									) ) );
									foreach ( $attachments as $k => $attachment ) {
										if ( $attachment->ID == $post->ID )
											break;
									}
									$k++;
									// If there is more than 1 attachment in a gallery
									if ( count( $attachments ) > 1 ) {
										if ( isset( $attachments[ $k ] ) )
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
									} else {
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									}
								?>

								<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
									$attachment_size = apply_filters( 'emphaino_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
									echo wp_get_attachment_image( $post->ID, $attachment_size );
								?></a>
							</div><!-- .attachment -->

							<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- .entry-caption -->
							<?php endif; ?>
						</div><!-- .entry-attachment -->

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'emphaino' ), 'after' => '</div>' ) ); ?>

					</div><!-- .entry-content -->

					<nav id="image-navigation" class="site-navigation">
						<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'emphaino' ) ); ?></span>
						<span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'emphaino' ) ); ?></span>
					</nav><!-- #image-navigation -->
				
					<footer class="entry-meta">
						<?php emphaino_posted_on(); ?>
						<span class="parent-post icon-doc"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php printf( __('Return to %s', 'emphaino'),  get_the_title( $post->post_parent ) ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>
						<?php $metadata = wp_get_attachment_metadata(); ?>
						<span class="full-size-link icon-resize-full"><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php _e('Full Size', 'emphaino'); ?>"><?php echo $metadata['width'] . ' &times; ' . $metadata['height']; ?></a></span>
						<?php edit_post_link( __( 'Edit', 'emphaino' ), ' <span class="edit-link icon-pencil">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area .image-attachment -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>