<?php

use \MongoDB\Driver\Manager;
use \MongoDB\Driver\BulkWrite;
use \MongoDB\Driver\Query;

$host = 'mongodb.guebs.net:27017';
$usr = 'USUARIO';
$db = 'NOMBRE DE BASE DE DATOS';
$pass = 'CONTRASEA';
$collection = 'NONBRE DE LA COLECCION';

// Iniciar conexion
$con = new Manager(sprintf('mongodb://%s:%s@%s/%s', $usr, $pass, $host, $db));

// Definir namespace
$namespace = "$db.$collection";

// Obtener todos los registros
if (($res = $con->executeQuery($namespace, new Query([], [])))) {
    var_dump($res->toArray());
}

// Insertar un nuevo registro
$bw = new BulkWrite();
$bw->insert(['entry'=>time()]);
$con->executeBulkWrite($namespace, $bw);

?>