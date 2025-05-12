document.addEventListener('DOMContentLoaded', ()=> {
    const uf      = document.getElementById('user-form');
    const umsg    = document.getElementById('user-msg');
    const tbody   = document.getElementById('profile-acts');
  
    // afficher infos de l'user
    fetch('get_user.php')
      .then(r=>r.json())
      .then(u=>{
        if(u.pseudo) {
          uf.pseudo.value = u.pseudo;
          uf.email.value  = u.email;
        } else {
          umsg.textContent = 'Erreur de chargement.';
        }
      });
  
    // enregistrer les modifications a l'util
    uf.addEventListener('submit', e=>{
      e.preventDefault();
      fetch('update_user.php', {
        method: 'POST',
        body: new FormData(uf)
      })
      .then(r=>r.json())
      .then(json=>{
        umsg.textContent = json.success
          ? '✅ Profil mis à jour'
          : ('❌ ' + (json.error||'Erreur'));
        if (json.success) {
          // mettre à jour le pseudo pour header
          document.querySelector('nav a[href="dashboard.php"]').textContent =
            'Dashboard (‘' + uf.pseudo.value + '’)';
        }
      });
    });
  
    // charger activites de l’utilisateur
    function loadActs() {
      fetch('get_user_activities.php')
        .then(r=>r.json())
        .then(data=>{
          tbody.innerHTML = '';
          data.forEach(a=>{
            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td>${a.date}</td>
              <td>${a.sport}</td>
              <td>${a.distance}</td>
              <td>${a.duration}</td>
              <td>${a.calories}</td>
              <td>
                <button class="del" data-id="${a.id}">🗑️</button>
              </td>`;
            tbody.appendChild(tr);
          });
          attachDel();
        });
    }
  
    // suppression
    function attachDel() {
      tbody.querySelectorAll('.del').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          if(!confirm('Confirmer la suppression ?')) return;
          fetch('delete_activity.php', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'id=' + btn.dataset.id
          })
          .then(r=>r.json())
          .then(j=>{
            if (j.success) loadActs();
          });
        });
      });
    }
  
    loadActs();
  });
  