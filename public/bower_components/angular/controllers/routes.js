//var m = angular.module('tfa', ['ngRoute']);
var m = angular.module('tfa', ['ngRoute','ui.grid','angular.morris-chart','chart.js','ui.select'])
// var myApp = angular.module('tfa');
	.config(function($routeProvider) {
		$routeProvider
			//Home
			.when('/',{
				templateUrl: 'prueba/index3',
				controller : "menuController"
			})

			.when('/home',{
				templateUrl: 'index.php/prueba/index3/',
				controller : "menuController"
			})

			.otherwise({
		        redirectTo: '/'
		    });

	});
