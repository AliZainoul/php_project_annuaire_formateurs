# Annuaire des Formateurs

## Présentation du Projet

L'Annuaire des Formateurs est une application web PHP qui permet de gérer une base de données de formateurs professionnels. Cette application implémente les opérations CRUD (Create, Read, Update, Delete) pour manipuler les données des formateurs de manière intuitive et efficace.

## Fonctionnalités

- **Consultation** : Affichage de la liste complète des formateurs avec leurs informations (nom, prénom, email, domaine d'expertise)
- **Ajout** : Formulaire pour ajouter un nouveau formateur avec validation des données
- **Modification** : Mise à jour des informations d'un formateur existant
- **Suppression** : Suppression d'un formateur avec confirmation préalable
- **Interface responsive** : Adaptation automatique à différentes tailles d'écran (ordinateurs, tablettes, smartphones)
- **Système d'authentification** : Connexion utilisateur pour sécuriser certaines opérations

## Architecture du Projet

### Structure des Fichiers

```
/
├── index.php           # Page d'accueil (READ) - Liste des formateurs
├── add.php             # Formulaire d'ajout (CREATE)
├── update.php          # Formulaire de modification (UPDATE)
├── delete.php          # Page de confirmation de suppression (DELETE)
├── login.php           # Page de connexion utilisateur
├── assets/
│   └── style.css       # Feuille de style principale
└── includes/
    ├── db.php          # Configuration de la base de données
    ├── header.php      # En-tête commun à toutes les pages
    └── footer.php      # Pied de page commun à toutes les pages
```

### Technologies Utilisées

- **PHP** : Langage de programmation côté serveur
- **MySQL** : Système de gestion de base de données
- **PDO** : Extension PHP pour l'accès aux bases de données
- **HTML5/CSS3** : Structure et mise en forme des pages
- **Font Awesome** : Bibliothèque d'icônes
- **Google Fonts** : Polices de caractères (Poppins)

## Base de Données

L'application utilise une base de données MySQL nommée `trainers_db` avec une table principale `trainers` qui contient les champs suivants :

- `id` : Identifiant unique (clé primaire)
- `first_name` : Prénom du formateur
- `last_name` : Nom du formateur
- `email` : Adresse email (unique)
- `domain` : Domaine d'expertise
- `created_at` : Date d'ajout dans la base de données

## Installation et Configuration

1. **Prérequis** :
   - Serveur web
   - PHP
   - MySQL

2. **Installation** :
   - Cloner le dépôt dans le répertoire de votre serveur web
   - Créer une base de données MySQL nommée `trainers_db`
   - Importer le schéma de base de données (non fourni dans ce dépôt)
   - Configurer les paramètres de connexion dans `includes/db.php`

3. **Configuration de la base de données** :
   - Modifier les paramètres dans le fichier `includes/db.php` :
     ```php
     $host = 'localhost';     // Hôte de la base de données
     $dbname = 'trainers_db'; // Nom de la base de données
     $user = 'votre_utilisateur'; // Nom d'utilisateur MySQL
     $pass = 'votre_mot_de_passe'; // Mot de passe MySQL
     ```

## Utilisation

1. **Consultation des formateurs** :
   - Accéder à la page d'accueil (`index.php`)
   - La liste des formateurs s'affiche sous forme de tableau

2. **Ajout d'un formateur** :
   - Cliquer sur le bouton "Ajouter un formateur" sur la page d'accueil
   - Remplir le formulaire avec les informations requises
   - Soumettre le formulaire

3. **Modification d'un formateur** :
   - Cliquer sur le bouton "Modifier" à côté du formateur concerné
   - Modifier les informations dans le formulaire pré-rempli
   - Soumettre le formulaire

4. **Suppression d'un formateur** :
   - Cliquer sur le bouton "Supprimer" à côté du formateur concerné
   - Confirmer la suppression sur la page de confirmation

## Sécurité

L'application implémente plusieurs mesures de sécurité :

- **Protection contre les injections SQL** : Utilisation de requêtes préparées via PDO
- **Validation des données** : Vérification des entrées utilisateur côté serveur
- **Échappement des sorties HTML** : Protection contre les attaques XSS
- **Authentification utilisateur** : Contrôle d'accès pour certaines opérations

## Fonctionnalités Responsives

L'interface s'adapte automatiquement aux différentes tailles d'écran :

- **Ordinateurs** : Affichage complet avec toutes les fonctionnalités
- **Tablettes** : Adaptation de la navigation et des tableaux
- **Smartphones** : Réorganisation des éléments pour une meilleure lisibilité

## Auteur

- **Développeur** : ali.zainoul.az@gmail.com
- **Version** : 1.0

## Licence

Ce projet est distribué sous licence propriétaire. Tous droits réservés.

---

© 2023 Annuaire des Formateurs. Tous droits réservés.