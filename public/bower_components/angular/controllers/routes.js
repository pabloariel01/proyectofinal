//var m = angular.module('tfa', ['ngRoute']);
var m = angular.module('tfa', ['ngRoute','ui.grid','angular.morris-chart','chart.js','ui.select'])
// var myApp = angular.module('tfa');
	.config(function($routeProvider) {
		$routeProvider
			//Home
			.when('/',{
				templateUrl: 'vistas/resumenCapturas',
				controller : "menuController"
			})
			.when('vistas',{
				templateUrl: 'vistas/resumenCapturas',
				controller : "menuController"
			})



			.otherwise({
		        redirectTo: '/'
		    });

	});
