resource "render_web_service" "tasks_api" {
  name          = "tasks-colaborativas"
  plan          = "free"
  region        = "oregon"
  start_command = "php database/migrate.php && apache2-foreground"

  runtime_source = {
    image = {
      image_url = "docker.io/${var.dockerhub_username}/tasks-colaborativas"
      tag       = "latest"
    }
  }

  env_vars = {
    DATABASE_URL      = { value = aiven_mysql.tasks_db.service_host }
    DATABASE_PORT     = { value = tostring(aiven_mysql.tasks_db.service_port) }
    DATABASE_NAME     = { value = aiven_mysql_database.tasks_colaborativas.database_name }
    DATABASE_USER     = { value = aiven_mysql.tasks_db.service_username }
    DATABASE_PASSWORD = { value = aiven_mysql.tasks_db.service_password }
    DATABASE_CHARSET  = { value = "utf8mb4" }
    JWT_SECRET        = { value = var.jwt_secret }
  }
}
