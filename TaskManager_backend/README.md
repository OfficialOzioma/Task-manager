# Task Manager Backend

**This is backend graphql API for the task manager application written with laravel framework**

## Technologies

- PHP 8.1
- Laravel 10
- MySQL 8.0.27
- GraphQL
- composer

## How to install

### Note

You need install PHP version 8.1 to run this project and composer

- Install dependencies

 ```bash
Composer install
```

- Create a `.env` file by copying the `.env.example` file

```bash
cp .env.example .env
```

- Generate application key

```bash
php artisan key:generate
```

- Create a database and update the `.env` file with your database credentials

- Migrate database

```bash
php artisan migrate
```

- Seed database

```bash
php artisan db:seed
```

- Start the application

```bash
php artisan serve
```

- Visit the application on your browser on the url `http://localhost:8000`

## GraphQL API Routes

- Visit the application payground on your browser on the url `http://localhost:8000/graphiql`

## GraphQl Queries

 This are some of the graphql queries you can run on the playground

```bash


```

## License

[MIT license](https://opensource.org/licenses/MIT).
