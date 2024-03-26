<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if ( is_user_logged_in() ) { ?>
			<!-- <a class="front_log_out" id="wp-logout" href="<?php echo wp_logout_url_custom() ?>"><?php esc_html_e( 'Log Out' ,'login-with-ajax') ?></a> -->
		<?php } ?>
	</header><!-- .entry-header -->



	<div class="entry-content _row">
		<div class="_col-6 acf_form_wrap">
			<?php
				// Bail if not logged in or able to post
				if ( ! ( is_user_logged_in()|| current_user_can('publish_posts') ) ) {
					echo '<p>'. __('Для добавления нового места вам нужно зарегистрироваться.', 'free4rest'). '</p>';
					echo do_shortcode('[login-with-ajax]');
					return;
				} else { 

				     acf_form(array(
				         'post_id' => 'new_post',
				         'field_groups' => array(38), // Used ID of the field groups here. array(188,167) 268
				         'post_title' => true, // This will show the title filed
				         'post_content' => false, // This will show the content field
				         'form' => true,
				         'new_post' => array(
				             'post_type' => 'place',
				             'post_status' => 'draft' // You may use other post statuses like draft, private etc.
				         ),
				         //'return' => home_url('thank-you'),
				         'submit_value' => __('Add Place', 'free4rest'),
				         'uploader' => 'wp', //'basic'
				         //'label_placement' => 'left',
				         'html_before_fields' => '
													<!-- add a marker using the map -->
														<div id="map-marker" data-mode="" style="height:300px;margin: 15px 0;">
														    <input type="hidden" data-map-markers="" value="" name="map-geojson-data" />
														</div>
														<div>
														 	<input class="append-markers button-admin" type="button" value="View on map" />
														    <input class="get-markers button-admin" type="button" value="Get the Marker from map" />
														</div>
													<!-- end -->
												',
				     ));	

				   ?>



				   <?php			
				}

			?>
		</div>


	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->



<?php 
		$plugin_public = new Locate_Anything_Public(null, null);      
    	$plugin_public->enqueue_scripts();
        $plugin_public->enqueue_styles();

?> 


