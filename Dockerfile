# Versao do PHP
FROM php:7.4-apache

# Instala as extensoes necessarias para o PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# Define o diretorio de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto para dentro do container
COPY . /var/www/html

# Ajusta permissoes para os logs e cache
RUN chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs

# Expoe a porta do Apache
EXPOSE 80
