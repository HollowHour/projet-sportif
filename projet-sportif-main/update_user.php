<?php
// update_user.php
session_start();
include 'config.php';
header('Content-Type: application/json');

if (empty($_SESSION['id'])) {
  echo json_encode(['success' => false, 'error' => 'Non authentifié']);
  exit;
}

$id = (int) $_SESSION['id'];
$p  = mysqli_real_escape_string($conn, $_POST['pseudo']);
$e  = mysqli_real_escape_string($conn, $_POST['email']);

// Construire la clause SET
$sets = [
  "pseudo = '$p'",
  "email  = '$e'"
];

if (!empty($_POST['pass'])) {
  $h = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  $sets[] = "pass = '$h'";
}

$sql = "UPDATE users SET " . implode(', ', $sets) . " WHERE id = $id";
$res = mysqli_query($conn, $sql);

if ($res) {
  $_SESSION['pseudo'] = $p;
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
