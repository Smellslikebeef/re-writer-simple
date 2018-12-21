FROM ramadhan/docker-php7.2-nginx-alpine

# install composer & prestissimo
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer global require hirak/prestissimo

WORKDIR /var/www/app

COPY composer.lock composer.json /home/projects/
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY docker/fpm.conf /etc/php7/php-fpm.d/www.conf

COPY . /var/www/app

RUN composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-suggest \
        && composer clear-cache

EXPOSE 80