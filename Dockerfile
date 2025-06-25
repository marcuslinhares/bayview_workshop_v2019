FROM php:8.1-apache

# Ativa extensões necessárias (PDO + MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Copia todos os arquivos do projeto para o Apache
COPY . /var/www/html/

# Dá permissão para o Apache acessar
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta padrão do Apache
EXPOSE 80
