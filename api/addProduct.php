<?php

require_once 'connection/databaseConnection.php';

$sku = $_POST['product_sku'] ? $_POST['product_sku'] : '';
$name = $_POST['product_name'] ? $_POST['product_name'] : '';
$price = $_POST['product_price'] ? $_POST['product_price'] : '';
$quantity = $_POST['product_quantity'] ? $_POST['product_quantity'] : '';
$categories = $_POST['product_categories'] ? $_POST['product_categories'] : [];
$description = $_POST['product_description'] ? $_POST['product_description'] : '';

if ($sku == '') die('Sku deve ser especificado!');
if ($name == '') die('Nome deve ser especificado!');
if ($price == '') die('Preço deve ser especificado!');
if ($quantity == '') die('A quantidade deve ser especificada!');
if (count($categories) == 0) die('Pelo menos uma categoria deve ser especificada!');

$price = (float) str_replace(',', '.', $price);
$quantity = (int) $quantity;
$categories = join('|', $categories);

$image_name = '';

if ($_FILES['product_image']['name'] != '') {
    $file_name = $_FILES['product_image']['name'];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $tmp_file = $_FILES['product_image']['tmp_name'];
    $destination = '../assets/images/product_images/';

    if (strstr('.jpg;.jpeg;.png', $file_extension)) {
        $new_name = uniqid(time()) . '.' . $file_extension;
        $destination = $destination . $new_name;

        if (!move_uploaded_file($tmp_file, $destination)) die('Erro ao inserir arquivo!');

        $image_name = $new_name;
    } else {
        die("Somente arquivo as extensões 'jpg', 'jpeg' e 'png' são permitidos");
    }
}

$sql = "insert into produtos (nome, sku, preco, descricao, quantidade, codigo_categoria, image_name) values (?, ?, ?, ?, ?, ?, ?)";

try {
    $bd = $conn->prepare($sql);

    $bd->bindParam(1, $name);
    $bd->bindParam(2, $sku);
    $bd->bindParam(3, $price);
    $bd->bindParam(4, $description);
    $bd->bindParam(5, $quantity);
    $bd->bindParam(6, $categories);
    $bd->bindParam(7, $image_name);

    $bd->execute();
} catch (PDOException $e) {
    die($e->getMessage());
}

echo '<script type="text/javascript">location.href="../assets/products.html"</script>';
