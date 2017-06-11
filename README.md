How to build a REST API with Laravel 5.4
===

We are going to create a simple REST API using Laravel 5. The application will be able to create, read, update and delete (CRUD) businesses from the database. We will store the name, location and description for businesses within a SQLite database.

Laravel is an awesome web framework for PHP that makes it really easy to build powerful web applications. 

Prereq: [Install Laravel](https://laravel.com/docs/5.4/installation)

First create a brand spanking new Laravel 5.4 project:

```
$ laravel new laravel-5-rest-api
$ cd  laravel-5-rest-api
$ composer install
$ touch .env
$ php artisan key:generate
```

Copy over the contents of **.env.example** into the newly created **.env** file. From there, we're going to generate a key and set it for our application. This is a common hurtle documented on github [here](https://github.com/phanan/koel/issues/516) and [here](https://github.com/laravel/framework/issues/9080). The fix is easy though! Copy the output contents of the key:generate command and paste that value into the .env file like so:

```
APP_KEY=base64:keygoesherenotpostingmyrealkey
```

Then run:

```
$ php artisan config:clear
$ php artisan config:cache
$ php artisan serve
```
The application will be accessible to your local development environment. Open a web browser to http://localhost:8000/.

![](https://cdn.scotch.io/2842/jsXU2z8hSn2WnQJDqqcC_Screen%20Shot%202017-06-10%20at%208.46.37%20PM.png)

Generate the model and resource controller.
```
$ php artisan make:model Business -mr
Model created successfully.
Created Migration: 2017_06_11_034845_create_businesses_table
Controller created successfully.
```

This command creates a database migration in **database/migrations/TIMESTAMP_GOES_HERE_create_businesses_table.php** and a [resource controller](https://laravel.com/docs/5.3/controllers#resource-controllers) in **app/Http/Controllers/BusinessController.php**.

In the migration file we define how the Businesses database table will look. Add the definition for the name, lat, long and description columns.

```
...
class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->timestamps();
        });
    }
...
```

### Set up SQLite

Laravel 5 supports MySQL, Postgres, SQLite, and SQL Server. To use MySQL and Sequel Pro check out [this post](https://medium.com/@connorleech/build-an-online-forum-with-laravel-initial-setup-and-seeding-part-1-a53138d1fffc). For SQLite follow the steps below. Either should work with minimal configuration headache.

Add a sqlite database file in the project root. Next, add the absolute file path to that file in our project's .env file. To output the file path location we can use the php artisan tinker command.

```
$ touch database/database.sqlite
$ php artisan tinker
Psy Shell v0.8.0 (PHP 5.6.27 — cli) by Justin Hileman
>>> database_path(‘database.sqlite’)
=> "/Users/connorleech/Projects/laravel-5-rest-api/database/database.sqlite"
```

The database section of my environment file looks like:

```
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=/Users/connorleech/Projects/laravel-5.3-app/database/database.sqlite
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Then create the database and set everything up:
```
$ php artisan migrate:install
$ php artisan migrate
```
This wil create the businesses table and database connection. 

### Create Resource Routes and Controller

Add one line in **routes/web.php**:

```
Route::resource('/businesses', 'BusinessController');
```

This will generate the below routes for Creating, Reading, Updating and Deleting businesses.

![The resource controller routes available to our application](https://cdn.scotch.io/2842/Mf4pMJdQQilZtzxyosAQ_Screen%20Shot%202017-06-10%20at%209.22.56%20PM.png)















