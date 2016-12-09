<?php

class Model_Base
{
	protected static $_db;

	public static function set_db(PDO $db) {
		self::$_db = $db;
	}

	public function hydrate(array $data) {
		foreach($data as $key => $value) {
			$method = 'set_'.$key;
			if(method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}
}

