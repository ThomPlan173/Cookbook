<?php
session_start();

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$ad = new \Edit\Add();

if (isset($_POST['submit'])) {

    $nom = $_POST['nom'];
    $img = "images/" . $_POST['image'];
    $description = $_POST['description'];
    $preparation = $_POST['preparation'];
    $response = $ad->verif($nom,$img,$description,$preparation);
    if ($response['granted']){
        $result = $cb->addRecette($img,htmlspecialchars($nom,ENT_QUOTES),htmlspecialchars($description, ENT_QUOTES),htmlspecialchars($preparation, ENT_QUOTES));
        header("Location: "."/Projet_Recettes/index.php");
        exit() ;
    }
}

ob_start() ;

if (!isset($response)) :
    $ad->generateform();
elseif (!$response['granted']) :
    echo "<div class='error'>" ."Empty !"."</div>" ;
    $ad->generateform($response['error']);
endif;
         
$code = ob_get_clean() ;

ob_start(); ?>

    <link rel="stylesheet" href="/Projet_Recettes/CSS/add.css">

<?php
$css = ob_get_clean();
Template::render($code);