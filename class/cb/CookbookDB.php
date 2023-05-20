<?php

namespace cb;

use \pdowrapper\PdoWrapper;

include __DIR__ . "../../../db_credentials.php";

// Classe utilisée pour la totalitée des requetes SQL nécéssaires
class cookbookDB extends PdoWrapper
{
    public const IMAGE_DIR = "images/"; // Répertoire pour les images des recettes

    // Constructeur de classe
    public function __construct()
    {
        // Appel du constructeur de la classe mère (PDOWrapper qui utilise PDO pour se connecter à la base de données)
        parent::__construct(
            $GLOBALS['db_name'],
            $GLOBALS['db_host'],
            $GLOBALS['db_port'],
            $GLOBALS['db_user'],
            $GLOBALS['db_pwd']
        );
    }

    // Méthode pour obtenir les données d'une recette spécifique en fonction de son ID
    public function getRecette($id)
    {
        $query = "SELECT * FROM recette WHERE idRecette = :id"; // Utilisation de paramètres nommés pour éviter les injections SQL
        $params = array('id' => $id); // Tableau des paramètres

        return $this->exec($query, $params); // Exécution de la requête préparée avec les paramètres
    }

    // Getter des ingrédients pour un ID de recette spécifique, affichage d'une liste d'ingrédients (recette.php)
    public function getIngredients($id)
    {
        $query = "SELECT i.idIngredient, i.imgIngredient, i.nomIngredient, c.quantite, c.unite 
              FROM recette AS r 
              INNER JOIN contenir AS c ON r.idRecette = c.idRecette
              INNER JOIN ingredient AS i ON c.idIngredient = i.idIngredient
              WHERE r.idRecette = :id"; // Utilisation de paramètres nommés pour éviter les injections SQL
        $params = array('id' => $id); // Tableau des paramètres

        return $this->exec($query, $params); // Exécution de la requête préparée avec les paramètres
    }

    // Getter des tags pour un ID de recette spécifique, affichage d'une liste de tags (recette.php)
    public function getTags($id)
    {
        $query = "SELECT t.idTag, t.nomTag 
              FROM tag AS t 
              INNER JOIN attribuer AS a ON a.idTag = t.idTag
              INNER JOIN recette AS r ON r.idRecette = a.idRecette
              WHERE r.idRecette = :id"; // Utilisation de paramètres nommés pour éviter les injections SQL
        $params = array('id' => $id); // Tableau des paramètres

        return $this->exec($query, $params); // Exécution de la requête préparée avec les paramètres
    }

    // Getter de tous les tags, affichage d'une liste de tous les tags
    public function getAllTags()
    {
        $query = "SELECT DISTINCT idTag, nomTag FROM tag ORDER BY nomTag ASC";

        return $this->exec($query, null);
    }

    // Getter de tous les ingrédients (id et nom), affichage d'une liste de tous les ingrédients disponibles
    public function getAllIngredients()
    {
        $query = "SELECT DISTINCT idIngredient, nomIngredient FROM ingredient ORDER BY nomIngredient ASC";

        return $this->exec($query, null);
    }

    public function getAllRecettes()
    {
        return $this->exec("SELECT DISTINCT idRecette, nomRecette FROM recette" , null);
    }

    // Update d'une recette spécifique dans la base de données
    public function updateRecette($id, $img, $nom, $description, $preparation)
    {
        $query = "UPDATE recette SET nomRecette = :nom, imgRecette = :img, Description = :description, Preparation = :preparation WHERE idRecette = :id";
        $params = array(
            'id' => $id, // Paramètre nommé pour l'ID de la recette
            'img' => $img, // Paramètre nommé pour l'image de la recette
            'nom' => $nom, // Paramètre nommé pour le nom de la recette
            'description' => $description, // Paramètre nommé pour la description de la recette
            'preparation' => $preparation // Paramètre nommé pour la préparation de la recette
        );

        return $this->exec($query, $params); // Exécution de la requête préparée avec les paramètres
    }

    // Update d'un ingrédient spécifique dans la base de données
    public function updateIngredient($id, $img, $nom)
    {
        $query = "UPDATE ingredient SET nomIngredient = :nom, imgIngredient = :img WHERE idIngredient = :id";
        $params = array(
            'id' => $id, // Paramètre nommé pour l'ID de l'ingrédient
            'img' => $img, // Paramètre nommé pour l'image de l'ingrédient
            'nom' => $nom // Paramètre nommé pour le nom de l'ingrédient
        );

        return $this->exec($query, $params); // Exécution de la requête préparée avec les paramètres
    }

