# Serviço MySQL gerenciado no Aiven
resource "aiven_mysql" "tasks_db" {
  project      = var.aiven_project
  cloud_name   = "google-europe-west3" # troque pela região mais próxima, se quiser
  plan         = "free"
  service_name = "tasks-colaborativas-mysql"
}

# Banco de dados dentro do serviço
resource "aiven_mysql_database" "tasks_colaborativas" {
  project       = var.aiven_project
  service_name  = aiven_mysql.tasks_db.service_name
  database_name = "tasks_colaborativas"
}
