(function(angular){
app.controller('userSearchController',function(searchService, searchService2, $scope, $compile, $http){
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

app.controller('editUserInfoController', function($scope){
  $scope.init = function(user){
    $scope.firstName = user.name;
    $scope.lastName = user.lastName;
  };
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