<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
</head>

<body>
    <div>
        <h1>Inscription</h1>

        <form action="controller/utilisateurController.php" method="POST">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required><br>

            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" required><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email"><br>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required><br>

            <label for="role">Rôle</label>
            <select name="role" id="role" required>
                <option value="eleve">élève</option>
                <option value="professeur">professeur</option>
            </select><br>

            <input type="hidden" name="action" value="inscription">
            <input type="submit" value="Valider">
        </form>
    </div>
</body>

</html>