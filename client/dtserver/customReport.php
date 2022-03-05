<?php
include('../../resources/functions.php');
session_start();
$report_arr = array();
$store_id = $_GET['storeid'];
$productid = $_GET['productid'];
$Count = 0;
$transaction_type = $_GET['transaction_type'];
$coupon_type = $_GET['coupon_type'];
$array = explode(' - ', $_GET['dateval']);
foreach($array as $value) {

	if($Count == 0 ) {
		$Date1 = $value;
	}elseif ($Count > 0) {
		$Date2 = $value;
	}

$Count += 1;

}

$Date1 = date_create($Date1);
$Date1 = date_format($Date1,"Y-m-d");

$Date2 = date_create($Date2);
$Date2 = date_format($Date2,"Y-m-d");


// if($store_id == 'All'){
//     $filter = " ORDER BY ADT.created_at DESC LIMIT 20; ";
// }else{
//     $filter = " WHERE OT.store_id = '".$store_id."' ORDER BY ADT.created_at DESC LIMIT 20; ";
// }


// $sql = "SELECT OT.store_name AS StoreName, OT.store_id AS StoreID, OT.address AS Address, OT.Barangay AS Brgy, OT.municipality AS Municipality, 
//                     OT.province AS Province, OT.postal_code AS Postal,ADT.transaction_number, ADT.total,ADT.created_at AS DATE
//                     FROM posrev.admin_daily_transaction_details ADT 
//                     INNER JOIN posrev.admin_outlets OT ON ADT.store_id = OT.store_id
//                     ".$filter;
$filter_store = '';
$filter_product = '';
$filter_transaction_type = '';
$filter_coupon_type = '';

if($store_id != 'All'){
    $filter_store = " AND a.store_id = '".$store_id."' ";
}else{
    $filter_store = " AND b.user_guid = '".$_SESSION['client_user_guid']."' AND b.active = 2 ";
}

if($productid != 'All'){
    $filter_product = " AND a.product_name = '".$productid."' ";
}

if($transaction_type != 'All'){
    if($transaction_type == 'All(Cash)'){
        $filter_transaction_type = " AND a.transaction_type = 'Walk-In' ";
    }else if($transaction_type == 'All(Others)'){
        $filter_transaction_type = " AND a.transaction_type != 'Walk-In' ";
    }else{
        $filter_transaction_type = " AND a.transaction_type = '".$transaction_type."' ";
    }
    
}

if($coupon_type != 'All'){
    $filter_coupon_type = " AND c.discount_type = '".$coupon_type."' ";
}

$sql = "SELECT a.*,DATE(a.created_at) t_date,b.store_name,c.discount_type FROM posrev.admin_daily_transaction_details a 
inner join posrev.admin_outlets b on b.store_id = a.store_id 
inner join posrev.admin_daily_transaction c on c.transaction_number = a.transaction_number
WHERE DATE_FORMAT(a.zreading, '%Y-%m-%d') >= '".$Date1."' AND DATE_FORMAT(a.zreading, '%Y-%m-%d') <= '".$Date2."' 
".$filter_store." ".$filter_product." ".$filter_transaction_type." ".$filter_coupon_type." ";

$result = query($sql);
confirm($result);
while($row = mysqli_fetch_array($result)){
    
    
    $report_arr[] = array("id" => $row['details_id'],"store_name" => $row['store_name'], "name" => $row['product_name'], 
                        "transaction_number" => $row['transaction_number'], 'quantity' => $row['quantity'] 
                        ,'price'=>$row['price'],'total'=>$row['total'],'Transaction_type'=>$row['transaction_type'],
                        'discount_type'=>$row['discount_type'],
                        'Transaction_date'=>$row['t_date'],'Read Date'=>$row['zreading']);
}
echo json_encode($report_arr);
?>