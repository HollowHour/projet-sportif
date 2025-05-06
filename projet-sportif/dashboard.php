<?php
session_start();
if (empty($_SESSION['id'])) {
  header('Location: login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <?php include 'header.php'; ?>
  <main>

    <!-- 1. Ajouter une activité -->
    <section>
      <h3>Ajouter une activité</h3>
      <form id="act-form">
        <label for="sport">Sport</label>
        <select name="sport" id="sport">
          <option value="course">Course</option>
          <option value="vélo">Vélo</option>
          <option value="muscu">Muscu</option>
        </select>

        <label id="dist-label" for="distance">Distance (km)</label>
        <input type="number" name="distance" id="distance"
               placeholder="Distance (km)" required>

        <label for="duration">Durée (min)</label>
        <input type="number" name="duration" id="duration"
               placeholder="Durée (min)" required>

        <label for="calories">Calories</label>
        <input type="number" name="calories" id="calories"
               placeholder="Calories" required>

        <label for="date">Date</label>
        <input type="datetime-local" name="date" id="date" required>

        <button type="submit">Ajouter</button>
      </form>
      <div id="msg"></div>
    </section>

   
    <!-- 2. Activités récentes -->
<section class="activities-section">
  <h3>Activités récentes</h3>
  <select id="filter">
    <option value="">Tous</option>
    <option value="course">Course</option>
    <option value="vélo">Vélo</option>
    <option value="muscu">Muscu</option>
  </select>
  <div class="table-wrapper">
    <table id="activities-table">
      <thead>
        <tr>
          <th>Date</th><th>Sport</th><th>Dist./Charge</th>
          <th>Durée</th><th>Cal</th><th>Utilisateur</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</section>

    <!-- 3. Top 5 -->
    <section>
      <h3>Top 5 (calories ce mois)</h3>
      <ul id="top5"></ul>
    </section>

    <!-- 4. Statistiques -->
    <section id="stats">
      <h3>Statistiques (dernier mois)</h3>
      <label for="metricSelect">Métrique :</label>
      <select id="metricSelect">
        <option value="speed">Vitesse (km/h)</option>
        <option value="distance">Distance (km)</option>
        <option value="duration">Durée (min)</option>
        <option value="calories">Calories</option>
      </select>
      <canvas id="activityChart"></canvas>
    </section>

  </main>
  <?php include 'footer.php'; ?>
  <script src="js/main.js"></script>
</body>
</html>

