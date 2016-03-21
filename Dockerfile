FROM rainsystems/symfony:latest

RUN apt-get update && apt-get install -y git

RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
RUN php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) === '41e71d86b40f28e771d4bb662b997f79625196afcca95a5abf44391188c695c6c1456e16154c75a211d238cc3bc5cb47') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/usr/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

RUN docker-php-ext-install zip
RUN docker-php-ext-install zip

COPY app /var/www/app
COPY src /var/www/src
COPY web /var/www/web
COPY bin /var/www/bin
COPY composer.json /var/www/composer.json
COPY composer.lock /var/www/composer.lock

VOLUME /var/www/vendor
VOLUME /var/www/var/logs
VOLUME /var/www/bower_components

COPY entrypoint.sh /entrypoint
RUN chmod +x /entrypoint
ENTRYPOINT /entrypoint
