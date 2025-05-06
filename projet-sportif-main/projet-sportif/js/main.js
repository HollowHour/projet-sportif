// js/main.js

document.addEventListener('DOMContentLoaded', () => {
  console.log('▶️ main.js chargé');

  // Références DOM
  const fm           = document.getElementById('act-form');
  const sp           = document.getElementById('sport');
  const distLabel    = document.getElementById('dist-label');
  const distIn       = document.getElementById('distance');
  const fl           = document.getElementById('filter');
  const tb           = document.querySelector('#activities-table tbody');
  const t5           = document.getElementById('top5');
  const msg          = document.getElementById('msg');
  const metricSelect = document.getElementById('metricSelect');
  const canvasEl     = document.getElementById('activityChart');
  if (!canvasEl) console.error('❌ #activityChart introuvable');
  const ctx     = canvasEl?.getContext('2d');
  let chart;

  // Check Chart.js presence
  if (typeof Chart === 'undefined') {
    console.error('❌ Chart.js non chargé');
  } else {
    console.log('✅ Chart.js OK');
  }

  // 1. Label dynamique
  function updateLabel() {
    distLabel.textContent = sp.value === 'muscu'
      ? 'Charge (kg)'
      : 'Distance (km)';
    distIn.placeholder = distLabel.textContent;
  }
  sp.addEventListener('change', updateLabel);
  updateLabel();

  // 2. Soumission activité
  fm.addEventListener('submit', e => {
    e.preventDefault();
    console.log('🔄 Envoi activité via AJAX');
    fetch('save_activity.php', {
      method: 'POST',
      body: new FormData(fm)
    })
    .then(r => r.text())
    .then(txt => {
      console.log('🛠 save_activity.php →', txt);
      msg.textContent = txt === 'ok'
        ? '✅ Activité ajoutée'
        : '❌ Erreur';
      loadAll();
    })
    .catch(err => console.error('❌ Erreur fetch save_activity:', err));
  });

  // 3. Filtre
  fl.addEventListener('change', loadAll);

  // 4. Chargement des activités + leaderboard
  function loadAll() {
    console.log('🔄 loadAll()');
    // Activités
    let url = 'get_activities.php';
    if (fl.value) url += '?sport=' + encodeURIComponent(fl.value);
    fetch(url)
      .then(r => r.json())
      .then(data => {
        console.log('📋 get_activities data:', data);
        tb.innerHTML = '';
        data.forEach(a => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${a.date}</td>
            <td>${a.sport}</td>
            <td>${a.distance}</td>
            <td>${a.duration}</td>
            <td>${a.calories}</td>
            <td>${a.pseudo}</td>
          `;
          tb.appendChild(tr);
        });
      })
      .catch(err => console.error('❌ Erreur fetch get_activities:', err));

    // Leaderboard
    fetch('get_leaderboard.php')
      .then(r => r.json())
      .then(data => {
        console.log('🏆 get_leaderboard data:', data);
        t5.innerHTML = '';
        data.forEach(u => {
          const li = document.createElement('li');
          li.textContent = `${u.pseudo} – ${u.total_cal} cal`;
          t5.appendChild(li);
        });
      })
      .catch(err => console.error('❌ Erreur fetch get_leaderboard:', err));
  }

  loadAll();
  setInterval(loadAll, 5000);

  // 5. Graphique Chart.js
  function loadChart() {
    console.log('📊 loadChart()');
    fetch('get_user_activities.php')
      .then(r => r.json())
      .then(data => {
        console.log('📈 get_user_activities data:', data);
        const now      = new Date();
        const monthAgo = new Date(now.getFullYear(), now.getMonth() - 1, now.getDate());
        const recent   = data.filter(a => new Date(a.date) >= monthAgo);

        const labels = recent.map(a => a.date.substring(0, 10));
        const metric = metricSelect.value;
        const values = recent.map(a => {
          switch(metric) {
            case 'speed':
              return a.duration > 0
                ? (a.distance / a.duration) * 60
                : 0;
            case 'distance': return a.distance;
            case 'duration': return a.duration;
            case 'calories': return a.calories;
            default: return 0;
          }
        });

        if (chart) chart.destroy();
        chart = new Chart(ctx, {
          type: 'line',
          data: {
            labels,
            datasets: [{
              label: metricSelect.options[metricSelect.selectedIndex].text,
              data: values,
              fill: false,
              tension: 0.2,
              borderColor: getComputedStyle(document.documentElement)
                             .getPropertyValue('--accent').trim(),
              pointBackgroundColor: getComputedStyle(document.documentElement)
                             .getPropertyValue('--accent-light').trim()
            }]
          },
          options: {
            responsive: true,
            scales: {
              x: { display: true },
              y: { beginAtZero: true }
            }
          }
        });
      })
      .catch(err => console.error('❌ Erreur fetch get_user_activities:', err));
  }

  metricSelect.addEventListener('change', loadChart);
  loadChart();
});
