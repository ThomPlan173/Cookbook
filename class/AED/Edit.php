<?php

namespace AED;

class Edit
{
    function editRecettes(string $nom, string $img, string $descr, string $prepa): void{ ?>
        <form method="post" action="" class="edit" >
            <legend style="text-align: center">Modification</legend>
            <div class="form-group">
                Image : <input type="file" name="image" accept="image/png, image/gif, image/jpeg" value="$img" autofocus> <br>
                Nom : <input type="text" name="nom" placeholder="nom" value="<?php echo $nom ?>" autofocus> <br>
                Description : <input type="text" name="description" placeholder="description" value="<?php echo $descr ?>" autofocus> <br>
                Préparation : <input type="text" name="preparation" placeholder="preparation" value="<?php echo $prepa?>" autofocus> <br>
            </div>
            <button type="submit" class="submit">Modifier</button>
        </form>
    <?php
    }
}
?>