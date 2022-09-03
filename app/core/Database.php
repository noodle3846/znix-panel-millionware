<?php

class Database {

	private $dbHost = "localhost";
	private $dbUser = "user";
	private $dbPass = "pass";
	private $dbName = "dbname";

	protected $statement;
	protected $error;

	protected function connect() {

		try {
			
			$dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
			$pdo = new PDO($dsn, $this->dbUser, $this->dbPass);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ, PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//	PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION is needed for catching PDO driver errors
			return $pdo;
			
		} catch(PDOException $e) {

			print "Error!: " . $e->getMessage() . "<br/>";
			die();

		}

	}

	protected function query($sql) {

		$this->statement = $this->connect()->query($sql);

	}

	protected function prepare($sql) {

		$this->statement = $this->connect()->prepare($sql);
		
	}
	

}
