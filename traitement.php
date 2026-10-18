<?php
/*
 * Auteur : KHADIJA EL HIMER 
 * Objectif : valider les données de saisie.html et les ajouter à data/notes.csv
 * Date : 18/10/2026
 */
require_once 'config.php';
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

$erreurs = [];

// 1) les champs existent et ne sont pas vides
foreach (['nom', 'note_info', 'note_math'] as $champ) {
    if (!isset($_POST[$champ]) || trim($_POST[$champ]) === '') {
        $erreurs[] = "Le champ « $champ » est manquant ou vide.";
    }
}

if (empty($erreurs)) {
    $nom       = trim($_POST['nom']);
    $note_info = $_POST['note_info'];
    $note_math = $_POST['note_math'];

    // 2) les notes sont numériques et comprises entre NOTE_MIN et NOTE_MAX
    foreach (['note_info' => $note_info, 'note_math' => $note_math] as $champ => $valeur) {
        if (!is_numeric($valeur)) {
            $erreurs[] = "« $champ » doit être un nombre.";
        } elseif ($valeur < NOTE_MIN || $valeur > NOTE_MAX) {
            $erreurs[] = "« $champ » doit être comprise entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
        }
    }
}

if (empty($erreurs)) {
    $note_info = (float) $note_info;
    $note_math = (float) $note_math;

    // 5.1 écriture dans le CSV : mode "a" (append) = ajout en fin de fichier
    if (!is_dir('data')) {
        mkdir('data', 0755, true);
    }
    $f = fopen('data/notes.csv', 'a');
    if ($f === false) {
        echo "<p class='echec'>Impossible d'ouvrir le fichier de données.</p>";
    } else {
        // 4e argument : délimiteur ';' ; l'échappement est donné explicitement (PHP 8.4)
        fputcsv($f, [$nom, $note_info, $note_math], ';', '"', '\\');
        fclose($f);
    }
    /*
     * Q (5.1) : avec le mode "w", le fichier est TRONQUÉ (vidé) à chaque
     * ouverture : on ne garderait que le dernier apprenant saisi.
     */

    // récapitulatif protégé contre l'injection HTML
    echo "<h2>Enregistrement réussi</h2>";
    echo "<ul>";
    echo "<li>Nom : " . htmlspecialchars($nom) . "</li>";
    echo "<li>Note info : $note_info</li>";
    echo "<li>Note math : $note_math</li>";
    echo "<li>Moyenne : " . round(($note_info + $note_math) / 2, 2) . "</li>";
    echo "</ul>";
} else {
    echo "<h2 class='echec'>Erreur de saisie</h2><ul>";
    foreach ($erreurs as $e) {
        echo "<li class='echec'>" . htmlspecialchars($e) . "</li>";
    }
    echo "</ul>";
}
echo '<p><a href="saisie.html">Nouvelle saisie</a></p>';

/*
 * Q1 : POST place les données dans le corps de la requête : elles
 *      n'apparaissent ni dans l'URL, ni dans l'historique, ni dans les logs
 *      du serveur (GET les expose). POST seul ne chiffre rien : il faut HTTPS.
 * Q2 : $_REQUEST contient le contenu de $_GET, $_POST et $_COOKIE (selon
 *      request_order, par défaut GP : GET puis POST). À éviter : on ne sait
 *      pas d'où vient la valeur.
 */
include 'includes/pied_inc.php';
