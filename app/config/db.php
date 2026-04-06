<?php

$host = 'mysql';
$db   = 'blog';
$user = 'root';
$pass = 'root';

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);