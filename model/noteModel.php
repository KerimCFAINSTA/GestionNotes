<?php
class Note
{
    private $bdd;

    function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    // Ajouter une note pour un élève
    public function ajouterNote($eleve_id, $note)
    {
        // Préparer la requête SQL pour insérer la note
        $req = $this->bdd->prepare("INSERT INTO notes (eleve_id, note) VALUES (:eleve_id, :note)");

        // Associer chaque paramètre à sa valeur
        $req->bindParam(':eleve_id', $eleve_id);
        $req->bindParam(':note', $note);

        // Exécuter la requête
        $req->execute();

        // Retourne l'id de la note insérée
        return $this->bdd->lastInsertId();
    }

    // Modifier la note d'un élève
    public function modifierNote($eleve_id, $note)
    {
        // Préparer la requête SQL pour mettre à jour la note
        $req = $this->bdd->prepare("UPDATE notes SET note = :note WHERE eleve_id = :eleve_id");

        // Associer chaque paramètre à sa valeur
        $req->bindParam(':eleve_id', $eleve_id);
        $req->bindParam(':note', $note);

        // Exécuter la requête
        $req->execute();
    }

    // Supprimer la note d'un élève
    public function supprimerNote($eleve_id)
    {
        // Préparer la requête SQL pour supprimer la note
        $req = $this->bdd->prepare("DELETE FROM notes WHERE eleve_id = :eleve_id");

        // Associer le paramètre à sa valeur
        $req->bindParam(':eleve_id', $eleve_id);

        // Exécuter la requête
        $req->execute();
    }

    // Obtenir la note d'un élève par son ID
    public function getNoteByEleve($eleve_id)
    {
        // Préparer la requête SQL pour récupérer la note d'un élève
        $req = $this->bdd->prepare("SELECT note FROM notes WHERE eleve_id = :eleve_id");

        // Associer le paramètre à sa valeur
        $req->bindParam(':eleve_id', $eleve_id);

        // Exécuter la requête
        $req->execute();
        $note = $req->fetch(PDO::FETCH_ASSOC);

        return $note ? $note['note'] : null;
    }
}
