FROM ubuntu:20.04
ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update
RUN apt -y install curl wget
RUN apt install php7.4 php7.4-fpm php7.4-dev php7.4-xml php7.4-zip unzip php7.4-curl php7.4-gd php7.4-xdebug php7.4-intl php7.4-mbstring php7.4-json  -y --allow-unauthenticated
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/bin/composer
RUN pecl install redis
RUN apt install apache2 -y
COPY http-vhosts.conf /etc/apache2/sites-available/http-vhosts.conf
COPY php-fpm/php.ini /etc/php/7.4/fpm/php.ini
COPY php-fpm/www.conf /etc/php/7.4/fpm/pool.d/www.conf
RUN a2enmod proxy_fcgi
RUN a2ensite http-vhosts.conf
EXPOSE 80
CMD chmod 777 -R /app && service php7.4-fpm start && apachectl -D FOREGROUND