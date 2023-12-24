<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['id'])){
        die
        (
            'Voce nao deve estar logado para acessar essa pagina.
            <a href="index.html">Entrar</a>'
        );
    }
?>