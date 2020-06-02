/**
 * Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
 */
( function() {
  var SubMenuFocus = function() {
    var menu = document.querySelector( '.global-menu' );

    if ( ! menu || ! menu.children ) {
      return;
    }

    var menu_item = menu.getElementsByTagName( 'a' );

    // menu_item.forEach( function( o ) {
    //   o.addEventListener( 'focus', this.toggle_focus, false );
    //   o.addEventListener( 'blur', this.toggle_focus, false );
    // });

    for ( var i = 0; i < menu_item.length; i++ ) {
      menu_item[i].addEventListener( 'focus', this.toggle_focus, false );
      menu_item[i].addEventListener( 'blur', this.toggle_focus, false );
    }
  }

  SubMenuFocus.prototype.toggle_focus = function() {
    var parents = [];
    var p = this.parentNode;

    while ( p !== document.querySelector( '.global-menu' ) ) {
      var o = p;
      if ( o.classList.contains('menu-item') ) {
        parents.push(o);
      }
      p = o.parentNode;
    }

    parents.forEach( function( o ) {
      o.classList.toggle('focus');
    });
  }

  new SubMenuFocus();
} )();
