<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=atcserv;port=6543;dbname=test_snow',
    'username' => 'client',
    'password' => 'client',
    'charset' => 'utf8',
    'enableQueryCache' => false,


    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
