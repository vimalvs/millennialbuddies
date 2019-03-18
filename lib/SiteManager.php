<?php
class SiteManager {
	public static function getDatabase() {
		try {
			// return new DbManager('host=localhost;dbname=student_db', 'root', '', []);
			$conn = new PDO(DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT  . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch (Exception $e) {
			print_r($e);
		}
	}
	public static function getDatabase1() {
		try {
			return new DbManager(DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT  . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS, []);
			// $conn = new PDO(DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT  . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
			// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// return $conn;
		} catch (Exception $e) {
			print_r($e);
		}
	}		
}