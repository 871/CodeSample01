<?php
/**
 * Created by PhpStorm.
 * User: hanai
 * Date: 2014/05/28
 * Time: 21:57
 */

namespace UseCase;

\App::import('Lib/UseCase', 'AppUseCase');
\App::import('Lib/Dto/UseCase', 'TplUseCaseDto');

class Tpl extends \UseCase\AppUseCase {

	/**
	 * ユースケース実行
	 */
	public static function run(\UseCase\AppUseCaseDto $dto) {
		self::_run($dto);
	}

	/**
	 * @param TplUseCaseDto $dto
	 */
	private static function _run(\UseCase\TplUseCaseDto $dto) {
		$db = $dto->getDataSource();
		// TODO ロジック未実装

		try {
			$db->begin();
			// TODO ロジック未実装



			$db->commit();
			$result		= '';
			$message	= '';
			$dto->setErrorFlag(false);
			$dto->setResult($result);
			$dto->setMessage($message);
		} catch (\ErrorException $e) {
			$db->rollback();
			$dto->setErrorFlag(true);
			$dto->setResult(null);
			$dto->setMessage($e->getMessage());
		}
	}
}