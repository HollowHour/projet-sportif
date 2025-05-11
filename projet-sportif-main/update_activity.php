<?php
// update_activity.php
session_start();
include 'config.php';
header('Content-Type: application/json');

if (empty($_SESSION['id']) || !isset($_POST['id'])) {
  echo json_encode(['success' => false]);
  exit;
}

$id       = (int) $_POST['id'];
$uid      = (int) $_SESSION['id'];
$sport    = mysqli_real_escape_string($conn, $_POST['sport']);
$distance = (float) $_POST['distance'];
$duration = (int) $_POST['duration'];
$calories = (int) $_POST['calories'];
$date     = mysqli_real_escape_string($conn, $_POST['date']);

$sql = "
  UPDATE activities SET
    sport    = '$sport',
    distance = $distance,
    duration = $duration,
    calories = $calories,
    date     = '$date'
  WHERE id = $id AND user_id = $uid
";
$res = mysqli_query($conn, $sql);

if ($res) {
  echo json_encode([
    'success'  => true,
    'activity' => [
      'id'       => $id,
      'sport'    => $sport,
      'distance' => $distance,
      'duration' => $duration,
      'calories' => $calories,
      'date'     => $date
    ]
  ]);
} else {
  echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
