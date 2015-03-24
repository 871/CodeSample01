<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppShell', 'Console/Command');
App::uses('ClassFile', 'Console/Command/Lib/FileGenerate');
App::uses('ClassMember', 'Console/Command/Lib/FileGenerate');
App::uses('ClassMedhod', 'Console/Command/Lib/FileGenerate');
App::uses('Import', 'Console/Command/Lib/FileGenerate');

/**
 * Description of GenerateCtlHelperCreateTask
 *
 * @author hanai
 */
class GenerateCtlHelperEditTask extends AppShell {
	
	const GENERATE_DIR = 'View/Helper/CtlHelper/';
	
	const INDENT = "\t";
	
	public function run(AppEditCtlConfig $config) {
		$task		= $this;
		$path		= self::getGenatratePath($config);
		$contents	= self::getGenatrateContents($config);
		self::generateCtlHelperFile($task, $path, $contents);
	}
	
	/**
	 * ファイルパス
	 * @param AppEditCtlConfig $config
	 * @return string
	 */
	private static function getGenatratePath(AppEditCtlConfig $config) {
		$helperName = $config->getHelperName();
		$path		= APP . self::GENERATE_DIR . $helperName . '.php';
		return self::createNotExistsPath($path);
	}
	
	/**
	 * 有効なファイルパス
	 * @staticvar int $cnt
	 * @param string $path
	 * @return string
	 */
	private static function createNotExistsPath($path) {
		static $cnt = 0;
		if (file_exists($path)) {
			$cnt++;
			$tmp = preg_replace('/(\([0-9]+\))?\.php$/', '(' . $cnt . ').php', $path);
			return static::createNotExistsPath($tmp);
		} else {
			$cnt = 0;
			return $path;
		}
	}
	
	/**
	 * 
	 * @param AppEditCtlConfig $config
	 * @return string
	 */
	private static function getGenatrateContents(AppEditCtlConfig $config) {
		$classType			= 'class';
		$className			= $config->getHelperName();
		$parentClassName	= 'AppCtlHelper';
		
		$importAppCtlHelper	= self::getImportAppCtlHelper();
		$importUrlUtil		= self::getImportUrlUtil();
		
		$getFormStartMethod	= self::getGetFormStartMethod	($config);
		$getFormEndMethod	= self::getGetFormEndMethod		();
		
		$getSubmitConfMethod	= self::getGetSubmitConfMethod	($config);
		$getSubmitBackMethod	= self::getGetSubmitBackMethod	($config);
		$getSubmitCompMethod	= self::getGetSubmitCompMethod	($config);
		
		$getLabelMedhods	= self::getGetLabelMedhods	($config);
		$getInputMedhods	= self::getGetInputMedhods	($config);
		$getValueMedhods	= self::getGetValueMedhods	($config);
		$getLinkMedhods		= self::getGetLinkMedhods	($config);
		
		$getDivNaviLinksMedhod	= self::getGetDivNaviLinksMedhod($config);
		
		$file = new ClassFile();
		$file->setClassType($classType);
		$file->setClassName($className);
		$file->setParentClassName($parentClassName);
		
		$file->addImport($importAppCtlHelper);
		$file->addImport($importUrlUtil);
		
		$file->addMedhod($getFormStartMethod);
		$file->addMedhod($getFormEndMethod);
		$file->addMedhod($getSubmitConfMethod);
		$file->addMedhod($getSubmitBackMethod);
		$file->addMedhod($getSubmitCompMethod);
		
		foreach ($getLabelMedhods as $getLabelMedhod) {
			$file->addMedhod($getLabelMedhod);
		}
		foreach ($getInputMedhods as $getInputMedhod) {
			$file->addMedhod($getInputMedhod);
		}
		foreach ($getValueMedhods as $getValueMedhod) {
			$file->addMedhod($getValueMedhod);
		}
		foreach ($getLinkMedhods as $getLinkMedhod) {
			$file->addMedhod($getLinkMedhod);
		}
		
		$file->addMedhod($getDivNaviLinksMedhod);
		
		return $file->getContents();
	}
	
	private static function getImportAppCtlHelper() {
		$className	= 'AppCtlHelper';
		$path		= 'View/Helper';
		$method		= Import::METHOD_USES;
		return new Import($className, $path, $method);
	}
	
	private static function getImportUrlUtil() {
		$className	= 'UrlUtil';
		$path		= 'Lib/Util';
		$method		= Import::METHOD_USES;
		return new Import($className, $path, $method);
	}
	
