FROM eu.gcr.io/websmunicipals/api-component:v1

COPY apache2/default.conf /etc/apache2/sites-enabled/000-default.conf

COPY --chown=www-data:www-data wwwroot/app/api /var/www/html/app/api
COPY --chown=www-data:www-data wwwroot/app/DB/login.php /var/www/html/app/DB/

ENV APACHE_LOG_DIR=/var/log/apache2$SUFFIX
