<?php
session_start();
include 'config.php';
if ($_POST) {
  $e = mysqli_real_escape_string($conn,$_POST['email']);
  $r = mysqli_query($conn, "SELECT * FROM users WHERE email='$e'");
  if ($u = mysqli_fetch_assoc($r)) {
    if (password_verify($_POST['pass'],$u['pass'])) {
      $_SESSION['id']=$u['id'];
      $_SESSION['pseudo']=$u['pseudo'];
      header('Location: dashboard.php'); exit;
    }
  }
  $err = 'Email ou mot de passe incorrect';
}
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="css/style.css"></head><body>
<?php include 'header.php';?>
<h2>Connexion</h2>
<?php if(isset($err)) echo "<p style='color:red;'>$err</p>"; ?>
<form method="post">
  <input name="email" type="email" placeholder="Email" required><br>
  <input name="pass" type="password" placeholder="Mot de passe" required><br>
  <button>Se connecter</button>
</form>
<?php include 'footer.php';?>
</body></html>