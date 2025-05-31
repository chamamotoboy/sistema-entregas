<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $res = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($res) == 1) {
        $usuario = mysqli_fetch_assoc($res);
        $_SESSION["usuario"] = $usuario;

        if ($usuario["tipo"] == "admin") {
            header("Location: painel_admin.php");
        } else {
            header("Location: painel_motoboy.php");
        }
        exit();
    } else {
        $erro = "Login inválido!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistema de Entregas</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
</body>
</html>
