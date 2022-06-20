<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Controller;
use App\Model;
use App\Work;


require_once dirname(__DIR__) . '/vendor/autoload.php';
$url = 'http://dreamary.ml:678';
$uri = $_SERVER['REQUEST_URI'];

$loader = new FilesystemLoader(dirname(__DIR__) . '/view');
$twig = new Environment($loader);
$control = new Controller($twig);
$work= new Work;

$login = trim($_POST['login']);
$password = trim($_POST['password']);
$ip_ = $_SERVER['REMOTE_ADDR']; 
$chars = ['.']; // символы для удаления
$ip = str_replace($chars,'', $ip_);


 switch ($uri){
     case '/':{
         $control->Show();
         break;
     }
    
        case '/logout':
            {    
                $work->logout();
                break;
            }
        case '/login':
            { if ($login != '' && $password !=''){
                $work->login($login, $password);} else   
                header('Location: ' .$url. '/');

               
                break;
            }
        case '/registration':
            {    if ($login != '' && $password !=''){
                $work->registration($login, $password,$ip);}else   
                header('Location: ' .$url. '/');
                break;
            }
     }    
     
    if (isset($_COOKIE['login'])){
        $user=$_COOKIE['login'];
        $log_h = $_COOKIE['loginHash'];
        $chek = $work->chek($user);
        //проверка, не изменял ли пользователь логин в куках       
        if ($log_h==$chek){
            echo('Добро пожаловать, ' . $user . '! <br>');
            echo('<b>Дальше тут что то может быть, но я пока не придумала </b>');
            $control->login();
        } else echo "Так делать нечестно) ";
    } 
        
        
      if (isset($_COOKIE['login1'])){
           $user=$_COOKIE['login1'];
            echo('Пользователь ' .$user. 'зарегестрирован ');
            $control->login();

        } 
    
    
   
     
     
 