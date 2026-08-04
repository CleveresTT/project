# docker/backend.Dockerfile
FROM php:8.3-fpm

# Устанавливаем системные пакеты и PHP-расширения
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_pgsql zip \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/project/backend

# Копируем Composer из официального образа
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Устанавливаем переменную окружения по умолчанию
ENV APP_ENV=prod

# Сначала копируем только composer-файлы для кеширования слоя
COPY backend/composer.json backend/composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Копируем весь код бэкенда
COPY backend/ ./

RUN composer dump-autoload --optimize --no-dev

# Копируем entrypoint-скрипт и делаем его исполняемым
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

CMD ["/usr/local/bin/entrypoint.sh"]
