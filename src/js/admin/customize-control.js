(function( $ ) {
  wp.customize.bind( 'ready', function() {
    wp.customize( 'header_textcolor', function( setting ) {

      wp.customize.control( 'foresight_site_header_options[display_site_title]', function( control ) {
        var checkbox_toggle = function( val ) {
          if ( 'blank' === setting.get() ) {
            control.setting.set( false );
            control.container.hide( 0 );
          }
          else {
            if ( 'init' != val ) {
              control.setting.set( true );
            }
            control.container.show( 0 );
          }
        };

        checkbox_toggle( 'init' );
        setting.bind( checkbox_toggle );
      });

      wp.customize.control( 'foresight_site_header_options[display_site_description]', function( control ) {
        var checkbox_toggle = function( val ) {
          if ( 'blank' === setting.get() ) {
            control.setting.set( false );
            control.container.hide( 0 );
          }
          else {
            if ( 'init' != val ) {
              control.setting.set( true );
            }
            control.container.show( 0 );
          }
        };

        checkbox_toggle( 'init' );
        setting.bind( checkbox_toggle );
      });

    });

    wp.customize( 'foresight_excerpt_options[excerpt_type]', function( setting ) {

      wp.customize.control( 'foresight_excerpt_options[excerpt_length]', function( control ) {
        var visibility = function() {
          if ( 'summary' == setting.get() ) {
            control.container.show( 0 );
          } else {
            control.container.hide( 0 );
          }
        };

        visibility();
        setting.bind( visibility );
      });

      wp.customize.control( 'foresight_excerpt_options[more_reading_link]', function( control ) {
        var visibility = function() {
          if ( 'summary' == setting.get() ) {
            control.container.show( 0 );
          } else {
            control.container.hide( 0 );
          }
        };

        visibility();
        setting.bind( visibility );
      });

    });

    wp.customize.control( 'blogdescription' ).priority( 20 );
  });
})( jQuery );
