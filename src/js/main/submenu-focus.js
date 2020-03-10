/**
 * Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
 */

( function( $ ) {
	var menu = $( '.global-menu' );

	if ( ! menu.length || ! menu.children().length ) {
		return;
	}

	menu.find( 'a' ).on( 'focus.foresight blur.foresight', function() {
		$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
	} );
} )( jQuery );
