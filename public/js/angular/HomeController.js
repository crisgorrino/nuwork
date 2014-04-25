
var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});


function HomeController($scope, $http) {
	$scope.espacios = 1;
	$scope.meses = 1;
	$scope.precio_mensual_1 = 1700;
	$scope.precio_mensual_2 = 1900;
	$scope.precio_mensual_3 = 4000;


	$scope.getPrecioMensual = function(){
	 	$http.post('getPrecioMensual', {meses:$scope.meses, espacios:$scope.espacios} ).success(function(data){
	 		angular.forEach(data, function(value, key){
	 			if(value.paquete_id === 1){
	 				$scope.precio_mensual_1 = value.precio;	
	 			}
	 			if(value.paquete_id === 2){
	 				$scope.precio_mensual_2 = value.precio;	
	 			}
	 			if(value.paquete_id === 3){
	 				$scope.precio_mensual_3 = value.precio;	
	 			}
	 		});
	 	});
	}
}