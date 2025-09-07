<?php
session_start();
require_once(__DIR__ . '/includes/db.php');
require_once(__DIR__ . '/includes/functions.php');

// Variable pour les messages
$message = '';
$messageType = '';

// Si l'utilisateur est déjà connecté, rediriger
if (is_logged_in()) {
    redirect('dashboard.php');
}

// Vérif si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $message = "Tous les champs sont obligatoires.";
        $messageType = "error";
    } elseif (!is_valid_email($email)) {
        $message = "L'adresse email n'est pas valide.";
        $messageType = "error";
    } elseif (strlen($password) < 6) {
        $message = "Le mot de passe doit contenir au moins 6 caractères.";
        $messageType = "error";
    } else {
        // Vérifier si l'email existe déjà
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            $message = "Cet email est déjà utilisé. Veuillez en choisir un autre.";
            $messageType = "error";
        } else {
            // Insérer l'utilisateur
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($sql);

            $result = $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT)
            ]);

            if ($result) {
                set_flash_message("Inscription réussie ! Vous pouvez maintenant vous connecter.", "success");
                redirect('login.php');
            } else {
                $message = "Une erreur est survenue lors de l'inscription.";
                $messageType = "error";
            }
        }
    }
}

$pageTitle = "Inscription";
require_once(__DIR__ . '/includes/header.php');
?>

<h1>Inscription</h1>

<?php if ($message): ?>
    <p class="message <?php echo $messageType; ?>"><?php echo secure_output($message); ?></p>
<?php endif; ?>

<p>Créez un compte pour partager vos articles et commenter.</p>

<form action="register.php" method="post">
    <div class="form-group">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" value="<?php echo secure_output($_POST['username'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?php echo secure_output($_POST['email'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <div class="password-container">
            <input type="password" name="password" id="password" required>
            <div class="password-toggle">
                <input type="checkbox" id="show-password" class="password-checkbox">
                <label for="show-password" class="password-toggle-label">👁️</label>
            </div>
        </div>
        <small>Au moins 6 caractères</small>
    </div>

    <button type="submit" class="btn">S'inscrire</button>
</form>

<p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>