<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppShell', 'Console/Command');
App::uses('AppCtlConfig', 'Console/Command/Lib/CtlConfig');

/**
 * Description of GenerateCtlHelperShell
 *
 * @author hanai
 */
class GenerateCtlHelperShell extends AppShell {
	
	public $tasks = array(
		'GenerateCtlHelperCreate',
		'GenerateCtlHelperEdit',
	);
	
    public function main() {
		$shell		= $this;
		$ctlName	= $shell->args[0];
		$helperName	= Inflector::singularize($ctlName) . 'Helper';
		
		try {
			$shell->out('Start Generate [View/Helper/CtlHelper/' . $helperName . '.php]');
			self::generateCtlHelper($shell, $ctlName);
			$shell->out('End Generate [View/Helper/CtlHelper/' . $helperName . '.php]');
		} catch (RuntimeException $e) {
			$shell->out('Error Message:' . $e->getMessage());
			$shell->out('Error Not Generate [View/Helper/CtlHelper/' . $helperName . '.php]');
		} catch (Exception $e) {
			$shell->out('System Error [' . $e->getMessage() . ']');
			$shell->out('Error Not Generate [View/Helper/CtlHelper/' . $helperName . '.php]');
		}
    }
	
	private static function generateCtlHelper(self $shell, $ctlName) {
		$ctlConfig	= self::getCtlConfig($ctlName);
		$ctlType	= self::getCtlType($ctlConfig);
		
		switch ($ctlType) {
			case AppCtlConfig::TYPE_CREATE:
				return $shell->GenerateCtlHelperCreate->run($ctlConfig);
			case AppCtlConfig::TYPE_EDIT:
				return $shell->GenerateCtlHelperEdit->run($ctlConfig);
			case AppCtlConfig::TYPE_DETAIL:
				// TODO 追加予定	
			case AppCtlConfig::TYPE_SEARCH:
				// TODO 追加予定	
			case AppCtlConfig::TYPE_LIST:
				// TODO 追加予定	
			default :
				throw new RuntimeException('[' . $ctlType . '] CtlConfig Type Not Fund');
		}
	}
	
	/**
	 * 設定オブジェクトを取得
	 * @param string $ctlName
	 * @return \AppCtlConfig
	 * @throws RuntimeException
	 */
	private static function getCtlConfig($ctlName) {
		$className = $ctlName . 'CtlConfig';
		
		config('CtlConfig' . DS . $className);
		
		$ctlConfig = new $className();
		if ($ctlConfig instanceof AppCtlConfig ) {
			return $ctlConfig;
		} else {
			throw new RuntimeException('[' . $className . '] is Not AppCtlConfig Instance');
		}
	}
	
	/**
	 * Ctl種別
	 * @param AppCtlConfig $ctlConfig
	 * @return string
	 */
	private static function getCtlType(AppCtlConfig $ctlConfig) {
		return $ctlConfig->getCtlType();
	}
}