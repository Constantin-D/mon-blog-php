<?php
session_start();
$pageTitle = 'À propos - Mon Blog';
require_once(__DIR__ . '/includes/header.php');
?>

<div class="container">
    <div class="card">
        <h1>À propos de Mon Blog</h1>

        <section class="about-content">
            <h2>Notre Mission</h2>
            <p>
                Bienvenue sur Mon Blog PHP ! Ce projet a été développé dans le cadre de l'apprentissage
                du développement web avec PHP (Vanilla) et MySQL. L'objectif est de créer une plateforme simple
                et intuitive pour partager des articles et des réflexions.
            </p>

            <h2>Fonctionnalités</h2>
            <ul>
                <li>🔐 Système d'authentification sécurisé</li>
                <li>✍️ Création et gestion d'articles</li>
                <li>👤 Tableau de bord personnalisé</li>
                <li>📱 Design responsive et moderne</li>
                <li>🎨 Interface utilisateur intuitive</li>
            </ul>

            <h2>Technologies Utilisées</h2>
            <p>
                Ce blog est développé avec les technologies suivantes :
            </p>
            <ul>
                <li><strong>Backend :</strong> PHP 8.2.12</li>
                <li><strong>Base de données :</strong> MySQL</li>
                <li><strong>Frontend :</strong> HTML5, CSS3</li>
                <li><strong>Serveur :</strong> Apache (XAMPP)</li>
                <li><strong>Fonts :</strong> Google Fonts (Open Sans)</li>
            </ul>

            <h2>Développement</h2>
            <p>
                Ce projet est en constante évolution. Nous ajoutons régulièrement de nouvelles
                fonctionnalités pour améliorer l'expérience utilisateur et explorer de nouvelles
                possibilités techniques.
            </p>
        </section>

        <div class="article-actions">
            <a href="index.php" class="btn">&larr; Retour à l'accueil</a>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>