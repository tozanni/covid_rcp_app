
	define(['angularAMD','ui-router','ui-bootstrap','angular-cookies','angular-animate','angular-sanitize','angular-filter','angular-locale','rzslider'], function(angularAMD){
		var app = angular.module('predcovid', ['ui.router','ui.bootstrap','ngCookies','ngAnimate','ngSanitize','angular.filter','rzSlider']);
		app.config(['$stateProvider','$urlRouterProvider',function($stateProvider, $urlRouterProvider){
			
			$urlRouterProvider.otherwise('/home');
			
			$stateProvider
			// states
			.state('home', {
				url:'/home',
				data:{title:'Inicio | Invitado'},
				views:{
					'':angularAMD.route({
						templateUrl: 'layout/home.html',
						controller: 'mainController',
						controllerUrl: 'controllers/mainController'
					})
				}
			})
			
			.state('home.first', {
				url: '/first',
				data: {title: 'Probabilidad de RcP'},
				views:{
					'': angularAMD.route({
						templateUrl: 'views/public/section-rcp-01.html',
						controller: 'mainController',
						controllerUrl: 'controllers/mainController'
					})
				}
			})

			.state('home.second',{
				url: '/second',
				data: {title: 'Triage #8888'},
				views:{
					'':angularAMD.route({
						templateUrl: 'views/public/section-rcp-02.html',
						controller: 'triageController',
						controllerUrl: 'controllers/mainController'
					})
				}
			})
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

		}]);
	
		app.run(['$rootScope','$location','$state', '$cookies','$http', function($rootScope, $location, $state, $cookies, $http){
			if($cookies.get('globals')){
				$rootScope.globals = JSON.parse($cookies.get('globals'));
				$location.path('/admin');
			}else{
				console.log('no access');
				$location.path('/home');
			}
		
			$rootScope.$on('$locationChangeStart', function(event, next, current){
				var unAuth = ['/'];
				var loggedIn = $cookies.get('globals');
				$rootScope.$state = $state;
				angular.forEach(unAuth, function(v,k){
					if(v!==$location.path() && !loggedIn){
						console.log('No access; not loggedIn');
						$location.path('/home');
					}
				});
			});
		}]);
		//boot 
		return angularAMD.bootstrap(app);
	});
