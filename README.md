# Laravel Project Setup

```bash
git clone https://github.com/NekoIchigo/todo_list_laravel
cd todo_list_laravel

composer install
npm install

```

Copy the .env.example file to .env and update the following configurations:

```bash

SESSION_DRIVER=cookie
SESSION_DOMAIN=localhost
SANCTUM_STATEFUL_DOMAINS=localhost:5173

```

Ensure that you run migrations with the seeder
```bash

php artisan migrate --seed
php artisan serve

```
