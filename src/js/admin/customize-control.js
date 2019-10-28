(function() {
	wp.customize.bind( 'ready', function() {
		wp.customize( 'ace_excerpt_options[excerpt_type]', function( setting ) {

			wp.customize.control( 'ace_excerpt_options[excerpt_length]', function( control ) {
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

			wp.customize.control( 'ace_excerpt_options[excerpt_mblength]', function( control ) {
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
	});
})( jQuery );
