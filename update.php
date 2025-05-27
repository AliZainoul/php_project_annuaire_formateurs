<?php
/**
 * Opération UPDATE - Modification d'un formateur dans l'application Annuaire des formateurs
 *
 * Ce fichier implémente l'opération UPDATE du modèle CRUD (Create, Read, Update, Delete).
 * Il permet de modifier les informations d'un formateur existant dans la base de données.
 * 
 * Le modèle CRUD est un acronyme pour les quatre opérations de base de la persistance des données :
 * - CREATE : Création/ajout de nouvelles données
 * - READ : Lecture/consultation des données existantes
 * - UPDATE : Mise à jour/modification des données existantes
 * - DELETE : Suppression des données existantes
 *
 * Ce fichier gère spécifiquement l'opération UPDATE en :
 * - Récupérant les informations actuelles du formateur via son ID
 * - Affichant un formulaire pré-rempli avec ces informations
 * - Validant les données modifiées (champs obligatoires, format d'email, unicité)
 * - Mettant à jour les données validées dans la base de données
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
$trainer = null;

// Vérification de l'ID passé en paramètre
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];

// Récupération des données du formateur
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

// Traitement du formulaire lors de la soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $domain = trim($_POST['domain'] ?? '');
    
    // Validation des données
    if (empty($first_name)) {
        $errors[] = "Le prénom est obligatoire";
    }
    
    if (empty($last_name)) {
        $errors[] = "Le nom est obligatoire";
    }
    
    if (empty($email)) {
        $errors[] = "L'email est obligatoire";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide";
    } else {
        // Vérification que l'email n'existe pas déjà (sauf pour le formateur actuel)
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM trainers WHERE email = ? AND id != ?");
        $stmt->execute([$email, $id]);
        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Cet email est déjà utilisé par un autre formateur";
        }
    }
    
    if (empty($domain)) {
        $errors[] = "Le domaine est obligatoire";
    }
    
    // Si aucune erreur, mise à jour en base de données
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("UPDATE trainers SET first_name = ?, last_name = ?, email = ?, domain = ? WHERE id = ?");
            $stmt->execute([$first_name, $last_name, $email, $domain, $id]);
            
            $success = true;
            // Mise à jour des données affichées
            $trainer['first_name'] = $first_name;
            $trainer['last_name'] = $last_name;
            $trainer['email'] = $email;
            $trainer['domain'] = $domain;
        } catch (PDOException $e) {
            $errors[] = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
}
?>

<main>
    <h2>Modifier un formateur</h2>
    
    <?php if ($success): ?>
        <div class="message success">
            Le formateur a été mis à jour avec succès.
            <a href="index.php">Retour à la liste</a>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($errors)): ?>
        <div class="message error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form method="post" action="" class="form-trainer">
        <div class="form-group">
            <label for="first_name">Prénom</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($trainer['first_name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="last_name">Nom</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($trainer['last_name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($trainer['email']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="domain">Domaine</label>
            <input type="text" id="domain" name="domain" value="<?php echo htmlspecialchars($trainer['domain']); ?>" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</main>

<?php require 'includes/footer.php'; ?>