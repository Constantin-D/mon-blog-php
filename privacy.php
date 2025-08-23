<?php
session_start();
$pageTitle = 'Politique de confidentialité - Mon Blog';
require_once(__DIR__ . '/includes/header.php');
?>

<div class="container">
    <div class="card">
        <h1>Politique de confidentialité</h1>

        <section class="privacy-content">
            <p><em>Dernière mise à jour : <?php echo date('d/m/Y'); ?></em></p>

            <h2>1. Collecte des informations</h2>
            <p>
                Notre blog collecte les informations suivantes lorsque vous vous inscrivez :
            </p>
            <ul>
                <li><strong>Nom d'utilisateur :</strong> Pour identifier votre compte</li>
                <li><strong>Email :</strong> Pour la communication et la récupération de compte</li>
                <li><strong>Mot de passe :</strong> Stocké de manière sécurisée (hashé)</li>
            </ul>

            <h2>2. Utilisation des informations</h2>
            <p>Vos informations sont utilisées pour :</p>
            <ul>
                <li>Gérer votre compte utilisateur</li>
                <li>Vous permettre de publier des articles</li>
                <li>Améliorer nos services</li>
                <li>Vous contacter si nécessaire</li>
            </ul>

            <h2>3. Protection des données</h2>
            <p>
                Nous prenons la sécurité de vos données très au sérieux :
            </p>
            <ul>
                <li>Les mots de passe sont hashés avec des algorithmes sécurisés</li>
                <li>L'accès à la base de données est protégé</li>
                <li>Les sessions sont sécurisées</li>
                <li>Les données sensibles ne sont jamais affichées en clair</li>
            </ul>

            <h2>4. Partage des informations</h2>
            <p>
                <strong>Nous ne vendons, n'échangeons ni ne louons vos informations personnelles
                    à des tiers.</strong> Vos données restent confidentielles et ne sont utilisées
                que dans le cadre du fonctionnement de ce blog.
            </p>

            <h2>5. Cookies et sessions</h2>
            <p>
                Notre site utilise des sessions PHP pour maintenir votre connexion.
                Aucun cookie de tracking ou publicitaire n'est utilisé.
            </p>

            <h2>6. Vos droits</h2>
            <p>Vous avez le droit de :</p>
            <ul>
                <li>Accéder à vos données personnelles</li>
                <li>Modifier vos informations de profil</li>
                <li>Supprimer votre compte</li>
                <li>Demander la portabilité de vos données</li>
            </ul>

            <h2>7. Contact</h2>
            <p>
                Pour toute question concernant cette politique de confidentialité,
                vous pouvez nous contacter via la <a href="contact.php">page de contact</a>.
            </p>

            <h2>8. Modifications</h2>
            <p>
                Cette politique peut être mise à jour occasionnellement.
                La date de dernière mise à jour est indiquée en haut de cette page.
            </p>
        </section>

        <div class="article-actions">
            <a href="index.php" class="btn">&larr; Retour à l'accueil</a>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>