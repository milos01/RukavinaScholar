(function(angular){
	"use strict";
	app.factory('UserResource',function(Restangular){

		var retVal = {};

		// /user
		retVal.getLoggedUser =  function(){
			return Restangular.one('user').get().then(function(response){
				return response;
			});
		}

		// /user/:id
		retVal.getUser =  function(id){
			return Restangular.one('user',id).get().then(function(response){
				return response;
			});
		}

		// /getAllModerators
		retVal.getAllModerators =  function(){
			return Restangular.one('getAllModerators').getList().then(function(response){
				return response;
			});
		}

		retVal.getLoggedUserTasks =  function(pageNum){
			return Restangular.one('getOneUserProblems').get({page: pageNum}).then(function(response){
				return response;
			});
		}

		retVal.updatePassword =  function(params){
			return Restangular.all('userpass').post(params).then(function(response){
				return response;
			});
		}


		return retVal;
	})
})(angular);