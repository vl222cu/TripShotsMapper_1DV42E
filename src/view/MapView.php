<?php

namespace view;

class MapView {

	private static $lat = 'lat';
	private static $lng = 'lng';
	private static $comment = 'comment';
	private $message = "";
	const MESSAGE_ERROR_GET_ALL_MARKERS = 'Something went wrong! Please logout and try a new session';
	const MESSAGE_SUCCSESS_GET_ALL_MARKERS = 'All your markers are successfully shown';
	const MESSAGE_ERROR_SAVE_MARKER = 'Something went wrong! The marker has not been saved.Please logout and try a new session';
	const MESSAGE_SUCCESS_SAVE_MARKER = 'The marker is successfully saved';
	const MESSAGE_ERROR_DELETE_MARKER = 'Something went wrong! The marker has not been deleted. Please logout and try a new session';
	const MESSAGE_SUCCESS_DELETE_MARKER = 'The marker is successfully deleted';

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
                                	<li><a href='ActionHandler.php?action=logout'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
                            	</ul>
                        	</div>
                       	</div>
                    </nav>
                    <div class='container'>
	                    <div id='infotext'>Click on the map to add a new marker, drag and drop it wherever you like. If you want to remove a marker, just right-click on the marker. For editing, saving and deleting markers, just click on the marker. Enjoy!
	                    </div>
                    </div>
        ";

        if($this->getMapMessage() !== null) {

			$html .= "<div class='mapmsg'>$this->message</div>";

		};

		$html .="	<div id='map-canvas'></div>
					<script type='text/javascript'src='https://maps.googleapis.com/maps/api/js?key=AIzaSyABwLvv5aTCn-nOShcBUzDhUstxjRIR5gc'></script>
					<script src='./script/marker.js'></script>
		";

		return $html;
	}

	public function getMapMessage() {

		return $this->message;
	}

	public function setMapMessage($msg) {

		$this->message = '<p>' . $msg . '</p>';
	}
}