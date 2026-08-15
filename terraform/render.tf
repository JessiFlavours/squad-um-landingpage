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
    DATABASE_URL      = { value = var.database_host }
    DATABASE_PORT     = { value = var.database_port }
    DATABASE_NAME     = { value = var.database_name }
    DATABASE_USER     = { value = var.database_user }
    DATABASE_PASSWORD = { value = var.database_password }
    DATABASE_CHARSET  = { value = "utf8mb4" }
    JWT_SECRET        = { value = var.jwt_secret }
  }
}
