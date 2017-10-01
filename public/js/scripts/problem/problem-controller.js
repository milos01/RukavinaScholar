(function(angular){
	"use strict";
	app.controller('showProblemController', function(UserResource, ProblemResource, $scope, $interval, $parse, $http){
    $scope.init = function(loggedUser){
      $scope.loading = true;
      $scope.limit = 20;
      $scope.taskTypeIncludes = [];
      $scope.noFound = 'No tasks found!';

      //filters for tasks
      taskTypeFilter();
      
      $scope.tookFilter = function(task){
        if(task.inactive == 0){
          return task;
        }
      }

      $scope.tookFilter = function(task){
        if(task.took == 0){
          return task;
        }
      }
      //if user has 'regular' role
      if (loggedUser.role_id == 1) {
        UserResource.getLoggedUserTasks().then(function(loggedUserTasks){
          $scope.problems = loggedUserTasks;
          //shows accept decline buttons (need to refector in directive)
          showAcceptDecline(loggedUserTasks);

          

          $scope.requestAgain = function(){
            socket.emit('updateAdminTime', {emailTo: "milosa942@gmail.com"});
          }

        }).finally(function() {
          // called no matter success or failure
          $scope.loading = false;
        });
      }else{
        $scope.showOffersManu = true;
        for (var i = res.data.length - 1; i >= 0; i--) {
          res.data[i].isCollapsed = true;

          if(res.data[i].offers.length === 0){
            res.data[i].showDown = false;
            res.data[i].showUp = false;
          }else{
            res.data[i].showDown = true;
          }


        }

        ProblemResource.getAllTasks().then(function(allTasks){
          $scope.problems = allTasks;
          taskCountdown(allTasks);

        }).finally(function() {
          // called no matter success or failure
          $scope.loading = false;
        });
      }

      $scope.acceptOffer = function(problem){
        var min = 100000;
        var minOffer;

        angular.forEach(problem.offers, function(value, key) {
          if(value.price < min){
            min = value.price;
            minOffer = value;
          }
        });

        $http({
            method: 'PUT',
            url: 'home/api/application/makePayment',
            headers: {
                "Content-Type": "application/json"
            },
            data: {probId: problem.id,
                  sloId: minOffer.person_from,
            }
        }).then(function(){
          var model = $parse('showMakePayment'+problem.id);
          var model2 = $parse('showAcceptDecline'+problem.id);
          // Assigns a value to it
          model.assign($scope, true);
          model2.assign($scope, false);
        });
      };

      $scope.declineOffer = function(problemId){
        // Set task as inactive
        ProblemResource.putTaskInactive(problemId).then(function(updatedTask){
        angular.forEach($scope.problems, function(value, key) {
            if(updatedTask.id == value.id && updatedTask.inactive === 1){
              $scope.problems.splice(key, 1);
            }
          });
        });
      }

      $scope.collapseMotion = function(problem){

        problem.isCollapsed = !problem.isCollapsed;
        if(problem.isCollapsed == true){
          problem.showDown = true;
          problem.showUp = false;
        }else{


          problem.showDown = false;
          problem.showUp = true;
        }
      }
    }
  });

  function showAcceptDecline(res){
    for (var i = res.length - 1; i >= 0; i--) {
      var min = 100000;
      var minOffer;

      if(res[i].offers.length > 0 && res[i].waiting === 0 && res[i].took === 0){
        angular.forEach(res[i].offers, function(value, key) {
          if(value.price < min){
            min = value.price;
            minOffer = value;
          }
        })
        $scope.mOffer = minOffer;
        model0 = $parse("showAcceptDecline"+res[i].id);
        var model2 = $parse('mOffer'+res[i].id);
        // Assigns a value to it
        model0.assign($scope, true);
        model2.assign($scope, minOffer);
      }
    }
  }

  function taskTypeFilter(){
    $scope.includeTaskType = function(taskType) {
      var i = $.inArray(taskType, $scope.taskTypeIncludes);
      if (i > -1) {
        $scope.taskTypeIncludes.splice(i, 1);
      } else {
        $scope.taskTypeIncludes.push(colour);
      }
    }

    $scope.taskTypeFilter = function(task) {
      if ($scope.taskTypeIncludes.length > 0) {
          if ($.inArray(task.problem_type, $scope.colourIncludes) < 0)
              return;
      }
      return task;
    }
  }

  function taskCountdown(tasks){
    var x = $interval(function() {

      var doneCounters = [];

      for (var i = tasks.length - 1; i >= 0; i--) {

        var countDownDate = new Date(tasks[i].time_ends_at).getTime();



        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;
        doneCounters[i] = distance;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        tasks.timer = minutes + "m " + seconds + "s ";

        if(distance < 0){
          tasks[i].timer = "Expired";
          problem = tasks[i];
          if(tasks[i].waiting !== 0){
            // Set waiting on false(0)
            $http({
                method: 'PUT',
                url: 'home/api/problem/'+tasks[i].id+'/resetWaiting',
                headers: {
                    "Content-Type": "application/json"
                },
                data: {}
            }).then(function(ress){
               console.log(problem);
              //socket emit event for changing task status
              socket.emit('updateProblemStatus', {emailTo: problem.user_from.email, problem_id: problem.id});
            });
          }
        }

        //If the count down is finished, write some text

      }

      var checkClearInterval = false;
      for (var i = doneCounters.length - 1; i >= 0; i--) {
        if (doneCounters[i] > 0) {
          checkClearInterval = true;
        }
      }
      if(!checkClearInterval){
        $interval.cancel(x);
      }

    }, 1000);
  }

app.controller('newProblemController', function($scope, $http, alertSerice, selectedFilesService, removeFileS3Service){
  $http({
      method: 'GET',
      url: '/home/api/application/categories',
      headers: {
          "Content-Type": "application/json"
      },
      data: {}
  }).then(function(res){
    $scope.categories = res.data;
  });
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

app.directive('problemShowDirective', function ($compile, $http, $parse) {
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

              var el3 = angular.element('<span>No offers.&nbsp; <span  ng-click="requestAgain()"><a href="home/problem/'+scope.problem.id+'/reset" style="position:absolute">Request again</a></span></sapn>');
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
              var el3 = angular.element('<span>No offers.&nbsp; <span  ng-click="requestAgain()"><a href="home/problem/'+scope.problem.id+'/reset" style="position:absolute">Request again</a></span></sapn>');
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

          var formBidElement = '<form name="offerForm" ng-submit="placeBid(id)" novalidate><div class = "input-group pull-left" style="width:150px;margin-right:10px"><span class = "input-group-addon">$</span><div class="form-group" ng-class="{ '+"'has-error'"+' : offerForm.biddingOffer.$invalid && !offerForm.biddingOffer.$pristine}"><input type = "number" min="1" class ="form-control" ng-model="biddingOffer" name="biddingOffer" style="height:54px;" required></div></div><div class="form-group" ng-class="{ '+"'has-error'"+' : offerForm.biddingDescription.$invalid && !offerForm.biddingDescription.$pristine}"><textarea class="form-control" placeholder="e.g. Problem can be solved in 10 mins with 1 file attached..." style="width:500px;resize:none" ng-model="biddingDescription" name="biddingDescription" required></textarea></div><button class="btn btn-primary" type="submit" style="float:left;border-radius: 0px;margin-top:5px" ng-disabled="offerForm.$invalid">Bid for this task</button></form>';



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
          $scope.placeBid = function(problemId){
            
            var offer = $scope.biddingOffer;
            var desc = $scope.biddingDescription;
              return $http({
                  method: 'POST',
                  url: '/home/api/application/placeOffer',
                  headers: {
                      "Content-Type": "application/json"
                  },
                  data: {probId: id, price: offer, description: desc}
              }).then(function(resp){

                alertSerice.successSweet('Success', 'success', 'Successfully bidded $'+offer+' on this task');
                $("#offerPlace").html('<span style="padding:13px 0px;position:absolute">Already bidded $'+offer+'</span>');
                //emit event
                var newOffer = {
                  price: offer,
                  description: desc,
                  problem_id: id,
                  user_from: d,
                  created_at: new Date()
                }
                socket.emit('updateTaskOffers', {emailTo: res.data.user_from.email, offer: newOffer});
              });
          };
        }).finally(function(){
          // $scope.loading02 = false;
        });
    }
  });
};

});
})(angular);
//SOCKETS
//|
//V
// socket.on('updateTaskOffersEmit',function(data){
//   angular.forEach(res.data, function(problem) {
//     if(problem.id == data.offer.problem_id){
//       var newOffer = {
//         created_at: data.offer.created_at,
//         description:data.offer.description,
//         price:data.offer.price,
//         persFrom:{
//           name: data.offer.user_from.name,
//           lastName: data.offer.user_from.lastName
//         }
//       }
//       problem.offers.push(newOffer);

//     }
//   });
//   $scope.$apply(function () {
//     $scope.problems = res.data;
//   });
// });

// socket.on('updateProblemStatusEmit', function(data){
//   var retVal = {};
//   var newProblems =  $http({
//   method: 'GET',
//   url: 'home/api/application/getOneUserProblems',
//   headers: {
//       "Content-Type": "application/json"
//   },
//   data: {}
// }).then(function(ress){
  
  
//     $scope.problems = ress.data;
  
// });
// // $scope.$apply(function () {
  
// // }          
//   // angular.forEach(res.data, function(problem) {
//   //   if(problem.id == data.problem_id){

//   //   }
//   // });
// });

// socket.on('updateAdminTimeEmit', function(){
//             $http({
//               method: 'GET',
//               url: 'home/api/application/getuserproblems',
//               headers: {
//                   "Content-Type": "application/json"
//               },
//               data: {}
//             }).then(function(ress){
//               $http({
//               method: 'GET',
//               url: 'home/problem/1/reset',
//               headers: {
//                   "Content-Type": "application/json"
//               },
//               data: {}
//             }).then(function(resss){
          
//             });
//               // console.log(ress.data);
       
      
//             });
//           });