	private static function getGetFormStartMethod() {
		$comment = 'Form Start';
		$logic = array(
			'$form	= $this->ExtForm;',
			'$alias	= $this->alias;',
			'return $form->create($alias, $options);',
		);
		
		$method = new ClassMedhod();
		$method->addMedhodComment($comment);
		$method->addMedhodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMedhodName('getFormStart');
		$method->addArg('$options = array()', 'array', 'array');
		$method->setLogic($logic);

		return $method;
	}
	
	private static function getGetFormEndMethod() {
		$comment = 'Form End';
		$logic = array(
			'$form = $this->ExtForm;',
			'return $form->end();',
		);
		
		$method = new ClassMedhod();
		$method->addMedhodComment($comment);
		$method->addMedhodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMedhodName('getFormEnd');
		$method->setLogic($logic);

		return $method;
	}

	private static function getGetSubmitNextMethod(AppEditCtlConfig $config) {
		$label		= $config->getSubmitLables('next');
		$comment	= 'Submit Button (' . $label . ')';
		$logic = array(
			'$form		= $this->ExtForm;',
			'$caption	= __(\'' . $label . '\');',
			'$options	= array(',
			'	\'div\'	=> false,',
			');',
			'',
			'return $form->submit($caption, $options);',
		);
		
		$method = new ClassMedhod();
		$method->addMedhodComment($comment);
		$method->addMedhodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMedhodName('getSubmitNext');
		$method->setLogic($logic);

		return $method;
	}
	
	private static function getGetSubmitConfMethod(AppEditCtlConfig $config) {
		$label		= $config->getSubmitLables('conf');
		$comment	= 'Submit Button (' . $label . ')';
		$logic = array(
			'$form		= $this->ExtForm;',
			'$caption	= __(\'' . $label . '\');',
			'$options	= array(',
			'	\'div\'	=> false,',
			');',
			'',
			'return $form->submit($caption, $options);',
		);
		
		$method = new ClassMedhod();
		$method->addMedhodComment($comment);
		$method->addMedhodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMedhodName('getSubmitConf');
		$method->setLogic($logic);

		return $method;
	}
	
	
	private static function getGetSubmitBackMethod(AppEditCtlConfig $config) {
		$ctlName	= $config->getCtlName();
		$label		= $config->getSubmitLables('back');
		$comment	= 'Submit Button (' . $label . ')';
		$logic = array(
			'$form		= $this->ExtForm;',
			'$caption	= __(\'' . $label . '\');',
			'$options	= array(',
			'	\'class\'	=> \'bt_back\',',
			'	\'div\'	=> false,',
			');',
			'',
			'$arrTags = array(',
			'	\'<script>(function($) {\',',
			'		"$(\'.bt_back\').click(function(){",',
			'			"location.href = \'/' . $ctlName . '/{$backAction}\';",',
			'			\'return false;\',',
			'		\'});\',',
			'	\'})(jQuery)</script>\',',
			');',
			'',
			'$script = join("\n", $arrTags);',
			'return $form->submit($caption, $options) . $script;',
		);
		
		$method = new ClassMedhod();
		$method->addMedhodComment($comment);
		$method->addMedhodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMedhodName('getSubmitComp');
		$method->addArg('$backAction', 'string');
		$method->setLogic($logic);

		return $method;
	}
	
	private static function getGetSubmitCompMethod(AppEditCtlConfig $config) {
		$label		= $config->getSubmitLables('comp');
		$comment	= 'Submit Button (' . $label . ')';
		$logic = array(
			'$form		= $this->ExtForm;',
			'$caption	= __(\'' . $label . '\');',
			'$options	= array(',
			'	\'div\'	=> false,',
			');',
			'',
			'return $form->submit($caption, $options);',
		);
		
		$method = new ClassMedhod();
		$method->addMedhodComment($comment);
		$method->addMedhodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMedhodName('getSubmitComp');
		$method->setLogic($logic);

		return $method;
	}

	private static function getGetLabelMedhods(AppEditCtlConfig $config) {
		$methods = array();
		
		$params = $config->getParams();
		foreach ($params as $fieldName => $param) {
			$medhodName	= self::getGetLabelMedhodMethodName($fieldName);
			$comment	= self::getGetLabelMedhodComment($param);
			$logic		= self::getGetLabelMedhodLogic($param);
			
			$method = new ClassMedhod();
			$method->addMedhodComment($comment);
			$method->addMedhodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMedhodName($medhodName);
			$method->setLogic($logic);
			
			$methods[] = $method;
		}
		return $methods;
	}
	
	private static function getGetLabelMedhodMethodName($fieldName) {
		return 'getLabel' . Inflector::camelize($fieldName);
	}
	
	private static function getGetLabelMedhodComment(array $param) {
		$label = $param['label'];
		return $label . ' Label';
	}
	
