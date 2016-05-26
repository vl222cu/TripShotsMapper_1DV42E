<?php

namespace view;

class HTMLView {

    public function showHTML($title, $body) {

        if($body === NULL) {

            throw new \Exception("HTMLView::showHTML does not allow body to be null");
        }

        echo "
                <!DOCTYPE html>
                <html lang='en'>
                    <head>
                        <title>$title</title>
                        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css' />
                        <link rel='stylesheet' href='css/mainstyle.css' media='screen' />
                        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css'>
                        <link href='https://fonts.googleapis.com/css?family=Happy+Monkey' rel='stylesheet' type='text/css'>
                        <meta http-equiv='content-type' content='text/html; charset=utf-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                    </head>
                    <body>
                        <h1 class='text-center'>TripShotsMapper</h1>
                        $body
                        <script src='//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js'></script>
                        <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
                        <script src='//cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.3/jquery.xdomainrequest.min.js'></script>
                        <script src='//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js'></script>
                        <script src='./script/messageHandler.js'></script>
                    </body>
                </html>
        ";
    }
} 