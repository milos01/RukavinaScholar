
var app = angular.module('kbkApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
 });
// var $cont = $(".chDiscussion");
// $cont[0].scrollTop = $cont[0].scrollHeight;
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

$(document).mouseup(function (e)
{
    var container = $("#responseDiv");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $("#responseDiv").hide();
    }
});

app.controller('userSearchController',function($scope, $compile, $http, searchService){ 
    var problemId = $("#problemId").val();
    $scope.search = function(){

        searchService.search($scope.keywords).then(function(response){
            $("#responseDiv").text("");

            $("#responseDiv").fadeIn(150);
            if(response.data.length === 0){
                $("#responseDiv").html("<div style='padding-top:6px;padding-bottom:6px;text-align:center'>No result found</div>");
            }else{
              for (var i = response.data.length - 1; i >= 0; i--) {
                  
                  var divDiv = "<div style='padding-top:6px;padding-bottom:6px' ng-click='addMateFunction("+response.data[i].id+","+problemId+")'>"+response.data[i].name+" "+response.data[i].lastName+"</div>";
    
                  angular.element(document.getElementById('responseDiv')).append($compile(divDiv)($scope));
                  $scope.addMateFunction = function(userId, problemId){
                      $http({
                          method: 'POST',
                          url: '/home/api/application/addModerator',
                          data: {userId: userId, problemId: problemId}
                      }).then(function successCallback(response) {
                          alert("sve ok");
                      }, function errorCallback(response) {
                          alert('ne valja');
                      });
                  };
                  
              }
            };
        });
    };

  

});

app.service('searchService', function($http){
    return {
        search: function(keywords){
            console.log(keywords);
            
            return $http.post('/home/api/application/getusers', { "username" : keywords });
        }
    }
});