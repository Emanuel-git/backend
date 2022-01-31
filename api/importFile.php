<?php

if ($_FILES['import_file']['name'] != '') {
    $file_name = $_FILES['import_file']['name'];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $tmp_file = $_FILES['import_file']['tmp_name'];
    $destination = '../assets/import_file/';

    if (strstr('csv', $file_extension)) {
        $new_name = uniqid(time()) . '.' . $file_extension;
        $destination = $destination . $new_name;

        if (move_uploaded_file($tmp_file, $destination)) {
            require_once 'importFileToDB.php';
            prepareFile($new_name);
        } else die('Erro ao adicionar arquivo!');
    } else {
        die("Somente arquivos com a extensão 'csv' são permitidos!");
    }
} else {
    die('Um arquivo deve ser adicionado!');
}

echo '<script type="text/javascript">location.href="../assets/importProducts.html"</script>';
