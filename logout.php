<?php
session_start(); // 1. Démarre la session (obligatoire pour la détruire)

// 2. Effacer toutes les variables de session
$_SESSION = [];

// 3. Détruire la session
session_destroy();

// 4. Rediriger l'utilisateur vers la page de connexion avec un message de déconnexion
header('Location: login.php?logout=1');
exit;
