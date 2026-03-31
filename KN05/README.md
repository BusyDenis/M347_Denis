# KN05: Arbeit mit Speicher

Kurzüberblick zu den Teilen A–C. Details und Befehle: `A/BEFEHLE_A.md`, `B/BEFEHLE_B.md`, Teil C unten und `C/docker-compose.yml`.

---

## A) Bind mounts

### Dateien

- `A/BEFEHLE_A.md` — Befehle
- `A/host_script.sh` — Skript auf dem Host (über Bind Mount im Container ausführbar)

### Ablauf

1. Ersten `docker run` mit Bind Mount ausführen (Ausgabe v1).
2. `host_script.sh` auf dem Host auf v2 ändern.
3. Zweiten `docker run` ausführen (Ausgabe v2).

### **STOP – Screenshot(s) Teil A**

Wenn du die Nachweise noch nicht hast: Terminal so fotografieren, dass **beide** Läufe sichtbar sind (v1, dann nach Änderung v2). Dateien z. B. `A/Bind 1.png` und `A/Bind 2.png`.

---

## B) Named Volumes (zwei Container, eine Datei)

### Dateien

- `B/BEFEHLE_B.md` — Befehle

### **STOP – Screenshot(s) Teil B**

Wenn noch kein Bild für B existiert: Hier anhalten, die Befehle aus `BEFEHLE_B.md` ausführen und den Ablauf fotografieren (beide Container, Volume `kn05b-shared`, gemeinsame Datei `/data/shared.txt`, lesen/schreiben von beiden Seiten). Z. B. `B/named-volume.png` (Name frei wählbar).

---

## C) Docker Compose — Bind, Named Volume, tmpfs

### Dateien

- `C/docker-compose.yml` — zwei `nginx`-Services, Named Volume `kn05c_shared` (Top-Level), **Container 1:** Long-Syntax-Volume + Bind `./bind_host` → `/shared` + tmpfs auf `/cache` — **Container 2:** Short-Syntax `kn05c_shared:/data`
- `C/bind_host/` — Inhalt für den Bind Mount (Host-Ordner)

### Befehle (PowerShell, im Ordner `KN05/C`)

```powershell
docker compose up -d
docker ps --filter "name=kn05c-nginx"
```

### **STOP – Screenshot 1 (Teil C, erster Container)**

Jetzt **Screenshot** vom `mount`-Auszug im **ersten** Container — sichtbar sollen die **drei** Arten sein (Named Volume unter `/data`, Bind unter `/shared`, tmpfs unter `/cache`):

```powershell
docker exec kn05c-nginx1 mount
```

Optional kompakter (nur relevante Zeilen):

```powershell
docker exec kn05c-nginx1 sh -lc "mount | grep -E ' on /data | on /shared | on /cache '"
```

Speichern z. B. als `C/mount-nginx1.png`.

### **STOP – Screenshot 2 (Teil C, zweiter Container)**

Screenshot vom `mount`-Auszug im **zweiten** Container — der Eintrag für das **Named Volume** auf `/data`:

```powershell
docker exec kn05c-nginx2 mount
```

Optional:

```powershell
docker exec kn05c-nginx2 sh -lc "mount | grep ' on /data '"
```

Speichern z. B. als `C/mount-nginx2.png`.

### Aufräumen

```powershell
docker compose down
```

Named Volume explizit löschen (nur wenn gewünscht):

```powershell
docker volume rm kn05c_kn05c_shared
```

---

## Abgabe-Checkliste (lt. Aufgabenstellung)

| Teil | Inhalt |
|------|--------|
| A | Befehlsliste, Nachweis (bei dir: Screenshots statt Screencast nach Absprache) |
| B | Befehlsliste, Nachweis (Screenshots) |
| C | `docker-compose.yml`, zwei `mount`-Auszüge (Screenshots oder Textauszug) |
