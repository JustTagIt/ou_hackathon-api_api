<?php

return array(
    'paths' => array(
        app_path().'/controllers',
        app_path().'/models'
    ),
    'excludedPath' => array(),
    'getResourceListOptions' => array(),
    'getResourceOptions' => array(
        'defaultBasePath' => ''
    ),
    'prefix' => '/api/docs',
    'showDemo' => true,
    'cache' => true,
    'cacheExpireAt' => 60
);
