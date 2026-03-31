# KN05 A - Bind Mounts

## Ziel

Nachweisen, dass eine Aenderung im Script auf dem Host sofort im Container sichtbar ist.

## Script auf dem Host (`KN05/A/host_script.sh`)

### Version 1 (vor dem ersten Run)

```bash
#!/usr/bin/env bash
echo "Hallo aus dem Bind-Mount Test v1 von Denis am 2026-03-24."
```

## Befehle

### 1) Erster Start mit Bind Mount (muss v1 ausgeben)

```powershell
docker run --name kn05a-bind-1 --rm -v "C:/work/Git/M347_Denis/KN05/A:/shared" nginx:latest bash /shared/host_script.sh
```

### 2) Script auf dem Host aendern auf Version 2

`host_script.sh` anpassen auf:

```bash
#!/usr/bin/env bash
echo "Hallo aus dem Bind-Mount Test v2 von Denis am 2026-03-24 - Aenderung sichtbar."
```

### 3) Zweiter Start mit demselben Bind Mount (muss v2 ausgeben)

```powershell
docker run --name kn05a-bind-2 --rm -v "C:/work/Git/M347_Denis/KN05/A:/shared" nginx:latest bash /shared/host_script.sh
```

## Screenshot/Screencast-Stopp

Stoppe hier fuer die Aufnahme. Im Bild/Video muessen beide Ausgaben sichtbar sein:
- erster Run -> v1
- zweiter Run nach Host-Aenderung -> v2
