<?php
/**
 * Created by PhpStorm.
 * User: hanai
 * Date: 2014/05/28
 * Time: 20:06
 */

namespace UseCase;

\App::uses('AppDto', 'Lib/Dto');

abstract class AppUseCaseDto extends AppDto {

	/**
	 * メッセージ
	 * @var string
	 */
	protected $message = '';

	/**
	 * 実行結果
	 * @var mix
	 */
	protected $result = '';

	/**
	 * エラーフラグ
	 * @var boolean
	 */
	protected $errorFlag = false;

	/**
	 * @var DataSource
	 */
	protected $dataSource = '';

	/**
	 * @return DataSource
	 */
	public function getDataSource() {
		return $this->dataSource;
	}

	/**
	 * @param DataSource $dataSource
	 */
	public function setDataSource(DataSource $dataSource) {
		$this->dataSource = $dataSource;
	}

	/**
	 * @return boolean
	 */
	public function getErrorFlag() {
		return $this->errorFlag;
	}

	/**
	 * @param boolean $errorFlag
	 */
	public function setErrorFlag($errorFlag) {
		$this->errorFlag = $errorFlag;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param string $message
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * @return mix
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * @param mix $result
	 */
	public function setResult($result) {
		$this->result = $result;
	}
}