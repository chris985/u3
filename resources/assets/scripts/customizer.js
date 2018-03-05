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

var control = new wp.customize.Control( 'button_id', {
    type: 'button',
    settings: [],
    section: 'section_id',
    inputAttrs: {
        value: 'Edit Pages',
        'class': 'button button-primary'
    }
} );
wp.customize.control.add( control );
control.container.find( '.button' ).on( 'click', function() {
    alert( "Button was clicked" );
} );