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

/**
 * Adjust the drawer position by the height of the wp admin bar.
 */
( function( $ ) {
  $( window ).on( 'load resize scroll', function() {
    if (window.matchMedia( '(max-width: 600px)' ).matches && $( '.admin-bar' ) ) {
      var admin_bar_height = 46;
      var scrollTop = $( window ).scrollTop();
      if ( scrollTop > admin_bar_height ) {
        $( '.admin-bar .drawer-btn' ).css( 'top', '18px' );
        $( 'body.admin-bar .drawer' ).css( 'top', '0px' );
        $( 'body.admin-bar .drawer' ).css( 'height', '100%' );
        $( 'body.admin-bar .drawer-overlay' ).css( 'top', '0px' );
      } else {
        $( '.admin-bar .drawer-btn' ).css( 'top', (18 + admin_bar_height - scrollTop ) + 'px' );
        $( 'body.admin-bar .drawer' ).css( 'top', (admin_bar_height - scrollTop ) + 'px' );
        $( 'body.admin-bar .drawer' ).css( 'height', '' );
        $( 'body.admin-bar .drawer-overlay' ).css( 'top', (admin_bar_height - scrollTop ) + 'px' );
      }
    }
    else {
      $( '.admin-bar .drawer-btn' ).css( 'top', '' );
      $( 'body.admin-bar .drawer' ).css( 'top', '' );
      $( 'body.admin-bar .drawer' ).css( 'height', '' );
      $( 'body.admin-bar .drawer-overlay' ).css( 'top', '' );
    }
  });
} )( jQuery );
