<?php
// template de toutes les pages par défaut
class Template
{
    public static function render(string $content, string $css = null, string $js = null): void
    { ?>


        <!doctype html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <title>CookBook</title>

            <link rel="icon" href="/Projet_Recettes/class/Template/img/index.png">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="/Projet_Recettes/class/Template/css/main.css">
            <!-- On fait charger le css -->
            <?php if ($css != null) {
                echo $css;
            } ?>
        </head>

        <body>
            <!-- Chargement du Header, du contenu de la page et du footer -->
            <?php include "Template/Header.php" ?>
            <div class="content" id="content">
                <?= $content  ?>

                <?php include "Template/Footer.php"?>
            </div>
            <script src="/Projet_Recettes/class/Template/JS/main.js"></script>
            <!-- On fait charger le JS -->
            <?php if ($js != null) {
                echo $js;
            } ?>
        </body>

        </html>

<?php
    }
}
?>