<?php

require('vendor/autoload.php');

// use CustomTypes\_Array;

class _ArrayTest extends \PHPUnit\Framework\TestCase
{
    public function testContructor()
    {
        
        $arr = new CustomTypes\_Array();
        $this->assertEquals($arr->toArray(), [], "Array should be empty");

        $arr = new CustomTypes\_Array([1,2,3]);
        $this->assertEquals($arr->toArray(), [1,2,3], "Array should be equal");

        $arr = new CustomTypes\_Array(1,2,3,4);
        $this->assertEquals($arr->toArray(), [1,2,3,4], "Array should be equal");
    }
    public function testAdd()
    {

        $this->assertEquals(25, 25);
    }
}
