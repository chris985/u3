import $ from 'jquery';

wp.customize('blogname', (value) => {
  value.bind(to => $('.brand').text(to));
});

wp.customize.bind( 'ready', function() {
	function hideShowColorControls() {
		var colorControlIds = explode( ',', get_theme_mod('sectionsList') );
		if ( wp.customize.instance( 'the_mx_color_scheme' ).get() === 'custom' ) {
			$.each( colorControlIds, function ( i, value ) {	
				$( '#customize-control-' + value ).show();
				$( bgColorControlId ).show();
			} );
		} else {
			$.each( colorControlIds, function ( i, value ) { 
				$( '#customize-control-' + value ).hide();
				$( bgColorControlId ).hide();
					console.log( '#customize-control-' + value );
				} );
		}
		return hideShowColorControls;
	}
} );

wp.customize.control( 'button_id', function( control ) {
    control.container.find( '.button' ).on( 'click', function() {
    	        console.info( 'Button was clicked.' );
        alert( "Button was clicked." );
    } );
} );