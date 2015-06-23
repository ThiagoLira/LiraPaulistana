<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

 

if(isset($_POST['user']) && isset($_POST['pass'])){
    $username = $_POST['user'];
    $senha = $_POST['pass'];
    $hash =  md5 ( $senha  );
    
    


    if($interface->login($username,$hash)){
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