<?php
/**
 * Pied de page commun pour l'application Annuaire des formateurs
 *
 * Ce fichier contient le pied de page HTML commun à toutes les pages de l'application,
 * incluant les informations de contact, les liens rapides et les mentions légales.
 * Il contient également des scripts JavaScript pour les animations et interactions.
 *
 * @package     AnnuaireFormateurs
 * @author      ali.zainoul.az@gmail.com
 * @version     1.0
 */
?>
</div><!-- Fin .main-container -->

  <!-- Pied de page principal -->
  <footer class="main-footer">
    <div class="container">
      <div class="footer-content">
        <!-- Informations sur l'application -->
        <div class="footer-info">
          <h3>Annuaire des formateurs</h3>
          <p>Une application de gestion des formateurs professionnels</p>
        </div>
        
        <!-- Liens de navigation rapide -->
        <div class="footer-links">
          <h4>Liens rapides</h4>
          <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="add.php">Ajouter un formateur</a></li>
            <li><a href="login.php">Connexion</a></li>
          </ul>
        </div>
        
        <!-- Informations de contact -->
        <div class="footer-contact">
          <h4>Contact</h4>
          <p><i class="fas fa-envelope"></i> contact@annuaire-formateurs.fr</p>
          <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
        </div>
      </div>
      
      <!-- Copyright et mentions légales -->
      <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Annuaire des formateurs. Tous droits réservés.</p>
      </div>
    </div>
  </footer>

  <!-- Scripts JavaScript pour les animations et interactions -->
  <script>
    // Script pour les animations et interactions
    document.addEventListener('DOMContentLoaded', function() {
      // Animation des messages d'alerte/notification
      const messages = document.querySelectorAll('.message');
      messages.forEach(message => {
        setTimeout(() => {
          message.classList.add('visible');
        }, 100);
      });
    });
  </script>
</body>
</html>
