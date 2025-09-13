FROM php:8.2-apache
COPY public/ /var/www/html/
# turn off secure XML parsing, disable any PHP security settings you might normally have
RUN a2enmod rewrite
EXPOSE 80
