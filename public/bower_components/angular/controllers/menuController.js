m.controller('capturasController', function($scope,$http,$controller) {
//$scope.var='hola';

// alert('asd');
$controller('BaseController', { $scope: $scope });
$scope.titulo='Resumen de Capturas';
$scope.vector_especies = [];
$scope.acta=25;
$scope.form={};
$scope.form.b=[];
$scope.selected={"id":"1","descripcion":"25"};



  $scope.gridOptions = {
    enableFiltering: true,
    enableGridMenu: false,
    exporterMenuCsv:true,
    exporterLinkLabel: 'get your csv here',
    exporterCsvFilename: 'myFile.csv',
    columnDefs: [
      { field: 'esp',
        filterHeaderTemplate: '<div class="ui-grid-filter-container" ng-repeat="colFilter in col.filters"><div my-custom-modal></div></div>'
      },{ field: 'ITU' , enableFiltering: false},{ field: 'ITA' , enableFiltering: false},{ field: 'PGO', enableFiltering: false },
      { field: 'ABR' , enableFiltering: false},
      { field: 'total', enableFiltering: false }


    ],
    // data:$scope.vector_especies,
    exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    }
  };

  $scope.export = function(){
      var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
      $scope.gridApi.exporter.csvExport( "all", "all", myElement );

  };

//trae un array con las especies y las cantidades
$scope.tabla_especies = function(){
    if (toggle){
        $http.post('/prueba/main/especies',{'acta':$scope.selected.id}).success(function(data){
        $scope.vector_especies=data;
        $scope.gridOptions.data = data;
        console.log(data);
        });
        toggle=false;
    }
}

//cambia la tabla por una de porcentajes
$scope.porcentajes=function(){
    if (!toggle){
        $http.post('/prueba/main/getPorcentajes',{'acta':$scope.selected.id}).success(function(data){
            $scope.vector_especies=data;
            $scope.gridOptions.data = data;

        });
    toggle=true;
    }
};



// TOTAL GENERAL
$scope.total=0
$scope.getTotales = function(){
    $http.post('/prueba/main/getTotales').success(function(data){
        $scope.total = data;

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
$scope.tabla_especies(1,"");
$scope.getCamps();
// console.log($scope.camps);
// console.log($scope.vector_especies);






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

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Totales y Pesos';


  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.form ={'a':"",'b':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.selected={"id":"1","descripcion":"25"};

  $scope.actualizarTabla=function () {
      $http.post('/prueba/main/totalypesoporloc',{'loc':$scope.form.a.idlocalidad,'acta':$scope.selected.id}).success(function(data){
          $scope.vector_especies=data;
      });
  }
  $scope.actualizarTabla();

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


m.controller('sumcpuelocController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Captura por Unidad de Esfuerzo';


  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.form ={'a':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.selected={"id":"1","descripcion":"25"};



  $scope.actualizarTabla=function () {
    $http.post('/prueba/main/sumcpueloc',{'loc':$scope.form.a.idlocalidad,'acta':$scope.selected.id}).then(function(data) {
          $scope.vector_especies=data.data;

        }, function(data, headersGetter, status) {console.log(data);
    });
  };

  $scope.actualizarTabla();
});


m.controller('cuboCpueEspeciesController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='suma Captura por Unidad de Esfuerzo(CPUE) por Localidad';


  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.modificador=["cpue","cpueg"];
  $scope.form ={'a':"",'b':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.form.b="cpue"
  $scope.selected={"id":"1","descripcion":"25"};



  $scope.gridOptions = {
    enableFiltering: true,
    enableGridMenu: false,
    exporterMenuCsv:true,
    exporterLinkLabel: 'get your csv here',
    exporterCsvFilename: 'myFile.csv',
    columnDefs: [
      { field: 'esp',
        filterHeaderTemplate: '<div class="ui-grid-filter-container" ng-repeat="colFilter in col.filters"><div my-custom-modal></div></div>'
      },
      { field: '1' , enableFiltering: false},{ field: '2' , enableFiltering: false},{ field: '3' , enableFiltering: false},{ field: '4', enableFiltering: false },{ field: '5', enableFiltering: false },{ field: '6', enableFiltering: false },
      { field: '7', enableFiltering: false },{ field: '8', enableFiltering: false },{ field: '9' , enableFiltering: false},{ field: '10', enableFiltering: false },{ field: '11', enableFiltering: false },{ field: '12', enableFiltering: false },
      { field: 'promedio', enableFiltering: false },
      { field: 'total', enableFiltering: false },


    ],
    // data:$scope.vector_especies,
    exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    }
  };

  $scope.export = function(){
      var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
      $scope.gridApi.exporter.csvExport( "all", "all", myElement );

  };

  $scope.actualizarTabla=function () {
    //segundo parametro es opt, puede ser cpue o cpueg
            $http.post('/prueba/main/cuboCpueEspecies',{'loc':$scope.form.a.idlocalidad,'opt':$scope.form.b}).then(function(data) {
                  // console.log(data);
                  $scope.vector_especies=data.data;
                  $scope.gridOptions.data = data.data;
                }, function(data, headersGetter, status) {console.log(data.data);
            });
  };

  $scope.actualizarTabla();
});


m.controller('rangocpuelstController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='suma Captura por Unidad de Esfuerzo(CPUE) por Localidad';


  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.modificador=["cpue","cpueg"];
  $scope.form ={'a':"",'b':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.form.b="cpue"
  $scope.selected={"id":"1","descripcion":"25"};



  $scope.gridOptions = {
    enableGridMenu: false,
    exporterMenuCsv:true,
    exporterLinkLabel: 'get your csv here',
    exporterCsvFilename: 'myFile.csv',

    exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    }
  };


  $scope.actualizarTabla=function () {
            $http.post('/prueba/main/rangocpuelst',{'loc':$scope.form.a.idlocalidad}).then(function(data) {
                  $scope.gridOptions.data = data.data;
                }, function(data, headersGetter, status) {console.log(data.data);
            });

  };

  $scope.actualizarTabla();
});


///NUEVO
m.controller('cuentaSexoEspController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Totales por Sexo';

  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.modificador=["cpue","cpueg"];
  $scope.form ={'a':"",'b':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.form.b="cpue"
  $scope.selected={"id":"1","descripcion":"25"};

  $scope.gridOptions = {
    enableGridMenu: false,
    exporterMenuCsv:true,
    exporterLinkLabel: 'get your csv here',
    exporterCsvFilename: 'myFile.csv',

    exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    }
  };



  $scope.actualizarTabla=function () {


            $http.post('/prueba/main/cuentaSexoEsp',{'loc':$scope.form.a.idlocalidad,'acta':$scope.selected.id}).then(function(data) {
                  $scope.gridOptions.data = data.data;
                }, function(data, headersGetter, status) {console.log(data.data);
            });

            $http.post('/prueba/main/rangocpuelst',{'loc':$scope.form.a.idlocalidad}).then(function(data) {

                }, function(data, headersGetter, status) {console.log(data.data);
            });

  };

  $scope.actualizarTabla();
});

m.controller('cuentaGonadaController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Total por Estado de Gonada';


  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.form ={'a':"",'b':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.form.b="cpue"
  $scope.selected={"id":"1","descripcion":"25"};



  $scope.gridOptions = {
    // enableFiltering: true,
    enableGridMenu: false,
    exporterMenuCsv:true,
    exporterLinkLabel: 'get your csv here',
    exporterCsvFilename: 'myFile.csv',
    columnDefs: [
      { field: 'des',displayName: "Descripcion"},
      { field: '1' , enableFiltering: false},{ field: '2' , enableFiltering: false},{ field: '3' , enableFiltering: false},{ field: '4', enableFiltering: false },{ field: '5', enableFiltering: false },{ field: '6', enableFiltering: false },
      { field: '7', enableFiltering: false },{ field: '8', enableFiltering: false },{ field: '9' , enableFiltering: false},{ field: '10', enableFiltering: false },{ field: '11', enableFiltering: false },{ field: '12', enableFiltering: false },

      { field: 'total', enableFiltering: false },


    ],
    exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    }
  };

  $scope.export = function(){
      var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
      $scope.gridApi.exporter.csvExport( "all", "all", myElement );

  };

  $scope.actualizarTabla=function () {

            $http.post('/prueba/main/cuentaGonada',{'loc':$scope.form.a.idlocalidad}).then(function(data) {
                  $scope.gridOptions.data = data.data;
                }, function(data, headersGetter, status) {console.log(data.data);
            });

  };

  $scope.actualizarTabla();
});


m.controller('cuentaGonadaSexoController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Total por estado de gonada y sexo';


  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.form ={'a':"",'b':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.form.b={'id':1,'nombre':"Macho"};
  $scope.selected={"id":"1","descripcion":"25"};

  $scope.modificador=[{'id':1,'nombre':"Macho"},{'id':2,'nombre':"Hembra"}];



  $scope.gridOptions = {
    // enableFiltering: true,
    enableGridMenu: false,
    exporterMenuCsv:true,
    exporterLinkLabel: 'get your csv here',
    exporterCsvFilename: 'myFile.csv',
    // columnDefs: [
    //   { field: 'des',displayName: "Descripcion"},
    //   { field: '1' , enableFiltering: false},{ field: '2' , enableFiltering: false},{ field: '3' , enableFiltering: false},{ field: '4', enableFiltering: false },{ field: '5', enableFiltering: false },{ field: '6', enableFiltering: false },
    //   { field: '7', enableFiltering: false },{ field: '8', enableFiltering: false },{ field: '9' , enableFiltering: false},{ field: '10', enableFiltering: false },{ field: '11', enableFiltering: false },{ field: '12', enableFiltering: false },
    //
    //   { field: 'total', enableFiltering: false },
    //
    //
    // ],
    exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    }
  };

  $scope.export = function(){
      var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
      $scope.gridApi.exporter.csvExport( "all", "all", myElement );

  };

  $scope.actualizarTabla=function () {

    //sexo 1=m 2=f

            $http.post('/prueba/main/cuentaGonadaSexo',{'loc':$scope.form.a.idlocalidad,'sexo':$scope.form.b.id}).then(function(data) {
                  $scope.gridOptions.data = data.data;
                }, function(data, headersGetter, status) {console.log(data.data);
            });


  };

  $scope.actualizarTabla();
});


