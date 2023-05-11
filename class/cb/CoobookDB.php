<?php

namespace cb;

use \pdowrapper\PdoWrapper;

include __DIR__ . "../../../db_credentials.php";

// Classe utilisée pour la totalitée des requetes SQL nécéssaires
class CoobookDB extends PdoWrapper
{
    //dir pour les images
    public const IMAGE_DIR = "images/";

    //constructeur de classe et initialisateurs 
    public function __construct()
    {
        // appel au constructeur de la classe mère (PDOWrapper qui utilise PDO pour connecter la BD)
        parent::__construct(
            $GLOBALS['db_name'],
            $GLOBALS['db_host'],
            $GLOBALS['db_port'],
            $GLOBALS['db_user'],
            $GLOBALS['db_pwd']
        );
    }

    //Getter de recette pour un ID de recette spécifique, affichage des données de la recette ( recette.php )
    public function getRecette($id)
    {
        return $this->exec("SELECT * FROM recette WHERE idRecette = '$id'", null);
    }
    //Getter des ingrédients pour un ID de recette spécifique, affichage d'une liste d'ingrédients ( recette.php )
    public function getIngredients($id)
    {
        return $this->exec("SELECT i.idIngredient, i.imgIngredient, i.nomIngredient, c.quantite, c.unite FROM recette as r 
        INNER JOIN contenir as c
        ON r.idRecette = c.idRecette
        INNER JOIN ingredient as i
        ON c.idIngredient = i.idIngredient
        WHERE r.idRecette = '$id'", null);
    }
    //Getter des tags pour un ID de recette spécifique, affichage d'un liste de tags
    public function getTags($id)
    {
        return $this->exec("SELECT t.idTag, t.nomTag FROM tag as t 
        INNER JOIN attribuer as a
        ON a.idTag = t.idTag
        INNER JOIN recette as r
        ON r.idRecette = a.idRecette
        WHERE r.idRecette = '$id'", null);
    }
    //Getter de tout les tags 
    public function getAllTags()
    {
        return $this->exec("SELECT DISTINCT idTag, nomTag FROM tag ORDER BY nomTag ASC", null);
    }
    //Getter de tous le les ingrédients
    public function getAllIngredients()
    {
        return $this->exec("SELECT DISTINCT idIngredient, nomIngredient FROM ingredient ORDER BY nomIngredient ASC", null);
    }
    public function getAllRecettes()
    {
        return $this->exec("SELECT DISTINCT idIngredient, nomIngredient FROM ingredient ORDER BY nomIngredient ASC", null);
    }
    //Etabli une recherche en fonction de 2 paramètres :
    // - $nom : valeur entrée dans la barre de recherche
    // - $pref : recherche selon préférence utilisateur ( Alphabetique ou inversé ) 

    // => Susceptible d'être modifié
    public function search($nom, $pref)
    {
        return $this->exec("SELECT idRecette,nomRecette, imgRecette, Description FROM recette WHERE nomRecette LIKE '%{$nom}%' ORDER BY nomRecette $pref", null);      
    }

// Update une recette, dépendra des valeurs transmises et de l'ID de recette passé en GET
    
    public function updateRecette($id,$img,$nom,$description,$preparation){
 
        $sql = "UPDATE recette SET nomRecette = '{$nom}',imgRecette = '{$img}', Description = '{$description}', Preparation = '{$preparation}' WHERE idRecette = '{$id}'";
        return $this->exec($sql, null);
    }

    public function updateIngredient($id,$img,$nom){

        $sql = "UPDATE ingredient SET nomIngredient = '{$nom}',imgIngredient = '{$img}' WHERE idIngredient = '{$id}'";
        return $this->exec($sql, null);
    }

    public function updateTag($id,$nom){

        $sql = "UPDATE tag SET nomTag = '{$nom}' WHERE idTag = '{$id}'";
        return $this->exec($sql, null);
    }

    public function addRecette($img,$nom,$description,$preparation){
 
        $sql = "INSERT INTO recette (nomRecette,imgRecette, Description, Preparation) VALUES ('$nom','$img','$description','$preparation')";
        return $this->exec($sql, null);
    }

    public function addIngredient($img,$nom){

        $sql = "INSERT INTO ingredient (nomIngredient,imgIngredient) VALUES ('$nom','$img')";
        return $this->exec($sql, null);
    }

    public function addTag($nom){

        $sql = "INSERT INTO tag (nomTag) VALUES ('$nom')";
        return $this->exec($sql, null);
    }
    public function getAllRIT(){
        $sql = "SELECT r.idRecette,r.nomRecette,r.Description,r.imgRecette,
        ( SELECT GROUP_CONCAT(a.idTag) 
         FROM  attribuer as a
         where r.idRecette = a.idRecette
        ) AS liste_de_tags ,
        ( SELECT GROUP_CONCAT(c.idIngredient ) 
         FROM  contenir as c
         where c.idRecette = r.idRecette
        )  AS liste_de_ingredients
        FROM recette as r
        ORDER BY r.nomRecette ASC" ;
        return $this->exec($sql, null);
    }
    public function deleteRecette($id)
    {
        return $this->exec("DELETE FROM recette WHERE idRecette = '$id'", null);
    }
    public function deleteIngredient($id)
    {
        return $this->exec("DELETE FROM ingredient WHERE idIngredient = '$id'", null);
    }
    public function deleteTag($id)
    {
        return $this->exec("DELETE FROM tag WHERE idTag = '$id'", null);
    }
    public function searchCount($nom, $pref)
    {
        return $this->exec("SELECT COUNT(idRecette) FROM recette WHERE nomRecette LIKE '%{$nom}%' ORDER BY nomRecette $pref", null);      
    }
    public function getIngrQuantities($idIngr, $idRecette){
        return $this->exec("SELECT quantite,unite FROM contenir WHERE idIngredient = '{$idIngr}' AND idRecette = '{$idRecette}' ", null);
    }
    
    public function updateRecetteTags($boolChecked, $idTag, $idRecette){
        if($boolChecked == true && $this->exec("SELECT * from attribuer WHERE idTag = '{$idTag}' AND idRecette = '{$idRecette}'
        ",null) == null  ){
            return $this->exec("INSERT INTO attribuer ( idRecette, idTag ) VALUES ( {$idRecette}','{$idTag}'", null);
        }else if($boolChecked == false && $this->exec("SELECT * from attribuer WHERE idTag = '{$idTag}' AND idRecette = '{$idRecette}'
        ",null) != null){
            return $this->exec("DELETE FROM attribuer WHERE idTag = '{$idTag}' AND idRecette = '{$idRecette}' ", null);
        }
    }
}
