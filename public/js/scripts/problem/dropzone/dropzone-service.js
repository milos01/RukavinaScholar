(function(angular){
app.factory('DropzoneService', function($http){
    return {
        addedFiles: [],
        currentFiles : []
    }
});
})(angular);