#FRONTEND
FROM node:20 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .

RUN npm run build


#BACKEND
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    git curl zip unzip supervisor \
    libonig-dev libxml2-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN sed -i 's/upload_max_filesize = .*/upload_max_filesize = 50M/' /usr/local/etc/php/php.ini \
 && sed -i 's/post_max_size = .*/post_max_size = 50M/' /usr/local/etc/php/php.ini

RUN apt-get update && apt-get install -y \
    python3 python3-pip python3-venv \
    build-essential libffi-dev libssl-dev libbz2-dev libreadline-dev libsqlite3-dev \
    zlib1g-dev libncurses5-dev libncursesw5-dev liblzma-dev

RUN python3 -m pip install --no-cache-dir --upgrade pip --break-system-packages \
 && python3 -m pip install --no-cache-dir flask --break-system-packages
 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY --from=frontend /app/public/build ./public/build

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN chown -R www-data:www-data /var/www && chmod -R 775 storage bootstrap/cache

COPY default.conf /etc/nginx/sites-available/default
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN composer dump-autoload

EXPOSE 80

CMD ["/usr/bin/supervisord"]