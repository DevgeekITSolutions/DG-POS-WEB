<?php
include('../../resources/functions.php');
$store_arr = array();


$sql = "SELECT b.store_id,b.store_name,b.address,b.location_name,CONCAT(a.user_fname,' ',a.user_lname)AS franchisee,
        case when b.active = 0 then 'Not Activated' when  b.active = 1 then 'Activated' when b.active = 2 then 'Pos Activate' END Status
        FROM admin_user a INNER JOIN admin_outlets b ON b.user_guid = a.user_guid;";
$result = query($sql);
while($row = mysqli_fetch_array($result)){
    $store_id = $row['store_id'];
    $storename = $row['store_name'];
    $address = $row['address'];
    $location_name = $row['location_name'];
    $franchisee = $row['franchisee'];
    $Status = $row['Status'];
    $store_arr[] = array("id" => $store_id, "name" => $storename, "address" => $address, 'location_name' => $location_name , 'franchisee'=>$franchisee , 'Status' => $Status);
}
echo json_encode($store_arr);
?>