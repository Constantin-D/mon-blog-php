<?php
session_start();
require_once(__DIR__ . '/includes/db.php');

// Vérifier si un ID d'article est fourni
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect('index.php');
}

$post_id = $_GET['id'];

// Récupérer l'article avec les informations de l'auteur
$stmt = $pdo->prepare("
    SELECT posts.*, users.username 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE posts.id = :id AND posts.published = 1
");
$stmt->execute([':id' => $post_id]);
$post = $stmt->fetch();

// Si l'article n'existe pas, rediriger
if (!$post) {
    redirect('index.php');
}

// Définir le titre de la page
$pageTitle = $post['title'] . " - Mon Blog";

// Inclure l'en-tête
require_once(__DIR__ . '/includes/header.php');
?>

<div class="article-container">
    <article class="full-article">
        <header class="article-header">
            <h1><?php echo secure_output($post['title']); ?></h1>
            <div class="article-meta">
                <span class="author">Par <?php echo secure_output($post['username']); ?></span>
                <span class="date">Publié le <?php echo format_date($post['created_at']); ?></span>
                <?php if ($post['updated_at'] != $post['created_at']): ?>
                    <span class="updated">Modifié le <?php echo format_date($post['updated_at'], 'd/m/Y'); ?></span>
                <?php endif; ?>
            </div>
        </header>

        <div class="article-content">
            <?php echo nl2br(secure_output($post['content'])); ?>
        </div>
    </article>

    <div class="article-actions">
        <a href="index.php" class="btn">&larr; Retour aux articles</a>

        <?php if (is_author($post['user_id'])): ?>
            <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary">Modifier cet article</a>
        <?php endif; ?>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>