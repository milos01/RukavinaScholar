(function(){
app.service('searchService', function($http){
    return {
        search: function(keywords, problemId){
            console.log(keywords);
            console.log(problemId);

            return $http.post('/home/api/application/getusers', { "username" : keywords, "problemId" : problemId});
        }
    }
});

app.service('searchService2', function($http){
    return {
        search: function(keywords, problemId){
            console.log(keywords);
            console.log(problemId);

            return $http.post('/home/api/application/getusers2', { "username" : keywords, "problemId" : problemId});
        }
    }
});
})(angular);