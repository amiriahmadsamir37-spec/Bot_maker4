FROM php:8.2-cli
WORKDIR /app
RUN apt-get update \
    && apt-get install -y --no-install-recommends libcurl4-openssl-dev curl \
    && docker-php-ext-install curl \
    && rm -rf /var/lib/apt/lists/*
COPY . /app
RUN chmod +x /app/start.sh && mkdir -p /app/usersData /app/botsData /app/settings
EXPOSE 8080
CMD ["./start.sh"]
