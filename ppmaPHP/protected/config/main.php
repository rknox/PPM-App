<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'PPM Application',

	// preloading 'log' component
	'preload'=>array('log'),
	
	//default controller
	'defaultController'=>'auth',

	// autoloading model and component classes
	'import'=>array(
		'application.models.activeRecords.*',
		'application.models.forms.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>'auth',
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<_c:(user|project)>'=>'<_c>/list',
				'<_c:(user|project)>/<id:\d+>'=>'<_c>/view',
				'<_c:(user|project|resources)>/<_a:(update|delete|view)>/<id:\d+>' => '<_c>/<_a>',
				'<_c:(user|project)>/create' => '<_c>/create',
				'<_c:(user|project)>/create/<name>' => '<_c>/create',
				'<_c:project>/<id:\d+>/manageMembers'=>'<_c>/manageMembers',
				'<_c:project>/<id:\d+>/manageMembers/delete/<del:\d+>'=>'<_c>/manageMembers',
				'<_c:project>/<id:\d+>/manageMembers/add/<add:\d+>'=>'<_c>/manageMembers',
			),
		),
		//'db'=>array(
		//	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		//),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=hansserver.net;dbname=lf_ppma',
			'emulatePrepare' => true,
			'username' => 'lf_ppm',
			'password' => 'jSQE6qabmM86bzc3',
			'charset' => 'utf8',
		),
		'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);