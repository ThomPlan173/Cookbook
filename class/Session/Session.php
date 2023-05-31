<?php
namespace Session;

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------
class Session
{

    // fonction permettant de nettoyer certains cles de $_SESSION
    function cleanSession(): void {
        $_SESSION['response'] = null; //reponse ou non, boolean
        $_SESSION['nom'] = null; //Nom de recette
        $_SESSION['image'] =  null; //lien d'image de recette
        $_SESSION['description'] = null; //description de recette
        $_SESSION['preparation'] =  null; //préparation de la recette
        $_SESSION['id'] = null; //id de recette
        $_SESSION['nomIngr'] = null; //nom d'ingredient de la recette
        $_SESSION['idIngr'] = null;  //id d'ingredient de la recette
        $_SESSION['errortext'] = null; //message d'erreur 
        $_SESSION['responseAdd'] = null; //réponse d'ajout de recette 
        $_SESSION['responseEdit'] = null; //réponse de modif de recette
        $_SESSION['idTag'] = null; //id de tag
        $_SESSION['nomTag'] = null; //nom de tag
        $_SESSION['verif'] = null; //verif si les formulaires sont remplis et valides
        $_SESSION['tagsChecked'] = null; //tags chechés
        $_SESSION['ingrsChecked'] = null; //ingrédients checkés
        $_SESSION['unite'] = null; //l'unité d'ingrédient
        $_SESSION['qte'] = null;//quantité de l'ingerédient
    }
}

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------