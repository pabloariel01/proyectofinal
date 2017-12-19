m.controller('capturasController', function($scope,$http,$controller) {
//$scope.var='hola';


// alert(<?php echo $this->security->get_csrf_token_name(); ?>);
// '<?php echo $this->security->get_csrf_hash(); ?>');
// alert('asd');
$controller('BaseController', { $scope: $scope });
$scope.titulo='Resumen de Capturas';
$scope.ayuda="Tabla resumen de capturas por especie por localidad acumuladas del acta elegida, posee opcion de elegir resultados totales o porcentuales y posibilidad de exportar. Localidades itu:Ituzaingo, ita:Ita ibate, abr:Puerto Abra  pgo:Pago Largo";
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
        $http.post('/pfcpablosilva/main/especies',{'acta':$scope.selected.id,'tMuestreos':$scope.token}).success(function(data){
        $scope.vector_especies=data;
        $scope.gridOptions.data = data;
        // console.log(data);
        });
        toggle=false;
    }
}

//cambia la tabla por una de porcentajes
$scope.porcentajes=function(){
    if (!toggle){
        $http.post('/pfcpablosilva/main/getPorcentajes',{'acta':$scope.selected.id,'tMuestreos':$scope.token}).success(function(data){
            $scope.vector_especies=data;
            $scope.gridOptions.data = data;

        });
    toggle=true;
    }
};



// TOTAL GENERAL
$scope.total=0
$scope.getTotales = function(){
    $http.post('/pfcpablosilva/main/getTotales',{'tMuestreos':$scope.token}).success(function(data){
        $scope.total = data;

         // console.log($scope.total);
    });
}



