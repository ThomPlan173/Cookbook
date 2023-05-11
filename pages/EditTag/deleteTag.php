<?php
session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();

$id = $_GET["del"];
$cb->deleteTag($id);
$_SESSION['errortext']=null;
header("Location: ".$_SERVER['HTTP_REFERER']);
