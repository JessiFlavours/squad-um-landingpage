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

variable "jwt_secret" {
  description = "Chave usada pra assinar os tokens JWT em produção"
  type        = string
  sensitive   = true
}