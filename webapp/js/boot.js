require.config({
	baseUrl: 'js',
	waitSeconds: 200,
	urlArgs: version(),
	paths:{
		'angular':'lib/angular',
		'angular-cookies': 'lib/angular-cookies',
		'angular-animate': 'lib/angular-animate',
		'ui-router':'lib/angular-ui-router',
		'angular-sanitize':'lib/angular-sanitize',
		'angularAMD': 'lib/angularAMD.min',
		'ui-bootstrap': 'lib/ui-bootstrap-tpls-2.5.0.min',
		'rzslider': 'lib/rzslider',
		/*'angular-multiselect': 'lib/angularjs-dropdown-multiselect',*/
		'angular-filter':'lib/angular-filter',
		'angular-locale':'lib/angular-locale_es-mx'
	},
	shim:{
		'angularAMD': ['angular'],
		'ui-router': ['angular'],
		'angular-cookies': ['angular'],
		'angular-animate':['angular'],
		'angular-sanitize':['angular'],
		'ui-bootstrap': ['angular'],
		'rzslider': ['angular'],
		//'angular-multiselect': ['angular'],
		'angular-filter':['angular'],
		'angular-locale':['angular']
	},
	deps: ['app']
});

function version(){
	return 'version=1.0.0';
}
