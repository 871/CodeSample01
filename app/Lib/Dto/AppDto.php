<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppDTO
 *
 * @author hanai
 */
class AppDto {
	
	final public function __call($name, $arguments) {
		$message = '[AppDTO __call]' . $name . '::' .  print_r($arguments, true);
		throw new Exception($message);
	}
	
	final public function __set($name, $value) {
		$message = '[AppDTO __set]' . $name . '::' . print_r($value, true);
		throw new Exception($message);
	}
	
	final public function __get($name) {
		$message = '[AppDTO __get]' . $name;
		throw new Exception($message);
	}
}