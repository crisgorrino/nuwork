
var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('Pagos', function($scope, $http){

	$scope.pagos = [];
    $scope.status = [];

    $scope.getPagos = function(){
        $http.get('getPagos').success(function(response){
            $scope.pagos = response;
            angular.forEach(response, function(pago){
                $scope.status[pago.id] = pago.status;
            });
        });        
    };

 	$scope.order = 'id';
 	$scope.reverse = true;

 	// variables de paginacion
	$scope.currentPage = 0;
	$scope.pageSize = 10;
 	$scope.numberOfPages=function(){
        return Math.ceil($scope.pagos.length/$scope.pageSize);                
    }

    $scope.options = [];
    $scope.options[0] = {id:1, value:'Pendiente'};
    $scope.options[1] = {id:2, value:'Pagado'};
    $scope.options[2] = {id:3, value:'Cancelado'};
    
    $scope.changeStatus = function(orden_id, status){
        if(status === '2'){
            $http({
                url: 'getPaqueteStock', 
                method: "PUT",
                params: {orden_id: orden_id, status:status}
            }).success(function(response){
                if(!response.sufficient){
                    $( "#dialog-confirm" ).dialog({
                      resizable: false,
                      height:140,
                      modal: true,
                      //buttons: {
                      //  "Delete all items": function() {
                      //      $( this ).dialog( "close" );
                      //  },
                      //  Cancel: function() {
                      //      $( this ).dialog( "close" );
                      //  }
                      //}
                    });
                    $scope.status[orden_id] = 1;
                }
            });
        }else{
            $http.post(
                'restoreStock',
                {orden_id: orden_id, status : status})
            .success(function(response){
                //console.log(response);
            });
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
