<?php
// Connexion à la base de données - FICHIER D'EXEMPLE
// Copiez ce fichier vers db.php et modifiez les paramètres selon votre configuration

$host = 'localhost';
$dbname = 'blog'; // Remplacez par le nom de votre base de données
$username = 'root'; // Remplacez par votre nom d'utilisateur MySQL
$password = ''; // Remplacez par votre mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Mode erreur pour avoir des messages en cas de souci
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
