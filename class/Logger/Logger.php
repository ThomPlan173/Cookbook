<?php

namespace Logger;

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

//Génére un le form de Login
//Prend en param le nom entrée précédemment et un bool erreur généré par log ci dessous
//en fonction des erreurs, affiche ou non une erreur
class Logger
{
    public function generateLoginForm(string $username=null, $error=null): void{
        if (isset($response['error'])): ?>
            <div class="error">
                <?php echo $error ?> <!-- erreur à afficher si il y a une erreur-->
            </div>
        <?php endif; ?>
       
        <form method="post" action="" class="login" id="login-form">
            <input type="hidden" name="url_referer" value="<?php echo $_SERVER['HTTP_REFERER']; ?>"> <!-- input contenant le lien de la derniere page visité pour rediriger correctement l'utilisateur-->
            <legend class="legend">Login</legend>
            <legend class="legend" id="admin">(Only for administrators)</legend>
            <div class="form-group">
                <input class="form" type="text" name="username" placeholder="Username" value="<?php echo $username ?>" autofocus> <!-- input du nom d'utilisateur avec comme valeur par défaut username en param-->
                <input class="form" id="formD" type="password" name="password" placeholder="Password">      <!-- input du mot de passe -->
            </div>
            <button type="submit" class="submit">LOGIN</button> <!-- bouton login -->
        </form>
        <?php
    }


    //Verifie les données dans le form login, contient donc en param un username et un mdp
    // si le données des params correspondent respectivement à user et pdw alors le param granted est true
    public function log(string $username, string $password) : array{

        $user = "admin" ;
        $pwd = "cookbook" ;

        $error = null ;
        $granted = false ; // initialisation de granted qui correspond à true si il n'y a pas d'erreur dans les param et false sinon
        if (empty($username)){ // affiche une erreur si il n'y a pas de nom
            $error = "Username is Empty" ;
        }elseif (empty($password)){ // affiche une erreur si il n'y a pas de mot de passer
            $error = "Password is Empty" ;
        }elseif ($user == $username and $pwd == $password){  // granted = true si les données correspondent
            $granted = true ;
        }else{
            $error = "Authentication Failed" ; // sinon renvoie une erreur
        }
        return array( // renvoie du tableau du bool granted et du bool error
            'granted' => $granted,
            'error' => $error
        ) ;

    }

}

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------