<?php
include('./model/utilisateurModel.php');
include('./bdd/bdd.php');

$utilisateur = new Utilisateur($bdd);
$allEleves = $utilisateur->allEleves();
