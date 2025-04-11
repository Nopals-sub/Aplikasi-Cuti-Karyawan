# Gunakan image dasar PHP 7.4 dengan Apache
FROM php:7.4-apache

# Set working directory di dalam container
WORKDIR /var/www/html

# Instal dependensi dan aktifkan ekstensi mysqli
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && docker-php-ext-install mysqli \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Salin semua file proyek ke direktori kerja
COPY . /var/www/html

RUN chmod -R 777 /var/www/html/admin/gambar_admin/
# Ekspos port 80 untuk akses web
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]