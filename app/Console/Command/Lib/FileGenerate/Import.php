<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('FielGenerate', 'Console/Command/Lib/Interface');

/**
 * Description of Inport
 *
 * @author hanai
 */
class Import implements FielGenerate {
	
	const METHOD_USES	= 'uses';
	const METHOD_IMPORT	= 'import';
	
	/**
	 * uses | import
	 * @var string
	 */
	private $method = self::METHOD_USES;

	/**
	 * クラス名
	 * @var string
	 */
	private $className = '';
	
	/**
	 * パス
	 * @var string
	 */
	private $path = '';
	
	
	public function __construct($className, $path, $method = self::METHOD_USES) {
		$import = $this;
		$import->className	= $className;
		$import->path		= $path;
		$import->method		= $method;
	}

	public function getContents() {
		$import	= $this;
		$method	= $import->method;
		switch ($method) {
			case self::METHOD_IMPORT:
				return self::getContentsImport($import);
			case self::METHOD_USES:
				return self::getContentsUses($import);
			default :
				throw new RuntimeException('Import Method Error [' . $method . ']');
		}
	}
	
	private static function getContentsImport(self $import) {
		$className	= $import->className;
		$path		= $import->path;
		$tpl = 'App::import(\'%s\', \'%s\');';
		
		return sprintf($tpl, $path, $className);
	}
	
	private static function getContentsUses(self $import) {
		$className	= $import->className;
		$path		= $import->path;
		$tpl = 'App::uses(\'%s\', \'%s\');';
		
		return sprintf($tpl, $className, $path);
	}
}