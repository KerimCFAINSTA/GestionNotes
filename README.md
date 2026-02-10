# GestionNotes - Système de Gestion des Notes Scolaires

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

Application web de gestion des notes scolaires développée en PHP natif suivant l'architecture MVC. Permet aux professeurs de gérer les élèves et leurs notes, et aux élèves de consulter leur classement.

## Fonctionnalités

### Espace Professeur
- **Gestion des élèves** : Visualisation complète de tous les élèves inscrits
- **Gestion des notes** : 
  - Ajout de notes pour chaque élève (0-20)
  - Modification des notes existantes
  - Suppression des notes
- **Suppression d'élèves** : Retrait d'élèves de la base de données
- **Tableau de bord** : Affichage des élèves avec leurs notes en temps réel

### Espace Élève
- **Consultation du classement** : Visualisation de son classement par rapport aux autres élèves
- **Suivi des notes** : Accès à ses propres résultats

### Système d'Authentification
- Inscription avec choix du rôle (élève/professeur)
- Connexion sécurisée avec hashage SHA-1
- Gestion des sessions utilisateur
- Contrôle d'accès basé sur les rôles

## Technologies Utilisées

- **Backend** : PHP 7.4+
- **Base de données** : MySQL / MariaDB
- **Frontend** : HTML5, CSS3, Bootstrap 5
- **Architecture** : MVC (Model-View-Controller)
- **Sécurité** : 
  - Requêtes préparées (PDO)
  - Hashage de mots de passe (SHA-1)
  - Protection CSRF
  - Contrôle d'accès par session

## Structure du Projet

```
GestionNotes/
│
├── bdd/
│   ├── bdd.php              # Configuration de la connexion à la base de données
│   └── script.sql           # Script de création de la base de données
│
├── controller/
│   ├── noteController.php           # Gestion des actions sur les notes
│   ├── selectAllEleves.php          # Récupération de tous les élèves
│   └── utilisateurController.php    # Gestion des utilisateurs
│
├── model/
│   ├── noteModel.php                # Modèle pour les notes
│   └── utilisateurModel.php         # Modèle pour les utilisateurs
│
├── view/
│   ├── commun/
│   │   ├── header.php       # En-tête commun
│   │   └── footer.php       # Pied de page commun
│   ├── accueil.php          # Page d'accueil
│   ├── login.php            # Page de connexion
│   ├── inscription.php      # Page d'inscription
│   ├── eleve.php            # Interface professeur (gestion élèves)
│   └── classement.php       # Classement des élèves
│
├── images/
│   └── classe.jpg           # Images du projet
│
└── index.php                # Point d'entrée de l'application
```

## Installation

### Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7+ ou MariaDB 10.3+
- Serveur web (Apache, Nginx) ou environnement de développement local (XAMPP, WAMP, MAMP)

### Étapes d'installation

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/votre-username/GestionNotes.git
   cd GestionNotes
   ```

2. **Créer la base de données**
   - Ouvrez phpMyAdmin ou votre client MySQL
   - Exécutez le script `bdd/script.sql` pour créer la base de données et les tables

3. **Configurer la connexion à la base de données**
   - Ouvrez le fichier `bdd/bdd.php`
   - Modifiez les paramètres de connexion selon votre environnement :
   ```php
   $host = 'localhost';
   $dbname = 'gestionnote';
   $username = 'votre_utilisateur';
   $password = 'votre_mot_de_passe';
   ```

4. **Lancer l'application**
   - Placez le projet dans votre répertoire web (htdocs, www, etc.)
   - Accédez à l'application via : `http://localhost/GestionNotes`

## 📊 Base de Données

