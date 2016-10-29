var app = angular.module('AppMaster',['ngRoute']);
// membuat filter sendiri
app.filter('rupiah', function(){
	return function toRp(angka){
		var rev = parseInt(angka, 10).toString().split('').reverse().join('');
		var rev2 = '';
		for(var i = 0; i < rev.length; i++){
			rev2 += rev[i];
			if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
			rev2 += '.';
			}
		}
	return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
	}
});
// Route
app.config(function($routeProvider){
	$routeProvider.when('/',{
		templateUrl : 'pages/home.html',
		controller : 'HomeController'
	})
	.when('/twitter',{
		templateUrl : 'pages/twitter/twitter.html',
		controller : 'TwitterController'
	})
	.when('/twitter/:theparam',{
		templateUrl : 'pages/twitter/twitter.html',
		controller : 'TwitterController'
	})
	.when('/twitter/search/:theparam',{
		templateUrl : 'pages/twitter/twitter_search.html',
		controller : 'TwitterController'
	})
	.otherwise({
		redirectTo : '/'
	})
});

// service
