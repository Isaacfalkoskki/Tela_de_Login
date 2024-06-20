<?php

require "index.html";
 if(isset($_SESSION)){
    session_start();
 }
if(!isset($_SESSION['id'])){
    die('Voce nao pode acessar esta pagina porque nao esta logado. <p><a href=\"teste.html\">entrar</a></p>');
}

?>