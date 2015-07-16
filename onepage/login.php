<?php
require_once "php/aplicacao.php";

require_once 'php/PasswordLib.phar';

session_start();

$interface = new Aplicacao();

 
 
//$lib = new PasswordLib\PasswordLib();

 

if(isset($_POST['user']) && isset($_POST['pass'])){
    
    $username = $_POST['user'];
    $senha = $_POST['pass'];
    
    //$hash = $lib->createPasswordHash($senha);
    
    $_SESSION['erro'] = $interface->returnHash($username);
    

    
    
    $hash = $interface->returnHash($username);
    
    
    $lib = new PasswordLib\PasswordLib();
    
    
    if( $lib->verifyPasswordHash($senha, $hash)    ){
        $interface->loginUser($username);
        header('Location: meuPainel.php');
        exit();
    }
    else{

        
        $_SESSION['erro'] = "Nome de usuário e/ou senha incorretos!";
        

        header('Location: loginAreaUsuario.php');
        exit();
    }
}
else {
    $_SESSION['erro'] = "Formulário não preenchido corretamente!";
    header('Location: loginAreaUsuario.php');
    exit();
}