
var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});


app.controller('Solicitudes', function($scope, $http){
	$scope.solicitudes = [];
	$http.get('getSolicitudes').success(function(response){
		$scope.solicitudes = response;
 	});

 	$scope.order = 'id';
 	$scope.reverse = true;

 	// variables de paginacion
	$scope.currentPage = 0;
	$scope.pageSize = 10;
 	$scope.numberOfPages=function(){
        return Math.ceil($scope.solicitudes.length/$scope.pageSize);                
    }
});


app.controller('Solicitud', function($scope, $http){
	
	// obtener todos los status disponibles de las solicitudes
	$scope.options = [];
	$http.get('../getSolicitudEstatus').success(function(response){	
		angular.forEach(response, function(value, key){
			$scope.options[value.id] = {id:value.id, descripcion:value.descripcion};	
		});
	});

	// actualizar el status de una solicitud
	$scope.updateStatus = function(){
		if(isNaN($scope.status)){
			alert('Debe seleccionar una opción valida');
		}else{
			var save = confirm('¿Desea actualizar el estatus de ésta solicitud?');
			if(save){
				$http.put('../updateSolicitudEstatus', 
					{solicitud_id:$scope.solicitud_id, status: $scope.status})
				.success(function(response){
					alert('Solicitud Actualizada');
				});
				console.log('Actualizando solicitud');
			}
		}
	};

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
