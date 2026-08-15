output "api_url" {
  description = "URL pública da API no Render"
  value       = render_web_service.tasks_api.url
}

output "database_host" {
  description = "Host do banco MySQL no Aiven"
  value       = aiven_mysql.tasks_db.service_host
  sensitive   = true
}
