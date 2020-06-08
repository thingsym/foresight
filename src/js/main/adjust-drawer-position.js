/**
 * Adjust the drawer position by the height of the wp admin bar.
 */
( function() {
  var AdjustDrawerPosition = function() {
    var admin_bar = document.querySelector('.admin-bar');

    if ( ! admin_bar )
      return;

    window.addEventListener( 'load', this.adjust_drawer_position, false );
    window.addEventListener( 'resize', this.adjust_drawer_position, false );
    window.addEventListener( 'scroll', this.adjust_drawer_position, false );
  }

  AdjustDrawerPosition.prototype.adjust_drawer_position = function() {
    if ( window.matchMedia( '(max-width: 600px)' ).matches ) {
      var admin_bar_height = 46;
      var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;

      if ( scrollTop > admin_bar_height ) {
        document.querySelector('.admin-bar .drawer-btn').style.top = '18px';
        document.querySelector('body.admin-bar .drawer').style.top = '0px';
        document.querySelector('body.admin-bar .drawer').style.height = '100%';
        document.querySelector('body.admin-bar .drawer-overlay').style.top = '0px';
      } else {
        document.querySelector('.admin-bar .drawer-btn').style.top = (18 + admin_bar_height - scrollTop ) + 'px';
        document.querySelector('body.admin-bar .drawer').style.top = (admin_bar_height - scrollTop ) + 'px';
        document.querySelector('body.admin-bar .drawer').style.height = '';
        document.querySelector('body.admin-bar .drawer-overlay').style.top = (admin_bar_height - scrollTop ) + 'px';
      }
    } else {
      document.querySelector('.admin-bar .drawer-btn').style.top = '';
      document.querySelector('body.admin-bar .drawer').style.top = '';
      document.querySelector('body.admin-bar .drawer').style.height = '';
      document.querySelector('body.admin-bar .drawer-overlay').style.top = '';
    }
  }

  new AdjustDrawerPosition();
} )();
