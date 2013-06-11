<?php
$params = require(__DIR__ . '/params.php');
return array(
	'id' => 'bootstrap-console',
	'basePath' => dirname(__DIR__),
	'preload' => array('log'),
	'controllerPath' => dirname(__DIR__) . '/commands',
	'controllerNamespace' => 'app\commands',
	'modules' => array(
            'MigrateController'
	),
	'components' => array(
		'cache' => array(
			'class' => 'yii\caching\FileCache',
		),
		'log' => array(
			'class' => 'yii\logging\Router',
			'targets' => array(
				array(
					'class' => 'yii\logging\FileTarget',
					'levels' => array('error', 'warning'),
				),
			),
		),
                'db' => array(
                        'class' => '\yii\db\Connection',
                        'dsn' => 'mysql:host=localhost;dbname=activity_manager',
                        'username' => 'root',
                        'password' => 'root',
                        'charset' => 'utf8',
                ),
	),
	'params' => $params,
);
