<?php
/**
 * Authentification des utilisateurs pour l'application Annuaire des formateurs
 *
 * Ce fichier gère le processus d'authentification des utilisateurs dans l'application.
 * Il permet aux utilisateurs de se connecter en vérifiant leurs identifiants (nom d'utilisateur
 * et mot de passe) par rapport aux données stockées dans la base de données.
 *
 * Fonctionnalités principales :
 * - Affichage du formulaire de connexion
 * - Validation des identifiants soumis
 * - Création de la session utilisateur après authentification réussie
 * - Gestion des erreurs d'authentification
 * - Redirection après connexion réussie
 *
 * @package     AnnuaireFormateurs
 * @author      ali.zainoul.az@gmail.com
 * @version     1.0
 */

require 'includes/header.php';
require 'includes/db.php';

$errors = [];
$success = false;

// Traitement du formulaire lors de la soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validation des données
    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur est obligatoire";
    }
    
    if (empty($password)) {
        $errors[] = "Le mot de passe est obligatoire";
    }
    
    // Si aucune erreur de validation, tentative d'authentification
    if (empty($errors)) {
        try {
            // Préparation et exécution de la requête pour récupérer l'utilisateur
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Vérification du mot de passe si l'utilisateur existe
            if ($user && password_verify($password, $user['password'])) {
                // Création de la session utilisateur
                $_SESSION['user'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                // Message de succès et redirection
                $success = true;
                header("Location: index.php");
                exit;
            } else {
                $errors[] = "Identifiants incorrects. Veuillez réessayer.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erreur de base de données: " . $e->getMessage();
        }
    }
}
?>

<div class="form-container">
    <h2><i class="fas fa-sign-in-alt"></i> Connexion</h2>
    
    <?php if ($success): ?>
        <div class="success-message">
            <p>Connexion réussie. Vous allez être redirigé...</p>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($errors)): ?>
        <div class="error-message">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
        </div>
    </form>
</div>

<?php require 'includes/footer.php'; ?>
