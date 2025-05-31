<?php
$host = "sql309.infinityfree.com";
$usuario = "if0_39055368";
$senha = "35266700izabel";
$banco = "if0_39055368_entregas";

$conexao = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conexao) {
    die("Erro ao conectar com o banco de dados: " . mysqli_connect_error());
}
?>
