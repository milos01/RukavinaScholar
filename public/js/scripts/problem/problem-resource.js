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
			return Restangular.one('problem', id).all('inactive').customPUT(taskId).then(function(response){
				return response;
			});
		}

		// /problem/{id}/resetWaiting
		retVal.putResetTaskWaiting =  function(id){
			var taskId = {
				'id': id
			};
			return Restangular.one('problem', id).all('resetWaiting').customPUT(taskId).then(function(response){
				return response;
			});
		}

		// /problem/{id}
		retVal.getProblem =  function(probId){
			return Restangular.one('problem', probId).getList().then(function(response){
				return response;
			});
		}

		// /acceptProblem
		retVal.postAcceptOffer =  function(probId, sloId){
			var data = {
				probId: probId,
				sloId: sloId
			}
			return Restangular.all('acceptProblem').post(data).then(function(response){
				return response;
			});
		}

		return retVal;
	})
})(angular);