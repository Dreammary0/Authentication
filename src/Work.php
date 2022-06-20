<?php

namespace App;
use App\Model;
use PDO;

class Work
{
    
    public function login($login, $password){
        $mod = new Model();
        $mod->setLogin($login);
        $mod->setPass($password);
        $mod-> Login();
        
    }
    
    public function chek($log){
    $mod = new Model();
    $rigt= $mod->getLogin($log);    
    return $rigt;
    }

    public function registration($login, $password, $ip){
        $mod = new Model();
        $mod->setLogin($login);
        $mod->setIp($ip);
        $mod->setPass($password);
        $mod->Reg();
       
    }
   
    public function logout(){
        $mod = new Model();
        $mod->Logout();
    }
  
}