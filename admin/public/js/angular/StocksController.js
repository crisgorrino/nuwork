var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});


app.controller('Stock', function($scope, $http){

	// obtener el stock de todos las paquetes
	$scope.stock = [];
 	$http.get('getStocks').success(function(response){
 		angular.forEach(response, function(value, key){
			$scope.stock[value.paquete_id] = value.stock;
 		});
 	});


 	// actualizar el stock del paquete
 	$scope.saveStock = function(paquete_id){
 		
 		if(isNaN($scope.stock[paquete_id])){
 			$scope.stock[paquete_id] = 0;
 		}

 		$http.put('saveStock', {paquete_id: paquete_id, stock: $scope.stock[paquete_id]} ).success(function(response){
 			//console.log(response);	
 		});

	 	
 	};

});
