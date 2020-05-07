
	define(['app','factories/factories','filters/filters'], (app)=>{
		app.controller('mainController', ['$rootScope','$scope','$location','authFactory', ($rootScope, $scope, $location)=>{
			console.log('mainController');
		});
	});
