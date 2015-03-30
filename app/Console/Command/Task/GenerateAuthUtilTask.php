<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppShell', 'Console/Command');
App::uses('ClassFile', 'Console/Command/Lib/FileGenerate');
App::uses('ClassMember', 'Console/Command/Lib/FileGenerate');
App::uses('ClassMethod', 'Console/Command/Lib/FileGenerate');

/**
 * Description of GenerateAuthUtilTask
 *
 * @author hanai
 */
class GenerateAuthUtilTask extends AppShell {
	
	const GENERATE_DIR = 'Lib/Util/';
	
	public function run($authModelName) {
		$task		= $this;
		$model		= ClassRegistry::init($authModelName);
		$path		= self::getGenatratePath();
		$contents	= self::getGenatrateContents($model);
		self::generateLibAuthUtilFile($task, $path, $contents);
	}
	
	/**
	 * ファイルパス
	 * @param type $modelName
	 * @return type
	 */
	private static function getGenatratePath() {
		$path = APP . self::GENERATE_DIR . 'AuthUtil.php';
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
	
	private static function getGenatrateContents(AppOrmModel $model) {
		$modelName	= $model->name;
		$classType	= 'class';
		$className	= 'AuthUtil';
		
		$refreshMethod				= self::getRefreshMethod($modelName);
		$getAuthMethods				= self::getGetAuthMethods			($model);
		$getHasOneAuthMethods		= self::getGetHasOneAuthMethods		($model);
		$getBelongsToAuthMethods	= self::getGetBelongsToAuthMethods	($model);
		
		
		$file = new ClassFile();
		$file->setClassType($classType);
		$file->setClassName($className);
		$file->addMethod($refreshMethod);
		
		foreach ($getAuthMethods as $getAuthMethod) {
			$file->addMethod($getAuthMethod);
		}
		foreach ($getHasOneAuthMethods as $getAuthMethod) {
			$file->addMethod($getAuthMethod);
		}
		foreach ($getBelongsToAuthMethods as $getAuthMethod) {
			$file->addMethod($getAuthMethod);
		}
		return $file->getContents();
	}
	
	private static function getRefreshMethod($modelName) {
		$methodName	= 'refresh';
		$access		= 'public static';
		$arrLogic = array(
			'$authrModelNmae	= \'' . $modelName . '\';',
			'$authModel		= ClassRegistry::init($authrModelNmae);',
			'$primaryKey		= $authModel->primaryKey;',
			'$id				= $auth->user($primaryKey);',
			'$data			= $authModel->read(null, $id);',
			'',
			'$tmp1	= $data[$authrModelNmae];',
			'$tmp2	= $data;',
			'unset($tmp2[$authrModelNmae]);',
			'',
			'$authData = am($tmp1, $tmp2);',
			'$auth->login($authData);',
		);
		
		$method = new ClassMethod();
		$method->setMethodName($methodName);
		$method->setAccess($access);
		$method->setLogic($arrLogic);
		$method->addArg('$auth', 'AuthComponent $auth', 'AuthComponent');
		$method->addMethodComment('認証情報の更新');
		
		return $method;
	}
	
	private static function getGetAuthMethods(AppOrmModel $model) {
		$modelName	= $model->name;
		$fields		= array_keys($model->schema());
		
		$methods = array();
		foreach ($fields as $field) {
			$methods[] = self::getGetAuthMethod($modelName, $field, false);
		}
		return $methods;
	}
	
	private static function getGetHasOneAuthMethods(AppOrmModel $model) {
		$hasOneModelNames = array_keys($model->hasOne);
		
		$methods = array();
		foreach ($hasOneModelNames as $hasOneModelName) {
			$hasOneModel	= $model->{$hasOneModelName};
			$modelName		= $hasOneModel->name;
			$fields			= array_keys($hasOneModel->schema());
			
			foreach ($fields as $field) {
				$methods[] = self::getGetAuthMethod($modelName, $field, true);
			}
		}
		return $methods;
	}
	
	private static function getGetBelongsToAuthMethods(AppOrmModel $model) {
		$belongsToModelNames = array_keys($model->belongsTo);
		
		$methods = array();
		foreach ($belongsToModelNames as $belongsToModelName) {
			$belongsToModel	= $model->{$belongsToModelName};
			$modelName		= $belongsToModel->name;
			$fields			= array_keys($belongsToModel->schema());
			
			foreach ($fields as $field) {
				$methods[] = self::getGetAuthMethod($modelName, $field, true);
			}
		}
		return $methods;
	}

	
	private static function getGetAuthMethod($modelName, $field, $relationFlag = false) {
		$methodName = 'get' . $modelName . Inflector::camelize($field);
		$access		= 'public static';
		$fieldName	= $relationFlag? $modelName . '.' . $field: $field;
		
		$arrLogic	= array(
			'return $auth->user(\'' . $fieldName . '\');',
		);

		$method = new ClassMethod();
		$method->setMethodName($methodName);
		$method->setAccess($access);
		$method->setLogic($arrLogic);
		$method->addArg('$auth', 'AuthComponent $auth', 'AuthComponent');

		return $method;
	}
	
	/**
	 * ファイルを作成
	 * @param self $task
	 * @param type $path
	 * @param type $contents
	 * @throws RuntimeException
	 */
	private static function generateLibAuthUtilFile(self $task, $path, $contents) {
		$result = $task->createFile($path, $contents);
		if (!$result) {
			throw new RuntimeException('File Generate Error [File:' . $path . ']');
		}
	}
}