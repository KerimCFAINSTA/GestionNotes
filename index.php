<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';
include('view/commun/header.php');

switch ($page) {
        // authentification 
    case 'login':
        include('view/login.php');
        break;
    case 'inscription':
        include('view/inscription.php');
        break;
    case 'eleve':
        // Vérifier si l'utilisateur est un professeur avant de lui donner accès à la page 'eleve'
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'professeur') {
            include('view/eleve.php');
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'classement':
        // Vérifier si l'utilisateur est un professeur avant de lui donner accès à la page 'eleve'
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'eleve') {
            include('view/classement.php');
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'deconnexion':
        session_destroy();
        header('Location: index.php');
        exit();
        break;
    default:
        include('view/accueil.php');
        break;
}
include('view/commun/footer.php');
