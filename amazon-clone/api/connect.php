<?php
$host = "localhost";
$db = "amazon_db";
$user = "postgres";
$password = "admin";

try {
    $pdo = new PDO("pgsql:host=$host; dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("System down and out: " . $e->getMessage());
}
