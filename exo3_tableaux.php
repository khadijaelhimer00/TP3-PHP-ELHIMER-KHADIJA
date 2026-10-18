<?php
/*
 * Auteur : KHADIJA EL HIMER
 * Objectif : Partie 3 - tableaux (création, affichage, stats, tri, opérateurs)
 * Date : 18/10/2026
 */
require_once 'config.php';
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

/*
 * Expérience 1 (4.1.3) : remplacer un nom de fichier par un nom inexistant
 *   include 'includes/inexistant.php';  -> Warning, le script CONTINUE
 *   require 'includes/inexistant.php';  -> Fatal error (Uncaught Error), le script S'ARRÊTE
 *
 * Expérience 2 (4.1.4) :
 *   include 'includes/menu_inc.php'; include 'includes/menu_inc.php';
 *       -> le menu s'affiche DEUX fois
 *   include_once ... (deux fois) -> le menu s'affiche UNE seule fois
 */

$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Souha" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];

/* ---------- 3.1 Création ---------- */
echo "<h2>3.1 Tableau indexé</h2>";
$modules = ["Algorithmique", "Bases de données", "Développement web"];
foreach ($modules as $m) {
    echo "$m<br>";
}
for ($i = 0; $i < count($modules); $i++) {
    echo "modules[$i] = $modules[$i]<br>";
}

/* ---------- 3.2 Affichage HTML ---------- */
echo "<h2>3.2 Tableau des notes</h2>";
echo "<table><tr><th>Nom</th><th>Note</th><th>Mention</th></tr>";
foreach ($notes as $nom => $note) {
    $classe = ($note < SEUIL) ? ' class="echec"' : '';
    echo "<tr$classe><td>" . htmlspecialchars($nom) . "</td><td>$note</td><td>"
        . mention($note) . "</td></tr>";
}
echo "</table>";

/* ---------- 3.3 Statistiques ---------- */
echo "<h2>3.3 Statistiques</h2>";
$somme = 0;
$nb = 0;
$meilleure = null;
$faible = null;
foreach ($notes as $note) {
    $somme += $note;
    $nb++;
    if ($meilleure === null || $note > $meilleure) { $meilleure = $note; }
    if ($faible === null || $note < $faible)       { $faible = $note; }
}
$moyenne = $somme / $nb;
echo "Somme : $somme<br>Moyenne : " . round($moyenne, 2)
   . "<br>Meilleure : $meilleure<br>Plus faible : $faible<br>";

echo "<p>Vérification : array_sum=" . array_sum($notes)
   . ", count=" . count($notes)
   . ", moyenne=" . round(array_sum($notes) / count($notes), 2)
   . ", max=" . max($notes) . ", min=" . min($notes) . "</p>";

$effectifs = [];
foreach ($notes as $note) {
    $m = mention($note);
    $effectifs[$m] = ($effectifs[$m] ?? 0) + 1;
}
echo "<h3>Effectifs par mention</h3><ul>";
foreach ($effectifs as $m => $n) {
    echo "<li>$m : $n</li>";
}
echo "</ul>";

/* ---------- 3.4 Tri ---------- */
function afficher($tab)
{
    echo "<ul>";
    foreach ($tab as $cle => $valeur) {
        echo "<li>" . htmlspecialchars($cle) . " : $valeur</li>";
    }
    echo "</ul>";
}

echo "<h2>3.4 Tris</h2>";

$t = $notes; ksort($t);
echo "<h3>Noms croissants (ksort)</h3>";  afficher($t);

$t = $notes; arsort($t);
echo "<h3>Notes décroissantes (arsort)</h3>"; afficher($t);

$t = $notes; krsort($t);
echo "<h3>Noms décroissants (krsort)</h3>"; afficher($t);

$t = $notes; asort($t);
echo "<h3>Notes croissantes (asort)</h3>"; afficher($t);
/*
 * Q : sur un tableau indexé comme $modules, on utilise sort() (croissant)
 *     ou rsort() (décroissant) : elles ré-indexent le tableau (0,1,2...),
 *     contrairement à asort/arsort qui conservent les clés.
 */

/* ---------- 3.5 Opérateurs de tableaux ---------- */
echo "<h2>3.5 Opérateurs de tableaux</h2><pre>";
$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];
echo '$a + $b : '; print_r($a + $b);   // [x=>1, y=>2] : union, les clés de $a gagnent
echo '$a == $b : '; var_dump($a == $b);   // true  : mêmes paires clé/valeur
echo '$a === $b : '; var_dump($a === $b); // false : l'ordre et les types doivent aussi être identiques
echo "</pre>";
/*
 * + : union (ajoute à $a les clés absentes de $a).
 * == : mêmes couples clé/valeur, l'ordre n'importe pas.
 * === : mêmes couples, même ORDRE et mêmes types.
 */

include 'includes/pied_inc.php';
