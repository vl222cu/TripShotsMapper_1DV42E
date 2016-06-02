<?php

namespace view;

class ErrorPageView {

    public function showErrorHTML() {

    $html = "   <nav class='navbar navbar-default navbar-custom'>
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
                        <div class='row row-centered'>
                            <div class='col-md-12 col-xs-12 col-centered'>
                                Oops! We can't seem to find the page you're looking for. Not to worry! You can head back to <a href='ActionHandler.php?action=return'>the map</a>. 
                            </div>
                        </div>               
                    </div>
        ";   

        return $html;
    }
} 