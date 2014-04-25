var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('Reservar', function($scope, $http){
	 $scope.costo_adicionales = 0;

 	$scope.precio_mensual_1 = 1700;
	$scope.precio_mensual_2 = 1900;
	$scope.precio_mensual_3 = 4000;
	$scope.costo_toal = {};

	$scope.getPaquetePrecioMensual = function(){
	 	$http.post('getPaquetePrecioMensual', {meses:$scope.meses, espacios:$scope.espacios, paquete_id:$scope.paquete_id} ).success(function(data){
	 		$scope.precio_mensual = data.precio;
	 	});
	}

});

app.filter("totalPrice", function() {
  return function(items = []) {
  	var total = 0, i = 0;
  	if(items.length > 0){
  		console.log(items);
	    for (i = 0; i < items.length; i++) total += items.price;
	 	angular.forEach(items, function(key, value){
			total += key;
		});	
  	}
    return total;
  }
});