<?php
namespace SlimSkeletonBuddy;

use Noodlehaus\Config;

final class User
{
    public $loggedin;
    
    private $role;
    private $log;


    public function __construct($log)
    {
        $this->_set_defaults();

        if(!empty($logger)){
            $this->log = $log;
        }

    }

    public function get_role(){
        return $this->role;
    }
    public function set_role($newrole){
        $this->role = $newrole;
    }

    private function _set_defaults(){
        $this->loggedin = 0;
        $this->role = "anon";
    }
}
?>