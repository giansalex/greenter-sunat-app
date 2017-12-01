<?php

$pathDb = __DIR__.'/../store/greenter.sqlite';
$pathQuery = __DIR__.'/../store/sqlite_schema.sql';

if (file_exists($pathDb)) {
    echo 'La db ya existe';
    exit();
}
if (!file_exists($pathQuery)) {
    echo 'No existe el archivo de querys';
    exit();
}

$querys = file_get_contents($pathQuery);

$con = new PDO('sqlite:'. $pathDb);
$con->exec($querys);

if ($con->errorCode() !== '00000') {
    var_dump($con->errorInfo());
} else {
    echo 'Database Created!';
}