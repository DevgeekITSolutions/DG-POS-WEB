<?php
include '../../resources/conn.php';
include '../../resources/functions.php';
global $connection;
$user_guid = $_POST['id'];
$sql = "SELECT user_role FROM admin_user WHERE user_guid = '$user_guid'";
$result = query($sql);
$row = mysqli_fetch_array($result);
if ($row['user_role'] == 'Admin') {
	echo "Unsuccessful";
} else {
	$sql = "SELECT * FROM admin_outlets WHERE user_guid = '$user_guid' ";
	$result = query($sql);
	$row = mysqli_fetch_array($result);
	$rowcount =  mysqli_num_rows($result);
	if ($rowcount > 0) {
		echo 'HasOutlet';
	} else {
 		$query = query("DELETE FROM `admin_user` WHERE user_guid = '$user_guid'");
        confirm($query);
		echo 'Success';
	}
}
?>