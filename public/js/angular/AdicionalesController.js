var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('Adicionales', function($scope){
	
	$scope.adicional_1 = false;
	$scope.adicional_2 = false;
	$scope.adicional_3 = false;
	$scope.adicional_4 = false;
	$scope.adicional_5 = false;
});