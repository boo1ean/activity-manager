<?php

return array(
    'app' => array(
        'basePath' => '@wwwroot',
        'baseUrl' => '@www',

        'css' => array(
            'css/site.css',
            'css/bootstrap-datetimepicker.min.css'
        ),

        'js' => array(
            'js/bootstrap.min.js',
            'js/bootstrap-datetimepicker.min.js'
        ),

        'depends' => array(
            'yii',
            'yii/bootstrap/responsive'
        ),
    ),
);
