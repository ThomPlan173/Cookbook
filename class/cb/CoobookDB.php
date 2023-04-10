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
        return $this->exec("SELECT DISTINCT nomTag FROM tag", null);
    }
    //Getter de tous le lesingrédients
    public function getAllIngredients()
    {
        return $this->exec("SELECT DISTINCT nomIngredient FROM ingredient", null);
    }
    //Etabli une recherche en fonction de 3 paramètres :
    // - $nom : valeur entrée dans la barre de recherche
    // - $method : la methode de recherche, par nom, ingrédient ou tag
    // - $pref : recherche selon préférence utilisateur ( Alphabetique ou inversé ) 

    // => Susceptible d'être modifié
    public function search($nom, $method, $pref)
    {

        switch ($method) {
            case 'nomRecette':
                return $this->exec("SELECT idRecette,nomRecette, imgRecette, Description FROM recette
                WHERE $method LIKE '%$nom%' ORDER BY nomRecette $pref", null);
            case 'nomIngredient':
                return $this->exec("SELECT r.idRecette,r.nomRecette, r.imgRecette, r.Description 
                FROM recette as r
                INNER JOIN contenir as c
                ON r.idRecette = c.idRecette
                INNER JOIN ingredient as i
                ON c.idIngredient = i.idIngredient 
                WHERE i.nomIngredient LIKE '%$nom%' ORDER BY r.nomRecette $pref", null);
            case 'nomTag':
                return $this->exec("SELECT r.idRecette,r.nomRecette, r.imgRecette, r.Description 
                FROM recette as r
                INNER JOIN attribuer as a
                ON a.idRecette = r.idRecette
                INNER JOIN tag as t
                ON t.idTag = a.idTag
                WHERE t.nomTag LIKE '%$nom%'ORDER BY r.nomRecette $pref", null);
        }
    }

// Update une recette, dépendra des valeurs transmises et de l'ID de recette passé en GET
    /*
    public function updateRecette (){
        return $this.exec("UPDATE recette SET imgRecette, nomRecette, Description, Preparation VALUES ...");
    }
*/

    //Création d'une nouvelle recette
    public function createRecette($name, $description = null, $imgFile = null)
    {

        /* $name = htmlspecialchars($name) ;
        $description = htmlspecialchars($description) ;

        $imgName = null ;
        // enregistrement du fichier uploadé
        if($imgFile != null){
            $tmpName = $imgFile['tmp_name'] ;
            $imgName = $imgFile['name'] ;
            $imgName = urlencode(htmlspecialchars($imgName)) ;

            $dirname = $GLOBALS['PHP_DIR'].self::IMAGE_DIR ;
            if(!is_dir($dirname)) mkdir($dirname) ;
            $uploaded = move_uploaded_file($tmpName, $dirname.$imgName) ;
            if (!$uploaded) die("FILE NOT UPLOADED") ;
        }else echo "NO IMAGE !!!!" ;

        $query = 'INSERT INTO games(name, description, image) VALUES (:name, :description, :image)';
        $params=[
            'name' => htmlspecialchars($name),
            'description' => htmlspecialchars($description),
            'image' => $imgName
        ] ;
        return $this->exec($query, $params) ;*/
    }
}
