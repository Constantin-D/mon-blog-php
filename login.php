<?php
session_start();

$errorMessage = '';

require_once(__DIR__ . '/includes/db.php');
require_once(__DIR__ . '/includes/functions.php');

if (is_logged_in()) {
    redirect('dashboard.php');
    exit;
}

// Vérification si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Préparer la requête de sélection (avec l'email)
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        redirect('dashboard.php');
        exit;
    } else {
        $errorMessage = "Email ou mot de passe incorrect.";
    }
}

$pageTitle = "Connexion";

require_once(__DIR__ . '/includes/header.php');
?>

<h1>Connexion</h1>

<?php if (isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
    <p class="message success">Déconnexion réussie !</p>
<?php endif; ?>

<?php if ($errorMessage): ?>
    <p class="message error"><?php echo secure_output($errorMessage); ?></p>
<?php endif; ?>

<p>Veuillez entrer vos identifiants pour vous connecter.</p>

<form action="login.php" method="post">
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
    </div>

    <button type="submit" class="btn">Se connecter</button>
</form>

<p>Pas encore inscrit ? <a href="register.php">Inscrivez-vous ici</a></p>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>