# B) Cluster verstehen

## B1: `get nodes` auf anderem Node

Auf Node 2 (ip-172-31-69-115) ausgeführt — das Resultat ist identisch zu A, da alle Nodes die gleiche Kubernetes-API abfragen.

![get-nodes-2](get-nodes-2.png)

---

## B2: `microk8s status`

Auf Node 1 ausgeführt (Zeilen vor "addons"):

![microk8s-status](microk8s-status.png)

**Erklärung:**
- **`microk8s is running`**: MicroK8s läuft auf diesem Node.
- **`high-availability: yes`**: Der Cluster ist im HA-Modus. Bei 3 vollwertigen Nodes wird Dqlite (verteilte Datenbank) über alle Nodes repliziert. Fällt ein Node aus, können die verbleibenden zwei den Cluster weiterführen.
- **`datastore master nodes`**: Alle drei Nodes sind Dqlite-Master und speichern den Cluster-Zustand.

---

## B3: Node entfernen

Node 3 (ip-172-31-68-181) wurde mit `drain`, `delete node`, `leave` und `remove-node` entfernt:

![remove-node](remove-node.png)

Danach nur noch 2 Nodes im Cluster:

![get-nodes-2nodes](get-nodes-2nodes.png)

---

## B4: Nodes als Worker wieder hinzufügen

Beide entfernten Nodes wurden mit dem `--worker` Flag wieder hinzugefügt:

![worker-join](worker-join.png)

Resultat — 1 Master + 2 Worker:

![get-nodes-workers](get-nodes-workers.png)

---

## B5: `microk8s status` nach Worker-Umbau

![microk8s-status-after](microk8s-status-after.png)

**Unterschied zu B2:**
- **`high-availability: no`** statt `yes` — Worker-Nodes tragen keinen Dqlite/Control-Plane-Anteil.
- **Nur 1 datastore master** (172.31.71.207) statt 3 — Worker nehmen nicht am verteilten Datastore teil, daher gibt es keine HA-Replikation mehr.

---

## B6: `get nodes` auf Master und Worker

**Master (Node 1):**

![get-nodes-master](get-nodes-master.png)

**Worker (Node 2):**

![get-nodes-worker](get-nodes-worker.png)

**Erklärung:** Worker-Nodes können kein `kubectl` ausführen, da sie keinen API-Server betreiben. Das stimmt mit `microk8s status` überein: nur der Master führt die Control-Plane-Komponenten (API-Server, Scheduler, Controller-Manager) aus. Worker führen nur Workloads (Pods) aus.
