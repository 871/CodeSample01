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
		
		$setDataMethod			= self::getSetDataMethod	($model);
		$modelDataCountMethod	= self::getModelDataCountMethod($model);
		$virtualFieldsMethods	= self::getVirtualFields	($model);
		$schemaMethods			= self::getSchemaMethods	($model);
		$hasOneMethods			= self::getHasOneMethods	($model);
		$belongsToMethods		= self::getBelongsToMethods	($model);
		$hasManyMethods			= self::getHasManyMethods	($model);
		$habtmMethods			= self::getHabtmMethods		($model);
		
		$file = new ClassFile();
		$file->setClassType($classType);
		$file->setClassName($className);
		$file->addMember($member);
		$file->addMethod($setDataMethod);
		$file->addMethod($modelDataCountMethod);
		
		foreach ($virtualFieldsMethods as $method) {
			$file->addMethod($method);
		}
		foreach ($schemaMethods as $method) {
			$file->addMethod($method);
		}
		foreach ($hasOneMethods as $method) {
			$file->addMethod($method);
		}
		foreach ($belongsToMethods as $method) {
			$file->addMethod($method);
		}
		foreach ($hasManyMethods as $method) {
			$file->addMethod($method);
		}
		foreach ($habtmMethods as $method) {
			$file->addMethod($method);
		}
		return $file->getContents();
	}
	
	private static function getSetDataMethod(AppOrmModel $model) {
		$modelName = $model->name;
		
		$methodName	= 'setData' . $modelName;
		$access		= 'public';
		$arg		= '$data' . $modelName;
		$arrLogic	= array(
			'$this->data' . $modelName . ' = ' . $arg . ';'
		);
		$methodComment	= $modelName . '::$data';
		$memo1			= "if (!isset(" . $arg . "))	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);";
		$memo2			= '$ctlHelper->' . $methodName . '(' . $arg . ');';
		$method = new ClassMethod();
		$method->setMethodName($methodName);
		$method->setAccess($access);
		$method->setLogic($arrLogic);
		$method->addArg($arg, 'array ' . $arg , 'array');
		$method->addMethodComment($methodComment);
		$method->addMethodComment($memo1);
		$method->addMethodComment($memo2);
		
		return $method;
	}
	
	/**
	 * HasManyアソシエーションのメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMethod>
	 */
	private static function getModelDataCountMethod(AppOrmModel $model) {
		$modelName		= $model->name;
		$methodComment	= 'データカウント（' . $modelName . '）';
		$methodName	= 'getData' . $modelName . 'Count';
		$access		= 'public';
		$arrLogic	= array(
			'return count($this->data' . $modelName . ');',
		);
		$memo1			= '$cnt = $ctlHelper->' . $methodName . '();';
		$returnComment	= 'int';
		
		$method = new ClassMethod();
		$method->setMethodName($methodName);
		$method->setAccess($access);
		$method->setLogic($arrLogic);
		$method->addMethodComment($methodComment);
		$method->addMethodComment($memo1);
		$method->setReturnComment($returnComment);
		return $method;
	}

	/**
	 * バーチャルフィールドのメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMethod>
	 */
	private static function getVirtualFields(AppOrmModel $model) {
		$result		= array();
		$modelName	= $model->name;
		$fieldNames	= array_keys($model->virtualFields);
		
		foreach ($fieldNames as $fieldName) {
			$cameFieldName	= Inflector::camelize($fieldName);
			$methodName		= 'getText' . $modelName . $cameFieldName;
			$access			= 'public';
			$arrLogic		= self::getLogicString($modelName, $modelName, $fieldName);
			$methodComment	= $modelName . '::virtualFields[' . $fieldName . ']';
			$memo1			= '$text' . $modelName . $cameFieldName . '	= $ctlHelper->' . $methodName . '	($i);';
			$memo2			= '<?php echo $text' . $modelName . $cameFieldName . '	; ?>';
			$returnComment	= 'string';
					
			$method = new ClassMethod();
			$method->setMethodName($methodName);
			$method->setAccess($access);
			$method->setLogic($arrLogic);
			$method->addMethodComment($methodComment);
			$method->addMethodComment($memo1);
			$method->addMethodComment($memo2);
			$method->setReturnComment($returnComment);
			$method->addArg('$cnt = 0', 'int $cnt');
			
			$result[] = $method;
		}
		return $result;
	}
	
	/**
	 * スキーマ情報のメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMethod>
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
	 * @return \ClassMethod
	 */
	private static function getSchemaMethod($modelName, $fieldName, $type, $comment, $prefix = '', $pluralityFlag = false) {
		$access			= 'public';
		$cameFieldName	= Inflector::camelize($fieldName);
		$methodName		= 'getText' . $prefix . $modelName . $cameFieldName;
		if ($pluralityFlag) {
			$memo1	= '$text' . $prefix . $modelName . $cameFieldName . '	= $ctlHelper->' . $methodName . '	($i, $j);';
		} else {
			$memo1	= '$text' . $prefix . $modelName . $cameFieldName . '	= $ctlHelper->' . $methodName . '	($i);';
		}
		$memo2			= '<?php echo $text' . $prefix . $modelName . $cameFieldName . '	; ?>';
		$returnComment	= 'string';
		$rootModelName	= $prefix === ''? $modelName: $prefix;
		
		$method = new ClassMethod();
		$method->setMethodName($methodName);
		$method->setAccess($access);
		$method->addArg('$cnt1 = 0', 'int $cnt1');
		if ($pluralityFlag) {
			$method->addArg('$cnt2 = 0', 'int $cnt2');
		}
		switch ($type) {
			case 'text':
				$arrLogic = self::getLogicText($rootModelName, $modelName, $fieldName, $pluralityFlag);
				$method->setLogic($arrLogic);
				break;
			case 'boolean':
				$arrLogic = self::getLogicBoolean($rootModelName, $modelName, $fieldName, $pluralityFlag);
				$method->setLogic($arrLogic);
				$method->addArg('$true = \'可\'', 'string $true');
				$method->addArg('$false = \'不可\'', 'string $false');
				break;
			case 'float':
			case 'integer':
				$arrLogic = self::getLogicInteger($rootModelName, $modelName, $fieldName, $pluralityFlag);
				$method->setLogic($arrLogic);
				break;
			case 'string':
			default :
				$arrLogic = self::getLogicString($rootModelName, $modelName, $fieldName, $pluralityFlag);
				$method->setLogic($arrLogic);
				break;
		}
		$method->addMethodComment($comment);
		$method->addMethodComment($memo1);
		$method->addMethodComment($memo2);
		$method->setReturnComment($returnComment);
		
		return $method;
	}

	/**
	 * HasOneアソシエーションのメソッド
	 * @param AppOrmModel $model
	 * @return array<ClassMethod>
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
	 * @return array<ClassMethod>
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
	 * @return array<ClassMethod>
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
	 * @return array<ClassMethod>
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
	 * @param type $methodComment
	 * @return \ClassMethod
	 */
	private static function getDataCountMethod($alias, $modelName, $methodComment) {
		$methodName	= 'getData' . $modelName . $alias . 'Count';
		$access		= 'public';
		$arrLogic	= array(
			'if (isset($this->data' . $modelName . '[$cnt][\''. $alias . '\'])) {',
			'	return count($this->data' . $modelName . '[$cnt][\''. $alias . '\']);',
			'} else {',
			'	return 0;',
			'}',
		);
		$memo1			= '$cnt = $ctlHelper->' . $methodName . '();';
		$returnComment	= 'int';
		
		$method = new ClassMethod();
		$method->setMethodName($methodName);
		$method->setAccess($access);
		$method->addArg('$cnt', 'int $snt1');
		$method->setLogic($arrLogic);
		$method->addMethodComment($methodComment);
		$method->addMethodComment($memo1);
		$method->setReturnComment($returnComment);
		return $method;
	}
	
	
	/**
	 * 複数項目の一覧表示
	 * @param type $alias
	 * @param type $displayField
	 * @param type $modelName
	 * @param type $methodComment
	 * @return \ClassMethod
	 */
	private static function getDisplayFieldsMethod($alias, $displayField, $modelName, $methodComment) {
		$methodName	= 'getText' . $modelName . $alias . 'Display';
		$access		= 'public';
		$arg		= '$display = \'' . $displayField . '\'';
		$arrLogic	= array(
			'$data	= $this->data' . $modelName . '[$cnt1];',
			'$path	= \'' . $alias . '.{n}.\' . $display;',
			'$tmp	= Hash::extract($data, $path);',
			'',
			'return join(",\n", $tmp);',
		);
		$memo1			= '$text' . $modelName . $alias . 'Display = $ctlHelper->' . $methodName . '($i);';
		$memo2			= '<?php $text' . $modelName . $alias . 'Display; ?>';
		$returnComment	= 'string';
		
		$method = new ClassMethod();
		$method->setMethodName($methodName);
		$method->setAccess($access);
		$method->setLogic($arrLogic);
		$method->addArg('$cnt1', 'int $cnt1');
		$method->addArg($arg, 'string $display');
		$method->addMethodComment($methodComment);
		$method->addMethodComment($memo1);
		$method->addMethodComment($memo2);
		$method->setReturnComment($returnComment);
		return $method;
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