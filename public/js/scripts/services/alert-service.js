(function(){
	app.factory('alertSerice', function() {
	    return {
	        successSweet: function(title, type, text) {
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