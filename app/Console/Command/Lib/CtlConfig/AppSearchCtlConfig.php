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
	
	
	
	
}