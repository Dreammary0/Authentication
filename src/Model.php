<?php
namespace App;
use PDO;

class Model
{
    private  $url = 'http://dreamary.ml:678';
    private  $login;
    private  $pass;
    private  $ip;
    private  $log_hash;
    private  $connection;
	private $sault = "nfnfro*inr_njfrn(hhur452)jjf7";      

    public function __construct(){
    $this->connection = new PDO
    ('mysql:host=localhost;dbname=testDB;charset=utf8', 'root', '00012278');
    }

    public function setLogin($login): void
    {
        $this->login = $login;
    }

    public function setPass($pass): void
    {
        $this->pass = $pass;
    }
     public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    public function getLogin($log_hash)
    {
        return md5($log_hash . $sault);
    }
    
    

    public function Login(){
        $hash = md5($this->pass . $sault);
        $hash_log = md5($this->login . $sault);
		$sql = "SELECT * FROM users_reg WHERE login=:login AND password=:pass AND hash=:hash";//Формируем запрос без данных
		$result = $this->connection ->prepare($sql);
		$result->bindvalue(':login', $this->login);	
		$result->bindvalue(':pass', $this->pass);	
		$result->bindvalue(':hash', $hash);	

		$result->execute( );							
		$result = $result->fetchAll();				

		if (count($result)>0) {//Если база вернула 1 значение, значит и логин и пароль совпали
			setcookie('login', $this->login, time() + 180); 
			setcookie('loginHash', $hash_log, time() + 180); 

            header('Location: ' .$url. '/test?');

		}else echo 'Логин или пароль не верный или пользователь не существует';
            
	}
	
    
	public function Reg(){
        $password = md5($this->pass . $sault);
        $sql_="SELECT * FROM users_reg WHERE login=:login";
        $stmt=$this->connection->prepare($sql_);
        $stmt->bindvalue(':login',$this->login);
        $stmt->execute();
        $stmt = $stmt->fetchAll();				
		if (count($stmt)>0) 
		    echo('Пользователь с таким логином уже существует');
		else{ 
	        $sql = "INSERT INTO users_reg (login, password, hash, ip) VALUES (:login,  :pass, :hash, :ip)";
			$result = $this->connection->prepare($sql);
			$result->bindvalue(':login',$this->login);	
			$result->bindvalue(':pass',$this->pass);	
			$result->bindvalue(':hash',$password);
			$result->bindvalue(':ip',$this->ip);
			$result->execute( );
             setcookie('login1', $this->login, time() + 180);
             header('Location: ' .$url. '/test1?');

		    
		}
}

public function Logout(){
 setcookie('login', null, -1, '/');
 setcookie('login1', null, -1, '/'); 
 setcookie('loginHash', null, -1, '/');

 header('Location: '.$url.'/');

}

}