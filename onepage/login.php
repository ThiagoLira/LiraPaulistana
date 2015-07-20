<?php
require_once "php/aplicacao.php";

require_once 'php/PasswordLib.phar';


ini_set('display_errors',1);  
error_reporting(E_ALL);

session_start();

$interface = new Aplicacao();

 
 
$lib = new PasswordLib\PasswordLib();

 

if(isset($_POST['user']) && isset($_POST['pass'])){
    
    $username = $_POST['user'];
    $senha = $_POST['pass'];
    
    //$hash2 = $lib->createPasswordHash($senha);
    
    //$_SESSION['erro'] = $interface->returnHash($username);
    
    
    $login = new Login();

    $login->setUsername($username);


    $existe = $login->isLogin(); //variavel booleana

    if($existe){
    $hash = $interface->returnHash($username);
    if( $lib->verifyPasswordHash($senha, $hash)    ){
        $interface->loginUser($username);
        header('Location: meuPainel.php');
        exit();
    }

    }
    else{

        
        $_SESSION['erro'] = "Nome de usuário e/ou senha incorretos!";
        //$_SESSION['erro'] = $hash2;

        header('Location: loginAreaUsuario.php');
        exit();
    }
}
else {
    $_SESSION['erro'] = "Formulário não preenchido corretamente!";
    header('Location: loginAreaUsuario.php');
    exit();
}