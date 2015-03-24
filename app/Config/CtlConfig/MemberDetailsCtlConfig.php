<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppDetailCtlConfig', 'Console/Command/Lib/CtlConfig');

/**
 * Description of MemberEditCtlConfig
 *
 * @author hanai
 */
class MemberDetailsCtlConfig extends AppDetailCtlConfig {
	
	protected $traitNames = array(
		'TblUserView',
		'TblGroupView',
	);
	
	protected $naviParams = array(
		'Top'			=> 'UrlUtil::getMainsIndex()',
		'Member Search'	=> 'UrlUtil::getMemberSearchsIndex()',
		'Member Detile'	=> 'UrlUtil::getMemberDetailsIndex()',
	);
	
}