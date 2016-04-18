<?php

namespace view;

class HTMLView {

    public function showHTML($title, $body) {

        if($body === NULL) {

            throw new \Exception("HTMLView::showHTLM does not allow body to be null");
        }

        echo "
                <!DOCTYPE html>
                <html>
                    <head>
                        <title>$title</title>
                        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
                        <link rel='stylesheet' href='css/mainstyle.css' media='screen' />
                        <meta http-equiv='content-type' content='text/html; charset=utf-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                    </head>
                    <body>
                    <h1 class='text-center'>TripShotsMapper</h1>
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
                                        <li><a href='#'><span class='glyphicon glyphicon-log-in'></span>Sign In</a></li>
                                        <li><a href='#'><span class='glyphicon glyphicon-user'></span>Sign up</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <div class='container'>
                            $body
                        </div>
                        <script src='//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js'></script>
                        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>
                    </body>
                </html>
        ";
    }
} 