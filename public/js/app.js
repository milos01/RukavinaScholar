
var app = angular.module('kbkApp', ['ngAnimate'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');

        
 });

app.factory('alertSerice', function() {
        return {
            successSweet: function(title, type, text) {
                swal({
                  title: title,
                  text: text,
                  type: type,
                  timer: 1500,
                  showConfirmButton: false
                });
            }
        };
});

app.factory('loggedUserService', function($http) {
        
        var loggedUserService =  {
            user: function() {
            var promise =  $http({
                  method: 'GET',
                  url: '/home/api/application/getuser',
                  headers: {
                      "Content-Type": "application/json"
                  },
                  data: {}
              }).then(function(res){
                return res.data;
              });
               return promise;
            }
        };
        return loggedUserService;
});



app.controller('mainController', function($scope, loggedUserService){
  // $scope.loggedUsers = loggedUserService.loggedUser();
  loggedUserService.user().then(function(d) {
    loggedUser = d;
  });
  
});
// socket = io('http://localhost:3000');
if($(".chDiscussion").is(":visible")){
  $cont = $(".chDiscussion");
  $cont[0].scrollTop = $cont[0].scrollHeight;
}
var selectedFiles = [];
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
    var mm = today.getMonth()+1; //January is 0!
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

app.controller('downloadController', function($scope){
  
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
          
          var check001 = false;
          if( !$("#searchInput").val() ){
              $("#resDiv").fadeOut(150);
            }else{
            $("#resDiv").text("");

            $("#resDiv").fadeIn(150);
            if(response.data.length === 0){

                $("#resDiv").html("<div style='border:1px solid red;'><div style='padding-top:6px;padding-bottom:6px;text-align:center'>No result found</div></div>");
            }else{
              
              for (var i = response.data.length - 1; i >= 0; i--) {
                var check = false;
                angular.forEach(response.data[i].problems, function(value, key) {
                  if(!check){
                    console.log(value.pivot);
                    if (problemId == value.pivot.problem_id) {
                       
                        check = true;
                        check001 = true;
                    }
                  }
                });
                if (!check) {
                  
                  var divDiv = "<div style='border:1px solid red;'><div style='padding:10px' class='searchResults' ng-click='addMateFunction("+response.data[i].id+","+problemId+")'>"+response.data[i].name+" "+response.data[i].lastName+"</div></div>";
    
                  angular.element(document.getElementById('resDiv')).append($compile(divDiv)($scope));
                  $scope.addMateFunction = function(userId, problemId){
                      $("#resDiv").fadeOut(150);
                      $http({
                          method: 'POST',
                          url: '/home/api/application/addModerator',
                          data: {userId: userId, problemId: problemId}
                      }).then(function successCallback(response) {
                          console.log(response.data);
                          // var item = $("#menuSearchItem").text("aa");
                          $("#itemsHolder").append("<div class='' id='menuSearchItem"+userId+"plus"+problemId+"' style='border-bottom:2px solid red;height: 33px;background-color: #F3F3F4;border-radius: 3px; text-align: center;padding-top: 7px;float: left;margin-left: 10px;padding-left: 5px;padding-right:5px'>"+response.data.name +" "+response.data.lastName+"<div id='iks' style='float:right;margin-left:2px'></div></div>");
                        var html="<i class='fa fa-times' aria-hidden='true' style='cursor:pointer' ng-click='deleteWorker("+problemId+", "+userId+")'></i>" ;
                        angular.element(document.getElementById('iks')).append($compile(html)($scope));

                      }, function errorCallback(response) {
                          alert('ne valja');
                      });
                  };
                  
            
                  }
                  
              }
            
             
            };

            if (check001) {
              // $("#responseDiv").html("<div style='padding-top:6px;padding-bottom:6px;text-align:center'>No result found</div>");    
            }
          }
        });
    };

    $scope.search2 = function(){
            
        searchService2.search($scope.keywords).then(function(response){
            if( !$("#top-search").val() ){
              $("#responseDiv2").fadeOut(50);
            }else{

            $("#responseDiv22").text("");

            $("#responseDiv2").fadeIn(150);
            if(response.data.length === 0){
                $("#responseDiv22").html("<div style='padding-top:6px;padding-bottom:6px;text-align:center'>No result found</div>");
            }else{
              for (var i = response.data.length - 1; i >= 0; i--) {
                  
                  var divDiv = "<a href='/home/user/"+response.data[i].id+"'><div style='padding:10px;color:black' class='searchResults'>"+response.data[i].name+" "+response.data[i].lastName+"</div></a>";
    
                  angular.element(document.getElementById('responseDiv22')).append($compile(divDiv)($scope));
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
    $scope.colourIncludes = [];
    $scope.noFound = 'No problem found!';
    return $http({
        method: 'GET',
        url: 'home/api/application/getuser',
        headers: {
            "Content-Type": "application/json"
        },
        data: {}
    }).then(function(res){
        var loggedUser = res.data;
        if (res.data.role == "regular") {
          $http({
            method: 'GET',
            url: 'home/api/application/getOneUserProblems',
            headers: {
                "Content-Type": "application/json"
            },
            data: {}
          }).then(function(res){
          
          $scope.problems = res.data;
         
          $scope.includeColour = function(colour) {
              var i = $.inArray(colour, $scope.colourIncludes);
              if (i > -1) {
                  $scope.colourIncludes.splice(i, 1);
              } else {
                  $scope.colourIncludes.push(colour);
              }
           }

           $scope.colourFilter = function(fruit) {
             
              if ($scope.colourIncludes.length > 0) {
                  if ($.inArray(fruit.problem_type, $scope.colourIncludes) < 0)
                      return;
              }
              
              return fruit;
            }

            $scope.tookFilter = function(problem){
              return problem;
            }

            
          });
        }else{
        $http({
            method: 'GET',
            url: 'home/api/application/getuserproblems',
            headers: {
                "Content-Type": "application/json"
            },
            data: {}
        }).then(function(res){
          
          $scope.problems = res.data;
          $scope.includeColour = function(colour) {
              var i = $.inArray(colour, $scope.colourIncludes);
              if (i > -1) {
                  $scope.colourIncludes.splice(i, 1);
              } else {
                  $scope.colourIncludes.push(colour);
              }
           }

           $scope.colourFilter = function(fruit) {
             
              if ($scope.colourIncludes.length > 0) {
                  if ($.inArray(fruit.problem_type, $scope.colourIncludes) < 0)
                      return;
              }
              
              return fruit;
            }
            $scope.tookFilter = function(problem){
              if(problem.took == '0'){
                return problem;
              }
            }
          // console.log($scope.colourIncludes);
        });

        
      
        
    
         
      }
    }).finally(function() {
      // called no matter success or failure
      $scope.loading = false;
    });


});

app.controller('newProblemController', function($scope, $http, alertSerice){
  $scope.addProblemSubmit = function(){
      
      // alert($scope.probName + " " + $scope.probDescription + " " +$scope.answer +" "+selectedFiles);
   
    return $http({
        method: 'POST',
        url: '/home/api/application/newproblemsubmit',
        headers: {
            "Content-Type": "application/json"
        },
        data: {probName: $scope.probName, probDescription: $scope.probDescription, probType: $scope.answer, selectedFiles: selectedFiles}
    }).then(function(res){
      alertSerice.successSweet('Success', 'success', 'Successfully submitted new task');
    }).finally(function() {
      // called no matter success or failure
    });

  }

  if($('#uploadHolderr').is(':visible')){
                $("#showSubmitButton2").show();
                Dropzone.options.dropzoneForm = {
                    addRemoveLinks: true,
                    removedfile: function(file) {
                        alert(file.name);
                    },
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 1024, // MB
                    dictDefaultMessage: "<strong>Drop files or click here to upload. </strong>",
                    accept: function(file, done) {
                      console.log(selectedFiles.length);
                        if(selectedFiles.length >= 0){
                            $("#showSubmitButton2").hide();
                        }
                        selectedFiles.push(file.name);

                        if (file.name == "a.jpg") {
                          done("Naha, you don't.");
                        }
                        else { done(); }
                    },
                    queuecomplete: function(file){
                        $("#showSubmitButton").fadeIn(100);
                        
                    }
                };
  }
});
//Custom Date filter
app.filter('dateFilter', function($filter) {
  // In the return function, we must pass in a single parameter which will be the data we will work on.
  // We have the ability to support multiple other parameters that can be passed into the filter optionally
  return function(input, format) {
       return $filter('date')(new Date(input), format);
}

});

app.controller('dropzoneSolutionController', function($scope, $element, $compile){
  if($('.modUpdate').css('display') == 'none'){
    Dropzone.options.dropzoneForm2= {
      addRemoveLinks: true,
      removedfile: function(file) {
        alert(file.name);
      },
      paramName: "file", // The name that will be used to transfer the file
      maxFilesize: 1024, // MB
      dictDefaultMessage: "<strong>Drop files or click here to upload. Sol</strong>",
      accept: function(file, done) {
        selectedFiles.push(file.name);
        // var el = angular.element('<div class="container pull-left" style="margin-left:-15px;width:60px" ><i class="fa fa-file-o fa-3x" aria-hidden="true" style="color:#c5c5c5"></i><p style="margin-left: 3px">test</p></div>');
        // $compile(el)($scope);
        // elm = $element.find("#filesHolder"); 
        // console.log(elm);
        // elm.append(el);
        if (file.name == "a.jpg") {
          done("Naha, you don't.");
        }
        else { done(); }
      }
    };
  }
});

app.directive('problemShowDirective', function ($compile, $http, $parse, loggedUserService) {
  return {
    scope: {
    problem: '='
  },
    link: function (scope, element, attrs) {     
      if (loggedUser.role == 'regular') {
        if (scope.problem.waiting == 0 && scope.problem.took == 0) {
        var el1 = angular.element('<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Offers<span class="caret"></span></button><ul class="dropdown-menu" id="offersHolder"></ul></div>');
        $compile(el1)(scope);
        elm = element.find("#dropDownMenu"); 
        elm.append(el1);
        $http({
          method: 'POST',
          url: '/home/api/application/getproblemoffers',
          headers: {
              "Content-Type": "application/json"
          },
            data: {probId: scope.problem.id}
          }).then(function(res){
            
            
              console.log(res.data);
            
     
              angular.forEach(res.data, function(value, key) {
                // console.log(view);
                var el2 = angular.element('<li ng-mouseover="hoverItem('+key+')" ng-mouseleave="hoverOut('+key+')" ><a href="/home/problem/'+scope.problem.id+'/payment/'+value.id+'">$'+value.price+' <span ng-show="hoverEdit'+key+'">  <i>-select</i></span></a></li>');
                $compile(el2)(scope);
                elm = element.find("#offersHolder"); 
                elm.append(el2);
             
              });
             
              
            
        });
          }else if(scope.problem.waiting == 0 && scope.problem.took == 1){
              var el1 = angular.element('<span><i class="fa fa-pencil" aria-hidden="true"></i> under work</span>');
              $compile(el1)(scope);
              elm = element.find("#statusHolder"); 
              elm.append(el1);
          }else{
              // var $dd = $('#dropDownMenu');
              // $dd.html('sadas');
              
              var el3 = angular.element('<span><i class="fa fa-clock-o" aria-hidden="true"></i> pending...</span>');
              $compile(el3)(scope);
              elm3 = element.find("#statusHolder"); 
              elm3.append(el3);
              // $("#dropDownMenu").prop('disabled',true);
            }
          }else{
           
            if (scope.problem.offers.length == 0) {
              var el3 = angular.element('<span><a href="/home/problem/'+scope.problem.id+'" role="button" class="btn btn-danger btn-xs"><i class="fa fa-clock-o" aria-hidden="true"></i> View</button></span>');
              $compile(el3)(scope);
              elm3 = element.find("#statusHolder"); 
              elm3.append(el3);
            }else{
              angular.forEach(scope.problem.offers, function(value, key) {
                console.log(value.person_from);
                if (value.person_from == lUser.id) {
                  var el2 = angular.element('<p>you bidded</p>');
                  $compile(el2)(scope);
                  elm = element.find("#statusHolder"); 
                  elm.append(el2);
                }
              });        
            }
          
          }
          scope.hoverItem = function(key){
            var string = "hoverEdit"+key;
            var newModel = $parse(string);
            newModel.assign(scope, true);
          }
            
          scope.hoverOut = function(key){
              var string = "hoverEdit"+key;
              var model = $parse(string);
               // Assigns a value to it
              model.assign(scope, false);
               
          };

        // scope.deletePatient = function(pacId, e){
        //    e.preventDefault();
        //    $http({
        //         method: 'POST',
        //         url: '/home/deletepatient',
        //         headers: {
        //             "Content-Type": "application/json"
        //         },
        //         data: {id: pacId}
        //     }).then(function(res){
        //       alert(res.data);
        //     });
        // }
    }
  }
});

app.controller('bidingController', function($scope, $http, $compile, $element, loggedUserService, alertSerice){
  
  $scope.init = function(id){
    loggedUserService.user().then(function(d) {
    var lUser = d;
    if (lUser.role != 'regular') {
    var check = false;
    var check02 = false;
    return $http({
            method: 'POST',
            url: '/home/api/application/getProblem',
            headers: {
                "Content-Type": "application/json"
            },
            data: {probId: id}
        }).then(function(res){
          var formBidElement = '<form name="offerForm" ng-submit="placeBid()" novalidate><div class = "input-group pull-left" style="width:150px;padding:5px 0px"><span class = "input-group-addon">$</span><input type = "number" class =" form-control" ng-model="biddingOffer" required></div><button class="btn btn-primary" type="submit" style="border-radius: 0px;margin-top:5px" ng-disabled="offerForm.$invalid">Bid</button></form>';
          var offers = res.data.offers;
          if (offers.length == 0) {
            var el3 = angular.element(formBidElement);
            $compile(el3)($scope);
            elm3 = $element.find("#offerPlace"); 
            console.log(elm3);
            elm3.append(el3);
          }else{
            angular.forEach(offers, function(value, key) {
                if (lUser.id != value.person_from) {
                  check = true;
                }else{
                  check02 = true;
                }
            });
            if (check && !check02) {
              var el3 = angular.element(formBidElement);
              $compile(el3)($scope);
              elm3 = $element.find("#offerPlace"); 
              elm3.append(el3);
            }else if(check02){
              angular.forEach(offers, function(value, key) {
                if (lUser.id == value.person_from) {
                  var el3 = angular.element('<span style="padding:13px 0px;position:absolute">Already bidded $'+value.price+'</span>');
                  $compile(el3)($scope);
                  elm3 = $element.find("#offerPlace"); 
                  elm3.append(el3);
                }
              });
              
            }
          }
          $scope.placeBid = function(){
            var offer = $scope.biddingOffer;
              return $http({
                  method: 'POST',
                  url: '/home/api/application/placeOffer',
                  headers: {
                      "Content-Type": "application/json"
                  },
                  data: {probId: id, price: offer}
              }).then(function(res){
                
                alertSerice.successSweet('Success', 'success', 'Successfully bidded $'+offer+' on this task');
                $("#offerPlace").html('<span style="padding:13px 0px;position:absolute">Already bidded $'+offer+'</span>');
              });
          };
        }).finally(function(){
          // $scope.loading02 = false;
        });
    }
  });
};

});

app.controller('makePaymentController', function($scope, $http, alertSerice){
  $scope.makePayment = function(){
    var sloId = $("#slovlerId").val();
    var probId = $("#problemId").val();
    return $http({
            method: 'POST',
            url: '/home/api/application/makePayment',
            headers: {
                "Content-Type": "application/json"
            },
            data: {probId: probId, sloId: sloId}
        }).then(function(res){
          alertSerice.successSweet('Success', 'success', 'Successfully payed');
        });

  };
});

app.controller('editUserInfoController', function($scope){
  $scope.init = function(user){
    $scope.firstName = user.name;
    $scope.lastName = user.lastName;
  };
});

app.controller('MyCtrldd', function($scope){
  $scope.showDetails = function(){
    $('.modUpdate').toggle();
  }
});
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

















































