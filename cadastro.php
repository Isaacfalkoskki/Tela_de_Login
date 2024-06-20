<?php
session_start();
require "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $conexao->real_escape_string($_POST['email']);
    $senha = $conexao->real_escape_string($_POST['senha']);
    $nome = $conexao->real_escape_string($_POST['nome']);
    
    // Verificar se o e-mail já está cadastrado
    $sqlUsuario = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
    $sqlUsuario->bind_param("s", $email);
    $sqlUsuario->execute();
    $result = $sqlUsuario->get_result();
    
    if ($result->num_rows > 0) {
       header("Location: teladeerrocadastro/indexerro.html");
       exit;
    } else {
        // Verificar se a senha atende aos critérios de segurança
        if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z0-9]).{8,}$/', $senha)) {
            echo "A senha deve conter pelo menos um número, uma letra maiúscula, uma letra minúscula e um símbolo.";
            exit;
        }

        // Inserir novo usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome,email,senha,sit) VALUES ('$nome', '$email', '$senha', 1)"; 
        if($conexao->query($sql)){
            header("Location: telausuariocadastrado/indexcadastrado.html");
            exit;
        } else {
            echo "Erro ao registrar: " . $conexao->error;
        }
    }
}
?>
