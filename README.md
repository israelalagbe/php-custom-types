# Custom PHP Types
This package holds some custom PHP types such as Array and String. It provides functionalities similar to array and string in Javascript.

## Installation
Require this package

```sh
composer require israelalagbe/php-custom-types
```

## Array Types

### Basic Usage
You can use it the following way

```php
use IsraelAlagbe\CustomTypes\_Array;

// Creating an array
$items = new _Array([1, 2, 3]); // or new _Array(1, 2, 3)

// Push items
$items->push(4);        // [1, 2, 3, 4]
$items->push(5, 6);     // [1, 2, 3, 4, 5, 6]

// Map through items
$doubled = $items->map(function($item) {
    return $item * 2;
});  // [2, 4, 6, 8, 10, 12]

echo $doubled; // Outputs: [2, 4, 6, 8, 10, 12]

// To get the original PHP array
print_r($items->toArray()); // [1, 2, 3, 4, 5, 6]
```

### Iterating with foreach
The `_Array` class implements `IteratorAggregate`, so you can iterate using a standard `foreach` loop:

```php
use IsraelAlagbe\CustomTypes\_Array;

$fruits = new _Array(['apple', 'banana', 'cherry']);

// Standard foreach loop
foreach ($fruits as $fruit) {
    echo $fruit . '\n';
}
// Output:
// apple
// banana
// cherry

// Foreach with keys
foreach ($fruits as $index => $fruit) {
    echo "$index: $fruit" . '\n';
}
// Output:
// 0: apple
// 1: banana
// 2: cherry

// Using forEach method (callback style)
$fruits->forEach(function($fruit, $index) {
    echo "Item $index is $fruit" . '\n';
});
```

### Filtering and Searching

```php
use IsraelAlagbe\CustomTypes\_Array;

$numbers = new _Array([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

// Filter even numbers
$evens = $numbers->filter(function($n) {
    return $n % 2 === 0;
}); // [2, 4, 6, 8, 10]

// Check if value exists
$numbers->contains(5);     // true
$numbers->contains(100);   // false

// Find index of a value
$numbers->indexOf(3);      // 2
$numbers->indexOf(100);    // -1

// Check if key exists
$numbers->has(0);          // true
$numbers->has(100);        // false
```

### Stack Operations

```php
use IsraelAlagbe\CustomTypes\_Array;

$stack = new _Array([1, 2, 3]);

// Push to the end
$stack->push(4);       // [1, 2, 3, 4]

// Pop from the end
$last = $stack->pop(); // Returns 4, array is now [1, 2, 3]

// Unshift (add to beginning)
$stack->unshift(0);    // [0, 1, 2, 3]

// Shift (remove from beginning)
$first = $stack->shift(); // Returns 0, array is now [1, 2, 3]
```

### Array Manipulation

```php
use IsraelAlagbe\CustomTypes\_Array;

$arr = new _Array(['a', 'b', 'c', 'd', 'e']);

// Join elements
$arr->join('-');        // "a-b-c-d-e"
$arr->join(', ');       // "a, b, c, d, e"

// Reverse array
$reversed = $arr->reverse(); // ['e', 'd', 'c', 'b', 'a']

// Slice array
$sliced = $arr->slice(1, 3); // ['b', 'c', 'd']

// Get keys and values
$arr->keys();           // [0, 1, 2, 3, 4]
$arr->values();         // ['a', 'b', 'c', 'd', 'e']

// Get length
$arr->length();         // 5
count($arr);            // 5 (Countable interface)

// Remove specific value
$arr->remove('c');      // ['a', 'b', 'd', 'e']

// Clear array
$arr->clear();          // []
```

### Array Access

