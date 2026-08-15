variable "aiven_api_token" {
  description = "Token de API do Aiven"
  type        = string
  sensitive   = true
}

variable "aiven_project" {
  description = "Nome do projeto no Aiven"
  type        = string
}

variable "render_api_key" {
  description = "Token de API do Render"
  type        = string
  sensitive   = true
}

variable "render_owner_id" {
  description = "ID da conta/workspace no Render (encontrado na URL do dashboard)"
  type        = string
}

variable "dockerhub_username" {
  description = "Usuário do Docker Hub, usado pra montar o nome completo da imagem"
  type        = string
}

variable "database_host" {
  description = "Host do MySQL criado manualmente no Console do Aiven"
  type        = string
}

variable "database_port" {
  description = "Porta do MySQL no Aiven (não é a 3306 padrão)"
  type        = string
  default     = "21903"
}

variable "database_name" {
  description = "Nome do banco (criado manualmente no Console do Aiven)"
  type        = string
  default     = "tasks_colaborativas"
}

variable "database_user" {
  description = "Usuário do MySQL criado manualmente no Console do Aiven"
  type        = string
  default     = "avnadmin"
}

variable "database_password" {
  description = "Senha do MySQL criado manualmente no Console do Aiven"
  type        = string
  sensitive   = true
}

variable "jwt_secret" {
  description = "Chave usada pra assinar os tokens JWT em produção"
  type        = string
  sensitive   = true
}
