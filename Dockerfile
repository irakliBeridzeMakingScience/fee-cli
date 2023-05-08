FROM php:8.2-cli-alpine
WORKDIR /zero

ADD ./ /zero

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --no-plugins --no-scripts

ENTRYPOINT ["/zero/fee-calculator"]