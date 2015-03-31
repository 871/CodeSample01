<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppShell', 'Console/Command');
App::uses('ClassFile', 'Console/Command/Lib/FileGenerate');
App::uses('ClassMember', 'Console/Command/Lib/FileGenerate');
App::uses('ClassMethod', 'Console/Command/Lib/FileGenerate');
App::uses('Import', 'Console/Command/Lib/FileGenerate');

/**
 * Description of GenerateCtlHelperCreateTask
 *
 * @author hanai
 */
class GenerateCtlHelperCreateTask extends AppShell {
	
	const GENERATE_DIR = 'View/Helper/CtlHelper/';
	
	const INDENT = "\t";
	
	public function run(AppCreateCtlConfig $config) {
		$task		= $this;
		$path		= self::getGenatratePath($config);
		$contents	= self::getGenatrateContents($config);
		self::generateCtlHelperFile($task, $path, $contents);
	}
	
	/**
	 * ファイルパス
	 * @param AppCreateCtlConfig $config
	 * @return string
	 */
	private static function getGenatratePath(AppCreateCtlConfig $config) {
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
	 * @param AppCreateCtlConfig $config
	 * @return string
	 */
	private static function getGenatrateContents(AppCreateCtlConfig $config) {
		$classType			= 'class';
		$className			= $config->getHelperName();
		$parentClassName	= 'AppCtlHelper';
		
		$importAppCtlHelper	= self::getImportAppCtlHelper();
		$importUrlUtil		= self::getImportUrlUtil();
		
		$getFormStartMethod	= self::getGetFormStartMethod	($config);
		$getFormEndMethod	= self::getGetFormEndMethod		();
		
		$getSubmitNextMethod	= self::getGetSubmitNextMethod	($config);
		$getSubmitConfMethod	= self::getGetSubmitConfMethod	($config);
		$getSubmitBackMethod	= self::getGetSubmitBackMethod	($config);
		$getSubmitCompMethod	= self::getGetSubmitCompMethod	($config);
		
		$getLabelMethods	= self::getGetLabelMethods	($config);
		$getInputMethods	= self::getGetInputMethods	($config);
		$getValueMethods	= self::getGetValueMethods	($config);
		$getLinkMethods		= self::getGetLinkMethods	($config);
		
		$getDivNaviLinksMethod	= self::getGetDivNaviLinksMethod($config);
		
		$file = new ClassFile();
		$file->setClassType($classType);
		$file->setClassName($className);
		$file->setParentClassName($parentClassName);
		
		$file->addImport($importAppCtlHelper);
		$file->addImport($importUrlUtil);
		
		$file->addMethod($getFormStartMethod);
		$file->addMethod($getFormEndMethod);
		$file->addMethod($getSubmitNextMethod);
		$file->addMethod($getSubmitConfMethod);
		$file->addMethod($getSubmitBackMethod);
		$file->addMethod($getSubmitCompMethod);
		
		foreach ($getLabelMethods as $getLabelMethod) {
			$file->addMethod($getLabelMethod);
		}
		foreach ($getInputMethods as $getInputMethod) {
			$file->addMethod($getInputMethod);
		}
		foreach ($getValueMethods as $getValueMethod) {
			$file->addMethod($getValueMethod);
		}
		foreach ($getLinkMethods as $getLinkMethod) {
			$file->addMethod($getLinkMethod);
		}
		
		$file->addMethod($getDivNaviLinksMethod);
		
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
		
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName('getFormStart');
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
		
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName('getFormEnd');
		$method->setLogic($logic);

		return $method;
	}

	private static function getGetSubmitNextMethod(AppCreateCtlConfig $config) {
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
		
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName('getSubmitNext');
		$method->setLogic($logic);

		return $method;
	}
	
	private static function getGetSubmitConfMethod(AppCreateCtlConfig $config) {
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
		
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName('getSubmitConf');
		$method->setLogic($logic);

		return $method;
	}
	
	
	private static function getGetSubmitBackMethod(AppCreateCtlConfig $config) {
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
		
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName('getSubmitComp');
		$method->addArg('$backAction', 'string');
		$method->setLogic($logic);

		return $method;
	}
	
	private static function getGetSubmitCompMethod(AppCreateCtlConfig $config) {
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
		
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName('getSubmitComp');
		$method->setLogic($logic);

		return $method;
	}

	private static function getGetLabelMethods(AppCreateCtlConfig $config) {
		$methods = array();
		
		$params = $config->getParams();
		foreach ($params as $fieldName => $param) {
			$methodName	= self::getGetLabelMethodMethodName($fieldName);
			$comment	= self::getGetLabelMethodComment($param);
			$logic		= self::getGetLabelMethodLogic($param);
			
			$method = new ClassMethod();
			$method->addMethodComment($comment);
			$method->addMethodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMethodName($methodName);
			$method->setLogic($logic);
			
			$methods[] = $method;
		}
		return $methods;
	}
	
	private static function getGetLabelMethodMethodName($fieldName) {
		return 'getLabel' . Inflector::camelize($fieldName);
	}
	
	private static function getGetLabelMethodComment(array $param) {
		$label = $param['label'];
		return $label . ' Label';
	}
	
	private static function getGetLabelMethodLogic(array $param) {
		$label = $param['label'];
		if (is_array($label)) {
			return self::getGetLabelMethodLogicArray($param);
		} else {
			return self::getGetLabelMethodLogicString($param);
		}
	}
	
	private static function getGetLabelMethodLogicArray(array $param) {
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
	
	private static function getGetLabelMethodLogicString(array $param) {
		$label = $param['label'];
		
		$result = array();
		$result[] = '$label	= __(\'' . $label . '\');';
		$result[] = 'return h($label);';
		
		return $result;
	}

	private static function getGetInputMethods(AppCreateCtlConfig $config) {
		$methods = array();
		
		$params = $config->getParams();
		foreach ($params as $fieldName => $param) {
			$methodName	= self::getGetInputMethodMethodName($fieldName);
			$comment	= self::getGetInputMethodComment($param);
			$logic		= self::getGetInputMethodLogic($fieldName, $param);
			
			$method = new ClassMethod();
			$method->addMethodComment($comment);
			$method->addMethodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMethodName($methodName);
			$method->setLogic($logic);
			
			$methods[] = $method;
		}
		return $methods;
	}
	
	private static function getGetInputMethodMethodName($fieldName) {
		return 'getInput' . Inflector::camelize($fieldName);
	}
	
	private static function getGetInputMethodComment(array $param) {
		$label = $param['label'];
		return $label . ' Input';
	}
	
	private static function getGetInputMethodLogic($fieldName, array $param) {
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
	
	private static function getGetValueMethods(AppCreateCtlConfig $config) {
		$methods = array();
		
		$params = $config->getParams();
		foreach ($params as $fieldName => $param) {
			$methodName	= self::getGetValueMethodMethodName($fieldName);
			$comment	= self::getGetValueMethodComment($param);
			$logic		= self::getGetValueMethodLogic($fieldName);
			
			$method = new ClassMethod();
			$method->addMethodComment($comment);
			$method->addMethodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMethodName($methodName);
			$method->setLogic($logic);
			
			$methods[] = $method;
		}
		return $methods;
	}
	
	private static function getGetValueMethodMethodName($fieldName) {
		return 'getValue' . Inflector::camelize($fieldName);
	}

	private static function getGetValueMethodComment(array $param) {
		$label = $param['label'];
		return $label . ' Value';
	}

	private static function getGetValueMethodLogic($fieldName) {
		$result = array(
			'$form		= $this->ExtForm;',
			'$field		= \'' . $fieldName . '\';',
			'return h($form->extValue($field));',
		);
		return $result;
	}
	
	private static function getGetLinkMethods(AppCreateCtlConfig $config) {
		$ctlName = $config->getCtlName();
		
		$methods = array();
		$links = $config->getLinks();
		foreach ($links as $label => $url) {
			$methodName	= self::getGetLinkMethodMethodName($url, $ctlName);
			$comment	= self::getGetLinkMethodComment($label);
			$logic		= self::getGetLinkMethodLogic($label, $url, $ctlName);
			
			$method = new ClassMethod();
			$method->addMethodComment($comment);
			$method->addMethodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMethodName($methodName);
			$method->setLogic($logic);
			
			$methods[] = $method;
		}
		return $methods;
	}
	
	private static function getGetLinkMethodMethodName(array $url, $ctlName) {
		$url['controller']	= !isset($url['controller'])? $ctlName	: $url['controller'];
		$url['action']		= !isset($url['action'])	? 'index'	: $url['action'];
		
		$ctl	= Inflector::camelize($url['controller']);
		$action	= Inflector::camelize($url['action']);
		
		return 'getLink' . $ctl . $action;
	}
	
	private static function getGetLinkMethodComment($label) {
		return $label . ' Link';
	}
	
	private static function getGetLinkMethodLogic($label, $url, $ctlName) {
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
	
	private static function getGetDivNaviLinksMethod(AppCreateCtlConfig $config) {
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
		$logic[] = '		$html->addCrumb(\'<strong>\' . $label . \'</strong>\');';
		$logic[] = '		continue;';
		$logic[] = '	}';
		$logic[] = '	if ($linkFlag) {';
		$logic[] = '		$html->addCrumb($label, $url);';
		$logic[] = '	} else {';
		$logic[] = '		$html->addCrumb($label);';
		$logic[] = '	}';
		$logic[] = '}';
		$logic[] = '';
		$logic[] = 'return $html->getCrumbs(" > ");';
		
		$method = new ClassMethod();
		$method->addMethodComment('Top Navigator');
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName('getDivNaviLinks');
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