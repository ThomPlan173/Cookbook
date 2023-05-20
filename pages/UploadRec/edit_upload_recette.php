<?php

/*#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------*/

//page permettent de verifier le formulaire de modification d'une recette et la modifie si il n'y a pas eu de problème et upload le fichier image

session_start();
require ".." . DIRECTORY_SEPARATOR .".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();
$ed = new \Edit\Edit();
$up = new \Upload\Upload();
$tags = $cb->getAllTags(); // liste des tags
$ingrs = $cb->getAllIngredients();// liste des ingrédients
$tagsChecked = null; // contient les tags checked
$ingrsChecked = null; // contient les ingrédients checked
$quantitees = null;  // contient les quantitées des ingrédients checked
$unitees = null;    // contient les unitées des ingrédients checked
$verifqte = true;   // bool qui si false signifie que la quantité d'un ingrédient n'a pas été saisie ou mal saisie
$_SESSION["errortext"]=null;
$i = 0;
foreach ( $tags as $t){ // boucle qui verifie si les tags sont checked et si oui les ajoute à tagsChecked
    if($_POST["hideTag".$t->idTag]=="true"){
        $tagsChecked[$i] = $t;
        $i++;
    }
}

$i = 0;
foreach ($ingrs as $ig){ // boucle qui verifie si les ingredients sont checked et si oui les ajoute à ingrsChecked et ajoute sa quantité et unité à quantitées et unitées respectivement
    if($_POST["hideIngr".$ig->idIngredient]=="true"){
        $ingrsChecked[$i] = $ig;
        if($_POST["qte".$ig->idIngredient]==""){ // boucle qui verifie si les quantitées ont bien été saisies
            $_SESSION["errortext"]="Erreur pour la quantité d'un ingrédient !"; // sauvegarde du message d'erreur si problème de saisie de quantitée
            $verifqte=false;
        }
        $quantitees[$i] = $_POST["qte".$ig->idIngredient];
        $unitees[$i] = $_POST["hideIngrUt".$ig->idIngredient];
        $i++;
    }
}

$_SESSION['tagsChecked'] = $tagsChecked; // sauvegarde les tags checked
$_SESSION['ingrsChecked'] = $ingrsChecked; // sauvegarde les ingrs checked
$_SESSION['qte'] = $quantitees; // sauvegarde les qtees des ingrs checked
$_SESSION['unite'] = $unitees; // sauvegarde les unitees des ingrs checked
$_SESSION['nom'] = $_POST['nom']; // sauvegarde le nom de la recette (dans le form)
$_SESSION['description'] = $_POST['description']; // sauvegarde la description de la recette (dans le form)
$_SESSION['preparation'] =  $_POST['preparation']; // sauvegarde la preparation de la recette (dans le form)
$_SESSION['verif'] = true; // enregistre la clé verif qui signifie que le formulaire à été envoyé

$response = $ed->verifRecette($_SESSION['nom'],$_SESSION['description'],$_SESSION['preparation']); // verifie si le formulaire de modification de recette ne présente pas d'erreurs
$_SESSION['response'] = $response ; // sauvegarde response
if($response['granted']){ // si il n'y a pas d'erreur (hormis l'upload de fichiers), on verifie si il n'y a pas d'erreurs de quantitées
    if($verifqte):// si il n'y a pas d'erreurs de quantitées on upload le fichier
        $upload = $up->uploading("Recette"); // enregistre le nom du chemin du fichier uplaod si pas d'erreur
        if($upload!=""): // si il n'y a pas d'erreur d'upload, modifie la recette , modifie les tags et les ingrédients cochées avec les quantitées, unitées
            $_SESSION['image'] = $upload;
            $cb->updateRecette($_SESSION['id'], $_SESSION['image'],htmlspecialchars($_SESSION['nom'],ENT_QUOTES),htmlspecialchars($_SESSION['description'],ENT_QUOTES),htmlspecialchars($_SESSION['preparation'], ENT_QUOTES));
            $recettes = $cb->getAllRecettes();
            $idRecette = $_SESSION['id'];// récupère l'id de la recette

            $cb->deleteRecContenir($idRecette); // nettoie les affiliations de la recette avec contenir
            $cb->deleteRecAttribution($idRecette); // nettoie les affiliations de la recette avec attribuer
            foreach ($tagsChecked as $tc){// modifie les tags à la recette
                $cb->updateRecetteTags(true,$tc->idTag,$idRecette);
            }
            $i = 0;
            foreach ($ingrsChecked as $igc){// modifie les ingrédients à la recette avec quantitées , unitées
                $cb->updateRecetteIngredient(true,$quantitees[$i],$unitees[$i],$igc->idIngredient,$idRecette);
                $i++;
            }
            $_SESSION['response'] = null; // nettoie les clés de $_SESSION utilisées
            $_SESSION['nom'] = null;
            $_SESSION['image'] =  null;
            $_SESSION['description'] = null;
            $_SESSION['preparation'] =  null;
            $_SESSION['id'] = null;
            $_SESSION['errortext']=null;
            $_SESSION['tagsChecked'] = null;
            $_SESSION['ingrsChecked'] = null;
            $_SESSION['unite'] = null;
            $_SESSION['qte'] = null;
            $_SESSION['verif'] = null;
            header("Location: "."/Projet_Recettes/index.php"); // renvoie vers l'index
            exit() ;
        endif;
    endif;
}
header("Location: ".$_SERVER['HTTP_REFERER']); // renvoie vers edit
exit();

/*#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------*/
