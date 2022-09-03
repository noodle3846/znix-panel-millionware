<?php

class Session {

    public static function init() {

		session_start();
			
	}


    public static function set($key, $val) {

		$_SESSION[$key] = $val;
			
	}


    public static function get($key) {

		return (array_key_exists($key, $_SESSION) && is_string($_SESSION[$key])) ? $_SESSION[$key] : false;	//	isset($_SESSION[$key]) will return undefined index, if the key doesn't exist in the array
			
	}


	public static function isLogged() {

		return (array_key_exists($key, $_SESSION) && is_bool($_SESSION[$key]) && $_SESSION[$key] !== false); // Maintains the same logic as earlier. It's just a good practice to do integrity checks every now and then.

	}


	public static function isAdmin() {

		return (array_key_exists("login", $_SESSION) && isset($_SESSION["login"]) && intval($_SESSION["admin"]) === 1); // Maintains the same logic as earlier

	}


	public static function isBanned() {

		return (array_key_exists("login", $_SESSION)	// In case you don't want your php error log to be flooded with undefined index notices at some point :)
				&& isset( $_SESSION["login"] )
				&& intval( $_SESSION["banned"] ) === 1
				&& intval( $_SESSION["admin"] ) === 0);

	}

}