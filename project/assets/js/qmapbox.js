var mapbox = function () {
	var arrCoordinates;
	var arrProperties;
	var token;
	var map;
	var containerId;
	var arrLayers = [];
	var toggleableLayerIds = [];
	var default_style='mapbox://styles/matthiaz/cjivp4t9a8v422sqg0pqvsqbc';
	
	function GenerateRandomString() {
		/* random string generator */
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		return possible.charAt(Math.floor(Math.random() * possible.length));
	}

	function DrawMap() {
		mapboxgl.accessToken = token;
		var features= new Array();
		for(var i=0;i<arrCoordinates.length;i++) {
			features.push({
				 "type": "Feature",
				 "geometry": {
				 "type": "Point",
				 "coordinates": arrCoordinates[i]
				},
				 "properties": arrProperties[i]
			 });
		}
		var geojson = {
			"type": "FeatureCollection",
			"features": features
		};

		var map = new mapboxgl.Map({
			container: containerId,
			style: default_style,
			center: arrCoordinates[0],
			zoom: 10
		});

		// add markers to map
		markercounter=0;
		geojson.features.forEach(function(marker) {

			// create a HTML element for each feature
			var el = document.createElement('div');
			console.log(marker.properties);
			el.className = 'marker ' + (marker.properties.className ? marker.properties.className : '');
			if(marker.properties.dataid) {
				$(el).attr('data-id',marker.properties.dataid);
			}
			// make a marker for each feature and add it to the map
			new mapboxgl.Marker(el)
				.setLngLat(marker.geometry.coordinates)
				.setPopup(new mapboxgl.Popup({offset: 25}) // add popups
					.setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
				.addTo(map);
		});
		
	}
	
	return {
		init: function (strContainer, api_token) {
			containerId = strContainer;
			token = api_token;
		},
		// SetAPI : function(api_token){token = api_token},
		DrawMap: function (arr, _arrProperties) {
			mapbox.AddCoordinates(arr, _arrProperties);
			DrawMap();
		},
		AddCoordinates: function (arr, _arrProperties) {
			arrCoordinates	= [];
			arrProperties	= _arrProperties;
			for (var i = 0; i < arr.length; i++) {
				arrCoordinates.push(arr[i].split(","));
			}

		},
		AddPinsOnMap: function (arr = []) {
			console.log(arr);
			var arrPins = [];
			for (var i = 0; i < arr.length; i++) {
				arrPins.push({
					"type": "Feature",
					"geometry": {
						"type": "Point",
						"coordinates": arr[i].split(",")
					},
					"properties": {
						"description": "<strong>Make it Mount Pleasant</strong><p><a href=\"http://www.mtpleasantdc.com/makeitmtpleasant\" target=\"_blank\" title=\"Opens in a new window\">Make it Mount Pleasant</a> is a handmade and vintage market and afternoon of live entertainment and kids activities. 12:00-6:00 p.m.</p>",
						"icon": "monument"
					}
				});
			}
			return arrPins;
		},
		AddLayer: function (_layerId, color, _arrCoordinates) {
			toggleableLayerIds.push([_layerId, color]);
			arrLayers.push(new Object(
					{
						'id': '' + _layerId + '',
						'type': 'circle',
						"source": {
							"type": "geojson",
							"data": {
								"type": "FeatureCollection",
								"features": mapbox.AddPinsOnMap(_arrCoordinates)
							}
						},
						'layout': {
							'visibility': 'visible'
						},
						'paint': {
							'circle-radius': 8,
							'circle-color': '#' + color + ''
						},
					}
			));
		},
		DrawMapWithPins: function () {
			mapboxgl.accessToken = token;
			map = new mapboxgl.Map({
				container: containerId,
				style: default_style,
				center: arrCoordinates[0],
				zoom: 10
			});

			map.on('load', function () {
				mapbox.AddLayer();
				console.log(arrLayers.filter.length);
				for (var i = 0; i < arrLayers.length - 1; i++) {
					map.addLayer(arrLayers[i]);
				}

			});

			for (var i = 0; i < toggleableLayerIds.length; i++) {
				var id = toggleableLayerIds[i][0];
				var color = toggleableLayerIds[i][1];

				var link = document.createElement('a');
				link.href = '#';
				link.className = 'active';
				link.textContent = id;
				link.style.backgroundColor = '#' + color;

				link.onclick = function (e) {
					var clickedLayer = this.textContent;
					e.preventDefault();
					e.stopPropagation();

					var visibility = map.getLayoutProperty(clickedLayer, 'visibility');

					if (visibility === 'visible') {
						map.setLayoutProperty(clickedLayer, 'visibility', 'none');
						this.className = '';
					} else {
						this.className = 'active';
						map.setLayoutProperty(clickedLayer, 'visibility', 'visible');
					}
				};



				var layers = document.getElementById('menu');
				layers.appendChild(link);


				map.on('click', id, function (e) {
					var coordinates = e.features[0].geometry.coordinates.slice();
					var description = e.features[0].properties.description;

					// Ensure that if the map is zoomed out such that multiple
					// copies of the feature are visible, the popup appears
					// over the copy being pointed to.
					while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
						coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
					}

					new mapboxgl.Popup()
							.setLngLat(coordinates)
							.setHTML(description)
							.addTo(map);
				});

				// Change the cursor to a pointer when the mouse is over the places layer.
				map.on('mouseenter', id, function () {
					map.getCanvas().style.cursor = 'pointer';
				});

				// Change it back to a pointer when it leaves.
				map.on('mouseleave', id, function () {
					map.getCanvas().style.cursor = '';
				});

			}
		}
	};
}();