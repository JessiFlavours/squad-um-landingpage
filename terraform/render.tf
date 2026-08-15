resource "render_web_service" "tasks_api" {
  name    = "tasks-colaborativas"
  plan    = "free"
  region  = "oregon"
  owner_id = var.render_owner_id

  runtime_source = {
    image = {
      image_url = "docker.io/${var.dockerhub_username}/tasks-colaborativas:latest"
    }
  }

  env_vars = {
    DATABASE_URL      = { value = aiven_mysql.tasks_db.service_host }
    DATABASE_NAME     = { value = aiven_database.tasks_colaborativas.database_name }
    DATABASE_USER     = { value = aiven_mysql.tasks_db.service_username }
    DATABASE_PASSWORD = { value = aiven_mysql.tasks_db.service_password }
    DATABASE_CHARSET  = { value = "utf8mb4" }
    JWT_SECRET        = { value = var.jwt_secret }
  }
}
