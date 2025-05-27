<?php
/**
 * Opération READ - Affichage des formateurs dans l'application Annuaire des formateurs
 *
 * Ce fichier implémente l'opération READ du modèle CRUD (Create, Read, Update, Delete).
 * Il permet d'afficher la liste de tous les formateurs enregistrés dans la base de données.
 * 
 * Le modèle CRUD est un acronyme pour les quatre opérations de base de la persistance des données :
 * - CREATE : Création/ajout de nouvelles données
 * - READ : Lecture/consultation des données existantes
 * - UPDATE : Mise à jour/modification des données existantes
 * - DELETE : Suppression des données existantes
 *
 * Ce fichier gère spécifiquement l'opération READ en :
 * - Récupérant tous les formateurs depuis la base de données
 * - Affichant les données sous forme de tableau
 * - Proposant des liens vers les opérations CREATE, UPDATE et DELETE
 * - Affichant un message approprié si aucun formateur n'est enregistré
 *
 * @package     AnnuaireFormateurs
 * @author      ali.zainoul.az@gmail.com
 * @version     1.0
 */

require 'includes/header.php';
require 'includes/db.php';

// Récupération de tous les formateurs
$stmt = $pdo->query('SELECT * FROM trainers ORDER BY last_name, first_name');
$trainers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
  <h2>Annuaire des formateurs</h2>
  
  <div class="actions">
    <a href="add.php" class="btn btn-primary">Ajouter un formateur</a>
  </div>
  
  <?php if (empty($trainers)): ?>
    <p class="message info">Aucun formateur n'est enregistré pour le moment.</p>
  <?php else: ?>
    <div class="trainers-list">
      <table>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Domaine</th>
            <th>Date d'ajout</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($trainers as $trainer): ?>
            <tr>
              <td><?php echo htmlspecialchars($trainer['last_name']); ?></td>
              <td><?php echo htmlspecialchars($trainer['first_name']); ?></td>
              <td><?php echo htmlspecialchars($trainer['email']); ?></td>
              <td><?php echo htmlspecialchars($trainer['domain']); ?></td>
              <td><?php echo date('d/m/Y', strtotime($trainer['created_at'])); ?></td>
              <td class="actions">
              <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'admin'): ?>
                <a href="update.php?id=<?php echo $trainer['id']; ?>" class="btn btn-edit">Modifier</a>
                <a href="delete.php?id=<?php echo $trainer['id']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce formateur ?');">Supprimer</a>
              <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</main>

<?php require 'includes/footer.php'; ?>
