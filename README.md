# Custom PHP Types
This package holds some custom PHP types such as Array and String. It provides functionalities similar to array and string in Javascript.

## Installation
Require this package

```sh
composer require israelalagbe/custom-php-types
```

After adding the package, add the ServiceProvider to the providers array in config/app.php

```
OneMustCode\Laravel\LaravelServiceProvider::class,
```
## Array Types
### Array2()
The **is** method is an marco that is attached to the Route Facade. It's just like the **is** method on the Request Facade, but then for route names.

```php
$items = new Array2([1,2,4,5]); // [1,2,4]
$items->push(4);
```
### Route::is()
The **is** method is an marco that is attached to the Route Facade. It's just like the **is** method on the Request Facade, but then for route names.

```php
$bool = Route::is('route.name', 'other.route*'); // [1,2,4]
```

License
----

APACHE 2.0