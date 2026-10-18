<?php
session_start();
/*
 * Auteur : KHADIJA EL HIMER
 * Objectif : formulaire de connexion, session, cookie et redirection
 * Date : 18/10/2026
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    if ($login !== '') {
        $_SESSION['login'] = $login;

        // 6.2.1 cookie valable 24 h
        setcookie("dernier_login", $login, time() + 86400, "/");

        // 6.2.3 variante : un seul cookie contenant un tableau JSON
        setcookie("derniere_connexion",
                  json_encode(['login' => $login, 'date' => date('d/m/Y H:i:s')]),
                  time() + 86400, "/");

        header("Location: profil.php");
        exit;
    }
    $erreur = "Veuillez saisir un login.";
}

// 6.2.2 pré-remplissage du champ
$valeur = $_COOKIE['dernier_login'] ?? '';

// Lecture de la variante JSON
$info = null;
if (isset($_COOKIE['derniere_connexion'])) {
    $info = json_decode($_COOKIE['derniere_connexion'], true);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Connexion</title></head>
<body>
<h1>Connexion</h1>
<?php if (isset($erreur)): ?>
    <p style="color:red"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>
<?php if ($info): ?>
    <p>Dernière connexion : <?= htmlspecialchars($info['login']) ?> le <?= htmlspecialchars($info['date']) ?></p>
<?php endif; ?>
<form method="post" action="login.php">
    <label>Login : <input type="text" name="login" value="<?= htmlspecialchars($valeur) ?>"></label>
    <button type="submit">Se connecter</button>
</form>
<!--
 Q : une session est stockée CÔTÉ SERVEUR (fichier ; le navigateur ne garde que
     l'identifiant PHPSESSID dans un cookie). Un cookie est stocké CÔTÉ CLIENT
     (dans le navigateur).
 Q : setcookie() et header() envoient des EN-TÊTES HTTP, qui doivent précéder le
     corps de la réponse. Dès que du contenu est envoyé (même un espace ou un
     BOM avant <?php, les en-têtes sont figés : erreur "headers already sent".
-->
</body>
</html>
