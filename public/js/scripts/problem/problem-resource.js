(function(angular){
	"use strict";
	app.factory('ProblemResource',function(Restangular){

		var retVal = {};

		// /getuserproblems
		retVal.getAllTasks =  function(){
			return Restangular.all('getuserproblems').getList().then(function(response){
				return response;
			});
		}

		// /problem/{id}/inactive
		retVal.putTaskInactive =  function(id){
			var taskId = {
				'id': id
			};
			return Restangular.one('problem', id).all('inactive').post('taskId').then(function(response){
				return response;
			});
		}

		return retVal;
	})
})(angular);