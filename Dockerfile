FROM phpswoole/swoole
WORKDIR /var/www

ADD composer.json .
ADD composer.lock .
RUN composer install --prefer-dist --no-dev --optimize-autoloader

ADD server.php .