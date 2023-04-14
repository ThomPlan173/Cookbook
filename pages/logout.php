<?php

session_start() ;
session_destroy() ;
header("Location: "."/Projet_Recettes/index.php");
exit() ;