$scope.totalPorLoc = function(){
    $http.post('/pfcpablosilva/main/totalPorLoc',{'input':"1",'tMuestreos':$scope.token}).success(function(data){
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
  $scope.ayuda="Esta tabla contiene los totales de capturas de cada localidad, discriminado por si fueron capturados mediante el uso de redes, o por artes complementarias(AC) y el peso total de las mismas"

  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.form ={'a':"",'b':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.selected={"id":"1","descripcion":"25"};

  $scope.actualizarTabla=function () {
      $http.post('/pfcpablosilva/main/totalypesoporloc',{'loc':$scope.form.a.idlocalidad,'acta':$scope.selected.id}).success(function(data){
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
  $scope.ayuda="Tabla de capturas por unidad de esfuerzo discriminadas por localidad, incluyen el total de capturas, el indice de capturas por unidad de esfuerzo (CPUE) y el indice de captura por unidad de esfuerzo por gramo(CPUE G)";

  $scope.getlocalidades();
  $scope.actas_busqueda();
  $scope.getCamps();
  $scope.form ={'a':""};
  $scope.form.a={"iniciales":"ABR","idlocalidad":"3","nombre":"Puerto Abra"};
  $scope.selected={"id":"1","descripcion":"25"};





  $scope.actualizarTabla=function () {
    $http.post('/pfcpablosilva/main/sumcpueloc',{'loc':$scope.form.a.idlocalidad,'acta':$scope.selected.id}).then(function(data) {
          $scope.vector_especies=data.data;

        }, function(data, headersGetter, status) {console.log(data);
    });
  };

  $scope.actualizarTabla();
});


m.controller('cuboCpueEspeciesController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Suma Captura por Unidad de Esfuerzo(CPUE) por Localidad';
  $scope.ayuda="Tabla con las capturas por unidad de esfuerzo discriminadas por especie, campaña en que se realizo la captura, promedio y total. Posee como parametro extra la posibilidad de optar por mostrar el indice CPUE o CPUE G";

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
            $http.post('/pfcpablosilva/main/cuboCpueEspecies',{'loc':$scope.form.a.idlocalidad,'opt':$scope.form.b}).then(function(data) {
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
  $scope.titulo='Suma Captura por Unidad de Esfuerzo(CPUE) por largo y Localidad';
  $scope.ayuda="Tabla con totales de pescas separadas por rangos de longitud y sexo";

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
            $http.post('/pfcpablosilva/main/rangocpuelst',{'loc':$scope.form.a.idlocalidad}).then(function(data) {
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
  $scope.ayuda="Tabla con totales de capturas discriminadas por especie y sexo, representando M:macho, H:hembra, X: sin clasificar";

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


            $http.post('/pfcpablosilva/main/cuentaSexoEsp',{'loc':$scope.form.a.idlocalidad,'acta':$scope.selected.id}).then(function(data) {
                  $scope.gridOptions.data = data.data;
                }, function(data, headersGetter, status) {console.log(data.data);
            });

            $http.post('/pfcpablosilva/main/rangocpuelst',{'loc':$scope.form.a.idlocalidad}).then(function(data) {

                }, function(data, headersGetter, status) {console.log(data.data);
            });

  };

  $scope.actualizarTabla();
});

m.controller('cuentaGonadaController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Total por Estado de Gonada';
  $scope.ayuda="Totales de capturas discriminados por estado gonodosomatico y campaña en la que fueron capturados";


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

            $http.post('/pfcpablosilva/main/cuentaGonada',{'loc':$scope.form.a.idlocalidad}).then(function(data) {
                  $scope.gridOptions.data = data.data;
                }, function(data, headersGetter, status) {console.log(data.data);
            });

  };

  $scope.actualizarTabla();
});


m.controller('cuentaGonadaSexoController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Total por estado de gonada y sexo';
  $scope.ayuda="Totales de capturas por discriminado por estado gonodosomatico y campaña de captura, con la posibilidad de recuperar por sexo";


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

            $http.post('/pfcpablosilva/main/cuentaGonadaSexo',{'loc':$scope.form.a.idlocalidad,'sexo':$scope.form.b.id}).then(function(data) {
                  $scope.gridOptions.data = data.data;
                }, function(data, headersGetter, status) {console.log(data.data);
            });


  };

  $scope.actualizarTabla();
});


m.controller('cuentaEspGonadaController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Total de Especies por Estado de Gonada y Sexo';
  $scope.ayuda="Total de capturas discriminadas por campaña, especie y estado gonodosomatico, discriminados por sexo";

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
        $http.post('/pfcpablosilva/main/cuentaEspGonada',{'loc':$scope.form.a.idlocalidad,'sexo':$scope.form.b.id}).then(function(data) {
              $scope.gridOptions.data = data.data;
            }, function(data, headersGetter, status) {console.log(data.data);
        });

  };

  $scope.actualizarTabla();
});


m.controller('rgsXCienController', function($scope,$http,$controller) {

  $controller('BaseController', { $scope: $scope });
  $scope.titulo='Regresion Porcentual';
  $scope.ayuda="tabla de analisis de regresion porcentual de las especies sobre las cuales se realiza dicho estudio, separados por localidad";


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

    $http.post('/pfcpablosilva/main/rgsXCien',{'loc':$scope.form.a.idlocalidad}).then(function(data) {
        $scope.gridOptions.data = data.data;
        }, function(data, headersGetter, status) {console.log(data.data);
    });


  };

  $scope.actualizarTabla();
});


m.controller('funcionesController', function($scope,$http,$controller) {

  $scope.callcalcularLargoProm=function(){
    document.getElementById("loader-content").style.display = "block";
    $http.get('/pfcpablosilva/main/calcularLargoProm').then(function(data) {
        // $scope.gridOptions.data = data.data;
        console.log(data);
        alert("finalizo correctamente");
        document.getElementById("loader-content").style.display = "none";
        }, function(data, headersGetter, status) {
          console.log(data.data);
          document.getElementById("loader-content").style.display = "none";
    });

  };

  $scope.calcularduracion=function(){
    document.getElementById("loader-content").style.display = "block";
    $http.get('/pfcpablosilva/main/calcularduracion').then(function(data) {
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
