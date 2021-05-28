<?php

use IsraelAlagbe\CustomTypes\_Array;
use IsraelAlagbe\CustomTypes\_String;

class __StringTest extends \PHPUnit\Framework\TestCase{
    public function setUp():void{
        // parent::setUp();
		$this->string = _String::from('abc');
	}
	
	public function testIndexOf(){
		$this->assertEquals($this->string->indexOf('a'), 0);
		$this->assertEquals($this->string->indexOf('b'), 1);
		$this->assertEquals($this->string->indexOf('c'), 2);
		$this->assertEquals($this->string->indexOf('d'), -1);
	}
	
	public function testContains(){
		$this->assertEquals($this->string->contains('a'), true);
		$this->assertEquals($this->string->contains('d'), false);
	}
	
	public function testSplit(){
		$array = $this->string->split();
		
		$this->assertEquals($array(), array('abc'));
		$this->assertTrue($array instanceof _Array);
		
		$array = $this->string->split('');

		$this->assertEquals($array(), array('a', 'b', 'c'));
		$this->assertTrue($array instanceof _Array);
		
		$array = $this->string->split('b');

		$this->assertEquals($array(), array('a', 'c'));
		$this->assertTrue($array instanceof _Array);
	}
	
	public function testTrim(){
		$string = _String::from(' abc ');
		$this->assertEquals($string->trim()->toString(), 'abc');
		$this->assertNotSame($string, $string->trim());
	}
	
	public function testCamelCase(){
		$this->assertEquals(_String::from('i-like-cookies')->camelCase()->toString(), 'iLikeCookies');
		$this->assertEquals(_String::from('I-like-cookies')->camelCase()->toString(), 'ILikeCookies');
	}
	
	public function testSubstitute(){
		$this->assertEquals(
			_String::from('I am {name}!')->substitute(array('name' => 'Banana'))->toString(),
			'I am Banana!'
		);
		
		$this->assertEquals(
			_String::from('I am {undefined}!')->substitute(array('name' => 'Banana'))->toString(),
			'I am !'
		);
	}
	
	public function testClear(){
		$this->assertEquals($this->string->clear()->toString(), '');
	}
	
	public function testReverse(){
		$this->assertEquals($this->string->reverse()->toString(), 'cba');
		$this->assertNotSame($this->string, $this->string->reverse());
	}

}