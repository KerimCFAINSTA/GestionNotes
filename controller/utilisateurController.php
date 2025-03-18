<?php
include('../model/utilisateurModel.php');
include('../bdd/bdd.php');

if (isset($_POST['action'])) {
    $utilisateurController = new UtilisateurController($bdd);

    switch ($_POST['action']) {
        case 'inscription':
            $utilisateurController->create();
            break;
        case 'login':
            $utilisateurController->login();
            break;
        case 'supprimerEleve': // Nouveau cas pour la suppression
            $utilisateurController->supprimerEleve();
            break;
    }
}

class UtilisateurController
{
    private $utilisateur;

    function __construct($bdd)
    {
        $this->utilisateur = new Utilisateur($bdd);
    }

    // Fonction pour ajouter un utilisateur (inscription)
    public function create()
    {
        if (!isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'], $_POST['role'])) {
            die("Tous les champs sont obligatoires.");
        }

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mdp = $_POST['password'];
        $role = $_POST['role'];

        $this->utilisateur->ajouterUtilisateur($nom, $prenom, $email, $mdp, $role);

        header('Location: http://localhost/promo284/GestionNotes/');
        exit;
    }

    // Fonction pour se connecter
    public function login()
    {
        if (!isset($_POST['email'], $_POST['password'])) {
            die("Veuillez remplir le formulaire.");
        }

        // Permet de chercher l'utilisateur dans la base de données
        $user = $this->utilisateur->checklogin($_POST['email'], $_POST['password']);

        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: http://localhost/promo284/GestionNotes/');
            exit;
        } else {
            die("Email ou mot de passe incorrect.");
        }
    }

    // Nouvelle fonction pour supprimer un élève
    public function supprimerEleve()
    {
        if (isset($_POST['eleve_id'])) {
            $eleve_id = $_POST['eleve_id'];

            // Appeler la méthode pour supprimer l'élève
            $supprime = $this->utilisateur->supprimerUtilisateur($eleve_id);

            if ($supprime) {
                // Si l'élève a bien été supprimé, rediriger
                header('Location: http://localhost/promo284/GestionNotes/index.php?page=eleve');
                exit;
            } else {
                // Si la suppression échoue, afficher un message d'erreur
                echo "Erreur : L'élève n'a pas pu être supprimé.";
            }
        } else {
            echo "Erreur : Aucun identifiant d'élève trouvé.";
        }
    }
}
