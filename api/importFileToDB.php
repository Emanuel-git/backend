<?php

function addProduct($product)
{
    require 'connection/databaseConnection.php';
    $sql = "insert into produtos (nome, sku, preco, descricao, quantidade, categorias) values (?, ?, ?, ?, ?, ?)";

    try {
        $db = $conn->prepare($sql);

        $preco = (float) $product['preco'];
        $quantidade = (int) $product['quantidade'];

        $db->bindParam(1, $product['nome']);
        $db->bindParam(2, $product['sku']);
        $db->bindParam(3, $preco);
        $db->bindParam(4, $product['descricao']);
        $db->bindParam(5, $quantidade);
        $db->bindParam(6, $product['categoria']);

        $execute = $db->execute();
        // if (!$teste) echo 'erro ao inserir!<br>';
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    return true;
};

function prepareFile($file_name)
{
    $handle = fopen('../assets/import_file/' . $file_name, 'r');

    $row = 0;
    while ($line = fgetcsv($handle, 1000, ';')) {
        if ($row++ == 0) continue;

        $products[] = [
            'nome' => $line[0],
            'sku' => $line[1],
            'descricao' => $line[2],
            'quantidade' => $line[3],
            'preco' => $line[4],
            'categoria' => $line[5]
        ];
    }

    fclose($handle);

    require_once __FILE__;
    try {
        array_map('addProduct', $products);
    } catch (Exception $e) {
        die($e->getMessage());
    }

    return;
}
