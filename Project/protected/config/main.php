<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Asset Tracking And Usage Management System',
        'defaultController'=>'site/login',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
                'application.models.*',
                'application.components.*',
                'application.extensions.yiimail.YiiMail',
                'application.extensions.yiimail.YiiMailMessage',
                'zii.widgets.*',
            ),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',			
                        'ipFilters'=>array('127.0.0.1','::1'),
                    ),
                ),
           

	// application components
	'components'=>array(              
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
            
            
                'clientScript'=>array(
                'packages'=>array(
                    'jquery'=>array(
                        'baseUrl'=>'//ajax.googleapis.com/ajax/libs/jquery/1.11.1',
                        'js'=>array('jquery.min.js'),
                            ),
                        ),
                    ),
            
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=> true,
//                        'enablePrettyUrl'=>true,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
                 */
            
            
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=login_project',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'password',
			'charset' => 'utf8',
		),
            
                'user'=>[
                        'allowAutoLogin'=>true,
                        'loginUrl'=>['site/login'],
                    ],
		
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
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
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
