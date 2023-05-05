<?php

session_start() ;

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();
use Logger\Logger ;

//$logger = new Logger(DOCUMENT_DIR."/pages/login.php") ;
$logger = new Logger() ;

$username = null;
$password = null ;
if (isset($_POST['username']) and isset($_POST['password'])){
    $username = $_POST['username'] ;
    $password = $_POST['password'] ;
    $response = $logger->log(trim($username), trim($password)) ;
    if ($response['granted']){
        $_SESSION['login'] = 'true' ;
        header("Location: "."/Projet_Recettes/index.php");
        exit() ;
    }
}

ob_start() ;

if (!isset($response)) :
    $logger->generateLoginForm($username);
elseif (!$response['granted']) :
    echo "<div class='error'>" .$response['error']."</div>" ;
    $logger->generateLoginForm($username, $response['error']);
endif;

$code = ob_get_clean() ;
Template::render($code);