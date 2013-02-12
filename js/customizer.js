/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).html( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).html( to );
		} );
	} );
	wp.customize( 'header_textcolor', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a, .site-description' ).css( 'color', to );
        } );
    } );

    // Link color
	wp.customize( 'link_color', function( value ) {
        value.bind( function( to ) {
            $( '.entry-content, .entry-summary a, .entry-meta a, .site-footer a' ).css( 'color', to );
        } );
    } );

	// Footer text
	wp.customize( 'footer_text', function( value ) {
		value.bind( function( to ) {
			$( '.footer-text' ).html( to );
		} );
	} );

} )( jQuery );