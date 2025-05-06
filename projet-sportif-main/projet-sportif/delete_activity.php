<?php
// delete_activity.php
session_start();
include 'config.php';
header('Content-Type: application/json');

if (empty($_SESSION['id']) || !isset($_POST['id'])) {
  echo json_encode(['success' => false]);
  exit;
}

$id  = (int) $_POST['id'];
$uid = (int) $_SESSION['id'];

$sql = "DELETE FROM activities WHERE id = $id AND user_id = $uid";
$res = mysqli_query($conn, $sql);

echo json_encode(['success' => (bool)$res]);
