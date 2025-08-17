<?php
session_start();
require_once(__DIR__ . '/includes/db.php');

$pageTitle = "Accueil - Mon Blog";

$posts = [];
try {
    // Récupérer les derniers articles de blog
    $stmt = $pdo->query("SELECT posts.*, users.username 
                        FROM posts 
                        JOIN users ON posts.user_id = users.id 
                        WHERE published = 1 
                        ORDER BY created_at DESC 
                        LIMIT 5");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
}

require_once(__DIR__ . '/includes/header.php');
?>

<section class="hero">
    <div class="hero-content">
        <h1>Bienvenue sur Mon Blog</h1>
        <p>Découvrez les derniers articles et partagez vos connaissances.</p>
        <?php if (!is_logged_in()): ?>
            <div class="cta-buttons">
                <a href="register.php" class="btn btn-primary">S'inscrire</a>
                <a href="login.php" class="btn btn-secondary">Se connecter</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="recent-posts">
    <h2>Derniers articles</h2>

    <?php if (count($posts) > 0): ?>
        <div class="posts-grid">
            <?php foreach ($posts as $post): ?>
                <article class="card post-card">
                    <h3><?php echo secure_output($post['title']); ?></h3>
                    <div class="post-meta">
                        <span class="author">Par <?php echo secure_output($post['username']); ?></span>
                        <span class="date"><?php echo format_date($post['created_at'], 'd/m/Y'); ?></span>
                    </div>
                    <div class="post-excerpt">
                        <?php echo create_excerpt($post['content']); ?>
                    </div>
                    <a href="post.php?id=<?php echo $post['id']; ?>" class="btn btn-small">Lire la suite</a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-posts">
            <p>Aucun article n'a encore été publié.</p>
            <?php if (is_logged_in()): ?>
                <p><a href="create_post.php" class="btn">Créer mon premier article</a></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<section class="about">
    <h2>À propos de ce blog</h2>
    <p>Mon Blog est une plateforme où les passionnés de développement web peuvent partager leurs connaissances et découvrir de nouveaux concepts. Rejoignez notre communauté pour participer à la discussion !</p>
</section>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>