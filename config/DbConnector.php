<?php
	/**
	* Database Connection
	*/
	// namespace config;

// use PDO;


    
	class DbConnector {
		private $server = 'localhost';
		private $dbname = 'boq_master';
		private $user = 'root';
		private $pass = '';

		public function getConnection() {
			try {
				$conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch (PDOException $e) {
				echo "Database Error: " . $e->getMessage();
			}
		}
        
	}
