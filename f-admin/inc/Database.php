<?php 

    require_once(__DIR__ . "/conn.php");

	class Database {
		

        public $error;

		private $db_host;
        private $db_port = 3306;
		private $db_user;
		private $db_pass;
		private $db_name;
		private $connection;

		function __construct(){
			$validMySQLConfigName = array(
				"F__MYSQL_HOST",
				"F__MYSQL_USERNAME",
				"F__MYSQL_PASSWORD",
				"F__MYSQL_DATABASE"
			);
			$invalidMySQLConfigName = [];
			foreach($validMySQLConfigName as $MySQLConfig){
				if(!defined($MySQLConfig)){
					array_push($invalidMySQLConfigName, $MySQLConfig);
				}
			}

            if(count($invalidMySQLConfigName) === 0){
                $this->db_host = F__MYSQL_HOST;
                if(isset($db_config['port'])) $this->db_port = F__MYSQL_PORT;
                $this->db_user = F__MYSQL_USERNAME;
                $this->db_pass = F__MYSQL_PASSWORD;
                $this->db_name = F__MYSQL_DATABASE;
                $this->connect();
            } else {
				$errorText = "<strong>FATAL ERROR!</strong> ";
				$errorText .= "Invalid MySQL Connection parameters: ";
				foreach($invalidMySQLConfigName as $MySQLConfig){
					$errorText .= $MySQLConfig . ", ";
				}
				$errorText = rtrim($errorText, ", ");
				$errorText .= ".";
				die($errorText);
			}
		}
		
		function connect(){
            $this->connection = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name, $this->db_port);
			mysqli_set_charset($this->connection, "utf8");
		}

		function numRows($table, $filter=""){
			if(!is_string($table)) return false;
			if(($filter !== "") && is_string($filter)){
				$filter = " WHERE ".$filter;
			} else {
				$filter = "";
			}
			$query = mysqli_query($this->connection, "SELECT COUNT(*) AS total FROM $table".$filter);
			return intval(mysqli_fetch_array($query)['total']);
		}

		function query($query_string){
			if(!is_string($query_string)) return false;
			$sql_cmd = strtolower(explode(" ", $query_string)[0]);
			$query = mysqli_query($this->connection, $query_string);
			$results = [];
			$results['query'] = $query_string;
			if($sql_cmd === "select"){
				$results['total'] = mysqli_num_rows($query);
				$results['data'] = [];
				if($results['total']){
					while($row_result = mysqli_fetch_array($query)){
						$data = $row_result;
						foreach($data as $key => $value){
							if(is_int($key)) unset($data[$key]);
						}
						array_push($results['data'], $data);
					}
				}
			} else {
				$results['error'] = ($query === false) ? true : false; 
				$results['error_text'] = mysqli_error($this->connection);
			}
			return $results;
		}

		function sanitizeInput($data){
			$data = htmlspecialchars($data);
			return mysqli_escape_string(
				$this->connection,
				$data
			);
		}

        function getConnection(){
            return $this->connection;
        }

		function close(){
			mysqli_close($this->connection);
		}
	}

?>