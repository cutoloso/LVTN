var app = angular.module('my-app',[],function($interpolateProvider){
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).constant('URL_Main', 'http://localhost:800/');
