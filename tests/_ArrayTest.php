<?php

use IsraelAlagbe\CustomTypes\_Array;
class _ArrayTest extends \PHPUnit\Framework\TestCase
{
    public function testContructor()
    {
        
        $arr = new _Array();
        $this->assertEquals($arr->toArray(), [], "Array should be empty");

        $arr = new _Array([1,2,3]);
        $this->assertEquals($arr->toArray(), [1,2,3], "Array should be equal");

        $arr = new _Array(1,2,3,4);
        $this->assertEquals($arr->toArray(), [1,2,3,4], "Array should be equal");
    }

    public function testGetter()
    {
        $arr = new _Array([
            'item' => 'value'
        ]);
        $this->assertEquals($arr->item, 'value');
    }

    public function testSetter()
    {
        $arr = new _Array();

        try{
            $arr->hello;
            $this->fail("Expected exception not thrown");
        }
        catch(Exception $e) {
            
        }

        $arr->hello = 'world';
        $this->assertEquals($arr->hello, 'world');
    }

    public function testFirst()
    {
        $arr = new _Array([1,2,3]);
        $this->assertEquals($arr->first(), 1, "Should return the first item");

        $arr = new _Array([]);
        $this->assertEquals($arr->first(), false, "Should return false when there are no items.");
    }

    public function testLast()
    {
        $arr = new _Array(['a', 'b', 'c']);
        $this->assertEquals($arr->last(), 'c', "Should return the last item");

        $arr = new _Array([]);
        $this->assertEquals($arr->last(), false, "Should return false when there are no items.");
    }
}
