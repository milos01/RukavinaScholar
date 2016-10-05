
var app = angular.module('kbkApp', ['ngAnimate'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
        
 });
// socket = io('http://localhost:3000');
if($(".chDiscussion").is(":visible")){
  $cont = $(".chDiscussion");
  $cont[0].scrollTop = $cont[0].scrollHeight;
}
var selectedFiles = [];
app.controller('sendMessageController', function($scope, $http ) {
	 $scope.submitMessageForm = function() {
	 	var message = $scope.message;
	 	var id = $('#userId').val();
    var email = $('#userEmail').val();
    var picture = $('#userPicture').val();
    var fname = $('#userName').val();
    var lname = $('#lastName').val();
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    console.log(id);
	 	$http({
  			method: 'POST',
  			url: '/home/inbox/sendMessage',
  			data: {message: message, id: id}
		}).then(function successCallback(response) {
        $(".messInput").val("");
        // $( ".chDiscussion" ).load( " .chDiscussion" );
        alert(response.data.variable1);
        $("#leftUserMessage").find("#messageBox").text(response.data.variable1);
        var messageDiv = $("#leftUserMessage");

        $(".chDiscussion").css('padding','0px');
        $(".chDiscussion").append('<div class="chat-message left" style="width:100%" id="leftUserMessage"><img class="message-avatar" src="../../../img/'+picture+'" alt="" style="border-radius: 50%"><div class="message"> <a class="message-author" href="#">'+ fname +' '+ lname +'</a></span><span class="message-date">'+mm+'/'+dd+'/'+yyyy+'</span><span class="message-content" id="messageBox">'+response.data.variable1+'</span></div></div>');
	    	// Sending notification
        $cont = $(".chDiscussion");
        $cont[0].scrollTop = $cont[0].scrollHeight;
        // socket.emit('messageNotify', {email: email});
        

  		}, function errorCallback(response) {
    		alert('ne valja');
  		});
    };
});

// socket.on('newMessageN', function (data) {
//           console.log("radiiiiiii");
//           $('#mailBox').append('<div id="redDot" style="border-radius: 50%;padding: 2px 2px;width:10px;height:10px;background: red;font-size: 10px; position: absolute; left:33px;top:13px;color:white"></div>');
//           toastr.options = {
//             "closeButton": true,
//             "debug": true,
//             "progressBar": true,
//             "preventDuplicates": true,
//             "positionClass": "toast-top-right",
//             "onclick": null,
//             "showDuration": "400",
//             "hideDuration": "1000",
//             "timeOut": "4000",
//             "extendedTimeOut": "1000",
//             "showEasing": "swing",
//             "hideEasing": "linear",
//             "showMethod": "fadeIn",
//             "hideMethod": "fadeOut"
//           }
//           toastr.success('You have new message')
//         });




app.directive('capitalizeFirst', function($parse) {
   return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
        var capitalize = function(inputValue) {
           if (inputValue === undefined) { inputValue = ''; }
           var capitalized = inputValue.charAt(0).toUpperCase() +
                             inputValue.substring(1);
           if(capitalized !== inputValue) {
              modelCtrl.$setViewValue(capitalized);
              modelCtrl.$render();
            }         
            return capitalized;
         }
         modelCtrl.$parsers.push(capitalize);
         capitalize($parse(attrs.ngModel)(scope)); // capitalize initial value
     }
   };
});

app.directive('passwordLength', function($timeout, $q, $http){
  return {
  require: 'ngModel',
  link: function(scope, elm, attr, model) {
            model.$asyncValidators.passwordLen = function() {
                console.log(model.$viewValue.length);
                if(model.$viewValue.length >= 4 && model.$viewValue.length <= 10){
                  model.$setValidity('passlen', true);
                  return $q.resolve();
                }else{
                  model.$setValidity('passlen', false);
                  return $q.reject();
                }
            };
        }
  }
});



