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
 * Description of GenerateLibTraitOrmViewTask
 *
 * @author hanai
 */
class GenerateLibTraitOrmViewsTask extends AppShell {
	
	const GENERATE_DIR = 'Lib/Trait/OrmView/';
	
	public function run($modelName) {
		$task		= $this;
		$model		= ClassRegistry::init($modelName);
		$path		= self::getGenatratePath($modelName);
		$contents	= self::getGenatrateContents($model);
		self::generateLibTraitOrmViewFile($task, $path, $contents);
	}
	
	/**
	 * ファイルパス
	 * @param type $modelName
	 * @return type
	 */
	private static function getGenatratePath($modelName) {
		$path = APP . self::GENERATE_DIR . $modelName . 'Views.php';
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
		$classType	= 'trait';
		$className	= $modelName . 'Views';
		$member		= new ClassMember('data' . $modelName , 'private', 'array()', $modelName, 'array<' . $modelName . '::$data>');
		
		$setDataMedhod			= self::getSetDataMedhod	($model);
		$virtualFieldsMedhods	= self::getVirtualFields	($model);
		$schemaMedhods			= self::getSchemaMethods	($model);
		$hasOneMedhods			= self::getHasOneMethods	($model);
		$belongsToMedhods		= self::getBelongsToMethods	($model);
		$hasManyMedhods			= self::getHasManyMethods	($model);
		$habtmMedhods			= self::getHabtmMethods		($model);
		
		$file = new ClassFile();
		$file->setClassType($classType);
		$file->setClassName($className);
		$file->addMember($member);
		$file->addMedhod($setDataMedhod);
		
		foreach ($virtualFieldsMedhods as $medhod) {
			$file->addMedhod($medhod);
		}
		foreach ($schemaMedhods as $medhod) {
			$file->addMedhod($medhod);
		}
		foreach ($hasOneMedhods as $medhod) {
			$file->addMedhod($medhod);
		}
		foreach ($belongsToMedhods as $medhod) {
			$file->addMedhod($medhod);
		}
		foreach ($hasManyMedhods as $medhod) {
			$file->addMedhod($medhod);
		}
		foreach ($habtmMedhods as $medhod) {
			$file->addMedhod($medhod);
		}
		return $file->getContents();
	}
	
	private static function getSetDataMedhod(AppOrmModel $model) {
		$modelName = $model->name;
		
		$medhodName	= 'setData' . $modelName;
		$access		= 'public';
		$arg		= '$data' . $modelName;
		$arrLogic	= array(
			'$this->data' . $modelName . ' = ' . $arg . ';'
		);
		$medhodComment	= $modelName . '::$data';
		$memo1			= "if (!isset(" . $arg . "))	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);";
		$memo2			= '$ctlHelper->' . $medhodName . '(' . $arg . ');';
		$medhod = new ClassMedhod();
		$medhod->setMedhodName($medhodName);
		$medhod->setAccess($access);
		$medhod->setLogic($arrLogic);
		$medhod->addArg($arg, 'array ' . $arg , 'array');
		$medhod->addMedhodComment($medhodComment);
		$medhod->addMedhodComment($memo1);
		$medhod->addMedhodComment($memo2);
		
		return $medhod;
	}

	/**
	 * バーチャルフィールドのメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMedhod>
	 */
	private static function getVirtualFields(AppOrmModel $model) {
		$result		= array();
		$modelName	= $model->name;
		$fieldNames	= array_keys($model->virtualFields);
		
		foreach ($fieldNames as $fieldName) {
			$cameFieldName	= Inflector::camelize($fieldName);
			$medhodName		= 'getText' . $modelName . $cameFieldName;
			$access			= 'public';
			$arrLogic		= self::getLogicString($modelName, $modelName, $fieldName);
			$medhodComment	= $modelName . '::virtualFields[' . $fieldName . ']';
			$memo1			= '$text' . $modelName . $cameFieldName . '	= $ctlHelper->' . $medhodName . '	($i);';
			$memo2			= '<?php echo $text' . $modelName . $cameFieldName . '	; ?>';
			$returnComment	= 'string';
					
			$medhod = new ClassMedhod();
			$medhod->setMedhodName($medhodName);
			$medhod->setAccess($access);
			$medhod->setLogic($arrLogic);
			$medhod->addMedhodComment($medhodComment);
			$medhod->addMedhodComment($memo1);
			$medhod->addMedhodComment($memo2);
			$medhod->setReturnComment($returnComment);
			$medhod->addArg('$cnt = 0', 'int $cnt');
			
			$result[] = $medhod;
		}
		return $result;
	}
	
