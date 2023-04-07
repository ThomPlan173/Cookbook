<header>
    <div class="header">
        <div id="header2">
            <img id="index" src=/Projet_Recettes/class/Template/img/index.png onclick="window.location.href = '/Projet_Recettes/index.php';">
            <div id="content_bouton_header">
                <?php if (isset($_SESSION['login'])) :

                ?>
                    <button class="button_header" onclick="window.location.href = '/Projet_Recettes/formular_recette.php';">
                        <h2>Ajouter une Recette</h2>
                    </button>


                    <button class="button_header" onclick="window.location.href = '/Projet_Recettes/pages/add_ingredient.php';">
                        <h2>Ajouter un Ingredient</h2>
                    </button>

                    <button class="button_header" onclick="window.location.href = '/Projet_Recettes/formular_recette.php';">
                        <h2>Ajouter un Tag</h2>
                    </button>
                <?php
                endif; ?>
            </div>
            <div>
            </div>
</header>