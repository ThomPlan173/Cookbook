<?php

namespace Edit;

class Edit
{
    function generateformRecette(string $nom=null, string $descr=null, string $prepa=null, $error=null): void{ ?>
        <form method="post" action="../UploadRec/edit_upload_recette.php" class="edit" enctype="multipart/form-data">
            <legend id = "legend">Modification</legend>
            <input type="submit" name="submit" class="submit" value="Modifier">
            <div class="form-group">
                <div id = "">
                    Image : <input id="input_img" class = "error"  class = "input"
                                   type="file" name="image" accept="image/png, image/gif, image/jpeg" autofocus>
                </div>
                <div id = "">
                    Nom : <input id="input_nom" <?php if($error != null): if($error[0]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                                 type="text" name="nom" placeholder="Nom de la recette" value="<?php echo $nom ?>" autofocus>
                </div>
                <div id = "">
                    Description : <br><textarea id="input_desc" <?php if($error != null): if($error[1]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                        name="description" placeholder="Description de la recette" value="<?php echo $descr?>" autofocus><?php echo $descr ?></textarea>
                </div>
                <div id = "">
                    Preparation : <br><textarea id="input_prep" <?php if($error != null): if($error[2]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                        name="preparation" placeholder="Préparation de la recette" value="<?php echo $prepa?>" autofocus><?php echo $prepa ?></textarea>
                </div>

            </div>

        </form>
        <?php
    }



public function verifRecette(string $nom, string $descr, string $prepa) : array{
    $error = [false,false,false] ;
    $granted = false ;
    $tabParams = [$nom,$descr,$prepa];
    $c=0;
    for($i=0;$i<3;$i++){
        if($tabParams[$i]==null){
            $c+=1;
            $error[$i]=true;
        }
    }
    if($c==0):$granted=true; endif;
    return array(
            'granted' => $granted,
            'error' => $error
    );
}

}
?>