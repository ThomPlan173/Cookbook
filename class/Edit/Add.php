<?php

namespace Edit;

class Add
{
    function generateform( $error=null): void{ ?>
        <form method="post" action="" class="edit" >
            <legend style="text-align: center">Modification</legend>
            <div class="form-group">
                Image : <input <?php if($error != null): if($error[0]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                       type="file" name="image" accept="image/png, image/gif, image/jpeg" autofocus>
                       
                Nom : <input <?php if($error != null): if($error[1]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                        type="text" name="nom" placeholder="nom" value="" autofocus>
                Description : <input <?php if($error != null): if($error[2]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                        type="text" name="description" placeholder="description"  autofocus>
                Preparation : <input <?php if($error != null): if($error[3]) :?>class = "error" <?php else :?> class = "input" <?php endif; endif ?>
                        type="text" name="preparation" placeholder="preparation" autofocus>
            </div>
            <input type="submit" name="submit" class="submit" value="Modifier">
        </form>
    <?php
    }



public function verif(string $nom, string $img, string $descr, string $prepa) : array{
    $error = [false,false,false,false] ;
    $granted = false ;
    $tabParams = [$nom,$img,$descr,$prepa];
    $c=0;
    for($i=0;$i<4;$i++){
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