<?php
/*
 * Auteur : KHADIJA EL HIMER
 * Objectif : Partie 0 et 1 - variables, constantes, types, chaînes
 * Date : 18/10/2026
 */
echo 'Hello PHP';

// commentaire sur une ligne 
# commentaire sur une ligne 
/* commentaire
   sur plusieurs lignes */

//Partie 1 : Variables, constantes, types et chaînes
require 'config.php';   
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Exercice 1 - Bases</title></head>
<body>
<h1>Exercice 1 : bases</h1>
<?php
/* ---------- 1.1 Noms de variables ---------- */
echo "<h2>1.1 Noms de variables</h2>";
/*
 * $x        : valide (lettre)
 * $_x       : valide (le underscore est autorisé au début)
 * $2x       : INVALIDE (ne peut pas commencer par un chiffre)
 * $x-y      : INVALIDE (le tiret est l'opérateur moins)
 * $Prix_HT  : valide (lettres, majuscules et underscore)
 * $prix ht  : INVALIDE (l'espace n'est pas autorisé)
 * $état     : valide (les octets 0x80-0xFF sont admis), déconseillé en pratique
 */
$x = 1;
$_x = 2;
$Prix_HT = 100;
$état = "ok";
echo "x=$x, _x=$_x, Prix_HT=$Prix_HT, état=$état<br>";

// Sensibilité à la casse
$a = 1;
$A = 2;
echo "\$a = $a et \$A = $A : deux variables distinctes<br>";

/* ---------- 1.2 Constantes ---------- */
echo "<h2>1.2 Constantes</h2>";
echo "ETABLISSEMENT = " . ETABLISSEMENT . "<br>";
echo "NOTE_MIN = " . NOTE_MIN . "<br>";
echo "NOTE_MAX = " . NOTE_MAX . "<br>";
echo "SEUIL = " . SEUIL . "<br>";
echo "defined('SEUIL') : ";
var_dump(defined('SEUIL'));
echo "<br>defined('INCONNUE') : ";
var_dump(defined('INCONNUE'));
echo "<br>";
/*
 * Q1 : afficher une constante non définie lève une Error en PHP 8
 *      ("Undefined constant") qui stoppe le script ; en PHP 7 c'était un
 *      warning et la constante était traitée comme la chaîne "INCONNUE".
 * Q2 : const est évalué à la compilation, s'écrit au niveau global d'un
 *      fichier (ou dans une classe), et ne peut pas être dans un if/une
 *      boucle. define() est une fonction exécutée à l'exécution : le nom
 *      peut être calculé et l'appel peut être conditionnel.
 */

/* ---------- 1.3 Calcul ---------- */
echo "<h2>1.3 Calcul</h2>";
$prix_ht = 60;
$tva = 20;
$prix_ttc = $prix_ht * (1 + $tva / 100);
echo "Le prix TTC du produit est de $prix_ttc €.<br>";

/* ---------- 1.4 Types et conversions ---------- */
echo "<h2>1.4 Types et conversions</h2><pre>";
$test = 42;
$test = (string) $test;     // ou strval($test) / settype($test, "string")
var_dump($test);            // string(2) "42"

echo "\n-- cast en booléen --\n";
// Faux : 0, 0.0, "0", "", [], null ; Vrai : "abc"
var_dump((bool) 0);         // false
var_dump((bool) 0.0);       // false
var_dump((bool) "0");       // false
var_dump((bool) "");        // false
var_dump((bool) "abc");     // true
var_dump((bool) []);        // false
var_dump((bool) null);      // false

echo "\n-- autres casts --\n";
var_dump((int) 3.9);        // int(3)   : troncature, pas d'arrondi
var_dump((int) "12abc");    // int(12)  : lecture jusqu'au premier caractère invalide
var_dump((float) "1.5e3");  // float(1500)
var_dump((int) true);       // int(1)

echo "\n-- 255 dans 4 bases --\n";
$dec = 255;
$hex = 0xFF;
$oct = 0377;                // ou 0o377 en PHP 8.1+
$bin = 0b11111111;
echo "décimal=$dec hexadécimal=$hex octal=$oct binaire=$bin\n";
echo "(affichage en base d'origine : " . dechex(255) . " / " . decoct(255) . " / " . decbin(255) . ")\n";
echo "</pre>";

/* ---------- 1.5 Chaînes ---------- */
echo "<h2>1.5 Chaînes de caractères</h2>";
$traitees = "égales à";
$ici = 2;
echo 'Ahmed a dit : "J\'ai réussi"' . "<br>";
echo 'Voulez-vous supprimer C:\*.*?' . "<br>";
echo 'Ceci n\'affichera pas \n de nouvelle ligne' . "<br>";
echo 'Les variables ne seront pas $traitees $ici' . "<br>";
echo "Les variables seront $traitees $ici<br>";

$chaine = trim("*Bonjour les développeurs*", "*");
echo $chaine . "<br>";

// Une lettre par ligne. strlen() compte des octets : 'é' compterait pour 2.
// mb_strlen()/mb_substr() gèrent correctement l'UTF-8.
for ($i = 0; $i < mb_strlen($chaine); $i++) {
    echo mb_substr($chaine, $i, 1) . "<br>";
}
?>
</body>
</html>
