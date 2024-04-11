<?php
define("Host", "localhost");
define("User", "root");
define("Pass", "");
define("DbName", "cvvendb");

$dsn = "mysql:dbname=" . DbName . ";host=" . Host;

try {
    $db = new PDO ($dsn, User, Pass);

    $db -> exec("SET NAMES utf8");

    $db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOExeption $e) {
    
}