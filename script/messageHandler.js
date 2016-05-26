"use strict";

$(document).ready(function () {
            var $statusText = $(".msgStatus");
            var $loginText = $(".loginMsg");
            if ($statusText.length || $loginText.length) {
                setTimeout(function () {
                    $statusText.fadeOut();
                    $loginText.fadeOut();
                }, 5000);
            }
        });