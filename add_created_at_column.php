<?php
require_once(__DIR__ . '/includes/db.php');

echo "<h2>Ajout de la colonne created_at à la table users</h2>";

try {
    // Ajouter la colonne created_at
    $sql = "ALTER TABLE users ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
    $pdo->exec($sql);

    echo "<p style='color: green;'>✅ Colonne created_at ajoutée avec succès !</p>";

    // Mettre à jour les utilisateurs existants avec la date actuelle
    $sql = "UPDATE users SET created_at = NOW() WHERE created_at IS NULL";
    $pdo->exec($sql);

    echo "<p style='color: green;'>✅ Dates mises à jour pour les utilisateurs existants !</p>";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "<p style='color: orange;'>⚠️ La colonne created_at existe déjà !</p>";
    } else {
        echo "<p style='color: red;'>❌ Erreur : " . $e->getMessage() . "</p>";
    }
}

// Vérifier la structure mise à jour
echo "<h3>Structure mise à jour :</h3>";
$stmt = $pdo->query("DESCRIBE users");
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table border='1'>";
echo "<tr><th>Champ</th><th>Type</th><th>Null</th><th>Clé</th><th>Défaut</th></tr>";
foreach ($columns as $column) {
    echo "<tr>";
    echo "<td>" . $column['Field'] . "</td>";
    echo "<td>" . $column['Type'] . "</td>";
    echo "<td>" . $column['Null'] . "</td>";
    echo "<td>" . $column['Key'] . "</td>";
    echo "<td>" . $column['Default'] . "</td>";
    echo "</tr>";
}
echo "</table>";
