<?php
class Utilisateur
{
    private $bdd;

    function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    //inscription
    public function ajouterUtilisateur($nom, $prenom, $email, $mdp, $role = 'eleve')
    {
        //hashage du mdp pour la securite
        $hashPassword = sha1($mdp);
        //preparer la requete sql pour ajouter un nouvelle utilisateur
        $req = $this->bdd->prepare("INSERT INTO utilisateurs (Nom, Prenom, Email, Mdp, Role ) VALUES (:nom, :prenom, :email, :mdp, :role )");

        //Associer chaque parametre a sa valeur
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':email', $email);
        $req->bindParam(':mdp', $hashPassword);
        $req->bindParam(':role', $role);

        //executer la requete
        $req->execute();

        //retourne l'id duu dernier utilisateur inserer
        return $this->bdd->lastInsertId();
    }

    //connexion
    public function checklogin($email, $password)
    {
        $hashPassword = sha1($password);

        $req = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE Email = :email AND Mdp = :mdp ");

        $req->bindParam(':email', $email);
        $req->bindParam(':mdp', $hashPassword);

        $req->execute();
        $user = $req->fetch();

        if ($user) {
            return $user;
        }
        return false;
    }

    public function allEleves()
    {
        $req = $this->bdd->prepare("
            SELECT u.id, u.nom, u.prenom, u.email, n.note
            FROM utilisateurs u
            LEFT JOIN notes n ON u.id = n.eleve_id
            WHERE u.role = 'eleve'
            ORDER BY n.note DESC
        ");
        $req->execute();
        $eleves = $req->fetchAll(PDO::FETCH_ASSOC);

        // Affiche le résultat pour vérifier son contenu
        //var_dump($eleves);

        return $eleves;
    }

    // Fonction pour supprimer un élève
    public function supprimerUtilisateur($eleve_id)
    {
        // Préparer la requête SQL pour supprimer l'élève de la table utilisateurs
        $req = $this->bdd->prepare("DELETE FROM utilisateurs WHERE id = :id");
        $req->bindParam(':id', $eleve_id, PDO::PARAM_INT);

        // Exécuter la requête
        $req->execute();

        // Vérifie si l'élève a bien été supprimé
        return $req->rowCount() > 0;
    }
}
