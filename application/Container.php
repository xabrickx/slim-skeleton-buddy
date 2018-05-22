<?php
  use Monolog\Logger;
  use Monolog\Handler\StreamHandler;
  use Monolog\Formatter\LineFormatter;
  use Monolog\Formatter\FormatterInterface;
  use Monolog\Handler\AbstractHandler;

  $container = $app->getContainer();

  
  
  $container['log'] = function ($c) use ($configuration) {
      $logger = new Monolog\Logger($configuration->get('logger.name'));
      
      //Create output formatter
      // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
      $output = "%datetime% > %level_name% > %message% %context% %extra%\n";
      $formatter = new LineFormatter($output);
      
      $logger->pushProcessor(new Monolog\Processor\UidProcessor());
      $stream = new Monolog\Handler\StreamHandler($configuration->get('paths.logs') . $configuration->get('logger.filename'), Monolog\Logger::DEBUG);
      $stream->setFormatter($formatter);
      $logger->pushHandler($stream);
      return $logger;
    };

    $container['session'] = function($c) use ($configuration) {
        $session = new SecureSessionHandler($configuration->get('session.content_key'), $configuration->get('session.cookie_name'));
        ini_set('session.save_handler', 'files');
        ini_set('session.gc_maxlifetime', $configuration->get('session.max_duration_msecs'));
        session_set_save_handler($session, true);
        session_save_path($configuration->get('paths.cookie_name'));
        session_set_cookie_params($configuration->get('session.max_duration_msecs'));
        $session->start();

        return $session;
    };

    $container['user'] = function ($c) {
        return new SlimSkeletonBuddy\User($c->get("log"));
    };
    
    $container['view'] = function ($container) use ($configuration) {
      $view = new \Slim\Views\Twig($configuration->get('view.template_path'), $configuration->get('view.twig'));
  
      // Instantiate and add Slim specific extension
      $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
      $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
      $view->addExtension(new Twig_Extension_Debug());
      return $view;
    };
    
    
    //Flash Message Handler
    //Some Projects will require the ability to pass flash messages
    //This require Session usage!
    //   $container['flash'] = function ($c) {
    //       return new Slim\Flash\Messages;
    //   };


    // Not Found Handler
    // Some Projects call for Not Found to be handled via slim
    //   $container['notFoundHandler'] = function ($c) {};
        
    $container['SiteController'] = function ($c) use ($configuration) {   
    $log = $c->get('log');
    return new SlimSkeletonBuddy\SiteController(array(
        "config" => $configuration,
        // "flash" => $c->get('flash'),
        "log" => $log,
        "session" => $c->get('session'),
        "user" => $c->get('user'),
        "view" => $c->get('view')

    ));       
  };
?>
