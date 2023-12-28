<?php
/**
 * Logs an event to the database
 * 
 * @param int $log_client_id The client ID of the user who performed the action
 * @param string $what The action that was performed
 * @param string $log_text The text to log
 * @param object $database The database object $database = new Database($host, $user, $pass, $db);
 * 
 */
	require_once("func/func_database.php");
	function AddLog($log_client_id, $what, $log_text, $database) {

		$query = "INSERT into log (timestamp, who, action, text) VALUES (now(), ?, ?, ?)";
	
		if (!($stmt = $database->mysqli->prepare($query))) {
			die("Prepare failed: " . $database->mysqli->error);
		}

		$stmt->bind_param('sss', $log_client_id, $what, $log_text);

		if (!$stmt->execute()) {
			die("Execute failed: " . $stmt->error);
		}

		$stmt->close();
	}
?>	