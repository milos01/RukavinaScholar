
(function (angular) {
// socket = io('http://localhost:3000');
app = angular.module('kbkApp', ['ui.bootstrap', 'restangular', 'ngSanitize', 'ui.footable', 'btford.socket-io', 'toastr'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

app.config(function(RestangularProvider) {
  RestangularProvider.setBaseUrl('/api/application');
  RestangularProvider.setErrorInterceptor(function(response) {
    if (response.status === 500) {
        $log.info("internal server error");
        return true;
    }
    return true;
  });
});

// DELETE?
// |
// V
// app.controller('braintreeController', function($scope, $http){
//     // $http({
//     //     method: 'GET',
//     //     url: '/home/api/application/generateToken',
//     //     data: {}
//     // }).then(function successCallback(res) {
//     //     braintree.setup(res.data.token, 'dropin', {
//     //       container: 'dropin-container'
//     //     });
//     // });
// });


})(angular);
