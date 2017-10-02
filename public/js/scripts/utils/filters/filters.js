(function(angular){
//Custom Date filter
app.filter('dateFilter', function($filter) {
  return function(input, format) {
       return $filter('date')(new Date(input), format);
  }
});
})(angular);