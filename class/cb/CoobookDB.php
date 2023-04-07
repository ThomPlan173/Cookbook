<?php

namespace cb;

use \pdowrapper\PdoWrapper;

include __DIR__ . "../../../db_credentials.php";

class CoobookDB extends PdoWrapper
{

    public const IMAGE_DIR = "images/";

    public function __construct()
    {
        // appel au constructeur de la classe mère
        parent::__construct(
            $GLOBALS['db_name'],
            $GLOBALS['db_host'],
            $GLOBALS['db_port'],
            $GLOBALS['db_user'],
            $GLOBALS['db_pwd']
        );
    }

    public function getRecette($nom)
    {
        return $this->exec("SELECT * FROM recette WHERE nomRecette = '$nom'", null);
    }
    public function getIngredients()
    {
        return $this->exec("SELECT i.imgIngredient, i.nomIngredient, c.quantite, c.unite FROM recette as r 
        INNER JOIN contenir as c
        ON r.idRecette = c.idRecette
        INNER JOIN ingredient as i
        ON c.idIngredient = i.idIngredient
        WHERE nomRecette = 'Cookies'", null);
    }
    public function getTags()
    {
        return $this->exec("SELECT t.nomTag FROM tag as t 
        INNER JOIN attribuer as a
        ON a.idTag = t.idTag
        INNER JOIN recette as r
        ON r.idRecette = a.idRecette
        WHERE nomRecette = 'Cookies'", null);
    }

    public function search($nom){
        return $this->exec("SELECT nomRecette, imgRecette FROM recette
        WHERE nomRecette LIKE '%$nom%'", null);
    }
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
