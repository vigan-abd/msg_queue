#!/bin/bash
APP_CONTAINER="vg_msg_queue_app"
DOCKER_CMD="docker"
DOCKER_COMPOSE_CMD="docker-compose"
echo "Installing VG Message Queue"
$DOCKER_COMPOSE_CMD build
$DOCKER_COMPOSE_CMD up -d
sleep 10
$DOCKER_CMD exec $APP_CONTAINER service apache2 start
$DOCKER_CMD exec $APP_CONTAINER composer install
$DOCKER_CMD exec $APP_CONTAINER chmod -R 777 /var/www/vg_msg_queue/storage/
$DOCKER_CMD exec $APP_CONTAINER usermod -aG www-data root
$DOCKER_CMD exec $APP_CONTAINER usermod -aG root www-data
$DOCKER_CMD exec $APP_CONTAINER a2enmod rewrite
$DOCKER_CMD exec $APP_CONTAINER service apache2 restart
$DOCKER_CMD exec $APP_CONTAINER service cron start
$DOCKER_CMD exec $APP_CONTAINER php artisan key:generate
sleep 10
$DOCKER_CMD exec $APP_CONTAINER php artisan migrate -v
$DOCKER_CMD exec $APP_CONTAINER php artisan db:seed -v
sleep 10
$DOCKER_CMD exec $APP_CONTAINER php artisan storage:link