<?php
namespace App;
use Twig\Environment;

class Controller
{
    private  $twig;
    private  $url = 'http://dreamary.ml:678';

     public function __construct($twig)
    {
        $this->twig = $twig;
    }


    public function Show()
    {
        echo $this->twig->render('main.html.twig');
    }
    
     public function login()
    {
        echo $this->twig->render('login.html.twig');
        //header('Location: '.$url.'/login');

    }
  
}