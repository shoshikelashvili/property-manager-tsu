function redirect()
{
	var url = window.location.href;
	url = url.slice(0, -1);
	var to = url.lastIndexOf('/');
	to = to == -1 ? url.length : to + 1;
	url = url.substring(0, to);
	console.log('url', url);
	window.location.replace(url)
}

document.addEventListener( 'DOMContentLoaded', function () {
	new Splide( '#image-slider', {
		'cover'      : true,
		'heightRatio': 0.8,
        rewind   : true,
        height   : '50rem',
        width: '80rem'
	} ).mount();
} );