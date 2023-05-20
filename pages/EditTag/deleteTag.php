<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();

$id = $_GET["del"];
$cb->deleteTag($id);
$cb->deleteTagAttribution($id);
$_SESSION['errortext']=null;
header("Location: ".$_SERVER['HTTP_REFERER']);

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------