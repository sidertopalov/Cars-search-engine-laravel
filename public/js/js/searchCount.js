$("form").change(function(e){
	var url = "/cars/search";
	var data = $(this).serialize();

	$.ajax({
		url: url,
		type: "POST",
		data: $(this).serialize(),
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
	e.preventDefault();
});