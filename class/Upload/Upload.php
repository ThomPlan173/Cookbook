<?php

namespace Upload;

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

class Upload
{
    function uploading(string $type): string{
        // Les informations liées au fichier uploadé se trouvent dans $_FILES
        // NB : 'le_fichier' est le nom du champ dans le formulaire

        // On vérifie qu'un fichier a bien été mis dans le formulaire
        if(empty($_FILES['image'])): ?> <span style='color : red'>Il n'y a pas de fichier !</span>"
            <?php return ""  ;
        endif;

        // On récupère les informations
        $file = $_FILES['image'] ;


        if($file['error']!=0): ?>
            <div style="color:red">
                Une erreur s'est produite (code : <?= $file['error'] ?>).<br>
                Le fichier n'a pas été correctement uploadé.
            </div>
            <?php return "" ;
            endif;

         // S il n'y a pas d erreur

            // Pour sauvegarder le fichier uploadé, il faut faire une 'copie'
            // du fichier temporaire reçu dans un dossier local.

            // Nom du fichier temporaire reçu
            $temp_file_name = $file['tmp_name'] ;

            // Nom du fichier sauvegardé :
            // -> on peut utiliser le nom original du fichier
            $file_name = $file['name'] ;

            // Nom (arbitraire) du dossier où l'on enregistre la sauvegarde :
            $dir_name = "../../images/" .$type."/";
            // Vérification d'existence (et éventuelle création) du dossier cible
            if(!is_dir($dir_name)) mkdir($dir_name) ;

            // Enregistrement du fichier dans le serveur :
            $full_name = $dir_name . $file_name ;
            move_uploaded_file($temp_file_name, $full_name) ;
            $src_name = "images/".$type."/". $file_name ;?>

        <?php
        return $src_name;
        }

}

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------