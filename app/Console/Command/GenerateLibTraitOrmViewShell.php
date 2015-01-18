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
class GenerateLibTraitOrmViewShell extends AppShell {
	
	public $tasks = array(
		'GenerateLibTraitOrmView',
	);
	
    public function main() {
		$shell = $this;
		$modelName = $shell->args[0];
		try {
			$shell->out('Start Generate [Lib/Trait/OrmView/' . $modelName . 'View.php]');
			$shell->GenerateLibTraitOrmView->run($modelName);
			$shell->out('End Generate [Lib/Trait/OrmView/' . $modelName . 'View.php]');
		} catch (RuntimeException $e) {
			$shell->out('Error Message:' . $e->getMessage());
			$shell->out('Error Not Generate [Lib/Trait/OrmView/' . $modelName . 'View.php]');
		}
    }
}