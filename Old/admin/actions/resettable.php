<?php


include '../../resources/conn.php';
include '../../resources/functions.php';

$tabletoreset = $_POST['tabletoreset'];
$store_id = $_POST['storeid'];

$table = array();
$return = "";
if ($tabletoreset == "Sales") {
   $table = array("loc_daily_transaction", "loc_daily_transaction_details");
} else if ($tabletoreset == "Logs") {
   $table = array("loc_system_logs", "loc_send_bug_report");
} else if ($tabletoreset == "Inventory"){
   $table = array("loc_pos_inventory", "loc_fm_stock");
} else {
   $table = array("loc_script_runner");
}
foreach ($table as $value) {
	$query = "TRUNCATE TABLE " .$value;
	$datenow = FullDateFormat24HR();
	if ($value == "loc_script_runner") {
		$sql = "INSERT INTO `admin_script_runner`(`script_command`, `store_id`, `created_at`, `truncatescript`,`active`) VALUES ('$query','$store_id','$datenow','YES',1)";
	} else {
		$sql = "INSERT INTO `admin_script_runner`(`script_command`, `store_id`, `created_at`, `truncatescript`,`active`) VALUES ('$query','$store_id','$datenow','NO',1)";
	}
	$result = mysqli_query($connection, $sql);
	sleep(1);
}
echo "Complete!";
?>