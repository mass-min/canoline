# Aurora MySQL が MySQL 8.x と互換性のあるバージョンを公開していないので、5.7.x で最新のものを入れる
# https://github.com/docker-library/mysql/blob/3fde29717aea785d4e37a97c9990ff0fda37e544/5.7/Dockerfile.debian
FROM mysql:5.7

ENV MY_CNF_PATH /etc/mysql/conf.d/my.cnf
COPY ./docker/mysql$MY_CNF_APTH $MY_CNF_APTH
