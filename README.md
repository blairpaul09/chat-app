## Install packages and dependencies

```
composer install
```

## Install packages and dependencies for front end

```
npm install
```

## Build front end assets

```
npm run build
```

## Setting up env

Create a .env file and copy the contents of .env.example

## Setting up database

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chat-app
DB_USERNAME=root
DB_PASSWORD=root
```

Change the database configuration with your local credentials. Make sure to use MySql.

Run migration

```
php artisan migrate
```

Run users seeder

```
php artisan db:seed --class=UsersSeeder
```

All users have the same password `password`



## Running the app locally

```
php artisan serve
```

INFO  Server running on [http://127.0.0.1:8000].  


