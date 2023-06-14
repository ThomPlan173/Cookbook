<header>
    <div class="header">
        <div id="header2">
           
        
        
            <div id="content_bouton_header">
                <?php if(isset($_SESSION['login'])):
                    ?>
                    <button class="button_header" onclick="window.location.href = '/Projet_Recettes/pages/EditRec/add.php';"><h2>Ajouter une recette</h2></button>

                    <?php
                        if($_SERVER['PHP_SELF'] == '/Projet_Recettes/pages/recette.php' AND isset($_SESSION['idRecette'])): ?>
                            <form class="content_bouton_recette" method="get" action="EditRec/edit.php">
                                <button class="button_header" type="submit" name="idRecette" value="<?= $_SESSION['idRecette']?>"><h2>Modifier la recette</h2></button>
                            </form>
                        <?php
                        endif;
                    endif;?>

                <?php if(!isset($_SESSION['login'])): ?>
                    <button class="button_header" class="button_footer" id="login" onclick="window.location.href = '/Projet_Recettes/pages/Login/login.php';"><h1>Admin</h1></button>
                <?php else:?>

                    <button class="button_footer" id="logout" onclick="window.location.href = '/Projet_Recettes/pages/Login/logout.php';"><h1>Logout</h1></button>

                <?php endif;?>
            </div>
        <div>
    </div>
</header>