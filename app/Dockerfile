# Dockerfile do app/ (MVC em PHP)
# Este arquivo deve ficar dentro da pasta app/, junto com composer.json e index.php

FROM php:8.2-apache

# Extensões e dependências necessárias
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2enmod rewrite

# Composer (copiado da imagem oficial, sem precisar instalar via script)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Permite que o .htaccess (com AllowOverride) funcione dentro do container
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copia primeiro só o composer.json/lock pra aproveitar cache de build
COPY composer.json composer.lock* ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Agora copia o restante do código
COPY . .

# Ajusta permissões (evita problemas de escrita em cache/logs, se houver)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
