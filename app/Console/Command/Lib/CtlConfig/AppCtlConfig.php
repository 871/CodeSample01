<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppCtlConfig
 *
 * @author hanai
 */
abstract class AppCtlConfig {
	
	const TYPE_CREATE	= 'Create';
	const TYPE_EDIT		= 'Edit';
	const TYPE_DETAIL	= 'Detail';
	const TYPE_SEARCH	= 'Search';
	const TYPE_LIST		= 'List';
	
	/**
	 * Ctl種別
	 * @var string
	 */
	protected $ctlType = '';
	
	/**
	 * Ctl名
	 * @var string
	 */
	protected $ctlName = '';
	
	/**
	 * Ctlモデル名
	 * @var string
	 */
	protected $modelName = '';
	
	/**
	 * Ctlヘルパ名
	 * @var string
	 */
	protected $helperName = '';
	
	/**
	 * $lable => $url
	 * @var array
	 */
	protected $naviParams = array();
	
	/**
	 * $lable => $url
	 * @var array
	 */
	protected $links = array();

	public function __construct() {
		$ctlConfig = $this;
		self::setCtlName	($ctlConfig);
		self::setModelName	($ctlConfig);
		self::setHelperName	($ctlConfig);
	}
	
	private static function setCtlName(self $ctlConfig) {
		$className	= get_class($ctlConfig);
		$tmp		= preg_replace('/CtlConfig$/', '', $className);
		
		$ctlConfig->ctlName = $tmp;
	}
	
	private static function setModelName(self $ctlConfig) {
		$className	= get_class($ctlConfig);
		$tmp1		= preg_replace('/CtlConfig$/', '', $className);
		$tmp2		= Inflector::singularize($tmp1);
		
		$ctlConfig->modelName = $tmp2;
	}
	
	private static function setHelperName(self $ctlConfig) {
		$className	= get_class($ctlConfig);
		$tmp1		= preg_replace('/CtlConfig$/', '', $className);
		$tmp2		= Inflector::singularize($tmp1);
		
		$ctlConfig->helperName = $tmp2 . 'Helper';
	}
	
	/**
	 * Ctl種別
	 * @return string
	 */
	public function getCtlType() {
		return $this->ctlType;
	}
	
	public function getCtlName() {
		return $this->ctlName;
	}

	public function getModelName() {
		return $this->modelName;
	}

	public function getHelperName() {
		return $this->helperName;
	}
	
	/**
	 * ナビゲーション作成用パラメータを取得する
	 * @return array
	 */
	public function getNaviParams() {
		return $this->naviParams;
	}
	
	public function getLinks() {
		return $this->links;
	}
}