	/**
	 * スキーマ情報のメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMedhod>
	 */
	private static function getSchemaMethods(AppOrmModel $model) {
		$result		= array();
		$schema		= $model->schema();
		$modelName	= $model->name;
		
		foreach ($schema as $fieldName => $params) {
			$type		= $params['type'];
			$comment	= $params['comment'];
			$result[] = self::getSchemaMethod($modelName, $fieldName, $type, $comment);
		}
		return $result;
	}
	
	/**
	 * スキーマ情報のメソッド
	 * @param type $name
	 * @param type $type
	 * @param type $null
	 * @param type $comment
	 * @return \ClassMedhod
	 */
	private static function getSchemaMethod($modelName, $fieldName, $type, $comment, $prefix = '', $pluralityFlag = false) {
		$access			= 'public';
		$cameFieldName	= Inflector::camelize($fieldName);
		$medhodName		= 'getText' . $prefix . $modelName . $cameFieldName;
		if ($pluralityFlag) {
			$memo1	= '$text' . $prefix . $modelName . $cameFieldName . '	= $ctlHelper->' . $medhodName . '	($i, $j);';
		} else {
			$memo1	= '$text' . $prefix . $modelName . $cameFieldName . '	= $ctlHelper->' . $medhodName . '	($i);';
		}
		$memo2			= '<?php echo $text' . $prefix . $modelName . $cameFieldName . '	; ?>';
		$returnComment	= 'string';
		$rootModelName	= $prefix === ''? $modelName: $prefix;
		
		$medhod = new ClassMedhod();
		$medhod->setMedhodName($medhodName);
		$medhod->setAccess($access);
		$medhod->addArg('$cnt1 = 0', 'int $cnt1');
		if ($pluralityFlag) {
			$medhod->addArg('$cnt2 = 0', 'int $cnt2');
		}
		switch ($type) {
			case 'text':
				$arrLogic = self::getLogicText($rootModelName, $modelName, $fieldName, $pluralityFlag);
				$medhod->setLogic($arrLogic);
				break;
			case 'boolean':
				$arrLogic = self::getLogicBoolean($rootModelName, $modelName, $fieldName, $pluralityFlag);
				$medhod->setLogic($arrLogic);
				$medhod->addArg('$true = \'可\'', 'string $true');
				$medhod->addArg('$false = \'不可\'', 'string $false');
				break;
			case 'float':
			case 'integer':
				$arrLogic = self::getLogicInteger($rootModelName, $modelName, $fieldName, $pluralityFlag);
				$medhod->setLogic($arrLogic);
				break;
			case 'string':
			default :
				$arrLogic = self::getLogicString($rootModelName, $modelName, $fieldName, $pluralityFlag);
				$medhod->setLogic($arrLogic);
				break;
		}
		$medhod->addMedhodComment($comment);
		$medhod->addMedhodComment($memo1);
		$medhod->addMedhodComment($memo2);
		$medhod->setReturnComment($returnComment);
		
		return $medhod;
	}

	/**
	 * HasOneアソシエーションのメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMedhod>
	 */
	private static function getHasOneMethods(AppOrmModel $model) {
		$result		= array();
		$prefix		= $model->name;
		$aliases	= array_keys($model->hasOne);
		
		foreach ($aliases as $alias) {
			$schema	= $model->{$alias}->schema();
			foreach ($schema as $fieldName => $params) {
				$type		= $params['type'];
				$comment	= $params['comment'] . '(hasOne ' . $alias . '.' . $fieldName . ')';
				$result[]	= self::getSchemaMethod($alias, $fieldName, $type, $comment, $prefix);
			}
		}
		return $result;
	}
	
	/**
	 * BelongsToアソシエーションのメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMedhod>
	 */
	private static function getBelongsToMethods(AppOrmModel $model) {
		$result		= array();
		$prefix		= $model->name;
		$aliases	= array_keys($model->belongsTo);
		
		foreach ($aliases as $alias) {
			$schema	= $model->{$alias}->schema();
			foreach ($schema as $fieldName => $params) {
				$type		= $params['type'];
				$comment	= $params['comment'] . '(belongsTo ' . $alias . '.' . $fieldName . ')';
				$result[]	= self::getSchemaMethod($alias, $fieldName, $type, $comment, $prefix);
			}
		}
		return $result;
	}
	
