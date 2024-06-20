<?php
require 'conexao.php';
//Comando para validar o Email/Senha no Banco, Se houver pode obter acesso ao site
if(isset($_POST['email']) || isset($_POST['senha'])){
    if(strlen($_POST['email'])== 0){
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha'])== 0){
        echo "Preencha sua Senha";
    } else{
        $email = $conexao->real_escape_string($_POST['email']);
        $senha = $conexao->real_escape_string($_POST['senha']);
        $sql_code= "SELECT * FROM usuarios WHERE email= '$email' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execuçao do codigoSQL:" . $conexao->error);
        $quantidade =$sql_query->num_rows;
        if($quantidade == 1){
            $usuario = $sql_query->fetch_assoc();
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("location: telaposlogin\indexlogado.html");
        } else {
            header ("location: telausuarioesenhainvalidos\indexinvalido.html");;
        }
    }
}
?>