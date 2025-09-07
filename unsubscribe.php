<?php
session_start();
require_once(__DIR__ . '/includes/db.php');
require_once(__DIR__ . '/includes/functions.php');

// Vérifier que l'User est connecté
if (!is_logged_in()) {
    redirect('login.php');
}

$message = '';
$messageType = '';

// Désinscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirmationText = trim($_POST['confirmation'] ?? '');
    $expectedText = 'SUPPRIMER MON COMPTE';

    if ($confirmationText === $expectedText) {
        try {
            // Commencer une transaction
            $pdo->beginTransaction();

            // Supprimer tous les articles de l'User
            $deletePostsSql = "DELETE FROM posts WHERE user_id = :user_id";
            $deletePostsStmt = $pdo->prepare($deletePostsSql);
            $deletePostsStmt->execute([':user_id' => $_SESSION['user_id']]);

            // + Supprimer l'User
            $deleteUserSql = "DELETE FROM users WHERE id = :user_id";
            $deleteUserStmt = $pdo->prepare($deleteUserSql);
            $deleteUserStmt->execute([':user_id' => $_SESSION['user_id']]);

            // Confirmer la transaction
            $pdo->commit();

            // Détruire la session
            session_destroy();

            // Rediriger vers le DhBd + message
            redirect('index.php?account_deleted=1');
        } catch (PDOException $e) {
            // Annuler la transaction en cas d'erreur
            $pdo->rollBack();
            $message = "Une erreur est survenue lors de la suppression du compte.";
            $messageType = "error";
        }
    } else {
        $message = "Le texte de confirmation ne correspond pas. Veuillez taper exactement : SUPPRIMER MON COMPTE";
        $messageType = "error";
    }
}

// Récupérer les infos de l'User
$sql = "SELECT username, email, created_at,
        (SELECT COUNT(*) FROM posts WHERE user_id = :user_id) as post_count 
        FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$pageTitle = "Désinscription";
require_once(__DIR__ . '/includes/header.php');
?>

<div class="article-container">
    <h1>🗑️ Désinscription</h1>

    <?php if ($message): ?>
        <p class="message <?php echo $messageType; ?>"><?php echo secure_output($message); ?></p>
    <?php endif; ?>

    <div class="card">
        <h2>Informations du compte</h2>
        <p><strong>Nom d'utilisateur :</strong> <?php echo secure_output($user['username']); ?></p>
        <p><strong>Email :</strong> <?php echo secure_output($user['email']); ?></p>
        <p><strong>Membre depuis :</strong> <?php echo $user['created_at'] ? date('d/m/Y', strtotime($user['created_at'])) : 'Date inconnue'; ?></p>
        <p><strong>Articles publiés :</strong> <?php echo $user['post_count']; ?></p>
    </div>

    <div class="danger-zone">
        <h3>⚠️ Zone de danger</h3>
        <p><strong>Attention :</strong> Cette action est <em>irréversible</em>. La suppression de votre compte entraînera :</p>

        <ul>
            <li>🗑️ Suppression définitive du profil</li>
            <li>📝 Suppression de tous ses articles (<?php echo $user['post_count']; ?> articles)</li>
            <li>💬 Perte de toutes ses données</li>
            <li>🔐 Impossibilité de récupérer ce compte</li>
        </ul>

        <form action="unsubscribe.php" method="post" onsubmit="return confirm('Êtes-vous absolument certain de vouloir supprimer votre compte ? Cette action est irréversible.');">
            <div class="form-group">
                <label for="confirmation">
                    Pour confirmer la suppression, taper exactement le texte suivant :
                </label>
                <div class="confirmation-text">SUPPRIMER MON COMPTE</div>
                <input type="text" name="confirmation" id="confirmation" required
                    placeholder="Tapez ici le texte de confirmation..."
                    autocomplete="off">
            </div>

            <button type="submit" class="btn btn-danger">
                🗑️ Supprimer définitivement mon compte
            </button>
        </form>
    </div>

    <div style="margin-top: 2rem; text-align: center;">
        <a href="dashboard.php" class="btn">← Retour DhBd</a>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>