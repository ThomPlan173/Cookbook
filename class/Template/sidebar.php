    <nav id="sidebar">
        <?php if (isset($_SESSION['page'])) {
            
            if ($_SESSION['page'] == "recettes") : ?>
                <button class="button_disable" onclick="window.location.href = '../../index.php';">
                    <h2>Recettes</h2>
                </button>
                <button class="button_header" onclick="window.location.href = '../../pages/liste_ingredients.php';">
                    <h2>Ingredients</h2>
                </button>
                <button class="button_header" onclick="window.location.href = '../../pages/liste_tags.php';">
                    <h2>Tags</h2>
                </button>
            <?php endif;
            if ($_SESSION['page'] == "ingredients") : ?>
                <button class="button_header" onclick="window.location.href = '../../index.php';">
                    <h2>Recettes</h2>
                </button>
                <button class="button_disable" onclick="window.location.href = '../../pages/liste_ingredients.php';">
                    <h2>Ingredients</h2>
                </button>
                <button class="button_header" onclick="window.location.href = '../../pages/liste_tags.php';">
                    <h2>Tags</h2>
                </button>
            <?php endif;
            if ($_SESSION['page'] == "tags") : ?>
                <button class="button_header" onclick="window.location.href = '../../index.php';">
                    <h2>Recettes</h2>
                </button>
                <button class="button_header" onclick="window.location.href = '../../pages/liste_ingredients.php';">
                    <h2>Ingredients</h2>
                </button>
                <button class="button_disable" onclick="window.location.href = '../../pages/liste_tags.php';">
                    <h2>Tags</h2>
                </button>
        <?php endif;
        }
        ?>
    </nav>