<!doctype html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>XAMPP Custom Dashboard</title>
<style>
:root{--bg:#0b1020;--bg2:#0f1528;--text:#e8ecf1;--muted:#9fb3c8;--border:#24314a;--chip:#22304a;--chip2:#2b3f62;--btn:#141b2f;--btnh:#1a233b;--ok:#19c37d;--err:#ff5a5f;--inf:#2a7bd5;--toastbg:#0f1528}
.light{--bg:#f3f6fb;--bg2:#ffffff;--text:#0c1a2b;--muted:#4c667d;--border:#c9d6e2;--chip:#e7eef6;--chip2:#c9d6e2;--btn:#eef4fb;--btnh:#e2edf9;--ok:#198754;--err:#d32f2f;--inf:#0d6efd;--toastbg:#ffffff}
html,body{margin:0;padding:0;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Ubuntu,Helvetica,Arial,sans-serif;background:var(--bg);color:var(--text)}
.container{max-width:1100px;margin:32px auto;padding:0 16px}
h1{font-size:28px;margin:0 0 8px;display:flex;align-items:center;gap:12px}
.logo{width:36px;height:36px}
h2{font-size:18px;margin:24px 0 8px;color:var(--muted)}
a{color:#2a7bd5;text-decoration:none}
a:hover{text-decoration:underline}
.toolbar{display:flex;flex-wrap:wrap;gap:12px;align-items:center;margin:12px 0 24px}
.btn{padding:8px 12px;border:1px solid var(--border);border-radius:8px;background:var(--btn);color:var(--text);cursor:pointer}
.btn:hover{background:var(--btnh)}
.input{padding:8px 12px;border:1px solid var(--border);border-radius:8px;background:var(--bg2);color:var(--text);min-width:220px}
.input-group{display:inline-flex;gap:8px;align-items:center}
@media (max-width:640px){ .input-group{width:100%} .input-group .input{flex:1} }
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px}
.card{border:1px solid var(--border);background:var(--bg2);border-radius:12px;padding:14px;display:flex;flex-direction:column;gap:8px;overflow:hidden}
.card h3{margin:0;font-size:16px}
.badge{display:inline-block;background:var(--chip);border:1px solid var(--chip2);color:var(--text);padding:2px 8px;border-radius:999px;font-size:12px}
.badge.path{display:block;margin-top:2px;white-space:normal;overflow-wrap:anywhere;word-break:break-word}
.meta{color:var(--muted);font-size:12px}
.header{display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap}
.links{display:flex;gap:8px;flex-wrap:wrap}
.small{font-size:12px;color:var(--muted)}
hr{border:none;border-top:1px solid var(--border);margin:24px 0}
.footer{margin:24px 0 48px}
.star{border:none;background:transparent;cursor:pointer;font-size:18px;line-height:1}
.star.fav{color:#e0b000}
.toggle{margin-left:8px}
.ignore{border:none;background:transparent;cursor:pointer;font-size:12px;line-height:1;color:#ff9c7a}
.ignore.on{color:#ff5a2a}
.warn{background:#38220f;border:1px solid #5e3c1a;color:#ffd7a1;padding:10px;border-radius:8px;margin-bottom:12px}
.kv{display:grid;grid-template-columns:160px 1fr;gap:8px;align-items:center}

/* --- Pretty Toasts --- */
.toast-container{position:fixed;right:16px;bottom:16px;display:flex;flex-direction:column;gap:10px;z-index:9999}
.toast{display:flex;align-items:flex-start;gap:10px;min-width:280px;max-width:360px;background:var(--toastbg);color:var(--text);border:1px solid var(--border);border-left:6px solid var(--inf);padding:12px 14px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.25);opacity:0;transform:translateY(20px);animation:toast-in .2s ease-out forwards}
.toast.success{border-left-color:var(--ok)}
.toast.error{border-left-color:var(--err)}
.toast .icon{font-weight:700;line-height:1.1}
.toast .msg{flex:1;font-size:14px}
.toast .close{border:none;background:transparent;color:var(--muted);cursor:pointer;font-size:18px;line-height:1;padding:0 0 0 6px}
@keyframes toast-in{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
@keyframes toast-out{from{opacity:1;transform:translateY(0)}to{opacity:0;transform:translateY(10px)}}
</style>
</head>
<body>
<div class="container" id="root">
  <div class="header">
    <h1>
      <!-- Logo: aufrechtes W -->
      <svg class="logo" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <defs>
          <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#ff8a00"/><stop offset="100%" stop-color="#ff4d00"/>
          </linearGradient>
        </defs>
        <rect x="2" y="2" width="60" height="60" rx="14" fill="url(#g)" />
        <!-- W: oben-unten-oben-unten-oben -->
        <path d="M16 20 L24 44 L32 20 L40 44 L48 20"
              fill="none" stroke="#fff" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      XAMPP Custom Dashboard <span class="small">W. Saal</span>
    </h1>
    <div class="links">
              <a class="btn" href="/index.php?action=phpinfo" target="_blank" rel="noopener">phpinfo()</a>
              <a class="btn" href="/phpmyadmin/" target="_blank" rel="noopener">phpMyAdmin</a>
              <a class="btn" href="/dashboard/" target="_blank" rel="noopener">XAMPP Dashboard</a>
            <a class="btn" href="/index.php?admin=1">Admin</a>
      <button class="btn toggle" id="themeToggle" type="button">Hell/Dunkel</button>
    </div>
  </div>

      <form class="toolbar" method="get" action="">
      <span class="input-group">
        <input class="input" type="search" name="q" placeholder="Projekte suchen…" value="">
        <button class="btn" type="button" onclick="const f=this.closest('form'); f.q.value=''; f.submit();" title="Suchfeld leeren">Suche zurücksetzen</button>
      </span>
      <select class="input" name="sort" onchange="this.form.submit()">
        <option value="name" selected>Sortierung: Name/Titel</option>
        <option value="time" >Sortierung: Zuletzt geändert</option>
        <option value="fav"  >Sortierung: Favoriten zuerst</option>
      </select>
      <select class="input" name="view" onchange="this.form.submit()">
        <option value="all"      selected>Ansicht: Alle</option>
        <option value="favs"     >Ansicht: Favoriten</option>
        <option value="ignored"  >Ansicht: Ignorierte</option>
      </select>
      <button class="btn" type="submit">Aktualisieren</button>
    </form>

    
    <h2>Gefundene Projekte (7)</h2>
    <div class="grid">
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/website/Colournator/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/website/Colournator">
          <h3>Colournator</h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/website/Colournator</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-30 12:56</div>
          <div class="links">
            <a class="btn" href="/website/Colournator/index.html" target="_blank" rel="noopener">Öffnen ↗</a>
            <a class="btn" href="/index.php?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FColournator">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FColournator">In VS Code öffnen</a>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
            <button class="ignore " title="Ignorieren" aria-label="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/website/DienstOrbit/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/website/DienstOrbit">
          <h3>DienstOrbit</h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/website/DienstOrbit</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-31 08:12</div>
          <div class="links">
            <a class="btn" href="/website/DienstOrbit/index.html" target="_blank" rel="noopener">Öffnen ↗</a>
            <a class="btn" href="/index.php?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FDienstOrbit">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FDienstOrbit">In VS Code öffnen</a>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
            <button class="ignore " title="Ignorieren" aria-label="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/website/SchoensteZeit/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/website/SchoensteZeit">
          <h3>Ferien &amp; Feiertage</h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/website/SchoensteZeit</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-23 15:29</div>
          <div class="links">
            <a class="btn" href="/website/SchoensteZeit/index.html" target="_blank" rel="noopener">Öffnen ↗</a>
            <a class="btn" href="/index.php?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FSchoensteZeit">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FSchoensteZeit">In VS Code öffnen</a>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
            <button class="ignore " title="Ignorieren" aria-label="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/website/KoordinatenWerk/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/website/KoordinatenWerk">
          <h3>KoordinatenWerk</h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/website/KoordinatenWerk</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-30 17:55</div>
          <div class="links">
            <a class="btn" href="/website/KoordinatenWerk/index.html" target="_blank" rel="noopener">Öffnen ↗</a>
            <a class="btn" href="/index.php?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FKoordinatenWerk">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FKoordinatenWerk">In VS Code öffnen</a>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
            <button class="ignore " title="Ignorieren" aria-label="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/website/Taktische-Zeit/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/website/Taktische-Zeit">
          <h3>Taktische Zeit</h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/website/Taktische-Zeit</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-29 14:10</div>
          <div class="links">
            <a class="btn" href="/website/Taktische-Zeit/index.html" target="_blank" rel="noopener">Öffnen ↗</a>
            <a class="btn" href="/index.php?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FTaktische-Zeit">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FTaktische-Zeit">In VS Code öffnen</a>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
            <button class="ignore " title="Ignorieren" aria-label="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/website/THW-Funkruf/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/website/THW-Funkruf">
          <h3>THW Funkrufnamen – Suche &amp; Generator</h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/website/THW-Funkruf</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-21 14:51</div>
          <div class="links">
            <a class="btn" href="/website/THW-Funkruf/index.html" target="_blank" rel="noopener">Öffnen ↗</a>
            <a class="btn" href="/index.php?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FTHW-Funkruf">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite%2FTHW-Funkruf">In VS Code öffnen</a>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
            <button class="ignore " title="Ignorieren" aria-label="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/website/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/website">
          <h3>Wolfgang Saal</h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/website</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-30 13:36</div>
          <div class="links">
            <a class="btn" href="/website/index.html" target="_blank" rel="noopener">Öffnen ↗</a>
            <a class="btn" href="/index.php?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Fwebsite">In VS Code öffnen</a>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
            <button class="ignore " title="Ignorieren" aria-label="Ignorieren">Ignorieren</button>
          </div>
        </div>
          </div>
    

    <hr>
    <div class="footer small">
      Scan: <span class="badge">/Applications/XAMPP/xamppfiles/htdocs</span>  ·
      Tiefe: <span class="badge">5</span> ·
      Ignoriert (Namen): <span class="badge">.git, vendor, node_modules, tmp, cache, logs, xampp, bitnami, .DS_Store, dashboard, src, secure</span> ·
      Ignoriert (Pfade): <span class="badge">17 Einträge</span> ·
      Auto-Fav (htdocs): <span class="badge">an</span>
    </div>

    <div class="footer small" style="text-align:center; margin-top:32px; padding:12px; border:1px solid var(--border); border-radius:12px; background:var(--bg2); opacity:0.9">
      © 2025 Wolfgang Saal · 
      <a href="https://opensource.org/licenses/MIT" target="_blank" rel="noopener">MIT-Lizenz</a> · 
      <a href="https://github.com/wsaal68" target="_blank" rel="noopener">GitHub</a>
    </div>



  </div>

<!-- Toasts Container -->
<div class="toast-container" id="toasts" aria-live="polite" aria-atomic="true"></div>

<script>
// Theme toggle
(function(){
  const root = document.documentElement, key='xd_theme';
  function apply(t){ if(t==='light'){ root.classList.add('light'); } else { root.classList.remove('light'); } }
  const saved = localStorage.getItem(key) || 'dark'; apply(saved);
  const btn = document.getElementById('themeToggle');
  if (btn) btn.addEventListener('click', ()=>{
    const cur = document.documentElement.classList.contains('light') ? 'light' : 'dark';
    const next = cur==='light' ? 'dark' : 'light';
    localStorage.setItem(key, next); apply(next);
    showToast('info','Theme auf <b>'+ (next==='light'?'Light':'Dark') +'</b> umgestellt.');
  });
})();

// --- Pretty Toasts ---
function showToast(type, html, opts){
  const c = document.getElementById('toasts');
  const t = document.createElement('div');
  t.className = 'toast ' + (type||'info');
  const icon = type==='success' ? '✓' : (type==='error' ? '⚠' : 'ℹ');
  t.innerHTML = '<div class="icon">'+icon+'</div><div class="msg">'+html+'</div><button class="close" aria-label="Schließen">×</button>';
  c.appendChild(t);

  const close = ()=>{ t.style.animation='toast-out .18s ease-in forwards'; setTimeout(()=>t.remove(), 180); };
  t.querySelector('.close').addEventListener('click', close);
  setTimeout(close, (opts?.duration ?? 2800));
}

// Fav toggle
document.querySelectorAll('.card .star').forEach(btn=>{
  btn.addEventListener('click', ev=>{
    ev.preventDefault();
    const card = ev.target.closest('.card');
    const path = card.getAttribute('data-path');
    fetch('?action=fav', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'path='+encodeURIComponent(path)})
      .then(r=>r.json()).then(d=>{
        if(!d.ok){ showToast('error','Konnte Favorit nicht speichern: '+(d.err||'')); return; }
        const on = d.fav;
        btn.classList.toggle('fav', on); btn.textContent = on ? '★' : '☆';
        showToast('success', on ? 'Als Favorit gespeichert.' : 'Favorit entfernt.');
      }).catch(e=>showToast('error','Fehler: '+e));
  });
});

// Ignore toggle
document.querySelectorAll('.card .ignore').forEach(btn=>{
  btn.addEventListener('click', ev=>{
    ev.preventDefault();
    const card = ev.target.closest('.card');
    const dir  = card.getAttribute('data-dir');
    fetch('?action=ignore', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'dir='+encodeURIComponent(dir)})
      .then(r=>r.json()).then(d=>{
        if(!d.ok){ showToast('error','Konnte Ignorieren nicht speichern: '+(d.err||'')); return; }
        btn.classList.toggle('on', d.ignored);
        btn.textContent = d.ignored ? 'Ignoriert' : 'Ignorieren';
        const url = new URL(window.location.href); const view = url.searchParams.get('view') || 'all';
        if (view !== 'ignored' && d.ignored) card.style.display='none';
        if (view === 'ignored' && !d.ignored) card.style.display='none';
        showToast('success', d.ignored ? 'Ordner wird nun ignoriert.' : 'Ordner nicht mehr ignoriert.');
      }).catch(e=>showToast('error','Fehler: '+e));
  });
});

// Admin behaviors
const saveDepth = document.getElementById('saveDepth');
if (saveDepth) {
  saveDepth.addEventListener('click', ()=>{
    const depth = document.getElementById('depthSel').value;
    fetch('?action=set_depth', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'depth='+encodeURIComponent(depth)})
      .then(r=>r.json()).then(d=>{
        if(!d.ok) showToast('error','Speichern fehlgeschlagen: '+(d.err||'')); else { showToast('success','Max. Tiefe gespeichert: <b>'+d.depth+'</b>'); setTimeout(()=>location.reload(), 300); }
      })
      .catch(e=>showToast('error','Fehler: '+e));
  });
}
const toggleAF = document.getElementById('toggleAutoFav');
if (toggleAF) {
  toggleAF.addEventListener('click', ()=>{
    fetch('?action=toggle_autofav').then(r=>r.json()).then(d=>{
      if(!d.ok) showToast('error','Speichern fehlgeschlagen: '+(d.err||'')); else { showToast('success','Auto-Fav: <b>'+ (d.auto_fav?'an':'aus') +'</b>'); setTimeout(()=>location.reload(), 300); }
    }).catch(e=>showToast('error','Fehler: '+e));
  });
}
const makeWr = document.getElementById('makeWritable');
if (makeWr) {
  makeWr.addEventListener('click', ()=>{
    fetch('?action=make_writable').then(r=>r.json()).then(d=>{
      if(!d.ok) showToast('error','Setzen fehlgeschlagen (evtl. fehlende Rechte).');
      else showToast('success','Rechte gesetzt (u+rwX).');
    }).catch(e=>showToast('error','Fehler: '+e));
  });
}
document.querySelectorAll('[data-unignore]').forEach(btn=>{
  btn.addEventListener('click', ()=>{
    const dir = btn.getAttribute('data-unignore');
    fetch('?action=ignore', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'dir='+encodeURIComponent(dir)})
      .then(r=>r.json()).then(d=>{ if(!d.ok) showToast('error','Fehler: '+(d.err||'')); else { showToast('success','Eintrag wieder aktiviert.'); setTimeout(()=>location.reload(), 200); } })
      .catch(e=>showToast('error','Fehler: '+e));
  });
});
</script>
</body>
</html>
