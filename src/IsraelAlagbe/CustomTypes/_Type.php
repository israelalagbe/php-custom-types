<?php
namespace IsraelAlagbe\CustomTypes;

abstract class _Type implements \Serializable {
	
	protected $data;
	
	public function __invoke(){
		return $this->__toString();
	}
	
	public function __toString(){
		return $this->data;
	}
	
	public function toString(){
		return '' . $this->data;
	}
	
	protected function setData($data){
		$this->data = $data;
		
		return $this;
	}
	
	// Serializable
	public function serialize(){
		return serialize($this->data);
	}
	
	public function unserialize($serialized){
		$this->data = unserialize($serialized);
	}
	
	// Static
	public static function from($data){
		$name = static::getClassName();
		return new $name($data);
	}
	
	protected static function getClassName(){}
	
}