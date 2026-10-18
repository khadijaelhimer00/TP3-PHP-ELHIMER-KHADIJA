<?php
session_start();
/*
 * Auteur : KHADIJA EL HIMER
 * Objectif : déconnexion (vider et détruire la session)
 * Date : 18/10/2026
 */
session_unset();     // supprime les variables de session
session_destroy();   // détruit la session côté serveur
header("Location: login.php");
exit;
