const $ = window.jQuery || jQuery;

const serializeJSON = function serializeJSON( path ) {
	const isInput = $( this ).is( 'input' ) || $( this ).is( 'select' ) || $( this ).is( 'textarea' );
	let unIndexed = isInput ? $( this ).serializeArray() : $( this ).find( 'input, select, textarea' ).serializeArray(),
		indexed = {},
		validate = /(\[([a-zA-Z0-9_-]+)?\]?)/g,
		arrayKeys = {},
		end = false;
	$.each( unIndexed, function() {
		const that = this,
			match = this.name.match( /^([0-9a-zA-Z_-]+)/ );
		if ( ! match ) {
			return;
		}
		let keys = this.name.match( validate ),
			objPath = "indexed['" + match[ 0 ] + "']";

		if ( keys ) {
			if ( typeof indexed[ match[ 0 ] ] != 'object' ) {
				indexed[ match[ 0 ] ] = {};
			}

			$.each( keys, function( i, prop ) {
				prop = prop.replace( /\]|\[/g, '' );
				let rawPath = objPath.replace( /'|\[|\]/g, '' ),
					objExp = '',
					preObjPath = objPath;

				if ( prop == '' ) {
					if ( arrayKeys[ rawPath ] == undefined ) {
						arrayKeys[ rawPath ] = 0;
					} else {
						arrayKeys[ rawPath ]++;
					}
					objPath += "['" + arrayKeys[ rawPath ] + "']";
				} else {
					if ( ! isNaN( prop ) ) {
						arrayKeys[ rawPath ] = prop;
					}
					objPath += "['" + prop + "']";
				}
				try {
					if ( i == keys.length - 1 ) {
						objExp = objPath + '=that.value;';
						end = true;
					} else {
						objExp = objPath + '={}';
						end = false;
					}

					const evalString = '' +
                        'if( typeof ' + objPath + " == 'undefined'){" + objExp + ';' +
                        '}else{' +
                        'if(end){' +
                        'if(typeof ' + preObjPath + "!='object'){" + preObjPath + '={};}' +
                        objExp +
                        '}' +
                        '}';
					eval( evalString );
				} catch ( e ) {
					console.log( 'Error:' + e + '\n' + objExp );
				}
			} );
		} else {
			indexed[ match[ 0 ] ] = this.value;
		}
	} );
	if ( path ) {
		path = "['" + path.replace( '.', "']['" ) + "']";
		const c = 'try{indexed = indexed' + path + '}catch(ex){console.log(c, ex);}';
		eval( c );
	}
	return indexed;
};

const LP_Tooltip = ( options ) => {
	options = $.extend( {}, { offset: [ 0, 0 ] }, options || {} );

	return $.each( this, function() {
		const $el = $( this ),
			content = $el.data( 'content' );

		if ( ! content || ( $el.data( 'LP_Tooltip' ) !== undefined ) ) {
			return;
		}

		let $tooltip = null;

		$el.on( 'mouseenter', function( e ) {
			$tooltip = $( '<div class="learn-press-tooltip-bubble"/>' ).html( content ).appendTo( $( 'body' ) ).hide();
			const position = $el.offset();

			if ( Array.isArray( options.offset ) ) {
				const top = options.offset[ 1 ],
					left = options.offset[ 0 ];

				if ( $.isNumeric( left ) ) {
					position.left += left;
				} else {

				}
				if ( $.isNumeric( top ) ) {
					position.top += top;
				} else {

				}
			}

			$tooltip.css( {
				top: position.top,
				left: position.left,
			} );

			$tooltip.fadeIn();
		} );

		$el.on( 'mouseleave', function( e ) {
			$tooltip && $tooltip.remove();
		} );

		$el.data( 'tooltip', true );
	} );
};

const hasEvent = function hasEvent( name ) {
	const events = $( this ).data( 'events' );
	if ( typeof events.LP == 'undefined' ) {
		return false;
	}
	for ( i = 0; i < events.LP.length; i++ ) {
		if ( events.LP[ i ].namespace == name ) {
			return true;
		}
	}
	return false;
};

const dataToJSON = function dataToJSON() {
	const json = {};
	$.each( this[ 0 ].attributes, function() {
		const m = this.name.match( /^data-(.*)/ );
		if ( m ) {
			json[ m[ 1 ] ] = this.value;
		}
	} );
	return json;
};

const rows = function rows() {
	const h = $( this ).height();
	const lh = $( this ).css( 'line-height' ).replace( 'px', '' );
	$( this ).attr( { height: h, 'line-height': lh } );

	return Math.floor( h / parseInt( lh ) );
};

const checkLines = function checkLines( p ) {
	return this.each( function() {
		const $e = $( this ),
			rows = $e.rows();

		p.call( this, rows );
	} );
};

const findNext = function findNext( selector ) {
	const $selector = $( selector ),
		$root = this.first(),
		index = $selector.index( $root ),
		$next = $selector.eq( index + 1 );
	return $next.length ? $next : false;
};

const findPrev = function findPrev( selector ) {
	const $selector = $( selector ),
		$root = this.first(),
		index = $selector.index( $root ),
		$prev = $selector.eq( index - 1 );
	return $prev.length ? $prev : false;
};

const progress = function progress( v ) {
	return this.each( function() {
		const t = parseInt( v / 100 * 360 ),
			timer = null,
			$this = $( this );

		if ( t < 180 ) {
			$this.find( '.progress-circle' ).removeClass( 'gt-50' );
		} else {
			$this.find( '.progress-circle' ).addClass( 'gt-50' );
		}
		$this.find( '.fill' ).css( {
			transform: 'rotate(' + t + 'deg)',
		} );
	} );
};

$.fn.serializeJSON = serializeJSON;
$.fn.LP_Tooltip = LP_Tooltip;
$.fn.hasEvent = hasEvent;
$.fn.dataToJSON = dataToJSON;
$.fn.rows = rows;
$.fn.checkLines = checkLines;
$.fn.findNext = findNext;
$.fn.findPrev = findPrev;
$.fn.progress = progress;

export default {
	serializeJSON,
	LP_Tooltip,
	hasEvent,
	dataToJSON,
	rows,
	checkLines,
	findNext,
	findPrev,
	progress,
};
