<?php
namespace pdowrapper ;

use \PDO ;

class PdoWrapper
{

    private $db_name ;
    private $db_user ;
    private $db_pwd ;
    private $db_host ;
    private $db_port ;
    private $pdo ;
//constructeur qui instancie une connexion à la BDD
    public function __construct($db_name, $db_host='127.0.0.1', $db_port='3306', $db_user = 'root', $db_pwd=''){
        $this->db_name = $db_name ;
        $this->db_host = $db_host ;
        $this->db_port = $db_port ;
        $this->db_user = $db_user ;
        $this->db_pwd = $db_pwd ;

        $dsn = 'mysql:dbname=' . $this->db_name . ';host='. $this->db_host. ';port=' . $this->db_port;
        try{
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pwd);
            $this->pdo->exec("set names utf8");
        }catch (\Exception $ex){
            die('Error : ' . $ex->getMessage()) ;
        }

    }
    //fonction qui execute les commandes SQL
    public function exec($statement, $params, $classname=null){
        $res = $this->pdo->prepare($statement) ;
        $res->execute($params) or die(print_r($res->errorInfo()));

        if($classname != null){
            $data = $res->fetchAll(PDO::FETCH_CLASS, $classname);
        }else{
            $data = $res->fetchAll(PDO::FETCH_OBJ);
        }

        return $data ;
    }

}