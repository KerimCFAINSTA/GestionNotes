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

            </tr>
        <?php
            $index++; // Incrémenter l'index à chaque itération
        } ?>
    </tbody>
</table>