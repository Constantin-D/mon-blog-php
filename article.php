<?php
session_start();
require_once(__DIR__ . '/includes/db.php');

// Vérifier si un ID d'article est fourni
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect('index.php');
    exit;
}

$article_id = $_GET['id'];

// Récupérer l'article avec les informations de l'auteur
$stmt = $pdo->prepare("
    SELECT posts.*, users.username 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE posts.id = :id AND posts.published = 1
");
$stmt->execute([':id' => $article_id]);
$article = $stmt->fetch();

// Si l'article n'existe pas, rediriger
if (!$article) {
    redirect('index.php');
    exit;
}

$pageTitle = $article['title'];

require_once(__DIR__ . '/includes/header.php');
?>

<div class="article-container">
    <article class="full-article">
        <header class="article-header">
            <h1><?php echo secure_output($article['title']); ?></h1>
            <div class="article-meta">
                <span class="author">Par <?php echo secure_output($article['username']); ?></span>
                <span class="date">Publié le <?php echo format_date($article['created_at']); ?></span>
            </div>
        </header>

        <div class="article-content">
            <?php echo nl2br(secure_output($article['content'])); ?>
        </div>
    </article>

    <div class="article-actions">
        <a href="index.php" class="btn">&larr; Retour à l'accueil</a>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>