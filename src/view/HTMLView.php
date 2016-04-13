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
                        <meta http-equiv='content-type' content='text/html; charset=utf-8' />
                        <script src='//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js'></script>
                    </head>
                    <body>
                        $body
                    </body>
                </html>
        ";
    }
} 