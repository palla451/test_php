# PHP base container
FROM php:8.2-fpm

# Arguments definiti in docker-compose.yml
ARG user
ARG uid

WORKDIR /tmp

# Installa dipendenze di sistema
RUN apt-get update && apt-get install -y \
    sudo \
    vim \
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
    rsync \
    ssh \
    sshpass \
    libpq-dev \
    libldb-dev \
    libldap2-dev \
    git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installa estensioni PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets pdo pdo_pgsql pgsql ldap zip

# Ottieni l'ultima versione di Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crea un utente di sistema per eseguire Composer e comandi Artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Imposta la directory di lavoro per l'applicazione
WORKDIR /var/www/laravel

# Copia i file di Composer
COPY composer.json composer.lock ./

# Debug temporaneo di composer
RUN composer install --no-dev --prefer-dist --optimize-autoloader || echo "Composer failed but continuing for debugging"

# Imposta i permessi appropriati
RUN chown -R $user:$user /var/www/laravel

# Copia lo script entrypoint.sh nel container
COPY docker/entrypoint.sh /usr/local/bin/
RUN chmod 777 /usr/local/bin/entrypoint.sh

# Espone la porta 9000
EXPOSE 9000

# Imposta l'entrypoint per lanciare lo script
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Comando default
CMD ["php-fpm"]
