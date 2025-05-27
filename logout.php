<?php
/**
 * Déconnexion des utilisateurs pour l'application Annuaire des formateurs
 *
 * Ce fichier gère le processus de déconnexion des utilisateurs de l'application.
 * Il détruit la session en cours et redirige l'utilisateur vers la page d'accueil.
 *
 * Fonctionnalités principales :
 * - Destruction de la session utilisateur
 * - Suppression des cookies de session
 * - Redirection vers la page d'accueil après déconnexion
 *
 * @package     AnnuaireFormateurs
 * @author      ali.zainoul.az@gmail.com
 * @version     1.0
 */

// Démarrage de la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destruction de toutes les données de session
$_SESSION = [];

// Destruction du cookie de session si présent
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destruction de la session
session_destroy();

// Redirection vers la page d'accueil
header("Location: index.php");
exit;