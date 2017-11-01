(function(angular){
	"use strict";
	app.factory('UserResource',function(Restangular){

		var retVal = {};

		retVal.getStaff = function (keywords) {
		    var searchData = {
		        'keywords': keywords
            }

            return Restangular.one('getSearchStaff').get(searchData).then(function(response){
                return response;
            });
        }
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

		retVal.getLoggedUserTasks =  function(pageNum, searchText, programming10, math10, physics10){
            var searchData = {
                page: pageNum,
                search: searchText,
                Programming: programming10,
                Math: math10,
                Physics: physics10
            }
			return Restangular.one('getOneUserProblems').get(searchData).then(function(response){
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