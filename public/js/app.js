if ($("#alarm").is(":visible")) { 
	$("#alarm").delay(1800).fadeOut(500);
}

var app = angular.module('kbkApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
 });

app.controller('sendMessageController', function($scope, $http ) {
	 $scope.submitMessageForm = function() {
	 	var message = $scope.message;
	 	var id = $('#userId').val();
    console.log(id);
	 	$http({
  			method: 'POST',
  			url: '/home/admin/inbox/sendMessage',
  			data: {message: message, id: id}
		}).then(function successCallback(response) {
	    	var res = JSON.stringify(response.data);
	    	alert(res);
  		}, function errorCallback(response) {
    		alert('ne valja');
  		});
    };
});