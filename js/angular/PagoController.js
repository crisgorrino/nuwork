var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('Pago', function($scope){
	$scope.metodo = 'credito'
});