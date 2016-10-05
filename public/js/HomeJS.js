socket = io('http://localhost:3000');
function init(){
	$.ajax({
	  url: '/home/api/application/getuser',
	  method: 'GET',
	  data: {} ,
	  success: function(res){
	  	socket.emit('homeLoad', {email: res.email});
	  }
	});
}
init();
app.controller('testController', function($scope){
	$scope.clickTest = function(){
		socket.emit('messageNotify', {email: 'jon@gmail.com'});
	}
});
socket.on('newMessageN',function(data){
	alert('fuck.');
});