<?php
/*
 * Auteur : KHADIJA EL HIMER 
 * Objectif : exporter les résultats en JSON, relire, comparer avec serialize()
 * Date : 18/10/2026
 */
require_once 'config.php';
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

// 1) tableau associatif des résultats construit depuis le CSV
$resultats = [];
if (file_exists('data/notes.csv') && ($f = fopen('data/notes.csv', 'r')) !== false) {
    while (($l = fgetcsv($f, 0, ';', '"', '\\')) !== false) {
        if (count($l) < 3) { continue; }
        $resultats[] = [
            'nom'     => $l[0],
            'info'    => (float) $l[1],
            'math'    => (float) $l[2],
            'moyenne' => ($l[1] + $l[2]) / 2,
        ];
    }
    fclose($f);
}

// 2) écriture JSON
$json = json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('data/notes.json', $json);

// 3) relecture
$relu = json_decode(file_get_contents('data/notes.json'), true);
echo "<h2>Contenu relu (print_r)</h2><pre>";
print_r($relu);
echo "</pre>";

// 4) comparaison des formats
echo "<h2>serialize()</h2><pre>" . htmlspecialchars(serialize($resultats)) . "</pre>";
echo "<h2>json_encode()</h2><pre>" . htmlspecialchars($json) . "</pre>";
/*
 * Q : JSON est directement exploitable par JavaScript (JSON.parse).
 * serialize() est un format propre à PHP (types et longueurs inclus),
 * lisible seulement par unserialize() ; à ne jamais appliquer à des
 * données non fiables (risque d'injection d'objets).
 */
include 'includes/pied_inc.php';
