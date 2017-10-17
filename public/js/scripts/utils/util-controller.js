(function(){

$(document).mouseup(function (e)
{
    var container = $("#responseDiv");
    var container2 = $("#responseDiv2");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0 || !container2.is(e.target) // if the target of the click isn't the container...
        && container2.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $("#responseDiv").hide();
        $("#responseDiv2").hide();
    }
});

app.factory('selectedFilesService', function() {
    return {
        selectedFiles : []
    };
});

app.controller('navigationController', function($scope){
  $scope.isSelected = function(menuItem){
    return $scope.selected === menuItem;
  }

  $scope.setActive = function(item){
    $scope.selected = item;
  }
})

app.directive('capitalizeFirst', function($parse) {
   	return {
    	require: 'ngModel',
    	link: function(scope, element, attrs, modelCtrl) {
        var capitalize = function(inputValue) {
           if (inputValue === undefined) { inputValue = ''; }
           var capitalized = inputValue.charAt(0).toUpperCase() +
                             inputValue.substring(1);
           if(capitalized !== inputValue) {
              modelCtrl.$setViewValue(capitalized);
              modelCtrl.$render();
            }
            return capitalized;
         }
         modelCtrl.$parsers.push(capitalize);
         capitalize($parse(attrs.ngModel)(scope)); // capitalize initial value
     }
   };
});

app.directive('passwordLength', function($timeout, $q, $http){
    return {
        require: 'ngModel',
    	link: function(scope, elm, attr, model) {
            model.$asyncValidators.passwordLen = function() {
                console.log();
                if(model.$viewValue.length >= 4 && model.$viewValue.length <= 10){
                  model.$setValidity('passlen', true);
                  return $q.resolve();
                }else{
                  model.$setValidity('passlen', false);
                  return $q.reject();
                }
            };
        }
 	}
});

app.directive('myOffer', function(UserResource) {
	return {
    template: 'From: {{offer.personFrom.name}} {{offer.personFrom.lastName}}<b ng-show=\"offer.isMine\">(You)</b>',
  	restrict: 'A',
  	scope: {
   	  offer: '=',
      user: '='
    },
    link: function(scope) {
      UserResource.getUser(scope.offer.person_from).then(function(personFrom){
        scope.offer.personFrom = personFrom;
        if(scope.user.id === scope.offer.personFrom.id){
          scope.offer.isMine = true;
        }
      });
  	}
  }
});

app.directive('fooRepeatDone', function() {
    return function($scope, element) {
        if ($scope.$last) { // all are rendered
            $('.table').trigger('footable_redraw');
        }
    }
});
app.directive("passwordVerify", function() {
    return {
        require: "ngModel",
        scope: {
            passwordVerify: '='
        },
        link: function(scope, element, attrs, ctrl) {
            scope.$watch(function() {
                var combined;

                if (scope.passwordVerify || ctrl.$viewValue) {
                    combined = scope.passwordVerify + '_' + ctrl.$viewValue;
                }
                return combined;
            }, function(value) {
              if(scope.passwordVerify){
                if (value) {
                    console.log("s");
                    ctrl.$parsers.unshift(function(viewValue) {
                        var origin = scope.passwordVerify;

                        if (origin !== viewValue) {
                            ctrl.$setValidity("passwordVerify", false);
                            return undefined;
                        } else {
                            ctrl.$setValidity("passwordVerify", true);
                            return viewValue;
                        }
                    });
                }
              }
            });
        }
    };
});

app.service('removeFileS3Service', function($http){
    return {
        remove: function(fileName){
            return $http.post('/home/api/application/removeUploadedFile', { "fileName" : fileName});
        }
    }
});

app.controller('toggleController', function($scope){
  $scope.showDetails = function(){
    $('.modUpdate').toggle();
  }
});

})(angular);