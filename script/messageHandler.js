"use strict";

// functions for fading out messages
function init() {
	$(document).ready(function () {
        var $statusText = $(".msgStatus");
        var $loginText = $(".loginMsg");
        var $sessionText = $(".sessionMsg");
        if ($statusText.length || $loginText.length || $sessionText.length) {
            setTimeout(function () {
                $statusText.fadeOut();
                $loginText.fadeOut();
                $sessionText.fadeOut();
            }, 5000);
        }
    });
}

function messages(msg) {
    $(document).ready(function () {
        $('#mapmsg').text(msg);
        var $message = $('#mapmsg');
        $message.fadeIn();
        if ($message.length) {
            setTimeout(function () {
                $message.fadeOut();
            }, 5000);
        }
    });
}

window.onload = init();