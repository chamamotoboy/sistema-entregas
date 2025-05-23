<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Motoboy - Express Foz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Painel do Motoboy</h1>
    <?php
    $arquivo = 'pedidos.json';
    if (!file_exists($arquivo)) {
        echo "<p>Nenhum pedido encontrado.</p>";
        exit;
    }

    $pedidos = json_decode(file_get_contents($arquivo), true);

    if (isset($_GET['id']) && isset($_GET['status'])) {
        foreach ($pedidos as &$pedido) {
            if ($pedido["id"] === $_GET["id"]) {
                $pedido["status"] = $_GET["status"];
                break;
            }
        }
        file_put_contents($arquivo, json_encode($pedidos, JSON_PRETTY_PRINT));
        header("Location: painel_do_motoboy.php");
        exit;
    }

    foreach ($pedidos as $pedido) {
        echo "<div><strong>{$pedido['id']}</strong> - {$pedido['coleta']} → {$pedido['entrega']}<br>Status: {$pedido['status']}<br>";
        if ($pedido['status'] === 'Aguardando motoboy') {
            echo "<a href='?id={$pedido['id']}&status=A caminho da coleta'>Aceitar</a>";
        } elseif ($pedido['status'] === 'A caminho da coleta') {
            echo "<a href='?id={$pedido['id']}&status=Entregue'>Marcar como Entregue</a>";
        }
        echo "</div><hr>";
    }
    ?>
</body>
</html>
