## About
Simple symfony application with audit logging on service entity changes.
Application contains (from ./docker-compose.yml):
```
nginx - Nginx web-server
php-fpm - request processing via PHP
app-db - mysql8 server
audit-db - Mongo DB for entity changes logging
mongo-express - simple web view for mongo DB
```
Nginx exposed on 80 port, Mongo web - on 8081

## Requirements
Docker / docker-compose

## Start the app
```
make build
make up # wait for a few seconds until mysql starts
make migrate
```
Go to http://localhost:80/register
