<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('FielGenerate', 'Console/Command/Lib/Interface');

/**
 * Description of ClassMedhod
 *
 * @author hanai
 */
class ClassMedhod implements FielGenerate {
	
	
	private $medhodName	= '';
	private $access		= '';
	private $args		= array();
	private $logic		= array();
	
	private $medhodComments = array();
	private $argsComments	= array();
	private $returnComment	= '';
	
	/**
	 * メソッド名
	 * @param string $medhodName
	 */
	public function setMedhodName($medhodName) {
		$this->medhodName = $medhodName;
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
	public function addMedhodComment($comment) {
		$this->medhodComments[] = $comment;
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
	 * コンテンツ
	 * @return string
	 */
	public function getContents() {
		$lfc	= static::LFC;
		$tab	= static::TAB;
		$file	= $this;
		
		$medhodName		= $file->medhodName;
		$access			= $file->access;
		$args			= $file->args;
		$logic			= $file->logic;
		$medhodComments	= $file->medhodComments;
		$argsComments	= $file->argsComments;
		$returnComment	= $file->returnComment;
		
		$medhodDeclare	= self::getMedhodDeclare($medhodName, $access, $args);
		
		// ヘッダコメント
		$file->contents[] = '/**';
		foreach ($medhodComments as $medhodComment ){
			$file->contents[] = ' * ' . $medhodComment;
		}
		foreach ($argsComments as $argsComment ){
			$file->contents[] = ' * @param ' . $argsComment;
		}
		if (!empty($returnComment)) {
			$file->contents[] = ' * @return ' . $returnComment;
		}
		$file->contents[] = ' */';
		// PGロジック
		$file->contents[] = $medhodDeclare;
		$file->contents[] = $tab . join($lfc . $tab . $tab, $logic);
		$file->contents[] = '}';
		
		return $tab . join($lfc . $tab, $file->contents);
	}
	
	private static function getMedhodDeclare($medhodName, $access, array $args) {
		$retult = $access . ' function ' . $medhodName . '(';
		$retult .= join(', ', $args);
		$retult .= ') {';
		return $retult;
	}
}