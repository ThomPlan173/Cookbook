<?php
session_start();

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();

$ed = new \Edit\Edit();


$id = $_GET['msg'];
$cb = new \cb\CoobookDB();
$data = $cb->getRecette($id);
$liste = $cb->getIngredients($id);
$tags = $cb->getTags($id);



$ed = new \Edit\Edit();
$ed->generateform($data[0]->nomRecette, $data[0]->imgRecette, $data[0]->Description, $data[0]->Preparation);
$id = $_GET["msg"];

if (isset($_POST['submit'])) {
    
   
    $nom = $_POST['nom'];
    $img = "images/" . $_POST['image'];
    $description = $_POST['description'];
    $preparation = $_POST['preparation'];
    
    //if ($data["granted"] != false) {
        if(!empty($nom) && !empty($img) && !empty($description) && !empty($preparation)){
            $result = $cb->updateRecette($id,$img,$nom,htmlspecialchars($description, ENT_QUOTES),htmlspecialchars($preparation, ENT_QUOTES));
        }else{
            echo "au moins 1 des champs est vide !";
        }
    
    //}

}       
    
//}
