(function(angular){
app.factory('UtilService', function($http){
    return {
        findMin: function(task){
        	var min = Number.MAX_SAFE_INTEGER;
            var minOffer;

            angular.forEach(task.offers, function(value, key) {
                if(value.price < min){
                  min = value.price;
                  minOffer = value;
                }
             })

            return minOffer;
        },
        STATUS: {
        	MIN_OFFER : {message: "Offer:"},
        	NO_OFFERS : {message: "No offers"},
        	UNDER_WORK : {message: "Under work..."},
        	FINISHED : {message: "Finished"},
        	WAITING_OFFERS : {message: "Waiting for offers"},
        	MY_OFFER : {message: "(You bidded)"}

        } 
    }
});
})(angular);