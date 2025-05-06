<?php
// Affiche toutes les erreurs (pour dev)
ini_set('display_errors',1);
error_reporting(E_ALL);

// Connexion MySQL
$conn = mysqli_connect(
  'localhost',  // hôte
  'root',       // utilisateur
  '',           // mot de passe root (vide par défaut)
  'sport'       // nom de la base
);
if (!$conn) {
  die('Erreur BDD : '.mysqli_connect_error());
}