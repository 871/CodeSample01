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
abstract class AppEditCtlConfig extends AppCtlConfig {
	
	const CTP_CONF = 'conf';
	const CTP_COMP = 'comp';

	/**
	 * Ctl Type
	 * @var string
	 */
	protected $ctlType = self::TYPE_EDIT;
	
	/**
	 * Array Path
	 * next => $label
	 * conf => $label
	 * back => $label
	 * comp => $label
	 * 
	 * @var array
	 */
	protected $submitLables = array(
		'next'	=> 'Next',
		'conf'	=> 'Confirmation',
		'back'	=> 'Back',
		'comp'	=> 'Register',
	);
	
	/**
	 * Array Path	
	 * $fieldName.ctp		=> Ctp File Name
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
	 * 入力フォーム作成用パラメータを取得する
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