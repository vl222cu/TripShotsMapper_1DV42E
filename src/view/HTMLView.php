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
                        <link rel='stylesheet' href='css/mainstyle.css' media='screen' />
                        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
                        <meta http-equiv='content-type' content='text/html; charset=utf-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                    </head>
                    <body>
                        $body
                        <script src='//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js'></script>
                        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>
                    </body>
                </html>
        ";
    }
} 