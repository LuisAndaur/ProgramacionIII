<?php
    // ------ SE ABRE UNA SESION ------------
    session_start();
    $_SESSION["CLAVE"] = "VALOR";

    echo $_SESSION["CLAVE"];


    // ------ SE ABRE UNA SESION ------------
    session_unset();

    // ------ SE ABRE UNA SESION ------------
    session_destroy();



?>