    //update d'un tag spécifique
    public function updateTag($id, $nom)
    {

        $sql = "UPDATE tag SET nomTag = '{$nom}' WHERE idTag = '{$id}'";
        return $this->exec($sql, null);
    }
    //ajouter une recette 
    public function addRecette($img, $nom, $description, $preparation)
    {

        $sql = "INSERT INTO recette (nomRecette,imgRecette, Description, Preparation) VALUES ('$nom','$img','$description','$preparation')";
        return $this->exec($sql, null);
    }
    //ajouter un ingredient
    public function addIngredient($img, $nom)
    {

        $sql = "INSERT INTO ingredient (nomIngredient,imgIngredient) VALUES ('$nom','$img')";
        return $this->exec($sql, null);
    }
    //ajouter un tag
    public function addTag($nom)
    {

        $sql = "INSERT INTO tag (nomTag) VALUES ('$nom')";
        return $this->exec($sql, null);
    }
    //Recuperation d'une recette, de ses informations, d'une liste d'id de tags, d'une liste d'id d'ingredients
    public function getAllRIT()
    {
        $sql = "SELECT r.idRecette,r.nomRecette,r.Description,r.imgRecette,
        ( SELECT GROUP_CONCAT(a.idTag) 
         FROM  attribuer as a
         where r.idRecette = a.idRecette
        ) AS liste_tags ,
        ( SELECT GROUP_CONCAT(c.idIngredient ) 
         FROM  contenir as c
         where c.idRecette = r.idRecette
        )  AS liste_ingredients
        FROM recette as r
        ORDER BY r.nomRecette ASC";
        return $this->exec($sql, null);
    }
    //supprimer une recette
    public function deleteRecette($id)
    {
        return $this->exec("DELETE FROM recette WHERE idRecette = '$id'", null);
    }
    //supprimer un ingredient
    public function deleteIngredient($id)
    {
        return $this->exec("DELETE FROM ingredient WHERE idIngredient = '$id'", null);
    }
    //supprimer un Tag
    public function deleteTag($id)
    {
        return $this->exec("DELETE FROM tag WHERE idTag = '$id'", null);
    }
    //obtenir pour un ingredient spécifique à une recette sa quantité et unité
    public function getIngrQuantities($idRecette)
    {
        return $this->exec("SELECT c.idIngredient,c.quantite,c.unite FROM contenir as c INNER JOIN ingredient as i ON c.idIngredient = i.idIngredient WHERE c.idRecette = '{$idRecette}' order by i.nomIngredient ", null);
    }
    //mettre à jour les tags d'une recette spécifique

    // Verifie la différence si on coche le tag, et qu'il n'est pas instancier dans la table "attribuer"
    public function updateRecetteTags($boolChecked, $idTag, $idRecette)
    {
        if ($boolChecked == true && $this->exec("SELECT * from attribuer WHERE idTag = '{$idTag}' AND idRecette = '{$idRecette}'
        ", null) == null) {
            return $this->exec("INSERT INTO attribuer ( idRecette, idTag ) VALUES ( '{$idRecette}','{$idTag}'", null);
        } else if ($boolChecked == false && $this->exec("SELECT * from attribuer WHERE idTag = '{$idTag}' AND idRecette = '{$idRecette}'
        ", null) != null) {
            return $this->exec("DELETE FROM attribuer WHERE idTag = '{$idTag}' AND idRecette = '{$idRecette}' ", null);
        }
    }
    public function updateRecetteIngredient($boolChecked,$quantite, $unite = null, $idIngr, $idRecette){
        if($boolChecked == true && $this->exec("SELECT * from contenir WHERE idIngredient = '{$idIngr}' AND idRecette = '{$idRecette}'
        ",null) == null  ){
            return $this->exec("INSERT INTO contenir ( idRecette, idIngredient, quantite, unite ) VALUES ( '{$idRecette}','{$idIngr}','{$quantite}','{$unite}')", null);
        }else if($boolChecked == false && $this->exec("SELECT * from contenirWHERE idIngredient = '{$idIngr}' AND idRecette = '{$idRecette}'
        ",null) != null){
            return $this->exec("DELETE FROM contenir WHERE idIngredient = '{$idIngr}' AND idRecette = '{$idRecette}' ", null);
        } else {
            return $this->exec("UPDATE contenir SET quantite = '{$quantite}', unite = '{$unite}' WHERE idIngredient = '{$idIngr}' AND idRecette = '{$idRecette}' ", null);
        }
    }
    public function addTagRecette($idTag,$idRecette){
        return $this->exec("INSERT INTO attribuer ( idRecette, idTag ) VALUES ( '{$idRecette}','{$idTag}')", null);
    }

    public function addIngredientRecette($quantite,$unite = null, $idIngr, $idRecette){
        return $this->exec("INSERT INTO contenir ( idRecette, idIngredient, quantite, unite ) VALUES ( '{$idRecette}','{$idIngr}','{$quantite}','{$unite}')", null);
    }

    public function deleteIngredientContenir($idIngr)
    {
        return $this->exec("DELETE FROM contenir WHERE idIngredient = '$idIngr'", null);
    }
    //supprimer un Tag
    public function deleteTagAttribution($idTag)
    {
        return $this->exec("DELETE FROM attribuer WHERE idTag = '$idTag'", null);
    }

    public function deleteRecAttribution($idRec)
    {
        return $this->exec("DELETE FROM attribuer WHERE idRecette = '$idRec'", null);
    }

    public function addIngredientRecette($quantite, $unite = null, $idIngr, $idRecette){
        return $this->exec("INSERT INTO contenir ( idRecette, idIngredient, quantite, unite ) VALUES ( '{$idRecette}','{$idIngr}','{$quantite}','{$unite}'", null);
    }
}
