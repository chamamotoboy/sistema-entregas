<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador - Express Foz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Painel do Administrador</h1>
    <?php
    $arquivo = 'pedidos.json';
    if (!file_exists($arquivo)) {
        echo "<p>Nenhum pedido encontrado.</p>";
        exit;
    }

    $pedidos = json_decode(file_get_contents($arquivo), true);

    if (isset($_GET['excluir'])) {
        $pedidos = array_filter($pedidos, fn($p) => $p['id'] !== $_GET['excluir']);
        file_put_contents($arquivo, json_encode(array_values($pedidos), JSON_PRETTY_PRINT));
        header("Location: painel_do_administrador.php");
        exit;
    }

    foreach ($pedidos as $pedido) {
        echo "<div><strong>{$pedido['id']}</strong> - {$pedido['coleta']} → {$pedido['entrega']}<br>Status: {$pedido['status']}<br>";
        echo "Cliente: {$pedido['nome']} - Tel: {$pedido['telefone']}<br>";
        echo "<a href='?excluir={$pedido['id']}'>Excluir</a></div><hr>";
    }
    ?>
</body>
</html>
