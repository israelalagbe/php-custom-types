<?php
namespace IsraelAlagbe\CustomTypes;

abstract class _Type {
	
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
	
	// Serialization
	public function __serialize(): array {
		return ['data' => $this->data];
	}
	
	public function __unserialize(array $data): void {
		$this->data = $data['data'];
	}
	
	// Static
	public static function from($data){
		$name = static::getClassName();
		return new $name($data);
	}
	
	protected static function getClassName(){}
	
}