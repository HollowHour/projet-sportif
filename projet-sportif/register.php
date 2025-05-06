<?php
session_start();
include 'config.php';

if ($_POST) {
  $pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
  $email  = mysqli_real_escape_string($conn, $_POST['email']);
  $pass   = $_POST['pass'];

  // 1) Vérifier que l'email et le pseudo n'existent pas déjà
  $sql = "SELECT COUNT(*) AS cnt
          FROM users
          WHERE email = '$email'
             OR pseudo = '$pseudo'";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);
  if ($row['cnt'] > 0) {
    $error = 'Ce pseudo ou cet e-mail est déjà utilisé.';
  } else {
    // 2) Si OK, hasher puis insérer
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    mysqli_query(
      $conn,
      "INSERT INTO users(pseudo,email,pass)
       VALUES('$pseudo','$email','$hash')"
    );
    header('Location: login.php');
    exit;
  }
}
?>
<!DOCTYPE html><html><head>…</head><body>
<?php include 'header.php'; ?>
<h2>Inscription</h2>
<?php if(isset($error)): ?>
  <p style="color:red;"><?= $error ?></p>
<?php endif; ?>
<form method="post">
  <!-- vos champs -->
</form>
<?php include 'footer.php'; ?>
</body></html>
