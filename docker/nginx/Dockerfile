# 最新安定版の 1.18 系で最新のものを入れる
FROM nginx:1.18-alpine
ENV APP_ROOT /usr/src/canoline

RUN mkdir -p $APP_ROOT
COPY ./public $APP_ROOT/public
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/conf.d/canoline.conf /etc/nginx/conf.d/canoline.conf