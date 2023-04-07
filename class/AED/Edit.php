<?php

namespace AED;

class Edit
{
    function editRecettes(string $nom, string $img, string $descr, string $prepa): void{ ?>
        <form method="post" action="" class="edit" >
            <legend style="text-align: center">Modification</legend>
            <div class="form-group">
                <input type="file" name="image" accept="image/png, image/gif, image/jpeg" value="$img" autofocus>
                <input type="text" name="nom" placeholder="nom" value="<?php echo $nom ?>" autofocus>
                <input type="text" name="description" placeholder="description" value="<?php echo $descr ?>" autofocus>
                <input type="text" name="preparation" placeholder="preparation" value="<?php echo $prepa?>" autofocus>
            </div>
            <button type="submit" class="submit">Modifier</button>
        </form>
    <?php
    }
}
?>