<?php
include "../config.php";
$sql = "create table users (id integer auto_increment primary key, name varchar(30), email VARCHAR(255));";
$pdo->exec($sql);
echo "Table Users has been created";