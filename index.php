<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        $sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $_SESSION['email'] = $email;
            header('Location: main.php');
        } else {
            echo "Email ou senha incorretos.";
        }
    } elseif (isset($_POST['register'])) {
        $nomeCompleto = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmarSenha = $_POST['confirmarSenha'];
        
        if ($senha == $confirmarSenha) {
            $sql = "INSERT INTO usuario (nomeCompleto, email, senha) VALUES ('$nomeCompleto', '$email', '$senha')";
            if ($conn->query($sql) === TRUE) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "As senhas não coincidem.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro/Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro/Login</h2>
        <form method="POST">
            <input type="text" name="nomeCompleto" placeholder="Nome Completo" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="password" name="confirmarSenha" placeholder="Confirmar Senha" required>
            <button type="submit" name="register">Cadastrar</button>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>