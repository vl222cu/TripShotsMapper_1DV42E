<?php

namespace view;

class MapView {

	private $mapModel;
	private static $lat = 'lat';
	private static $lng = 'lng';
	private static $comment = 'comment';
	private $message = '';

	public function __construct(\model\MapModel $mapModel) {
		
		$this->mapModel = $mapModel;
	}

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
                    <div id='messageWrapper'>
                		<p id='mapmsg'></p>
            		</div>
        ";

        if($this->getMessage() !== null) {

			$html .= "<div class='sessionMsg'>$this->message</div>";

		};

		$html .="	<div id='map-canvas'></div>
					<script type='text/javascript'src='https://maps.googleapis.com/maps/api/js?key=AIzaSyABwLvv5aTCn-nOShcBUzDhUstxjRIR5gc'></script>
					<script src='./script/marker.js'></script>
		";

		return $html;
	}

	public function getMessage() {

		return $this->message = $this->mapModel->getSessionMessage();
     
    }
}