	/**
	 * HasManyアソシエーションのメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMedhod>
	 */
	private static function getHasManyMethods(AppOrmModel $model) {
		$result		= array();
		$prefix		= $model->name;
		$aliases	= array_keys($model->hasMany);
		
		foreach ($aliases as $alias) {
			$commentCnt	= 'hasManyデータカウント（' . $alias . '）';
			$result[]	= self::getDataCountMethod($alias, $prefix, $commentCnt);
			
			$displayField	= $model->{$alias}->displayField;
			$commentDis		= 'hasMany Displays (' . $alias . '）';
			$result[]		= self::getDisplayFieldsMethod($alias, $displayField, $prefix, $commentDis);
			
			$schema		= $model->{$alias}->schema();
			foreach ($schema as $fieldName => $params) {
				$type		= $params['type'];
				$comment	= $params['comment'] . '(hasMany {n}.' . $alias . '.{n}.' . $fieldName . ')';
				$result[]	= self::getSchemaMethod($alias, $fieldName, $type, $comment, $prefix, true);
			}
		}
		return $result;
	}
	
	/**
	 * HasAndBelongsToManyアソシエーションのメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMedhod>
	 */
	private static function getHabtmMethods(AppOrmModel $model) {
		$result		= array();
		$prefix		= $model->name;
		$aliases	= array_keys($model->hasAndBelongsToMany);
		
		foreach ($aliases as $alias) {
			$comment	= 'hasAndBelongsToManyデータカウント（' . $alias . '）';
			$result[]	= self::getDataCountMethod($alias, $prefix, $comment);
			
			$displayField	= $model->{$alias}->displayField;
			$commentDis		= 'hasAndBelongsToMany Displays (' . $alias . '）';
			$result[]		= self::getDisplayFieldsMethod($alias, $displayField, $prefix, $commentDis);
			
			$schema		= $model->{$alias}->schema();
			foreach ($schema as $fieldName => $params) {
				$type		= $params['type'];
				$comment	= $params['comment'] . '(hasAndBelongsToMany {n}.' . $alias . '.{n}.' . $fieldName . ')';
				$result[]	= self::getSchemaMethod($alias, $fieldName, $type, $comment, $prefix, true);
			}
		}
		return $result;
	}
	
	/**
	 * データ数取得メソッド
	 * @param type $alias
	 * @param type $modelName
	 * @param type $medhodComment
	 * @return \ClassMedhod
	 */
	private static function getDataCountMethod($alias, $modelName, $medhodComment) {
		$medhodName	= 'getData' . $modelName . $alias . 'Count';
		$access		= 'public';
		$arrLogic	= array(
			'if (isset($this->data' . $modelName . '[$cnt][\''. $alias . '\'])) {',
			'	return count($this->data' . $modelName . '[$cnt][\''. $alias . '\']);',
			'} else {',
			'	return 0;',
			'}',
		);
		$memo1			= '$cnt = $ctlHelper->' . $medhodName . '();';
		$returnComment	= 'int';
		
		$medhod = new ClassMedhod();
		$medhod->setMedhodName($medhodName);
		$medhod->setAccess($access);
		$medhod->addArg('$cnt', 'int $snt1');
		$medhod->setLogic($arrLogic);
		$medhod->addMedhodComment($medhodComment);
		$medhod->addMedhodComment($memo1);
		$medhod->setReturnComment($returnComment);
		return $medhod;
	}
	
	
	/**
	 * 複数項目の一覧表示
	 * @param type $alias
	 * @param type $displayField
	 * @param type $modelName
	 * @param type $medhodComment
	 * @return \ClassMedhod
	 */
	private static function getDisplayFieldsMethod($alias, $displayField, $modelName, $medhodComment) {
		$medhodName	= 'getText' . $modelName . $alias . 'Display';
		$access		= 'public';
		$arg		= '$display = \'' . $displayField . '\'';
		$arrLogic	= array(
			'$data	= $this->data' . $modelName . '[$cnt1];',
			'$path	= \'' . $alias . '.{n}.\' . $display;',
			'$tmp	= Hash::extract($data, $path);',
			'',
			'return join(",\n", $tmp);',
		);
		$memo1			= '$text' . $modelName . $alias . 'Display = $ctlHelper->' . $medhodName . '($i);';
		$memo2			= '<?php $text' . $modelName . $alias . 'Display; ?>';
		$returnComment	= 'string';
		
		$medhod = new ClassMedhod();
		$medhod->setMedhodName($medhodName);
		$medhod->setAccess($access);
		$medhod->setLogic($arrLogic);
		$medhod->addArg('$cnt1', 'int $cnt1');
		$medhod->addArg($arg, 'string $display');
		$medhod->addMedhodComment($medhodComment);
		$medhod->addMedhodComment($memo1);
		$medhod->addMedhodComment($memo2);
		$medhod->setReturnComment($returnComment);
		return $medhod;
	}
	
