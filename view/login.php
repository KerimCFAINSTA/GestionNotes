<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
</head>

<body>
    <div>
        <h1>Connexion</h1>

        <form action="controller/utilisateurController.php" method="POST">


            <label>Email</label>
            <input type="email" name="email" required><br>

            <label>Mot de passe</label>
            <input type="password" name="password" required><br>


            <input type="hidden" name="action" value="login">
            <input type="submit" value="Valider">
        </form>
    </div>
</body>

</html>