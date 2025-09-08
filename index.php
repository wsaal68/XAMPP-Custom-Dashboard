<!doctype html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Custom Dashboard</title>
<style>
:root{
  --bg:#0b1020;--bg2:#0f1528;--text:#e8ecf1;--muted:#9fb3c8;--border:#24314a;
  --chip:#22304a;--chip2:#2b3f62;--btn:#141b2f;--btnh:#1a233b;
  --ok:#19c37d;--err:#ff5a5f;--inf:#2a7bd5;--toastbg:#0f1528;
  --open-bg:#2a7bd5;--open-hg:#246bc0;--ign-bg:#8a2430;--ign-hg:#76202a;
  --shadow:0 6px 18px rgba(0,0,0,.28);
  --accent:#ff7a1a; /* Logo-Orange */
}
.light{
  --bg:#f3f6fb;--bg2:#ffffff;--text:#0c1a2b;--muted:#4c667d;--border:#c9d6e2;
  --chip:#e8f0fa;--chip2:#d6e3f1;--btn:#eef4fb;--btnh:#e7effa;
  --ok:#198754;--err:#d32f2f;--inf:#0d6efd;--toastbg:#ffffff;
  --open-bg:#0d6efd;--open-hg:#0b5ed7;
  --shadow:0 6px 18px rgba(0,0,0,.12);
  --accent:#ff7a1a;
}
html,body{margin:0;padding:0;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Ubuntu,Helvetica,Arial,sans-serif;background:var(--bg);color:var(--text)}
.container{max-width:1100px;margin:32px auto;padding:0 16px}
h1{margin:0 0 8px;display:flex;align-items:center;gap:12px}
.logo{width:36px;height:36px;flex:0 0 36px}
.title-wrap{display:flex;flex-direction:column;line-height:1.1}
.title-text{font-size:28px}
.ver{color:var(--muted);margin-top:2px;display:block}
.env-badge{
  display:inline-block; margin-left:6px;
  padding:0 8px; border-radius:999px; font-weight:600;
  color:#fff; background:linear-gradient(135deg, #ff8a00, #ff4d00);
}
h2{font-size:18px;margin:24px 0 8px;color:var(--muted)}
a{color:#2a7bd5;text-decoration:none}
a:hover{text-decoration:underline}
.toolbar{display:flex;flex-wrap:wrap;gap:12px;align-items:center;margin:12px 0 24px}
.btn{
  padding:9px 12px;border:1px solid var(--border);border-radius:10px;background:var(--btn);color:var(--text);
  cursor:pointer;display:inline-flex;align-items:center;gap:8px;font-size:14px;line-height:1.2;
  box-shadow:var(--shadow);transition:transform .08s ease, background .12s ease, box-shadow .12s ease
}
.btn:hover{background:var(--btnh);transform:translateY(-1px)}
.btn:active{transform:translateY(0)}
.btn.danger{border-color:#7a2b35;background:var(--ign-bg);color:#fff}
.btn.danger:hover{background:var(--ign-hg)}
.btn.open{background:var(--open-bg);border-color:transparent;color:#fff}
.light .btn.open{color:#fff}
.btn.open:hover{background:var(--open-hg)}
.btn.ghost{background:transparent}
.btn.icon{padding:0;border:none;background:transparent;box-shadow:none}
.icon{width:22px;height:22px;display:inline-block}
.input{padding:9px 12px;border:1px solid var(--border);border-radius:10px;background:var(--bg2);color:var(--text);min-width:220px}
.input-group{display:inline-flex;gap:8px;align-items:center}
.input.resetthin{white-space:nowrap}
@media (max-width:640px){ .input-group{width:100%} .input-group .input{flex:1} }
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px}
.card{border:1px solid var(--border);background:var(--bg2);border-radius:14px;padding:14px;display:flex;flex-direction:column;gap:10px;overflow:hidden;box-shadow:var(--shadow)}
.card h3{margin:0;font-size:16px;display:flex;align-items:center;justify-content:space-between}
.badge{display:inline-block;background:var(--chip);border:1px solid var(--chip2);color:var(--text);padding:2px 8px;border-radius:999px;font-size:12px}
.badge.path{display:block;margin-top:2px;white-space:normal;overflow-wrap:anywhere;word-break:break-word}
.badge.tag{font-size:11px;letter-spacing:.2px;text-transform:uppercase;opacity:.9}
.meta{color:var(--muted);font-size:12px}
.header{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.links{display:flex;gap:8px;flex-wrap:wrap}
.links .spacer{flex:1}
.small{font-size:12px;color:var(--muted)}
hr{border:none;border-top:1px solid var(--border);margin:24px 0}
.footer{margin:24px 0 48px}
.star{border:none;background:transparent;cursor:pointer;font-size:20px;line-height:1}
.star.fav{color:#e0b000}
html:not(.light) .star:not(.fav){ color:#9aa3af; opacity:1; }
html:not(.light) .star:not(.fav):hover,
html:not(.light) .star:not(.fav):focus{ color:#ffd36a; text-shadow:0 0 6px rgba(255,211,106,.35); outline:none; }

/* Admin/Hilfe – moderne Sektionen */
.sections{display:grid;gap:18px}
.section{border:1px solid var(--border);background:var(--bg2);border-radius:14px;padding:16px;box-shadow:var(--shadow)}
.section h4{margin:0 0 6px;font-size:16px;display:flex;align-items:center;gap:10px}
.section .desc{color:var(--muted);font-size:13px;margin-bottom:12px}
.kv{display:grid;grid-template-columns:220px 1fr;gap:10px 14px;align-items:center}
.kv .label{color:var(--muted)}
.inline{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
.select-narrow{min-width:auto;width:90px}
.badge-mini{font-size:11px;padding:1px 8px}

/* Tabelle (Durchsuchen) */
.table{width:100%;border-collapse:separate;border-spacing:0;box-shadow:var(--shadow);border-radius:12px;overflow:hidden}
.table th,.table td{border-bottom:1px solid var(--border);padding:10px 12px;text-align:left;background:var(--bg2)}
.table th{cursor:pointer;user-select:none}
.table tr:hover td{background:rgba(255,255,255,0.03)}
.code{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace}
.btn[disabled]{opacity:.5; cursor:not-allowed}

/* Warn/Info */
.warn{border:1px solid var(--border);background:var(--bg2);border-left:6px solid var(--err);padding:10px 12px;border-radius:12px;box-shadow:var(--shadow)}
.info{border:1px solid var(--border);background:var(--bg2);border-left:6px solid var(--inf);padding:10px 12px;border-radius:12px;box-shadow:var(--shadow)}
.success{border-left-color:var(--ok)}

/* Pfadzeile Layout */
.browse-head{display:flex; align-items:center; gap:12px; margin-top:8px; flex-wrap:wrap;}

/* Toasts */
.toast-container{position:fixed;right:16px;bottom:16px;display:flex;flex-direction:column;gap:10px;z-index:9999}
.toast{display:flex;align-items:flex-start;gap:10px;min-width:280px;max-width:360px;background:var(--toastbg);color:var(--text);border:1px solid var(--border);border-left:6px solid var(--inf);padding:12px 14px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.25);opacity:0;transform:translateY(20px);animation:toast-in .2s ease-out forwards}
.toast.success{border-left-color:var(--ok)}
.toast.error{border-left-color:var(--err)}
.toast .icon{font-weight:700;line-height:1.1}
.toast .msg{flex:1;font-size:14px}
.toast .close{border:none;background:transparent;color:var(--muted);cursor:pointer;font-size:18px;line-height:1;padding:0 0 0 6px}
@keyframes toast-in{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
@keyframes toast-out{from{opacity:1;transform:translateY(0)}to{opacity:0;transform:translateY(10px)}}

/* --- ToTop FAB --- */
.totop-fab{
  position:fixed; right:16px; bottom:16px; z-index:1100;
  display:inline-flex; align-items:center; justify-content:center;
  width:44px; height:44px; border-radius:999px;
  border:1px solid var(--border); background:var(--btn); color:var(--text);
  box-shadow:0 8px 24px rgba(0,0,0,.35);
  cursor:pointer; opacity:0; transform:translateY(12px) scale(.98);
  pointer-events:none; transition:opacity .18s ease, transform .18s ease, background .12s ease;
}
.totop-fab:hover{ background:var(--btnh); }
.totop-fab.show{ opacity:1; transform:translateY(0) scale(1); pointer-events:auto; }
.totop-fab svg{ width:22px; height:22px; }
</style>
</head>
<body>
<div class="container" id="root">
  <div class="header">
    <h1>
      <!-- Logo -->
      <svg class="logo" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#ff8a00"/><stop offset="100%" stop-color="#ff4d00"/></linearGradient></defs>
        <rect x="2" y="2" width="60" height="60" rx="14" fill="url(#g)" />
        <path d="M16 20 L24 44 L32 20 L40 44 L48 20" fill="none" stroke="#fff" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <div class="title-wrap">
        <span class="title-text">Custom Dashboard XAMPP/Synology</span>
        <span class="small ver">
          v2.2.0 · Build 2025-09-08 · PHP 8.2.4 ·
          <span class="env-badge" title="Apache/2.4.56 (Unix) OpenSSL/1.1.1t PHP/8.2.4 mod_perl/2.0.12 Perl/v5.34.1">XAMPP</span>
        </span>
      </div>
    </h1>
    <div class="links" style="flex:1">
      <a class="btn" href="?action=phpinfo" target="_blank" rel="noopener">phpinfo()</a>
      <a class="btn" href="/phpmyadmin/" target="_blank" rel="noopener">phpMyAdmin</a>
      <a class="btn" href="/dashboard/" target="_blank" rel="noopener">XAMPP Dashboard</a>
      <a class="btn" href="?help=1">Hilfe</a>
      <a class="btn" href="?admin=1">Admin</a>
      <span class="spacer"></span>
      <span id="themeToggle" class="btn icon" style="padding:0;box-shadow:none" title="Hell/Dunkel umschalten" role="button" tabindex="0" aria-label="Theme">
        <svg class="icon" viewBox="0 0 24 24" id="themeIcon" aria-hidden="true"></svg>
      </span>
    </div>
  </div>


  <!-- ================= Dashboard / Liste ================= -->
  <form class="toolbar" method="get" action="">
    <span class="input-group" style="flex:1; min-width:280px">
      <input class="input" style="width:100%" type="search" name="q" placeholder="Projekte suchen…" value="">
      <button class="btn input resetthin" type="button" onclick="const f=this.closest('form'); f.q.value=''; f.submit();" title="Suchfeld leeren">Suche zurücksetzen</button>
    </span>
    <select class="input" name="sort" onchange="this.form.submit()">
      <option value="name" selected>Sortierung: Name/Titel</option>
      <option value="time" >Sortierung: Zuletzt geändert</option>
      <option value="fav"  >Sortierung: Favoriten zuerst</option>
    </select>
    <select class="input" name="view" onchange="this.form.submit()" style="width:auto">
      <option value="all"     selected>Ansicht: Alle</option>
      <option value="favs"    >Ansicht: Favoriten</option>
      <option value="ignored" >Ansicht: Ignorierte</option>
    </select>
    <button class="btn" type="submit">Aktualisieren</button>
  </form>

  
    <h2>Gefundene Projekte (11)</h2>
    <div class="grid">
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/Website/Colournator/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/Website/Colournator">
          <h3>
            <span>Colournator</span>
            <button class="star " title="Favorit" aria-label="Favorit">☆</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/Website/Colournator</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-09-01 10:58</div>

          
          <div class="links">
            <a class="btn open" href="/Website/Colournator/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FColournator">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FColournator">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/Website/DienstOrbit/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/Website/DienstOrbit">
          <h3>
            <span>DienstOrbit</span>
            <button class="star " title="Favorit" aria-label="Favorit">☆</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/Website/DienstOrbit</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-09-01 09:50</div>

          
          <div class="links">
            <a class="btn open" href="/Website/DienstOrbit/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FDienstOrbit">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FDienstOrbit">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/index.php" data-dir="/Applications/XAMPP/xamppfiles/htdocs">
          <h3>
            <span>htdocs</span>
            <button class="star " title="Favorit" aria-label="Favorit">☆</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs</span></div>
          <div class="small">Entry: <code>index.php</code></div>
          <div class="small">Geändert: 2025-09-08 09:23</div>

          
          <div class="links">
            <a class="btn open" href="/index.php" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/icon-builder/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/icon-builder">
          <h3>
            <span>icon-builder</span>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/icon-builder</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-09-08 11:05</div>

          
          <div class="links">
            <a class="btn open" href="/icon-builder/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Ficon-builder">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2Ficon-builder">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/JoghurtMeister/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/JoghurtMeister">
          <h3>
            <span>JoghurtMeister</span>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/JoghurtMeister</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-09-04 22:26</div>

          
          <div class="links">
            <a class="btn open" href="/JoghurtMeister/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FJoghurtMeister">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FJoghurtMeister">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/Website/KoordinatenWerk/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/Website/KoordinatenWerk">
          <h3>
            <span>KoordinatenWerk</span>
            <button class="star " title="Favorit" aria-label="Favorit">☆</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/Website/KoordinatenWerk</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-30 17:55</div>

          
          <div class="links">
            <a class="btn open" href="/Website/KoordinatenWerk/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FKoordinatenWerk">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FKoordinatenWerk">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/Website/SchoensteZeit/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/Website/SchoensteZeit">
          <h3>
            <span>SchoensteZeit</span>
            <button class="star " title="Favorit" aria-label="Favorit">☆</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/Website/SchoensteZeit</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-23 15:29</div>

          
          <div class="links">
            <a class="btn open" href="/Website/SchoensteZeit/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FSchoensteZeit">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FSchoensteZeit">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/Website/Taktische-Zeit/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/Website/Taktische-Zeit">
          <h3>
            <span>Taktische-Zeit</span>
            <button class="star " title="Favorit" aria-label="Favorit">☆</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/Website/Taktische-Zeit</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-29 14:10</div>

          
          <div class="links">
            <a class="btn open" href="/Website/Taktische-Zeit/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FTaktische-Zeit">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FTaktische-Zeit">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/Website/THW-Funkruf/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/Website/THW-Funkruf">
          <h3>
            <span>THW-Funkruf</span>
            <button class="star " title="Favorit" aria-label="Favorit">☆</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/Website/THW-Funkruf</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-21 14:51</div>

          
          <div class="links">
            <a class="btn open" href="/Website/THW-Funkruf/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FTHW-Funkruf">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite%2FTHW-Funkruf">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/Veilbeam/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/Veilbeam">
          <h3>
            <span>Veilbeam</span>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/Veilbeam</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-09-08 10:53</div>

          
          <div class="links">
            <a class="btn open" href="/Veilbeam/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FVeilbeam">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FVeilbeam">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
              <div class="card" data-path="/Applications/XAMPP/xamppfiles/htdocs/Website/index.html" data-dir="/Applications/XAMPP/xamppfiles/htdocs/Website">
          <h3>
            <span>Website</span>
            <button class="star fav" title="Favorit" aria-label="Favorit">★</button>
          </h3>
          <div class="meta">Ordner: <span class="badge path">/Applications/XAMPP/xamppfiles/htdocs/Website</span></div>
          <div class="small">Entry: <code>index.html</code></div>
          <div class="small">Geändert: 2025-08-30 13:36</div>

          
          <div class="links">
            <a class="btn open" href="/Website/index.html" target="_blank" rel="noopener"
               >
               Öffnen ↗
            </a>
            <a class="btn" href="?action=browse&dir=%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite">Durchsuchen</a>
            <a class="btn" href="vscode://file/%2FApplications%2FXAMPP%2Fxamppfiles%2Fhtdocs%2FWebsite">In VS Code öffnen</a>
            <button class="btn danger ignore" title="Ignorieren">Ignorieren</button>
          </div>
        </div>
          </div>

  
  <hr>
  <div class="footer small">
    BASE: <span class="badge">/Applications/XAMPP/xamppfiles/htdocs</span> ·
    Tiefe: <span class="badge">3</span> ·
    Ignoriert (Namen): <span class="badge">.git, vendor, node_modules, tmp, cache, logs, xampp, bitnami, .DS_Store, dashboard, src, secure</span> ·
    Ignoriert (Pfade): <span class="badge">5 Einträge</span> ·
    Whitelist: <span class="badge">0 Einträge</span> ·
    Hinweise: <span class="badge">0</span> ·
    Auto-Fav: <span class="badge">an</span> ·
    Auto-Ignore: <span class="badge">an</span>
  </div>

  
  <div class="footer small" style="text-align:center; margin-top:32px; padding:12px; border:1px solid var(--border); border-radius:12px; background:var(--bg2); opacity:0.9">
    © 2025 Wolfgang Saal · 
    <a href="https://opensource.org/licenses/MIT" target="_blank" rel="noopener">MIT-Lizenz</a> · 
    <a href="https://github.com/wsaal68" target="_blank" rel="noopener">GitHub</a>
  </div>
</div>

<!-- Floating "To Top" Button -->
<button class="totop-fab" id="toTop" type="button" aria-label="Nach oben">
  <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M12 5l6 6h-4v8h-4v-8H6l6-6z"/></svg>
</button>

<!-- Toasts Container -->
<div class="toast-container" id="toasts" aria-live="polite" aria-atomic="true"></div>

<script>
// ===== Theme toggle =====
(function(){
  const root = document.documentElement, key='xd_theme';
  const sun  = '<g fill="none" stroke="#f4b000" stroke-width="2" stroke-linecap="round">'+
               '<circle cx="12" cy="12" r="4" stroke="#f4b000"/>'+
               '<line x1="12" y1="1" x2="12" y2="4"/><line x1="12" y1="20" x2="12" y2="23"/>'+
               '<line x1="1" y1="12" x2="4" y2="12"/><line x1="20" y1="12" x2="23" y2="12"/>'+
               '<line x1="4.2" y1="4.2" x2="6.3" y2="6.3"/><line x1="17.7" y1="17.7" x2="19.8" y2="19.8"/>'+
               '<line x1="4.2" y1="19.8" x2="6.3" y2="17.7"/><line x1="17.7" y1="6.3" x2="19.8" y2="4.2"/></g>';
  const moon = '<path d="M21 12.5A8.5 8.5 0 1 1 11.5 3a7 7 0 1 0 9.5 9.5Z" fill="#9ec5fe"/>';
  function apply(t){
    const isLight = (t==='light');
    root.classList.toggle('light', isLight);
    const icon = document.getElementById('themeIcon');
    if (icon) icon.innerHTML = isLight ? moon : sun;
  }
  const saved = localStorage.getItem(key) || 'dark';
  apply(saved);
  const btn = document.getElementById('themeToggle');
  function toggle(){
    const cur = root.classList.contains('light') ? 'light' : 'dark';
    const next = cur==='light' ? 'dark' : 'light';
    localStorage.setItem(key, next); apply(next);
    showToast('info','Theme auf <b>'+ (next==='light'?'Light':'Dark') +'</b> umgestellt.');
  }
  if (btn) { btn.addEventListener('click', toggle); btn.addEventListener('keydown', e=>{ if(e.key==='Enter' || e.key===' ') { e.preventDefault(); toggle(); } }); }
})();

// ===== Toasts =====
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

// ===== Scan-Hinweise als Toast spiegeln =====
(function(){
  document.querySelectorAll('.scan-errors li').forEach(li=>{
    showToast('error', li.innerHTML, {duration: 5200});
  });
})();

// ===== Fav toggle =====
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

// ===== Ignore toggle (mit Whitelist-Logik) =====
document.querySelectorAll('.card .ignore').forEach(btn=>{
  btn.addEventListener('click', ev=>{
    ev.preventDefault();
    const card = ev.target.closest('.card');
    const dir  = card.getAttribute('data-dir');
    fetch('?action=ignore', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'dir='+encodeURIComponent(dir)})
      .then(r=>r.json()).then(d=>{
        if(!d.ok){ showToast('error','Konnte Ignorieren nicht speichern: '+(d.err||'')); return; }
        btn.classList.toggle('danger', d.ignored);
        btn.textContent = d.ignored ? 'Ignoriert' : 'Ignorieren';
        const url = new URL(window.location.href); const view = url.searchParams.get('view') || 'all';
        const cardEl = ev.target.closest('.card');
        if (view !== 'ignored' && d.ignored) cardEl.style.display='none';
        if (view === 'ignored' && !d.ignored) cardEl.style.display='none';
        showToast('success', d.ignored ? 'Ordner wird nun ignoriert.' : 'Ordner nicht mehr ignoriert (Whitelist).');
      }).catch(e=>showToast('error','Fehler: '+e));
  });
});

// === Admin-Aktionen (Tiefe speichern / Auto-Fav / Auto-Ignore / Reaktivieren) ===
(function(){
  // Max. Tiefe speichern
  const saveBtn = document.getElementById('saveDepth');
  const depthSel = document.getElementById('depthSel');
  if (saveBtn && depthSel) {
    saveBtn.addEventListener('click', ()=>{
      const depth = parseInt(depthSel.value || '0', 10);
      fetch('?action=set_depth', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'depth=' + encodeURIComponent(depth)
      })
      .then(r=>r.json())
      .then(d=>{
        if (!d.ok) { showToast('error','Konnte Tiefe nicht speichern (xd_config.json beschreibbar?).'); return; }
        depthSel.value = String(d.depth);
        showToast('success','Max. Tiefe gespeichert: <b>'+ d.depth +'</b>.');
      })
      .catch(e=>showToast('error','Fehler: '+e));
    });
  }

  // Auto-Fav umschalten
  const autoFavBtn = document.getElementById('toggleAutoFav');
  const autoFavState = document.getElementById('autoFavState');
  if (autoFavBtn && autoFavState) {
    autoFavBtn.addEventListener('click', ()=>{
      fetch('?action=toggle_autofav')
      .then(r=>r.json())
      .then(d=>{
        if (!d.ok) { showToast('error','Konnte Auto-Fav nicht umschalten.'); return; }
        autoFavState.textContent = d.auto_fav ? 'an' : 'aus';
        autoFavState.classList.toggle('success', !!d.auto_fav);
        showToast('success','Auto-Fav '+ (d.auto_fav ? 'aktiviert' : 'deaktiviert') +'.');
      })
      .catch(e=>showToast('error','Fehler: '+e));
    });
  }

  // Auto-Ignore umschalten
  const autoIgnoreBtn = document.getElementById('toggleAutoIgnore');
  const autoIgnoreState = document.getElementById('autoIgnoreState');
  if (autoIgnoreBtn && autoIgnoreState) {
    autoIgnoreBtn.addEventListener('click', ()=>{
      fetch('?action=toggle_autoignore')
      .then(r=>r.json())
      .then(d=>{
        if (!d.ok) { showToast('error','Konnte Auto-Ignore nicht umschalten.'); return; }
        autoIgnoreState.textContent = d.auto_ignore ? 'an' : 'aus';
        autoIgnoreState.classList.toggle('success', !!d.auto_ignore);
        showToast('success','Auto-Ignore '+ (d.auto_ignore ? 'aktiviert' : 'deaktiviert') +'.');
      })
      .catch(e=>showToast('error','Fehler: '+e));
    });
  }

  // „Reaktivieren“-Buttons in der Ignoriert-Liste
  document.querySelectorAll('[data-unignore]').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const dir = btn.getAttribute('data-unignore');
      fetch('?action=ignore', {
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'dir=' + encodeURIComponent(dir)
      })
      .then(r=>r.json())
      .then(d=>{
        if (!d.ok) { showToast('error','Konnte Pfad nicht reaktivieren.'); return; }
        const row = btn.closest('.inline');
        if (row) row.remove();
        showToast('success','Pfad reaktiviert (Whitelist).');
      })
      .catch(e=>showToast('error','Fehler: '+e));
    });
  });
})(); // IIFE sauber schließen

// --- Floating "To Top" Button ---
(function(){
  const fab = document.getElementById('toTop');
  if (!fab) return;
  fab.addEventListener('click', ()=> window.scrollTo({top:0, behavior:'smooth'}));
  const hdr = document.querySelector('.header');
  const reveal = (show)=> fab.classList.toggle('show', !!show);
  if ('IntersectionObserver' in window && hdr) {
    const io = new IntersectionObserver((entries)=>{
      const e = entries[0];
      const shouldShow = !e.isIntersecting || window.scrollY > 200;
      reveal(shouldShow);
    }, {root:null, threshold: [0, 0.01]});
    io.observe(hdr);
  } else {
    const onScroll = ()=>{ const y = window.scrollY || document.documentElement.scrollTop; reveal(y > 200); };
    window.addEventListener('scroll', onScroll, {passive:true}); onScroll();
  }
})();
</script>
</body>
</html>
