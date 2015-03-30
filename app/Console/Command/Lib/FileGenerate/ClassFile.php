<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('FielGenerate', 'Console/Command/Lib/Interface');
App::uses('ClassMember', 'Console/Command/Lib/FielGenerate');
App::uses('ClassMethod', 'Console/Command/Lib/FielGenerate');

/**
 * Description of ClassFile
 *
 * @author hanai
 */
class ClassFile implements FielGenerate {
	
	/**
	 * 
	 * @var array<Import>
	 */
	private $imports = array();

	/**
	 * class | abstract class | trait
	 * @var string
	 */
	private $classType = 'class';
	
	/**
	 * クラス名
	 * @var string
	 */
	private $className = '';
	
	/**
	 * 親クラス名
	 * @var string
	 */
	private $parentClassName = '';
	
	/**
	 *
	 * @var type 
	 */
	private $use = array();

	/**
	 *
	 * @var array<ClassMember>
	 */
	private $members = array();
	
	/**
	 *
	 * @var array<ClassMethod>
	 */
	private $methods = array();
	
	/**
	 * ファイル内容
	 * @var
	 */
	private $contents = array();
	
	/**
	 * Import Instance
	 * @param Import $import
	 */
	public function addImport(Import $import) {
		$this->imports[] = $import;
	}

	/**
	 * クラス種別（class | abstract class | trait | interface）
	 * @param string $classType
	 */
	public function setClassType($classType = 'class') {
		$this->classType = $classType;
	}
	
	/**
	 * クラス名
	 * @param string $className
	 */
	public function setClassName($className) {
		$this->className = $className;
	}
	
	/**
	 * 親クラス名
	 * @param string $className
	 */
	public function setParentClassName($parentClassName) {
		$this->parentClassName = $parentClassName;
	}
	
	/**
	 * トレイト
	 * @param string $trait
	 */
	public function addUses($trait) {
		$file = $this;
		if (!array_search($trait, $file->use)) {
			$file->use[] = $trait;
		}
	}
	
	/**
	 * ClassMember Instance
	 * @param ClassMember $member
	 */
	public function addMember(ClassMember $member) {
		$memberName = $member->getName();
		if (!array_key_exists($memberName, $this->members)) {
			$this->members[$memberName] = $member;
		};
	}
	
	/**
	 * ClassMethod Instance
	 * @param ClassMethod $method
	 */
	public function addMethod(ClassMethod $method) {
		$methodName = $method->getName();
		if (!array_key_exists($methodName, $this->methods)) {
			$this->methods[$methodName] = $method;
		}
	}
	
	/**
	 * コンテンツ
	 * @return string
	 */
	public function getContents() {
		$ind				= self::TAB;
		$file				= $this;
		$imports			= $file->imports;
		$classType			= $file->classType;
		$className			= $file->className;
		$parentClassName	= $file->parentClassName;
		$uses				= $file->use;
		$members			= array_values($file->members);
		$methods			= array_values($file->methods);
		
		$extends	= !empty($parentClassName)? ' extends ' . $parentClassName: '';
		$use		= join(', ', $uses);
		
		$file->contents[] = '<?php ';
		$file->contents[] = '';
		foreach ($imports as $import) {
			$file->contents[] = $import->getContents();
		}
		$file->contents[] = '';
		$file->contents[] = $classType . ' ' . $className . $extends . ' {';
		$file->contents[] = '';
		
		if (!empty($uses)) {
			$file->contents[] = $ind . 'use ' . $use . ';';
			$file->contents[] = '';
		} 
		
		foreach ($members as $member) {
			$file->contents[] = $member->getContents();
			$file->contents[] = '';
		}
		foreach ($methods as $method) {
			$file->contents[] = $method->getContents();
			$file->contents[] = '';
		}
		$file->contents[] = '}';
		
		return join(static::LFC, $file->contents);
	}
}