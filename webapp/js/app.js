
	define(['angularAMD','ui-router','ui-bootstrap','angular-cookies','angular-animate','angular-sanitize','angular-filter','angular-locale'], function(angularAMD){
		var app = angular.module('predcovid', ['ui.router','ui.bootstrap','ngCookies','ngAnimate','ngSanitize','angular.filter']);
		app.config(['$stateProvider','$urlRouterProvider',function($stateProvider, $urlRouterProvider){
			$stateProvider
			// states
			.state('/',angularAMD.route({
				url:'/',
				data:{title:'predCOVID | Inicio'},
				templateUrl: 'layout/login.php',
				controller: 'mainController',
				controllerUrl: 'controllers/mainController'
			}))
			.state('admin', {
				url: '/admin',
				data:{title: 'predCOVID | Administración'},
				views:{
					'': angularAMD.route({
						templateUrl: 'layout/admin.html',
						controller: 'adminController',
						controllerUrl: 'controllers/mainController'
					})
				}
			})
			/* dashboards */
			.state('admin.master_dashboard',{
				url: '/master_dashboard',
				data:{title:'predCOVID | Dashboard'},
				views:{
					'':angularAMD.route({
						templateUrl: 'views/dashboards/section-master.html',
						controller: 'masterController',
						controllerUrl: 'controllers/dashboards'
					})
				}
			})
			/* Catalogs */
		}]);
	
		app.run(['$rootScope','$location','$state', '$cookies','$http', function($rootScope, $location, $state, $cookies, $http){
			if($cookies.get('globals')){
				$rootScope.globals = JSON.parse($cookies.get('globals'));
				$location.path('/admin');
			}else{
				console.log('no access');
				$location.path('/');
			}
		
			$rootScope.$on('$locationChangeStart', function(event, next, current){
				var unAuth = ['/'];
				var loggedIn = $cookies.get('globals');
				$rootScope.$state = $state;
				angular.forEach(unAuth, function(v,k){
					if(v!==$location.path() && !loggedIn){
						console.log('No access; not loggedIn');
						$location.path('/');
					}
				});
			});
		}]);
		//boot 
		return angularAMD.bootstrap(app);
	});
