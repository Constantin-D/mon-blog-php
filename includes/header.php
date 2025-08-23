<?php

require_once(__DIR__ . '/functions.php');

// Détecter le chemin racine pour lier correctement les fichiers CSS/JS/images
$rootPath = dirname($_SERVER['SCRIPT_NAME']);
$rootPath = rtrim($rootPath, '/'); // enlever le / final si il existe
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Mon Blog'; ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Feuilles de style dans l'ordre logique -->
    <link rel="stylesheet" href="<?php echo $rootPath; ?>/css/reset.css">
    <link rel="stylesheet" href="<?php echo $rootPath; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo $rootPath; ?>/css/responsive.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>Mon Blog</h1>
            <nav>
                <!-- Checkbox cachée pour contrôler le Menu -->
                <input type="checkbox" id="nav-toggle" class="nav-toggle">

                <!-- Label qui agit comme btn Burger avec pseudo-éléments -->
                <label for="nav-toggle" class="nav-toggle-label">
                    <span></span>
                </label>

                <!-- Overlay invisible pour fermer Menu -->
                <label for="nav-toggle" class="nav-overlay"></label>

                <ul class="nav-menu">
                    <li><a href="<?php echo $rootPath; ?>/index.php" class="<?php echo ($pageTitle == 'Accueil - Mon Blog') ? 'active' : ''; ?>">Accueil</a></li>
                    <li><a href="<?php echo $rootPath; ?>/about.php" class="<?php echo ($pageTitle == 'À propos - Mon Blog') ? 'active' : ''; ?>">À propos</a></li>
                    <li><a href="<?php echo $rootPath; ?>/contact.php" class="<?php echo ($pageTitle == 'Contact - Mon Blog') ? 'active' : ''; ?>">Contact</a></li>
                    <?php if (!is_logged_in()): ?>
                        <li><a href="<?php echo $rootPath; ?>/register.php" class="<?php echo ($pageTitle == 'Inscription') ? 'active' : ''; ?>">Inscription</a></li>
                        <li><a href="<?php echo $rootPath; ?>/login.php" class="<?php echo ($pageTitle == 'Connexion') ? 'active' : ''; ?>">Connexion</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo $rootPath; ?>/dashboard.php" class="<?php echo ($pageTitle == 'Tableau de bord') ? 'active' : ''; ?>">Tableau de bord</a></li>
                        <li><a href="<?php echo $rootPath; ?>/logout.php">Déconnexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">

        <?php
        // Afficher les messages flash s'il y en a
        $flash = get_flash_message();
        if ($flash): ?>
            <div class="message <?php echo $flash['type']; ?>">
                <?php echo secure_output($flash['text']); ?>
            </div>
        <?php endif; ?>