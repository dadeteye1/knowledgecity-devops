# KnowledgeCity DevOps Project

## 📌 Overview
This project is a **cloud-native video processing and analytics pipeline**, designed as part of a senior DevOps engineering assessment.  
It demonstrates the ability to integrate multiple microservices, data pipelines, and DevOps best practices into a fully automated setup.

The solution includes:
- **PHP Monolith API** that logs user activity.
- **Video Encoder Service** that processes uploaded videos with `ffmpeg`.
- **ClickHouse Database** for event analytics storage.
- **Dashboard UI** to visualize events and activity.
- **Terraform + Helm** for Infrastructure as Code (IaC).
- **GitHub Actions** for CI/CD automation.
- **Kubernetes (Minikube/Cloud)** as the runtime platform.

---

## 🏗️ High-Level Architecture

![Architecture Diagram](architecture.png)

### Components
1. **SPA Frontend (Dashboard)**  
   - A simple Node.js/Express web dashboard.  
   - Displays events stored in ClickHouse.  

2. **PHP Monolith API**  
   - Handles HTTP requests.  
   - Logs user actions (`page_view`, `video_start`, etc.) into ClickHouse via HTTP API.  

3. **Video Encoder**  
   - A containerized `ffmpeg` service.  
   - Accepts uploaded videos and encodes them into a standard format.  

4. **ClickHouse Database**  
   - Stores all events from the PHP Monolith.  
   - Provides analytics queries to the dashboard.  

5. **Infrastructure**  
   - Kubernetes for orchestration.  
   - Terraform + Helm for automated provisioning.  
   - GitHub Actions for CI/CD pipelines.  

---

## ⚙️ Tools & Technologies

- **Infrastructure as Code**: Terraform, Helm  
- **Containerization**: Docker  
- **Orchestration**: Kubernetes (Minikube locally / EKS/AKS/GKE in cloud)  
- **Languages**: PHP, Node.js, Bash  
- **Database**: ClickHouse  
- **CI/CD**: GitHub Actions  
- **Monitoring (future)**: Prometheus + Grafana  
- **Version Control**: Git + GitHub  

---

## 🚀 Deployment Flow

![Pipeline Diagram](pipeline.png)

1. **Developer Workflow**  
   - Code changes pushed to GitHub.  
   - Pull Requests trigger CI pipelines.  

2. **CI/CD Pipeline** (GitHub Actions)  
   - Build Docker images.  
   - Run tests and linting.  
   - Push to container registry.  
   - Deploy to Kubernetes using `kubectl` + Helm.  

3. **Kubernetes Deployment**  
   - Services (`php-monolith`, `video-encoder`, `dashboard`) deployed as pods.  
   - ClickHouse deployed via Helm chart.  
   - Services communicate internally via Cluster DNS.  

4. **Observability (optional)**  
   - Logs collected via Kubernetes logging stack.  
   - Metrics visualized in Grafana (future improvement).  

---

## 📂 Repository Structure

knowledgecity-devops/
├── apps/
│ ├── dashboard/ # Node.js dashboard (UI)
│ │ ├── Dockerfile
│ │ ├── server.js
│ │ └── k8s-deploy.yaml
│ ├── php-monolith/ # PHP API with ClickHouse integration
│ │ ├── Dockerfile
│ │ ├── index.php
│ │ ├── analytics.php
│ │ └── k8s-deploy.yaml
│ └── video-encoder/ # ffmpeg encoder
│ ├── Dockerfile
│ ├── encode.sh
│ └── k8s-deploy.yaml
├── terraform/ # IaC configs
│ ├── main.tf
│ ├── variables.tf
│ ├── outputs.tf
│ └── helm-clickhouse.tf
├── .github/workflows/ # CI/CD pipelines
│ └── ci-cd.yaml
└── README.md # Documentation


---

## 🛠️ How to Run Locally (Minikube)

1. **Start Minikube**  
   ```bash
   minikube start --memory=4096 --cpus=2


Build Images

docker build -t php-monolith:local ./apps/php-monolith
docker build -t video-encoder:local ./apps/video-encoder
docker build -t dashboard:local ./apps/dashboard
minikube image load php-monolith:local video-encoder:local dashboard:local


Deploy Infrastructure

kubectl create ns knowledgecity
kubectl apply -f apps/php-monolith/k8s-deploy.yaml -n knowledgecity
kubectl apply -f apps/video-encoder/k8s-deploy.yaml -n knowledgecity
kubectl apply -f apps/dashboard/k8s-deploy.yaml -n knowledgecity
terraform init && terraform apply -auto-approve


Access Dashboard

minikube service dashboard -n knowledgecity --url

📊 Learnings & Improvements
✅ What Was Achieved

End-to-end system setup with API, DB, encoder, and UI.

Kubernetes-native deployment.

Event logging into ClickHouse.

CI/CD workflow automation.

🔧 Improvements

Add monitoring with Prometheus + Grafana.

Secure communication with TLS/Ingress.

Store secrets in Vault/Secrets Manager.

Use AWS EKS (or Azure AKS) for production-scale deployment.

🔄 Alternatives

Replace PHP Monolith with Node.js microservices.

Use S3 + Lambda for video encoding (serverless).

Use PostgreSQL or BigQuery instead of ClickHouse.

📜 Proposal for Production

Migrate to AWS EKS for managed Kubernetes.

Use Terraform Cloud for IaC state management.

Integrate ArgoCD for GitOps-style deployments.

Enhance observability with distributed tracing.

Harden security with network policies and IAM roles.

👨‍💻 Author

dadeteye1
Senior DevOps Engineer | Cloud & IaC Specialist
