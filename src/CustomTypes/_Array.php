<?php

namespace CustomTypes;

use InvalidArgumentException;

class _Array extends _ArrayObject {
	
	public function __construct(){
		$args = func_get_args();

		if(count($args) === 1 && \is_array(@$args[0])){
			$args = $args[0];
		}
		parent::__construct($args);
	}
	
	public static function from($data): _Array {
		if(!is_array($data) && !$data instanceof _Array){
			throw new InvalidArgumentException("Argument passed to from() must be an array or an instance of _Array");
		}
		return parent::from($data);
	}

	//
	public function map($fn){
		return parent::map($fn);
	}



	public function __set($name, $val) {
        $this->data[$name] = $val;
    }

    public function __get($name) {
        return $this->data[$name];
    }
	
	// Static
	protected static function getClassName(){
		return __CLASS__;
	}
	
}