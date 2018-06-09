#!/bin/bash
APP_IMG="vg_msg_queue_app:0.7"
APP_CONTAINER="vg_msg_queue_app"
DB_CONTAINER="vg_msg_queue_db"
DOCKER_CMD="docker"
PMA_CONTAINER="vg_msg_queue_pma"

echo "Removing VG Message Queue"
echo "Stopping containers"
$DOCKER_CMD stop $APP_CONTAINER
$DOCKER_CMD stop $PMA_CONTAINER
$DOCKER_CMD stop $DB_CONTAINER

echo "Removing containers"
$DOCKER_CMD rm $APP_CONTAINER
$DOCKER_CMD rm $PMA_CONTAINER
$DOCKER_CMD rm $DB_CONTAINER

rm -rf ./public/storage

echo "Removing images"
$DOCKER_CMD rmi $APP_IMG