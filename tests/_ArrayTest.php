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

    public function testGetterItem()
    {
        $arr = new _Array([
            'value'
        ]);
        $this->assertEquals('value', $arr->item(0));
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

    public function testMultiDimensionGetter()
    {
        $arr = new _Array([
            'item' => [
                'subitem' => 'value'
            ]
        ]);

        $this->assertEquals($arr->item->subitem, 'value');
    }

    public function testMultiDimensionIterator()
    {
        $arr = new _Array([
            'item' => [
                'subitem' => 'value'
            ]
        ]);
        $i = 1;
        foreach($arr as $val) {
            $this->assertInstanceOf(_Array::class, $val);
            $this->assertEquals($val->subitem, 'value');
        }
    }
}
