<?php
// Script pour détecter la version PHP et les informations système
echo "=== INFORMATIONS PHP ===\n";
echo "Version PHP : " . PHP_VERSION . "\n";
echo "Version majeure : " . PHP_MAJOR_VERSION . "\n";
echo "Version mineure : " . PHP_MINOR_VERSION . "\n";
echo "Version de révision : " . PHP_RELEASE_VERSION . "\n";
echo "SAPI : " . PHP_SAPI . "\n";
echo "OS : " . PHP_OS . "\n";
echo "Architecture : " . (PHP_INT_SIZE * 8) . " bits\n";
echo "\n=== EXTENSIONS CHARGÉES ===\n";

// Extensions importantes pour le blog
$extensions = ['pdo', 'pdo_mysql', 'mysqli', 'session', 'json', 'mbstring'];
foreach ($extensions as $ext) {
    echo $ext . " : " . (extension_loaded($ext) ? "✓ Chargée" : "✗ Non disponible") . "\n";
}

echo "\n=== CONFIGURATION IMPORTANTE ===\n";
echo "Taille max upload : " . ini_get('upload_max_filesize') . "\n";
echo "Taille max POST : " . ini_get('post_max_size') . "\n";
echo "Limite mémoire : " . ini_get('memory_limit') . "\n";
echo "Temps d'exécution max : " . ini_get('max_execution_time') . "s\n";
echo "Affichage erreurs : " . (ini_get('display_errors') ? "Activé" : "Désactivé") . "\n";
