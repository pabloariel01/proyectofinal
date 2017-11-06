//var m = angular.module('tfa', ['ngRoute']);
var m = angular.module('tfa', ['ngRoute','ui.grid','ui.bootstrap','angular.morris-chart','chart.js','ui.select','ngSanitize','ngAnimate', 'ui.grid.exporter','ui.grid.selection'])
// var myApp = angular.module('tfa');
	.config(function($routeProvider) {
		$routeProvider
			//Home
			.when('/',{
				// templateUrl: 'vistas/inicio',
				controller : "menuController"
			})
			.when('/capturas',{
				templateUrl: 'vistas/resumenCapturas',
				controller : "capturasController"
			})
			.when('/totales',{
				templateUrl: 'vistas/totalypesoporloc',
				controller : "totalypesoporlocController"
			})
			.when('/sumcpueloc',{
				templateUrl: 'vistas/sumcpueloc',
				controller : "sumcpuelocController"
			})
			.when('/cuboCpueEspecies',{
				templateUrl: 'vistas/cuboCpueEspecies',
				controller : "cuboCpueEspeciesController"
			})
			.when('/rangocpuelst',{
				templateUrl: 'vistas/rangocpuelst',
				controller : "rangocpuelstController"
			})
			.when('/cuentaSexoEsp',{
				templateUrl: 'vistas/rangocpuelst',
				controller : "cuentaSexoEspController"
			})
			.when('/cuentaGonada',{
				templateUrl: 'vistas/rangocpuelst',
				controller : "cuentaGonadaController"
			})
			.when('/cuentaGonadaSexo',{
				templateUrl: 'vistas/cuentaGonadaSexo',
				controller : "cuentaGonadaSexoController"
			})
			.when('/cuentaEspGonada',{
				templateUrl: 'vistas/cuentaGonadaSexo',
				controller : "cuentaEspGonadaController"
			})
			.when('/rgsXCien',{
				templateUrl: 'vistas/rangocpuelst',
				controller : "rgsXCienController"
			})
			.when('/funciones',{
				templateUrl: 'vistas/funciones',
				controller : "funcionesController"
			})
			.when("/abmusers",{
				templateUrl:'abmusuario/usuarios'
			})


			// .otherwise({
		  //       redirectTo: '/'
		  //   });

	})

// Controlador del que van a heredar funciones los demas
	.controller('BaseController',
	    ['$scope','$http',
	    function ($scope,$http) {
				// alert();
					// DEVUELVE TODAS LAS ACTAS
					$scope.actas=[];




					$scope.actas_busqueda = function(){
					    $http.post('/pfcpablosilva/main/traeractas').success(function(data){
					        $scope.actas = data;
					        // console.log(data);
					    });
					};
					// Trae las campanias de un acta
					$scope.camps=[];
					$scope.getCamps= function() {
					  $http.post('/pfcpablosilva/main/getCamps',{'acta':1}).success(function(data){
					      $scope.camps=data;
					      // console.log(data);
					  });
					}
					$scope.localidades=[];
					$scope.getlocalidades = function(){
					    $http.post('/pfcpablosilva/main/getLocalidadesxcamp').success(function(data){
					        $scope.localidades = data;
					        //  console.log($scope.localidades);
					    });
					}

					$scope.export = function(){
							var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
							$scope.gridApi.exporter.csvExport( "all", "all", myElement );

					};

	    }])



			.directive('myCustomDropdown', function() {
			  return {
			    template: '<select class="form-control" ng-model="colFilter.term" ng-options="option.id as option.value for option in colFilter.options"></select>'
			  };
			})

			.controller('myCustomModalCtrl', function( $scope, $compile, $timeout ) {
			  var $elm;

			  $scope.showAgeModal = function() {
			    $scope.listOfAges = [];

			    $scope.col.grid.appScope.gridOptions.data.forEach( function ( row ) {
			      if ( $scope.listOfAges.indexOf( row.esp ) === -1 ) {
			        $scope.listOfAges.push( row.esp );
			      }
			    });
			    $scope.listOfAges.sort();

			    $scope.gridOptions = {
			      data: [],
			      enableColumnMenus: false,
			      onRegisterApi: function( gridApi) {
			        $scope.gridApi = gridApi;

			        if ( $scope.colFilter && $scope.colFilter.listTerm ){
			          $timeout(function() {
			            $scope.colFilter.listTerm.forEach( function( esp ) {
			              var entities = $scope.gridOptions.data.filter( function( row ) {
			                return row.esp === esp;
			              });

			              if( entities.length > 0 ) {
			                $scope.gridApi.selection.selectRow(entities[0]);
			              }
			            });
			          });
			        }
			      }
			    };

			    $scope.listOfAges.forEach(function( esp ) {
			      $scope.gridOptions.data.push({esp: esp});
			    });

			    var html = '<div class="modal" ng-style="{display: \'block\'}"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">Filtrar por Especie</div><div class="modal-body"><div id="grid1" ui-grid="gridOptions" ui-grid-selection class="modalGrid"></div></div><div class="modal-footer"><button id="buttonClose" class="btn btn-primary" ng-click="close()">Filtrar</button></div></div></div></div>';
			    $elm = angular.element(html);
			    angular.element(document.body).prepend($elm);

			    $compile($elm)($scope);

			  };

			  $scope.close = function() {
			    var ages = $scope.gridApi.selection.getSelectedRows();
			    $scope.colFilter.listTerm = [];

			    ages.forEach( function( esp ) {
			      $scope.colFilter.listTerm.push( esp.esp );
			    });

			    $scope.colFilter.term = $scope.colFilter.listTerm.join(', ');
			    $scope.colFilter.condition = new RegExp($scope.colFilter.listTerm.join('|'));

			    if ($elm) {
			      $elm.remove();
			    }
			  };
			})


			.directive('myCustomModal', function() {
			  return {
			    template: '<label></label><button ng-click="showAgeModal()">...</button>',
			    controller: 'myCustomModalCtrl'
			  };
			})

// 	.factory('httpRequestInterceptor', function () {
//   		return {
//     request: function (config) {
//
//       config.headers['tMuestreos'] = $scope.name;
//       config.headers['Accept'] = 'application/json;odata=verbose';
//
//       return config;
//     }
//   };
// })
//
// .config(function ($httpProvider) {
//   $httpProvider.interceptors.push('httpRequestInterceptor');
// });
