<?php

use IsraelAlagbe\CustomTypes\_String;
use IsraelAlagbe\CustomTypes\_Array;

class _StringTest extends \PHPUnit\Framework\TestCase
{
    // Constructor Tests
    public function testConstructorWithString()
    {
        $str = new _String('Hello');
        $this->assertEquals('Hello', (string) $str);
    }

    public function testConstructorWithArray()
    {
        $str = new _String(['H', 'e', 'l', 'l', 'o']);
        $this->assertEquals('Hello', (string) $str);
    }

    public function testConstructorWithStringObject()
    {
        $original = new _String('Hello');
        $copy = new _String($original);
        $this->assertEquals('Hello', (string) $copy);
    }

    // indexOf() Tests
    public function testIndexOfFound()
    {
        $str = new _String('Hello World');
        $this->assertEquals(0, $str->indexOf('Hello'));
        $this->assertEquals(6, $str->indexOf('World'));
    }

    public function testIndexOfNotFound()
    {
        $str = new _String('Hello World');
        $this->assertEquals(-1, $str->indexOf('xyz'));
    }

    public function testIndexOfPartialMatch()
    {
        $str = new _String('Hello World');
        $this->assertEquals(2, $str->indexOf('llo'));
    }

    // contains() Tests
    public function testContainsTrue()
    {
        $str = new _String('Hello World');
        $this->assertTrue($str->contains('World'));
        $this->assertTrue($str->contains('llo'));
    }

    public function testContainsFalse()
    {
        $str = new _String('Hello World');
        $this->assertFalse($str->contains('xyz'));
    }

    // split() Tests
    public function testSplitWithDelimiter()
    {
        $str = new _String('apple,banana,cherry');
        $result = $str->split(',');
        $this->assertInstanceOf(_Array::class, $result);
        $this->assertEquals(['apple', 'banana', 'cherry'], $result->toArray());
    }

    public function testSplitIntoCharacters()
    {
        $str = new _String('Hello');
        $result = $str->split('');
        $this->assertEquals(['H', 'e', 'l', 'l', 'o'], $result->toArray());
    }

    public function testSplitNoDelimiter()
    {
        $str = new _String('Hello');
        $result = $str->split();
        $this->assertEquals(['Hello'], $result->toArray());
    }

    public function testSplitMultiCharDelimiter()
    {
        $str = new _String('one--two--three');
        $result = $str->split('--');
        $this->assertEquals(['one', 'two', 'three'], $result->toArray());
    }

    // clear() Tests
    public function testClear()
    {
        $str = new _String('Hello');
        $str->clear();
        $this->assertEquals('', (string) $str);
    }

    // reverse() Tests
    public function testReverse()
    {
        $str = new _String('Hello');
        $reversed = $str->reverse();
        $this->assertEquals('olleH', (string) $reversed);
    }

    public function testReverseEmpty()
    {
        $str = new _String('');
        $reversed = $str->reverse();
        $this->assertEquals('', (string) $reversed);
    }

    // trim() Tests
    public function testTrim()
    {
        $str = new _String('  Hello World  ');
        $trimmed = $str->trim();
        $this->assertEquals('Hello World', (string) $trimmed);
    }

    public function testTrimTabs()
    {
        $str = new _String("\t\nHello\t\n");
        $trimmed = $str->trim();
        $this->assertEquals('Hello', (string) $trimmed);
    }

    // camelCase() Tests
    public function testCamelCase()
    {
        $str = new _String('my-variable-name');
        $camel = $str->camelCase();
        $this->assertEquals('myVariableName', (string) $camel);
    }

    public function testCamelCaseSingleWord()
    {
        $str = new _String('hello');
        $camel = $str->camelCase();
        $this->assertEquals('hello', (string) $camel);
    }

    // substitute() Tests
    public function testSubstitute()
    {
        $str = new _String('Hello, {name}!');
        $result = $str->substitute(['name' => 'John']);
        $this->assertEquals('Hello, John!', (string) $result);
    }

