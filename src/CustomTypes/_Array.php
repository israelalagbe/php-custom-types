<?php

namespace CustomTypes;

class _Array extends _ArrayObject {
	
	public function __construct(){
		$args = func_get_args();

		if(count($args) === 1 && \is_array(@$args[0])){
			$args = $args[0];
		}
		parent::__construct($args);
	}
	
	public static function from($data = null){
		$array = new _Array;
		return $array->setData($data);
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