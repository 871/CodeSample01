<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppCtlConfig', 'Console/Command/Lib/CtlConfig');

/**
 * Description of AppCtlConfig
 *
 * @author hanai
 */
abstract class AppSearchCtlConfig extends AppCtlConfig {
		
	/**
	 * Ctl Type
	 * @var string
	 */
	protected $ctlType = self::TYPE_SEARCH;
	
	/**
	 *
	 * @var string
	 */
	protected $paginateModelName = '';
	
	/**
	 * Array Path
	 * search => $label
	 * 
	 * @var array
	 */
	protected $submitLables = array(
		'search'	=> 'Search',
	);
	
	/**
	 * Array Path	
	 * $fieldName.label		=> CtlHelper getLabelMethod Value
	 * $fieldName.type		=> $ctlModel->params[$fieldName]['type']
	 * $fieldName.validate	=> $ctlModel->validate
	 * $fieldName.params	=> $ctlModel->params[$fieldName]
	 * $fieldName.options	=> CtlHelper getInputMethod $options
	 * 
	 * @var array
	 */
	protected $params = array();
	
	/**
	 * $lable => $url
	 * 
	 * @var array
	 */
	protected $links = array();
	
	/**
	 * Array Path
	 * {n}.$label
	 * {n}.$type(get|post)
	 * {n}.$ctl
	 * {n}.$action
	 * 
	 * @var array
	 */
	protected $paginatorLinks = array();
	
	/**
	 * 検索フォーム作成用パラメータを取得する
	 * @param string $path
	 * @return mix
	 */
	public function getParams($path = null) {
		$params	= $this->params;
		if (is_null($path)) {
			return $params;
		} else {
			return Hash::extract($params, $path);
		}
	}
	
	public function getPaginateModel() {
		$modelName = $this->paginateModelName;
		return ClassRegistry::init($modelName);
	}
	
	public function getPaginatorLinks() {
		return $this->paginatorLinks;
	}
	
	/**
	 * サブミットボタン作成用パラメータを取得する
	 * @param string $path
	 * @return mix
	 */
	public function getSubmitLables($path = null) {
		$submitLables	= $this->submitLables;
		if (is_null($path)) {
			return $submitLables;
		} else {
			return Hash::get($submitLables, $path);
		}
	}
}