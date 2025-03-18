<?php
include('../model/noteModel.php');
include('../bdd/bdd.php');

if (isset($_POST['action'])) {
    $noteController = new NoteController($bdd);

    switch ($_POST['action']) {
        case 'ajouterNote':
            $noteController->ajouter();
            break;
        case 'modifierNote':
            $noteController->modifier();
            break;
        case 'supprimerNote':
            $noteController->supprimer();
            break;
        case 'getNote':
            $noteController->obtenir();
            break;
    }
}

class NoteController
{
    private $note;

    function __construct($bdd)
    {
        $this->note = new Note($bdd);
    }

    // Ajouter une note
    public function ajouter()
    {
        if (!isset($_POST['eleve_id'], $_POST['note'])) {
            die("Tous les champs sont obligatoires.");
        }

        $eleve_id = $_POST['eleve_id'];
        $note = $_POST['note'];

        // Ajouter la note via le modèle
        $this->note->ajouterNote($eleve_id, $note);

        // Rediriger ou afficher un message de succès
        header('Location: http://localhost/promo284/GestionNotes/index.php?page=eleve'); // Modifier l'URL selon ton besoin
        exit;
    }

    // Modifier une note
    public function modifier()
    {
        if (!isset($_POST['eleve_id'], $_POST['note'])) {
            die("Tous les champs sont obligatoires.");
        }

        $eleve_id = $_POST['eleve_id'];
        $note = $_POST['note'];

        // Modifier la note via le modèle
        $this->note->modifierNote($eleve_id, $note);

        // Rediriger ou afficher un message de succès
        header('Location: http://localhost/promo284/GestionNotes/index.php?page=eleve');
        exit;
    }

    // Supprimer une note
    public function supprimer()
    {
        if (!isset($_POST['eleve_id'])) {
            die("L'identifiant de l'élève est obligatoire.");
        }

        $eleve_id = $_POST['eleve_id'];

        // Supprimer la note via le modèle
        $this->note->supprimerNote($eleve_id);

        // Rediriger ou afficher un message de succès
        header('Location: http://localhost/promo284/GestionNotes/index.php?page=eleve');
        exit;
    }

    // Obtenir la note d'un élève
    public function obtenir()
    {
        if (!isset($_POST['eleve_id'])) {
            die("L'identifiant de l'élève est obligatoire.");
        }

        $eleve_id = $_POST['eleve_id'];

        // Récupérer la note via le modèle
        $note = $this->note->getNoteByEleve($eleve_id);

        // Afficher la note ou rediriger
        if ($note !== null) {
            echo "La note de l'élève est : " . $note;
        } else {
            echo "Aucune note trouvée pour cet élève.";
        }
    }
}
