var ToggleMenu = function() {
	var menu = document.querySelector('.container .site-navi');
	var button = document.querySelector('#js-drawer-btn');
	var overlay = document.querySelector('.drawer-overlay');

	if ( !menu && button ) {
		button.parentNode.removeChild(button);
		return;
	}

	if ( !button )
		return;

	button.addEventListener( 'click', this.toggle_drawer, false );
	overlay.addEventListener( 'click', this.toggle_drawer, false );
}

ToggleMenu.prototype.toggle_drawer = function() {
	document.body.classList.toggle('drawer--on');
}

new ToggleMenu();

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
} )();
