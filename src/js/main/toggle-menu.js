const ToggleMenu = function() {
	const menu = document.querySelector('.container .site-navi');
	const button = document.querySelector('#js-drawer-btn');
	const overlay = document.querySelector('.drawer-overlay');

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
