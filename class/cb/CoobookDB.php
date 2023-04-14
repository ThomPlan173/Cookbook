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
        return $this->exec("SELECT i.imgIngredient, i.nomIngredient, c.quantite, c.unite FROM recette as r 
        INNER JOIN contenir as c
        ON r.idRecette = c.idRecette
        INNER JOIN ingredient as i
        ON c.idIngredient = i.idIngredient
        WHERE r.idRecette = '$id'", null);
    }
    //Getter des tags pour un ID de recette spécifique, affichage d'un liste de tags
    public function getTags($id)
    {
        return $this->exec("SELECT t.nomTag FROM tag as t 
        INNER JOIN attribuer as a
        ON a.idTag = t.idTag
        INNER JOIN recette as r
        ON r.idRecette = a.idRecette
        WHERE r.idRecette = '$id'", null);
    }
    //Getter de tout les tags 
    public function getAllTags()
    {
        return $this->exec("SELECT DISTINCT idTag, nomTag FROM tag", null);
    }
    //Getter de tous le lesingrédients
    public function getAllIngredients()
    {
        return $this->exec("SELECT DISTINCT idIngredient, nomIngredient FROM ingredient", null);
    }
    //Etabli une recherche en fonction de 3 paramètres :
    // - $nom : valeur entrée dans la barre de recherche
    // - $method : la methode de recherche, par nom, ingrédient ou tag
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

    public function addRecette($img,$nom,$description,$preparation){
 
        $sql = "INSERT INTO recette (nomRecette,imgRecette, Description, Preparation) VALUES ('$nom','$img','$description','$preparation')";
        return $this->exec($sql, null);
    }
    
}
