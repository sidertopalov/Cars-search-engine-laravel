$(function(){
	
	//Slider
	$( ".slider-range" ).slider({
		range: true,
		min: 0,
		max: 200000,
		step: 1000,
		values: [ 20000, 120000 ],
		slide: function( event, ui ) {
        	$( ".slider_amount" ).val( "BGN " + ui.values[ 0 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "- BGN " + ui.values[ 1 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
      	},
      	change: function(event, ui) {
			sendAjax();
      	}
    });
    $( ".slider_amount" ).val( "BGN " + $( ".slider-range" ).slider( "values", 0 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " - BGN " + $( ".slider-range" ).slider( "values", 1 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );

	$("form").change(function(e){
		sendAjax();
	});

    function sendAjax() {
    	var url = "/cars/search";

		$.ajax({
			url: url,
			type: "POST",
			data: $("form").serialize(),
			dataType: "json",
			beforeSend: function (xhr) {
				// Function needed from Laravel because of the CSRF Middleware
				var token = $('meta[name="csrf_token"]').attr('content');
				if (token) {
					return xhr.setRequestHeader('X-CSRF-TOKEN', token);
				}
			},
			success: function(data){
					$('#carsCount').text(data['count']);
			}
		});
    };
});

