<?php
session_start(); include 'config.php';
if (!isset($_SESSION['id'])) exit;
$s = $_POST['sport']; $d = $_POST['distance'];
$t = $_POST['duration']; $c = $_POST['calories'];
$dt = $_POST['date'];
mysqli_query($conn,"INSERT INTO activities(user_id,sport,distance,duration,calories,date)
 VALUES({$_SESSION['id']},'$s',$d,$t,$c,'$dt')");
echo 'ok';