app.directive("passwordVerify", function() {
    return {
        require: "ngModel",
        scope: {
            passwordVerify: '='
        },
        link: function(scope, element, attrs, ctrl) {
            scope.$watch(function() {
                var combined;

                if (scope.passwordVerify || ctrl.$viewValue) {
                    combined = scope.passwordVerify + '_' + ctrl.$viewValue;
                }
                return combined;
            }, function(value) {
                if (value) {
                    ctrl.$parsers.unshift(function(viewValue) {
                        var origin = scope.passwordVerify;
                        if (origin !== viewValue) {
                            ctrl.$setValidity("passwordVerify", false);
                            return undefined;
                        } else {
                            ctrl.$setValidity("passwordVerify", true);
                            return viewValue;
                        }
                    });
                }
            });
        }
    };
});

$(document).mouseup(function (e)
{
    var container = $("#responseDiv");
    var container2 = $("#responseDiv2");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0 || !container2.is(e.target) // if the target of the click isn't the container...
        && container2.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $("#responseDiv").hide();
        $("#responseDiv2").hide();
    }
});

app.controller('userSearchController',function($scope, $compile, $http, searchService, searchService2){ 
    var problemId = $("#problemId").val();
    $scope.search = function(){

        searchService.search($scope.keywords).then(function(response){
          console.log(response.data);
          if( !$("#searchInput").val() ){
              $("#responseDiv").hide();
            }else{
            $("#responseDiv").text("");

            $("#responseDiv").fadeIn(150);
            if(response.data.length === 0){
                $("#responseDiv").html("<div style='padding-top:6px;padding-bottom:6px;text-align:center'>No result found</div>");
            }else{
              for (var i = response.data.length - 1; i >= 0; i--) {
                  
                  var divDiv = "<div style='padding:10px' class='searchResults' ng-click='addMateFunction("+response.data[i].id+","+problemId+")'>"+response.data[i].name+" "+response.data[i].lastName+"</div>";
    
                  angular.element(document.getElementById('responseDiv')).append($compile(divDiv)($scope));
                  $scope.addMateFunction = function(userId, problemId){
                      $http({
                          method: 'POST',
                          url: '/home/api/application/addModerator',
                          data: {userId: userId, problemId: problemId}
                      }).then(function successCallback(response) {
                          console.log(response.data);
                          // var item = $("#menuSearchItem").text("aa");
                          $("#itemsHolder").append("<div class='' id='menuSearchItem"+userId+"plus"+problemId+"' style='border-bottom:2px solid red;max-width: 100px;height: 33px;background-color: #F3F3F4;border-radius: 3px; text-align: center;padding-top: 7px;float: left;margin-left: 10px;padding-left: 5px;padding-right:5px'>"+response.data.name +" "+response.data.lastName+"<div id='iks' style='float:right;margin-left:2px'></div></div>");
                        var html="<i class='fa fa-times' aria-hidden='true' style='cursor:pointer' ng-click='deleteWorker("+problemId+", "+userId+")'></i>" ;
                        angular.element(document.getElementById('iks')).append($compile(html)($scope));

                      }, function errorCallback(response) {
                          alert('ne valja');
                      });
                  };
                  
              }
            };
          }
        });
    };

    $scope.search2 = function(){
            
        searchService2.search($scope.keywords).then(function(response){
          console.log(response.data);
            if( !$("#top-search").val() ){
              $("#responseDiv2").hide();
            }else{

            $("#responseDiv2").text("");

            $("#responseDiv2").fadeIn(150);
            if(response.data.length === 0){
                $("#responseDiv2").html(" <div style='padding-top:6px;padding-bottom:6px;text-align:center'>No result found</div>");
            }else{
              for (var i = response.data.length - 1; i >= 0; i--) {
                  
                  var divDiv = "</div><a href='/home/user/"+response.data[i].id+"'><div style='padding:10px;color:black' class='searchResults'>"+response.data[i].name+" "+response.data[i].lastName+"</div></a>";
    
                  angular.element(document.getElementById('responseDiv2')).append($compile(divDiv)($scope));
                  $scope.addMateFunction = function(userId, problemId){
                      $http({
                          method: 'POST',
                          url: '/home/api/application/addModerator',
                          data: {userId: userId, problemId: problemId}
                      }).then(function successCallback(response) {
                          console.log(response.data);
                          // var item = $("#menuSearchItem").text("aa");
                          $("#itemsHolder").append("<div class='' id='menuSearchItem' style='border-bottom:2px solid red;max-width: 100px;height: 33px;background-color: #F3F3F4;border-radius: 3px; text-align: center;padding-top: 7px;float: left;margin-left: 10px;padding-left: 5px;padding-right:5px'>"+response.data.name +" "+response.data.lastName+"<i class='fa fa-times' aria-hidden='true' style='cursor:pointer;float:right' ng-click='deleteWorker("+problemId+","+userId+")'></i></div>");
                      }, function errorCallback(response) {
                          alert('ne valja');
                      });
                  };
                  
              }
            };
          }
        });

    };

    $scope.deleteWorker = function(problemId, userId){
        $http({
          method: 'POST',
          url: '/home/api/application/deleteWorker',
          data: {problemId: problemId, userId: userId}
        }).then(function successCallback(response) {
          $("#menuSearchItem"+userId+"plus"+problemId).hide();
        }, function errorCallback(response) {
        alert('ne valja');
        });
    }
  

});

