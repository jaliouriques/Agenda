<?php
session_start();
function login()
{
    $lista_usuarios = file_get_contents("usuarios.json");
    $lista_usuarios = json_decode($lista_usuarios, true);
    foreach ($lista_usuarios as $usuario) {
        if ($_POST['login'] == $usuario['login'] && $_POST['senha'] == $usuario['senha']) {
            $_SESSION['nome']  = $_POST['nome'];
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['senha'] = $_POST['senha'];
            $_SESSION['esta_logado'] = true;
            header('Location: index.phtml');
        } else {
            //Deu Errado
            header('Location: login.php');
        }
    }
}
function sair(){
    session_destroy();
    header('Location: login.php');
}
//Rotas
if($_POST['login_form'] == "acessar"){
    login();
}
if ($_GET['acao'] == "sair"){
    sair();
}