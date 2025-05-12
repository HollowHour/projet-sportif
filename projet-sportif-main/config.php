<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

// sign in MySQL
$conn = mysqli_connect(
  'localhost',  // hôte
  'root',       // user
  '',           // mdp root 
  'sport'       // nom de base
);
if (!$conn) {
  die('Erreur BDD : '.mysqli_connect_error());
}