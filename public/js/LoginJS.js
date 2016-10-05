socket = io('http://localhost:3000');
app.controller('loginController', function($scope, $http, $window){

  $scope.loginFormSubmit = function(){
      var email = $scope.email;
      var password = $scope.password;
      
      var remember = $scope.remember;
      console.log(email);
      $http({
        method: 'POST',
        url: '/login',
        data: { email: email, password: password, remember:remember}
      }).then(function successCallback(response) {
        console.log(response);
        if(response.data == 'logedin'){
          $window.location.href = '/home';
          socket.emit('my other event', { email: email });

          

        }
        console.log(response);
      }, function errorCallback(response) {
        alert('ne valja');
      });
  };
});