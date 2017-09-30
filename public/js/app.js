
(function (angular) {
// socket = io('http://localhost:3000');
app = angular.module('kbkApp', ['restangular'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

app.config(function(RestangularProvider) {
  RestangularProvider.setBaseUrl('api/application');
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
// //Custom Date filter
// app.filter('dateFilter', function($filter) {
//   // In the return function, we must pass in a single parameter which will be the data we will work on.
//   // We have the ability to support multiple other parameters that can be passed into the filter optionally
//   return function(input, format) {
//        return $filter('date')(new Date(input), format);
// }
// });



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
