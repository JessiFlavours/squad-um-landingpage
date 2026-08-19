# =============================================================================
# Stage 1: Builder — Instala dependências e compila o projeto
# =============================================================================
FROM composer:2.7 AS builder
WORKDIR /app

# Copia primeiro os arquivos de dependência 
COPY composer.json composer.lock* ./

# Instala apenas as dependências de produção
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copia o restante do código fonte
COPY . .

# Gera o autoloader final otimizado
RUN composer dump-autoload --optimize --classmap-authoritative


# =============================================================================
# Stage 2: Runner — Imagem final de produção (Apache)
# =============================================================================
FROM php:8.2-apache AS runner

# Instala apenas o necessário para rodar o app
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Configura o Apache para aceitar o .htaccess (AllowOverride All)
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copia a aplicação construída no Stage 1 com as permissões corretas
COPY --from=builder --chown=www-data:www-data /app /var/www/html

# =============================================================================
# ENTRYPOINT — Configuração de Inicialização e Migrations
# =============================================================================

# Corrige quebras de linha se o script foi criado no Windows e dá permissão de execução
RUN sed -i 's/\r$//' /var/www/html/entrypoint.sh \
    && chmod +x /var/www/html/entrypoint.sh

EXPOSE 80

# Substitui o comando padrão do Apache pelo seu script de entrada
CMD ["sh", "/var/www/html/entrypoint.sh"]
