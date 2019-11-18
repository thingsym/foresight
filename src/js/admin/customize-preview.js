/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

  // Site title and description.
  wp.customize( 'blogname', function( value ) {
    value.bind( function( to ) {
      $( '.site-title a' ).text( to );
    } );
  } );

  wp.customize( 'blogdescription', function( value ) {
    value.bind( function( to ) {
      $( '.site-description' ).text( to );
    } );
  } );

  wp.customize( 'ace_site_header_options[display_site_title]', function( value ) {
    value.bind( function( to ) {
      if ( to ) {
        $( '.site-title' ).css( {
          'clip': 'auto',
          'position': 'relative'
        } );
      } else {
        $( '.site-title' ).css( {
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        } );
      }
    } );
  } );

  wp.customize( 'ace_site_header_options[display_site_description]', function( value ) {
    value.bind( function( to ) {
      if ( to ) {
        $( '.site-description' ).css( {
          'clip': 'auto',
          'position': 'relative'
        } );
      } else {
        $( '.site-description' ).css( {
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        } );
      }
    } );
  } );

  // Header text color.
  wp.customize( 'header_textcolor', function( value ) {
    value.bind( function( to ) {
      if ( ! to ) {
        to = 'unset';
      }

      document.documentElement.style.setProperty('--custom-header-text-color', to);
    } );
  } );

} )( jQuery );
