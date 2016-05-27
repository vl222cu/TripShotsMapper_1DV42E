<?php

namespace view;

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
                    <div class='container'>
                        <div id='imgContainer'>
                        <img class='img-responsive img-rounded' src='./pics/cover.jpg' alt='cover' id='cover'/></div>
                        </div>
                    </div>
        ";   

		return $html;
	}
}