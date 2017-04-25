(function (angular) {
// socket = io('http://localhost:3000');
app.controller('loginController', function($scope, $http, $window){
  $scope.loginFormSubmit = function(){
      var email = $scope.email;
      var password = $scope.password;
      
      var remember = $scope.remember;
      
      $http({
        method: 'POST',
        url: '/login',
        data: { email: email, password: password, remember:remember}
      }).then(function successCallback(response) {
        if(response.data == 'logedin'){
           $window.location.href = '/home';
        }else{
          $scope.loginForm1.email.$setValidity("wrongInputs", false);
          $scope.loginForm1.password.$setValidity("wrongInputs", false);
        }
      }, function errorCallback(response) {
        alert('ne valja');
      });
  };
})

app.controller('registerController', function($scope){
  $scope.registerUserForm = function(){
    alert("radi");
  }
});

})(angular);