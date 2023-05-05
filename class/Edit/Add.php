<?php

namespace Edit;

class Add
{
    function generateformRecette( $error=null): void{ ?>
        <form method="post" action="" class="edit" >
            <legend id="legend">Ajout</legend>
            <input type="submit" name="submit" class="submit" value="Ajouter">
            <div class="form-group">
                <div id="img">
                    Image : <input id="input_img" <?php if($error != null): if($error[0]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                                   type="file" name="image" accept="image/png, image/gif, image/jpeg" autofocus>
                </div>

                <div id="nom">
                Nom : <input id="input_nom" <?php if($error != null): if($error[1]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                             type="text" name="nom" placeholder="Nom de la recette" value="" autofocus>
                </div>

                <div id="desc">
                Description : <br><textarea id="input_desc" <?php if($error != null): if($error[2]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                                        name="description" placeholder="Description de la recette"  autofocus></textarea>
                </div>

                <div id="prep">
                Préparation : <br><textarea id="input_prep" <?php if($error != null): if($error[3]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                                        name="preparation" placeholder="Préparation de la recette" autofocus></textarea>
                 </div>
            </div>

        </form>
    <?php
    }



public function verifRecette(string $nom, string $img, string $descr, string $prepa) : array
{
    $error = [false, false, false, false];
    $granted = false;
    $tabParams = [$nom, $img, $descr, $prepa];
    $c = 0;
    for ($i = 0; $i < 4; $i++) {
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


function generateformIngredient( $error=null): void{ ?>
        <form method="post" action="" class="edit" >
            <div class="form-group">
                <input <?php if($error != null): if($error[1]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                             type="text" name="nom" placeholder="nom" value="" autofocus>
                <input <?php if($error != null): if($error[0]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                       type="file" name="image" accept="image/png, image/gif, image/jpeg" autofocus>
            </div>
            <input type="submit" name="submit" class="submit" value="Valider">
        </form>
        <?php
    }

    public function verifIngredient(string $nom, string $img) : array
    {
        $error = [false, false];
        $granted = false;
        $tabParams = [$nom, $img];
        $c = 0;
        for ($i = 0; $i < 2; $i++) {
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

?>