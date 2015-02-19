<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppShell', 'Console/Command');

/**
 * Description of GenerateLibTraitOrmViewShell
 *
 * @author hanai
 */
class GenerateAuthUtilShell extends AppShell {
	
	public $tasks = array(
		'GenerateAuthUtil',
	);
	
    public function main() {
		$shell = $this;
		$authModelName = $shell->args[0];
		
		try {
			$shell->out('Start Generate [Lib/Util/AuthUtil.php]');
			$shell->GenerateAuthUtil->run($authModelName);
			$shell->out('End Generate [Lib/Util/AuthUtil.php]');
		} catch (RuntimeException $e) {
			$shell->out('Error Message:' . $e->getMessage());
			$shell->out('Error Not Generate [Lib/Util/AuthUtil.php]');
		} catch (Exception $e) {
			$shell->out('System Error [' . $e->getMessage() . ']');
			$shell->out('Error Not Generate [Lib/Util/AuthUtil.php]');
		}
    }
}