```php
use IsraelAlagbe\CustomTypes\_Array;

$arr = new _Array(['x', 'y', 'z']);

// Access by index
echo $arr[0];           // 'x'
echo $arr[2];           // 'z'

// Use item() for negative index support
echo $arr->item(-1);    // 'z' (last element)
echo $arr->item(-2);    // 'y' (second to last)

// Set by index
$arr[1] = 'Y';          // ['x', 'Y', 'z']
$arr[] = 'w';           // ['x', 'Y', 'z', 'w']

// Check if index exists
isset($arr[0]);         // true

// Unset index
unset($arr[0]);
```

### Conversion Methods

```php
use IsraelAlagbe\CustomTypes\_Array;

$arr = new _Array(['name' => 'John', 'age' => 30]);

// Convert to native PHP array
$native = $arr->toArray();  // ['name' => 'John', 'age' => 30]

// Convert to JSON
$json = $arr->toJSON();     // '{"name":"John","age":30}'

// String representation
echo $arr;                  // [John, 30]
```

---

## String Types

### Basic Usage

```php
use IsraelAlagbe\CustomTypes\_String;

// Creating a string
$str = new _String('Hello World');

echo $str;              // Hello World
echo $str->count();     // 11
```

### Searching and Checking

```php
use IsraelAlagbe\CustomTypes\_String;

$str = new _String('The quick brown fox jumps over the lazy dog');

// Find index of substring
$str->indexOf('quick');     // 4
$str->indexOf('cat');       // -1 (not found)

// Check if contains substring
$str->contains('fox');      // true
$str->contains('cat');      // false
```

### String Manipulation

```php
use IsraelAlagbe\CustomTypes\_String;

$str = new _String('  Hello World  ');

// Trim whitespace
$trimmed = $str->trim();    // 'Hello World'

// Reverse string
$str2 = new _String('Hello');
$reversed = $str2->reverse(); // 'olleH'

// Clear string
$str2->clear();             // ''
```

### Splitting Strings

```php
use IsraelAlagbe\CustomTypes\_String;

$str = new _String('apple,banana,cherry');

// Split by delimiter
$fruits = $str->split(',');  // _Array(['apple', 'banana', 'cherry'])

// Split into characters
$str2 = new _String('Hello');
$chars = $str2->split('');   // _Array(['H', 'e', 'l', 'l', 'o'])

// Split with no delimiter (returns single-element array)
$single = $str->split();     // _Array(['apple,banana,cherry'])
```

### Template Substitution

```php
use IsraelAlagbe\CustomTypes\_String;

$template = new _String('Hello, {name}! You are {age} years old.');

$result = $template->substitute([
    'name' => 'John',
    'age' => 25
]); // 'Hello, John! You are 25 years old.'

// Missing placeholders are removed
$template2 = new _String('{greeting}, {name}!');
$result2 = $template2->substitute(['name' => 'Alice']); // ', Alice!'
```

### Case Conversion

```php
use IsraelAlagbe\CustomTypes\_String;

// Convert to camelCase (from dash-case)
$str = new _String('my-variable-name');
$camel = $str->camelCase(); // 'myVariableName'
```

### Array Access and Iteration

```php
use IsraelAlagbe\CustomTypes\_String;

$str = new _String('Hello');

// Access individual characters
echo $str[0];              // 'H'
echo $str[4];              // 'o'

// Iterate through characters
foreach ($str as $index => $char) {
    echo "$index: $char" . '\n';
}
// Output:
// 0: H
// 1: e
// 2: l
// 3: l
// 4: o

// Count characters
echo count($str);          // 5
```

### Conversion Methods

```php
use IsraelAlagbe\CustomTypes\_String;

$str = new _String('Hello');

// Convert to array of characters
$chars = $str->toArray();   // ['H', 'e', 'l', 'l', 'o']

// Convert to JSON
$json = $str->toJSON();     // '"Hello"'
```

### Chaining Methods

```php
use IsraelAlagbe\CustomTypes\_String;

// Methods that return new _String instances can be chained
$str = new _String('  hello-world  ');

$result = $str->trim()->camelCase(); // 'helloWorld'
```

---

## Testing
If you forked this package, you can test using the command below.

```sh
composer test
```

## License

MIT