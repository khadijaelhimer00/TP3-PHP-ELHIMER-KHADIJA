<?php
/*
 * Auteur : KHADIJA EL HIMER 
 * Objectif : Partie 2 - structures de contrôle et boucles
 * Date : 18/10/2026
 */
require_once 'config.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Exercice 2 - Flux</title></head>
<body>
<h1>Exercice 2 : structures de contrôle</h1>
<?php
/* ---------- 2.1 mention() ---------- */
echo "<h2>2.1 Mentions</h2>";
foreach ([18, 16, 15, 14, 12.5, 12, 10, 9.99, 0] as $n) {
    echo "$n : " . mention($n) . "<br>";
}

/* ---------- 2.2 switch ---------- */
echo "<h2>2.2 Mois courant</h2>";
$mois = date("m");          
switch ((int) $mois) {
    case 1:  $nom = "janvier"; break;
    case 2:  $nom = "février"; break;
    case 3:  $nom = "mars"; break;
    case 4:  $nom = "avril"; break;
    case 5:  $nom = "mai"; break;
    case 6:  $nom = "juin"; break;
    case 7:  $nom = "juillet"; break;
    case 8:  $nom = "août"; break;
    case 9:  $nom = "septembre"; break;
    case 10: $nom = "octobre"; break;
    case 11: $nom = "novembre"; break;
    case 12: $nom = "décembre"; break;
    default: $nom = "mois inconnu";
}
echo "Nous sommes en $nom.<br>";
/*
 * Q : sans break, l'exécution "tombe" dans le case suivant (fall-through)
 *     et continue jusqu'au prochain break ou à la fin du switch.
 */

/* ---------- 2.3 Boucles ---------- */
echo "<h2>2.3.1 Triangle</h2><pre>";
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "\n";
}
echo "</pre>";

echo "<h2>2.3.2 while : 0 à 20 par pas de 2</h2>";
$i = 0;
while ($i <= 20) {
    if ($i == 10) {
        echo "<strong>$i</strong> ";
    } else {
        echo "$i ";
    }
    $i += 2;
}

echo "<h2>2.3.3 for + continue : pairs de 0 à 10</h2>";
for ($i = 0; $i <= 10; $i++) {
    if ($i % 2 != 0) {
        continue;           // passe à l'itération suivante
    }
    echo "$i ";
}

echo "<h2>2.3.4 while + switch + break 2</h2>";
$i = 0;
while (true) {
    $i++;
    switch ($i) {
        case 5:
            echo "At 5<br>";
            break;          
        case 10:
            echo "At 10; quitting<br>";
            break 2;      
        default:
            break;
    }
}

echo "<h2>2.3.5 do-while</h2>";
$i = 0;
do {
    echo ($i == 10) ? "<strong>$i</strong> " : "$i ";
    $i += 2;
} while ($i <= 20);
/*
 * Différence essentielle : while teste la condition AVANT chaque tour (le
 * corps peut ne jamais s'exécuter) ; do-while la teste APRÈS : le corps
 * s'exécute au moins une fois.
 */
?>
</body>
</html>
