
(function (angular) {
  angular.module('kbkApp').controller('showProblemController', function($scope, $http){
    $scope.loading = true;
    $scope.limit = 20;
    $scope.colourIncludes = [];
    $scope.noFound = 'No problem found!';
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
          for (var i = res.data.length - 1; i >= 0; i--) {
            $http({
            method: 'POST',
            url: 'home/api/application/getuserproblemoffer',
            headers: {
                "Content-Type": "application/json"
            },
            data: {probId: res.data[i].id}
            }).then(function(offers){
              console.log(offers);
            });   
          }

          for (var i = res.data.length - 1; i >= 0; i--) {
            res.data[i].isCollapsed = true;
            res.data[i].showDown = true;
          }
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