<?php
/*
 * Auteur : KHADIJA EL HIMER
 * Objectif : lire data/notes.csv et afficher la liste avec moyennes et mentions
 * Date : 18/10/2026
 */
require_once 'config.php';
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

$fichier = 'data/notes.csv';

if (!file_exists($fichier)) {
    echo "<p class='echec'>Aucune donnée : le fichier n'existe pas encore.</p>";
    include 'includes/pied_inc.php';
    exit;
}

$f = fopen($fichier, 'r');
if ($f === false) {
    echo "<p class='echec'>Erreur : impossible d'ouvrir le fichier.</p>";
    include 'includes/pied_inc.php';
    exit;
}

echo "<h2>Liste des apprenants</h2>";
echo "<table><tr><th>Nom</th><th>Info</th><th>Math</th><th>Moyenne</th><th>Mention</th></tr>";

$total = 0;
$nb = 0;
// fgetcsv retourne un tableau, puis false en fin de fichier
while (($ligne = fgetcsv($f, 0, ';', '"', '\\')) !== false) {
    if (count($ligne) < 3) {
        continue;              
    }
    [$nom, $info, $math] = $ligne;
    $moy = ($info + $math) / 2;
    $total += $moy;
    $nb++;
    $classe = ($moy < SEUIL) ? ' class="echec"' : '';
    echo "<tr$classe><td>" . htmlspecialchars($nom) . "</td><td>$info</td><td>$math</td><td>"
        . round($moy, 2) . "</td><td>" . mention($moy) . "</td></tr>";
}
fclose($f);
echo "</table>";

if ($nb > 0) {
    echo "<p><strong>Moyenne générale de la classe : " . round($total / $nb, 2) . "</strong></p>";
} else {
    echo "<p>Aucun apprenant enregistré.</p>";
}

/* ---------- 5.3 Lecture « bas niveau » ---------- */
echo "<h2>Lecture avec fgets / explode</h2><ul>";
$f = fopen($fichier, 'r');
while (!feof($f)) {
    $ligne = fgets($f);
    if ($ligne === false || trim($ligne) === '') {
        continue;
    }
    $champs = explode(';', trim($ligne));
    echo "<li>" . htmlspecialchars(implode(' | ', $champs)) . "</li>";
}
fclose($f);
echo "</ul>";
/*
 * Comparaison fgetcsv / fgets+explode :
 * - fgetcsv : gère les guillemets, les séparateurs ou retours à la ligne
 *   contenus dans un champ, retourne directement un tableau, fin = false.
 *   Inconvénient : spécifique au format CSV.
 * - fgets + feof + explode : plus bas niveau, fonctionne pour tout fichier
 *   texte et donne le contrôle total ; mais explode casse si un champ
 *   contient ';' ou des guillemets, et il faut nettoyer les "\n" et gérer la
 *   dernière ligne vide soi-même (piège classique de feof()).
 */

include 'includes/pied_inc.php';
