<?php
session_start();
header('Content-Type: application/json');
include 'config.php';

if (empty($_SESSION['id'])) {
  echo json_encode(['error'=>'Non authentifié']);
  exit;
}

$id = (int)$_SESSION['id'];
$res = mysqli_query($conn, "
  SELECT pseudo, email
  FROM users
  WHERE id = $id
  LIMIT 1
");
$user = mysqli_fetch_assoc($res) ?: [];
echo json_encode($user);
