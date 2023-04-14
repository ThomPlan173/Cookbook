<?php

namespace Edit;

class Add
{
    function generateform( $error=null, $nom= null, $img = null, $description = null, $preparation = null): void{ ?>
        <form method="post" action="" class="edit" >
            <legend style="text-align: center">Ajout</legend>
            <div class="form-group">
                <?php if ($error!=null) : if(!$error[0]) : ?>
                    <img src ="<?php echo "/Projet_Recettes/".$img?>">
                <?php endif ; endif;?>
                Image : <input <?php if($error != null): if($error[0]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                       type="file" name="image" accept="image/png, image/gif, image/jpeg" value="<?php echo $img ?>" autofocus>

                Nom : <input <?php if($error != null): if($error[1]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                        type="text" name="nom" placeholder="nom" value="<?php echo $nom ?>" autofocus>
                Description : <input <?php if($error != null): if($error[2]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                        type="text" name="description" placeholder="description" value="<?php echo $description ?>" autofocus>
                Preparation : <input <?php if($error != null): if($error[3]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                        type="text" name="preparation" placeholder="preparation" value="<?php echo $preparation ?>" autofocus>
            </div>
            <input type="submit" name="submit" class="submit" value="Ajouter">
        </form>
    <?php
    }



public function verif(string $nom, string $img, string $descr, string $prepa) : array{
    $error = [false,false,false,false] ;
    $granted = false ;
    $tabParams = [$img,$nom,$descr,$prepa];
    $c=0;
    if($tabParams[0]=="images/"){
        $c+=1;
        $error[0]=true;
    }
    for($i=1;$i<4;$i++){
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