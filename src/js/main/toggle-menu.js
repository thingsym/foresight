class ToggleMenu {
	constructor() {
		const menu = document.querySelector( '.container .site-navi' );
		const button = document.querySelector( '#js-drawer-btn' );
		const overlay = document.querySelector( '.drawer-overlay' );

		if ( ! menu && button ) {
			button.parentNode.removeChild( button );
			return;
		}

		if ( ! button )
			return;

		button.addEventListener( 'click', this.toggle_drawer, false );
		overlay.addEventListener( 'click', this.toggle_drawer, false );

		button.addEventListener( 'keydown', event => {
			// Enter key or o key
			// TODO: Interference between Enter and Space
			if ( event.code === 'Space' || event.code === 'KeyO' ) {
				document.body.classList.toggle( 'drawer--on' );
				document.querySelector('.site-content' ).setAttribute( 'tabindex', 0 );
			}
		});

		document.body.addEventListener( 'keydown', event => {
			if ( document.body.classList.contains( 'drawer--on' ) ) {
				// Tab key, out of focus of drawer
				if ( event.code === 'Tab' && document.activeElement.classList.contains( 'site-content' ) ) {
					document.body.classList.toggle( 'drawer--on' );
					document.querySelector( '.site-content' ).removeAttribute( 'tabindex' );
				}
				// Escape key
				if ( event.code === 'Escape' ) {
					document.body.classList.toggle( 'drawer--on' );
					document.querySelector( '.site-content' ).removeAttribute( 'tabindex' );
					button.focus();
				}
			}
		});
	}

	toggle_drawer() {
		document.body.classList.toggle( 'drawer--on' );

		if ( document.body.classList.contains( 'drawer--on' ) ) {
			document.querySelector( '.site-content' ).setAttribute( 'tabindex', 0 );
		}
		else {
			document.querySelector( '.site-content' ).removeAttribute( 'tabindex' );
		}
	}
}

new ToggleMenu();
