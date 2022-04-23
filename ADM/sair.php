<?php
   #iniciar varial de sessao
    session_start();
    #apagar variavel de sessao
    unset( $_SESSION['user']);

    Header("Location:../pag-01.php");


?>