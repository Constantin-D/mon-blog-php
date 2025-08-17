<?php

function secure_output($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function format_date($date, $format = 'd/m/Y à H:i')
{
    return date($format, strtotime($date));
}

function create_excerpt($text, $length = 150)
{
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}

// Fonction pour vérifier si l'utilisateur est l'auteur
function is_author($post_user_id)
{
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post_user_id;
}

// Fonction pour rediriger
function redirect($url)
{
    header("Location: $url");
    exit;
}

function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

// Fonction pour afficher un message flash 
function set_flash_message($message, $type = 'info')
{
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

// Fonction pour récupérer et effacer le message flash
function get_flash_message()
{
    if (isset($_SESSION['flash_message'])) {
        $message = [
            'text' => $_SESSION['flash_message'],
            'type' => $_SESSION['flash_type'] ?? 'info'
        ];
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
        return $message;
    }
    return null;
}

function is_valid_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function create_slug($title)
{
    $slug = strtolower($title);
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    return trim($slug, '-');
}

// Fonction pour calculer le temps de lecture estimé
function reading_time($content)
{
    $word_count = str_word_count(strip_tags($content));
    $minutes = ceil($word_count / 200); // 200 mots par minute en moyenne
    return $minutes . ' min de lecture';
}
