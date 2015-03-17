<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppCreateCtlConfig', 'Console/Command/Lib/CtlConfig');

/**
 * Description of MemberCreateCtlConfig
 *
 * @author hanai
 */
class MemberCreatesCtlConfig extends AppCreateCtlConfig {
	
	const CTP01 = 'step01';
	const CTP02 = 'step02';
	const CTP03 = 'step03';
	
	protected $naviParams = array(
		'Step1(メンバ情報)'		=> array('action' => self::CTP01,),
		'Step2(メールアドレス)'	=> array('action' => self::CTP02,),
		'Step3(グループ情報)'		=> array('action' => self::CTP03,),
		'登録確認'				=> array('action' => self::CTP_CONF,),
		'登録完了'				=> array('action' => self::CTP_COMP,),
	);
	
	protected $submitLables = array(
		'next'	=> 'Next',
		'conf'	=> 'Confirmation',
		'back'	=> 'Back',
		'comp'	=> 'Register',
	);
	
	protected $links = array(
		'Label' => array('controller' => 'user_edits', 'action' => 'index',),
	);
	
	protected $params = array(
		'member_name' => array(
			'ctp'		=> self::CTP01,
			'label'		=> 'Member Name',
			'type'		=> 'text',
			'validate'	=> array(
				'notEmpty' => array(
					'rule'			=> array('notEmpty', ),
					'message'		=> 'メンバー名を入力して下さい',
					'allowEmpty'	=> true,
				),
				'maxlength' => array(
					'rule'			=> array('maxlength', 50),
					'message'		=> 'メンバー名は50文字以内で入力して下さい',
					'allowEmpty'	=> true,
				),
				'checkUnique' => array(
					'rule'			=> array('checkUnique', 'TblMember', 'member_name', null),
					'message'		=> 'このメンバー名は登録済です',
					'allowEmpty'	=> true,
				),
			),
			'params'	=> array(
				'maxlength'		=> 50,
				'required'		=> true,
			),
			'options'	=> array(),
		),
		'member_mail' => array(
			'ctp'		=> self::CTP01,
			'label'		=> 'Member Mail',
			'type'		=> 'text',
			'validate'	=> array(
				'notEmpty' => array(
					'rule'			=> array('notEmpty', ),
					'message'		=> 'E-Mailを入力して下さい',
				),
				'email' => array(
					'rule'		=> array('email',),
					'message'	=> 'メールアドレスのフォーマットが不正です',
				),
				'maxlength' => array(
					'rule'			=> array('maxlength', 200),
					'message'		=> 'E-Mailは200文字以内で入力して下さい',
				),
				'checkUnique' => array(
					'rule'			=> array('checkUnique', 'TblMember', 'member_mail', null),
					'message'		=> '入力されたメールアドレスは登録済です',
				),
				'checkSubMail' => array(
					'rule'			=> array('checkSubMail',),
					'message'		=> '同じメールアドレスが複数入力されています',
				),
			),
			'params'	=> array(
				'maxlength'		=> 200,
				'required'		=> true,
			),
			'options'	=> array(
				'style' => 'width: 90%;',
			),
		),
		/**
		'' => array(
			'ctp'		=> static::CTP01,
			'label'		=> '',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(),
		),
		'' => array(
			'ctp'		=> static::CTP01,
			'label'		=> '',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(),
		),
		'' => array(
			'ctp'		=> static::CTP01,
			'label'		=> '',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(),
		),
		'' => array(
			'ctp'		=> static::CTP01,
			'label'		=> '',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(),
		),
		'' => array(
			'ctp'		=> static::CTP01,
			'label'		=> '',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(),
		),
		'' => array(
			'ctp'		=> static::CTP01,
			'label'		=> '',
			'type'		=> 'text',
			'validate'	=> array(),
			'params'	=> array(),
			'options'	=> array(),
		),
		/**/
	);
}