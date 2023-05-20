<?php

/*#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------*/

session_start();
require ".." . DIRECTORY_SEPARATOR .".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();
$ad = new \Edit\Add();
$up = new \Upload\Upload();
$tags = $cb->getAllTags();
$ingrs = $cb->getAllIngredients();
$tagsChecked = null;
$ingrsChecked = null;
$quantitees = null;
$unitees = null;
$verifqte = true;
$ingredients = $cb->getAllIngredients();
$_SESSION["errortext"]=null;
$i = 0;
foreach ( $tags as $t){
    if($_POST["hideTag".$t->idTag]=="true"){
        $tagsChecked[$i] = $t;
        $i++;
    }
}

$i = 0;
foreach ($ingrs as $ig){
    if($_POST["hideIngr".$ig->idIngredient]=="true"){
        $ingrsChecked[$i] = $ig;
        if($_POST["qte".$ig->idIngredient]==""){
            $_SESSION["errortext"]="Erreur pour la quantité d'un ingrédient !";
            $verifqte=false;
        }
        $quantitees[$i] = $_POST["qte".$ig->idIngredient];
        $unitees[$i] = $_POST["hideIngrUt".$ig->idIngredient];
        $i++;
    }
}

$_SESSION['tagsChecked'] = $tagsChecked;
$_SESSION['ingrsChecked'] = $ingrsChecked;
$_SESSION['qte'] = $quantitees;
$_SESSION['unite'] = $unitees;
$_SESSION['nom'] = $_POST['nom'];
$_SESSION['description'] = $_POST['description'];
$_SESSION['preparation'] =  $_POST['preparation'];

$response = $ad->verifRecette($_SESSION['nom'],$_SESSION['description'],$_SESSION['preparation']);
$_SESSION['response'] = $response ;
if($response['granted']){
    if($verifqte):
    $upload = $up->uploading("Recette");
    if($upload!=""):
        $_SESSION['image'] = $upload;
        $cb->addRecette($_SESSION['image'],htmlspecialchars($_SESSION['nom'],ENT_QUOTES),htmlspecialchars($_SESSION['description'], ENT_QUOTES),htmlspecialchars($_SESSION['preparation'], ENT_QUOTES));
        $recettes = $cb->getAllRecettes();
        foreach ($recettes as $r){
            $idRecette = $r->idRecette;
        }
        foreach ($tagsChecked as $tc){
            $cb->addTagRecette($tc->idTag, $idRecette);
        }
        $i = 0;
        foreach ($ingrsChecked as $igc){
            $cb->addIngredientRecette($quantitees[$i],$unitees[$i], $igc->idIngredient, $idRecette);
            $i++;
        }
        $_SESSION['response'] = null;
        $_SESSION['nom'] = null;
        $_SESSION['image'] =  null;
        $_SESSION['description'] = null;
        $_SESSION['preparation'] =  null;
        $_SESSION['errortext']=null;
        $_SESSION['tagsChecked'] = null;
        $_SESSION['ingrsChecked'] = null;
        $_SESSION['unite'] = null;
        $_SESSION['qte'] = null;
        header("Location: "."/Projet_Recettes/index.php");
        exit() ;
        endif;
        endif;
}
header("Location: ".$_SERVER['HTTP_REFERER']);
exit();

/*#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------*/

