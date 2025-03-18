<?php
// Démarrage de la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="p-3 bg-light text-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="index.php?page=accueil" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="images/classe.jpg" alt="logo banque" style="width: 40px; height: auto;" class="me-2">
                </a>

                <ul class="nav me-auto mb-2 justify-content-center mb-md-0">
                    <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['role'])): ?> <!-- Vérification que 'Role' existe -->
                        <!-- Vérifier le rôle de l'utilisateur -->
                        <?php if ($_SESSION['user']['role'] == 'eleve'): ?>
                            <!-- Si c'est un eleve, afficher les pages eleves -->
                            <li><a href="index.php?page=classement" class="nav-link px-2 text-dark">Classement</a></li>
                        <?php elseif ($_SESSION['user']['role'] == 'professeur'): ?>
                            <!-- Si c'est un professeur, afficher la page des professeurs -->
                            <li><a href="index.php?page=eleve" class="nav-link px-2 text-dark">Eleve</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>

                <div class="text-end">
                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- Si l'utilisateur est connecté, afficher le bouton Déconnexion -->
                        <a href="index.php?page=deconnexion" class="btn btn-outline-dark me-2">Déconnexion</a>
                    <?php else: ?>
                        <!-- Si l'utilisateur n'est pas connecté, afficher les boutons Login et S'inscrire -->
                        <a href="index.php?page=login" class="btn btn-outline-dark me-2">Connexion</a>
                        <a href="index.php?page=inscription" class="btn btn-primary">S'inscrire</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>