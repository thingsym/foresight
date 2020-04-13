( function() {
  var ToggleMenu = function() {
    var menu = document.querySelector('.container .site-navi');
    var button = document.querySelector('#js-drawer-btn');
    var overlay = document.querySelector('.drawer-overlay');

    if ( ! menu && button ) {
      button.parentNode.removeChild(button);
      return;
    }

    if ( ! button )
      return;

    button.addEventListener( 'click', this.toggle_drawer, false );
    overlay.addEventListener( 'click', this.toggle_drawer, false );

    button.addEventListener( 'keydown', event => {
      // Enter key
      if ( event.keyCode === 13 ) {
        document.body.classList.toggle('drawer--on');
        document.querySelector('.site-content').setAttribute('tabindex', 0);
      }
    });

    document.body.addEventListener('keydown', event => {
      if (document.body.classList.contains('drawer--on')) {
        // Tab key, out of focus of drawer
        if ( event.keyCode === 9 && document.activeElement.classList.contains('site-content') ) {
          document.body.classList.toggle('drawer--on');
          document.querySelector('.site-content').removeAttribute('tabindex');
        }
        // Esc key
        if ( event.keyCode === 27 ) {
          document.body.classList.toggle('drawer--on');
          document.querySelector('.site-content').removeAttribute('tabindex');
          button.focus();
        }
      }
    });
  }

  ToggleMenu.prototype.toggle_drawer = function() {
    document.body.classList.toggle('drawer--on');

    if (document.body.classList.contains('drawer--on')) {
      document.querySelector('.site-content').setAttribute('tabindex', 0);
    }
    else {
      document.querySelector('.site-content').removeAttribute('tabindex');
    }
  }

  new ToggleMenu();
} )();
