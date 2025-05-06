<?php session_start(); ?>
<nav>
  <?php if(isset($_SESSION['id'])): ?>
    <a href="dashboard.php">Dashboard</a>
    <a href="logout.php">Déconnexion</a>
  <?php else: ?>
    <a href="login.php">Connexion</a>
    <a href="register.php">Inscription</a>
  <?php endif; ?>
</nav>