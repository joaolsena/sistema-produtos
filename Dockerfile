# Usa imagem PHP 8.4 com Apache
FROM php:8.4-apache

# Instala dependências do sistema e a extensão gd
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Copia os arquivos do projeto
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Instala dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install --no-dev --optimize-autoloader

# Configura o Apache para servir a pasta "public"
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's|/var/www/|/var/www/html/public|g' /etc/apache2/apache2.conf && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expõe a porta padrão do Apache
EXPOSE 80

# Inicia o Apache
CMD ["apache2-foreground"]
