var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('Reservar', function($scope, $http){
	
	$scope.costo_adicionales = 0;

	$scope.getPaquetePrecioMensual = function(){
	 	$http.post('getPaquetePrecioMensual', {meses:$scope.meses, espacios:$scope.espacios, paquete_id:$scope.paquete_id} ).success(function(data){
	 		$scope.precio_mensual = parseFloat(data.precio);
	 	});
	}

	// adicionales info
	$scope.cantidad =[];
	$scope.adicional_meses = [];
	$scope.costo_total = [];
	$scope.costo = [];

	$scope.getTotales = function(){
		var total = 0;
		angular.forEach($scope.cantidad, function(value, key){
			var costo_de_decorado = $scope.costo[key];
			var cantidad = value;
			var meses = $scope.adicional_meses[key];

			var subtotal = costo_de_decorado * cantidad * meses;
			total += subtotal;
		});
		$scope.costo_adicionales = total;
	};
});
