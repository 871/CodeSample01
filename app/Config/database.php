<?php
class DATABASE_CONFIG {

	public $default = array();

	public $local = array(
		'datasource'	=> 'Database/Mysql',
		'persistent'	=> false,
		'host'			=> 'localhost',
		'login'			=> 'root',
		'password'		=> 'root',
		'database'		=> 'roster',
		'encoding'		=> 'utf8'
	);

	public $development = array(
		'datasource'	=> 'Database/Mysql',
		'persistent'	=> false,
		'host'			=> '*******',
		'login'			=> '*******',
		'password'		=> '*******',
		'database'		=> '*******',
		'encoding'		=> 'utf8'
	);

	public $test = array(
		'datasource'	=> 'Database/Mysql',
		'persistent'	=> false,
		'host'			=> 'localhost',
		'login'			=> 'root',
		'password'		=> 'root',
		'database'		=> 'roster_test',
		'encoding'		=> 'utf8'
	);

	public function __construct() {
		if (is_null(env('USER'))) {
			// Webからのアクセス
			if (env('SERVER_ADDR') === '127.0.0.1') {
				$this->default = $this->local;
			} else {
				$this->default = $this->development;
			}
		} else {
			// コンソールからのアクセス
			if (env('USER') === 'hanai') {
				$this->default = $this->local;
			} else {
				$this->default = $this->development;
			}
		}
	}
}
