# 基礎 PHP 版本 8.4 + FPM
FROM php:8.4-fpm

# 安裝系統依賴和 composer
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip

# 安裝 composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# 設定工作目錄
WORKDIR /var/www/html

# 複製專案
COPY . .

# 安裝依賴
RUN composer install --optimize-autoloader --no-dev

# Laravel 可寫目錄
RUN chmod -R 775 storage bootstrap/cache

# 啟動 Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
