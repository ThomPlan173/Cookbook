<header>
    <div class="header">
        <div id="header2">
            <img id="index" src=/Projet_Recettes/class/Template/img/index.png onclick="window.location.href = '/Projet_Recettes/index.php';">
            <div id="content_bouton_header">
                <?php if(isset($_SESSION['login'])):
                    ?>
                    <button class="button_header" onclick="window.location.href = '/Projet_Recettes/pages/EditRec/add.php';"><h2>Ajouter une Recette</h2></button>

                    <?php
                        if($_SERVER['PHP_SELF'] == '/Projet_Recettes/pages/recette.php' AND isset($_SESSION['idRecette'])): ?>
                            <form class="content_bouton_recette" method="get" action="EditRec/edit.php">
                                <button class="button_header" type="submit" name="idRecette" value="<?= $_SESSION['idRecette']?>"><h2>Ajouter une Recette</h2></button>
                            </form>
                        <?php
                        endif;
                    endif;?>
            </div>
        <div>
    </div>
</header>