	private static function getGetLabelMedhodLogic(array $param) {
		$label = $param['label'];
		if (is_array($label)) {
			return self::getGetLabelMedhodLogicArray($param);
		} else {
			return self::getGetLabelMedhodLogicString($param);
		}
	}
	
	private static function getGetLabelMedhodLogicArray(array $param) {
		$indent	= self::INDENT;
		$label	= $param['label'];
		
		$result = array();
		$result[] = '$labels = array(';
		for ($i = 0, $cnt = count($label); $i < $cnt; ++$i) {
			$result[] = $indent . '__(\'' . $label[$i] . '\'),';
		}
		$result[] = ');';
		$result[] = '$label = join("\n", $labels);';
		$result[] = '';
		$result[] = 'return nl2br(h($label));';
		
		return $result;
	}
	
	private static function getGetLabelMedhodLogicString(array $param) {
		$label = $param['label'];
		
		$result = array();
		$result[] = '$label	= __(\'' . $label . '\');';
		$result[] = 'return h($label);';
		
		return $result;
	}

	private static function getGetInputMedhods(AppEditCtlConfig $config) {
		$methods = array();
		
		$params = $config->getParams();
		foreach ($params as $fieldName => $param) {
			$medhodName	= self::getGetInputMedhodMethodName($fieldName);
			$comment	= self::getGetInputMedhodComment($param);
			$logic		= self::getGetInputMedhodLogic($fieldName, $param);
			
			$method = new ClassMedhod();
			$method->addMedhodComment($comment);
			$method->addMedhodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMedhodName($medhodName);
			$method->setLogic($logic);
			
			$methods[] = $method;
		}
		return $methods;
	}
	
	private static function getGetInputMedhodMethodName($fieldName) {
		return 'getInput' . Inflector::camelize($fieldName);
	}
	
	private static function getGetInputMedhodComment(array $param) {
		$label = $param['label'];
		return $label . ' Input';
	}
	
	private static function getGetInputMedhodLogic($fieldName, array $param) {
		$options		= $param['options'];
		$arrayInners	= self::getArrayInners($options, 1);
		
		$result = array();
		$result[] = '$form		= $this->ExtForm;';
		$result[] = '$field		= \'' . $fieldName . '\';';
		if (empty($arrayInners)) {
			$result[] = '$options	= array();';
		} else {
			$result[] = '$options	= array(';
			for ($i = 0, $cnt = count($arrayInners); $i < $cnt; ++$i) {
				$result[] = $arrayInners[$i];
			}
			$result[] = ');';
		}
		$result[] = '';
		$result[] = 'return $form->error($field) . $form->input($field, $options);';
		
		return $result;
	}
	
	private static function getGetValueMedhods(AppEditCtlConfig $config) {
		$methods = array();
		
		$params = $config->getParams();
		foreach ($params as $fieldName => $param) {
			$medhodName	= self::getGetValueMedhodMethodName($fieldName);
			$comment	= self::getGetValueMedhodComment($param);
			$logic		= self::getGetValueMedhodLogic($fieldName);
			
			$method = new ClassMedhod();
			$method->addMedhodComment($comment);
			$method->addMedhodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMedhodName($medhodName);
			$method->setLogic($logic);
			
			$methods[] = $method;
		}
		return $methods;
	}
	
	private static function getGetValueMedhodMethodName($fieldName) {
		return 'getValue' . Inflector::camelize($fieldName);
	}

	private static function getGetValueMedhodComment(array $param) {
		$label = $param['label'];
		return $label . ' Value';
	}

	private static function getGetValueMedhodLogic($fieldName) {
		$result = array(
			'$form		= $this->ExtForm;',
			'$field		= \'' . $fieldName . '\';',
			'return h($form->extValue($field));',
		);
		return $result;
	}
	
	private static function getGetLinkMedhods(AppCreateCtlConfig $config) {
		$ctlName = $config->getCtlName();
		
		$methods = array();
		$links = $config->getLinks();
		foreach ($links as $label => $url) {
			$medhodName	= self::getGetLinkMedhodMethodName($url, $ctlName);
			$comment	= self::getGetLinkMedhodComment($label);
			$logic		= self::getGetLinkMedhodLogic($label, $url, $ctlName);
			
			$method = new ClassMedhod();
			$method->addMedhodComment($comment);
			$method->addMedhodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMedhodName($medhodName);
			$method->setLogic($logic);
			
			$methods[] = $method;
		}
		return $methods;
	}
	
