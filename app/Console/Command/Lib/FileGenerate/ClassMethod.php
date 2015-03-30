<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('FielGenerate', 'Console/Command/Lib/Interface');

/**
 * Description of ClassMethod
 *
 * @author hanai
 */
class ClassMethod implements FielGenerate {
	
	
	private $methodName	= '';
	private $access		= '';
	private $args		= array();
	private $logic		= array();
	
	private $methodComments = array();
	private $argsComments	= array();
	private $returnComment	= '';
	
	/**
	 * メソッド名
	 * @param string $methodName
	 */
	public function setMethodName($methodName) {
		$this->methodName = $methodName;
	}
	
	/**
	 * アクセサ（修飾子）
	 * @param type $access
	 */
	public function setAccess($access) {
		$this->access = $access;
	}
	
	/**
	 * メソッドロジック
	 * @param array $logic
	 */
	public function setLogic(array $logic) {
		$this->logic = $logic;
	}
	
	/**
	 * メソッドコメント
	 * @param string $comment
	 */
	public function addMethodComment($comment) {
		$this->methodComments[] = $comment;
	}
	
	/**
	 * 戻り値のコメント
	 * @param string $comment
	 */
	public function setReturnComment($comment) {
		$this->returnComment = $comment;
	}

	/**
	 * 引数
	 * @param type $arg
	 * @param type $comment
	 * @param type $typeHinting
	 */
	public function addArg($arg, $comment = 'type', $typeHinting = '') {
		$tmp = $typeHinting . ' '. $arg;
		$this->args[]			= trim($tmp);
		$this->argsComments[]	= $comment;
	}
	
	/**
	 * メソッド名
	 * @return type
	 */
	public function getName() {
		return $this->methodName;
	}

	/**
	 * コンテンツ
	 * @return string
	 */
	public function getContents() {
		$lfc	= static::LFC;
		$tab	= static::TAB;
		$file	= $this;
		
		$methodName		= $file->methodName;
		$access			= $file->access;
		$args			= $file->args;
		$logic			= $file->logic;
		$methodComments	= $file->methodComments;
		$argsComments	= $file->argsComments;
		$returnComment	= $file->returnComment;
		
		$methodDeclare	= self::getMethodDeclare($methodName, $access, $args);
		
		// ヘッダコメント
		$file->contents[] = '/**';
		foreach ($methodComments as $methodComment ){
			$file->contents[] = ' * ' . $methodComment;
		}
		foreach ($argsComments as $argsComment ){
			$file->contents[] = ' * @param ' . $argsComment;
		}
		if (!empty($returnComment)) {
			$file->contents[] = ' * @return ' . $returnComment;
		}
		$file->contents[] = ' */';
		// PGロジック
		$file->contents[] = $methodDeclare;
		$file->contents[] = $tab . join($lfc . $tab . $tab, $logic);
		$file->contents[] = '}';
		
		return $tab . join($lfc . $tab, $file->contents);
	}
	
	private static function getMethodDeclare($methodName, $access, array $args) {
		$retult = $access . ' function ' . $methodName . '(';
		$retult .= join(', ', $args);
		$retult .= ') {';
		return $retult;
	}
}