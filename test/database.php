<?php
require_once ('connectvars.php');
class Database {
	public $dbc;
	public $last_query;
	
	// open and close the database connection
	function open_connection() {
		$this->dbc = mysqli_connect ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
		if (! $this->dbc) {
			die ( "Database connection failed: " . mysqli_error () );
		} else {
			mysqli_query ( $this->dbc, "SET NAMES 'utf8'" );
			return true;
		}
	}
	
	public function close_connection() {
		if (isset ( $this->dbc )) {
			mysqli_close ( $this->dbc );
			unset ( $this->dbc );
		}
	}
	
	public function query($sql) {
		$this->last_query = $sql;
		$result = mysqli_query ( $this->dbc, $sql );
		$this->confirm_query ( $result );
		return $result;
	}
	
	private function confirm_query($result) {
		if (! $result) {
			$output = "Database query failed: " . mysqli_error () . "<br /><br />";
			$output .= "Last SQL query: " . $this->last_query;
			die ( $output );
		}
	}
	
	//This would probably be a unique method
	public function ouput_table($query) {
		$result = $this->query ( $query );
		$fetch_fields = mysqli_fetch_fields ( $result );
		$affected_rows = mysqli_affected_rows ( $this->dbc );
		
		echo $affected_rows;
		echo ' ';
		echo count ( $fetch_fields );
		
		$total_fields = count ( $fetch_fields );
		$table = array ();
		while ( $data = mysqli_fetch_array ( $result ) ) {
			array_push ( $table, $data );
		}
		//echo $table[0][1];
		echo '<table>';
		for($row = 0; $row < $affected_rows; $row ++) {
			echo '<tr>';
			for($field = 0; $field < $total_fields; $field ++) {
				echo '<td>';
				echo $table [$row] [$field];
				echo '</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
		/*echo '<pre>';
		print_r ( $fetch_fields );
		echo '</pre>';*/
	}

	public function total_rows($table){
		$sql = "SELECT COUNT(*) FROM {$table}"; 
		$result = mysqli_fetch_array( $this->query($sql) );
		$total_rows = $result['COUNT(*)'];
		return $total_rows;
	}

}




?>