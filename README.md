[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

# Custom-Dashboard

Übersichtliches, kleines Dashboard für lokale XAMPP-Entwicklungsprojekte bzw. Synology Web Station.

## Beschreibung
Dieses Projekt stellt ein UI bereit, das lokale Ordner unterhalb von htdocs scannt und als "Projekte" anzeigt. Die Oberfläche bietet Suche, Sortierung, Filter (Alle / Favoriten / Ignorierte), Theme-Umschaltung (Hell/Dunkel) sowie schnelle Links zu phpinfo(), phpMyAdmin und dem XAMPP-Dashboard.

Die aktuelle Implementierung findest du in [index.php](index.php). UI-Interaktionen (Toasts) werden über die Funktion [`showToast`](index.php) gesteuert.

## Funktionen (Kurz)
- Scan und Auflistung von Projekten (Ordner, Entry-Datei, Änderungsdatum)
- Suche, Sortierung und Ansicht-Filter
- Favorisieren (★) und Ignorieren von Ordnern (AJAX POST)
- Theme-Umschalter (persistiert in localStorage)
- Admin-Aktionen: maximale Tiefe speichern, Auto-Fav umschalten, Schreibrechte setzen
- Kleine, einblendbare Toast-Benachrichtigungen (siehe [`showToast`](index.php))

## Nutzung
1. Kopiere `index.php` in das gewünschte Verzeichnis innerhalb deines XAMPP `htdocs` (z. B. direkt in `/Applications/XAMPP/xamppfiles/htdocs`).
2. Öffne im Browser: http://localhost/index.php (oder entsprechende Pfade).
3. Admin-View erreichst du über `?admin=1` (sofern in der Umgebung erlaubt).
4. Favoriten / Ignorieren funktionieren per Klick — Änderungen werden per Fetch an `?action=...` gesendet.

## Dateien
- Hauptseite: [index.php](index.php)
- Lizenz: [LICENSE](LICENSE)

## Hinweise für Entwickler
- UI-Logik befindet sich inline in [index.php](index.php) (Vanilla JS).
- Toaster: [`showToast`](index.php) — einfache API: showToast(type, html, opts).
- AJAX-Endpunkte: `?action=fav`, `?action=ignore`, `?action=set_depth`, `?action=toggle_autofav`, `?action=make_writable` — serverseitige Implementierung muss diese Actions verarbeiten.

## Lizenz
MIT — siehe [LICENSE](LICENSE)

---

## Autor

© 2025 Wolfgang Saal, Böllenborn
