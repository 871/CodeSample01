<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppUseCase
 *
 * @author hanai
 */
namespace UseCase;


abstract class AppUseCase {
	
	/**
	 * ユースケース実行
	 */
	abstract public static function run(AppUseCaseDto $dto);
	
	
	final public function __construct() {
		throw new Exception('AppUseCase Class Static Only');
	}
}