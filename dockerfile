FROM php:8.2-apache

WORKDIR /var/www/html

# ติดตั้ง extensions
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip \
    mariadb-client \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# ติดตั้ง Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# คัดลอกเฉพาะไฟล์ที่จำเป็นสำหรับการติดตั้ง dependencies ก่อน
COPY composer.json composer.lock ./

# ติดตั้ง dependencies
RUN composer install --no-dev --no-scripts --no-autoloader

# คัดลอกไฟล์ทั้งหมด
COPY . .

# สร้าง autoloader
RUN composer dump-autoload --optimize

# ตั้งสิทธิ์ไฟล์
RUN chmod -R 777 storage bootstrap/cache

# คัดลอกไฟล์การตั้งค่า Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# เปิด mod_rewrite
RUN a2enmod rewrite
