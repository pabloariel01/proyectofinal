m.controller('capturasController', function($scope,$http,$controller) {
//$scope.var='hola';

// alert('asd');
$controller('BaseController', { $scope: $scope });
console.log($scope.test1);
$scope.titulo='Resumen de Capturas';
$scope.vector_especies = [];
$scope.acta=25;
$scope.form={};
$scope.form.b=[];


//trae un array con las especies y las cantidades
$scope.tabla_especies = function(){
    if (toggle){
        $http.post('/prueba/main/especies',{'acta':1}).success(function(data){
        $scope.vector_especies=data;
        });
    toggle=false;
    }
}

//cambia la tabla por una de porcentajes
$scope.porcentajes=function(){
    if (!toggle){
        $http.post('/prueba/main/getPorcentajes',{'acta':1,'campania':"(1,3,2,4,5,6)"}).success(function(data){
            $scope.vector_especies=data;
            console.log(data);
        });
    toggle=true;
    }
}




// TOTAL GENERAL
$scope.total=0
$scope.getTotales = function(){
    $http.post('/prueba/main/getTotales').success(function(data){
        $scope.total = data;
        // console.log(data[0]);
         // console.log($scope.total);
    });
}



$scope.totalPorLoc = function(){
    $http.post('/prueba/main/totalPorLoc',{'input':"1"}).success(function(data){
        // console.log( data);
        //  console.log($scope.localidades);
    });
}



var toggle=true;
// $scope.totalPorLoc();
$scope.getlocalidades();
$scope.getTotales();
$scope.actas_busqueda();
$scope.tabla_especies();
$scope.getCamps();
// console.log($scope.camps);
// console.log($scope.vector_especies);




$scope.sumcpueloc=function(){
        $http.post('/prueba/main/sumcpueloc',{'loc':'1','acta':'1'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

//segundo parametro es opt, puede ser cpue o cpueg
$scope.cuboCpueEspecies=function(){
        $http.post('/prueba/main/cuboCpueEspecies',{'loc':'1','opt':'cpue'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.rangocpuelst=function(){
        $http.post('/prueba/main/rangocpuelst',{'loc':'1'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.cuentaSexoEsp=function(){
        $http.post('/prueba/main/cuentaSexoEsp',{'loc':'1','acta':'1'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.cuentaGonada=function(){
        $http.post('/prueba/main/cuentaGonada',{'loc':'1'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}
//sexo 1=m 2=f
$scope.cuentaGonadaSexo=function(){
        $http.post('/prueba/main/cuentaGonadaSexo',{'loc':'1','sexo':1}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.cuentaEspGonada=function(){
        $http.post('/prueba/main/cuentaEspGonada',{'loc':'1','sexo':1}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.rgsXCien=function(){
        $http.post('/prueba/main/rgsXCien',{'loc':'3'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}
$scope.callAbmview=function(uri){
  // console.log(uri);

  // alert("");
  // console.log($scope.templates[3]);
  $scope.template={url: uri};
  // console.log($scope.template.url);
};
$scope.adduser=function(){
        $scope.template = $scope.templates[3];
        // $http.post('abmusuario/usuarios').then(function(data) {
              // console.log(data);

              // $scope.vector_especies1=data.data;
            // }, function(data, headersGetter, status) {console.log(data.data);
        // });
}







// alert("asd");
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

// ///////////////////
//totalypesoporloc
/////////////////////

m.controller('totalypesoporlocController', function($scope,$http,$controller) {
//$scope.var='hola';

// alert('asd');


  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Totales y Pesos';



  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  console.log($scope.camps);
  $scope.form ={'a':""};
  $scope.form.a="";
  $scope.form.b=3;
  $http.post('/prueba/main/totalypesoporloc',{'loc':'3','acta':'1'}).success(function(data){
      $scope.vector_especies=data;
  });
  $scope.filtrarpor=function(items) {
    var camps="(";
    // items="("+items.toString()+")";

    if (angular.isArray(items)){
      angular.forEach(items,function(v,k) {
          camps +=(v.id.toString()+",");
      })
    }
    camps=camps.substring(0, camps.length-1)+")";

    console.log(camps);
  }
});
