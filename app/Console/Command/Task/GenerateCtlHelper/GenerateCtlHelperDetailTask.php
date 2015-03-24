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
class GenerateCtlHelperDetailTask extends AppShell {
	
	const GENERATE_DIR = 'View/Helper/CtlHelper/';
	
	const INDENT = "\t";
	
	public function run(AppDetailCtlConfig $config) {
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
	private static function getGenatratePath(AppDetailCtlConfig $config) {
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
	private static function getGenatrateContents(AppDetailCtlConfig $config) {
		$classType			= 'class';
		$className			= $config->getHelperName();
		$parentClassName	= 'AppCtlHelper';
		
		$importAppCtlHelper		= self::getImportAppCtlHelper();
		$importUrlUtil			= self::getImportUrlUtil();
		$importLibTraitOrmViews	= self::getImportLibTraitOrmViews($config);
		
		$traits					= self::getTraits($config);
		
		$getDivNaviLinksMedhod	= self::getGetDivNaviLinksMedhod($config);
		
		$file = new ClassFile();
		$file->setClassType($classType);
		$file->setClassName($className);
		$file->setParentClassName($parentClassName);
		
		$file->addImport($importAppCtlHelper);
		$file->addImport($importUrlUtil);
		
		foreach ($importLibTraitOrmViews as $importLibTraitOrmView) {
			$file->addImport($importLibTraitOrmView);
		}
		
		foreach ($traits as $trait) {
			$file->addUses($trait);
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
	
	private static function getImportLibTraitOrmViews(AppDetailCtlConfig $config) {
		$traitNames = $config->getTraitNames();
		$path		= 'Lib/Trait/OrmView';
		$method		= Import::METHOD_USES;
		
		foreach ($traitNames as $traitName ) {
			$imports	= new Import($traitName, $path, $method);
		}
		return $imports;
	}
	
	private static function getTraits(AppDetailCtlConfig $config) {
		return $config->getTraitNames();
	}

	private static function getGetDivNaviLinksMedhod(AppDetailCtlConfig $config) {
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