<?php
session_start();
require_once(__DIR__ . '/includes/db.php');
require_once(__DIR__ . '/includes/functions.php');

if (!is_logged_in()) {
    redirect('login.php');
}

$message = '';
$messageType = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Validation basique
    if (empty($title) || empty($content)) {
        $message = "Le titre et le contenu sont obligatoires.";
        $messageType = "error";
    } else {
        // Vérifier si l'article existe déjà pour cet utilisateur
        $checkSql = "SELECT COUNT(*) FROM posts WHERE user_id = :user_id AND title = :title";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([
            ':user_id' => $_SESSION['user_id'],
            ':title' => $title
        ]);

        if ($checkStmt->fetchColumn() > 0) {
            $message = "Vous avez déjà publié un article avec ce titre. Veuillez choisir un titre différent.";
            $messageType = "error";
        } else {
            $sql = "INSERT INTO posts (user_id, title, content) VALUES (:user_id, :title, :content)";
            $stmt = $pdo->prepare($sql);

            try {
                $result = $stmt->execute([
                    ':user_id' => $_SESSION['user_id'],
                    ':title' => $title,
                    ':content' => $content
                ]);

                if ($result) {
                    $message = "Article publié avec succès !";
                    $messageType = "success";
                }
            } catch (PDOException $e) {
                // Gestion des erreurs de la base de données
                $message = "Une erreur est survenue lors de la publication.";
                $messageType = "error";
            }
        }
    }
}

$pageTitle = "Créer un article";

require_once(__DIR__ . '/includes/header.php');
?>

<h1>Créer un nouvel article</h1>

<?php if ($message): ?>
    <p class="message <?php echo $messageType; ?>"><?php echo secure_output($message); ?></p>
<?php endif; ?>

<form action="create_post.php" method="post">
    <div class="form-group">
        <label for="title">Titre de l'article</label>
        <input type="text" name="title" id="title" required>
    </div>

    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea name="content" id="content" rows="10" required></textarea>
    </div>

    <button type="submit" class="btn">Publier</button>
</form>

<p><a href="dashboard.php">&larr; Retour au tableau de bord</a></p>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>