m.controller('cuentaEspGonadaController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Total de Especies por Estado de Gonada y Sexo';


  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.form ={'a':"",'b':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.form.b={'id':1,'nombre':"Macho"};
  $scope.selected={"id":"1","descripcion":"25"};

  $scope.modificador=[{'id':1,'nombre':"Macho"},{'id':2,'nombre':"Hembra"}];



  $scope.gridOptions = {
    // enableFiltering: true,
    enableGridMenu: false,
    exporterMenuCsv:true,
    exporterLinkLabel: 'get your csv here',
    exporterCsvFilename: 'myFile.csv',
    // columnDefs: [
    //   { field: 'des',displayName: "Descripcion"},
    //   { field: '1' , enableFiltering: false},{ field: '2' , enableFiltering: false},{ field: '3' , enableFiltering: false},{ field: '4', enableFiltering: false },{ field: '5', enableFiltering: false },{ field: '6', enableFiltering: false },
    //   { field: '7', enableFiltering: false },{ field: '8', enableFiltering: false },{ field: '9' , enableFiltering: false},{ field: '10', enableFiltering: false },{ field: '11', enableFiltering: false },{ field: '12', enableFiltering: false },
    //
    //   { field: 'total', enableFiltering: false },
    //
    //
    // ],
    exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    }
  };

  $scope.export = function(){
      var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
      $scope.gridApi.exporter.csvExport( "all", "all", myElement );

  };

  $scope.actualizarTabla=function () {

        //sexo 1=m 2=f
        $http.post('/prueba/main/cuentaEspGonada',{'loc':$scope.form.a.idlocalidad,'sexo':$scope.form.b.id}).then(function(data) {
              $scope.gridOptions.data = data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });

  };

  $scope.actualizarTabla();
});


