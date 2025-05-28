<?php
/**
 * Opération DELETE - Suppression d'un formateur dans l'application Annuaire des formateurs
 *
 * Ce fichier implémente l'opération DELETE du modèle CRUD (Create, Read, Update, Delete).
 * Il permet de supprimer un formateur existant de la base de données après confirmation.
 * 
 * Le modèle CRUD est un acronyme pour les quatre opérations de base de la persistance des données :
 * - CREATE : Création/ajout de nouvelles données
 * - READ : Lecture/consultation des données existantes
 * - UPDATE : Mise à jour/modification des données existantes
 * - DELETE : Suppression des données existantes
 *
 * Ce fichier gère spécifiquement l'opération DELETE en :
 * - Vérifiant l'existence du formateur à supprimer via son ID
 * - Affichant une page de confirmation avec les informations du formateur
 * - Exécutant la suppression après confirmation de l'utilisateur
 * - Affichant les messages de succès ou d'erreur appropriés
 *
 * @package     AnnuaireFormateurs
 * @author      ali.zainoul.az@gmail.com
 * @version     1.0
 */

require 'includes/header.php';
require 'includes/db.php';

$errors = [];
$success = false;

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin'){
    header('Location: index.php');
    exit;
}

// Vérification de l'ID passé en paramètre
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}


$id = (int)$_GET['id'];

// Vérification que le formateur existe
try {
    $stmt = $pdo->prepare("SELECT * FROM trainers WHERE id = ?");
    $stmt->execute([$id]);
    $trainer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$trainer) {
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    $errors[] = "Erreur lors de la récupération des données : " . $e->getMessage();
}

// Traitement de la suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    try {
        $stmt = $pdo->prepare("DELETE FROM trainers WHERE id = ?");
        $stmt->execute([$id]);
        
        $success = true;
    } catch (PDOException $e) {
        $errors[] = "Erreur lors de la suppression : " . $e->getMessage();
    }
}
?>

<main>
    <h2>Supprimer un formateur</h2>
    
    <?php if ($success): ?>
        <div class="message success">
            Le formateur a été supprimé avec succès.
            <a href="index.php">Retour à la liste</a>
        </div>
    <?php else: ?>
        <?php if (!empty($errors)): ?>
            <div class="message error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <div class="confirmation">
            <p>Êtes-vous sûr de vouloir supprimer le formateur suivant ?</p>
            <div class="trainer-info">
                <p><strong>Nom :</strong> <?php echo htmlspecialchars($trainer['last_name']); ?></p>
                <p><strong>Prénom :</strong> <?php echo htmlspecialchars($trainer['first_name']); ?></p>
                <p><strong>Email :</strong> <?php echo htmlspecialchars($trainer['email']); ?></p>
                <p><strong>Domaine :</strong> <?php echo htmlspecialchars($trainer['domain']); ?></p>
            </div>
            
            <form method="post" action="">
                <input type="hidden" name="confirm" value="yes">
                <div class="form-actions">
                    <button type="submit" class="btn btn-delete">Confirmer la suppression</button>
                    <a href="index.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    <?php endif; ?>
</main>

<?php require 'includes/footer.php'; ?>