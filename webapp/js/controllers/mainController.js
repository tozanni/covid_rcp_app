
	define(['app','services/services','filters/filters'], function(app){
		app.controller('mainController', ['$rootScope','$scope','$state', function($rootScope, $scope, $state){
			//$scope.isCollapsed = true;
			$state.go('home.first');
		}]);
		app.controller('triageController', ['$scope', '$state',function($scope, $state){
			$scope.fields = {};
			$scope.fields.teteSlider = {
				value: 0,
				options: {
					floor: 0,
					ceil: 3,
					showSelectionBar: true,
					translate: function (value){
						let r = '';
						switch(value){
							case 0:
								r='No';
							break;
							case 1:
								r='Leve';
							break;
							case 2:
								r='Moderado';
							break;
							case 3:
								r='Grave';
							break;	
						}
						return r;
					},
					getSelectionBarColor: function(value){
						switch(value){
							case 0:
								return 'green';
							break;
							case 1:
								return 'yellow';
							break;
							case 2:
								return 'orange';
							break;
							case 3:
								return 'red';
							break;
							//return '#2AE02A';
						}
					}
				}
			}
		}]);
	});
