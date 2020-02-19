var map = tt.map({
	key: 'dgpdrWUnUvnoPXBUzH6GXWDOHaJmBo81',
	container: 'map',
	basePath: 'https://api.tomtom.com/maps-sdk-for-web/5.x/5.20.2/examples/sdk',
	theme: {
		style: 'main',
		layer: 'basic',
		source: 'vector'
		}
	});
map.addControl(new FullscreenControl());
map.addControl(new tt.NavigationControl());
