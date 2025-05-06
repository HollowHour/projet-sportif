document.addEventListener('DOMContentLoaded', ()=>{
    const fm = document.getElementById('act-form');
    const sp = document.getElementById('sport');
    const distLabel = document.getElementById('dist-label');
    const distIn = document.getElementById('distance');
    const fl = document.getElementById('filter');
    const tb = document.querySelector('tbody');
    const t5 = document.getElementById('top5');
    const msg = document.getElementById('msg');
  
    // Adaptation label selon sport
    function updateLabel(){
      if(sp.value==='muscu'){
        distLabel.textContent = 'Charge (kg)';
        distIn.placeholder = 'Charge (kg)';
      } else {
        distLabel.textContent = 'Distance (km)';
        distIn.placeholder = 'Distance (km)';
      }
    }
    sp.addEventListener('change', updateLabel);
    updateLabel();
  
    fm.addEventListener('submit', e=>{
      e.preventDefault();
      fetch('save_activity.php',{ method:'POST', body:new FormData(fm) })
        .then(r=>r.text()).then(txt=>{
          msg.textContent = txt==='ok' ? '✅ Activité ajoutée' : '❌ Erreur';
          loadAll();
        });
    });
    fl.addEventListener('change', loadAll);
  
    function loadAll(){
      let url = 'get_activities.php';
      if(fl.value) url += '?sport='+encodeURIComponent(fl.value);
      fetch(url).then(r=>r.json()).then(data=>{
        tb.innerHTML='';
        data.forEach(a=>{
          const tr = document.createElement('tr');
          tr.innerHTML =`
            <td>${a.date}</td>
            <td>${a.sport}</td>
            <td>${a.distance}</td>
            <td>${a.duration}</td>
            <td>${a.calories}</td>
            <td>${a.pseudo}</td>`;
          tb.appendChild(tr);
        });
      });
      fetch('get_leaderboard.php')
        .then(r=>r.json()).then(data=>{
          t5.innerHTML='';
          data.forEach(u=>{
            const li = document.createElement('li');
            li.textContent = `${u.pseudo} – ${u.total_cal} cal`;
            t5.appendChild(li);
          });
        });
    }
  
    loadAll();
    setInterval(loadAll,5000);
  });