<?php

require_once 'connection/databaseConnection.php';

$sql = 'select * from categorias';

try {
    $bd = $conn->prepare($sql);
    $bd->execute();
} catch (PDOException $e) {
    die($e->getMessage());
}
