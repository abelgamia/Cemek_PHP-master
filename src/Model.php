<?php

namespace src;

use PDO;
use PDOException;

/**
 *
 * @author Edikowy
 *        
 */
class Model {
	public $conn; // Uchwyt połączenia z bazą danych
	public function __construct() {
		try {
			$this->conn = new PDO(Config::$db['db_driver'].':host='.Config::$db['db_host']
					.';dbname='.Config::$db['db_name'].';charset=utf8'
					,Config::$db['db_user_name'],Config::$db['db_user_pass']);
		}
		catch(PDOException $e) {
			echo $e->getMessage();
			exit();
		}
	}
}

