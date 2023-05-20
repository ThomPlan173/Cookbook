<?php

namespace Edit;

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

//Génére un la structure du form de modification d'une recette
//Prend en param les params d'une recette et un tableau d'erreurs qui contient les erreurs (généré avec verifRecette ci dessous )
//en fonction des erreurs, affiche ou non une erreur respectivement à côté de l'input
class Edit
{
    function generateformRecette(string $nom=null, string $descr=null, string $prepa=null, $error=null, $img=false): void{ ?>
        <div id = "Editform" class="edit" >
            <legend id = "legend" style="margin-left: 30%">
                <input id = "editsubmit"  type="submit" name="submit" class="submit" value="Modif"> <!-- Bouton d'Ajout -->
            </legend>
            <div class="form-group">
                <div id = "img">
                    Image : <input id="input_img"  class = "input"
                                   type="file" name="image" accept="image/png, image/gif, image/jpeg" autofocus> <!-- Input de l'image -->
                    <?php if($img):?><span class = "errortext">IMG !</span> <?php endif; ?>
                </div>
                <div id = "nom">
                    Nom : <input id="input_nom" <?php if($error != null): if($error[0]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif; ?>
                                 type="text" name="nom" placeholder="Nom de la recette" value="<?php echo $nom ?>" autofocus> <!-- Input du nom -->
                    <?php if($error!= null): if($error[0]) : ?><span class = "errortext">Nom !</span> <?php endif; endif; ?>
                </div>
                <div id = "desc">
                    Description : <?php if($error!= null): if($error[1]) : ?><span class = "errortext">Ajouter une Description !</span> <?php endif; endif; ?>
                    <br><textarea id="input_desc" <?php if($error != null): if($error[1]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif; ?>
                        name="description" placeholder="Description de la recette" value="<?php echo $descr?>" autofocus><?php echo $descr ?></textarea><!-- Input de la preparation-->
                </div>
                <div id = "prep">
                    Preparation : <?php if($error!= null): if($error[2]) : ?><span class = "errortext">Ajouter une Preparation !</span> <?php endif; endif; ?>
                    <br><textarea id="input_prep" <?php if($error != null): if($error[2]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif; ?>
                        name="preparation" placeholder="Préparation de la recette" value="<?php echo $prepa?>" autofocus><?php echo $prepa ?></textarea> <!-- Input de la description -->
                </div>

            </div>
        </div>
        <?php
    }

//renvoie si le formulaire et bien rempli ou non et le tableau d'erreurs qui est un tableau de bool avec pour indce -> 0, le nom -> 1, la description -> 2, la preparation
//si il y a une erreur à l'indice i, alors error[i] = true;
// on dit qu'il y a une erreur dans le cas où un champ est vide
    public function verifRecette(string $nom, string $descr, string $prepa) : array
    {
        $error = [false, false, false];// tableau d'erreurs initialisé
        $granted = false; // initialisation de granted qui definit si le formulaire est bien rempli ou non
        $tabParams = [$nom, $descr, $prepa]; // association des params de la recette à un indice du tableau error
        $c = 0; // correspond au nombre d'erreurs
        for ($i = 0; $i < 3; $i++) { //boucle de verification entre le tableau des params et error
            if ($tabParams[$i] == null) {
                $c += 1;
                $error[$i] = true;
            }
        }
        if ($c == 0):$granted = true; endif; // si aucune erreurs, granted = true
        return array(  // renvoie du tableau error et du bool granted
            'granted' => $granted,
            'error' => $error
        );
    }

//renvoie si le formulaire et bien rempli ou non et un bool erreur qui correspond à une erreur de nom
//si il y a une erreur error = true;
// on dit qu'il y a une erreur dans le cas où un champ est vide
    public function verifIngredient(string $nom) : array
    {
        $error = false; // error initialisé à false
        $granted = false;   // initialisation de granted qui definit si le formulaire est bien rempli ou non
        if ($nom==null)
            $error = true;
        if (!$error):$granted = true; endif;
        return array(   // renvoie dle bool error et le bool granted
            'granted' => $granted,
            'error' => $error
        );
    }

//renvoie si le formulaire et bien rempli ou non et un bool erreur qui correspond à une erreur de nom
//si il y a une erreur error = true;
// on dit qu'il y a une erreur dans le cas où un champ est vide
    public function verifTag(string $nom) : array
    {
        $error = false; // error initialisé à false
        $granted = false;   // initialisation de granted qui definit si le formulaire est bien rempli ou non
        if ($nom==null)
            $error = true;
        if (!$error):$granted = true; endif;
        return array(   // renvoie dle bool error et le bool granted
            'granted' => $granted,
            'error' => $error
        );
    }
}

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------
?>


