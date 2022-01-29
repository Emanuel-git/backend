<?php

require_once 'connection/databaseConnection.php';

$category_name = '';
$category_code = '';

if (isset($_POST['category_name']) && $_POST['category_name'] != '') {
    $category_name = $_POST['category_name'];
} else die('Nome deve ser especificado!');

if (isset($_POST['category_code']) && $_POST['category_code'] != '') {
    $category_code = $_POST['category_code'];
} else die('Código deve ser especificado!');

$sql = 'insert into categorias (codigo, nome) values ("' . $category_code . '", "' . $category_name . '");';

try {
    $bd = $conn->prepare($sql);
    $bd->execute();
} catch (PDOException $e) {
    die($e->getMessage());
}

echo '<script type="text/javascript">location.href="../assets/categories.php"</script>';
