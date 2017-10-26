m.controller('menuController', function($scope,$http) {
//$scope.var='hola';

// alert('asd');

$scope.titulo='Resumen de Capturas';
$scope.vector_especies = [];
$scope.acta=24;
$scope.form={};
$scope.form.b=[];

$scope.templates =
  [{ name: 'resumenCapturas', url: 'vistas/resumenCapturas'},
   { name: 'template2.html', url: 'vistas/totalypesoporloc'},
   { name: 'sumcpueloc', url: 'vistas/sumcpueloc'},
   {name:'abmusers',url:'abmusuario/usuarios'}
  ];


$scope.traertablaespecies=function() {
  // $http.get('vistas/resumenCapturas').then(function successCallback(data) {
  //   // console.log(data.data);
  //   $scope.vistas=data.data;
  // });
  toggle=true;
  $scope.tabla_especies();
  $scope.template = $scope.templates[0];

}
//trae un array con las especies y las cantidades
$scope.tabla_especies = function(){
    if (toggle){
        $http.post('prueba/especies',{'acta':1,'campania':""}).success(function(data){
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
        // console.log(data);
    });
}
$scope.camps=[];
$scope.getCamps= function() {
  $http.post('prueba/getCamps',{'acta':1}).success(function(data){
      $scope.camps=data;
      // console.log(data);
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
        // console.log( data);
         // console.log($scope.localidades);
    });
}



var toggle=true;
$scope.totalPorLoc();
$scope.getlocalidades();
$scope.getTotales();
$scope.actas_busqueda();
$scope.tabla_especies();
$scope.getCamps();
// console.log($scope.camps);
// console.log($scope.vector_especies);


// ///////////////////
//totalypesoporloc
/////////////////////
$scope.totalypesoporloc=function(){

        // $http.post('prueba/totalypesoporloc/1/1').success(function(data){
        //     $scope.vector_especies=data;
        //     console.log(data);
        // });

        $http.post('prueba/totalypesoporloc',{'loc':'3','acta':'1'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(status);
        });
}

$scope.sumcpueloc=function(){
        $http.post('prueba/sumcpueloc',{'loc':'1','acta':'1'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

//segundo parametro es opt, puede ser cpue o cpueg
$scope.cuboCpueEspecies=function(){
        $http.post('prueba/cuboCpueEspecies',{'loc':'1','opt':'cpue'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.rangocpuelst=function(){
        $http.post('prueba/rangocpuelst',{'loc':'1'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.cuentaSexoEsp=function(){
        $http.post('prueba/cuentaSexoEsp',{'loc':'1','acta':'1'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.cuentaGonada=function(){
        $http.post('prueba/cuentaGonada',{'loc':'1'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}
//sexo 1=m 2=f
$scope.cuentaGonadaSexo=function(){
        $http.post('prueba/cuentaGonadaSexo',{'loc':'1','sexo':1}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.cuentaEspGonada=function(){
        $http.post('prueba/cuentaEspGonada',{'loc':'1','sexo':1}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}

$scope.rgsXCien=function(){
        $http.post('prueba/rgsXCien',{'loc':'3'}).then(function(data) {
              console.log(data);
              $scope.template = $scope.templates[1];
              $scope.vector_especies1=data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });
}
$scope.callAbmview=function(uri){
  console.log(uri);
  alert("");
  // console.log($scope.templates[3]);
  $scope.template={url: uri};
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
