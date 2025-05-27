<?php
/**
 * En-tête commun pour l'application Annuaire des formateurs
 *
 * Ce fichier contient l'en-tête HTML commun à toutes les pages de l'application,
 * incluant les métadonnées, les feuilles de style, les polices et la barre de navigation.
 * Il gère également l'initialisation de la session PHP si nécessaire.
 *
 * @package     AnnuaireFormateurs
 * @author      ali.zainoul.az@gmail.com
 * @version     1.0
 */

// Démarrage de la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Métadonnées de base -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Annuaire des formateurs</title>
  
  <!-- Feuilles de style externes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="assets/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- En-tête principal avec logo et navigation -->
  <header class="main-header">
    <div class="container">
      <div class="header-content">
        <!-- Logo et titre de l'application -->
        <div class="logo">
          <a href="/" style="text-decoration: none; color: inherit;">
            <h1><i class="fas fa-chalkboard-teacher"></i> Annuaire des formateurs</h1>
          </a>
        </div>
        
        <!-- Navigation principale -->
        <nav class="main-nav">
          <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="add.php"><i class="fas fa-plus-circle"></i> Ajouter</a></li>
            <?php if (isset($_SESSION['user'])): ?>
              <!-- Affichage du nom d'utilisateur et lien de déconnexion pour les utilisateurs connectés -->
              <li><span class="user-welcome"><i class="fas fa-user"></i> <?php echo $_SESSION['user']; ?></span></li>
              <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            <?php else: ?>
              <!-- Lien de connexion pour les utilisateurs non connectés -->
              <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </div>
  </header>
  
  <!-- Conteneur principal pour le contenu de la page -->
  <div class="container main-container">
