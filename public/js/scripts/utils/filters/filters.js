(function(angular){
//Custom Date filter
app.filter('dateFilter', function($filter) {
    return function(input, format) {
    	return $filter('date')(new Date(input), format);
    }
});

app.filter('tookFilter', function(){
	return function(tasks) {
		var filtered = [];
		angular.forEach(tasks, function(task) {
	      if(task.inactive === 0) {
	        filtered.push(task);
	      }
	    });
		
		return filtered;
	}
});

app.filter('taskTypeFilter', function(){
	return function(tasks, taskTypeIncludes){
		var filtered = [];
		angular.forEach(tasks, function(task) {
	    	if (taskTypeIncludes.length > 0) {
	            if ($.inArray(task.task_type.name, taskTypeIncludes) >= 0)
	                filtered.push(task);
	        }else{
	        	filtered.push(task);
	        }
	    });

	    return filtered;
	}
})
})(angular);