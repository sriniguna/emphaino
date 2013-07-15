<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar('footer'); ?>
		<div id="bottom-bar">
			<div class="footer-text">
				<?php echo get_theme_mod( 'footer_text', emphaino_default_settings('footer_text') ) ?>
			</div>
			<div class="site-info">
				<?php do_action( 'emphaino_credits' ); ?>
				<?php printf( __( 'Powered by %s.', 'emphaino' ), '<a href="' . esc_url( 'http://wordpress.org/' ) . '" title="' . esc_attr__( 'A Semantic Personal Publishing Platform', 'emphaino' ) . '" rel="generator">WordPress</a>' ); ?>
				<?php printf( __( 'Theme %s.', 'emphaino' ), '<a href="' . esc_url( 'http://srinig.com/wordpress/themes/emphaino/' ) . '" title="Emphaino">Emphaino</a>' ); ?>
			</div><!-- .site-info -->
		</div> <!-- #bottom-bar -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php if( get_theme_mod( 'disable_backtotop' ) != 'on' ): ?>
<a href="#" class="back-to-top icon-up-open-mini"></a>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>