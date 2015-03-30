<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppSearchCtlConfig', 'Console/Command/Lib/CtlConfig');

/**
 * Description of MemberSearchsCtlConfig
 *
 * @author hanai
 */
class MemberSearchsCtlConfig extends AppSearchCtlConfig {
	
	protected $paginateModelName = 'TblMember';
	
	protected $naviParams = array(
		'Top'			=> 'UrlUtil::getMainsIndex()',
		'Member Search'	=> 'UrlUtil::getMemberSearchsIndex()',
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
	protected $params = array(
		'tbl_group_id' => array(
			'label'		=> 'Group Name',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(
				'style' => 'font-size: 100%; width: 90%;',
			),
		),
		'member_name' => array(
			'label'		=> 'Member Name',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(
				'style' => 'font-size: 100%; width: 90%;',
			),
		),
		'member_mail' => array(
			'label'		=> 'Member Mail',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(
				'style' => 'font-size: 100%; width: 90%;',
			),
		),
		'member_age_min' => array(
			'label'		=> 'Member Age(min)',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(
				'style' => 'font-size: 100%; width: 40%;',
			),
		),
		'member_age_max' => array(
			'label'		=> 'Member Age(max)',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(
				'style' => 'font-size: 100%; width: 40%;',
			),
		),
		/*
		'' => array(
			'label'		=> '',
			'type'		=> '',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(),
		),/**/
	);
	
	/**
	 * $lable => $url
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
	protected $paginatorLinks = array(
		array('label' => 'Member Detail', 'type' => 'get', 'ctl' => 'MemberDetails', 'action' => 'index',),
		array('label' => 'Member Edit', 'type' => 'get', 'ctl' => 'MemberEdits', 'action' => 'index',),
		array('label' => 'Member Delete', 'type' => 'post', 'ctl' => 'MemberDeletes', 'action' => 'index',),
		array('label' => 'EtcEtc', 'type' => 'get', 'ctl' => 'Hoges', 'action' => 'huga',),
	);
}