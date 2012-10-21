/*
 * 	Creates Google Map Objects
 *
 *	@framework	Google Map | JQuery
 *	@author		Kenneth "digiArtist_ph" P. Vallejos
 *	@since		Sunday, December 4, 2011
 *	@version	1.3
 *
 *
 *		Instructions:
 *			The following are scripts that are required:
 *				1. jQuery 1.6 and higher
 *				2. googlemap.query.js (custom jquery plugin -- written by Kenneth "digiArtist_ph" P. Vallejos)
 *				3. //maps.googleapis.com/maps/api/js?sensor=false -- Google Map API
 *				4. CSS -- to style your map container object (e.i. <div id="map_canvas"></div>)
 *
 *			Code Sample:
 *				$('#map_canvas').googlemap(r, 'New Castle, Australia', 'http://localhost/map/images/markers');
 *			
 *			Plugin BNF Grammar:
 *				$('[map object conatiner]').google('[serps object]', '[default address (city, address)]', '[icon markers path]');
 *
 *
 *		{Plain HTML+Php}
 *			>> googlemap.php <<
 *		<?php
 *			$data = array(
 *						'0' => array(
 *	
 *										'name' => 'Kenneth P. Vallejos',
 *										'address' => 'Cagayan de Oro City, Philippines'
 *									),
 *						'1' => array(
 *										'name' => 'Myla M. Vallejos',
 *										'address' => 'Iligan City, Philippines'
 *									),
 *						'2' => array(
 *										'name' => 'Megan M. Vallejos',
 *										'address' => 'Butuan City, Philippines'
 *									)
 *					);				
 *					
 *		?>
 *		<!DOCTYPE HTML>
 *		
 *			--- some html blocks here ----
 *			<script type="text/javascript" src="js/jquery.js"></script> <! REQUUIRED -->
 *			<script type="text/javascript" src="js/googlemap.query.js"></script> <! REQUUIRED -->
 *			<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script> <! REQUUIRED -->
 *			<script type="text/javascript"> <! REQUUIRED -->
 *				$(function(){
 *					<?php echo isset($data) ?'var r = ' . json_encode($data) . ';' : 'var r = {}'; ?>
 *
 *					$('#map_canvas').googlemap(r, 'New Castle, Australia');
 *				});
 *			</script>
 *			
 *				--- some html blocks here ----
 *				
 *			<body>
 *				<div id="map_canvas"></div>
 *			</body>
 *		</html>
 *
 *
 *
 *
 *
 */
(function($){
	
	/*
	 *	This generates the Google Map Marker Icons on the map
	 *	
	 */	
	$.fn.googlemap = function(serps, defaultMap, iconPath) {
			serps = serps || {};
			defaultMap = defaultMap || "";
			iconPath = iconPath || '';
			iconPath = iconPath != "" ? iconPath : "./images/markers";
			var geocoder;
			var map;
			var cntr = 0;
			var arrMarker = [];
			var mWindow;
			
		return this.each(function(){
					
			var initializeMap = function(mapContainer) {
				geocoder = new google.maps.Geocoder(); // initializes very important google map component
												
				var latlng = new google.maps.LatLng(-34.397, 150.644);
				
				var myOptions = {
				  zoom: 15,
				  center: latlng,
				  mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				
				map = new google.maps.Map(mapContainer, myOptions);								
				
				if(serps.length < 1  || serps.length == undefined) {
					geocoder.geocode({address: defaultMap}, function(results, status) {
						if(status == google.maps.GeocoderStatus.OK) {
							map.setCenter(results[0].geometry.location);
							map.setZoom(18);
						}
					});
				} 	
			}
			
			var codeAddress = function() {
							
				for(n in serps/*arrAddress*/) {
					
					geocoder.geocode({address: serps[n].address}, function(results, status){							
							if(status == google.maps.GeocoderStatus.OK) {
								
								var image = new google.maps.MarkerImage(
											  iconPath + '/marker' + (cntr+1) + '.png',
											  new google.maps.Size(48, 58),
											  new google.maps.Point(0, 0),
											  new google.maps.Point(10, 34)
											  );
								
								map.setCenter(results[0].geometry.location);
								
								var aMarker = new google.maps.Marker({
									map: map,
									position: results[0].geometry.location,
									title: (cntr + 1).toString(),
									icon: image
								});
								
								goGeoCode(aMarker, cntr, serps[n].name);
								arrMarker[cntr] = aMarker;
								
							} else {
								//alert("Geocode was not successful for the following reason: " + status);
							}
							cntr++;
						});
				}
						
			}
			
			var goGeoCode = function(marker, number, address) {
				var nWindow = new google.maps.InfoWindow({content: '<div class="contentWindow"><span class="name">' + serps[number].name + '</span><br />' + serps[number].address + '<br />' + serps[number].country + '</div>'} );
											
				google.maps.event.addListener(marker, 'click', function() {
					nWindow.open(map, marker);
				});
				
				google.maps.event.addListener(marker, 'closeclick', function() {
					nWindow.close(map, marker);
				});
				
				nWindow.open(map, marker); // @neerevisit: auto open the info window on google map.
			}
	
			// calls some methods
			initializeMap(this);			
			codeAddress();


			
	});	
}	


})(jQuery);
