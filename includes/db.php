<?php
/**
 * Configuration et connexion à la base de données pour l'application Annuaire des formateurs
 *
 * Ce fichier établit la connexion à la base de données MySQL en utilisant PDO.
 * Il définit les paramètres de connexion et gère les erreurs potentielles.
 * La connexion établie ($pdo) est utilisée dans les autres fichiers de l'application.
 *
 * PDO (PHP Data Objects) est une extension PHP qui définit une interface légère et cohérente
 * pour accéder aux bases de données. Avantages principaux de PDO :
 * - Interface unifiée pour accéder à différents types de bases de données
 * - Requêtes préparées qui protègent contre les injections SQL
 * - Gestion des erreurs via les exceptions
 * - Support de transactions
 * - Méthodes de récupération de données flexibles
 *
 * @package     AnnuaireFormateurs
 * @author      ali.zainoul.az@gmail.com
 * @version     1.0
 */

// Paramètres de connexion à la base de données
$host = 'localhost';     // Hôte de la base de données
$dbname = 'trainers_db'; // Nom de la base de données
$user = 'trainers_db_user'; // Nom d'utilisateur MySQL
$pass = 'phpsecure';     // Mot de passe MySQL

try {
        // Création de l'instance PDO pour la connexion à la base de données
        // PDO = PHP Data Objects, une interface d'abstraction pour accéder aux bases de données
        // avec définition du jeu de caractères utf8mb4 pour support complet Unicode (y compris les emojis)
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $user, $pass);
        
        // Configuration du mode d'erreur PDO pour lancer des exceptions
        // ERRMODE_EXCEPTION permet de capturer les erreurs via le bloc catch
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Optionnel : 
        // echo 'Connexion réussie.';
    } catch (PDOException $e) {
        // En cas d'erreur, arrêt du script et affichage du message d'erreur
        // PDOException contient les détails sur l'erreur survenue
        die('Erreur de connexion : ' . $e->getMessage());
    }
?>
