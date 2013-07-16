<?php
$params = require(__DIR__ . '/params.php');
return array(
    'id'       => 'bootstrap',
    'basePath' => dirname(__DIR__),
    'preload'  => array('log'),

    'components' => array(
        'cache' => array(
            'class' => 'yii\caching\FileCache',
        ),

        'user' => array(
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\User'
        ),

        'log' => array(
            'targets' => array(
                array(
                    'class' => 'yii\log\FileTarget',
                    'levels' => array('error', 'warning'),
                )
            ),
        ),

        'urlManager' => array(
            'enablePrettyUrl' => true,

            'rules' => array(
                '/'                      => 'site/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/' => '<controller>/index',
//                'event/add'              => 'event/add',
//                'event/save'             => 'event/save',
//                'event/remove'           => 'event/remove',
//                'event/notify'           => 'event/notify',
//                'event/edit/<id:\d+>'    => 'event/edit',
//                'event/delete/<id:\d+>'  => 'event/delete',
//                'event/invite/<id:\d+>'  => 'event/invite',
//                'event/details/<id:\d+>' => 'event/details'
            )
        ),

        'errorHandler' => array(
            'errorAction' => 'site/error'
        ),

        'db' => array(
            'class'    => '\yii\db\Connection',
            'dsn'      => 'mysql:host=localhost;dbname=activity_manager',
            'username' => 'root',
            'password' => 'root',
            'charset'  => 'utf8'
        ),

        'session' => array(
            'class' => '\yii\web\DbSession',
            'sessionTable'  => 'tbl_session'
        ),

        'import' => array(
            'application.libs.*',
        ),
    ),

    'params' => $params
);
