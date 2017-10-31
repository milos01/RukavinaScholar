(function(angular){
	"use strict";
	app.factory('ProblemResource',function(Restangular){

		var retVal = {};

		// /getuserproblems
		retVal.getAllTasks =  function(pageNum, searchText, programming10, math10, physics10){
			var searchData = {
				page: pageNum,
				search: searchText,
				Programming: programming10,
				Math: math10,
                Physics: physics10
			}
			return Restangular.one('getuserproblems').get(searchData).then(function(response){
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
			return Restangular.one('problem', probId).get().then(function(response){
				return response;
			});
		}

		// /problem/{id}/reset
		retVal.getProblemReset =  function(id){
			return Restangular.one('problem', id).one('reset').get().then(function(response){
				return response;
			});
		}

		// /getAssignedToMe
		retVal.getAssignedToMe =  function(pageNum, searchText, programming10, math10, physics10){
            var searchData = {
                page: pageNum,
                search: searchText,
                Programming: programming10,
                Math: math10,
                Physics: physics10
            }
			return Restangular.one('getAssignedToMe').get(searchData).then(function(response){
				return response;
			});
		}

		// /placeOffer
		retVal.postPlaceOffer =  function(id, offer, description){
			var data = {
				id: id,
				offer: offer,
				description: description
			}
			return Restangular.all('placeOffer').post(data).then(function(response){
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

		// /category
		retVal.getTaskCategories =  function(){
			return Restangular.all('category').getList().then(function(response){
				return response;
			});
		}

		// /newproblemsubmit
		retVal.postNewTask =  function(data){
			return Restangular.all('newproblemsubmit').post(data).then(function(response){
				return response;
			});
		}

		// /newsolutionsubmit
		retVal.postTaskSolution =  function(data){
			return Restangular.all('newsolutionsubmit').post(data).then(function(response){
				return response;
			});
		}

		// /deltefile
		retVal.postDeleteFile =  function(data){
			return Restangular.all('deltefile').post(data).then(function(response){
				return response;
			});
		}

		return retVal;
	})
})(angular);