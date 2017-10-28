//var m = angular.module('tfa', ['ngRoute']);
var m = angular.module('tfa', ['ngRoute','ui.grid','angular.morris-chart','chart.js','ui.select','ngSanitize','ngAnimate'])
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

	        $scope.test1="asdf"
					// DEVUELVE TODAS LAS ACTAS
					$scope.actas=[];
					$scope.actas_busqueda = function(){
					    $http.post('/prueba/main/traeractas').success(function(data){
					        $scope.actas = data;
					        // console.log(data);
					    });
					};
					// Trae las campanias de un acta
					$scope.camps=[];
					$scope.getCamps= function() {
					  $http.post('/prueba/main/getCamps',{'acta':1}).success(function(data){
					      $scope.camps=data;
					      // console.log(data);
					  });
					}
					$scope.localidades=[];
					$scope.getlocalidades = function(){
					    $http.post('/prueba/main/getLocalidadesxcamp').success(function(data){
					        $scope.localidades = data;
					        //  console.log($scope.localidades);
					    });
					}

	    }]);