m.controller('rgsXCienController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Regresion Porcentual';


  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.form ={'a':"",'b':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.form.b={'id':1,'nombre':"Macho"};
  $scope.selected={"id":"1","descripcion":"25"};

  $scope.modificador=[{'id':1,'nombre':"Macho"},{'id':2,'nombre':"Hembra"}];



  $scope.gridOptions = {
    // enableFiltering: true,
    enableGridMenu: false,
    exporterMenuCsv:true,
    exporterLinkLabel: 'get your csv here',
    exporterCsvFilename: 'myFile.csv',
    // columnDefs: [
    //   { field: 'des',displayName: "Descripcion"},
    //   { field: '1' , enableFiltering: false},{ field: '2' , enableFiltering: false},{ field: '3' , enableFiltering: false},{ field: '4', enableFiltering: false },{ field: '5', enableFiltering: false },{ field: '6', enableFiltering: false },
    //   { field: '7', enableFiltering: false },{ field: '8', enableFiltering: false },{ field: '9' , enableFiltering: false},{ field: '10', enableFiltering: false },{ field: '11', enableFiltering: false },{ field: '12', enableFiltering: false },
    //
    //   { field: 'total', enableFiltering: false },
    //
    //
    // ],
    exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    }
  };

  $scope.export = function(){
      var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
      $scope.gridApi.exporter.csvExport( "all", "all", myElement );

  };

  $scope.actualizarTabla=function () {

    $http.post('/prueba/main/rgsXCien',{'loc':$scope.form.a.idlocalidad}).then(function(data) {
        $scope.gridOptions.data = data.data;
        }, function(data, headersGetter, status) {console.log(data.data);
    });


  };

  $scope.actualizarTabla();
});


m.controller('funcionesController', function($scope,$http,$controller) {

  $scope.callcalcularLargoProm=function(){
    document.getElementById("loader-content").style.display = "block";
    $http.get('/prueba/main/calcularLargoProm').then(function(data) {
        // $scope.gridOptions.data = data.data;
        console.log(data);
        alert("finalizo correctamente");
        document.getElementById("loader-content").style.display = "none";
        }, function(data, headersGetter, status) {
          console.log(data.data);
          document.getElementById("loader-content").style.display = "none";
    });

  };

  $scope.callcalcularLargoProm=function(){
    document.getElementById("loader-content").style.display = "block";
    $http.get('/prueba/main/calcularLargoProm').then(function(data) {
        // $scope.gridOptions.data = data.data;
        console.log(data);
        document.getElementById("loader-content").style.display = "none";
        alert("finalizo correctamente");
        }, function(data, headersGetter, status) {
          console.log(data.data);
          document.getElementById("loader-content").style.display = "none";
    });

  };
})
