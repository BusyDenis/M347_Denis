# KN05 A — Bind Mount: Befehlsliste

## Ziel

Eine Aenderung des Skripts auf dem Host ist beim naechsten Container-Lauf
unmittelbar sichtbar (Bind Mount).

## Skript auf dem Host (`KN05/A/host_script.sh`)

### Version 1

```bash
#!/usr/bin/env bash
echo "Hallo aus dem Bind-Mount Test v1 von Denis am 2026-03-24."
```

### Version 2 (nach Aenderung)

```bash
#!/usr/bin/env bash
echo "Hallo aus dem Bind-Mount Test v2 von Denis am 2026-03-24 - Aenderung sichtbar."
```

## Ablauf

### 1) Erster Lauf mit Bind Mount — Ausgabe v1

```powershell
docker run --name kn05a-bind-1 --rm `
  -v "C:/work/Git/M347_Denis/KN05/A:/shared" `
  nginx:latest bash /shared/host_script.sh
```

### 2) `host_script.sh` auf Version 2 anpassen

### 3) Zweiter Lauf mit demselben Bind Mount — Ausgabe v2

```powershell
docker run --name kn05a-bind-2 --rm `
  -v "C:/work/Git/M347_Denis/KN05/A:/shared" `
  nginx:latest bash /shared/host_script.sh
```
