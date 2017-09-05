
(function (angular) {
app = angular.module('kbkApp', ['ngAnimate', 'ui.bootstrap', 'summernote', 'ngSanitize'], function($interpolateProvider) {
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

app.factory('selectedFilesService', function() {
    return {
        selectedFiles : []
    };
});

app.service('removeFileS3Service', function($http){
    return {
        remove: function(fileName){
            return $http.post('/home/api/application/removeUploadedFile', { "fileName" : fileName});
        }
    }
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

app.controller('dropzoneImageController', function($scope, selectedFilesService){
  Dropzone.options.dropzoneForm2= {
      addRemoveLinks: true,
      // removedfile: function(file) {
      //   alert(file.name);
      // },
      paramName: "file", // The name that will be used to transfer the file
      maxFilesize: 4, // MB
      dictDefaultMessage: "<strong>Drop image or click here to upload.</strong>",
      accept: function(file, done) {
        selectedFilesService.selectedFiles.push(file.name);
        console.log(selectedFilesService.selectedFiles.length)
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
});


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
                console.log();
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

app.directive('myOffer', function($http, loggedUserService) {
  return {
    restrict: 'A',
    scope: {
      offer: '=',
    },
    link: function(scope) {
      $http({
          method: 'GET',
          url: '/home/api/application/finduserbid',
          headers: {
              "Content-Type": "application/json"
          },
          params: {userId: scope.offer.person_from}
      }).then(function(res){
        scope.offer.persFrom = res.data;
        loggedUserService.user().then(function(user) {
          if(user.id === scope.offer.person_from){
            scope.offer.isMine = '(you)';
          }
        });
      });


    }
  };
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
              if(scope.passwordVerify){
                if (value) {
                    console.log("s");
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

                $("#resDiv").html("<div style='border:1px solid #a9a9a9;'><div style='padding-top:6px;padding-bottom:6px;text-align:center'>No result found</div></div>");
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

                  var divDiv = "<div style='border:1px solid #a9a9a9;'><div style='padding:10px' class='searchResults' ng-click='addMateFunction("+response.data[i].id+","+problemId+")'><a href='/home/user/"+response.data[i].id+"'><img src='../../img/"+response.data[i].picture+"' width='30px' style='border-radius: 3px; margin-right:10px'></a>"+response.data[i].name+" "+response.data[i].lastName+"</div></div>";

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
                          $("#itemsHolder").append("<div class='' id='menuSearchItem"+userId+"plus"+problemId+"' style='border-bottom:2px solid red;height: 33px;background-color: #F3F3F4;border-radius: 3px; text-align: center;padding-top: 7px;float: left;margin-left: 10px;padding-left: 5px;padding-right:5px'>bh"+response.data.name +" "+response.data.lastName+"<div id='iks' style='float:right;margin-left:2px'></div></div>");
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

                  var divDiv = "<a href='/home/user/"+response.data[i].id+"'><div style='padding:10px;color:black' class='searchResults'><img src='../../img/"+response.data[i].picture+"' width='30px' style='border-radius: 3px; margin-right:10px'>"+response.data[i].name+" "+response.data[i].lastName+"</div></a>";

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

    $http({
        method: 'POST',
        url: '/home/inbox/sendMessage',
        data: {message: message2, id: id2}
    }).then(function successCallback(response) {
        $('#sendMessageModal').modal('toggle');
        $scope.message = "";
      }, function errorCallback(response) {

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



app.controller('newProblemController', function($scope, $http, alertSerice, selectedFilesService, removeFileS3Service){
  $scope.summernoteOptions = {
    height:300,
    toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          // ['height', ['height']]
        ]
  }
  $scope.addProblemSubmit = function(){

      // alert($scope.probName + " " + $scope.probDescription + " " +$scope.answer +" "+selectedFiles);

    return $http({
        method: 'POST',
        url: '/home/api/application/newproblemsubmit',
        headers: {
            "Content-Type": "application/json"
        },
        data: {probName: $scope.probName, probDescription: $scope.probDescription, probType: $scope.answer, selectedFiles: selectedFilesService.selectedFiles}
    }).then(function(res){
      alertSerice.successSweet('Success', 'success', 'Successfully submitted new task');
      $('#showNewProblemForm').hide();
      $('#showProblemConfirm').show();


    }).finally(function() {
      // called no matter success or failure
    });

  }

  if($('#uploadHolderr').is(':visible')){
                $("#showSubmitButton2").show();
                Dropzone.options.dropzoneForm = {
                    addRemoveLinks: true,
                    maxFilesize: 15,
                    acceptedFiles: ".png, .jpg, .jpeg, .zip, .rar, .pdf, .tex, .docx, .xlsx, .tar, .gz , .bz2, .7z, .s7z",
                    removedfile: function(file){
                      var _ref;
                      var name = file.name;
                      selectedFilesService.selectedFiles.splice(file.name, 1);
                      removeFileS3Service.remove(name).then(function (){});
                      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;

                    },
                    paramName: "file", // The name that will be used to transfer the file
                    dictDefaultMessage: "<strong>Drop files or click here to upload. (max. 15MB)<br>Accepted files: .png, .jpg, .jpeg, .zip, .rar, .pdf, .tex, .docx, .xlsx, .tar, .gz , .bz2, .7z, .s7z</strong>",
                    accept: function(file, done) {
                        if(selectedFilesService.selectedFiles.length >= 0){
                            $("#showSubmitButton2").hide();
                        }
                        selectedFilesService.selectedFiles.push(file.name);

                        if (file.name == "a.jpg") {
                          done("Naha, you don't.");
                        }
                        else { done(); }
                    },
                    queuecomplete: function(file){
                        $("#showSubmitButton").fadeIn(100);

                    },
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

app.controller('dropzoneSolutionController', function($scope, $element, $compile, selectedFilesService, removeFileS3Service){
  if($('.modUpdate').css('display') == 'none'){
    $scope.summernotePostSolutionOptions = {
      height:300,
      toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            // ['height', ['height']]
          ]
    }
    Dropzone.options.dropzoneForm2= {
      addRemoveLinks: true,
      acceptedFiles: ".png, .jpg, .jpeg, .zip, .rar, .pdf, .tex, .docx, .xlsx, .tar, .gz , .bz2, .7z, .s7z",
      removedfile: function(file){
                      var _ref;
                      var name = file.name;
                      selectedFilesService.selectedFiles.splice(file.name, 1);
                      removeFileS3Service.remove(name).then(function (){});
                      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;

      },
      paramName: "file", // The name that will be used to transfer the file
      maxFilesize: 15, // MB
      dictDefaultMessage: "<strong>Drop files or click here to upload. (max. 15MB)<br>Accepted files: .png, .jpg, .jpeg, .zip, .rar, .pdf, .tex, .docx, .xlsx, .tar, .gz , .bz2, .7z, .s7z</strong>",
      accept: function(file, done) {
        selectedFilesService.selectedFiles.push(file.name);
        // var el = angular.element('<div class="container" style="margin-left:-15px;width:60px" ><i class="fa fa-file-o fa-3x" aria-hidden="true" style="color:#c5c5c5"></i><p style="margin-left: 3px">test</p></div>');
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
    problem: '=',
    user: '='
  },
    link: function (scope, element, attrs) {
      if (loggedUser.role.name == 'regular') {
        scope.showOffersManu = false;
        var countDownDate = new Date(scope.problem.time_ends_at).getTime();
          // Get todays date and time
        var now = new Date().getTime();
        // Find the distance between now an the count down date
        var distance = countDownDate - now;
        if(distance < 0){
          if(scope.problem.waiting !== 0){

            // Set waiting on false(0)
            $http({
                method: 'PUT',
                url: 'home/api/problem/'+scope.problem.id+'/resetWaiting',
                headers: {
                    "Content-Type": "application/json"
                },
                data: {}
            }).then(function(){
              elm3 = element.find("#statusHolder");
              elm3.empty();

              var el3 = angular.element('<span>No offers.&nbsp; <a href="home/problem/'+scope.problem.id+'/reset" style="position:absolute">Request again</a></sapn>');
              $compile(el3)(scope);
              elm3.append(el3);
            });
          }
        }
        if (scope.problem.waiting == 0 && scope.problem.took == 0) {
          if(distance < 0){

            var min = 100000;
            var minOffer;

            if(scope.problem.offers.length > 0){
              angular.forEach(scope.problem.offers, function(value, key) {
                if(value.price < min){
                  min = value.price;
                  minOffer = value;
                }
              })
              console.log('1');
              var el1 = angular.element('<span>Offer: $'+min+'</span>');
              $compile(el1)(scope);
              elm = element.find("#statusHolder");
              elm.append(el1);

              // var el2 = angular.element('<a href="home/problem/'+scope.problem.id+'/payment/'+minOffer.id+'" style="position:absolute" class="btn btn-info btn-xs">Make payment</a>');


            }else{
              console.log('2');
              var el3 = angular.element('<span>No offers.&nbsp; <a href="home/problem/'+scope.problem.id+'/reset" style="position:absolute">Request again</a></sapn>');
              $compile(el3)(scope);
              elm3 = element.find("#statusHolder");
              elm3.append(el3);
            }

          }else{
            console.log(problem);
            var el1 = angular.element('<span><i class="fa fa-clock-o" aria-hidden="true" style="color:black"></i> Pending...</span>');
            $compile(el1)(scope);
            elm = element.find("#statusHolder");
            elm.append(el1);
          }
        }else if(scope.problem.waiting == 0 && scope.problem.took == 1){
            var el1 = angular.element('<span><i class="fa fa-pencil" aria-hidden="true" style="color:black"></i> Under work...</span>');
            $compile(el1)(scope);
            elm = element.find("#statusHolder");
            elm.append(el1);

            var el2 = angular.element('<a href=""  class="btn btn-info btn-xs">Make paymentb</a>');

            $compile(el2)(scope);
            el = element.find("#paymentHolder");
            el.append(el2);
        }else if(scope.problem.waiting == 0 && scope.problem.took == 2){
            var el1 = angular.element('<span><i class="fa fa-check" aria-hidden="true" style="color:green"></i> Finished</span>');
            $compile(el1)(scope);
            elm = element.find("#statusHolder");
            elm.append(el1);
        }else{
            // var $dd = $('#dropDownMenu');
            // $dd.html('sadas');

            var el3 = angular.element('<span>Waiting for offers</sapn>');
            $compile(el3)(scope);
            elm3 = element.find("#statusHolder");
            elm3.append(el3);
            // $("#dropDownMenu").prop('disabled',true);
        }
      }else{



        if (scope.problem.offers.length == 0) {
          var el3 = angular.element('<span><a href="/home/problem/'+scope.problem.id+'" role="button" class="btn btn-danger btn-xs"><i class="fa fa-clock-o" aria-hidden="true"></i> No offers</button></span>');
          $compile(el3)(scope);
          elm3 = element.find("#statusHolder");
          elm3.append(el3);
        }else{
          var el3 = angular.element('<span class="label label-default">'+scope.problem.offers.length+'</span>');
          $compile(el3)(scope);
          elm3 = element.find("#statusHolder");
          elm3.append(el3);
          angular.forEach(scope.problem.offers, function(value, key) {
            if (value.person_from == scope.user) {
              var el2 = angular.element('<span class="label label-default" style="margin-left:5px;">You bidded</span>');
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
      scope.acceptOffer = function(){
        alert('dd');
      }
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
        //     });https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.messenger.com%2Ft%2Fnikola.vorinski&h=ATN22LZwM5cR05F23qLX8JgsFYUadrAQyuliz5RiVJthT73PBT6Ph4yNTbWrqWkUCdZZU4hO222eLlmmZXaTGD8bD_wp_RtUhnCBOgPmPhML1cGTcwKHDpOEVLxcjf3rPaQw9Dmhtk6p2A
        // }
    }
  }
});

app.controller('bidingController', function($scope, $http, $compile, $element, loggedUserService, alertSerice){

  $scope.init = function(id){
    loggedUserService.user().then(function(d) {
    var lUser = d;
    if (lUser.role.name != 'regular') {
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
          var formBidElement = '<form name="offerForm" ng-submit="placeBid()" novalidate><div class = "input-group pull-left" style="width:150px;margin-right:10px"><span class = "input-group-addon">$</span><div class="form-group" ng-class="{ '+"'has-error'"+' : offerForm.biddingOffer.$invalid && !offerForm.biddingOffer.$pristine}"><input type = "number" min="1" class ="form-control" ng-model="biddingOffer" name="biddingOffer" style="height:54px;" required></div></div><div class="form-group" ng-class="{ '+"'has-error'"+' : offerForm.biddingDescription.$invalid && !offerForm.biddingDescription.$pristine}"><textarea class="form-control" placeholder="e.g. Problem can be solved in 10 mins with 1 file attached..." style="width:500px;resize:none" ng-model="biddingDescription" name="biddingDescription" required></textarea></div><button class="btn btn-primary" type="submit" style="float:left;border-radius: 0px;margin-top:5px" ng-disabled="offerForm.$invalid">Bid for this task</button></form>';



          var countDownDate = new Date(res.data.time_ends_at).getTime();
          // Get todays date and time
          var now = new Date().getTime();
          // Find the distance between now an the count down date
          var distance = countDownDate - now;
          // console.log(distance);
          if(distance < 0){
              var el = angular.element('<hr><h3><span style="padding:13px 0px;position:absolute">Time expired! Can\'t bid anymore</span></h3>');
              $compile(el)($scope);
              elm = $element.find("#offerPlace");
              elm.append(el);
          }else{
            var offers = res.data.offers;

            if (offers.length == 0) {
              var el3 = angular.element(formBidElement);
              $compile(el3)($scope);
              elm3 = $element.find("#offerPlace");
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
                    var el3 = angular.element('<hr><h3><span style="padding:13px 0px;position:absolute">Already bidded $'+value.price+'</span></h3>');
                    $compile(el3)($scope);
                    elm3 = $element.find("#offerPlace");
                    elm3.append(el3);
                  }
                });

              }
            }
          }
          $scope.placeBid = function(){
            var offer = $scope.biddingOffer;
            var desc = $scope.biddingDescription;
              return $http({
                  method: 'POST',
                  url: '/home/api/application/placeOffer',
                  headers: {
                      "Content-Type": "application/json"
                  },
                  data: {probId: id, price: offer, description: desc}
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

app.controller('braintreeController', function($scope, $http){

    // $http({
    //     method: 'GET',
    //     url: '/home/api/application/generateToken',
    //     data: {}
    // }).then(function successCallback(res) {
    //     braintree.setup(res.data.token, 'dropin', {
    //       container: 'dropin-container'
    //     });
    // });


});

app.controller('reserPasswrdController', function($scope, $http){
  $scope.findUser = function(){
    var email = $scope.resetEmilAdderss;

    $http({
        method: 'GET',
        url: '/api/application/getuserbyemail',
        params: {"email" : email}
    }).then(function successCallback(item) {
      if(item.data.length === 0){
        console.log("neam");
        $scope.resetForm.resetEmilAdderss.$setValidity('userex', false);
      }else{
        $scope.resetForm.resetEmilAdderss.$setValidity('userex', true);
      }
    });
  }


  $scope.resetFormSubmit = function(){
    $scope.showLoadMailIcon = true;
    var email = $scope.resetEmilAdderss;
    $http({
        method: 'POST',
        url: '/password/email',
        data: {"email" : email}
    }).then(function successCallback(item) {
      $scope.showLoadMailIcon = false;
      $scope.resetEmilAdderss="";
    });
  }
});

})(angular);
