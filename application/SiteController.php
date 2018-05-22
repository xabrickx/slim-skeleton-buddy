<?php
namespace SlimSkeletonBuddy;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use RandomLib\Factory;

final class SiteController
{
    public $config;
    // public $flash;
    public $log;
    public $session;
    public $user;
    public $view;
        
    public function __construct($settings)
    {

        
        if (empty($settings)){
            return false;
        }
        if(!empty($settings['config'])){
            $this->config = $settings['config'];
        }
        // if(!empty($settings['flash'])){
        //     $this->flash = $settings['flash'];
        // }
        if(!empty($settings['log'])){
            $this->log = $settings['log'];
        }
        if(!empty($settings['session'])){
            $this->session = $settings['session'];
        }
        if(!empty($settings['user'])){
            $this->user = $settings['user'];
        }
        if(!empty($settings['view'])){
            $this->view = $settings['view'];
        }
    }

    public function Home(Request $request, Response $response)
    {
        echo 'home';
    }

    public function About(Request $request, Response $response)
    {
        return $this->view->render($response, 'about.html.twig', array());
        // echo 'about';
    }


}
?>