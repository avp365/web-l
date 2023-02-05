FROM  nginx:1.20

RUN usermod -aG www-data nginx \
    && usermod -u 1000 nginx

COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /app