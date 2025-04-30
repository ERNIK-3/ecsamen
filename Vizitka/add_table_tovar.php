<?php
include "../config.php";
$sql = "create table tovar (id integer auto_increment primary key, category varchar(30), type varchar(30), size varchar(30), qual varchar(30));";
$pdo->exec($sql);
echo "Table tovar has been created";