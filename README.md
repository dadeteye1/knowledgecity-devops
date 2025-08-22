# KnowledgeCity DevOps Project

This project demonstrates a **cloud-native microservices architecture** deployed to **AWS EKS** using **Terraform**, **Helm**, and **Kubernetes**.  
It includes automated CI/CD with GitHub Actions, observability with Prometheus, Loki, Grafana, and persistent data storage with ClickHouse.  

The goal is to showcase **end-to-end DevOps practices**: Infrastructure as Code (IaC), containerization, orchestration, monitoring, and modular deployments.

---

## 🚀 Architecture Overview

The system consists of:

- **Applications**
  - `php-monolith` → API service with ClickHouse logging integration.
  - `video-encoder` → Encodes video files using FFmpeg.
  - `dashboard` → Node.js dashboard displaying events from ClickHouse.
- **Database**
  - `ClickHouse` deployed via Helm chart with persistent storage.
- **Infrastructure**
  - AWS EKS cluster (Terraform).
  - VPC, subnets, IAM roles, storage, and security groups managed with Terraform.
- **Observability**
  - Prometheus → metrics collection.
  - Loki → log aggregation.
  - Grafana → dashboards and visualization.

---

## 🛠️ Tools & Technologies

- **Infrastructure as Code**: Terraform (AWS EKS, IAM, VPC, Storage, Helm).
- **Containerization**: Docker.
- **Orchestration**: Kubernetes (EKS).
- **CI/CD**: GitHub Actions.
- **Monitoring & Logging**: Prometheus, Loki, Grafana.
- **Database**: ClickHouse (time-series events).
- **Languages**: PHP, Node.js, Bash.

---

## 📂 Repository Structure

```bash
.
├── apps
│   ├── dashboard          # Node.js dashboard
│   │   ├── Dockerfile
│   │   ├── k8s-deploy.yaml
│   │   └── server.js
│   ├── php-monolith       # PHP monolith API
│   │   ├── analytics.php
│   │   ├── Dockerfile
│   │   ├── index.php
│   │   └── k8s-deploy.yaml
│   └── video-encoder      # Video encoder (FFmpeg)
│       ├── Dockerfile
│       ├── encode.sh
│       └── k8s-deploy.yaml
├── helm-values            # Helm chart configurations
│   ├── grafana-values.yaml
│   ├── loki-values.yaml
│   └── prometheus-values.yaml
├── terraform              # Infrastructure as Code
│   ├── eks.tf             # EKS cluster
│   ├── helm-clickhouse.tf # ClickHouse deployment
│   ├── iam.tf             # IAM roles & policies
│   ├── main.tf            # Root Terraform orchestration
│   ├── monitoring.tf      # Prometheus, Loki, Grafana
│   ├── network.tf         # VPC, subnets, security groups
│   ├── outputs.tf         # Terraform outputs
│   ├── providers.tf       # AWS & Helm providers
│   ├── storage.tf         # EBS, S3, PVC
│   └── variables.tf       # Inputs for reusability
├── .github/workflows
│   └── ci-cd.yaml         # CI/CD pipeline
└── README.md              # Documentation
