<?php

use IsraelAlagbe\CustomTypes\_Array;

class _ArrayTest extends \PHPUnit\Framework\TestCase
{
    // Constructor Tests
    public function testConstructorEmpty()
    {
        $arr = new _Array();
        $this->assertEquals([], $arr->toArray());
    }

    public function testConstructorWithArray()
    {
        $arr = new _Array([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $arr->toArray());
    }

    public function testConstructorWithVariadicArgs()
    {
        $arr = new _Array(1, 2, 3, 4);
        $this->assertEquals([1, 2, 3, 4], $arr->toArray());
    }

    public function testConstructorWithAnotherArray()
    {
        $original = new _Array([1, 2, 3]);
        $copy = new _Array($original);
        $this->assertEquals([1, 2, 3], $copy->toArray());
    }

    // Static from() Method Tests
    public function testFromWithArray()
    {
        $arr = _Array::from([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $arr->toArray());
    }

    public function testFromWithArrayInstance()
    {
        $original = new _Array([1, 2, 3]);
        $arr = _Array::from($original);
        $this->assertEquals([1, 2, 3], $arr->toArray());
    }

    public function testFromThrowsExceptionForInvalidArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        _Array::from("invalid");
    }

    // Getter/Setter Tests
    public function testGetter()
    {
        $arr = new _Array(['item' => 'value']);
        $this->assertEquals('value', $arr->item);
    }

    public function testSetter()
    {
        $arr = new _Array();
        $arr->hello = 'world';
        $this->assertEquals('world', $arr->hello);
    }

    public function testGetterReturnsArrayInstance()
    {
        $arr = new _Array(['item' => ['subitem' => 'value']]);
        $this->assertInstanceOf(_Array::class, $arr->item);
        $this->assertEquals('value', $arr->item->subitem);
    }

    // indexOf() Tests
    public function testIndexOfFound()
    {
        $arr = new _Array(['a', 'b', 'c']);
        $this->assertEquals(1, $arr->indexOf('b'));
    }

    public function testIndexOfNotFound()
    {
        $arr = new _Array(['a', 'b', 'c']);
        $this->assertEquals(-1, $arr->indexOf('z'));
    }

    public function testIndexOfStrictMode()
    {
        $arr = new _Array([1, 2, 3]);
        $this->assertEquals(-1, $arr->indexOf('1', true));
        $this->assertEquals(0, $arr->indexOf('1', false));
    }

    // contains() Tests
    public function testContainsTrue()
    {
        $arr = new _Array([1, 2, 3]);
        $this->assertTrue($arr->contains(2));
    }

    public function testContainsFalse()
    {
        $arr = new _Array([1, 2, 3]);
        $this->assertFalse($arr->contains(5));
    }

    public function testContainsStrict()
    {
        $arr = new _Array([1, 2, 3]);
        $this->assertFalse($arr->contains('1', true));
        $this->assertTrue($arr->contains('1', false));
    }

    // has() Tests
    public function testHasKeyExists()
    {
        $arr = new _Array(['name' => 'John']);
        $this->assertTrue($arr->has('name'));
    }

    public function testHasKeyNotExists()
    {
        $arr = new _Array(['name' => 'John']);
        $this->assertFalse($arr->has('age'));
    }

    // item() Tests
    public function testItemPositiveIndex()
    {
        $arr = new _Array(['a', 'b', 'c']);
        $this->assertEquals('a', $arr->item(0));
        $this->assertEquals('c', $arr->item(2));
    }

    public function testItemNegativeIndex()
    {
        $arr = new _Array(['a', 'b', 'c']);
        $this->assertEquals('c', $arr->item(-1));
        $this->assertEquals('b', $arr->item(-2));
        $this->assertEquals('a', $arr->item(-3));
    }

    public function testItemOutOfBounds()
    {
        $arr = new _Array(['a', 'b', 'c']);
        $this->assertNull($arr->item(10));
    }

    public function testItemReturnsArrayInstance()
    {
        $arr = new _Array([['nested' => 'value']]);
        $this->assertInstanceOf(_Array::class, $arr->item(0));
    }

    // join() Tests
    public function testJoinDefault()
    {
        $arr = new _Array(['a', 'b', 'c']);
        $this->assertEquals('a,b,c', $arr->join());
    }

    public function testJoinCustomSeparator()
    {
        $arr = new _Array(['a', 'b', 'c']);
        $this->assertEquals('a-b-c', $arr->join('-'));
        $this->assertEquals('a, b, c', $arr->join(', '));
    }

    // clear() Tests
    public function testClear()
    {
        $arr = new _Array([1, 2, 3]);
        $arr->clear();
        $this->assertEquals([], $arr->toArray());
    }

    // append() Tests
    public function testAppendArrayInstance()
    {
        $arr = new _Array([1, 2]);
        $arr->append(new _Array([3, 4]));
        $this->assertEquals([1, 2, 3, 4], $arr->toArray());
    }

    // reverse() Tests
    public function testReverse()
    {
        $arr = new _Array([1, 2, 3]);
        $reversed = $arr->reverse();
        $this->assertEquals([3, 2, 1], $reversed->toArray());
    }

    public function testReversePreserveKeys()
    {
        $arr = new _Array(['a' => 1, 'b' => 2]);
        $reversed = $arr->reverse(true);
        $this->assertEquals(['b' => 2, 'a' => 1], $reversed->toArray());
    }

    // slice() Tests
    public function testSlice()
    {
        $arr = new _Array([1, 2, 3, 4, 5]);
        $sliced = $arr->slice(1, 3);
        $this->assertEquals([2, 3, 4], $sliced->toArray());
    }

    public function testSliceNoEnd()
    {
        $arr = new _Array([1, 2, 3, 4, 5]);
        $sliced = $arr->slice(2);
        $this->assertEquals([3, 4, 5], $sliced->toArray());
    }

    // remove() Tests
    public function testRemove()
    {
        $arr = new _Array([1, 2, 3, 2, 4]);
        $arr->remove(2);
        $this->assertFalse($arr->contains(2));
    }

    // clean() Tests
    public function testClean()
    {
        $arr = new _Array([1, null, 2, false, 0, '', 3]);
        $cleaned = $arr->clean();
        $this->assertEquals([1, 2, 3], array_values($cleaned->toArray()));
    }

    // keys() Tests
    public function testKeys()
    {
        $arr = new _Array(['a' => 1, 'b' => 2]);
        $this->assertEquals(['a', 'b'], $arr->keys()->toArray());
    }

    // values() Tests
    public function testValues()
    {
        $arr = new _Array(['a' => 1, 'b' => 2]);
        $this->assertEquals([1, 2], $arr->values()->toArray());
    }

    // push() Tests
    public function testPushSingle()
    {
        $arr = new _Array([1, 2]);
        $arr->push(3);
        $this->assertEquals([1, 2, 3], $arr->toArray());
    }

    public function testPushMultiple()
    {
        $arr = new _Array([1]);
        $arr->push(2, 3, 4);
        $this->assertEquals([1, 2, 3, 4], $arr->toArray());
    }

    // pop() Tests
    public function testPop()
    {
        $arr = new _Array([1, 2, 3]);
        $popped = $arr->pop();
        $this->assertEquals(3, $popped);
        $this->assertEquals([1, 2], $arr->toArray());
    }

    // shift() Tests
    public function testShift()
    {
        $arr = new _Array([1, 2, 3]);
        $shifted = $arr->shift();
        $this->assertEquals(1, $shifted);
        $this->assertEquals([2, 3], $arr->toArray());
    }

    // unshift() Tests
    public function testUnshift()
    {
        $arr = new _Array([2, 3]);
        $arr->unshift(1);
        $this->assertEquals([1, 2, 3], $arr->toArray());
    }

    // toJSON() Tests
    public function testToJSON()
    {
        $arr = new _Array(['name' => 'John', 'age' => 30]);
        $this->assertEquals('{"name":"John","age":30}', $arr->toJSON());
    }

    // IteratorAggregate Tests
    public function testIterator()
    {
        $arr = new _Array([1, 2, 3]);
        $result = [];
        foreach ($arr as $value) {
            $result[] = $value;
        }
        $this->assertEquals([1, 2, 3], $result);
    }

    public function testIteratorWithKeys()
    {
        $arr = new _Array(['a' => 1, 'b' => 2]);
        $keys = [];
        $values = [];
        foreach ($arr as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }
        $this->assertEquals(['a', 'b'], $keys);
        $this->assertEquals([1, 2], $values);
    }

    public function testIteratorNestedArrays()
    {
        $arr = new _Array([['nested' => 'value']]);
        foreach ($arr as $val) {
            $this->assertInstanceOf(_Array::class, $val);
        }
    }

    // ArrayAccess Tests
    public function testOffsetGet()
    {
        $arr = new _Array(['a', 'b', 'c']);
        $this->assertEquals('a', $arr->item(0));
        $this->assertEquals('c', $arr->item(2));
    }

    public function testOffsetSet()
    {
        $arr = new _Array(['a', 'b']);
        $arr[1] = 'B';
        $this->assertEquals('B', $arr->item(1));
    }

    public function testOffsetSetAppend()
    {
        $arr = new _Array(['a', 'b']);
        $arr[] = 'c';
        $this->assertEquals(['a', 'b', 'c'], $arr->toArray());
    }

    public function testOffsetExists()
    {
        $arr = new _Array(['a', 'b']);
        $this->assertTrue(isset($arr[0]));
        $this->assertFalse(isset($arr[10]));
    }

    public function testOffsetUnset()
    {
        $arr = new _Array(['a', 'b', 'c']);
        unset($arr[1]);
        $this->assertFalse(isset($arr[1]));
    }

    // Countable Tests
    public function testCount()
    {
        $arr = new _Array([1, 2, 3, 4, 5]);
        $this->assertEquals(5, count($arr));
    }

    public function testLength()
    {
        $arr = new _Array([1, 2, 3]);
        $this->assertEquals(3, $arr->length());
    }

    // map() Tests
    public function testMap()
    {
        $arr = new _Array([1, 2, 3]);
        $result = $arr->map(function ($item) {
            return $item * 2;
        });
        $this->assertEquals([2, 4, 6], $result->toArray());
    }

    // filter() Tests
    public function testFilter()
    {
        $arr = new _Array([1, 2, 3, 4, 5, 6]);
        $evens = $arr->filter(function ($n) {
            return $n % 2 === 0;
        });
        $this->assertEquals([2, 4, 6], array_values($evens->toArray()));
    }

    // each()/forEach() Tests
    public function testEach()
    {
        $arr = new _Array([1, 2, 3]);
        $sum = 0;
        $arr->each(function ($item) use (&$sum) {
            $sum += $item;
        });
        $this->assertEquals(6, $sum);
    }

    public function testForEach()
    {
        $arr = new _Array([1, 2, 3]);
        $sum = 0;
        $arr->forEach(function ($item) use (&$sum) {
            $sum += $item;
        });
        $this->assertEquals(6, $sum);
    }

    // __toString() Tests
    public function testToString()
    {
        $arr = new _Array([1, 2, 3]);
        $this->assertEquals('[1, 2, 3]', (string) $arr);
    }

    // __invoke() Tests
    public function testInvoke()
    {
        $arr = new _Array([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $arr());
    }
}
