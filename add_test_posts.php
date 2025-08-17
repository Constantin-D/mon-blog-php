<?php
require_once(__DIR__ . '/includes/db.php');

// Articles de test
$articles = [
    [
        'user_id' => 4,
        'title' => 'Introduction au PHP',
        'content' => 'Le PHP est un langage de programmation côté serveur qui permet de créer des sites web dynamiques.'
    ],
    [
        'user_id' => 4,
        'title' => 'Travailler avec MySQL',
        'content' => 'MySQL est un système de gestion de base de données relationnelle très utilisé avec PHP.'
    ],
    [
        'user_id' => 5,
        'title' => 'CSS moderne avec les variables',
        'content' => 'Les variables CSS permettent de stocker des valeurs spécifiques pour les réutiliser.'
    ]
];

// Insérer les articles
$count = 0;
foreach ($articles as $article) {
    $sql = "INSERT INTO posts (user_id, title, content) VALUES (:user_id, :title, :content)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':user_id' => $article['user_id'],
        ':title' => $article['title'],
        ':content' => $article['content']
    ])) {
        $count++;
    }
}

echo "Articles ajoutés : $count";
