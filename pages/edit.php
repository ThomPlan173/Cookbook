<?php
session_start();

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
//$msg = $_POST['edit'] ;
//$id = htmlspecialchars( utf8_encode($msg)) ;

$cb = new \cb\CoobookDB();
$data = $cb->getRecette("3");
$liste = $cb->getIngredients("3");
$tags = $cb->getTags("3");


$ed = new \Edit\Edit();
$ed->generateform($data[0]->nomRecette, $data[0]->imgRecette, $data[0]->Description, $data[0]->Preparation);
var_dump($_POST );
//if (isset($_POST['submit'])) {
    
    $img = "images\\" . $_POST['image'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $preparation = $_POST['preparation'];

    var_dump($nom);
    /*$data = verif($nom, $description, $preparation);
    //if ($data["error"] != null) {
        $sql = "UPDATE SET WHERE ";
        //$result = $db->query($sql);
    }

    //if ($result == true) {

       // header('location: homeuser.php');
    }*/
//}
