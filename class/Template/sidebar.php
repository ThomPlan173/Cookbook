    <nav id="sidebar">
        <?php if($_SESSION['page']=="recettes"):?>
        <button class="button_disable" onclick="window.location.href = '/Projet_Recettes/pages/browse/liste_recettes.php';"><h2>Recettes</h2></button>
        <button class="button_header" onclick="window.location.href = '/Projet_Recettes/pages/browse/liste_ingredients.php';"><h2>Ingredients</h2></button>
        <button class="button_header" onclick="window.location.href = '/Projet_Recettes/pages/browse/liste_tags.php';"><h2>Tags</h2></button>
        <?php endif;
        if($_SESSION['page']=="ingredients"):?>
        <button class="button_header" onclick="window.location.href = '/Projet_Recettes/pages/browse/liste_recettes.php';"><h2>Recettes</h2></button>
        <button class="button_disable" onclick="window.location.href = '/Projet_Recettes/pages/browse/liste_ingredients.php';"><h2>Ingredients</h2></button>
        <button class="button_header" onclick="window.location.href = '/Projet_Recettes/pages/browse/liste_tags.php';"><h2>Tags</h2></button>
        <?php endif;
        if($_SESSION['page']=="tags"):?>
        <button class="button_header" onclick="window.location.href = '/Projet_Recettes/pages/browse/liste_recettes.php';"><h2>Recettes</h2></button>
        <button class="button_header" onclick="window.location.href = '/Projet_Recettes/pages/browse/liste_ingredients.php';"><h2>Ingredients</h2></button>
        <button class="button_disable" onclick="window.location.href = '/Projet_Recettes/pages/browse/liste_tags.php';"><h2>Tags</h2></button>
        <?php endif ?>
    </nav>