	private static function getGetLinkMedhodMethodName(array $url, $ctlName) {
		$url['controller']	= !isset($url['controller'])? $ctlName	: $url['controller'];
		$url['action']		= !isset($url['action'])	? 'index'	: $url['action'];
		
		$ctl	= Inflector::camelize($url['controller']);
		$action	= Inflector::camelize($url['action']);
		
		return 'getLink' . $ctl . $action;
	}
	
	private static function getGetLinkMedhodComment($label) {
		return $label . ' Link';
	}
	
	private static function getGetLinkMedhodLogic($label, $url, $ctlName) {
		$url['controller']	= !isset($url['controller'])? $ctlName	: $url['controller'];
		$url['action']		= !isset($url['action'])	? 'index'	: $url['action'];
		
		$ctl	= Inflector::camelize($url['controller']);
		$action	= Inflector::camelize($url['action']);
		
		$result = array(
			'$html		= $this->Html;',
			'$title		= __(\'' . $label . '\');',
			'$url		= UrlUtil::get' . $ctl . $action . '();',
			'$options	= array();',
			'',
			'return $html->link($title, $url, $options);',
		);
		return $result;
	}
	
	private static function getGetDivNaviLinksMedhod(AppCreateCtlConfig $config) {
		$indnt		= self::INDENT;
		$naviParams	= $config->getNaviParams();
		
		$logic = array();
		$logic[] = '$ctlHelper	= $this;';
		$logic[] = '$alias		= $ctlHelper->alias;';
		$logic[] = '$html		= $ctlHelper->Html;';
		$logic[] = '$request	= $ctlHelper->request;';
		$logic[] = '$action		= $request->params[\'action\'];';
		$logic[] = '$ctlName	= Inflector::tableize($alias);';
		$logic[] = '';
		$logic[] = '$params = array(';
		foreach ($naviParams as $label => $url) {
			$logic[] = $indnt . '__(\'' . $label . '\')	=> ' . self::arrayToString($url);
		}
		$logic[] = ');';
		$logic[] = '';
		$logic[] = '$linkFlag = true;';
		$logic[] = 'foreach ($params as $label => $url) {';
		$logic[] = '	$url[\'controller\'] = !isset($url[\'controller\'])? $ctlName: $url[\'controller\'];';
		$logic[] = '	$url[\'controller\'] = empty($url[\'controller\'])? $ctlName: $url[\'controller\'];';
		$logic[] = '	';
		$logic[] = '	if ($action === $url[\'action\'] && $url[\'controller\'] === $ctlName) {';
		$logic[] = '		$linkFlag = false;';
		$logic[] = '	}';
		$logic[] = '	if ($linkFlag) {';
		$logic[] = '		$html->addCrumb($label, $url);';
		$logic[] = '	} else {';
		$logic[] = '		$html->addCrumb($label);';
		$logic[] = '	}';
		$logic[] = '}';
		$logic[] = '';
		$logic[] = 'return $html->getCrumbs(" > ");';
		
		$method = new ClassMedhod();
		$method->addMedhodComment('Top Navigator');
		$method->addMedhodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMedhodName('getDivNaviLinks');
		$method->setLogic($logic);

		return $method;
	}

	/**
	 * 配列コードの内容を作成
	 * @param array $array
	 * @param int $indntCount
	 * @return string
	 */
	private static function getArrayInners(array $array, $indntCount = 1, $translate = false) {
		$indnt	= self::INDENT;
		$indnts	= str_repeat($indnt, $indntCount);
		
		$result = array();
		foreach ($array as $key => $val) {
			if (is_numeric($key) && $translate) {
				$result[] = $indnts . '__(\'' . $val . '\'),';
			} else if (is_numeric($key)){
				$result[] = $indnts . '\'' . $val . '\',';
			} else if ($translate) {
				$result[] = $indnts . '\'' . $key . '\'' . $indnt . '=> __(\'' . $val . '\'),';
			} else {
				$result[] = $indnts . '\'' . $key . '\'' . $indnt . '=> \'' . $val . '\',';
			}
		}
		return $result;
	}
	
	private static function arrayToString($value) {
		if (is_array($value)) {
			$tmp = '';
			foreach ($value as $key => $val) {
				if (is_numeric($key)) {
					$tmp .= '\'' . $val . '\',';
				} else {
					$tmp .= '\'' . $key . '\' => \'' . $val . '\',';
				}
			}
			return 'array(' . $tmp . '),';
		} else {
			return $value;
		}
	}

	/**
	 * ファイルを作成
	 * @param self $task
	 * @param type $path
	 * @param type $contents
	 * @throws RuntimeException
	 */
	private static function generateCtlHelperFile(self $task, $path, $contents) {
		$result = $task->createFile($path, $contents);
		if (!$result) {
			throw new RuntimeException('File Generate Error [File:' . $path . ']');
		}
	}
}