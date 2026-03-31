# KN05 B - Named Volumes

## Ziel

Nachweisen, dass zwei Container dasselbe Named Volume benutzen und gegenseitig in derselben Datei lesen/schreiben koennen.

## 1) Volume und Container starten

```powershell
docker volume create kn05b-shared
docker run -d --name kn05b-c1 -v kn05b-shared:/data nginx:latest
docker run -d --name kn05b-c2 -v kn05b-shared:/data nginx:latest
```

## 2) Container 1 schreibt in Datei

```powershell
docker exec kn05b-c1 sh -lc "echo 'Nachricht von Container 1 - Denis' >> /data/shared.txt && cat /data/shared.txt"
```

## 3) Container 2 liest und schreibt

```powershell
docker exec kn05b-c2 sh -lc "cat /data/shared.txt && echo 'Antwort von Container 2 - Denis' >> /data/shared.txt && cat /data/shared.txt"
```

## 4) Container 1 liest und schreibt erneut

```powershell
docker exec kn05b-c1 sh -lc "cat /data/shared.txt && echo 'Weitere Nachricht von Container 1 - Denis' >> /data/shared.txt && cat /data/shared.txt"
```

## 5) Container 2 liest Endstand

```powershell
docker exec kn05b-c2 sh -lc "cat /data/shared.txt"
```

## Screenshot/Screencast-Stopp

Stoppe hier fuer die Aufnahme. Sichtbar sein soll:
- beide Container verwenden dasselbe Volume `kn05b-shared`
- beide Container schreiben in `/data/shared.txt`
- beide Container sehen den gemeinsamen Endstand
