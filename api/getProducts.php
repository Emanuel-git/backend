<?php

function getProducts($limit = 10)
{
    require_once 'connection/databaseConnection.php';

    $sql = 'select * from produtos limit ' . $limit;

    try {
        $db = $conn->prepare($sql);
        $db->execute();

        while ($row = $db->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = [
                'nome' => $row['nome'],
                'sku' => $row['sku'],
                'preco' => $row['preco'],
                'descricao' => $row['descricao'],
                'quantidade' => $row['quantidade'],
                'categorias' => $row['categorias']
            ];
        }

        return $rows;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
