<?php

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  $loader = require('vendor/autoload.php');
  $loader->addPsr4('SlimSkeletonBuddy\\', realpath(dirname(__FILE__) . "/../application"));

  /* Load Configuration */
  $configuration = new SlimSkeletonBuddy\Configuration();
  
  if(
    !empty($configuration->get("filenames.config.env"))
    && file_exists($configuration->get("paths.config") . $configuration->get("filenames.config.env"))
  ){
    $dotenv = new Dotenv\Dotenv($configuration->get("paths.config"), $configuration->get("filenames.config.env"));
    $dotenv->load();
  }
  
  $app = new \Slim\App($configuration->get('slim'));

  //Sequential order of our Slim app setup  
  require __DIR__ . '/../application/Container.php';
  require __DIR__ . '/../application/Middleware.php';
  require __DIR__ . '/../application/Routes.php';


  $app->run();


?>
