<?php

namespace Browser;

class Liste
{
    function generateRecettes()
    { ?>
        <div id="liste_recette">
            <?php if (isset($_POST["nom"]) && isset($_POST["preference"])) {
                $cb = new \cb\CoobookDB;
                $data = $cb->search($_POST["nom"], $_POST["preference"]);
                echo "<div class='blabla'> Recettes similaires à " . "\"" . $_POST["nom"] . "\" :" . "</div>";

                if (!empty($data)) {
                    foreach ($data as $d) {

            ?>

                        <div class="recette">
                            <form method='get' action="pages/recette.php">
                                <button class="bouton_image_recette" type="submit" id='photo_tete' name="msg" value='<?= $d->idRecette ?>'>
                                    <img class="image_recette" src="<?= $d->imgRecette ?>">
                                </button>
                            </form>
                            <?php if (isset($_SESSION['login'])) : ?>
                                <form method='get' action="pages/edit.php">
                                    <div>
                                        <button type="submit" id='photo_tete' name="msg" value='<?= $d->idRecette ?>'>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                </form>
                                <form method='get' action="pages/delete.php">
                                    <button type="submit" id='photo_tete' name="del" value='<?= $d->idRecette ?>'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                        </div>
                    <?php endif ?>
                    <div>
                        <h3><?= htmlspecialchars_decode($d->nomRecette) ?> :</h3>
                        <?= htmlspecialchars_decode($d->Description) ?>
                    </div>

        </div>
        </form>

<?php
                    }
                } else {
                    echo "Aucune recette trouvée...";
                }
            }; ?>
</div>

<?php
    }
}
?>