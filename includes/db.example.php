<?php

/**
 * Fichier de configuration de base de données - EXEMPLE
 * 
 * Instructions d'installation :
 * 1. Copiez ce fichier et renommez-le en 'db.php'
 * 2. Modifiez les paramètres ci-dessous selon votre configuration
 * 3. Assurez-vous d'avoir créé la base de données 'blog' dans phpMyAdmin
 * 
 * Configuration par défaut pour XAMPP :
 * - Host: localhost
 * - Username: root  
 * - Password: (vide)
 * - Database: blog (à créer manuellement)
 */

$host = 'localhost'; // Adresse du serveur MySQL (généralement localhost)
$dbname = 'blog'; // Nom de votre base de données (créée dans phpMyAdmin)
$username = 'root'; // Nom d'utilisateur MySQL (par défaut 'root' sur XAMPP)
$password = ''; // Mot de passe MySQL (vide par défaut sur XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configuration PDO pour un développement sécurisé
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage() .
        '<br><br>Vérifiez que :<br>' .
        '- XAMPP est démarré (Apache + MySQL)<br>' .
        '- La base de données "' . $dbname . '" existe dans phpMyAdmin<br>' .
        '- Les paramètres de connexion sont corrects');
}