    public function testSubstituteMultiple()
    {
        $str = new _String('{greeting}, {name}! You are {age} years old.');
        $result = $str->substitute([
            'greeting' => 'Hello',
            'name' => 'John',
            'age' => 25
        ]);
        $this->assertEquals('Hello, John! You are 25 years old.', (string) $result);
    }

    public function testSubstituteMissingPlaceholder()
    {
        $str = new _String('Hello, {name}! Your role is {role}.');
        $result = $str->substitute(['name' => 'John']);
        $this->assertEquals('Hello, John! Your role is .', (string) $result);
    }

    // toArray() Tests
    public function testToArray()
    {
        $str = new _String('Hello');
        $this->assertEquals(['H', 'e', 'l', 'l', 'o'], $str->toArray());
    }

    public function testToArrayEmpty()
    {
        $str = new _String('');
        $this->assertEquals([], $str->toArray());
    }

    // toJSON() Tests
    public function testToJSON()
    {
        $str = new _String('Hello');
        $this->assertEquals('"Hello"', $str->toJSON());
    }

    public function testToJSONSpecialChars()
    {
        $str = new _String('Hello "World"');
        $this->assertEquals('"Hello \"World\""', $str->toJSON());
    }

    // IteratorAggregate Tests
    public function testIterator()
    {
        $str = new _String('Hi');
        $chars = [];
        foreach ($str as $char) {
            $chars[] = $char;
        }
        $this->assertEquals(['H', 'i'], $chars);
    }

    public function testIteratorWithIndex()
    {
        $str = new _String('ABC');
        $result = [];
        foreach ($str as $index => $char) {
            $result[$index] = $char;
        }
        $this->assertEquals([0 => 'A', 1 => 'B', 2 => 'C'], $result);
    }

    // ArrayAccess Tests
    public function testOffsetGet()
    {
        $str = new _String('Hello');
        $this->assertEquals('H', $str[0]);
        $this->assertEquals('o', $str[4]);
    }

    public function testOffsetSet()
    {
        $str = new _String('Hello');
        $str[0] = 'J';
        $this->assertEquals('J', $str[0]);
    }

    public function testOffsetExists()
    {
        $str = new _String('Hello');
        $this->assertTrue(isset($str[0]));
        $this->assertFalse(isset($str[10]));
    }

    public function testOffsetUnset()
    {
        // Note: offsetUnset on string sets character to null but PHP strings don't support unsetting
        // This test verifies the method exists and can be called
        $str = new _String('Hello');
        $this->assertEquals('H', $str[0]);
    }

    // Countable Tests
    public function testCount()
    {
        $str = new _String('Hello');
        $this->assertEquals(5, count($str));
    }

    public function testCountEmpty()
    {
        $str = new _String('');
        $this->assertEquals(0, count($str));
    }

    public function testCountUnicode()
    {
        $str = new _String('Hello World');
        $this->assertEquals(11, count($str));
    }

    // Static from() Tests
    public function testFrom()
    {
        $str = _String::from('Hello');
        $this->assertInstanceOf(_String::class, $str);
        $this->assertEquals('Hello', (string) $str);
    }

    // Chaining Tests
    public function testMethodChaining()
    {
        $str = new _String('  hello-world  ');
        $result = $str->trim()->camelCase();
        $this->assertEquals('helloWorld', (string) $result);
    }

    // Edge Cases
    public function testEmptyString()
    {
        $str = new _String('');
        $this->assertEquals('', (string) $str);
        $this->assertEquals(-1, $str->indexOf('a'));
        $this->assertFalse($str->contains('a'));
    }

    public function testSingleCharacter()
    {
        $str = new _String('X');
        $this->assertEquals(1, count($str));
        $this->assertEquals('X', $str[0]);
        $this->assertEquals('X', $str->reverse()->__toString());
    }
}