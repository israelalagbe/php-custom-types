<?php

require('vendor/autoload.php');

// use CustomTypes\_Array;

class _ArrayTest extends \PHPUnit\Framework\TestCase
{
    public function testContructor()
    {
        
        $arr = new CustomTypes\_Array();
        // $this->assertEquals($arr->toArray(), [], "Array should be empty");
    }
    public function testAdd()
    {

        $this->assertEquals(25, 25);
    }
}
