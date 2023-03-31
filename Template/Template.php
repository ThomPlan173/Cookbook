<?php
require_once "./init_autoload.php";
class Template
{

    public static function render(string $content, string $css, string $js) :void{?>


        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Projet Web3</title>

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="Template/css/main.css" >
            <?= $css ?>

        </head>
        <body>
        <?php include "Template/Header.php" ?>

        <div class="content">

            <?= $content  ?>
            <?php include "Template/Footer.php" ?>
        </div>

        <script src="Template/JS/main.js"></script>
        <?= $js ?>

        </body>
        </html>

        <?php
    }
}
?>