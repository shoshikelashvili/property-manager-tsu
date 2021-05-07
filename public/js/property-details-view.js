document.addEventListener( 'DOMContentLoaded', function () {
	new Splide( '#image-slider', {
		'cover'      : true,
		'heightRatio': 0.8,
        rewind   : true,
        height   : '50rem',
        width: '80rem'
	} ).mount();
} );