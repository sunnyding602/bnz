<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out


// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions


class Session {
	
	public $logged_in = false;
	public $user_id;
	public $message;
	
	function __construct() {
		session_start ();
		//$this->check_message ();
		$this->check_login ();
		if ($this->logged_in) {
			// actions to take right away if user is logged in
			//echo 'Logged in';
		} else {
			// actions to take right away if user is not logged in
			//echo 'Not logged in';
			
		}
	}
	
	public function is_logged_in() {
		return $this->logged_in;
	}
	
	public function login($user) {
		// database should find user based on username/password
		if ($user) {
			$this->user_id = $_SESSION ['user_id'] = $user;
			$this->logged_in = true;
		}
	}
	
	public function logout() {
		unset ( $_SESSION ['user_id'] );
		unset ( $this->user_id );
		$this->logged_in = false;
	}
//error message control	
	public function set_error_message($msg = "") {
		if (! empty ( $msg )) {
			// then this is "set message"
			// make sure you understand why $this->message=$msg wouldn't work
			$_SESSION ['error_message'] = $msg;
		} else {
			// then this is "get message"
			return $this->message;
		}
	}
	
	public function check_error_message() {
		if (isset ( $_SESSION ['error_message'] )) {
			return $_SESSION ['error_message'];
		} else {
			return false;
		}
	}
	
	public function remove_error_message() {
		if (isset ( $_SESSION ['error_message'] )) {
			unset ( $_SESSION ['error_message'] );
			return true;
		} else {
			return false;
		}
	}
//notice message control
	public function set_notice_message($msg = "") {
		if (! empty ( $msg )) {
			// then this is "set message"
			// make sure you understand why $this->message=$msg wouldn't work
			$_SESSION ['notice_message'] = $msg;
		} else {
			// then this is "get message"
			return $this->message;
		}
	}
	
	public function check_notice_message() {
		if (isset ( $_SESSION ['notice_message'] )) {
			return $_SESSION ['notice_message'];
		} else {
			return false;
		}
	}
	
	public function remove_notice_message() {
		if (isset ( $_SESSION ['notice_message'] )) {
			unset ( $_SESSION ['notice_message'] );
			return true;
		} else {
			return false;
		}
	}
//------------------------
	private function check_login() {
		if (isset ( $_SESSION ['user_id'] )) {
			$this->user_id = $_SESSION ['user_id'];
			$this->logged_in = true;
		} else {
			unset ( $this->user_id );
			$this->logged_in = false;
		}
	}
	
	/*private function check_message() {
		// Is there a message stored in the session?
		if (isset ( $_SESSION ['message'] )) {
			// Add it as an attribute and erase the stored version
			$this->message = $_SESSION ['message'];
			unset ( $_SESSION ['message'] );
		} else {
			$this->message = "";
		}
	}*/

}

?>