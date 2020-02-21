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
