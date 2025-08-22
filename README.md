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


⚙️ Infrastructure Setup (Terraform)

Initialize Terraform

cd terraform
terraform init


Preview changes

terraform plan -var-file=dev.tfvars


Apply changes

terraform apply -var-file=dev.tfvars -auto-approve


This will:

Provision an EKS cluster.

Create VPC, subnets, IAM roles.

Deploy ClickHouse, Prometheus, Loki, Grafana via Helm.

📦 CI/CD Pipeline (GitHub Actions)

The pipeline (.github/workflows/ci-cd.yaml) automates:

✅ Build Docker images for each service.

✅ Run linting & tests.

✅ Push images to container registry (ECR).

✅ Deploy to Kubernetes using kubectl + Helm.

Trigger:

Runs on push to main branch.

☸️ Kubernetes Deployment

Each service has its own k8s-deploy.yaml:

php-monolith → API service logging events into ClickHouse.

video-encoder → Encodes sample.mp4 files on demand.

dashboard → Displays logs/events from ClickHouse.

ClickHouse → Deployed via Helm with PVC for persistence.

Internal communication:

Services discover each other via Kubernetes Service DNS (e.g., clickhouse.knowledgecity.svc.cluster.local).

📊 Observability

Prometheus
Collects metrics (scrape interval: 15s).
Values configured in helm-values/prometheus-values.yaml.

Loki
Aggregates logs from all pods.
Configured in helm-values/loki-values.yaml.

Grafana
Visualizes metrics and logs with dashboards.
Configured in helm-values/grafana-values.yaml.

Access Grafana:

kubectl port-forward svc/grafana -n monitoring 3000:3000

📝 Example Workflow

Deploy EKS + infrastructure:

terraform apply


Deploy apps:

kubectl apply -f apps/php-monolith/k8s-deploy.yaml
kubectl apply -f apps/video-encoder/k8s-deploy.yaml
kubectl apply -f apps/dashboard/k8s-deploy.yaml


Access dashboard:

kubectl port-forward svc/dashboard 8080:80


Verify events in ClickHouse:

SELECT * FROM analytics.events ORDER BY event_time DESC LIMIT 10;

📈 Improvements & Alternatives

Replace Minikube with fully managed EKS (production).

Add service mesh (Istio or Linkerd) for traffic management.

Secure ClickHouse with authentication & TLS.

Implement Horizontal Pod Autoscaling.

Integrate ArgoCD for GitOps.

Add end-to-end monitoring dashboards in Grafana.

📚 What I Learned

Managing end-to-end DevOps workflow (infra → apps → observability).

Writing modular Terraform for repeatable infrastructure.

Deploying stateful apps (ClickHouse) on Kubernetes.

Setting up CI/CD pipelines that handle build, test, deploy.

Observability stack integration (Prometheus + Loki + Grafana).

🔗 References

Terraform AWS EKS Docs

ClickHouse Helm Chart

Prometheus Helm Chart

Grafana Loki

FFmpeg Docs

👨‍💻 Author

DAVID ADETEYE
Senior DevOps Engineer Candidate
