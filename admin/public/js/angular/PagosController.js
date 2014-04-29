
var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});


app.controller('Pagos', function($scope, $http){
	$scope.pagos = [];
	$http.get('getPagos').success(function(response){
		$scope.pagos = response;
		console.log(response);
 	});

 	$scope.order = 'id';
 	$scope.reverse = true;

 	// variables de paginacion
	$scope.currentPage = 0;
	$scope.pageSize = 5;
 	$scope.numberOfPages=function(){
        return Math.ceil($scope.pagos.length/$scope.pageSize);                
    }
});


//We already have a limitTo filter built-in to angular,
//let's make a startFrom filter
app.filter('startFrom', function() {
    return function(input, start) {
    	//console.log('input-->' + input);
        start = +start; //parse to int
        return input.slice(start);
    }
});
