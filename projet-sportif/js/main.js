document.addEventListener('DOMContentLoaded',()=>{
    const fm = document.getElementById('act-form');
    const fl = document.getElementById('filter');
    const tb = document.querySelector('tbody');
    const t5 = document.getElementById('top5');
    const msg = document.getElementById('msg');
    // envoi activité
    fm.onsubmit = e=>{
      e.preventDefault();
      fetch('save_activity.php',{method:'POST',body:new FormData(fm)})
        .then(()=>{ msg.textContent='Ajouté'; load(); });
    };
    // filtre et reload
    fl.onchange = load;
    // fonctions
    function load(){
      // act
      let url='get_activities.php';
      if(fl.value) url+='?sport='+fl.value;
      fetch(url).then(r=>r.json()).then(d=>{
        tb.innerHTML='';
        d.forEach(a=>{
          let tr=document.createElement('tr');
          tr.innerHTML=`<td>${a.date}</td><td>${a.sport}</td>
  <td>${a.distance}</td><td>${a.duration}</td><td>${a.calories}</td>
  <td>${a.pseudo}</td>`;
          tb.appendChild(tr);
        });
      });
      // top5
      fetch('get_leaderboard.php').then(r=>r.json()).then(d=>{
        t5.innerHTML='';
        d.forEach(u=>{
          let li=document.createElement('li');
          li.textContent=`${u.pseudo} – ${u.tot} km`;
          t5.appendChild(li);
        });
      });
    }
    load();
    setInterval(load,5000);
  });