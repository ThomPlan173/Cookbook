<?php

namespace Edit;

class Delete
{
    function generateform( $error=null): void{ ?>
        <script>
            alert("Etes-vous sûr de vouloir supprimer la recette ?")
        </script>
    <?php
    }
}