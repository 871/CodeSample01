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
abstract class AppDetailCtlConfig extends AppCtlConfig {
	
	const TRAIT_PATH = 'Lib/Trait/OrmView';
	
	/**
	 * Ctl Type
	 * @var string
	 */
	protected $ctlType = self::TYPE_DETAIL;
	
	/**
	 * use
	 * @var array
	 */
	protected $traitNames = array();
	
	/**
	 * トレイト設定作成用パラメータを取得する
	 * @return array
	 */
	public function getTraitNames() {
		return $this->traitNames;
	}
}