<?php
include('./controller/selectAllEleves.php');
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Email</th>
            <th scope="col">Note</th>
            <th scope="col">Ajouter</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $index = 0;  // Initialise l'index
        foreach ($allEleves as $value) { ?>
            <tr>
                <th scope="row"><?php echo $index + 1; ?></th>
                <td><?php echo $value['nom']; ?></td> <!-- Remplacer 'Nom' par 'nom' -->
                <td><?php echo $value['prenom']; ?></td> <!-- Remplacer 'Prenom' par 'prenom' -->
                <td><?php echo $value['email']; ?></td> <!-- Remplacer 'Email' par 'email' -->
                <td><?php echo $value['note']; ?></td> <!-- Remplacer 'Note' par 'note' -->

                <!-- Formulaire d'ajout de note -->
                <td>
                    <form action="controller/noteController.php" method="POST">
                        <input type="hidden" name="eleve_id" value="<?php echo $value['id']; ?>">
                        <input type="number" step="0.01" name="note" placeholder="Ajouter note" required>
                        <input type="submit" name="action" value="ajouterNote">
                    </form>
                </td>

                <!-- Formulaire de modification de note -->
                <td>
                    <form action="controller/noteController.php" method="POST">
                        <input type="hidden" name="eleve_id" value="<?php echo $value['id']; ?>">
                        <input type="number" step="0.01" name="note" value="<?php echo $value['note']; ?>" required>
                        <input type="submit" name="action" value="modifierNote">
                    </form>
                </td>

                <!-- Formulaire de suppression d'élève -->
                <td>
                    <form action="controller/utilisateurController.php" method="POST">
                        <input type="hidden" name="eleve_id" value="<?php echo $value['id']; ?>">
                        <input type="hidden" name="action" value="supprimerEleve">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php
            $index++; // Incrémenter l'index à chaque itération
        } ?>
    </tbody>
</table>