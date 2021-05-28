<?php
namespace IsraelAlagbe\CustomTypes;

use ArrayObject;
use InvalidArgumentException;

class _Array  extends _Iterable implements \IteratorAggregate, \ArrayAccess, \Countable {
	
	public function __construct(){
		$args = func_get_args();

		if(count($args) === 1 && \is_array(@$args[0])){
			$args = $args[0];
		}
		else if(count($args) === 1 && @$args[0] instanceof _Array){
			$args = $args[0]->toArray();
		}

		$this->setData($args ?: array());
	}
	
	public static function from($data): _Array {
		if(!is_array($data) && !$data instanceof _Array){
			throw new InvalidArgumentException("Argument passed to from() must be an array or an instance of _Array");
		}
		return parent::from($data);
	}



	public function __set($name, $val) {
        $this->data[$name] = $val;
    }

    public function &__get($name) {
        return $this->data[$name];
    }

	public function __invoke(){ 
		return $this->toArray();
	}
	
	public function __toString(){
		return '[' . $this->join(', ') . ']';
	}
	
	// Misc
	public function indexOf($value, $strict = true){
		$index = array_search($value, $this->data, $strict);
		return $index !== false ? $index : -1;
	}
	
	public function contains($value, $strict = true){
		return in_array($value, $this->data, $strict);
	}
	
	public function has($key){
		return array_key_exists($key, $this->data);
	}
	
	public function item($at){
		$length = count($this->data);
		
		if ($at < 0){
			$mod = $at % $length;
			if ($mod == 0) $at = 0;
			else $at = $mod + $length;
		}
		
		return ($at < 0 || $at >= $length || !array_key_exists($at, $this->data)) ? null : $this->data[$at];
	}
	
	public function join($separator = ','){
		return implode($separator, $this->data);
	}
	
	public function clear(){
		return $this->setData(array());
	}
	
	public function append($array){
		return call_user_func_array(array($this, 'push'), method_exists($array, 'toArray') ? $array->toArray() : $array);
	}
	
	public function reverse($preserveKeys = false){
		return static::from(array_reverse($this->data, $preserveKeys));
	}
	
	public function slice($begin = 0, $end = false){
		if (func_num_args() < 2) $end = $this->length();
		
		return static::from(array_slice($this->data, $begin, $end));
	}
	
	public function remove($value){
		if (in_array($value, $this->data))
			$this->data = array_diff_key($this->data, array_flip(array_keys($this->data, $value, true)));
		
		return $this;
	}
	
	public function clean(){
		return $this->remove(null)->remove(false)->remove(0)->remove('');
	}
	
	// Keys / Values
	public function keys(){
		return static::from(array_keys($this->data));
	}
	
	public function values(){
		return static::from(array_values($this->data));
	}
	
	// Stack
	public function push(){
		$args = func_get_args();
		foreach ($args as $arg)
			$this->data[] = $arg;
		
		return $this;
	}
	
	public function pop(){
		return array_pop($this->data);
	}

	public function first(){
		return reset($this->data);
	}

	public function last(){
		return end($this->data);
	}
	
	// Shift
	public function shift(){
		return array_shift($this->data);
	}
	
	public function unshift($data){
		array_unshift($this->data, $data);
		
		return $this;
	}
	
	// Cast
	public function toArray(): array{
		return $this->data;
	}
	
	public function toJSON(){
		return json_encode($this->data);
	}
	
	// IteratorAggregate
	public function getIterator(){
		return new \ArrayIterator($this->data);
	}
	
	// ArrayAccess
	public function offsetSet($key, $value){
		if ($key === null) {
			$this->data[] = $value;
		} else {
			$this->data[$key] = $value;
		}
	}
	
	public function offsetGet($key){
		return array_key_exists($key, $this->data) ? $this->data[$key] : null;
	}
	
	public function offsetExists($key){
		return array_key_exists($key, $this->data);
	}
	
	public function offsetUnset($key){
		unset($this->data[$key]);
	}

	public function length(){
		return count($this->data);
	}
	
	// Iterator Methods
	public function each($fn) : _Array{
		return parent::each($fn);
	}

	public function forEach($fn) : _Array{
		return parent::each($fn);
	}

	
	public function map($fn): _Array{
		return parent::map($fn);
	}
	
	public function filter($fn, $preserveKeys = false): _Array{
		return parent::filter($fn, $preserveKeys);
	}
	
	// Countable
	public function count(){
		return count($this->data);
	}
	
	// Static
	protected static function getClassName(){
		return __CLASS__;
	}
	
}