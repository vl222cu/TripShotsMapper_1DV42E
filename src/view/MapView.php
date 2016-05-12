<?php

namespace view;

class MapView {

	public function showMapView() {

		$html = "	
					<nav class='navbar navbar-default navbar-custom'>
                        <div class='container'>
                            <div class='navbar-header'>
                                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavBar'>
                                    <span class='sr-only'>Toggle navigation</span>
                                    <span class='icon-bar'></span>
                                    <span class='icon-bar'></span>
                                    <span class='icon-bar'></span>
                                </button>
                            </div>
                        	<div class='collapse navbar-collapse' id='myNavBar'>
                            	<ul class='nav navbar-nav navbar-right'>
                                	<li><a href='?logout'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
                            	</ul>
                        	</div>
                       	</div>
                    </nav>
					<div id='map-canvas'></div>
					<script type='text/javascript'src='https://maps.googleapis.com/maps/api/js?key=AIzaSyABwLvv5aTCn-nOShcBUzDhUstxjRIR5gc'></script>
					<script src='./script/marker.js'></script>
		";

		return $html;
	}

	public function fetchAction($name) {

        $val = isset($_POST[$name]) ? $_POST[$name] : "";

        return strip_tags(trim($val));
    }
}