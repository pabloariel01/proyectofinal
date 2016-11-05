var m = angular.module('tfa', ['ngRoute','angular.morris-chart'])
	.config(function($routeProvider) {
		$routeProvider
			//RUTAS DE USUARIOS
			.when('/',{
				templateUrl: 'starboostrap/index/',
				controller : "metodosController"
			})
						
			.otherwise({
		        redirectTo: '/'
		    });
		
	});