resource "aws_s3_bucket" "assets" {
  bucket = "${var.project}-${var.environment}-assets"

  tags = {
    Project = "knowledgecity"
    Env     = var.environment
  }
}

resource "aws_ebs_volume" "clickhouse_data" {
  availability_zone = "${var.region}a"
  size              = 20
  type              = "gp3"
  tags = {
    Name = "clickhouse-data"
  }
}
