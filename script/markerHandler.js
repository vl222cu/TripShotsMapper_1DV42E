function MarkerHandler() {

	this.getMarker = function(callback) {

		var that = this;
		var comment = null;

		$.ajax ({
            type: "GET",
            url: "src/controller/MapController.php",
            contentType: "application/xml; charset=utf-8",
            dataType: 'xml',
            data: {
                mode: 'get'
            },
            cache: false,
            success: function (data) {

                if (data.result) {

                    callback(data);
                }
            },

             error: function(e) {

                console.log(e);
            }
        }); 
	};
};

var markerHandler = new MarkerHandler();