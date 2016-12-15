(function (angular) {
// socket = io('http://localhost:3000');
angular.module('kbkApp').controller('loginController', function($scope, $http, $window){

  $scope.loginFormSubmit = function(){
      var email = $scope.email;
      var password = $scope.password;
      
      var remember = $scope.remember;
      
      $http({
        method: 'POST',
        url: '/login',
        data: { email: email, password: password, remember:remember}
      }).then(function successCallback(response) {
        console.log(response);
        if(response.data == 'logedin'){
           $window.location.href = '/home';
           // socket.emit('my other event', { email: email });

          

        }
        
      }, function errorCallback(response) {
        alert('ne valja');
      });
  };
});
})(angular);