(function(angular){
	"use strict";
	app.factory('Socket', function(socketFactory){
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
		    }
	   };
	});
})(angular);