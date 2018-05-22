<?php
use Slim\Http\Request;
use Slim\Http\Response;
use RandomLib\Factory;

$app->get('/', 'SiteController:Home')
    ->setName('Home');

$app->get('/about', 'SiteController:About')
    ->setName('About');
?>