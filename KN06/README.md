# KN06: Kubernetes I (MicroK8s / AWS)

## A) Drei Nodes

Siehe [A/README.md](A/README.md)

![get-nodes](A/get-nodes.png)

---

## B) Cluster verstehen

Siehe [B/README.md](B/README.md) für alle Screenshots und Erklärungen (B1–B6).

---

## Abgabetext: Unterschied `microk8s` vs. `microk8s kubectl`

- **`microk8s`** ist ein Verwaltungstool für die lokale MicroK8s-Installation (Snap-Paket). Es steuert den lokalen Dienst: `microk8s status` zeigt den Zustand der lokalen Installation, `microk8s add-node` generiert Join-Tokens, `microk8s leave` entfernt den Node aus dem Cluster. Diese Befehle betreffen die **lokale Node-Konfiguration**.

- **`microk8s kubectl`** ist das Standard-Kubernetes-CLI (`kubectl`), das gegen die **Kubernetes-API** des Clusters spricht. Es verwaltet Cluster-Ressourcen wie Pods, Nodes, Deployments und Services. Die Befehle wirken auf den gesamten Cluster, nicht nur auf den lokalen Node.

Kurz: `microk8s` = lokale Installation verwalten, `microk8s kubectl` = Cluster-Ressourcen über die API verwalten.
