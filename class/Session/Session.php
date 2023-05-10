<?php

namespace Session;

class Session
{
    function cleanSession(): void {
        $_SESSION['response'] = null;
        $_SESSION['nom'] = null;
        $_SESSION['image'] =  null;
        $_SESSION['description'] = null;
        $_SESSION['preparation'] =  null;
        $_SESSION['id'] = null;
        $_SESSION['nomIngr'] = null;
        $_SESSION['idIngr'] = null;
        $_SESSION['errortext'] = null;
        $_SESSION['responseAdd'] = null;
        $_SESSION['responseEdit'] = null;
        $_SESSION['idTag'] = null;
        $_SESSION['nomTag'] = null;
    }
}