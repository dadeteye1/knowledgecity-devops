resource "helm_release" "clickhouse" {
  name       = "clickhouse"
  repository = "https://charts.altinity.com"
  chart      = "clickhouse"
  namespace  = "knowledgecity"
}
