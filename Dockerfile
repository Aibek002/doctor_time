# PHP-FPM Dockerfile
FROM php:8.3-fpm

# Install system deps and PHP extensions commonly used in web apps
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libicu-dev \
    libxml2-dev \
    pkg-config \
    libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
    pdo \
    pdo_mysql \
    mysqli \
    mbstring \
    zip \
    gd \
    intl \
    bcmath \
    xml \
    opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (copy from official composer image)
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Create non-root user and working directory
ARG APP_USER=www
ARG APP_UID=1000
RUN useradd -u ${APP_UID} -m -U -s /bin/bash ${APP_USER}
WORKDIR /var/www/html
RUN chown -R ${APP_USER}:${APP_USER} /var/www/html

# Copy application (adjust as needed) and set permissions
# COPY . /var/www/html
# RUN chown -R ${APP_USER}:${APP_USER} /var/www/html

# Switch to non-root user
USER ${APP_USER}

# Expose PHP-FPM port
EXPOSE 9000

# Healthcheck (optional)
HEALTHCHECK --interval=30s --timeout=5s --start-period=5s CMD ["php-fpm", "-t"] || exit 1

# Default command
CMD ["php-fpm"]