(function(angular){
if($(".chDiscussion").is(":visible")){
  $cont = $(".chDiscussion");
  $cont[0].scrollTop = $cont[0].scrollHeight;
}
// var selectedFiles = [];
app.controller('sendMessageController', function($scope, $http,$compile, $element) {
	 $scope.submitMessageForm = function() {
	 	var message = $scope.message;
	 	var id = $('#userId').val();
    var email = $('#userEmail').val();
    var picture = $('#userPicture').val();
    var fname = $('#userName').val();
    var lname = $('#lastName').val();
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();
	 	$http({
  			method: 'POST',
  			url: '/home/inbox/sendMessage',
  			data: {message: message, id: id}
		}).then(function successCallback(response) {
        var elmhtml = '<div class="chat-message left" style="width:100%" id="leftUserMessage"><img class="message-avatar" src="../../../img/'+picture+'" alt="" style="border-radius: 50%"><div class="message"><a class="message-author" href="#">'+ fname +' '+ lname +'</a><span class="message-date">'+mm+'/'+dd+'/'+yyyy+'</span><span class="message-content" id="messageBox">'+response.data.variable1+'</span></div></div>';
        var el2 = angular.element(elmhtml);
        $compile(el2)($scope);
        elm = $element.find("#showNewMessage");
        // console.log(elm);
        // elm01 = elm.find("#messageBox")
        elm.append(el2);


      //   $(".messInput").val("");
      //   // $( ".chDiscussion" ).load( " .chDiscussion" );
      //   alert(response.data.variable1);
      //   $("#leftUserMessage").find("#messageBox").text(response.data.variable1);
      //   var messageDiv = $("#leftUserMessage");

      //   $(".chDiscussion").css('padding','0px');
      //   $(".chDiscussion").append('<div class="chat-message left" style="width:100%" id="leftUserMessage"><img class="message-avatar" src="../../../img/'+picture+'" alt="" style="border-radius: 50%"><div class="message"> <a class="message-author" href="#">'+ fname +' '+ lname +'</a></span><span class="message-date">'+mm+'/'+dd+'/'+yyyy+'</span><span class="message-content" id="messageBox">'+response.data.variable1+'</span></div></div>');
	    	// // Sending notification
        $cont = $(".chDiscussion");
        $cont[0].scrollTop = $cont[0].scrollHeight;
        // socket.emit('messageNotify', {email: email});


  		}, function errorCallback(response) {
    		alert('ne valja');
  		});
    };
});
})(angular);