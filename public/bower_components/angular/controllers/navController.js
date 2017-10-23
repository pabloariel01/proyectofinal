m.controller('navController', function($scope) {

$scope.collapsable=true;
$scope.collapse=function() {
  $scope.collapsable=!$scope.collapsable;
}
// var myElement = angular.element( document.querySelector('side-menu')).metisMenu();
    // $('#side-menu').metisMenu();


});