### Table `utilisateurs`
| Champ    | Type         | Description                          |
|----------|--------------|--------------------------------------|
| id       | INT          | Identifiant unique (Auto-increment)  |
| nom      | VARCHAR(50)  | Nom de l'utilisateur                 |
| prenom   | VARCHAR(50)  | Prénom de l'utilisateur              |
| email    | VARCHAR(100) | Email unique de l'utilisateur        |
| Mdp      | VARCHAR(255) | Mot de passe hashé                   |
| role     | ENUM         | Rôle : 'eleve' ou 'professeur'       |

### Table `notes`
| Champ     | Type          | Description                              |
|-----------|---------------|------------------------------------------|
| id        | INT           | Identifiant unique (Auto-increment)      |
| eleve_id  | INT           | Référence à l'élève (FK)                 |
| note      | DECIMAL(5,2)  | Note de l'élève (0.00 - 20.00)          |

**Contraintes** :
- Clé étrangère entre `notes.eleve_id` et `utilisateurs.id`
- Suppression en cascade des notes lors de la suppression d'un élève
- Validation de la note entre 0 et 20

## Utilisation

### Créer un compte professeur
1. Accédez à la page d'inscription
2. Remplissez le formulaire avec vos informations
3. Sélectionnez le rôle **"Professeur"**
4. Connectez-vous avec vos identifiants

### Créer un compte élève
1. Accédez à la page d'inscription
2. Remplissez le formulaire avec vos informations
3. Sélectionnez le rôle **"Élève"**
4. Connectez-vous pour consulter votre classement

### Gérer les notes (Professeur)
1. Connectez-vous avec un compte professeur
2. Accédez à l'espace "Gestion des élèves"
3. Utilisez les formulaires pour :
   - Ajouter une note à un élève
   - Modifier une note existante
   - Supprimer un élève

## Sécurité

Le projet implémente plusieurs mesures de sécurité :

- **Requêtes préparées PDO** : Protection contre les injections SQL
- **Hashage des mots de passe** : Utilisation de SHA-1 (à améliorer avec `password_hash()`)
- **Gestion des sessions** : Contrôle d'accès basé sur les rôles
- **Validation des données** : Vérification côté serveur et client
- **Contrôle d'accès** : Redirection automatique selon le rôle utilisateur

### ⚠️ Recommandations d'amélioration
- Migrer de SHA-1 vers `password_hash()` et `password_verify()` (bcrypt)
- Implémenter la protection CSRF avec tokens
- Ajouter la validation et le nettoyage des entrées utilisateur
- Utiliser HTTPS en production

## Interface Utilisateur

L'application utilise **Bootstrap 5** pour une interface responsive et moderne :
- Design adaptatif (mobile-friendly)
- Formulaires stylisés
- Tableaux interactifs
- Navigation intuitive

## Architecture MVC

### Model
- `utilisateurModel.php` : Gestion des utilisateurs (CRUD)
- `noteModel.php` : Gestion des notes (CRUD)

### View
- Pages séparées pour chaque fonctionnalité
- Templates communs (header/footer) pour la cohérence
- Affichage dynamique des données

### Controller
- `utilisateurController.php` : Logique métier des utilisateurs
- `noteController.php` : Logique métier des notes
- Routage centralisé via `index.php`

## Améliorations Futures

- [ ] Migration vers `password_hash()` et `password_verify()`
- [ ] Ajout d'un système de pagination pour les listes d'élèves
- [ ] Implémentation d'un tableau de bord avec statistiques
- [ ] Export des notes en PDF/Excel
- [ ] Système de notification par email
- [ ] Gestion de plusieurs matières
- [ ] Graphiques de progression des élèves
- [ ] API REST pour une application mobile
- [ ] Tests unitaires et d'intégration

## 👨‍💻 Auteur

**Kerim** - Développeur Web  
- 🌐 Portfolio : kocait.fr

## 🙏 Remerciements

- Bootstrap pour le framework CSS
- La communauté PHP pour les ressources et la documentation
- Mes formateurs BTS SIO pour leur accompagnement

---

**⭐ Si ce projet vous a été utile, n'hésitez pas à lui donner une étoile !**
