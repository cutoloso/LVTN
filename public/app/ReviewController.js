app.controller('ReviewController',function($scope,$http,URL_Main){
    $http.get(URL_Main + 'review').then(function (response) {
        console.log(response);
    });
});