	/**
	 * １行文字列の出力ロジック
	 * @param type $modelName
	 * @param type $fieldName
	 * @return string
	 */
	private static function getLogicString($modelName, $alais, $fieldName, $pluralityFlag = false) {
		$result = array();
		$result[] = '$data	= $this->data' . $modelName . '[$cnt1];';
		$result[] = '$alias	= \'' . $alais . '\';';
		$result[] = '$field	= \'' . $fieldName . '\';';
		if ($pluralityFlag) {
			$result[] = '$path	= $alias . \'.\' . $cnt2 . \'.\' . $field;';
		} else {
			$result[] = '$path	= $alias . \'.\' . $field;';
		}
		$result[] = '$value	= Hash::get($data, $path);';
		$result[] = '';
		$result[] = 'return h($value);';
		
		return $result;
	}
	
	/**
	 * １行文字列の出力ロジック
	 * @param type $modelName
	 * @param type $fieldName
	 * @return string
	 */
	private static function getLogicText($modelName, $alais, $fieldName, $pluralityFlag = false) {
		$result = array();
		$result[] = '$data	= $this->data' . $modelName . '[$cnt1];';
		$result[] = '$alias	= \'' . $alais . '\';';
		$result[] = '$field	= \'' . $fieldName . '\';';
		if ($pluralityFlag) {
			$result[] = '$path	= $alias . \'.\' . $cnt2 . \'.\' . $field;';
		} else {
			$result[] = '$path	= $alias . \'.\' . $field;';
		}
		$result[] = '$value	= Hash::get($data, $path);';
		$result[] = '';
		$result[] = 'return nl2br(h($value));';
		
		return $result;
	}
	
	/**
	 * 数字の出力ロジック
	 * @param type $modelName
	 * @param type $fieldName
	 * @return string
	 */
	private static function getLogicInteger($modelName, $alais, $fieldName, $pluralityFlag = false) {
		$result = array();
		$result[] = '$data	= $this->data' . $modelName . '[$cnt1];';
		$result[] = '$alias	= \'' . $alais . '\';';
		$result[] = '$field	= \'' . $fieldName . '\';';
		if ($pluralityFlag) {
			$result[] = '$path	= $alias . \'.\' . $cnt2 . \'.\' . $field;';
		} else {
			$result[] = '$path	= $alias . \'.\' . $field;';
		}
		$result[] = '$tmp	= Hash::get($data, $path);';
		$result[] = '$value	= number_format((int) $tmp);';
		$result[] = '';
		$result[] = 'return h($value);';
		
		return $result;
	}
	
	/**
	 * ブーリアン出力ロジック
	 * @param type $modelName
	 * @param type $fieldName
	 * @return string
	 */
	private static function getLogicBoolean($modelName, $alais, $fieldName, $pluralityFlag = false) {
		$result = array();
		$result[] = '$data	= $this->data' . $modelName . '[$cnt1];';
		$result[] = '$alias	= \'' . $alais . '\';';
		$result[] = '$field	= \'' . $fieldName . '\';';
		if ($pluralityFlag) {
			$result[] = '$path	= $alias . \'.\' . $cnt2 . \'.\' . $field;';
		} else {
			$result[] = '$path	= $alias . \'.\' . $field;';
		}
		$result[] = '$flag	= Hash::get($data, $path);';
		$result[] = '$value	= $flag? $true: $false;';
		$result[] = '';
		$result[] = 'return h($value);';
		
		return $result;
	}
	
	
	/**
	 * ファイルを作成
	 * @param self $task
	 * @param type $path
	 * @param type $contents
	 * @throws RuntimeException
	 */
	private static function generateLibTraitOrmViewFile(self $task, $path, $contents) {
		$result = $task->createFile($path, $contents);
		if (!$result) {
			throw new RuntimeException('File Generate Error [File:' . $path . ']');
		}
	}
}