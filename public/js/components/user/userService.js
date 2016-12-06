(function (angular) {
  angular.module('kbkApp').factory('loggedUserService', function($http) {
        
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
})(angular);