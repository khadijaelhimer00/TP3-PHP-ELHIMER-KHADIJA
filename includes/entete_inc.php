<?php
/*
 * Auteur : KHADIJA EL HIMER 
 * Objectif : en-tête commun des pages 
 * Date : 18/10/2026
 */
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars(ETABLISSEMENT) ?> - Suivi des notes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; }
        th, td { border: 1px solid #888; padding: 4px 10px; }
        th { background: #eee; }
        .echec { color: red; }
        nav a { margin-right: 12px; }
    </style>
</head>
<body>
<header>
    <h1><?= htmlspecialchars(ETABLISSEMENT) ?></h1>
    <h2>Suivi des notes des apprenants</h2>
</header>
