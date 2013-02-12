<?php
/**
 * The Footer Widget Area.
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */
?>
	<?php do_action( 'before_sidebar' ); ?>
	<?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
		<div class="widget-area footer-widget-area" role="complementary">
			<div id="footer-widgets">
				<?php dynamic_sidebar( 'footer-widget-area' ); ?>
			</div>
		</div><!-- #footer-widget-area .widget-area -->
	<?php endif; // end footer widget area ?>
