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
echo $id;
if (isset($_POST['submit'])) {
    
   
    $nom = $_POST['nom'];
    $img = "images\\" . $_POST['image'];
    $description = $_POST['description'];
    $preparation = $_POST['preparation'];

    var_dump($_POST);
    echo $img . "<br>";
    echo $nom . "<br>";
    echo $description . "<br>";
    echo $preparation;
}
//
$data = $ed->verif($nom,$img, $description, $preparation);
var_dump($data);
    if ($data["granted"] != false) {
        $result = $cb->updateRecette($id,$img,$nom,$description,$preparation);
    }
       
    
//}
