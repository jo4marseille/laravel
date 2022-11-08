
FROM --platform=linux/x86-64 php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user=sammy
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip



# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ADD . /var/www
# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user && \
    chown -R $user:$user /var/www/storage && \
    chown -R $user:$user /var/www/bootstrap

# Set working directory
WORKDIR /var/www

RUN composer install
RUN composer update
RUN composer update
# RUN php artisan migrate
RUN php artisan key:generate
# RUN php artisan storage:link

USER $user