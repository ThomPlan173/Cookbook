<?php
session_start();

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
//$msg = $_POST['edit'] ;
$ed = new \Edit\Edit();
//$id = htmlspecialchars( utf8_encode($msg)) ;

$cb = new \cb\CoobookDB();
$data = $cb->getRecette("3");
$liste = $cb->getIngredients("3");
$tags = $cb->getTags("3");



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
            $result = $cb->updateRecette($id,$img,$nom,$description,$preparation);
        }else{
            echo "au moins 1 des champs est vide !";
        }
    
    //}

}       
    
//}
