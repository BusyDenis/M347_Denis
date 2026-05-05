# KN05 B — Named Volume: Befehlsliste

## Ziel

Zwei Container nutzen dasselbe Named Volume und schreiben/lesen
gegenseitig in die gleiche Datei `/data/shared.txt`.

## 1) Volume und Container starten

```powershell
docker volume create kn05b-shared
docker run -d --name kn05b-c1 -v kn05b-shared:/data nginx:latest
docker run -d --name kn05b-c2 -v kn05b-shared:/data nginx:latest
```

## 2) Container 1 schreibt in die Datei

```powershell
docker exec kn05b-c1 sh -lc "echo 'Nachricht von Container 1 - Denis' >> /data/shared.txt && cat /data/shared.txt"
```

## 3) Container 2 liest und schreibt eigene Antwort

```powershell
docker exec kn05b-c2 sh -lc "cat /data/shared.txt && echo 'Antwort von Container 2 - Denis' >> /data/shared.txt && cat /data/shared.txt"
```

## 4) Container 1 liest und ergaenzt erneut

```powershell
docker exec kn05b-c1 sh -lc "cat /data/shared.txt && echo 'Weitere Nachricht von Container 1 - Denis' >> /data/shared.txt && cat /data/shared.txt"
```

## 5) Container 2 liest den Endstand

```powershell
docker exec kn05b-c2 sh -lc "cat /data/shared.txt"
```

## Aufraeumen (optional)

```powershell
docker rm -f kn05b-c1 kn05b-c2
docker volume rm kn05b-shared
```
