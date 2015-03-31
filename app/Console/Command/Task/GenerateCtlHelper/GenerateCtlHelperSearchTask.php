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
 * Description of GenerateCtlHelperSearchTask
 *
 * @author hanai
 */
class GenerateCtlHelperSearchTask extends AppShell {
	
	const GENERATE_DIR = 'View/Helper/CtlHelper/';
	
	const INDENT = "\t";
	
	public function run(AppSearchCtlConfig $config) {
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
	private static function getGenatratePath(AppSearchCtlConfig $config) {
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
	private static function getGenatrateContents(AppSearchCtlConfig $config) {
		$classType			= 'class';
		$className			= $config->getHelperName();
		$parentClassName	= 'AppCtlHelper';
		// インポート
		$importAppCtlHelper		= self::getImportAppCtlHelper();
		$importUrlUtil			= self::getImportUrlUtil();
		// メンバ
		$dataPaginateMember		= self::getDataPaginateMember();
		
		$setDataPaginateMethod			= self::getSetDataPaginateMethod		();
		$getDataPaginateCountMethod		= self::getGetDataPaginateCountMethod	();
		
		$getPaginatorLinkMethods		= self::getGetPaginatorLinkMethods	($config);
		$getPaginatorTextMethods		= self::getGetPaginatorTextMethods	($config);
		$getPaginatorSortMethods		= self::getGetPaginatorSortMethods	($config);
		
		$getPaginatorCounterMethod		= self::getGetPaginatorCounterMethod	();
		$getPaginatorLinksMethod		= self::getGetPaginatorLinksMethod		();
		$getPaginatorLinkPrevMethod		= self::getGetPaginatorLinkPrevMethod	();
		$getPaginatorLinkNumbersMethod	= self::getGetPaginatorLinkNumbersMethod();
		$getPaginatorLinkNextMethod		= self::getGetPaginatorLinkNextMethod	();
		
		$getFormStartMethod				= self::getGetFormStartMethod	();
		$getFormEndMethod				= self::getGetFormEndMethod		();
		$getSubmitSearchMethod			= self::getGetSubmitSearchMethod($config);
		
		$getLabelMethods				= self::getGetLabelMethods($config);
		$getInputMethods				= self::getGetInputMethods($config);
		
		$getLinkMethods					= self::getGetLinkMethods($config);
		
		$getDivNaviLinksMethod			= self::getGetDivNaviLinksMethod($config);
		
		$file = new ClassFile();
		$file->setClassType($classType);
		$file->setClassName($className);
		$file->setParentClassName($parentClassName);
		
		$file->addImport($importAppCtlHelper);
		$file->addImport($importUrlUtil);
		
		$file->addMember($dataPaginateMember);
		
		$file->addMethod($setDataPaginateMethod);
		$file->addMethod($getDataPaginateCountMethod);
		
		foreach ($getPaginatorLinkMethods as $getPaginatorLinkMethod) {
			$file->addMethod($getPaginatorLinkMethod);
		}
		
		foreach ($getPaginatorTextMethods as $getPaginatorTextMethod) {
			$file->addMethod($getPaginatorTextMethod);
		}
		
		foreach ($getPaginatorSortMethods as $getPaginatorSortMethod) {
			$file->addMethod($getPaginatorSortMethod);
		}
		
		$file->addMethod($getPaginatorCounterMethod);
		$file->addMethod($getPaginatorLinksMethod);
		$file->addMethod($getPaginatorLinkPrevMethod);
		$file->addMethod($getPaginatorLinkNumbersMethod);
		$file->addMethod($getPaginatorLinkNextMethod);
		
		$file->addMethod($getFormStartMethod);
		$file->addMethod($getFormEndMethod);
		$file->addMethod($getSubmitSearchMethod);
		
		foreach ($getLabelMethods as $getLabelMethod) {
			$file->addMethod($getLabelMethod);
		}
		
		foreach ($getInputMethods as $getInputMethod) {
			$file->addMethod($getInputMethod);
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
	
	private static function getDataPaginateMember() {
		$name		= 'dataPaginate';
		$access		= 'public';
		$value		= 'array()';
		$comment	= '';
		$type		= 'array';
		
		return new ClassMember($name, $access, $value, $comment, $type);
	}

	private static function getSetDataPaginateMethod() {
		$comment	= 'Paginate Data Setting';
		$methodName	= 'setDataPaginate';
		$logic = array(
			'$this->dataPaginate = $dataPaginate;',
		);
		
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName($methodName);
		$method->addArg('$dataPaginate', 'array $dataPaginate', 'array');
		$method->setLogic($logic);
		
		return $method;
	}

	private static function getGetDataPaginateCountMethod() {
		$comment	= 'Paginate Data Count';
		$methodName	= 'getDataPaginateCount';
		$logic = array(
			'return count($this->dataPaginate);',
		);
		
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName($methodName);
		$method->setLogic($logic);
		
		return $method;
	}
	
	private static function getGetPaginatorLinkMethods(AppSearchCtlConfig $config) {
		$paginatorLinks		= $config->getPaginatorLinks();
		$ctlName			= $config->getCtlName();
		$paginateModel		= $config->getPaginateModel();
		
		$results = array();
		foreach ($paginatorLinks as $paginatorLink) {
			$paginatorLink['label']		= isset($paginatorLink['label'])? $paginatorLink['label']: '';
			$paginatorLink['type']		= isset($paginatorLink['type'])? $paginatorLink['type']: '';
			$paginatorLink['ctl']		= isset($paginatorLink['ctl'])? $paginatorLink['ctl']: '';
			$paginatorLink['action']	= isset($paginatorLink['action'])? $paginatorLink['action']: '';
			
			$paginatorLink['type']		= ($paginatorLink['type'] === 'post')? $paginatorLink['type']: 'get';
			$paginatorLink['ctl']		= !empty($paginatorLink['ctl'])? $paginatorLink['ctl']: $ctlName;
			$paginatorLink['action']	= !empty($paginatorLink['action'])? $paginatorLink['action']: 'index';
			
			$lable	= $paginatorLink['label'];
			$ctl	= $paginatorLink['ctl'];
			$action	= $paginatorLink['action'];
			
			$comment	= Inflector::humanize($lable) . 'Link';
			$methodName = 'getLink' . Inflector::camelize($ctl) . Inflector::camelize($action);
			
			$logic = self::getPaginatorLinkLogic($paginatorLink, $paginateModel);
			
			$method = new ClassMethod();
			$method->addMethodComment($comment);
			$method->addMethodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMethodName($methodName);
			$method->addArg('$index = 0', 'int $index');
			$method->setLogic($logic);
			
			$results[] = $method;
		}
		
		return $results;
	}
	
	private static function getPaginatorLinkLogic(array $paginatorLink, AppModel $paginateModel) {
		$lable	= $paginatorLink['label'];
		$type	= $paginatorLink['type'];
		$ctl	= $paginatorLink['ctl'];
		$action	= $paginatorLink['action'];

		switch ($type) {
			case 'get':
				return self::getPaginatorLinkLogicGet($lable, $ctl, $action, $paginateModel);
			case 'post':
				return self::getPaginatorLinkLogicPost($lable, $ctl, $action, $paginateModel);
			default :
				throw new RuntimeException('Paginator Link Logic Type Error [' . $type . ']');
		}
	}
	
	
	private static function getPaginatorLinkLogicGet($lable, $ctlName, $actionName, AppModel $paginateModel) {
		$alias			= $paginateModel->alias;
		$primaryKey		= $paginateModel->primaryKey;
		
		$camelizeCtlName	= Inflector::camelize($ctlName);
		$camelizeActionName	= Inflector::camelize($actionName);
		
		return array(
			'$html		= $this->Html;',
			'$data		= $this->dataPaginate[$index];',
			'$alias		= \'' . $alias . '\';',
			'$fieldId	= \'' . $primaryKey . '\';',
			'',
			'$id			= $data[$alias][$fieldId];',
			'',
			'$title		= __(\'' . $lable . '\');',
			'$url		= UrlUtil::get' . $camelizeCtlName . $camelizeActionName . '($id);',
			'$options	= array();',
			'',
			'return $html->link($title, $url, $options);',
		);
	}

	private static function getPaginatorLinkLogicPost($lable, $ctlName, $actionName, AppModel $paginateModel) {
		$alias			= $paginateModel->alias;
		$primaryKey		= $paginateModel->primaryKey;
		$displayField	= $paginateModel->displayField;
		
		$camelizeCtlName	= Inflector::camelize($ctlName);
		$camelizeActionName	= Inflector::camelize($actionName);
		
		return array(
			'$form		= $this->ExtForm;',
			'$data		= $this->dataPaginate[$index];',
			'$alias		= \'' . $alias . '\';',
			'$fieldId	= \'' . $primaryKey . '\';',
			'$fieldName	= \'' . $displayField . '\';',
			'',
			'$id			= $data[$alias][$fieldId];',
			'$name		= $data[$alias][$fieldName];',
			'',
			'$title		= __(\'' . $lable . '\');',
			'$url		= UrlUtil::get' . $camelizeCtlName . $camelizeActionName . '($id);',
			'$options	= array();',
			'// TODO ',
			'$confirmMessage = sprintf(__(\'TODO： Please create a message ID: [%1$s] Name: [%2$s]\'), $id, $name);',
			'',
			'return $form->postLink($title, $url, $options, $confirmMessage);',
		);
	}

	
	private static function getGetPaginatorTextMethods(AppSearchCtlConfig $config) {
		$ormModel		= $config->getPaginateModel();
		$hasOneKeys		= array_keys($ormModel->hasOne);
		$belongsToKeys	= array_keys($ormModel->belongsTo);
		
		$tmp1 = self::_getGetPaginatorTextMethods($ormModel);
		
		$tmp2 = array();
		foreach ($hasOneKeys as $hasOneKey) {
			$hasOneModel = $ormModel->{$hasOneKey};
			$tmp2 = am($tmp2, self::_getGetPaginatorTextMethods($hasOneModel));
		}
		
		$tmp3 = array();
		foreach ($belongsToKeys as $belongsToKey) {
			$belongsToModel = $ormModel->{$belongsToKey};
			$tmp3 = am($tmp3, self::_getGetPaginatorTextMethods($belongsToModel));
		}
		
		return am($tmp1, $tmp2, $tmp3);
	}
	
	private static function _getGetPaginatorTextMethods(AppModel $ormModel) {
		$alias			= $ormModel->alias;
		$columnTypes	= $ormModel->getColumnTypes();
		
		$results = array();
		$camelizeAlias = Inflector::camelize($alias);
		foreach ($columnTypes as $columnName => $columnType) {
			$camelizeColumnName = Inflector::camelize($columnName);
			
			$comment	= 'Paginator Text (' . $alias . ' ' . $columnName . ')';
			$methodName	= 'getText' . $camelizeAlias . $camelizeColumnName;
			
			$logic = array();
			$logic[] = '$data	= $this->dataPaginate[$index];';
			$logic[] = '$alias	= \'TblMember\';';
			$logic[] = '$field	= \'tbl_group_count\';';
			$logic[] = '';
			
			if ($columnType === 'text') {
				$logic[] = 'return nl2br(h($data[$alias][$field]));';
			} else {
				$logic[] = 'return h($data[$alias][$field]);';
			}
			
			$method = new ClassMethod();
			$method->addMethodComment($comment);
			$method->addMethodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMethodName($methodName);
			$method->addArg('$index = 0', 'int $index');
			$method->setLogic($logic);
			
			$results[] = $method;
		}
		
		return $results;
	}

	private static function getGetPaginatorSortMethods(AppSearchCtlConfig $config) {
		$ormModel		= $config->getPaginateModel();
		$hasOneKeys		= array_keys($ormModel->hasOne);
		$belongsToKeys	= array_keys($ormModel->belongsTo);
		
		$tmp1 = self::_getGetPaginatorSortMethods($ormModel);
		
		$tmp2 = array();
		foreach ($hasOneKeys as $hasOneKey) {
			$hasOneModel = $ormModel->{$hasOneKey};
			$tmp2 = am($tmp2, self::_getGetPaginatorSortMethods($hasOneModel));
		}
		
		$tmp3 = array();
		foreach ($belongsToKeys as $belongsToKey) {
			$belongsToModel = $ormModel->{$belongsToKey};
			$tmp3 = am($tmp3, self::_getGetPaginatorSortMethods($belongsToModel));
		}
		
		return am($tmp1, $tmp2, $tmp3);
	}
	
	private static function _getGetPaginatorSortMethods(AppModel $ormModel) {
		$alias			= $ormModel->alias;
		$tmp1			= $ormModel->getColumnTypes();
		$columnNames	= array_keys($tmp1);
		
		$results = array();
		$camelizeAlias = Inflector::camelize($alias);
		$humanizeAlias = Inflector::humanize($alias);
		
		foreach ($columnNames as $columnName) {
			$camelizeColumnName = Inflector::camelize($columnName);
			$humanizeColumnName = Inflector::humanize($columnName);
			
			$comment	= 'Paginator Sort Link (' . $humanizeAlias . ' ' . $humanizeColumnName . ')';
			$methodName	= 'getSort' . $camelizeAlias . $camelizeColumnName;
			$logic = array(
				'$paginator	= $this->Paginator;',
				'$key		= \'' . $alias . '.' . $columnName . '\';',
				'$title		= __(\'' . $humanizeColumnName . '\');',
				'$options	= array();',
				'',
				'return $paginator->sort($key, $title, $options);',
			);
			
			$method = new ClassMethod();
			$method->addMethodComment($comment);
			$method->addMethodComment('');
			$method->setReturnComment('string');
			$method->setAccess('public');
			$method->setMethodName($methodName);
			$method->setLogic($logic);
			
			$results[] = $method;
		}
		
		return $results;
	}
	
	private static function getGetPaginatorCounterMethod() {
		$comment = 'Page / Data Counter';
		$logic = array(
			'$paginator	= $this->Paginator;',
			'$options = array(',
			'	\'format\' => __(\'{:page}/{:pages} Page {:start}-{:end} Items Show (All {:count} Items)\'),',
			');',
			'',
			'return $paginator->counter($options);',
		);
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName('getPaginatorCounter');
		$method->setLogic($logic);

		return $method;
	}
	
	private static function getGetPaginatorLinksMethod() {
		$comment = 'Prev & Page Numbers & Next Links';
		$logic = array(
			'$paginator	= $this->Paginator;',
			'',
			'$result = array(',
			'	self::getPaginatorLinkPrev		($paginator),',
			'	self::getPaginatorLinkNumbers	($paginator),',
			'	self::getPaginatorLinkNext		($paginator),',
			');',
			'',
			'return join("", $result);',
		);
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('public');
		$method->setMethodName('getPaginatorLinks');
		$method->setLogic($logic);

		return $method;
	}

	private static function getGetPaginatorLinkPrevMethod() {
		$comment = 'Prev Page Link';
		$logic = array(
			'$title				= \'< \' . __(\'Prev\');',
			'$options			= array();',
			'$disabledTitle		= null;',
			'$disabledOptions	= array(',
			'	\'class\' => \'next disabled\'',
			');',
			'',
			'return $paginator->next($title, $options, $disabledTitle, $disabledOptions);',
		);
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('private static');
		$method->setMethodName('getPaginatorLinkPrev');
		$method->addArg('$paginator', 'PaginatorHelper', 'PaginatorHelper');
		$method->setLogic($logic);

		return $method;
	}

	private static function getGetPaginatorLinkNumbersMethod() {
		$comment = 'Page No Links';
		$logic = array(
			'$options = array(',
			'	\'separator\' => \'\',',
			');',
			'',
			'return $paginator->numbers($options);',
		);
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('private static');
		$method->setMethodName('getPaginatorLinkNumbers');
		$method->addArg('$paginator', 'PaginatorHelper', 'PaginatorHelper');
		$method->setLogic($logic);

		return $method;
	}
	
	private static function getGetPaginatorLinkNextMethod() {
		$comment = 'Next Page Link';
		$logic = array(
			'$title				= __(\'Next\') . \' >\';',
			'$options			= array();',
			'$disabledTitle		= null;',
			'$disabledOptions	= array(',
			'	\'class\' => \'next disabled\'',
			');',
			'',
			'return $paginator->next($title, $options, $disabledTitle, $disabledOptions);',
		);
		$method = new ClassMethod();
		$method->addMethodComment($comment);
		$method->addMethodComment('');
		$method->setReturnComment('string');
		$method->setAccess('private static');
		$method->setMethodName('getPaginatorLinkNext');
		$method->addArg('$paginator', 'PaginatorHelper', 'PaginatorHelper');
		$method->setLogic($logic);

		return $method;
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
	
	private static function getGetSubmitSearchMethod(AppSearchCtlConfig $config) {
		$label		= $config->getSubmitLables('search');
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
	
	private static function getGetLabelMethods(AppSearchCtlConfig $config) {
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
	
	private static function getGetInputMethods(AppSearchCtlConfig $config) {
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
	
	private static function getGetLinkMethods(AppSearchCtlConfig $config) {
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

	private static function getGetDivNaviLinksMethod(AppSearchCtlConfig $config) {
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
			return $value . ',';
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