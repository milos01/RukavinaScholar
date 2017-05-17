
(function (angular) {
  angular.module('kbkApp').controller('showProblemController', function($scope, $http, $interval){
    $scope.loading = true;
    $scope.limit = 20;
    $scope.colourIncludes = [];
    $scope.noFound = 'No problems found!';
    $http({
        method: 'GET',
        url: 'home/api/application/getuser',
        headers: {
            "Content-Type": "application/json"
        },
        data: {}
    }).then(function(res){
        var loggedUser = res.data;
        if (res.data.role.name == "regular") {
          $scope.showOffersManu = false;
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
        $scope.showOffersManu = true;
        $http({
            method: 'GET',
            url: 'home/api/application/getuserproblems',
            headers: {
                "Content-Type": "application/json"
            },
            data: {}
        }).then(function(res){
 
          $scope.problems = res.data;
          
          // for (i = res.data.length - 1; i >= 0; i--) {
          //   console.log(i);
          //   c = i;
          //   $http({
          //   method: 'POST',
          //   url: 'home/api/application/getuserproblemoffer',
          //   headers: {
          //       "Content-Type": "application/json"
          //   },
          //   data: {probId: res.data[i].id}
          //   }).then(function(offers){
          //     console.log(c);
          //     // for (var i = res.data.length - 1; i >= 0; i--) {
                
          //      // res.data[i].offersList = offers.data;
          //     // }
          //   });   
          // }

          for (var i = res.data.length - 1; i >= 0; i--) {
            
            





            res.data[i].isCollapsed = true;
            
            if(res.data[i].offers.length === 0){
              res.data[i].showDown = false;
              res.data[i].showUp = false;
            }else{
              res.data[i].showDown = true;
            }
            
            
          }
          var x = $interval(function() {

                var doneCounters = [];

                for (var i = res.data.length - 1; i >= 0; i--) {

                  var countDownDate = new Date(res.data[i].time_ends_at).getTime();
                  
                  
                  
                  // Get todays date and time
                  var now = new Date().getTime();

                  // Find the distance between now an the count down date
                  var distance = countDownDate - now;
                  doneCounters[i] = distance;
                  console.log('ch');

                  // Time calculations for days, hours, minutes and seconds
                  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                  // Display the result in the element with id="demo"
                  res.data[i].timer = minutes + "m " + seconds + "s ";
                  
                  if(distance < 0){
                    res.data[i].timer = "Expired"
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
    

    // $scope.loadMore = function() {
    //   // var increamented = 
    //   alert("uso");
    //   $scope.limit += 10;
    //   // $scope.limit = increamented > $scope.problems.length ? $scope.problems.length : increamented;
    // };

  });
})(angular);