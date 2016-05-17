<?php

namespace view;
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");*/

class MapView {

	private static $lat = 'lat';
	private static $lng = 'lng';
	private static $comment = 'comment';
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

	public function getMarkerLatitude() {

		if(isset($_POST[self::$lat]))
		{
			return trim($_POST[self::$name]);
		}
		return "";
	}
}