<?php session_start();

include '../../resources/functions.php';

$from 	  = $_POST['from'];
$fname 	  = '';
$lname    = '';
$emails   = $_POST['emails'];
$subject  = escape_string($_POST['subject']);
$content  = escape_string($_POST['content']);
$guid 	  = '';
$datenow  = FullDateFormat24HR();
$status   = 'INBOX';
$origin   = 'Server';
$synced   = 'Unsynced';


foreach($emails as $result) {
	
	$query = query("SELECT user_fname, user_lname, user_guid FROM posrev.admin_user WHERE user_email = '".$result."' LIMIT 1");
	confirm($query);
	$row    = fetch_array($query);
	$fname  = $row['user_fname'];
	$lname  = $row['user_lname'];
	$guid   = $row['user_guid'];
	$table  = "posrev.admin_message";
	$fieds  = "`from`, `fname`, `lname`, `email`,`subject`, `content`, `guid`, `created_at`, `status`, `origin`, `synced`";
	$values = "'$from','$fname','$lname','$result','$subject','$content','$guid','$datenow','$status','$origin','$synced'";
	save($table,$fieds,$values);

}

echo " Message sent";

?>