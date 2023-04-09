<?php

session_start() ;
session_destroy() ;
header("Location: "."/Projet_Recettes/liste_recettes.php");
exit() ;