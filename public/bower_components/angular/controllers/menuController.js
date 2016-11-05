m.controller('menuController', function($scope,$http) {
//$scope.var='hola';

// alert('asd');
$scope.titulo='Resumen de Capturas'
$scope.vector_especies = [];
$scope.acta=24;

//trae un array con las especies y las cantidades
$scope.tabla_especies = function(){
    if (toggle){
        $http.post('prueba/especies',{'acta':1}).success(function(data){
        $scope.vector_especies=data;
        });
    toggle=false;
    }
}

//cambia la tabla por una de porcentajes
$scope.porcentajes=function(){
    if (!toggle){
        $http.post('prueba/getPorcentajes',{'acta':1}).success(function(data){
            $scope.vector_especies=data;
        });
    toggle=true;
    }
}

// DEVUELVE TODAS LAS ACTAS
$scope.actas=[];
$scope.actas_busqueda = function(){
    $http.post('prueba/traeractas').success(function(data){
        $scope.actas = data;
        // console.log($scope.data);
    });
}

// TOTAL GENERAL
$scope.total=0
$scope.getTotales = function(){
    $http.post('prueba/getTotales').success(function(data){
        $scope.total = data;
        // console.log(data[0]);
         // console.log($scope.total);
    });
}


$scope.localidades=[];
$scope.getlocalidades = function(){
    $http.post('prueba/getLocalidadesxcamp').success(function(data){
        $scope.localidades = data;
         // console.log($scope.localidades);
    });
}
$scope.totalPorLoc = function(){
    $http.post('prueba/totalPorLoc',{'input':"1"}).success(function(data){
        console.log( data);
         // console.log($scope.localidades);
    });
}



var toggle=true;
$scope.totalPorLoc();
$scope.getlocalidades();
$scope.getTotales();
$scope.actas_busqueda();
$scope.tabla_especies();

 
// Morris.Line({
//   element: 'line-example',
//   data: 'vector_especies',
//   xkey: 'descripcion',
//   ykeys: ["ITU", "ITA","ABR","PGO"],
//   labels: ["itu", "ita","abr","pgo"]
 
  
// });

// class="line-chart"
//                               line-chart
//                               line-post-units="'%'"  
//                               line-data='vector_especies'
//                               line-xkey='descripcion'
//                               line-ykeys='["ITU", "ITA","ABR","PGO"]'
//                               line-labels='["itu", "ita","abr","pgo"]'
//                               line-colors='["#31C0BE", "#c7254e","#c225ff","#ff254e"]'
//                               resize='true'
//                               ymax='25'>


});