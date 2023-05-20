<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

//page permettent aux admins de se logger
session_start() ;

require ".." . DIRECTORY_SEPARATOR. ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();
use Logger\Logger ;

$logger = new Logger() ;

$username = null;
$password = null ;
if (isset($_POST['username']) and isset($_POST['password'])){ // si un submit a été fait, verifie les informations
    $username = $_POST['username'] ;
    $password = $_POST['password'] ;
    $response = $logger->log(trim($username), trim($password)) ;
    if ($response['granted']){ // si les données sont bonnes, renvoie vers la dernière page visité
        $_SESSION['login'] = true ;
        header("Location: ".$_SESSION['page']);
        exit() ;
    }
}

ob_start() ;

if (!isset($response)) : // si il n'y a pas eu encore d'envoie du formulaire, genère les données avec username qui est null et sans message d'erreur
    $logger->generateLoginForm($username);
elseif (!$response['granted']) : // si il y a une erreur, renvoie le formulaire avec le message d'erreur correspondant
    echo "<div class='error'>" .$response['error']."</div>" ;
    $logger->generateLoginForm($username, $response['error']);
endif;

$code = ob_get_clean() ;

ob_start();?>

    <link rel="stylesheet" href="/Projet_Recettes/CSS/login.css">

<?php
$css = ob_get_clean();

ob_start();
$js = ob_get_clean();
Template::render($code, $css, $js);

/*#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------*/