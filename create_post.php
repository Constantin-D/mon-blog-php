<?php
session_start();
require_once(__DIR__ . '/includes/db.php');
require_once(__DIR__ . '/includes/functions.php');
require_once(__DIR__ . '/includes/markdown.php');

if (!is_logged_in()) {
    redirect('login.php');
}

$message = '';
$messageType = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $useMarkdown = isset($_POST['use_markdown']) ? true : false;

    // Validation basique
    if (empty($title) || empty($content)) {
        $message = "Le titre et le contenu sont obligatoires.";
        $messageType = "error";
    } else {
        // Convertir le Markdown en HTML (Si l'option est activée)
        $finalContent = $useMarkdown ? convertMarkdownToHtml($content) : $content;
        // Vérifier si l'article existe déjà pour cet User
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
                    ':content' => $finalContent  // Utiliser le contenu converti
                ]);

                if ($result) {
                    $message = "Article publié avec succès !";
                    $messageType = "success";
                }
            } catch (PDOException $e) {
                // Gestion des erreurs de la BDD
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
        <label for="use_markdown">
            <input type="checkbox" name="use_markdown" id="use_markdown">
            Utiliser Markdown pour le formatage
        </label>
    </div>

    <!-- Aide Markdown -->
    <div class="markdown-toggle-container">
        <input type="checkbox" id="markdown-help-toggle" class="markdown-help-checkbox">
        <label for="markdown-help-toggle" class="markdown-help-label">
            📖 Afficher/Masquer l'aide Markdown
        </label>

        <div class="markdown-help">
            <h3>🎯 Guide Markdown complet :</h3>
            <div class="markdown-examples">
                <div class="markdown-example">
                    <code># Titre principal</code> → <strong>Titre principal</strong>
                </div>
                <div class="markdown-example">
                    <code>## Sous-titre</code> → <strong style="font-size: 0.9em;">Sous-titre</strong>
                </div>
                <div class="markdown-example">
                    <code>**gras**</code> → <strong>gras</strong>
                </div>
                <div class="markdown-example">
                    <code>*italique*</code> → <em>italique</em>
                </div>
                <div class="markdown-example">
                    <code>`code`</code> → <code style="background: #e9ecef; padding: 2px 4px;">code</code>
                </div>
                <div class="markdown-example">
                    <code>- Liste à puces</code> → • Liste à puces
                </div>
                <div class="markdown-example">
                    <code>1. Liste numérotée</code> → 1. Liste numérotée
                </div>
                <div class="markdown-example">
                    <code>[Lien](https://example.com)</code> → <a href="#" style="color: var(--primary-color);">Lien</a>
                </div>
                <div class="markdown-example">
                    <code>![Image](url)</code> → 🖼️ Image
                </div>
                <div class="markdown-example">
                    <code>> Citation</code> → <em style="border-left: 3px solid var(--primary-color); padding-left: 8px;">Citation</em>
                </div>
                <div class="markdown-example">
                    <code>---</code> →
                    <hr style="width: 50px; margin: 5px 0;">
                </div>
            </div>

            <div class="markdown-template">
                <h4>📝 Exemple complet avec nouvelles fonctionnalités :</h4>
                <pre><code># Mon titre principal

Voici un paragraphe avec du **texte en gras**, de l'*italique* et du `code inline`.

## Fonctionnalités avancées

### Code
```php
function hello() {
    echo "Hello World!";
}
```

### Listes
- Liste à puces
- Deuxième élément

1. Liste numérotée
2. Deuxième item

### Citation
> Ceci est une citation importante

### Image et lien
![Mon image](url-image.jpg)
[Mon lien](https://example.com)

---
Ligne horizontale ci-dessus.</code></pre>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea name="content" id="content" rows="15" required placeholder="Tapez votre contenu ici..."></textarea>
    </div>

    <button type="submit" class="btn">Publier</button>
</form>

<p><a href="dashboard.php">&larr; Retour au tableau de bord</a></p>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>