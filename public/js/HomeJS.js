(function (angular) {
socket = io('http://localhost:3000');
function init(){
	$.ajax({
	  url: '/home/api/application/user',
	  method: 'GET',
	  success: function(res){
	  	socket.emit('homeLoad', {email: res.email});
	  }
	});
}

// angular.module('kbkApp').controller('testController', function($scope){
	
// 	$scope.clickTest = function(){
// 		socket.emit('messageNotify', {email: 'milosa942@gmail.com'});
// 	}
	socket.on('updateProblemStatsEmit',function(data){
		toastr.success('You have new offer for task!', 'Rukhell')
	});
// });


init();
})(angular);