#!/bin/bash

export COMPOSE_PROJECT_NAME="carreracup2"
export DOCKER_HTTP_PORT=1084
[ -z $GANTRY_ENV ] && export GANTRY_ENV="prod"
[ -z $APP_ENV ] && export APP_ENV="${GANTRY_ENV}"
[ -z $BOWER_VOL ] && export BOWER_VOL="`pwd`/bower_components"

# Dev setup
function setup() {
    _exec ./app/console doctrine:database:create

    #_exec ./app/console doctrine:schema:update --force
}

# Backup DB
function backup() {
    docker exec -it ${COMPOSE_PROJECT_NAME}_db_1 bash -c "/usr/lib/postgresql/9.4/bin/pg_dump -U postgres sixpence_collection > /tmp/backup.sql"
    if [ -z $1 ]; then
        local BACKUP_FILE=data/backup-$(date +%Y%m%d%H%M)-${GANTRY_ENV}.sql
    else
        local BACKUP_FILE=$1
    fi
    cp data/backup.sql $BACKUP_FILE
    gzip $BACKUP_FILE
}
# Restore DB
function restore() {
    echo "DROP DATABASE sixpence_collection;" > data/backup.sql
    echo "CREATE DATABASE sixpence_collection;" >> data/backup.sql
    docker exec -it ${COMPOSE_PROJECT_NAME}_db_1 bash -c "psql -U postgres < /tmp/backup.sql"
    zcat $1 > data/backup.sql
    docker exec -it ${COMPOSE_PROJECT_NAME}_db_1 bash -c "psql -U postgres sixpence_collection < /tmp/backup.sql"
}
# Start a secondary container, wait till it starts and stop old container
function start2() {

    ## If db is not started run build and run main start
    if [ -z "$(docker ps | grep -E "\b${COMPOSE_PROJECT_NAME}_db_1\b")" ]; then
        echo "Running Full Start"
        start
        _save
        exit 0
    fi


    export DOCKER_HTTP_PORT1="$DOCKER_HTTP_PORT";
    export DOCKER_HTTP_PORT2=$(echo "$DOCKER_HTTP_PORT+1" | bc);

    # Get Port Number
    if [ "$(docker ps | grep ${COMPOSE_PROJECT_NAME}_main | tr ' ' "\n" | grep tcp)" == "0.0.0.0:$DOCKER_HTTP_PORT1->80/tcp" ]; then
      export DOCKER_HTTP_PORT="$DOCKER_HTTP_PORT2"
      export STOP_DOCKER_HTTP_PORT="$DOCKER_HTTP_PORT1"
    else
      export DOCKER_HTTP_PORT="$DOCKER_HTTP_PORT1"
      export STOP_DOCKER_HTTP_PORT="$DOCKER_HTTP_PORT2"
    fi

    # Build
    build || exit 1

    # Ensure only 1 copy
    if [ -n "$(docker ps | grep -E "\b${COMPOSE_PROJECT_NAME}_main_${DOCKER_HTTP_PORT}\b")" ]; then
        docker stop ${COMPOSE_PROJECT_NAME}_main_${DOCKER_HTTP_PORT}
    fi
    if [ -n "$(docker ps -a | grep -E "\b${COMPOSE_PROJECT_NAME}_main_${DOCKER_HTTP_PORT}\b")" ]; then
        docker rm -v ${COMPOSE_PROJECT_NAME}_main_${DOCKER_HTTP_PORT}
    fi

    # Start
    docker run -d -p ${DOCKER_HTTP_PORT}:80 \
      --name ${COMPOSE_PROJECT_NAME}_main_${DOCKER_HTTP_PORT} \
      -v $PWD/src:/var/www/src \
      -v $PWD/app:/var/www/app \
      -v $PWD/web:/var/www/web \
      -v ${BOWER_VOL}:/var/www/bower_components \
      -v $PWD/composer.json:/var/www/composer.json \
      -v $PWD/composer.lock:/var/www/composer.lock \
      -v $PWD/data/logs:/var/www/var/logs \
      --restart always \
      --volumes-from sc_data_shared_1 \
      --link ${COMPOSE_PROJECT_NAME}_db_1:db \
      --link ${COMPOSE_PROJECT_NAME}_memcached_1:memcached \
      -e APP_ENV=${APP_ENV} \
      ${COMPOSE_PROJECT_NAME}_main || exit 1
      # --link ${COMPOSE_PROJECT_NAME}_elasticsearch_1:elasticsearch \

    # Wait for port to open
    echo "Waiting for http://$(_dockerHost):$DOCKER_HTTP_PORT";
    until $(curl --output /dev/null --silent --head --fail http://$(_dockerHost):${DOCKER_HTTP_PORT}); do
        printf '.'
        sleep 1
    done

    # Stop and remove old container
    docker stop ${COMPOSE_PROJECT_NAME}_main_${STOP_DOCKER_HTTP_PORT}
    docker rm -v ${COMPOSE_PROJECT_NAME}_main_${STOP_DOCKER_HTTP_PORT}

    _save
}