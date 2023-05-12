<?php

session_start() ;
header("Location: ".$_SESSION['page']);
session_destroy();
exit() ;