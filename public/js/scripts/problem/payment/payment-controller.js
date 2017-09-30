(function(angular){
app.controller('makePaymentController', function($scope, $http, alertSerice){
  $scope.makePayment = function(){
    var sloId = $("#slovlerId").val();
    var probId = $("#problemId").val();
    return $http({
            method: 'POST',
            url: '/home/api/application/makePayment',
            headers: {
                "Content-Type": "application/json"
            },
            data: {probId: probId, sloId: sloId}
        }).then(function(res){
          alertSerice.successSweet('Success', 'success', 'Successfully payed');
        });
  };
});
})(angular);