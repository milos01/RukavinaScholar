if ($("#alarm").is(":visible")) { 
	$("#alarm").delay(1800).fadeOut(500);
}
var $cont = $(".chDiscussion");
$cont[0].scrollTop = $cont[0].scrollHeight;
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
  			url: '/home/inbox/sendMessage',
  			data: {message: message, id: id}
		}).then(function successCallback(response) {
        $(".messInput").val("");
        // $( ".chDiscussion" ).load( " .chDiscussion" );
        $("#leftUserMessage").find("#messageBox").text(response.data.variable1);
        var messageDiv = $("#leftUserMessage");
        $(".chDiscussion").css('padding','0px');
        $(".chDiscussion").append(messageDiv);
	    	// var res = JSON.stringify(response.data);
	    	// alert(res);
  		}, function errorCallback(response) {
    		alert('ne valja');
  		});
    };
});