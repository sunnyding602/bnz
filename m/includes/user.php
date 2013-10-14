<?php
require_once ('database.php');

class User extends Database {
	public $user_info_id;
	public $user_id;
	public $user_password;
	public $user_nickname;
	public $user_email;
	public $yin_si;
	public $user_total_circle;
	public $user_total_bar;
	public $user_total;
	public $user_rank;
	
	public function authenticate($username = "", $password = "") {
		//Notice!!! 注意这里global 的使用!!!
		global $database;
		$username = $database->escape_value ( $username );
		$password = $database->escape_value ( $password );
		
		$sql = "SELECT * FROM user_info ";
		$sql .= "WHERE user_id = '{$username}' ";
		$sql .= "AND user_password = '{$password}' ";
		$sql .= "LIMIT 1";
		$result_array = $this->find_by_sql ( $sql );
		return ! empty ( $result_array ) ?  $result_array : false;
	}
	
	public function find_by_sql($sql = '') {
		global $database;
		//虽然是extends 但是还得这样用!!!!!!!!!!!!!! 这个不算bug的问题折腾我了这么久.....记住它
		$result = $database->query ( $sql );
		$result_array = $database->fetch_array ( $result );
		return $result_array;
	}
}

?>