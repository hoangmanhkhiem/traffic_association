window.previewGoogleFonts = [];

function attachProjectEvent( eventName, funcString ) {

	let paramName = ( eventName === 'slideTimelineDidUpdate' ) ? 'timeline' : 'slider';

	try {
		jQuery('#lse-project-preview-content' ).on( eventName, new Function( 'event', paramName, funcString ) );
	}catch(e){
		console.error( 'LayerSlider: Error while calling event "' + eventName + '":\n\r\n\r', e );
	}
}

function loadGoogleFonts( fontList ) {

	if( ! Array.isArray( fontList ) ) {
		fontList = [ fontList ];
	}

	fontList.forEach( ( fontName ) => {

		// Bail out if the font is already loaded
		if( -1 !== window.previewGoogleFonts.indexOf( fontName ) ) {
			return false;
		}

		window.previewGoogleFonts.push( fontName );

		WebFont.load({
			google: {
				families: [ fontName + ':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i']
			}
		});
	});
}

function testFunction(){
	console.log('test function called');
}