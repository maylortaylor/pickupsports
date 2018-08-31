# Pick Up Sports application
## Using PHP Laravel, mySQL

### Steps to run:
1. Go to `.env` file and setup your local variables for your **DATABASE*, **DB_USER**, **DB_PASSWORD**, and any other variables you need/want to setup
2. Once your database environment is setup, run 

        php artisan migrate:fresh --seed

    - this will run all migrations located in `database/migrations` folder && all seeds in `database/seeds` folder


## Helpful things

You can use `Psy Shell` ([Tinker](https://laravel-news.com/laravel-tinker)) to help look at important info quickly.

Open the shell by navigating to the root folder of the application and running 

        php artisan tinker

Once you are in the shell, look at a database model by running

        App\Sport::first()