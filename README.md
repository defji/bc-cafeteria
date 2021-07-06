## Cafeteria test app

## Installation

Clone the repo:

```shell
git clone git@github.com:defji/bc-cafeteria.git
```

Edit .env file, and set database variables:

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=/home/full_path/to/bc-afeteria/database/database.sqlite
```

Do the following steps

```shell
composer install
touch ./database/database.sqlite
php artisan migrate
npm install
npm run dev 
php artisan serve

```

Open browser, and go to [http://127.0.0.1:8000](http://127.0.0.1:8000)






