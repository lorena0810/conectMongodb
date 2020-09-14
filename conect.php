<?php

require 'vendor/autoload.php' ;


$db= (new MongoDB\Client('mongodb://132.148.166.79/',
[
    'username' => 'dbadmin',
    'password' => 'Vps2020**@@',
    'authSource' => 'bestwaymarket',
    'ssl' => false,
   
]
))->bestwaymarket;

//INSERTANDO 
$insertOneResult = $db->test->insertOne([
    'username' => 'admin',
    'email' => 'admin@example.com',
    'name' => 'Admin User',
]);

printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

var_dump($insertOneResult->getInsertedId());

//creando una nueva coleccion
/* $db->createCollection('contacts', [
    'collation' => ['locale' => 'es'], //español
]); */ //esto solo se corre una vez, porque se supone que ya esta creada y te manda el error despues 

$insertManyResult = $db->contacts->insertMany([ //insertmany metodo para insertar mas de un documento a la vez 
    [
        'username' => 'admin',
        'email' => 'admin@example.com',
        'name' => 'Admin User',
    ],
    [
        'username' => 'test',
        'email' => 'test@example.com',
        'name' => 'Test User',
    ],
]);

printf("Inserted %d document(s)\n", $insertManyResult->getInsertedCount()); // se trae cuantos se intertados

var_dump($insertManyResult->getInsertedIds()); //y muestra los id q se insertaron


echo("\n");
echo("\n");

//CONSULTAS 

//coleccion -> tabla | documento-> fila (que contiene los datos )
$cursor = $db->contacts->find(['username' => 'admin']);

foreach ($cursor as $document) {
    echo $document['_id'], "\n"; 
    var_dump($document);
}

//NOTA:
//CUIDADO CON REPETIR LA DATA , esto se puede dar cuando ejecutas los insert varias veces 
//INSERTORUPDATE -> verifica que si esta o no, y lo crea 



?>