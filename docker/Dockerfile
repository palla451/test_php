#PHP base container, contiene la base per i container di dev e prod
FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

RUN apt-get update && apt-get install -y software-properties-common

# Install system dependencies
RUN apt-get update && apt-get install -y \
    sudo \
    vim  \
    nano \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    librabbitmq-dev \
    libssl-dev \
    gettext-base \
    rsync  \
    ssh  \
    sshpass \
    libpq-dev \
    libldb-dev \
    libldap2-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets pdo pdo_pgsql pgsql ldap zip

# Use default "production" configuration
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user


# build app
WORKDIR /var/www/laravel


#ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]



