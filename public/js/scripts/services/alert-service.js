(function(){
	app.factory('AlertSerice', function() {
	    return {
	        sweet: function(title, type, text) {
	            swal({
	              title: title,
	              text: text,
	              type: type,
	              timer: 1500,
	              showConfirmButton: false
	            });
	        }
	    };
	});
})(angular);