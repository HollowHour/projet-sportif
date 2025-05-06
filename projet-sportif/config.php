<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect('localhost','root','','sport');
if (!$conn) {
  die('Erreur BDD: ' . mysqli_connect_error());
}
