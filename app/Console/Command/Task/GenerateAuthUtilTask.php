<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppShell', 'Console/Command');
App::uses('ClassFile', 'Console/Command/Lib/FileGenerate');
App::uses('ClassMember', 'Console/Command/Lib/FileGenerate');
App::uses('ClassMedhod', 'Console/Command/Lib/FileGenerate');

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
		
		$refreshMedhod				= self::getRefreshMedhod($modelName);
		$getAuthMedhods				= self::getGetAuthMedhods			($model);
		$getHasOneAuthMedhods		= self::getGetHasOneAuthMedhods		($model);
		$getBelongsToAuthMedhods	= self::getGetBelongsToAuthMedhods	($model);
		
		
		$file = new ClassFile();
		$file->setClassType($classType);
		$file->setClassName($className);
		$file->addMedhod($refreshMedhod);
		
		foreach ($getAuthMedhods as $getAuthMedhod) {
			$file->addMedhod($getAuthMedhod);
		}
		foreach ($getHasOneAuthMedhods as $getAuthMedhod) {
			$file->addMedhod($getAuthMedhod);
		}
		foreach ($getBelongsToAuthMedhods as $getAuthMedhod) {
			$file->addMedhod($getAuthMedhod);
		}
		return $file->getContents();
	}
	
	private static function getRefreshMedhod($modelName) {
		$medhodName	= 'refresh';
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
		
		$medhod = new ClassMedhod();
		$medhod->setMedhodName($medhodName);
		$medhod->setAccess($access);
		$medhod->setLogic($arrLogic);
		$medhod->addArg('$auth', 'AuthComponent $auth', 'AuthComponent');
		$medhod->addMedhodComment('認証情報の更新');
		
		return $medhod;
	}
	
	private static function getGetAuthMedhods(AppOrmModel $model) {
		$modelName	= $model->name;
		$fields		= array_keys($model->schema());
		
		$medhods = array();
		foreach ($fields as $field) {
			$medhods[] = self::getGetAuthMedhod($modelName, $field, false);
		}
		return $medhods;
	}
	
	private static function getGetHasOneAuthMedhods(AppOrmModel $model) {
		$hasOneModelNames = array_keys($model->hasOne);
		
		$medhods = array();
		foreach ($hasOneModelNames as $hasOneModelName) {
			$hasOneModel	= $model->{$hasOneModelName};
			$modelName		= $hasOneModel->name;
			$fields			= array_keys($hasOneModel->schema());
			
			foreach ($fields as $field) {
				$medhods[] = self::getGetAuthMedhod($modelName, $field, true);
			}
		}
		return $medhods;
	}
	
	private static function getGetBelongsToAuthMedhods(AppOrmModel $model) {
		$belongsToModelNames = array_keys($model->belongsTo);
		
		$medhods = array();
		foreach ($belongsToModelNames as $belongsToModelName) {
			$belongsToModel	= $model->{$belongsToModelName};
			$modelName		= $belongsToModel->name;
			$fields			= array_keys($belongsToModel->schema());
			
			foreach ($fields as $field) {
				$medhods[] = self::getGetAuthMedhod($modelName, $field, true);
			}
		}
		return $medhods;
	}

	
	private static function getGetAuthMedhod($modelName, $field, $relationFlag = false) {
		$medhodName = 'get' . $modelName . Inflector::camelize($field);
		$access		= 'public static';
		$fieldName	= $relationFlag? $modelName . '.' . $field: $field;
		
		$arrLogic	= array(
			'return $auth->user(\'' . $fieldName . '\');',
		);

		$medhod = new ClassMedhod();
		$medhod->setMedhodName($medhodName);
		$medhod->setAccess($access);
		$medhod->setLogic($arrLogic);
		$medhod->addArg('$auth', 'AuthComponent $auth', 'AuthComponent');

		return $medhod;
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