app.controller('sendDirectMessageController', function($scope, $http){
  $scope.submitMessageForm = function(){
    var message2 = $scope.message;
    var id2 = $('#userID').val();
    alert(message2 + ' ' + id2);
    $http({
        method: 'POST',
        url: '/home/inbox/sendMessage',
        data: {message: message2, id: id2}
    }).then(function successCallback(response) {
        alert('radi');
      }, function errorCallback(response) {
        alert('ne valja');
    });
  }
});

app.service('searchService', function($http){
    return {
        search: function(keywords, problemId){
            console.log(keywords);
            console.log(problemId);
            
            return $http.post('/home/api/application/getusers', { "username" : keywords, "problemId" : problemId});
        }
    }
});

app.service('searchService2', function($http){
    return {
        search: function(keywords, problemId){
            console.log(keywords);
            console.log(problemId);
            
            return $http.post('/home/api/application/getusers2', { "username" : keywords, "problemId" : problemId});
        }
    }
});

app.controller('showProblemController', function($scope, $http){
    $scope.loading = true;

    return $http({
        method: 'GET',
        url: 'home/api/application/getuserproblems',
        headers: {
            "Content-Type": "application/json"
        },
        data: {}
    }).then(function(res){
      
      $scope.problems = res.data;
      console.log($scope.problems);
    }).finally(function() {
      // called no matter success or failure
      $scope.loading = false;
    });
});

app.controller('newProblemController', function($scope){
  $scope.addProblemSubmit = function(){
      
      // alert($scope.probName + " " + $scope.probDescription);
      console.log(selectedFiles);
  }
});

if($('#uploadHolderr').is(':visible')){
                Dropzone.options.dropzoneForm = {
                    addRemoveLinks: true,
                    removedfile: function(file) {
                        alert(file.name);
                    },
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 1024, // MB
                    dictDefaultMessage: "<strong>Drop files here or click to upload. </strong>",
                    accept: function(file, done) {
                        console.log(file);
                        selectedFiles.push(file.name);
                        if (file.name == "a.jpg") {
                          done("Naha, you don'tt.");
                        }
                        else { done(); }
                  }
                };
            }

// app.directive('animateOnLoad', function($animateCss) {
//     return {
//       'link': function(scope, element) {
//         $animateCss(element, {
//             'event': 'enter',
//              structural: true
//         }).start();
//       }
//     };
// });