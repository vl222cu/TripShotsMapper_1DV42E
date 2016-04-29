<?php

namespace view;

class MapView {

	public function showMapView() {

		$html = "	
					<div id='map-canvas'></div>
					<script type='text/javascript'src='https://maps.googleapis.com/maps/api/js?key=APIKEY'></script>
					<script src='./src/js/addMarker.js'></script>
		";

		return $html;
	}
}