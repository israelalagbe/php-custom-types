# Custom PHP Types
This package holds some custom PHP types such as Array and String. It provides functionalities similar to array and string in Javascript.

## Installation
Require this package

```sh
composer require israelalagbe/custom-php-types
```
## Array Types
### Basic Usage
You can .

```php
$items = new _Array([1,2]); // or _Array(1, 2)
$items->push(4); // [1,2,4]
$items->map(function($item) {
    return $item * 2;
});  // [2, 4, 8]

echo $items;

//To get the original array, you can use
print_r($items->toArray()); // [2, 4, 8]

```

## Testing
If you forked this package, you can test using the command below.

```sh
composer test
```

License
----

APACHE 2.0