<?php
session_start();
$pageTitle = 'Contact - Mon Blog';
require_once(__DIR__ . '/includes/header.php');

// Traitement du formulaire de contact
if ($_POST) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $errors = [];

    if (empty($name)) {
        $errors[] = "Le nom est requis.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Un email valide est requis.";
    }

    if (empty($subject)) {
        $errors[] = "Le sujet est requis.";
    }

    if (empty($message)) {
        $errors[] = "Le message est requis.";
    }

    if (empty($errors)) {
        // À faire : envoyer l'email ou sauvegarder en base
        // Pour l'instant, simule l'envoi
        set_flash_message('Merci pour votre message ! Nous vous répondrons rapidement.', 'success');
        redirect('contact.php');
        exit;
    }
}
?>

<div class="container">
    <div class="card">
        <h1>Contactez-nous</h1>

        <div class="contact-info">
            <h2>Nous contacter</h2>
            <p>
                N'hésitez pas à nous faire part de vos commentaires, suggestions ou questions.
                Nous serons ravis de vous répondre !
            </p>

            <div class="contact-methods">
                <h3>Informations de contact</h3>
                <ul>
                    <li><strong>Email :</strong> contact@monblog.local</li>
                    <li><strong>Réponse :</strong> Sous 24-48h</li>
                    <li><strong>Sujet :</strong> Questions techniques, suggestions, partenariats</li>
                </ul>
            </div>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="message error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo secure_output($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="contact.php">
            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" value="<?php echo secure_output($name ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo secure_output($email ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" id="subject" name="subject" value="<?php echo secure_output($subject ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="6" required><?php echo secure_output($message ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn">Envoyer le message</button>
        </form>

        <div class="article-actions">
            <a href="index.php" class="btn">&larr; Retour à l'accueil</a>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>