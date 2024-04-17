<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="page">
        <form action="login.php" method="POST" class="formLogin">
            <h1>Login</h1>
            <br>
            
            <label for="username">Usuário</label>
            <input type="text" placeholder="Digite seu usuário" autofocus="true" id="username" name="username" required />
            
            <label for="password">Senha</label>
            <input type="password" placeholder="Digite sua senha" id="password" name="password" required />
            
            <input type="submit" value="Acessar" class="btn" style="width: 116%;"/>
            <div id="msgError" class="alert alert-danger" style="display: none;" role="alert">Usuário ou senha incorretos.</div>
        </form>
    </div>
    
    <script src="libs/jquery/dist/jquery.min.js"></script>
    <script src="libs/jquery/dist/jquery.min.js"></script>
</body>
</html>

<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "inmaster";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM inmaster.usuarios WHERE usuario='$username' AND senha='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: ../masterin100novo/home.php");
    } else {
        header("Location: ../masterin100novo/login.php");
    }
}

$conn->close();
?>