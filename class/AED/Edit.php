<?php

namespace AED;

class Edit
{
    function generateform(string $nom=null, string $img=null, string $descr=null, string $prepa=null, $error=null): void{ ?>
        <form method="get" action="" class="edit" >
            <legend style="text-align: center">Modification</legend>
            <div class="form-group">
                <?php if($error==null):?>
                Image : <input <?php if($error[0]) :?>class = "error" <?php else :?> class = "input" <?php endif; ?>
                       type="file" name="image" accept="image/png, image/gif, image/jpeg" value="$img" autofocus>
                Nom : <input <?php if($error[1]) :?>class = "error" <?php else :?> class = "input" <?php endif; ?>
                        type="text" name="nom" placeholder="nom" value="<?php echo $nom ?>" autofocus>
                Description : <input <?php if($error[2]) :?>class = "error" <?php else :?> class = "input" <?php endif; ?>
                        type="text" name="description" placeholder="description" value="<?php echo $descr ?>" autofocus>
                Preparation : <input <?php if($error[3]) :?>class = "error" <?php else :?> class = "input" <?php endif; ?>
                        type="text" name="preparation" placeholder="preparation" value="<?php echo $prepa?>" autofocus>
                <?php endif ?>
            </div>
            <button type="submit" class="submit">Modifier</button>
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