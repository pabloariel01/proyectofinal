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
			.when('vistas/total',{
				templateUrl: 'vistas/resumenCapturas',
				controller : "menuController"
			})
			.when("/abmusers",{
				templateUrl:'abmusuario/usuarios'
			})
			.when("/abmusers1",{
				// templateUrl: 'vistas/inicio',
				templateUrl:'abmusuario/usuarios/edit/8'
			})

			// .otherwise({
		  //       redirectTo: '/'
		  //   });

	});
