<?php

class Template
{

    public static function render(string $content, string $css = null, string $js = null): void
    { ?>


        <!doctype html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>Projet Web3</title>

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="/Projet_Recettes/class/Template/css/main.css">
            <?php if ($css != null) { ?>
                <?= $css; ?>
            <?php } ?>

        </head>

        <body>
            <?php include "Template/Header.php" ?>
            <?php include "Template/sidebar.php" ?>
            <div class="content">

                <?= $content  ?>
                <?php include "Template/Footer.php" ?>
            </div>

            <script src="/Projet_Recettes/class/Template/JS/main.js"></script>
            <?php if ($js != null) { ?>
                <?= $js; ?>
            <?php } ?>

        </body>

        </html>

<?php
    }
}
?>