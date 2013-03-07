/**
 * Emphaino Scripts
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */

jQuery(window).load(function(){
    jQuery('#footer-widgets').masonry({
    	itemSelector: '.widget',
    	gutterWidth: 20,
    	isAnimated: true
    });

    jQuery('#dynamic-grid').masonry({
	    itemSelector: '.hentry',
    	isAnimated: true
    });

 });

jQuery().ready(function( jQuery ) {
    jQuery(".wp-caption").width(function() {
        return jQuery('img', this).width();
    });
    jQuery(".gallery-caption").width(function() {
        galleryIcon = jQuery(this).prev('.gallery-icon');
        return jQuery('img', galleryIcon).width();
    });
});

jQuery(document).ready(function(){
    jQuery(".entry-content").fitVids();
});