<?php

namespace view;
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");*/

class StartView {

	public function showStartView() {

		$html = " 	<nav class='navbar navbar-default navbar-custom'>
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
                                	<li><a href='?loginsignuppage'><span class='glyphicon glyphicon-log-in'></span> Login | <span class='glyphicon glyphicon-user'></span> Sign up</a></li>
                            	</ul>
                        	</div>
                       	</div>
                    </nav>
                    <div class='container'><h2>Tanken är att ha någon slags bild här på startsidan</h2></div>";
		
		return $html;
	}
}