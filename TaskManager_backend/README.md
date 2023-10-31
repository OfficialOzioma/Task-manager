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

 This are some of the graphql queries and mutations you can run on the playground

```bash
mutation {

     register(
    name:"John Doe"
    email:"john.doe@example.com"
    password: "password"
  ) {
    status
    message
    user{
      name
    }
  }

    login(email: "john.doe@example.com", password: "password" )
  {
    status
    token
    message
   
  } 

   createTask(
    title:"my title 15",
    category_id: 4, 
    description: "This is my description"
    due_date: "2023-10-27",
  ){
    status
    message
    task{
      title
      unique_id
    }
  }
  
  updateTask(
    unique_id: "6a11abe8-571d-41b6-a9e0-7a3389da9886",
    title: "my title updated now",
    status: "Completed"
  ){
    status
    message
    task{
      title
    }
  }
}

query {
  tasks{
    data {
      id
      unique_id
      title
      description
    }
  }

  taskCategories{
    data{
      id
      name
    }
  }
  
  categories{
    id
    name
  }
  
  task(unique_id: "fa9c5f5b-7baf-4a71-a51c-f67da15b421d"){
    title
    description
  }
  
  searchTask(title: "my title"){
    unique_id
    title
  }
  
}

```

## License

[MIT license](https://opensource.org/licenses/MIT).
