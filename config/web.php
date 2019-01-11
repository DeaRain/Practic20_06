<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-Ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => getenv("COOKIE_VALIDATION_KEY"),
            'baseUrl' => '',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'signup/<userType:\w+>'=>'auth/signup',
                '<action:(login|logout|signup)>'=>'auth/<action>',
                'category'=>'category/category',
                '<controller:(category|article)>/view/<id:\d+>'=>'<controller>/view',
                'search'=>'article/search',
                'user' => 'user/profile/index',
                '<module:(user|admin)>/<controller:(article)>/<action:(view|update|delete)>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'baseUrl'=>getenv('EDITOR_BASE_URL'),
                'path' => getenv('EDITOR_PATH'),
                'name' => getenv('EDITOR_SYSTEM_FOLDER'),
                'options' => [
//                    'uploadOverwrite' => false,
//                    'uploadDeny'  => array('all'),
                    'uploadAllow' => array('image'),
                    'uploadOrder' => array('allow', 'deny'),
                    'uploadMaxSize' => '5000K',
                    'disabled' => array('rename', 'mkfile'),
                ]
            ],
//            [
//                'class' => 'mihaildev\elfinder\volume\UserPath',
//                'path'  => 'upload/files/user_{id}',
//                'name'  => 'My Documents'
//            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
