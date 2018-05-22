<?php
namespace SlimSkeletonBuddy\;

use Noodlehaus\Config;

final class Configuration
{
    public $config;

    private $config_path;
    private $config_filenames;

    public function __construct(String $config_path = "", $filenames = NULL)
    {

        //Set defaults if required
        if($config_path==""){
            $this->config_path = realpath(dirname(__FILE__)) . "/conf/";
        } else {
            $this->config_path = $config_path;
        }
        if (empty($filenames)) {
            $this->config_filenames = array(
                'application' => "application.php",
                'environment' => "environment.php"
            );
        } else {
            $this->config_filenames = $filenames;
        }
        
        $this->config = new Config([
            $this->config_path . $this->config_filenames["environment"],
            $this->config_path . $this->config_filenames["application"]
        ]);
        
    }

    public function get($path=NULL, $fallback=NULL){
        return $this->config->get($path, $fallback);
    }
    public function all(){
        return $this->config->all();
    }
    public function set($path=NULL, $value=NULL){
        $this->config[$path] = $filename;
    }

   
}

?>