<?php
/*
 * Auteur : KHADIJA EL HIMER 
 * Objectif : traiter le formulaire info.html
 * Date : 18/10/2026
 */
$nom    = htmlspecialchars(trim($_GET['nom'] ?? ''));
$prenom = htmlspecialchars(trim($_GET['prenom'] ?? ''));
$sexe   = $_GET['sexe'] ?? '';

if ($sexe === 'M') {
    $civilite = "Monsieur";
} elseif ($sexe === 'F') {
    $civilite = "Madame";
} else {
    $civilite = "";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Bonjour</title></head>
<body>
<p>Bonjour <?= $civilite ?> <?= $prenom ?> <?= $nom ?></p>
<p><a href="info.html">Retour</a></p>
</body>
</html>
