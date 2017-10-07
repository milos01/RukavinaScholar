(function(angular){
	"use strict";
	app.factory('Socket', function(UserResource, socketFactory){
	  	var IoSocket = io.connect('http://localhost:3000');
	  	var socket = socketFactory({
	    	ioSocket: IoSocket
	  	});

	   return {
			on: function(eventName, callback){
		      socket.on(eventName, callback);
		    },
		    emit: function(eventName, data) {
		      socket.emit(eventName, data);
		    },
		    connectUser: function(){
		    	UserResource.getLoggedUser().then(function(user){
		    		socket.emit('connect-user', {email: user.email});
		    	});
		    },
		    forward: function(eventName, scope){
		    	socket.forward(eventName, scope);
		    }
	   };
	});
})(angular);