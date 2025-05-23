<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Solicitar Entrega - Express Foz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Solicitar Entrega</h1>
    <form action="index.php" method="POST">
        <input type="text" name="nome" placeholder="Seu nome" required><br>
        <input type="text" name="coleta" placeholder="Endereço de coleta" required><br>
        <input type="text" name="entrega" placeholder="Endereço de entrega" required><br>
        <input type="text" name="telefone" placeholder="Telefone" required><br>
        <button type="submit">Solicitar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $arquivo = 'pedidos.json';
        $pedidos = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];

        $id = 'EXPRESS ' . str_pad(count($pedidos) + 1, 4, '0', STR_PAD_LEFT);

        $novo = [
            "id" => $id,
            "nome" => $_POST["nome"],
            "coleta" => $_POST["coleta"],
            "entrega" => $_POST["entrega"],
            "telefone" => $_POST["telefone"],
            "status" => "Aguardando motoboy"
        ];

        $pedidos[] = $novo;
        file_put_contents($arquivo, json_encode($pedidos, JSON_PRETTY_PRINT));
        echo "<p><strong>Pedido enviado com sucesso! ID: $id</strong></p>";
    }
    ?>
</body>
</html>
