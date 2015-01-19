<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('FielGenerate', 'Console/Command/Lib/Interface');

/**
 * Description of ClassMember
 *
 * @author hanai
 */
class ClassMember implements FielGenerate {
	
	private $name;
	private $access;
	private $value;
	private $comment;
	private $type;
	
	/**
	 *
	 * @var type 
	 */
	private $contents = array();

	
	public function __construct($name, $access = 'public', $value = 'null', $comment = '', $type = 'type') {
		$file = $this;
		$file->name		= $name;
		$file->access	= $access;
		$file->value	= $value;
		$file->comment	= $comment;
		$file->type		= $type;
	}

	public function getName() {
		return $this->name;
	}

	public function getContents() {
		$lfc	= static::LFC;
		$tab	= static::TAB;
		$file	= $this;
		
		$name		= $file->name;
		$access		= $file->access;
		$value		= $file->value;
		$comment	= $file->comment;
		$type		= $file->type;
		
		$file->contents[] = '/**';
		$file->contents[] = ' * ' . $comment;
		$file->contents[] = ' * @var ' . $type;
		$file->contents[] = ' */';
		$file->contents[] = $access . ' $' . $name . ' = ' . $value . ';';
		
		return $tab . join($lfc . $tab, $file->contents);
	}
}