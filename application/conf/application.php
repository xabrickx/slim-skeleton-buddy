<?php
return array(
    'logger' => array(
        'name' => 'application',
        'filename' => 'application.log'
    ), 
    'filenames' => array(
        'config' => array(
            'env' => 'env'  //Set to empty to avoid env load but consider the secutiry impact
        )
    ),
    'paths' => array(
        'application' => ROOTPATH . "application/",
        'config' => ROOTPATH . "application/config/",
        'db' => ROOTPATH . "db/",
        'htdocs' => ROOTPATH . "htdocs/",
        'logs' => ROOTPATH . "logs/",
        'root' => ROOTPATH,
        'sessions' => ROOTPATH . "application/cache/session/",
        'static' => ROOTPATH . "static/",
        'templates' => ROOTPATH . "application/templates/"
    ),
    'session' => array(
        "content_key" => "Rm9hYoYLf1aKFIYCKwLd51dKxjYY4W7w",   #This key should be generated uniquely for every site.  
        "cookie_name" => "ssn",
        "max_duration_msecs" => 7200
    ),
    'slim' => array(
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true
    ),
    'view' => array(
        'template_path' => ROOTPATH . '/application/templates/',
        'twig' => array(
            'cache' => ROOTPATH . '/application/cache/twig/',
            'debug' => true,
            'auto_reload' => true,
            'autoescape' => false
        ),
    )
);
?>