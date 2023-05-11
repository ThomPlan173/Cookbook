<?php

namespace Edit;

class Edit
{
    function generateformRecette(string $nom=null, string $descr=null, string $prepa=null, $error=null, $img=false): void{ ?>
        <form method="post" action="../UploadRec/edit_upload_recette.php" class="edit" enctype="multipart/form-data" >
            <legend id = "legend">Modification</legend>
            <input type="hidden" name="id" value="<?php echo $_GET["idRecette"] ?>">
            <input type="submit" name="submit" class="submit" value="Modifier">
            <div class="form-group">
                <div id = "img">
                    Image : <input id="input_img"  class = "input"
                                   type="file" name="image" accept="image/png, image/gif, image/jpeg" autofocus>
                    <?php if($img):?><span class = "errortext">IMG !</span> <?php endif; ?>
                </div>
                <div id = "nom">
                    Nom : <input id="input_nom" <?php if($error != null): if($error[0]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif; ?>
                                 type="text" name="nom" placeholder="Nom de la recette" value="<?php echo $nom ?>" autofocus>
                    <?php if($error!= null): if($error[0]) : ?><span class = "errortext">Nom !</span> <?php endif; endif; ?>
                </div>
                <div id = "desc">
                    Description : <?php if($error!= null): if($error[1]) : ?><span class = "errortext">Ajouter une Description !</span> <?php endif; endif; ?>
                    <br><textarea id="input_desc" <?php if($error != null): if($error[1]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif; ?>
                        name="description" placeholder="Description de la recette" value="<?php echo $descr?>" autofocus><?php echo $descr ?></textarea>
                </div>
                <div id = "prep">
                    Preparation : <?php if($error!= null): if($error[2]) : ?><span class = "errortext">Ajouter une Preparation !</span> <?php endif; endif; ?>
                    <br><textarea id="input_prep" <?php if($error != null): if($error[2]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif; ?>
                        name="preparation" placeholder="Préparation de la recette" value="<?php echo $prepa?>" autofocus><?php echo $prepa ?></textarea>
                </div>

            </div>

        </form>
        <?php
    }



    function generateformIngredient( $error=null): void{ ?>
        <form method="post" action="../UploadIngr/add_upload_ingredient" class="edit" >
            <div class="form-group">
                <input <?php if($error != null): if($error) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                       type="text" name="nom" placeholder="nom" value="" autofocus>
                <input class = "error"  class = "input"
                       type="file" name="image" accept="image/png, image/gif, image/jpeg" autofocus>
            </div>
            <input type="submit" name="submit" class="submit" value="Valider">
        </form>
        <?php
    }

    public function verifIngredient(string $nom) : array
    {
        $error = false;
        $granted = false;
        for ($i = 0; $i < 2; $i++) {
            if ($nom==null)
                $error = true;
        }
        if (!$error):$granted = true; endif;
        return array(
            'granted' => $granted,
            'error' => $error
        );
    }

    function generateformTag( $error=null): void{ ?>
        <form method="post" action="" class="edit" >
            <div class="form-group">
                <input <?php if($error != null): if($error[1]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                       type="text" name="nom" placeholder="nom" value="" autofocus>
            </div>
            <input type="submit" name="submit" class="submit" value="Valider">
        </form>
        <?php
    }

    public function verifTag(string $nom) : array
    {
        $error = false;
        $granted = false;
        for ($i = 0; $i < 2; $i++) {
            if ($nom==null)
                $error = true;
        }
        if (!$error):$granted = true; endif;
        return array(
            'granted' => $granted,
            'error' => $error
        );
    }
    public function verifRecette(string $nom, string $descr, string $prepa) : array
{
    $error = [false, false, false];
    $granted = false;
    $tabParams = [$nom, $descr, $prepa];
    $c = 0;
    for ($i = 0; $i < 3; $i++) {
        if ($tabParams[$i] == null) {
            $c += 1;
            $error[$i] = true;
        }
    }
    if ($c == 0):$granted = true; endif;
    return array(
        'granted' => $granted,
        'error' => $error
    );
}
}
?>