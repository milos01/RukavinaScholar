var socket = io('http://localhost:3000');

$('#loginButton').click(function(){
	alert('submitetd');
});
socket.on('news', function (data) {
    console.log(data);
    socket.emit('my other event', { my: 'data' });
});