<?php
session_start();
require_once(__DIR__ . '/includes/db.php');
require_once(__DIR__ . '/includes/functions.php');

// Vérifier si l'User est connecté
if (!is_logged_in()) {
    redirect('login.php');
}

$pageTitle = "Tableau de bord";

// Récupérer les articles de l'User connecté
$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$userPosts = $stmt->fetchAll();

require_once(__DIR__ . '/includes/header.php');
?>

<h1>Tableau de bord</h1>

<p>Bienvenue, <strong><?php echo secure_output($_SESSION['username']); ?></strong> !</p>

<div class="dashboard-actions">
    <a href="create_post.php" class="btn">Créer un nouvel article</a>
</div>

<h2>Mes articles</h2>

<?php if (count($userPosts) > 0): ?>
    <div class="posts-grid">
        <?php foreach ($userPosts as $post): ?>
            <article class="card post-card">
                <h3><?php echo secure_output($post['title']); ?></h3>
                <div class="post-meta">
                    <span class="date">Créé le <?php echo format_date($post['created_at'], 'd/m/Y'); ?></span>
                    <span class="status"><?php echo $post['published'] ? 'Publié' : 'Brouillon'; ?></span>
                </div>
                <div class="post-excerpt">
                    <?php echo create_excerpt($post['content']); ?>
                </div>
                <div class="post-actions">
                    <a href="article.php?id=<?php echo $post['id']; ?>" class="btn btn-small">Voir</a>
                    <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-small btn-secondary">Modifier</a>
                    <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="no-posts">
        <p>Vous n'avez encore écrit aucun article.</p>
        <p><a href="create_post.php" class="btn">Créer votre premier article</a></p>
    </div>
<?php endif; ?>

<!-- Section paramètres du compte -->
<div class="danger-zone" style="margin-top: 3rem;">
    <h3>⚙️ Paramètres du compte</h3>
    <p>Gérez les options avancées de votre compte.</p>
    <a href="unsubscribe.php" class="btn btn-danger">
        🗑️ Supprimer mon compte
    </a>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>