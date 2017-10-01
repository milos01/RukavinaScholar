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


		
		// /user/:uid
		retVal.getUserById =  function(uid){
			return Restangular.one('user',uid).get().then(function(response){
				return response;
			});
		}

		retVal.getLoggedUserTasks =  function(){
			return Restangular.one('getOneUserProblems').get().then(function(response){
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