<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('FielGenerate', 'Console/Command/Lib/Interface');
App::uses('ClassMember', 'Console/Command/Lib/FielGenerate');
App::uses('ClassMedhod', 'Console/Command/Lib/FielGenerate');

/**
 * Description of ClassFile
 *
 * @author hanai
 */
class ClassFile implements FielGenerate {
	
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
	 *
	 * @var array<ClassMember>
	 */
	private $members = array();
	
	/**
	 *
	 * @var array<ClassMedhod>
	 */
	private $medhods = array();
	
	/**
	 * ファイル内容
	 * @var
	 */
	private $contents = array();

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
	 * ClassMember Instance
	 * @param ClassMember $member
	 */
	public function addMember(ClassMember $member) {
		$this->members[] = $member;
	}
	
	/**
	 * ClassMedhod Instance
	 * @param ClassMedhod $medhod
	 */
	public function addMedhod(ClassMedhod $medhod) {
		$this->medhods[] = $medhod;
	}
	
	/**
	 * コンテンツ
	 * @return string
	 */
	public function getContents() {
		$file		= $this;
		$classType	= $file->classType;
		$className	= $file->className;
		$members	= $file->members;
		$medhods	= $file->medhods;
		
		$file->contents[] = '<?php ';
		$file->contents[] = '';
		$file->contents[] = '';
		$file->contents[] = $classType . ' ' . $className . ' {';
		$file->contents[] = '';
		foreach ($members as $member) {
			if ($member instanceof ClassMember) {
				$file->contents[] = $member->getContents();
				$file->contents[] = '';
			} else {
				throw new RuntimeException('Error Not ClassMember Instance ClassFile::$members');
			}
		}
		foreach ($medhods as $medhod) {
			$file->contents[] = $medhod->getContents();
			$file->contents[] = '';
		}
		$file->contents[] = '}';
		
		return join(static::LFC, $file->contents);
	}
}