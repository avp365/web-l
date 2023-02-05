ARG COMPOSER
ARG PROJECT_IMAGE

FROM ${COMPOSER} as composer

FROM  ${PROJECT_IMAGE} as project
COPY --from=composer /usr/bin/composer  /usr/bin/composer 

# Для composer cache разрешим запись в директорию
RUN chown -R www-data /var/www



