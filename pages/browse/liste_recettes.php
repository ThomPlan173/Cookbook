<?php
session_start();
$_SESSION['page']="recettes";

require "..." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

?>

<?php ob_start() ?>
    <form action="./liste_recettes.php" method="post">
        <div class="search">
            <div>

                <h1>Recherche :</h1>
            </div>
            <input class="recherche" type="text" placeholder="Rechercher une recette" name="nom">
            <input type="submit" value="Rechercher">
        </div>
    </form>


    <fieldset>
        <legend>Type de recherche:</legend>

        <div>
            <input type="radio" id="type" name="type" value="nom" checked>
            <label for="nom">Par nom</label>
        </div>

        <div>
            <input type="radio" id="type"" name=" type" value="ingrédient">
            <label for="ingredient">Par ingrédient</label>
        </div>

        <div>
            <input type="radio" id="type" name="type" value="tag">
            <label for="louie">Par tag</label>
        </div>
    </fieldset>

    <fieldset>
        <legend>Préférences de recherche:</legend>

        <div>
            <input type="radio" id="huey" name="drone" value="huey" checked>
            <label for="huey">Alphabétique ( A-Z )</label>
        </div>

        <div>
            <input type="radio" id="dewey" name="drone" value="dewey">
            <label for="dewey">Alphabétique inversée ( Z-A )</label>
        </div>


    </fieldset>

<?php if (isset($_POST["nom"])) {
    $cb = new \cb\CoobookDB();
    $data = $cb->search($_POST["nom"]);
    if (!empty($data)) {
        foreach ($data as $d) {

            ?>
            <form method='get' action="pages/recette.php" >
                <div>
                    <button type="submit" id='photo_tete' name="msg" value='<?=$d->idRecette?>'>
                        <img src="<?=$d->imgRecette?>">
                    </button>
                    <?php if(isset($_SESSION['login'])): ?>
                        <button type="submit" id='photo_tete' name="msg" value='<?=$d->idRecette?>'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </button>
                        <button type="submit" id='photo_tete' name="msg" value='<?=$d->idRecette?>'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                        </button>
                    <?php endif ?>
                    <?=$d->nomRecette?> <br/>
                    <?=$d->Description?>
                </div>
            </form>

            <?php
        }
    } else {
        echo "Aucune recette trouvée...";
    }
}; ?>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

    <link rel="stylesheet" href="/Projet_Recettes/CSS/index.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

    <script src="/Projet_Recettes/JS/index.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>