<?php
session_start();
if (!isset($_SESSION['id'])) header('Location: login.php');
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="css/style.css"></head><body>
<?php include 'header.php';?>
<h2>Bienvenue, <?= htmlentities($_SESSION['pseudo']) ?> !</h2>

<h3>Ajouter une activité</h3>
<form id="act-form">
  <select name="sport"><option>course</option><option>vélo</option><option>muscu</option></select><br>
  <input name="distance" placeholder="km" required><br>
  <input name="duration" placeholder="min" required><br>
  <input name="calories" placeholder="cal" required><br>
  <input name="date" type="datetime-local" required><br>
  <button>Ajouter</button>
</form>
<div id="msg"></div>

<h3>Activités récentes</h3>
<select id="filter">
  <option value="">Tous</option>
  <option>course</option><option>vélo</option><option>muscu</option>
</select>
<table border="1"><thead><tr><th>Date</th><th>Sport</th><th>Dist</th><th>Durée</th><th>Cal</th><th>User</th></tr></thead><tbody></tbody></table>

<h3>Top 5 ce mois</h3>
<ul id="top5"></ul>

<?php include 'footer.php';?>
<script src="js/main.js"></script>
</body></html>