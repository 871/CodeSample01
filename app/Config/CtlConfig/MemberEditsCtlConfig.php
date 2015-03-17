<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppEditCtlConfig', 'Console/Command/Lib/CtlConfig');

/**
 * Description of MemberEditCtlConfig
 *
 * @author hanai
 */
class MemberEditsCtlConfig extends AppEditCtlConfig {
	
	const CTP01 = 'input';
	
	protected $naviParams = array(
		'編集'	=> array('action' => self::CTP01,),
		'確認'	=> array('action' => self::CTP_CONF,),
		'完了'	=> array('action' => self::CTP_COMP,),
	);
	
	protected $submitLables = array(
		'conf'	=> 'Confirmation',
		'back'	=> 'Back',
		'comp'	=> 'Register',
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