<?php

/*#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------*/

// page permettent de se deconnecter, elle detruit la session et redirige vers la dernière page visité
session_start() ;
header("Location: ".$_SESSION['page']);
session_destroy();
exit() ;

/*#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------*/