<!-- add a marker using the map -->
<script>
	jQuery(document).ready(function($){

	  // We’ll add a OSM tile layer to our map
	  var osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
	      osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	      osm = L.tileLayer(osmUrl, {
	          maxZoom: 18,
	          attribution: osmAttrib
	      });


	  // initialize the map on the "map" div with a given center and zoom
	  var map = L.map('map-marker').setView([49.68185, 30.57495], 5).addLayer(osm);
	  var markersLayer = new L.LayerGroup(); // NOTE: Layer is created here!
	  markersLayer.addTo(map);
	  
	  //console.log($("input[name='locate-anything-lat']").val() );
	  //console.log($("input[name='locate-anything-lon']").val());
	  
	  //init marker
	  // if( $("input[name='locate-anything-lat']").val() || $("input[name='locate-anything-lon']").val() ) {
	  // 	initMarker();
	  // }
	  $('.append-markers').click(function(event) {
	  		//if( $('#acf-field_5b854a3d60cd8').val() || $('#acf-field_5b854a8760cd9').val() ) {
	  		if( $('.acf-field[data-name="free4rest_front_lat"] input').val() || $('.acf-field[data-name="free4rest_front_lon"] input').val() ) {
	  			markersLayer.clearLayers();
	  			initMarker();
	  		}
	  });

	  // attaching function on map click
	  map.on('click', onMapClick);

		function initMarker() {
					
					

				  // var input_lat = $('#acf-field_5b854a3d60cd8').val();
				  // var input_lon = $('#acf-field_5b854a8760cd9').val();

				  var input_lat = $('.acf-field[data-name="free4rest_front_lat"] input').val();
				  var input_lon = $('.acf-field[data-name="free4rest_front_lon"] input').val();

				  var geojsonFeature = {
			          "type": "Feature",
			              "properties": {},
			              "geometry": {
			                  "type": "Point",
			                  "coordinates": [input_lat, input_lon]
			          }
			      }

			      var marker;

			      

			      L.geoJson(geojsonFeature, {
			          
			          pointToLayer: function(feature, latlng){
			              
			              marker = L.marker([input_lat, input_lon], {
			                  
			                  title: "Resource Location",
			                  alt: "Resource Location",
			                  riseOnHover: true,
			                  draggable: true,

			              }).bindPopup("<input type='button' value='Delete this marker' class='marker-delete-button'/>");

			              marker.on("popupopen", onPopupOpen);

			         	  markersLayer.addLayer(marker);

			              return marker;
			          }
			      }).addTo(map);

			     

		}

	  // Script for adding marker on map click
	  function onMapClick(e) {
	  	 markersLayer.clearLayers();
	      var allMarkersObjArray = [];//new Array();
	      var allMarkersGeoJsonArray = [];//new Array();

	  	$.each(map._layers, function (ml) {
	          //console.log(map._layers)
	          if (map._layers[ml].feature) {
	              
	              allMarkersObjArray.push(this)
	                                      allMarkersGeoJsonArray.push(JSON.stringify(this.toGeoJSON()))
	          }
	    });
	    //console.log(allMarkersGeoJsonArray.length);

		if(allMarkersGeoJsonArray.length == 0) {

	      var geojsonFeature = {
	          "type": "Feature",
	              "properties": {},
	              "geometry": {
	                  "type": "Point",
	                  "coordinates": [e.latlng.lat, e.latlng.lng]
	          }
	      }

	      var marker;

	      L.geoJson(geojsonFeature, {
	          
	          pointToLayer: function(feature, latlng){
	              
	              marker = L.marker(e.latlng, {
	                  
	                  title: "Resource Location",
	                  alt: "Resource Location",
	                  riseOnHover: true,
	                  draggable: true,

	              }).bindPopup("<input type='button' value='Delete this marker' class='marker-delete-button'/>");

	              marker.on("popupopen", onPopupOpen);
	         	markersLayer.addLayer(marker);
	              return marker;
	          }
	      }).addTo(map);

	    }//end if

	  }


	  // Function to handle delete as well as other events on marker popup open
	  function onPopupOpen() {

	      var tempMarker = this;

	      //var tempMarkerGeoJSON = this.toGeoJSON();

	      //var lID = tempMarker._leaflet_id; // Getting Leaflet ID of this marker

	      // To remove marker on click of delete
	      $(".marker-delete-button:visible").click(function () {
	          map.removeLayer(tempMarker);
	      });
	  }


	  // getting all the markers at once
	  function getAllMarkers() {
	      
	      var allMarkersObjArray = [];//new Array();
	      var allMarkersGeoJsonArray = [];//new Array();

	      $.each(map._layers, function (ml) {
	          //console.log(map._layers)
	          if (map._layers[ml].feature) {
	              
	              allMarkersObjArray.push(this)
	                                      allMarkersGeoJsonArray.push(JSON.stringify(this.toGeoJSON()))
	          }
	      })

	      console.log(allMarkersObjArray);
	      //alert("total Markers : " + allMarkersGeoJsonArray.length + "\n\n" + allMarkersGeoJsonArray + "\n\n Also see your console for object view of this array" );
	  	
	  	if(allMarkersGeoJsonArray.length>0){
			//$(this).parent().parent().find("input[name='locate-anything-lat']").val( allMarkersObjArray[0]['_latlng']['lat'] );
			//$(this).parent().parent().find("input[name='locate-anything-lon']").val( allMarkersObjArray[0]['_latlng']['lng'] );
			
			//$('#acf-field_5b854a3d60cd8').val( allMarkersObjArray[0]['_latlng']['lat'] );
			//$('#acf-field_5b854a8760cd9').val( allMarkersObjArray[0]['_latlng']['lng'] );

			$('.acf-field[data-name="free4rest_front_lat"] input').val( allMarkersObjArray[0]['_latlng']['lat'] );
			$('.acf-field[data-name="free4rest_front_lon"] input').val( allMarkersObjArray[0]['_latlng']['lng'] );

	  	}




	  }

	  $(".get-markers").on("click", getAllMarkers);

	}); 
</script>   
