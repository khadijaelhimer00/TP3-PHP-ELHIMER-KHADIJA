<?php
session_start();
/*
 * Auteur : KHADIJA EL HIMER
 * Objectif : page protégée accessible uniquement après connexion
 * Date : 18/10/2026
 */
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Profil</title></head>
<body>
<h1>Bienvenue <?= htmlspecialchars($_SESSION['login']) ?> !</h1>
<p><a href="liste.php">Liste des notes</a> | <a href="deconnexion.php">Se déconnecter</a></p>
</body>
</html>
