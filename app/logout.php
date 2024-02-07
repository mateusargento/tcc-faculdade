<?php
    session_start();

    unset($_SESSION['nome']);
    if(isset($_SESSION['codigo_profissional']))
    {
        unset($_SESSION['codigo_profissional']);
    }
    else if(isset($_SESSION['codigo_cliente_fisico']))
    {
        unset($_SESSION['codigo_cliente_fisico']);
    }
    else if(isset($_SESSION['codigo_cliente_juridico']))
    {
        unset($_SESSION['codigo_cliente_juridico']);
    }
    
    header('Location: ../view/login.php');
    die();
?>